@extends('layouts.master')
@section('titulo', 'ALUMNOS')
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
                    <div class="card-header d-flex">
                        <div style="flex-grow: 1;">
                            <h5 class="mb-0" style="text-align: center;">
                                <b>ALUMNOS</b>
                            </h5>
                            <div style="margin-left: 80%;">
                                <button type="button" class="d-sm-inline-block btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fa-regular fa-square-plus"></i> Nuevo Alumno
                                </button>
                            </div>

                            <!--  -->
                            <div class="card-body">
                                <table class="table table-bordered table-striped table-reponsive mt-4">
                                    <thead>
                                        <th>#</th>
                                        <th>MATRICULA</th>
                                        <th>NOMBRES</th>
                                        <th>APELLIDO PATERNO</th>
                                        <th>APELLIDO MATERNO</th>
                                        <th>GRUPO</th>
                                        <th>GRADO</th>
                                        <th>CARRERA</th>
                                        <th>TURNO</th>
                                        <th>ACCIONES</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @foreach($students as $row)
                                            <!-- la primera variable es la que mande en el compat
            despues del as es el valor que se va a sustituir en la tabla -->
                                            <td>{{$row -> id}}</td>
                                            <td>{{$row -> matricula}}</td>
                                            <td>{{$row -> nombres}}</td>
                                            <td>{{$row -> apellido_paterno}}</td>
                                            <td>{{$row -> apellido_materno}}</td>
                                            <td>{{$row -> grado}}</td>
                                            <td>{{$row -> grupo}}</td>
                                            <td>{{$row -> carrera}}</td>
                                            <td>{{$row -> turno}}</td>
                                            <td>

                                                <a href="{{url('/students',[$row])}}" class="btn btn-warning mb-2"><i class="fa-solid fa-pencil"></i></a>
                                                <!-- lo que hara es tomar la ruta y pasarle un parametro, al estar dentro del $row lo que hara es 
                         pasar el ID como le indicamos en el controlador -->

                                                <form action="{{url('/students',[$row])}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                                    <!-- al igual que el boton de editar solo que este va dentro de un formulario con el método delete
                         asi el controlador sabra cual es el ID del registro en específico -->
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>


                            <!--  -->
                            <!-- Modal -->
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">AGREGAR ALUMNOS</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{url('/students')}}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <input type="text" placeholder="Matricula" class="form-control mt-2" name="matricula">
                                                    <input type="text" placeholder="Nombre" class="form-control mt-2" name="nombres">
                                                    <input type="text" placeholder="Apellido Paterno" class="form-control mt-2" name="apellido_paterno">
                                                    <input type="text" placeholder="Apellido Materno" class="form-control mt-2" name="apellido_materno">
                                                    <input type="text" placeholder="Grado" class="form-control mt-2" name="grado">
                                                    <input type="text" placeholder="Grupo" class="form-control mt-2" name="grupo">
                                                    <input type="text" placeholder="Carrera" class="form-control mt-2" name="carrera">
                                                    <input type="text" placeholder="Turno" class="form-control mt-2" name="turno">
                                                </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CERRAR</button>
                                            <button type="submit" class="btn btn-primary">GUARDAR</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- End Modal -->
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