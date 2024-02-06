@extends('layouts.master')
@section('titulo', 'PANEL CONTROL')
@section('contenido')

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <style>
    .contenedor {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 30px;
      padding: 40px;
    }

    .fondo {
      width: 79%;
      height: 82%;
      background-color: #fff; 
      position: absolute; 
      z-index: 0; 
      margin-left: 20px; 
    }

    .cuadro {
      width: 90%;
      height: auto;
      background-color: #08483A;
      color: #fff;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      font-size: 22px;
      font-weight: bold;
      border-radius: 40px;
      overflow: hidden; 
      margin-left: 30px; 
      position: relative; 
    }

    .cuadro img {
      display: block;
      margin: auto; 
      padding: 20px;
      margin-bottom: 9px;
      width: 31%; 
    }

    .text {
      margin-top: 1px; 
    }
  </style>

</head>
<body>
  <?php
    echo '<div class="fondo"></div>';
    echo '<div class="contenedor">';
    
    $cuadros = [
      ['url' => 'url_de_tu_pagina_alumnos', 'img' => 'dist/img/alumnos.png', 'alt' => 'Alumnos', 'text' => 'Alumnos'],
      ['url' => 'recibo', 'img' => 'dist/img/recibo.png', 'alt' => 'Recibo Alumno', 'text' => 'Recibo Alumnos'],
      ['url' => 'url_de_tu_pagina_recibo_coordinacion', 'img' => 'dist/img/contrato.png', 'alt' => 'Recibo Coordinación', 'text' => 'Recibo Coordinación'],
      ['url' => 'url_de_tu_pagina_ingresos', 'img' => 'dist/img/reportes.png', 'alt' => 'Ingresos', 'text' => 'Ingresos'],
    ];

    foreach ($cuadros as $cuadro) {
      echo '<div class="cuadro">';
      echo '<a href="' . $cuadro['url'] . '">';
      echo '<img src="' . $cuadro['img'] . '" alt="' . $cuadro['alt'] . '">';
      echo '</a>';
      echo '<p>' . $cuadro['text'] . '</p>';
      echo '</div>';
    }

    echo '</div>';
  ?>
</body>
</html>


@endsection