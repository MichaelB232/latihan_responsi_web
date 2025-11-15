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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body {
        /* background-color: blue; */
        display: flex;
        align-items: center;
        justify-content: center;
        height: 90vh;
    }

    .container {
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
        /* display: flex; */
    }

    input {
        box-sizing: border-box;
        border: 2px solid grey;
        border-radius: 5px;
        width: 100%;
        padding: 5px;
    }

    button {
        padding: 5px;
        background-color: green;
        border-radius: 7px;
        border: 2px solid green;
        width: 100%;

    }
</style>

<body>
    <div class="container">
        <div class="form-container">
            <h1>Register</h1>
            <form action="register.php" method="POST">
                <label for="username">Username</label> <br>
                <input type="text" name="username"> <br>
                <label for="password" style="margin-top: 15px;">Password</label><br>
                <input type="password" name="password"> <br>
                <button type="submit" style="margin-top: 15px;">Register</button>
                <p>Sudah punya akun? <a href="login.php">Login</a></p>
            </form>
        </div>
    </div>
</body>

</html>
