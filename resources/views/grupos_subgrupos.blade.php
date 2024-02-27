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
        .color {
            background-color: #FF8C00; 
        }

        .table-bordered {
            border: 3px solid #000000 !important; 
        }

        th,
        td {
            border: 3px solid #000000 !important; 
            text-align: center;
        }

        th{
            background-color: #DCDCDC;
        }
        
    </style>

</head>

<body>

<header class="bg-dark text-white text-center py-3">
    <h1 style="margin-bottom: -35px;">Grupos/Subgrupos</h1>
    <div class="button-container d-flex justify-content-end align-items-center pr-4">
        <a href="#" id="agregar-btn" class="btn btn-warning font-weight-bold" data-toggle="modal"
            data-target="#modalGrupo">
            <i class="fas fa-plus"></i> Agregar Grupo
        </a>
    </div>
</header>


    <!-- Modal para agregar grupo -->
    <div class="modal fade" id="modalGrupo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Grupo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formGrupo" action="/grupos_subgrupos" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="clavegrupo" placeholder="Clave del grupo">
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

    <div class="container mt-4">
        <table class="table table-bordered" id="tablaSubgrupos" style="width: 100%">
            <tr class="btn-cell">
                <td colspan="4" class="color">
                    <div class="button-container d-flex justify-content-end align-items-center">
                        <span id="textoGrupo"></span>
                        <button class="btn btn-warning ml-2 font-weight-bold" data-toggle="modal"
                            data-target="#modalSubgrupo" id="agregarSubgrupoModalBtn">
                            <i class="fas fa-plus"></i> Agregar Subgrupo
                        </button>
                    </div>
                </td>
            </tr>
            <tr>
                <th>CLAVE</th>
                <th>DESCRIPCIÓN</th>
                <th>COSTO</th>
                <th>ACCIONES</th>
            </tr>
        </table>
    </div>

    <!-- Modal para agregar subgrupo -->
    <div class="modal fade" id="modalSubgrupo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Subgrupo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('subgrupos.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div id="formSubgrupo" class="form-group">
                            <input type="text" class="form-control" name="clavesubgrupo"
                                placeholder="Clave del subgrupo">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="descripcionsubgrupo"
                                placeholder="Descripción del subgrupo">
                        </div>
                        <div class="form-group">
                            <input type="money" class="form-control" name="costosubgrupo"
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

    <!-- Bootstrap JS y Popper.js (asegúrate de incluirlos en el orden correcto) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>

@endsection