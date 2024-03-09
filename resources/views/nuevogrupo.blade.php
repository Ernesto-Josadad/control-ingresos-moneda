@extends('layouts.master')
@section('titulo', 'GRUPOS')
@section('contenido')

<div class="card mt-4">
    <div class="card-body">
        <h5 class="card-body text-center">CREAR GRUPOS</h5>
        <div class="button-container d-flex justify-content-end align-items-center pr-4">
        <a href="#" id="agregar-btn" class="btn btn-warning font-weight-bold" data-toggle="modal"
            data-target="#modalGrupo">
            <i class="fas fa-plus"></i> Agregar Grupo
        </a>
    </div>
    <div class="button-container d-flex align-items-center pr-4">
        <a href="/grupos_subgrupos" class="btn btn-warning font-weight-bold">
            REGRESAR A SUBGRUPOS
        </a>
    </div>
    <table class="tablet-bored table-stripet table-responsive mt-4">
        <thead>
            <th>#</th>
            <th>CLAVE</th>
            <th>CONCEPTO</th>
            <th>ACCIONES</th>
        </thead>
        <tbody>
            <tr>
            @foreach($cgrupos as $row)
            <td>{{$row->id}}</td>
            <td>{{$row->clave}}</td>
            <td>{{$row->concepto}}</td>
            <td></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal para agregar grupo -->
    <div class="modal fade" id="modalGrupo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #bdecb6;">
                    <h5 class="modal-title text-black" id="exampleModalLabel">Agregar Grupo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form  action="{{url('/nuevogrupo')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="clave" placeholder="Clave del grupo">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="concepto" placeholder="Descripción del grupo">
                        </div>
                    </div>
                    <div class="modal-footer">
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