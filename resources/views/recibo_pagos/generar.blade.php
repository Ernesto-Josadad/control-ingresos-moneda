@extends('layouts.master')
@section('titulo', 'generar_pagos')
@section('contenido')
<style>

</style>
<div class="card mt-4">
    <div class="card-body">
        <h5 class="card-body text-center">RECIBO COBROS</h5>
        <div class="grid-item">
            <div class="grid item">
                <div class="col-md-6" style="width: 30%;">
                    <label for="matricula">Recibí de:</label>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" id="inputMatricula" class="form-control" placeholder="MATRICULA">
                        </div>
                        <div class="col-md-6 mt-2 mt-md-0">
                            <button class="btn btn-success btn-sm" id="btnActualizar">BUSCAR</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group" style="margin-left:80%">
                <input type="text" class="form-control" name="folio" placeholder="FOLIO">
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

        <div class="card-body">
            <div class="footer">
                <a href="/payment" type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</a>
                <button type="submit" class="btn btn-primary">GUARDAR</button>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection
@push('scripts')
<script>
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
</script>
@endpush