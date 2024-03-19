@extends('layouts.master')
@section('titulo', 'reporte_mensual')
@section('contenido')

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jQuery UI -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <link rel="stylesheet" href="css/monthReport.css">
    <header id="encabezado">
        <h2 class="tittle"> INFORME REAL DE INGRESOS</h2>
        <h2 class="tittle">CENTRO DE BACHILLERATO TECNOLOGICO AGROPECUARIO No.284</h2>
    </header>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex">
                    <div style="flex-grow: 1;">
                        <div style="margin-left: 80%;">
                            <form method="GET" action="{{ route('pdfAuto') }}">
                                <button type="submit" class="d-sm-inline-block btn btn-primary shadow-sm">
                                    <i class="fa-regular fa-clipboard"></i> Generar Reporte
                                </button>
                            </form>
                        </div>
                        <br>

                        {{-- ! Barra de Búsqueda --}}




                        <!-- CUERPO DE LA TABLA -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-reponsive mt-4">
                                <thead>
                                    <th>Fecha del Reporte</th>
                                    <th>Acciones</th>
                                </thead>
                                @if ($reportesMensuales->isNotEmpty())
                                    @foreach ($reportesMensuales as $reporte)
                                        <tr>
                                            <td>{{ $reporte['fecha_de_elaboracion'] }}</td>
                                            <td>
                                                <form action="{{ route('pdf') }}" method="post" target="_blank">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $reporte->id }}">
                                                    <!-- Suponiendo que tienes acceso a la variable $reporte que contiene el reporte deseado -->
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="fa-regular fa-file-pdf"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="2">No hay reportes disponibles</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
