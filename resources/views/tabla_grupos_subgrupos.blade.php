@extends('layouts.master')
@section('titulo', 'TABLA GRUPOS Y SUBGRUPOS')
@section('contenido')

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

   <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: #8c8c8c;
            padding: 1em;
            text-align: center;
            height: 90px; 
        }

        .navbar a {
            color: white;
            text-decoration: none;
            font-size: 1.5em;
        }

        .search-container {
            display: flex;
            align-items: center;
            background-color: #FFFF;
            padding: 0.3em;
            border-radius: 20px; 
            width: 79%;
            margin: 0 auto; 
        }

        .search-text {
            font-size: 1em;
            margin-right: 0.5em; 
            font-weight: bold; 
            color: black;
        }

        .search-input {
            flex: 2;
            border: none;io 
            border-radius: 12px;
            padding: 0.1em; 
            margin-left: 0.5em; 
            width: 100%; 
        }

        .search-icon {
            font-size: 1.1em;
            color: black;
           
        }

        .btn-buscar-container {
            display: inline-block;
            margin-left: 10px; 
        }

        .btn-buscar {
            background-color: #ffc107;
            color: #212529;
            border: none;
            padding: 0.4em 1em;
            border-radius: 20px; 
            cursor: pointer;
            font-weight: bold; 
        }

        .container {
            margin-top: 2em;
            text-align: center;
            background-color: #ae9c8f; 
            padding: 20px; 
            border-radius: 15px; 
            overflow: hidden; 
        }

        th.tabla-header {
            font-family: 'Courier New';
            font-size: 15px;
            color: black;
            font-weight: bold;
            text-align: center;
            background-color: #ff9800;
            padding: 10px;
            
        }
        td.table-font{
            font-family:'Arial Narrow';
            font-size: 15px;
        }

        .table-bordered, .table-bordered th, .table-bordered td,
        .table-bordered thead th, .table-bordered tbody + tbody {
            border-color: black;
            border-width: 2px; 
        }
    </style>

</head>
<body>

<!-- Barra de navegación con barra de búsqueda -->
<div class="navbar">
    <span class="search-text">Búsqueda:</span>
    <div class="search-container">
        <input class="search-input" type="search" placeholder="Buscar" aria-label="Search">
        &nbsp;
        <i class="fas fa-search search-icon"></i>
    </div>
    <div class="btn-buscar-container">
        <button class="btn-buscar" type="submit">Buscar</button>
    </div>
</div>

<!-- Contenido de la página con tabla responsiva -->
<div class="container">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="tabla-header" scope="col">NUMERO</th>
                    <th class="tabla-header" scope="col">FECHA</th>
                    <th class="tabla-header" scope="col">No. DE CONTROL</th>
                    <th class="tabla-header" scope="col">NOMBRE</th>
                    <th class="tabla-header" scope="col">APELLIDO P</th>
                    <th class="tabla-header" scope="col">APELLIDO M</th>
                    <th class="tabla-header" scope="col">GRADO</th>
                    <th class="tabla-header" scope="col">GRUPO</th>
                    <th class="tabla-header" scope="col">CARRERA</th>
                    <th class="tabla-header" scope="col">DESCRIPCIÓN</th>
                    <th class="tabla-header" scope="col">CONCEPTO</th>
                    <th class="tabla-header" scope="col">IMPORTE</th>
                    <th class="tabla-header" scope="col">IMPORTE CON LETRAS</th>
                    <th class="tabla-header" scope="col">CANTIDAD</th>
                    <th class="tabla-header" scope="col">NUMERO DE ROC</th>
                </tr>
            </thead>
            <tbody>
                <!-- Agrega filas de datos aquí -->
                <tr>
                    <td class="table-font">Dato 1</td>
                    <td class="table-font">Dato 2</td>
                    <td class="table-font">Dato 3</td>
                    <td class="table-font">Dato 4</td>
                    <td class="table-font">Dato 5</td>
                    <td class="table-font">Dato 6</td>
                    <td class="table-font">Dato 7</td>
                    <td class="table-font">Dato 8</td>
                    <td class="table-font">Dato 9</td>
                    <td class="table-font">Dato 10</td>
                    <td class="table-font">Dato 11</td>
                    <td class="table-font">Dato 12</td>
                    <td class="table-font">Dato 13</td>
                    <td class="table-font">Dato 14</td>
                    <td class="table-font">Dato 15</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

@endsection
