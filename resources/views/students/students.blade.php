@extends('layouts.master')
@section('titulo', 'ALUMNOS')
@section('contenido')
<div class="container-fluid mt-2">

    <div class="row">
        <div class="d-gid col-3 mx-auto">
            <button type="button" class="btn btn-dark btn-block" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fa-regular fa-square-plus"></i> Nuevo Alumno
            </button>
            <!-- boton de guardar -->
        </div>
    </div>

    <table class="table table-bordered table-striped table-reponsive mt-4">
        <thead>
            <th>#</th>
            <th>MATRICULA</th>
            <th>NOMBRE</th>
            <th>APELLIDO PATERNO</th>
            <th>APELLIDO MATERNO</th>
            <th>GRUPO</th>
            <th>GRADO</th>
            <th>CARRERA</th>
            <th>ACCIONES</th>
        </thead>
        <tbody>
            <tr>
                @foreach($students as $row)
                <!-- la primera variable es la que mande en el compat
            despues del as es el valor que se va a sustituir en la tabla -->
                <td>{{$row -> id}}</td>
                <td>{{$row -> matricula}}</td>
                <td>{{$row -> nombre}}</td>
                <td>{{$row -> apellido_paterno}}</td>
                <td>{{$row -> apellido_materno}}</td>
                <td>{{$row -> grado}}</td>
                <td>{{$row -> grupo}}</td>
                <td>{{$row -> carrera}}</td>
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{url('/students')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" placeholder="Matricula" class="form-control mt-2" name="matricula">
                            <input type="text" placeholder="Nombre" class="form-control mt-2" name="nombre">
                            <input type="text" placeholder="Apellido Paterno" class="form-control mt-2" name="apellido_paterno">
                            <input type="text" placeholder="Apellido Materno" class="form-control mt-2" name="apellido_materno">
                            <input type="text" placeholder="Grado" class="form-control mt-2" name="grado">
                            <input type="text" placeholder="Grupo" class="form-control mt-2" name="grupo">
                            <input type="text" placeholder="Carrea" class="form-control mt-2" name="carrera">
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- End Modal -->
</div>
@endsection