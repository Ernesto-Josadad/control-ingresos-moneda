@extends('layouts.master')
@section('titulo', 'ALUMNOS')
@section('contenido')
<div class="card mt-4">
    <div class="card-body">
        <h5 class="card-body text-center">Editando Alumno</h5>
        <form action="{{url('/students',[$student])}}" method="post">
            <!-- una vez aue encuentra el registro lo que hace es traer la variable que mandamos
                en el compact para poder usarla en la vista para mostrar sus datos -->
            @csrf
            @method('PUT')
            <!-- El method put es para actualizar el registro -->
            <div class="form-group">
                <input type="text" placeholder="Matricula" class="form-control mt-2" name="matricula" value="{{$student->matricula}}" oninput="this.value = this.value.toUpperCase()" required>
                <!-- Todo los input deveran de tener la propiedad value dentro de ella la variable como se muestra -->
                <input type="text" placeholder="Nombres" class="form-control mt-2" name="nombres" value="{{$student->nombres}}" oninput="this.value = this.value.toUpperCase()" required>
                <input type="text" placeholder="Apellido Paterno" class="form-control mt-2" name="apellido_paterno" value="{{$student->apellido_paterno}}" oninput="this.value = this.value.toUpperCase()" required>
                <input type="text" placeholder="Apellido Materno" class="form-control mt-2" name="apellido_materno" value="{{$student->apellido_materno}}" oninput="this.value = this.value.toUpperCase()" required>
                <input type="number" placeholder="Grado" class="form-control mt-2" name="grado" value="{{$student->grado}}" oninput="this.value = this.value.toUpperCase()" required>
                <input type="text" placeholder="Grupo" class="form-control mt-2" name="grupo" value="{{$student->grupo}}" oninput="this.value = this.value.toUpperCase()" required>
                <input type="text" placeholder="Carrera" class="form-control mt-2" name="carrera" value="{{$student->carrera}}" oninput="this.value = this.value.toUpperCase()" required>
                <select class="form-control mt-2" name="turno" value="{{$student->turno}}">
                    <option value="MATUTINO">MATUTINO</option>
                    <option value="VESPERTINO">VESPERTINO</option>
                </select>
            </div>
            <div class="row">
                <div class="d-gid col-3 mx-auto">
                    <button type="submit" class="btn btn-primary btn-block"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
                </div>
                <div>

                </div>
            </div>
        </form>
    </div>
</div>
@endsection