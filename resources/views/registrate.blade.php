<!DOCTYPE html>
<html lang="en">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../js/alerts.js"></script>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarme</title>
    <style>
        body {
            background-color: #FF977A;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: #08483A;
            width: 500px;
            height: 470px;
            margin: 150px auto;
            padding: 0px;
            border: 15px solid black;
            border-radius: 40px;
        }

        h1 {
            width: 100%;
            padding: 20px;
            border: 150px;
            border-radius: 5px;
            color: rgb(2, 2, 2);
            text-align: center;
            margin: 0px 0px;
            background-color: #FF977A;
        }

        .input-group {
            margin-bottom: 30px;
        }



        label {
            color: #FF977A;
            display: block;
        }

        input {
            width: 50%;
            height: 40px;
            padding: 15px;
            margin: 15px 110px;
            border: 100px;
            border-radius: 30px;
            color: rgb(7, 7, 7);
            background-color: rgb(255, 255, 255);
        }

        button {
            width: 30%;
            height: 40px;
            border: none;
            margin: 0px 90px;
            border-radius: 30px;
            background-color: rgb(16, 16, 16);
            color: #f7f3f3;
            font-weight: bold;
        }

        .error-message {
            color: red;
            font-size: 12px;
        }

        a {
            padding: 10px;
            color: white;
            margin: 10px 17px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>REGISTRARME</h1>
        <form action="{{ route('registrate.register') }}" method="post">

            @csrf

            @if (count($errors) > 0)
                @php
                    $errorMessages = '';
                    foreach ($errors->all() as $message) {
                        $errorMessages .= "<li>$message</li>";
                    }
                @endphp

                <script>
                    Swal.fire({
                        icon: "error",
                        title: "Corrige los siguientes errores",
                        html: `{!! $errorMessages !!}`
                    });
                </script>
            @endif
            <br>
            <input type="text" autocomplete="off" name="name" placeholder="Nombre" value="{{ old('name') }}">

            <input type="email" autocomplete="off" name="email" placeholder="Correo Electrónico"
                value="{{ old('email') }}">

            <input type="password" name="password" required placeholder="Contraseña">

            <input type="password" name="password_confirmation" required placeholder="Confirmar Contraseña">

            <div class="container-fluid">
                <a href="{{route('login')}}">Iniciar sesión</a>
                <button type="submit" class="btn btn-black">Registrarme</button>
            </div>

        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
s
