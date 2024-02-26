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
								<b>RECIBO OFICIAL DE COBRO</b>
							</h5>
							<div>
								<a href="#" class="d-none d-sm-inline-block btn btn-primary shadow-sm" data-toggle="modal" data-target="#modalRecibo">
									<i class="fa fa-plus-square" aria-hidden="true"></i></i>RECIBO
								</a>
							</div>
							@if($message = Session::get('Correcto'))
							<div class="col-12 alert alert-success alert-dismissable fade show" role="alert">
								<h5>LISTO</h5>
								<ul>
									@foreach($errors->all() as $error)
									<li>{{$message}}</li>
									@endforeach
								</ul>

							</div>
							@endif
							<div class="row">
								@if($message = Session::get('ErrorInsert'))
								<div class="col-12 alert alert-danger alert-dismissable fade show" role="alert">
									<h5> ERRORES : </h5>
									<ul>
										@foreach($errors->all() as $error)
										<li>{{$error}}</li>
										@endforeach
									</ul>

								</div>
								@endif
							</div>
							<!-- Modal -->
							<div class="modal fade" id="modalRecibo" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
								<div class="modal-dialog modal-xl">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="staticBackdropLabel">RECIBO OFICIAL DE COBRO</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form action="/recibo" method="post">
											@csrf
											<div class="modal-body">
												<div class="grid-container">
													<div class="grid-item">
														<div class="form-group">
															<input type="text" class="form-control" name="folio" placeholder="FOLIO">
														</div>
													</div>
													<div class="grid-item">
														<div class="form-group">
															<input type="text" class="form-control" name="ur" placeholder="UR">
														</div>
													</div>
													<div class="grid-item">
														<div class="form-group">
															<input type="text" class="form-control" name="num_recibo" placeholder="NUMERO RECIBO">
														</div>
													</div>
													<div class="grid-item">
														<div class="form-group">
															<input type="text" class="form-control" name="entidad_federativa" placeholder="ENTIDAD FEDERATIVA">
														</div>
													</div>
												</div>
												<div>
													<hr>

													<div class="container">
														<div class="row justify-content-center">
															<div class="col-6">
																<div class="form-group">
																	<label style="text-align: center;">RECIBI DE: </label>
																	<input type="text" class="form-control" name="matricula" placeholder="MATRICULA">
																</div>
															</div>
														</div>
													</div>

													<div class="form-row">
														<div class="form-group col">
															<input type="text" class="form-control" name="apellido_paterno" placeholder="APELLIDO PATERNO">
														</div>
														<div class="form-group col">
															<input type="text" class="form-control" name="apellido_materno" placeholder="APELLIDO MATERNO">
														</div>
														<div class="form-group col">
															<input type="text" class="form-control" name="nombre" placeholder="NOMBRE (S)">
														</div>
													</div>

													<div class="container">
														<div class="row align-items-center">
															<div class="form-group col-auto"> <!-- Utilizamos col-auto para que este div ocupe solo el espacio necesario -->
																<div>CONOCIDO</div>
															</div>
															<div class="form-group col">
																<input type="text" class="form-control" name="grado" placeholder="GRADO">
															</div>
															<div class="form-group col">
																<input type="text" class="form-control" name="grupo" placeholder="GRUPO">
															</div>
															<div class="form-group col">
																<input type="text" class="form-control" name="turno" placeholder="TURNO">
															</div>
														</div>
													</div>
													<div class="container1">
														<div class="row1">
															<div class="col">
																<div class="d-flex">
																	<div class="form-group">
																		<input type="text" class="form-control" name="total" placeholder="TOTAL">
																	</div>
																	<div class="form-group">
																		<input type="text" class="form-control" name="total_letras" placeholder="TOTAL EN LETRAS">
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="my-2">
														<table class="table">
															<thead>
																<tr>
																	<th scope="col"><label for="cantidad">CANTIDAD</label></th>
																	<th scope="col"><label for="clave_padre">CLAVE</label></th>
																	<th scope="col"><label for="concepto">CONCEPTO</label></th>
																	<th scope="col"><label for="costo">CUOTA</label></th>
																	<th scope="col"><label for="total">IMPORTE</label></th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td><input type="text" class="form-control" id="cantidad" name="cantidad"></td>
																	<td><select name="clave_padre" id="clave_hijo">
																			<option value="selecciona">SELECCIONA UNA CLAVE</option>
																			<option value="A003">A003</option>
																			<option value="B002">B002</option>
																			<option value="B003">B003</option>
																		</select></td>
																	<td><input type="text" class="form-control" id="concepto" name="concepto"></td>
																	<td><input type="text" class="form-control" id="cuota" name="cuota"></td>
																	<td><input type="text" class="form-control" id="importe" name="importe"></td>
																</tr>
																<tr>
																	<td><input type="text" class="form-control" id="cantidad" name="cantidad"></td>
																	<td><select name="clave_padre" id="clave_hijo">
																			<option value="selecciona">SELECCIONA UNA CLAVE</option>
																			<option value="A003">A003</option>
																			<option value="B002">B002</option>
																			<option value="B003">B003</option>
																		</select></td>
																	<td><input type="text" class="form-control" id="concepto" name="concepto"></td>
																	<td><input type="text" class="form-control" id="cuota" name="cuota"></td>
																	<td><input type="text" class="form-control" id="importe" name="importe"></td>
																</tr>
																<tr>
																	<td><input type="text" class="form-control" id="cantidad" name="cantidad"></td>
																	<td><select name="clave_padre" id="clave_hijo">
																			<option value="selecciona">SELECCIONA UNA CLAVE</option>
																			<option value="A003">A003</option>
																			<option value="B002">B002</option>
																			<option value="B003">B003</option>
																		</select></td>
																	<td><input type="text" class="form-control" id="concepto" name="concepto"></td>
																	<td><input type="text" class="form-control" id="cuota" name="cuota"></td>
																	<td><input type="text" class="form-control" id="importe" name="importe"></td>
																</tr>
															</tbody>
															<tbody>
																<tr>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td><label for="total">TOTAL</label></td>
																	<td>
																		<input type="text" class="form-control" id="total" name="total">
																	</td>
																</tr>
															</tbody>
														</table>
													</div>



												</div>

											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
												<button type="submit" class="btn btn-primary">GUARDAR</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body">

					</div>


				</div>
			</div>
		</div>
	</div>
</div>


@endsection