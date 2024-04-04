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
<div class="container-fluid">
  <div class="col-lg-12">
    <div class="row mb-2 mt-2">
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <!--  -->
          <div class="card-body">
            <div class="fondo"></div>

            <div class="contenedor">
              <div class="cuadro">
                <a href="students">
                  <img src="dist/img/alumnos.png" alt="Alumnos">
                </a>
                <p>Alumnos</p>
              </div>

              <div class="cuadro">
                <a href="/payment">
                  <img src="dist/img/recibo.png" alt="Recibo Alumno">
                </a>
                <p>Recibo Alumnos</p>
              </div>

              <div class="cuadro">
                <a href="nuevogrupo">
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
          </div>


          <!--  -->

        </div>
      </div>
    </div>
  </div>
</div>
<div class="card-body">

</div>


</html>

@endsection