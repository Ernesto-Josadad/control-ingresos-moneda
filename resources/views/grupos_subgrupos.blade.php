@extends('layouts.master')
@section('titulo', 'SUBGRUPOS')
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
        font-family: 'Arial Narrow';
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

    .opciones {
        width: 130px;
    }

    .card {
        border-radius: 10px;

    }

    .shadow-effect {

        font-family: 'TIMES NEW ROMAN';
    }
</style>

<div class="card mt-4">
    <div class="card-body">
        <!-- Encabezado de la sección -->
        <h5 class="card-body text-center shadow-effect">CREAR SUBGRUPOS</h5>

        <!-- Contenedor de botones para regresar y agregar subgrupos -->
        <div class="button-container d-flex justify-content-between align-items-center pr-4 mt-2">
            <!-- Botón para regresar a la lista de grupos -->
            <a href="/nuevogrupo" class="btn btn-warning font-weight-bold">
                <i class="fas fa-arrow-left"></i> Regresar a grupos
            </a>
            <!-- Botón para abrir el modal para agregar un nuevo subgrupo -->
            <a href="#" id="agregar-btn" class="btn btn-warning font-weight-bold " data-toggle="modal" data-target="#modalSubgrupo">
                <i class="fas fa-plus"></i> Agregar Subgrupo
            </a>
        </div>

        <!-- Tabla para mostrar la lista de subgrupos -->
        <div class="table-responsive mt-4">
            <table class="table table-bordered custom-table">
                <!-- Encabezados de la tabla -->
                <thead>
                    <tr>
                        <th>ID</th>
                        <th class="opciones">GRUPO</th>
                        <th class="opciones">CODIGO</th>
                        <th>DESCRIPCIÓN</th>
                        <th class="opciones">COSTO</th>
                        <th class="opciones">ACCIONES</th>
                    </tr>
                </thead>
                <!-- Cuerpo de la tabla -->
                <tbody>
                    <!-- Bucle para mostrar cada subgrupo -->
                    @foreach($csubgrupos as $row)
                    <tr>
                        <td class="align-middle text-center">{{$row->id}}</td>
                        <td class="align-middle text-center">
                            @php
                            $grupo = App\Models\Grupos::find($row->clave_grupo_id);
                            @endphp
                            @if ($grupo)
                            {{$grupo->concepto}}
                            @endif
                        </td>

                        <td class="align-middle text-center">{{$row->codigo}}</td>
                        <td class="align-middle text-center">{{$row->descripcion}}</td>
                        <td class="align-middle text-center">$ {{$row->costo}}</td>
                        <td>
                            <!-- Botones para editar y eliminar cada subgrupo -->
                            <div class="d-inline-flex mt-2">
                                <a href="{{url('/grupos_subgrupos',[$row])}}" class="btn btn-primary mb-2 mx-2"><i class="fa-solid fa-pen-to-square"></i></a>

                                <form action="{{url('/grupos_subgrupos',[$row])}}" method="post" style="display: inline-block;">
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

        <!-- Modal para agregar un nuevo subgrupo -->
        <div class="modal fade" id="modalSubgrupo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #bdecb6;">
                        <h5 class="modal-title text-black" id="exampleModalLabel">Agregar Subgrupo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Formulario para agregar un nuevo subgrupo -->
                    <form action="{{url('/grupos_subgrupos')}}" method="post">
                        @csrf
                        <div class="modal-body">
                            <!-- Campos para ingresar datos del nuevo subgrupo -->
                            <div class="form-group">
                                <select class="form-control" name="clave_grupo_id">
                                    <option value="">Selecciona un grupo</option>
                                    @foreach ($grupos as $grupo)
                                    <option value="{{ $grupo->id }}">{{ $grupo->concepto}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="codigo" placeholder="Codigo del subgrupo">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="descripcion" placeholder="Descripción del subgrupo">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="costo" placeholder="Costo del subgrupo">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!-- Botones para cancelar y guardar el nuevo subgrupo -->
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