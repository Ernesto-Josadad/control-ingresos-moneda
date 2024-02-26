<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- <style>
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
    </style> -->
</head>

<body>
<div class="wrapper">
        <div class="login-box">
            <form action="">
                <h2>Login</h2>
            <div class="input-box">
                <span class="icon">
                    <i class="fa-solid fa-envelope"></i>
                </span>
                <input type="email" required>
                <label>Email</label>
            </div>

            <div class="input-box">
                <span class="icon">
                    <i class="fa-solid fa-lock"></i>
                </span>
                <input type="password" required>
                <label>Pass</label>
            </div>

            <div class="remember-forgot">
                <label><input type="checkbox">Remember me</label>
                <a href="#">Forgot Password</a>
            </div>

            <button type="submit">Login</button>

            <div class="register-link">
                <p>Don't Have an Account 
                    <a href="#">Register</a>
                </p>
            </div>
            </form>
        </div>
    </div>
    
</body>

</html>
