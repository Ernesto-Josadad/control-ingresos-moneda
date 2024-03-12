@extends('layouts.master')
@section('titulo', 'RECIBO ALUMNOS')
@section('contenido')
<style>
	.card-body {
		display: flex;
		justify-content: space-between;
	}

	.encabezados {
		padding-left: 10%;
		text-align: center;
		font-size: 15px;
	}

	.grid-container {
		display: grid;
		grid-template-columns: 1fr 1fr;
		grid-gap: 10px;
	}

	.grid-item {
		padding: 10px;
	}

	.form-row {
		display: flex;
		justify-content: space-between;
		/* Ajusta el espacio entre los elementos */
	}

	.form-group {
		flex: 1;
		/* Permite que los elementos se expandan para llenar el espacio disponible */
		margin-right: 10px;
		/* Espacio entre los elementos */
	}

	.form-group:last-child {
		margin-right: 0;
		/* Elimina el margen derecho del último elemento */
	}

	.container {
		width: 50%;
		/* Establece el ancho del contenedor al 30% */
		margin: 0 auto;
		/* Centra el contenedor horizontalmente */
	}

	.container2 {
		display: flex;
		justify-content: space-between;
		align-items: center;
	}
</style>
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="row mb-4 mt-4">
			<div class="col-md-12">
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header d-flex">
						<div style="flex-grow: 1;">
							<h5 class="mb-0" style="text-align: center;">
								<b>PAGOS REGISTRADOS</b>
							</h5>

							<!-- <div style="margin-left: 90%;">
								<a href="/generar" class="d-none d-sm-inline-block btn btn-primary shadow-sm">
									<i class="fa fa-plus-square" aria-hidden="true"></i></i>RECIBO
								</a>
							</div> -->
							<div style="margin-left: 80%;">
								<button type="button" class="d-sm-inline-block btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
									<i class="fa-regular fa-square-plus"></i> Nuevo Alumno
								</button>
							</div>
							<!-- Tabla para visualizar los datos de los recibos -->
							<div class="card-body">
								<table class="table table-reponsive table-striped">
									<thead>
										<th>#</th>
										<th>Folio</th>
										<th>Matricula</th>
										<th>Nombre</th>
										<th>Apellido P</th>
										<th>Apellido M</th>
										<th>Total</th>
										<th>Fecha</th>
										<th>Acciones</th>
									</thead>
									<tbody>
										<tr>
											@foreach($payment as $row)
											<td>{{$row->id}}</td>
											<td>{{$row->folio}}</td>
											<td>{{$row->matricula}}</td>
											<td>{{$row->nombres}}</td>
											<td>{{$row->apellido_paterno}}</td>
											<td>{{$row->apellido_materno}}</td>
											<td>${{$row->total}}</td>
											<td>${{$row->fecha}}</td>
											<td>

											</td>
										</tr>
										@endforeach

									</tbody>
								</table>
							</div>


							<!--  -->
						</div>
					</div>
					<div class="card-body">

					</div>


				</div>
			</div>
		</div>
		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="exampleModalLabel">AGREGAR ALUMNOS</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">

						<div class="form-group">
						<div class="col-md-6">
                            <input type="text" id="inputMatricula" class="form-control" placeholder="MATRICULA">
                        </div>
							<div class="col-md-6 mt-2 mt-md-0">
								<button class="btn btn-success btn-sm" id="btnActualizar">BUSCAR</button>
							</div>
							<input type="text" placeholder="Matricula" class="form-control mt-2" id="matricula">
							<input type="text" placeholder="Nombre" class="form-control mt-2" id="nombres">
							<input type="text" placeholder="Apellido Paterno" class="form-control mt-2" id="apellido_paterno">
							<input type="text" placeholder="Apellido Materno" class="form-control mt-2" id="apellido_materno">
							<input type="text" placeholder="Grado" class="form-control mt-2" id="grado">
							<input type="text" placeholder="Grupo" class="form-control mt-2" id="grupo">
							<input type="text" placeholder="Carrera" class="form-control mt-2" id="carrera">
							<input type="text" placeholder="Turno" class="form-control mt-2" id="turno">
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CERRAR</button>
						<button type="submit" class="btn btn-primary">GUARDAR</button>
					</div>
				</div>
			</div>
		</div>

		<!-- End Modal -->
	</div>
</div>
@push('scripts')
<script>
	document.addEventListener('DOMContentLoaded', function() {
		// Aquí dentro colocarías todas tus funciones y llamadas a funciones
		actualizarCampos();

	});

	function actualizarCampos() {
		document.getElementById('btnActualizar').addEventListener('click', function() {
			var matriculaAlumno = document.getElementById('inputAlumno').value; // Obtener la matrícula del alumno
			var alumnos = @json($student);

			var alumnoSeleccionado = alumnos.find(function(alumno) {
				return alumno.matricula == matriculaAlumno; // Comparar por matrícula en lugar de ID
			});

			document.getElementById('nombres').value = alumnoSeleccionado.nombres;
			document.getElementById('matricula').value = alumnoSeleccionado.matricula;
			document.getElementById('apellido_paterno').value = alumnoSeleccionado.apellido_paterno;
			document.getElementById('apellido_materno').value = alumnoSeleccionado.apellido_materno;
			document.getElementById('grado').value = alumnoSeleccionado.grado;
			document.getElementById('grupo').value = alumnoSeleccionado.grupo;
			document.getElementById('turno').value = alumnoSeleccionado.turno;
		});
	}
</script>

@endpush
@endsection