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
      background-color: #fff; /* Color de fondo blanco */
      position: absolute; /* Posicionamiento absoluto para crear el fondo */
      z-index: 0; /* Asegura que el fondo esté detrás de los cuadros pequeños */
      margin-left: 20px; /* sirve para alinear el contenido */
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
      overflow: hidden; /* Evita que el contenido se desborde */
      margin-left: 30px; /* sirve para alinear el contenido */
      position: relative; /* Ajustado para que los cuadros estén en el flujo normal */
    }

    .cuadro img {
      display: block;
      margin: auto; /* Centra horizontalmente */
      padding: 20px;
      margin-bottom: 9px;
      width: 31%; /* Ajusta el tamaño de la imagen según tus necesidades */
    }

    .text {
      margin-top: 1px; /* Ajusta el espacio entre la imagen y el texto */
    }
  </style>

</head>
<body>
  <div class="fondo"></div>

  <div class="contenedor">
    <div class="cuadro">
      <a href="url_de_tu_pagina_alumnos">
        <img src="dist/img/alumnos.png" alt="Alumnos">
      </a>
      <p>Alumnos</p>
    </div>

    <div class="cuadro">
      <a href="recibo">
        <img src="dist/img/recibo.png" alt="Recibo Alumno">
      </a>
      <p>Recibo Alumnos</p>
    </div>

    <div class="cuadro">
      <a href="url_de_tu_pagina_recibo_coordinacion">
        <img src="dist/img/altas.png" alt="Grupos">
      </a>
      <p>Grupos</p>
    </div>

    <div class="cuadro">
      <a href="reporte">
        <img src="dist/img/reportes.png" alt="Ingresos">
      </a>
      <div class="text">
        <p>Ingresos</p>
      </div>
    </div>
  </div>
</body>
</html>

@endsection
