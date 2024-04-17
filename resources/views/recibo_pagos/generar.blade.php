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
            <div class="grid-item">
                <div class="grid item">
                    <div class="col-md-6 mt-2" style="width: 30%;">
                        <a href="/payment" class="btn btn-warning font-weight-bold">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <label for="matricula">Recibí de:</label>
                        <br>
                        <div class="row">

                            <div class="col-md-6">
                                <input type="text" id="inputMatricula" class="form-control" placeholder="MATRICULA" oninput="this.value = this.value.toUpperCase()">
                            </div>
                            <div class="col-md-6 mt-2 mt-md-0">
                                <button class="btn btn-success btn-sm" id="btnActualizar">BUSCAR</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group" style="margin-left:80%">
                    <div class="col-md-6 mt-2 mt-md-0">
                        <button type="submit" class="btn btn-warning btn-sm" id="btnFolio">FOLIO</button>
                    </div>

                    <label id="folio"></label>
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
                            <input type="text" id="inputCode" class="form-control" placeholder="CLAVE SUBGRUPO" oninput="this.value = this.value.toUpperCase()">
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
                                <th>#</th>
                                <th>Cantidad</th>
                                <th>Clave</th>
                                <th>Concepto</th>
                                <th>Cuota</th>
                                <th>Importe</th>
                                <th>Acciones</th>
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

            <div class="footer d-flex justify-content-between" >
                <button type="button" class="btn btn-warning" id="btnRecargarPagina">Limpiar</button>

            <div class="footer d-flex justify-content-between"> <!-- Utilizamos flexbox y justify-content-between para alinear los botones -->
                <button type="button" class="btn btn-warning" id="btnRecargarPagina">Limpiar</button> <!-- Nuevo botón para recargar la página -->

                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </div>

    </form>
</div>


