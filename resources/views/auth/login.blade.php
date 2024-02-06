<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
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
    height: 300px;
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
    height: 30px;
    padding: 10px;
    border: none;
    margin: 15px 300px;
    border-radius: 30px;
    background-color: rgb(16, 16, 16);
    color: #f7f3f3;
    font-weight: bold;
  }

  .error-message {
    color: red;
    font-size: 12px;
  }

  </style>
</head>
<body>
  <div class="container">
    <h1>LOGIN</h1>
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
