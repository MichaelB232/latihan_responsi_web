<?php

require_once("koneksi.php");
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = mysqli_prepare($connection, "SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);

    $check = $stmt->execute();
    $check = $stmt->get_result();
    if ($check->num_rows > 0) {
        $user = $check->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            header('location:dashboard.php');
        } else {
            header('location: login.php?pesan=error');
        }
    } else {
        header('location: login.php?pesan="error"');
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
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
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    input {
        box-sizing: border-box;
        border: 2px solid grey;
        border-radius: 5px;
        width: 100%;
        padding: 5px;
    }

    .form-content {
        width: 100%;
    }

    button {
        padding: 5px;
        background-color: blue;
        border-radius: 7px;
        border: 2px solid blue;
        width: 100%;
        color: white;
    }
</style>

<body>
    <div class="container-gw">
        <div class="form-container">
            <h2>Login</h2>
            <?php if (isset($_GET['pesan'])): ?>
                <?php if ($_GET['pesan'] == "logindulu"): ?>
                    <p style="color: red;">Login dulu brader</p>
                <?php elseif ($_GET['pesan'] == "error"): ?>
                    <p style="color: red;">Username / password salah brader</p>
                <?php endif; ?>
            <?php endif; ?>
            <div class="form-content">
                <form action="login.php" method="POST">
                    <label for="username">Username</label> <br>
                    <input type="text" name="username"> <br>
                    <label for="password" style="margin-top: 15px;">Password</label><br>
                    <input type="password" name="password"> <br>
                    <button type="submit" style="margin-top: 15px;">Login</button>
            </div>
            <p style="margin-top: 10px;">Belum punya akun? <a href="register.php">Register</a></p>
            </form>
        </div>
    </div>
</body>

</html>