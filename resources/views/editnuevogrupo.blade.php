@extends('layouts.master')
@section('titulo', 'EDITANDO GRUPO') 
@section('contenido') 
<div class="card mt-4"> 
    <div class="card-body"> 
        <h5 class="card-body text-center">Editando Grupo</h5> 

        <!-- Formulario para editar el grupo -->
        <form action="{{url('/nuevogrupo',[$cgrupos])}}" method="post"> 
            @csrf 
            <!-- Método HTTP para actualizar los datos del grupo -->
            @method('PUT')   

            <div class="form-group"> 
                <input type="text" class="form-control" name="clave" placeholder="Clave del grupo" value="{{$cgrupos->clave}}">
            </div>

            <div class="form-group"> 
                <input type="text" class="form-control" name="concepto" placeholder="Descripción del grupo" value="{{$cgrupos->concepto}}">
            </div>

            <div class="row">
                <div class="d-gid col-2 mx-auto"> 
                    <button type="submit" class="btn btn-primary btn-block"><i class="fa-solid fa-floppy-disk"></i> Guardar</button> 
                </div>
            </div>
        </form>
    </div> 
</div> 
@endsection 
