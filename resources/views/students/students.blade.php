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
                                        <th class="tabla-header align-middle text-center">#</th>
                                        <th class="tabla-header align-middle text-center">MATRICULA</th>
                                        <th class="tabla-header align-middle text-center">NOMBRES</th>
                                        <th class="tabla-header align-middle text-center">APELLIDO PATERNO</th>
                                        <th class="tabla-header align-middle text-center">APELLIDO MATERNO</th>
                                        <th class="tabla-header align-middle text-center">GRUPO</th>
                                        <th class="tabla-header align-middle text-center">GRADO</th>
                                        <th class="tabla-header align-middle text-center">CARRERA</th>
                                        <th class="tabla-header align-middle text-center">TURNO</th>
                                        <th class="tabla-header align-middle text-center">ACCIONES</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @foreach($students as $row)
                                            <!-- la primera variable es la que mande en el compat
            despues del as es el valor que se va a sustituir en la tabla -->
                                            <td class="tabla-header align-middle text-center">{{$row -> id}}</td>
                                            <td class="tabla-header align-middle text-center">{{$row -> matricula}}</td>
                                            <td class="tabla-header align-middle text-center">{{$row -> nombres}}</td>
                                            <td class="tabla-header align-middle text-center">{{$row -> apellido_paterno}}</td>
                                            <td class="tabla-header align-middle text-center">{{$row -> apellido_materno}}</td>
                                            <td class="tabla-header align-middle text-center">{{$row -> grado}}</td>
                                            <td class="tabla-header align-middle text-center">{{$row -> grupo}}</td>
                                            <td class="tabla-header align-middle text-center">{{$row -> carrera}}</td>
                                            <td class="tabla-header align-middle text-center">{{$row -> turno}}</td>
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
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Paginación -->
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-end">
        {{-- Botón Anterior --}}
        @if ($students->onFirstPage())
        <li class="page-item disabled">
            <span class="page-link">Anterior</span>
        </li>
        @else
        <li class="page-item">
            <a class="page-link" href="{{ $students->previousPageUrl() }}" tabindex="-1">Anterior</a>
        </li>
        @endif

        {{-- Números de Página --}}
        @if ($students->lastPage() > 1)
        @for ($i = max(1, $students->currentPage() - 1); $i <= min($students->lastPage(), $students->currentPage() + 1); $i++)
            <li class="page-item {{ $i == $students->currentPage() ? 'active' : '' }}">
                <a class="page-link" href="{{ $students->url($i) }}">{{ $i }}</a>
            </li>
            @endfor
            @endif

            {{-- Botón Siguiente --}}
            @if ($students->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $students->nextPageUrl() }}" tabindex="-1">Siguiente</a>
            </li>
            @else
            <li class="page-item disabled">
                <span class="page-link">Siguiente</span>
            </li>
            @endif
    </ul>
</nav>
<!-- End Paginación -->
@endsection