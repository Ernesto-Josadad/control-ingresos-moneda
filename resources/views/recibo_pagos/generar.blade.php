@extends('layouts.master')
@section('titulo', 'generar_pagos')
@section('contenido')
<style>

</style>
<div class="card mt-4">
    <form id="miForm" onsubmit="sendFormToBackend(event)">
        @csrf
        <div class="card-body">
            <h5 class="card-body text-center">RECIBO COBROS</h5>
            <div>
                <button class="btn btn-primary" id="btnRecargarPagina">Limpiar Campos</button>
            </div>
            <div class="grid-item">
                <div class="grid item">
                    <div class="col-md-6" style="width: 30%;">
                        <label for="matricula">Recibí de:</label>
                        <div class="row">

                            <div class="col-md-6">
                                <input type="number" id="inputMatricula" class="form-control" placeholder="MATRICULA">
                            </div>
                            <div class="col-md-6 mt-2 mt-md-0">
                                <button class="btn btn-success btn-sm" id="btnActualizar">BUSCAR</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group" style="margin-left:80%">
                    <input type="text" class="form-control" name="folio" id="folio" placeholder="FOLIO" required>

                    <input type="date" id="fecha" class="form-control" required>
                </div>


                <div class="row" mb-3>
                    <div class="col-md-4">
                        <input type="number" class="form-control" id="alumno_id" name="alumno_id" hidden>
                    </div>
                </div>
                <div class="row mb-3"> <!-- Añadimos mb-3 para la separación -->
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="matricula" placeholder="NOMBRES" id="nombres">
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="matricula" placeholder="NOMBRES" id="matricula">
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="matricula" placeholder="APELLIDO P" id="apellido_paterno">
                    </div>
                    <div class="col-md-4 mt-3">
                        <input type="text" class="form-control" name="matricula" placeholder="APELLIDO M" id="apellido_materno">
                    </div>
                </div>

                <div class="row mb-3"> <!-- Añadimos mb-3 para la separación -->
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="matricula" placeholder="GRADO" id="grado">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="matricula" placeholder="GRUPO" id="grupo">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="matricula" placeholder="CARRERA" id="carrera">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="matricula" placeholder="TURNO" id="turno">
                    </div>
                </div>

                <div class="grid-item">
                    <div class="row">
                        <div class="col-md-2">
                            <input type="text" id="inputCode" class="form-control" placeholder="CLAVE SUBGRUPO">
                        </div>
                        <div class="col-md-6 mt-2 mt-md-0 mb-4">
                            <button class="btn btn-success btn-sm" id="btnAddNewRow">BUSCAR</button>
                        </div>

                        <div class="col-md-6 mt-2 mt-md-0 mb-4">
                            <input type="number" id="claveSubgrupoId" class="form-control" hidden>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <table class="table" id="subGroupTable">
                        <thead>
                            <tr>
                                <th>Cantidad</th>
                                <th>Clave</th>
                                <th>Concepto</th>
                                <th>Cuota</th>
                                <th>Importe</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Aquí colocas la primera fila que estará presente siempre -->


                            <!-- Aquí puedes agregar más filas dinámicamente si es necesario -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="footer">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </div>
    </form>
