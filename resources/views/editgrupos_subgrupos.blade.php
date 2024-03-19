@extends('layouts.master')
@section('titulo', 'EDITANDO SUBGRUPOS') 
@section('contenido') 
<div class="card mt-4"> 
    <div class="card-body"> 
        <h5 class="card-body text-center">Editando Subgrupo</h5> 
        <!-- Formulario para editar el subgrupo -->
        <form action="{{url('/grupos_subgrupos',[$csubgrupos])}}" method="post"> 
            @csrf 
            <!-- Método HTTP para actualizar los datos del subgrupo -->
            @method('PUT') 

            <div class="form-group"> 
                <select class="form-control" name="clave_grupo_id">
                    <option value="">Selecciona un grupo</option> 
                    @foreach ($grupos as $grupo) 
                    <option value="{{ $grupo->id }}" {{ $grupo->id == $csubgrupos->clave_grupo_id ? 'selected' : '' }}> 
                        {{ $grupo->concepto }} 
                    </option>
                    @endforeach 
                </select> 
            </div> 

            <div class="form-group"> 
                <input type="text" class="form-control" name="codigo" placeholder="Codigo del subgrupo" value="{{$csubgrupos->codigo}}"> 
            </div> 

            <div class="form-group"> 
                <input type="text" class="form-control" name="descripcion" placeholder="Descripción del subgrupo" value="{{$csubgrupos->descripcion}}"> 
            </div> 

            <div class="form-group"> 
                <input type="text" class="form-control" name="costo" placeholder="Costo del subgrupo" value="{{$csubgrupos->costo}}">
            </div> 

            <div class="row"> 
                <div class="d-gid col-2 mx-auto">
                    <button type="submit" class="btn btn-primary btn-block"><i class="fa-solid fa-floppy-disk"></i> Guardar</button> 
            </div> 
        </form> 
    </div> 
</div> 
</div>
@endsection 
