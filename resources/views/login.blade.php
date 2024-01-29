<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #FF977A;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh; 
            margin: 0;
        }

        .miDiv {
            width: 400px;
            background-color: white;
            border: 20px solid black;
            border-radius: 10px;
            padding: 20px; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            overflow: hidden; 
        }

        .miDiv h2 {
            text-align: center;
            background-color: #FF977A;
            margin-top: -20px;
            padding: 10px;
            border-radius: 10px 10px 0 0;
            margin-bottom: 0px;
        }

        .miDiv form {
            text-align: center; 
            background-color: #08483A; 
            padding: 20px;
            border-radius: 0 0 10px 10px;
        }

        .miDiv form label, .miDiv form input {
            display: block;
            margin-bottom: 10px;
            width: 100%;
            color: white;
        }

        .miDiv form button {
            border-radius: 3px;
            background-color: black; 
            color: white;
        }
    </style>
</head>
<body>
    <div class="miDiv">
        <h2>Login</h2>
        <form>
            <input type="text" id="username" name="username" class="form-control" required placeholder="Nombre de usuario">

            <input type="password" id="password" name="password" class="form-control" required placeholder="Contraseña">

            <button type="submit" class="btn btn-block">Entrar</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