</div>
</div>
</div>
</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.getElementById('btnRecargarPagina').addEventListener('click', function() {
        // Redirecciona a la misma página para recargarla y limpiar los cambios
        window.location.reload();
    });


    document.addEventListener('DOMContentLoaded', function() {
        // Aquí dentro colocarías todas tus funciones y llamadas a funciones
        actualizarCampos();
        addNewRowTableSubGroup();

    });

    function actualizarCampos() {
        document.getElementById('btnActualizar').addEventListener('click', function() {
            var matriculaAlumno = document.getElementById('inputMatricula').value; // Obtener la matrícula del alumno
            console.log(matriculaAlumno);
            var alumnos = @json($students);

            var alumnoSeleccionado = alumnos.find(function(alumno) {
                return alumno.matricula == matriculaAlumno; // Comparar por matrícula en lugar de ID
                console.log(alumno.matricula);
            });


            // Actualizar los campos del formulario con la información del alumno seleccionado
            document.getElementById('alumno_id').value = alumnoSeleccionado.id;
            document.getElementById('nombres').value = alumnoSeleccionado.nombres;
            document.getElementById('matricula').value = alumnoSeleccionado.matricula;
            document.getElementById('apellido_paterno').value = alumnoSeleccionado.apellido_paterno;
            document.getElementById('apellido_materno').value = alumnoSeleccionado.apellido_materno;
            document.getElementById('grado').value = alumnoSeleccionado.grado;
            document.getElementById('grupo').value = alumnoSeleccionado.grupo;
            document.getElementById('carrera').value = alumnoSeleccionado.carrera;
            document.getElementById('turno').value = alumnoSeleccionado.turno;

        });
    }

    function addNewRowTableSubGroup() {
        document.getElementById('btnAddNewRow').addEventListener('click', function() {
            var codigoSubGrupo = document.getElementById('inputCode').value; // Obtener la matrícula del alumno
            var subGrupos = @json($subGroups);

            var subGrupoSeleccionado = subGrupos.find(function(subGrupo) {
                return subGrupo.codigo == codigoSubGrupo; // Comparar por matrícula en lugar de ID
            });

            if (subGrupoSeleccionado) {
                // Limpiar la tabla antes de agregar nuevos datos
                // document.getElementById('subGroupTable').getElementsByTagName('tbody')[0].innerHTML = '';

                // Definimos los input a usar en la tabla
                let cantidadInput = document.createElement("input");
                // definimos valor inicial
                cantidadInput.value = 1;

                // Crear una nueva fila de tabla con los datos del alumno seleccionado
                var newRow = document.getElementById('subGroupTable').getElementsByTagName('tbody')[0].insertRow();
                var cellCantidad = newRow.insertCell(0);
                var cellCodigo = newRow.insertCell(1);
                var cellDescripcion = newRow.insertCell(2);
                var cellCosto = newRow.insertCell(3);
                var cellImporte = newRow.insertCell(4);

                let cantidad = cantidadInput.value;

                // Obtiene el valor del campo costo del componente
                let costo = subGrupoSeleccionado.costo;

                // Calcula el nuevo importe
                let importe = cantidad * costo;

                // Asignar los valores a las celdas de la fila
                cellCantidad.appendChild(cantidadInput);
                cellCodigo.innerHTML = subGrupoSeleccionado.codigo;
                cellDescripcion.innerHTML = subGrupoSeleccionado.descripcion;
                cellCosto.innerHTML = subGrupoSeleccionado.costo;
                cellImporte.textContent = importe;
                document.getElementById('claveSubgrupoId').value = subGrupoSeleccionado.id;

                // Agregar un evento change al input cantidad
                cantidadInput.addEventListener("change", function() {
                    // Obtiene el valor del input cantidad
                    let cantidad = cantidadInput.value;

                    // Obtiene el valor del campo costo del componente
                    let costo = subGrupoSeleccionado.costo;

                    // Calcula el nuevo importe
                    let importe = cantidad * costo;

                    // Actualiza el valor del elemento que muestra el importe
                    cellImporte.textContent = importe;
                });
            } else {
                // Si no se encuentra el alumno con la matrícula proporcionada, mostrar un mensaje de error o manejar la situación según sea necesario
                console.error('Sub grupo no encontrado con el codigo: ' + codigoSubGrupo + ' no encontrado');
            }
        });
    }

    async function sendFormToBackend(event) {
        event.preventDefault();
        let detallePagos = []; // Definir detallePagos dentro de la función
        let form = {};
        // Traemos los datos de la tabla de sub grupos 
        let table = document.getElementById('subGroupTable');
        if (table) {
            console.log('Se encontró la tabla');

            // Obtener todas las filas de la tabla
            let rows = table.getElementsByTagName('tr');

            // Iterar sobre todas las filas, excepto la primera (encabezados)
            for (let i = 1; i < rows.length; i++) {
                let cells = rows[i].getElementsByTagName('td');

                // Obtener los valores de las celdas en la fila actual
                let importeString = cells[4].textContent;
                let importe = parseFloat(importeString, 10);
                let cantidadSubgrupo = cells[0].querySelector('input');
                let cantidad = parseInt(cantidadSubgrupo.value, 10);

                // Crear un objeto con los datos del detalle de pago y agregarlo al array
                let detallePago = {
                    folio: document.getElementById('folio').value,
                    clave_subgrupo_id: parseInt(document.getElementById('claveSubgrupoId').value, 10),
                    importe: importe,
                    cantidad_subgrupo: cantidad
                };
                detallePagos.push(detallePago);
            }
        } else {
            console.error('No se encontró la tabla');
            return; // Salir de la función si no se encontró la tabla
        }

        // Obtener la fecha y formatearla
        let fechaInput = document.getElementById('fecha');
        let fecha = new Date(fechaInput.value);
        let dia = fecha.getDate().toString().padStart(2, '0');
        let mes = (fecha.getMonth() + 1).toString().padStart(2, '0'); // Corrección aquí
        let año = fecha.getFullYear();
        let fechaFormateada = `${dia}/${mes}/${año}`;


        // Crear el objeto de formulario con detallePagos
        form = {
            alumno_id: parseInt(document.getElementById('alumno_id').value, 10),
            folio: document.getElementById('folio').value,
            fecha: fechaFormateada,
            total: detallePagos.reduce((total, detalle) => total + detalle.importe, 0), // Calcular el total sumando todos los importes
            cantidad: detallePagos.reduce((total, detalle) => total + detalle.cantidad_subgrupo, 0), // Calcular la cantidad sumando todas las cantidades
            detallePagos: detallePagos // Aquí usamos detallePagos
        };

        console.log(form);
        try {
            const formData = new FormData(event.target);

            const response = await axios.post('/savePayment', form, {
                headers: {
                    'Content-Type': 'application/json',
                },
            });

            if (response.status === 200) {
                const reciboId = response.data.recibo_pago_id;
                window.location.href = `/payments/${reciboId}/pdf`;
            } else {
                alert('Error al enviar los datos');
            }
        } catch (error) {
            console.log(error);
        }


    }
</script>
@endpush