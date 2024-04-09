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

        .barra {
            margin-top: 1em;
        }

        th.tabla-header {
            font-family: 'Courier New';
            font-size: 18px;
            color: black;
            font-weight: bold;
            text-align: center;
            /* background-color: #bdecb6; */
            background-color: #00FF7F;
            padding: 10px;
            white-space: nowrap;
        }

        td.table-font {
            font-family: 'Arial Narrow';
            font-size: 16px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .table-bordered,
        .table-bordered th,
        .table-bordered td,
        .table-bordered thead th,
        .table-bordered tbody+tbody {
            border-color: black;
            border-width: 1px;
        }

        .sidebar-closed .container-fluid .col-lg-12 {
            padding-left: 20px;
            padding-right: 20px;
        }

        .page-link-black {
            font-family: 'arial';
            color: black;
            font-weight: bold;
        }
    </style>
</head>

<!-- Barra de búsqueda -->
<div class="barra">
    <form id="searchForm" action="{{ route('tabla_grupos_subgrupos.index') }}" method="GET" class="input-group">
        <input id="searchInput" name="search" class="form-control search-input" type="search" placeholder="Buscar..." value="{{ $search ?? '' }}" style="border-top-right-radius: 0; border-bottom-right-radius: 0; border-top-left-radius: 10px; border-bottom-left-radius: 10px; border: 1px solid #000000;">
        <div class="input-group-append">
            <button type="submit" class="btn btn-primary" style="border-top-left-radius: 0; border-bottom-left-radius: 0; border-top-right-radius: 10px; border-bottom-right-radius: 10px; border: 1px solid #000000;"><i class="fas fa-search"></i></button>
        </div>
        @if($search)
        <button type="submit" class="btn btn-secondary ml-2" onclick="clearSearch()" style="background-color: #98FB98; color: black; font-weight: bold; border: 1px solid #008000; border-top-left-radius: 10px; border-top-right-radius: 10px; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">Limpiar búsqueda</button>

        @endif
    </form>
</div>
<br>
<!-- Contenido de la página con tabla responsiva -->
<div class="container-fluid"> <!-- Conserva el contenedor original -->
    <div class="row">
        <div class="col-lg-12">
            @if ($recibos->isEmpty())
            <!-- Mostrar el mensaje de SweetAlert si no hay registros -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'info',
                        title: 'No se encontraron registros',
                        text: 'No hay registros que coincidan con la búsqueda.'
                    }).then(function() {
                        // Redirigir al usuario de vuelta a la vista 'tabla_grupos_subgrupos'
                        window.location.href = '{{ route("tabla_grupos_subgrupos.index") }}';
                    });
                });
            </script>
            @endif
            <div class="table-responsive">
                <table id="tablaRecibos" class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="tabla-header align-middle text-center" scope="col">NUMERO</th>
                            <th class="tabla-header align-middle text-center" scope="col">FECHA</th>
                            <th class="tabla-header align-middle text-center" scope="col">ID ALUMNO</th>
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
                            <td class="table-font align-middle text-center">{{$row->id ?? 'N/A'}}</td>
                            <td class="table-font align-middle text-center">{{$row->fecha ?? 'N/A'}}</td>
                            <td class="table-font align-middle text-center">{{$row->alumno_id}}</td>
                            <td class="table-font align-middle text-center">{{$row->alumno->matricula ?? 'N/A'}}</td>
                            <td class="table-font align-middle text-center">{{$row->alumno->nombres ?? 'N/A'}}</td>
                            <td class="table-font align-middle text-center">{{$row->alumno->apellido_paterno ?? 'N/A'}}</td>
                            <td class="table-font align-middle text-center">{{$row->alumno->apellido_materno ?? 'N/A'}}</td>
                            <td class="table-font align-middle text-center">{{$row->alumno->grado ?? 'N/A'}}</td>
                            <td class="table-font align-middle text-center">{{$row->alumno->grupo ?? 'N/A'}}</td>
                            <td class="table-font align-middle text-center">{{$row->alumno->carrera ?? 'N/A'}}</td>

                            @php
                            $subgrupo = null;
                            $importe = '0';
                            $descripcion = 'N/A';
                            $cantidad_subgrupo = 'N/A';

                            foreach($datosRecibos as $dato) {
                            if($dato->pago_recibo_id == $row->id) {
                            $subgrupo = App\Models\Subgrupos::find($dato->clave_subgrupo_id);
                            $importe = $dato->importe;
                            $descripcion = $subgrupo ? $subgrupo->descripcion : 'N/A';
                            $cantidad_subgrupo = $dato->cantidad_subgrupo;
                            break;
                            }
                            }
                            @endphp

                            <td class="table-font align-middle text-center">{{$subgrupo ? $subgrupo->codigo : 'N/A'}}</td>
                            <td class="table-font align-middle text-center">{{$descripcion}}</td>
                            <td class="table-font align-middle text-center">${{ number_format($importe, 2, '.', ',') }}</td>
                            <td class="table-font align-middle text-center">
                                {{ ucwords($currencyTransformer->toWords(floatval($importe) * 100, 'MXN')) }}
                            </td>
                            <td class="table-font align-middle text-center">{{$cantidad_subgrupo}}</td>

                            <td class="table-font align-middle text-center">{{$row->folio ?? 'N/A'}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
<br>
<!-- Paginación -->
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-end">
        {{-- Botón Anterior --}}
        @if ($recibos->onFirstPage())
        <li class="page-item disabled">
            <span class="page-link page-link-black">Anterior</span>
        </li>
        @else
        <li class="page-item">
            <a class="page-link page-link-black" href="{{ $recibos->previousPageUrl() }}" tabindex="-1">Anterior</a>
        </li>
        @endif

        {{-- Números de Página --}}
        @if ($recibos->lastPage() > 1)
        @for ($i = max(1, $recibos->currentPage() - 1); $i <= min($recibos->lastPage(), $recibos->currentPage() + 1); $i++)
            <li class="page-item {{ $i == $recibos->currentPage() ? 'active' : '' }}">
                <a class="page-link" href="{{ $recibos->appends(['search' => $search])->url($i) }}">{{ $i }}</a>
            </li>
            @endfor
            @endif

            {{-- Botón Siguiente --}}
            @if ($recibos->hasMorePages())
            <li class="page-item">
                <a class="page-link page-link-black" href="{{ $recibos->nextPageUrl() }}" tabindex="-1">Siguiente</a>
            </li>
            @else
            <li class="page-item disabled">
                <span class="page-link page-link-black">Siguiente</span>
            </li>
            @endif
    </ul>
</nav>


<!-- para limpiar la barra de busqueda-->
<script>
    function clearSearch() {
        document.getElementById('searchInput').value = '';
        document.getElementById('searchForm').submit();
    }
</script>

</body>

</html>

@endsection