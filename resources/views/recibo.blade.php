@extends('layouts.master')
@section('titulo', 'RECIBO ALUMNOS')
@section('contenido')
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="row mb-4 mt-4">
			<div class="col-md-12">

			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h5>
							<b style="margin-left: 10%;">Pagos </b>
						</h5>
						<button id="nuevo" class="btn btn-primary"><i class="fa fa-plus"></i>RECIBO </button>
					</div>
					<div class="card-body">
						<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="">Folio</th>
									<th class="">Nombre</th>
									<th class="">Apellido M</th>
									<th class="">Apellido P</th>
									<th class="">Monto Pagado</th>
									<th class="text-center">Acción</th>
								</tr>
							</thead>
              <tbody>
              <tr>
											<td class="text-center"></td>
											<td>
												<p></p>
											</td>
											<td>
												<p></p>
											</td>
											<td>
												<p></p>
											</td>
											<td>
												<p></p>
											</td>
											<td class="text-right">
												<p></p>
											</td>
											<td class="text-center">
												<button class="btn btn-primary view_payment" type="button"><i class="fa fa-eye"></i></button>
												<button class="btn btn-info edit_payment" type="button"><i class="fa fa-edit"></i></button>
												<button class="btn btn-danger delete_payment" type="button" ><i class="fa fa-trash-alt"></i></button>
											</td>
										</tr>
									<tr>
										<th class="text-center" colspan="7">Sin datos que mostrar.</th>
									</tr>

            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--MODAL DE EJEMPLO-->
<div id="modal1" class="modal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">RECIBO</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>	Ejemplo</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"> Cerrar</button>
				<button type="button" class="btn btn-primary">Guardar</button>

			</div>
		</div>
	</div>
</div>

@endsection