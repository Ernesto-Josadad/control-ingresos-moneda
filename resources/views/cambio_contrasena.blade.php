@extends('layouts.master')
@section('titulo', 'CAMBIO DE CONTRASEÑA')
@section('contenido')

    <style>
        .card-body {
            display: flex;
            justify-content: center;
            align-items: center;
            main=height: 100vh;
        }

        .errorContainer {
            display: flex;
            justify-content: center;
        }

        .encabezado {
            display: flex;
            justify-content: center;
            text-align: center;
        }
    </style>

    <link rel="stylesheet" href="css/monthReport.css">

    <br>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <br>
                <div class="encabezado">
                    <h2>Cambiar la contraseña</h2>
                </div>
                <div class="card-header d-flex">

                    <div style="flex-grow: 1;">

                        <br>

                        <div class="container-fluid errorContainer">

                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <span class="alert alert-danger">{{ $error }}</span>
                                    <br>
                                @endforeach
                            @endif

                            <br>

                            @if (session('repeatPassword'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('repeatPassword') }}
                                </div>
                            @endif

                            <br>

                            @if (session('notification'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('notification') }}
                                </div>
                            @endif

                        </div>

                        <!-- CUERPO DE CAMBIO DE CONTRASEÑA -->
                        <div class="card-body">

                            <form method="post" action="{{ route('cambio.updatePassword') }}">

                                @csrf

                                <div class="input-group input-group-lg">
                                    <span class="input-group-text" id="inputGroup-sizing-lg">Contraseña actual</span>
                                    <input type="password" id="password" name="current_password" class="form-control"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
                                </div>
                                <br>

                                <div class="input-group input-group-lg">
                                    <span class="input-group-text" id="inputGroup-sizing-lg">Nueva contraseña</span>
                                    <input type="password" class="form-control" name="password"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                </div>
                                <br>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text" id="inputGroup-sizing-lg">Confirmar
                                        contraseña</span>
                                    <input type="password" class="form-control" name="password_confirmation"
                                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                </div>

                                <br>

                                <button type="submit" class="btn btn-dark">Cambiar la contraseña</button>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
