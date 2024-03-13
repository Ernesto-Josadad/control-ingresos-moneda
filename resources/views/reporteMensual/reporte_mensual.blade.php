@extends('layouts.master')
@section('titulo', 'reporte_mensual')
@section('contenido')
    <link rel="stylesheet" href="css/monthReport.css">
    <header id="encabezado">
        <h2 class="tittle">INFORME REAL DE INGRESOS</h2>
        <h2 class="tittle">CENTRO DE BACHILLERATO TECNOLOGICO AGROPECUARIO No.284</h2>
    </header>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex">
                    <div style="flex-grow: 1;">
                        <h3 class="mb-0" style="text-align: center;">
                            Concentrado de Reportes por Fecha
                        </h3>
                        <div style="margin-left: 80%;">
                            <button type="button" class="d-sm-inline-block btn btn-primary shadow-sm">
                                <i class="fa-regular fa-clipboard"></i> Generar Reporte
                            </button>
                        </div>

                        <!-- CUERPO DE LA TABLA -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-reponsive mt-4">
                                <thead>
                                    <th>#</th>
                                    <th>Fecha de Informe</th>
                                    <th>Acciones</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="" class="btn btn-warning mb-2"><i class="fa-solid fa-pencil"></i></a>
                                            <form action=""><button class="btn btn-primary"><i class="fa-regular fa-file-pdf"></i></button></form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
