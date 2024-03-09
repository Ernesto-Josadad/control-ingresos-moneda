@extends('layouts.master')
@section('titulo', 'GRUPOS Y SUBGRUPOS')
@section('contenido')

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar grupos y subgrupos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        .table-bordered {
            border: 2px solid #000000 !important; 
        }

        th,
        td {
            border: 2px solid #000000 !important; 
            text-align: center;
        }
        .wide-th {
        width: 200px; 
        }
        .wide-th2 {
        width: 800px; 
        }
        .agregar-btn{
        align-left: 60px;
        }
    </style>

</head>

<body>

<header class="bg-dark text-white text-center py-3">
    <h1 style="margin-bottom: -35px;">Subgrupos</h1>
    <div class="button-container d-flex justify-content-end align-items-center pr-4">
        <a href="/nuevogrupo" class="btn btn-warning font-weight-bold">
            CREAR NUEVO GRUPO
        </a>
    </div>
</header>
    <div class="container mt-4" style="display: block;">
        <table class="table table-bordered" id="tablaSubgrupos" >
            <tr class="btn-cell">
            <!-- En tu vista -->
<td id="1" style="background-color: #FF8C00; text-align: center; vertical-align: middle; padding-top: 10px;" class="text-center font-weight-bold">
    
</td>
<td id="2" style="background-color: #FF8C00; text-align: center; vertical-align: middle; padding-top: 10px;" class="text-center font-weight-bold">
    
</td>
  
                <td colspan="4" style="background-color: #FF8C00; text-align: center; vertical-align: middle;" id="codigoGrupoContainer">
    <div class="button-container d-flex justify-content-center align-items-center">
        <span id="textoGrupo" style="display: inline-block;" class="text-center font-weight-bold">
        </span>
        <div class="ml-auto mr-5"> <!-- Ajusta el valor de "mr-3" según sea necesario -->
            <button class="btn btn-warning font-weight-bold" data-toggle="modal"
                    data-target="#modalSubgrupo" id="agregarSubgrupoModalBtn">
                <i class="fas fa-plus"></i> Agregar Subgrupo
            </button>
        </div>
    </div>
</td>
<tr>
    
    <th style="background-color: #DCDCDC;" class="wide-th">Clave Grupo</th>
    <th style="background-color: #DCDCDC;" class="wide-th">Codigo</th>
    <th style="background-color: #DCDCDC;" class="wide-th2">Descripción</th>
    <th style="background-color: #DCDCDC;" class="wide-th">Costo</th>
    <th style="background-color: #DCDCDC;" class="wide-th">Acciones</th>
</tr>
<tbody>
        <tr>
        @foreach($csubgroup as $row)
        
        <td>{{$row->clave}}</td>
        <td>{{$row->codigo}}</td>
        <td>{{$row->descripcion}}</td>
        <td>{{$row->costo}}</td>
        <td>
        <a href="" class="btn btn-warning mb-2"><i class="fa-solid fa-pencil"></i></a>
        <button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
        </td>
        </tr>
    @endforeach
    </tbody>

    </table>
    </div>

    <!-- Modal para agregar subgrupo -->
    <div class="modal fade" id="modalSubgrupo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #bdecb6;">
                    <h5 class="modal-title text-black" id="exampleModalLabel">Agregar Subgrupo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{url('/grupos_subgrupos')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div id="formSubgrupo" class="form-group">
                            <input type="text" class="form-control" name="codigo"
                                placeholder="Clave del subgrupo">
                        </div>
                        <div id="formSubgrupo" class="form-group">
                            <input type="text" class="form-control" name="codigo"
                                placeholder="Clave del subgrupo">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="descripcion"
                                placeholder="Descripción del subgrupo">
                        </div>
                        <div class="form-group">
                            <input type="money" class="form-control" name="costo"
                                placeholder="Ingrese el costo">
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







     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script> 
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   

</body>

</html>

@endsection