@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>


    document.addEventListener('DOMContentLoaded', function() {
        // Aquí dentro colocarías todas tus funciones y llamadas a funciones
        actualizarCampos();
        addNewRowTableSubGroup();
        traerFolio();

    });

    function actualizarCampos() {
        document.getElementById('btnActualizar').addEventListener('click', function() {
            var matriculaAlumno = document.getElementById('inputMatricula').value; // Obtener la matrícula del alumno
            console.log(matriculaAlumno);
            var alumnos = @json($students);

            var alumnoSeleccionado = alumnos.find(function(alumno) {
                return alumno.matricula == matriculaAlumno; // Comparar por matrícula en lugar de ID
            });

            // Verificar si se encontró un alumno con la matrícula proporcionada
            if (alumnoSeleccionado) {
                // Si se encontró el alumno, actualizar los campos del formulario
                document.getElementById('alumno_id').value = alumnoSeleccionado.id;
                document.getElementById('nombres').value = alumnoSeleccionado.nombres;
                document.getElementById('matricula').value = alumnoSeleccionado.matricula;
                document.getElementById('apellido_paterno').value = alumnoSeleccionado.apellido_paterno;
                document.getElementById('apellido_materno').value = alumnoSeleccionado.apellido_materno;
                document.getElementById('grado').value = alumnoSeleccionado.grado;
                document.getElementById('grupo').value = alumnoSeleccionado.grupo;
                document.getElementById('carrera').value = alumnoSeleccionado.carrera;
                document.getElementById('turno').value = alumnoSeleccionado.turno;
            } else {
                // Si no se encontró un alumno con la matrícula proporcionada, mostrar una alerta
                alert('Matrícula no existente');
            }
        });

    }

    document.getElementById('btnFolio').addEventListener('click', async () => {
        try {
            let response = await axios.get('/ultimoFolio');
            if (response && !isNaN(response.data)) { // Verifica si el valor es un número válido
                const ultimoFolio = parseInt(response.data) + 1; // Parsea el valor a entero antes de sumarle 1
                console.log('folio: ', response.data);
                var folioLabel = document.getElementById('folio');
                folioLabel.textContent = `${ultimoFolio}`;
                console.log('folio: ', folioLabel);
                document.getElementById('folio').value = ultimoFolio;
            } else {
                console.error('No se recibió un número válido del servidor.');
            }
        } catch (error) {
            console.error('Error al obtener el último folio:', error);
        }
    });

    function addNewRowTableSubGroup() {
        document.getElementById('btnAddNewRow').addEventListener('click', function() {
            var codigoSubGrupo = document.getElementById('inputCode').value;
            var subGrupos = @json($subGroups);
            var subGrupoSeleccionado = subGrupos.find(function(subGrupo) {
                return subGrupo.codigo == codigoSubGrupo;
            });

            if (subGrupoSeleccionado) {
                let cantidadInput = document.createElement("input");
                cantidadInput.value = 1;

                var newRow = document.getElementById('subGroupTable').getElementsByTagName('tbody')[0].insertRow();
                var cellIdGrupo = newRow.insertCell(0);
                var cellCantidad = newRow.insertCell(1);
                var cellCodigo = newRow.insertCell(2);
                var cellDescripcion = newRow.insertCell(3);
                var cellCosto = newRow.insertCell(4);
                var cellImporte = newRow.insertCell(5);

                let cantidad = cantidadInput.value;
                let costo = subGrupoSeleccionado.costo;
                let importe = cantidad * costo;

                cellIdGrupo.innerHTML = subGrupoSeleccionado.id;
                cellCantidad.appendChild(cantidadInput);
                cellCodigo.innerHTML = subGrupoSeleccionado.codigo;
                cellDescripcion.innerHTML = subGrupoSeleccionado.descripcion;
                cellCosto.innerHTML = subGrupoSeleccionado.costo;
                cellImporte.textContent = importe;
                document.getElementById('claveSubgrupoId').value = subGrupoSeleccionado.id;

                cantidadInput.addEventListener("change", function() {
                    let cantidad = cantidadInput.value;
                    let costo = subGrupoSeleccionado.costo;
                    let importe = cantidad * costo;
                    cellImporte.textContent = importe;
                });

                // Agregar botón de edición de costo (cuota)
                var editButton = document.createElement('button');
                editButton.textContent = 'Editar';
                editButton.classList.add('btn', 'btn-primary', 'btn-sm', 'mr-2');
                editButton.addEventListener('click', function() {
                    var newCost = prompt('Ingrese el nuevo costo:');
                    if (newCost !== null) {
                        subGrupoSeleccionado.costo = parseFloat(newCost);
                        cellCosto.textContent = newCost;
                        // Actualizar el importe de la fila
                        importe = cantidad * parseFloat(newCost);
                        cellImporte.textContent = importe;
                    }

                });
                newRow.appendChild(editButton);

                // Agregar botón de eliminación de fila
                var deleteButton = document.createElement('button');
                deleteButton.textContent = '';
                // Crear un elemento <i> para el icono de "x"
                let icon = document.createElement('i');
                icon.classList.add('fas', 'fa-times'); // Agregar las clases de Font Awesome para el icono de "x"

                // Agregar el icono como hijo del botón
                deleteButton.appendChild(icon);
                deleteButton.classList.add('btn', 'btn-danger', 'btn-sm');
                deleteButton.addEventListener('click', function() {
                    newRow.remove(); // Eliminar la fila actual
                });
                newRow.appendChild(deleteButton);
            } else {
                // Si no se encontró un alumno con la clave del subgrupo proporcionada, mostrar una alerta
                alert('El subgrupo no existe, verifique sus datos');
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
                let importeString = cells[5].textContent;
                let importe = parseFloat(importeString, 10);
                let cantidadSubgrupo = cells[1].querySelector('input');
                let cantidad = parseInt(cantidadSubgrupo.value, 10);
                let grupoId = cells[0].textContent;
                let folioString = document.getElementById('folio').value

                // Crear un objeto con los datos del detalle de pago y agregarlo al array
                let detallePago = {
                    folio: parseInt(folioString, 10),
                    clave_subgrupo_id: parseInt(grupoId, 10),
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

    document.getElementById('btnRecargarPagina').addEventListener('click', function() {
        // Redirecciona a la misma página para recargarla y limpiar los cambios
        window.location.reload();
    });
</script>
@endpush
