@extends('layouts.master')
@section('titulo', 'ALUMNOS')
@section('contenido')
    <div class="modal fade" id="modal-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog"><!-- Log on to codeastro.com for more projects! -->
            <div class="modal-content">
                <form id="form-item" method="post" class="form-horizontal" data-toggle="validator"
                    enctype="multipart/form-data">
                    {{ csrf_field() }} {{ method_field('POST') }}

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h3 class="modal-title"></h3>
                    </div>


                    <div class="modal-body">
                        <input type="hidden" id="id" name="id">


                        <div class="box-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" id="nama" name="nama" autofocus required>
                                <span class="help-block with-errors"></span>
                            </div>

                            <div class="form-group">
                                <label>Price</label>
                                <input type="text" class="form-control" id="harga" name="harga" required>
                                <span class="help-block with-errors"></span>
                            </div>

                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="text" class="form-control" id="qty" name="qty" required>
                                <span class="help-block with-errors"></span>
                            </div>


                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                                <span class="help-block with-errors"></span>
                            </div>

                            <div class="form-group">
                                <label>Category</label>

                                <span class="help-block with-errors"></span>
                            </div>




                        </div>
                        <!-- /.box-body -->

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>

                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div><!-- Log on to codeastro.com for more projects! -->
    <!-- /.modal -->


    <div class="box box-success">

        <div class="box-header" style="display: flex; background-color:grey; wi">
            <h3 class="box-title">Lista de Alumnos</h3>

            <a onclick="addForm()" class="btn pull-right"
                style="margin-top: 8px; margin-left:900px; background-color:#FF977A;"><i class="fa fa-plus"></i> Agregar
                alumnos</a>
        </div>
        <br>
        <div class="box-header" style="display: flex;">


            <p class="pull-right" style="margin-top: 8px; margin-left:900px;">Búsqueda <input type="text"></p>
        </div>


        <!-- /.box-header -->
        <div class="box-body" style="background-color: white;">
            <table id="products-table" class="table table-bordered table-hover table-striped">
                <thead style="background-color: #FF977A;">
                    <tr>
                        <th>#</th>
                        <th>MATRICULA</th>
                        <th>APELLIDO P.</th>
                        <th>APELLIDO M.</th>
                        <th>NOMBRE</th>
                        <th>GRADO</th>
                        <th>GRUPO</th>
                        <th>CARRERA</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>

@endsection
