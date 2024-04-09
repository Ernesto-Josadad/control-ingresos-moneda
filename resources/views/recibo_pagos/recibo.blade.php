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
								<a href="/generar" type="button" class="d-sm-inline-block btn btn-primary shadow-sm">
									<i class="fa-regular fa-square-plus"></i> Nuevo recibo
								</a>
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
											<td>{{$row->fecha}}</td>
											<td>
												<a href="{{ route('payments.pdf', $row->id) }}" class="btn btn-primary"><i class="fa-solid fa-file"></i></a>
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