@extends('layouts.master')
@section('titulo', 'GRUPOS')
@section('contenido')
<style>
    .button-container {
        margin-left: 2%;
    }

    .custom-table {
        border-collapse: collapse;
        width: 100%;
    }

    .custom-table th,
    .custom-table td {
        border: 5px solid #000; 
        padding: 5px;
        font-family:'Arial Narrow';
        text-align: center;
    }

    .custom-table th {
        background-color: #bdecb6;
        font-family: 'Courier New';
        text-align: center;
    }

    .custom-table.table-bordered th,
    .custom-table.table-bordered td {
        border: 2px solid #000; 
    }

    .opciones{
        width: 150px;
    }

    .card{
        border-radius: 10px;
        
    }

    .shadow-effect {
        font-family: 'TIMES NEW ROMAN';
    }
</style>

<div class="card mt-4">
    <div class="card-body">
        <!-- Encabezado de la sección -->
        <h5 class="card-body text-center shadow-effect">CREAR GRUPOS</h5>
        
        <!-- Contenedor de botones para agregar grupo y navegar a subgrupos -->
        <div class="button-container d-flex justify-content-between align-items-center pr-4 mt-2">
            <!-- Botón para abrir el modal para agregar un nuevo grupo -->
            <a href="#" id="agregar-btn" class="btn btn-warning font-weight-bold " data-toggle="modal" data-target="#modalGrupo">
                <i class="fas fa-plus"></i> Agregar Grupo
            </a>
            <!-- Botón para ir a la lista de subgrupos -->
            <a href="/grupos_subgrupos" class="btn btn-warning font-weight-bold">          
                Ir a subgrupos  <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <!-- Tabla para mostrar la lista de grupos -->
        <div class="table-responsive mt-4">
            <table class="table table-bordered custom-table">
                <!-- Encabezados de la tabla -->
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>CLAVE</th>
                        <th>CONCEPTO</th>
                        <th class="opciones">ACCIONES</th>
                    </tr>
                </thead>
                <!-- Cuerpo de la tabla -->
                <tbody>
                    <!-- Bucle para mostrar cada grupo -->
                    @foreach($cgrupos as $row)
                    <tr>
                        <td class="align-middle text-center">{{$row->id}}</td>
                        <td class="align-middle text-center">{{$row->clave}}</td>
                        <td class="align-middle text-center">{{$row->concepto}}</td>
                        <td>
                            <!-- Botones para editar y eliminar cada grupo -->
                            <div class="d-inline-flex mt-2">
                                <a href="{{url('/nuevogrupo',[$row])}}" class="btn btn-primary mb-2 mx-2"><i class="fa-solid fa-pen-to-square"></i></a>

                                <form action="{{url('/nuevogrupo',[$row])}}" method="post" style="display: inline-block;">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger mx-2"><i class="fa-solid fa-trash-can"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modal para agregar un nuevo grupo -->
        <div class="modal fade" id="modalGrupo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #bdecb6;">
                        <h5 class="modal-title text-black" id="exampleModalLabel">Agregar Grupo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Formulario para agregar un nuevo grupo -->
                    <form  action="{{url('/nuevogrupo')}}" method="post">
                        @csrf
                        <div class="modal-body">
                            <!-- Campos para ingresar datos del nuevo grupo -->
                            <div class="form-group">
                                <input type="text" class="form-control" name="clave" placeholder="Clave del grupo">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="concepto" placeholder="Descripción del grupo">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!-- Botones para cancelar y guardar el nuevo grupo -->
                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-outline-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection