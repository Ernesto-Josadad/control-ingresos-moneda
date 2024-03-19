@extends('layouts.master')
@section('titulo', 'TABLA GRUPOS Y SUBGRUPOS')
@section('contenido')

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .input-group-text {
            background-color: transparent;
            border: none;
            padding: 0;
        }

        .input-group-text i {
            margin: auto;
            color: #ccc;
        }


        .barra {
            margin-top: 1em;
        }

        .form-control {
            border-radius: px;
        }

        th.tabla-header {
            font-family: 'Courier New';
            font-size: 18px;
            color: black;
            font-weight: bold;
            text-align: center;
            background-color: #bdecb6;
            padding: 10px;
            white-space: nowrap;
            /* Evitar saltos de línea */

        }

        td.table-font {
            font-family: 'Arial Narrow';
            font-size: 16px;
            white-space: nowrap;
            /* Evitar saltos de línea */
            overflow: hidden;
            /* Ocultar el contenido excedente */
            text-overflow: ellipsis;
            /* Mostrar puntos suspensivos cuando el contenido es demasiado largo */
        }

        .table-bordered,
        .table-bordered th,
        .table-bordered td,
        .table-bordered thead th,
        .table-bordered tbody+tbody {
            border-color: black;
            border-width: 1px;
        }

        .pagination .page-link {
            color: black;
            /* Cambiar el color del texto a negro */
        }

        .sidebar-closed .container-fluid .col-lg-12 {
            padding-left: 20px;
            /* Ajusta el padding según el ancho de la barra lateral */
            padding-right: 20px;
            /* Ajusta el padding según el ancho de la barra lateral */
        }
    </style>

</head>

<!-- Barra de búsqueda -->
<div class="barra">
    <div class="input-group">
        <input id="input" class="form-control" type="search" placeholder="Buscar...">
        <div class="input-group-append">
            <span class="input-group-text" style="background-color: transparent; border: none; padding: 0; position: absolute; top: 50%; right: 10px; transform: translateY(-50%);">
                <i class="fas fa-search" style="color: #000000;"></i>
            </span>
        </div>
    </div>
</div>
<br>
<!-- Contenido de la página con tabla responsiva -->
<div class="container-fluid"> <!-- Conserva el contenedor original -->
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table id="tablaRecibos" class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="tabla-header align-middle text-center" scope="col">NUMERO</th>
                            <th class="tabla-header align-middle text-center" scope="col">FECHA</th>
                            <!-- <th class="tabla-header align-middle text-center" scope="col">ID ALUMNO</th> -->
                            <th class="tabla-header align-middle text-center" scope="col">MATRICULA</th>
                            <th class="tabla-header align-middle text-center" scope="col">NOMBRES</th>
                            <th class="tabla-header align-middle text-center" scope="col">APELLIDO PATERNO</th>
                            <th class="tabla-header align-middle text-center" scope="col">APELLIDO MATERNO</th>
                            <th class="tabla-header align-middle text-center" scope="col">GRADO</th>
                            <th class="tabla-header align-middle text-center" scope="col">GRUPO</th>
                            <th class="tabla-header align-middle text-center" scope="col">CARRERA</th>
                            <th class="tabla-header align-middle text-center" scope="col">DESCRIPCIÓN</th>
                            <th class="tabla-header align-middle text-center" scope="col">CONCEPTO</th>
                            <th class="tabla-header align-middle text-center" scope="col">IMPORTE</th>
                            <th class="tabla-header align-middle text-center" scope="col">IMPORTE CON LETRAS</th>
                            <th class="tabla-header align-middle text-center" scope="col">CANTIDAD</th>
                            <th class="tabla-header align-middle text-center" scope="col">NUMERO DE ROC</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recibos as $row)
                        <tr>
                            <td class="table-font align-middle text-center">{{$row->id}}</td>
                            <td class="table-font align-middle text-center">{{$row->fecha}}</td>
                            <!-- <td class="table-font">{{$row->alumno_id}}</td> -->
                            <td class="table-font align-middle text-center">{{$row->alumno->matricula}}</td>
                            <td class="table-font align-middle text-center">{{$row->alumno->nombres}}</td>
                            <td class="table-font align-middle text-center">{{$row->alumno->apellido_paterno}}</td>
                            <td class="table-font align-middle text-center">{{$row->alumno->apellido_materno}}</td>
                            <td class="table-font align-middle text-center">{{$row->alumno->grado}}</td>
                            <td class="table-font align-middle text-center">{{$row->alumno->grupo}}</td>
                            <td class="table-font align-middle text-center">{{$row->alumno->carrera}}</td>
                            @foreach($datosRecibos as $dato)
                            @if($dato->recibo_pago_id == $row->id)
                            <?php
                            $subgrupo = App\Models\Subgrupos::find($dato->clave_subgrupo_id);
                            ?>
                            <td class="table-font align-middle text-center">{{$subgrupo ? $subgrupo->codigo : 'N/A'}}</td>
                            <td class="table-font align-middle text-center">{{$subgrupo ? $subgrupo->descripcion : 'N/A'}}</td>
                            <td class="table-font align-middle text-center">${{$dato->importe}}</td>
                            <td class="table-font align-middle text-center">
                                {{ ucwords($currencyTransformer->toWords($dato->importe * 100, 'MXN')) }}
                            </td>

                            <td class="table-font align-middle text-center">{{$dato->cantidad_subgrupo}}</td>
                            @break
                            @endif
                            @endforeach

                            <td class="table-font align-middle text-center">{{$row->folio}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Script JavaScript para manejar la búsqueda en tiempo real -->
<script>
    // Obtener el campo de búsqueda y las filas de la tabla
    const input = document.getElementById('input');
    const filas = document.querySelectorAll('#tablaRecibos tbody tr');

    // Agregar un evento de escucha para el evento input
    input.addEventListener('input', function() {
        // Obtener el valor del campo de búsqueda
        const keyword = input.value.trim().toLowerCase();

        // Filtrar las filas de la tabla
        for (let i = 0; i < filas.length; i++) {
            const fila = filas[i];
            let coincide = false;
            // Obtener las celdas visibles de la fila
            const celdas = fila.getElementsByTagName('td');
            for (let j = 0; j < celdas.length; j++) {
                const celda = celdas[j];
                // Obtener el texto de la celda y convertirlo a minúsculas
                const textoCelda = celda.textContent.trim().toLowerCase();
                // Verificar si el texto de la celda coincide con el término de búsqueda
                if (textoCelda.includes(keyword)) {
                    coincide = true;
                    break;
                }
            }
            // Mostrar la fila si coincide con el término de búsqueda, ocultarla si no coincide
            if (coincide) {
                fila.style.display = '';
            } else {
                fila.style.display = 'none';
            }
        }
    });
</script>


<br>
<!-- Paginación -->
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-end">
        {{-- Botón Anterior --}}
        @if ($recibos->onFirstPage())
        <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1">Anterior</a>
        </li>
        @else
        <li class="page-item">
            <a class="page-link" href="{{ $recibos->previousPageUrl() }}" tabindex="-1">Anterior</a>
        </li>
        @endif

        {{-- Números de Página --}}
        @foreach ($recibos->getUrlRange(1, $recibos->lastPage()) as $page => $url)
        <li class="page-item {{ $page == $recibos->currentPage() ? 'active' : '' }}">
            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
        </li>
        @endforeach

        {{-- Botón Siguiente --}}
        @if ($recibos->hasMorePages())
        <li class="page-item">
            <a class="page-link" href="{{ $recibos->nextPageUrl() }}" tabindex="-1">Siguiente</a>
        </li>
        @else
        <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1">Siguiente</a>
        </li>
        @endif
    </ul>
</nav>
</body>

</html>

@endsection