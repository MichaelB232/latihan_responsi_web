<?php

require_once("koneksi.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    $stmt = mysqli_prepare($connection, "INSERT INTO users (username,password) VALUES(?,?)");
    $stmt->bind_param("ss", $username, $password_hash);

    if ($stmt->execute()) {
        header("location:login.php");
    } else {
        header("location:register.php");
    }
}

?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <style>
        body {
            /* background-color: blue; */
            display: flex;
            align-items: center;
            justify-content: center;
            height: 90vh;
        }

        .container-gw {
            width: 500px;
            border: 10px solid white;
            border-radius: 10px;
            box-shadow: 5px 5px 5px 5px rgba(0, 0, 0, 0.3);
            /* background-color: cyan; */
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .form-container {
            /* background-color: cyan; */
            width: 450px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        input {
            box-sizing: border-box;
            border: 2px solid grey;
            border-radius: 5px;
            width: 100%;
            padding: 5px;
        }

        button {
            color: white;
            padding: 5px;
            background-color: green;
            border-radius: 7px;
            border: 2px solid green;
            width: 100%;
        }

        .form-content {
            /* background-color: cyan; */
            width: 450px;
        }
    </style>

    <body>
        <div class="container-gw">
            <div class="form-container">
                <div class="form-header">
                    <h2>Register</h1>
                </div>
                <div class="form-content">
                    <form action="register.php" method="POST">
                        <label for="username">Username</label> <br>
                        <input type="text" name="username"> <br>
                        <label for="password" style="margin-top: 15px;">Password</label><br>
                        <input type="password" name="password"> <br>
                        <button type="submit" style="margin-top: 15px;">Register</button>
                    </form>
                </div>
                <p>Sudah punya akun? <a href="login.php">Login</a></p>
            </div>
        </div>
    </body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>