<?php
include("koneksi.php");
session_start();
if (empty($_SESSION['username'])) {
    header("location:login.php?pesan=logindulu");
}

$query = mysqli_query($connection, "SELECT * FROM kue");
$results = [];
while ($row = $query->fetch_assoc()) {
    $results[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<style>
    * {
        margin: 0;
        padding: 0;
    }

    .container-gw {
        width: 100%;
        height: 100%;
    }

    .navbar-gw {
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        /* background-color: cyan; */
    }

    .navbar-gw a {
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        background-color: red;
        width: 70px;
        height: 30px;
        border-radius: 8px;
    }

    .navbar-gw a:hover {
        color: black;
    }

    .container-content {
        /* background-color: orange; */
        margin-left: 150px;
    }

    .container-kue {
        /* background-color: red; */
        display: flex;
        flex: wrap;
        gap: 10px;

    }
</style>

<body>
    <div class="container-gw">
        <div class="navbar-gw">
            <h2 style="margin-left:150px">Katalog Kue</h1>
                <a href="logout.php" style="margin-right: 150px;">Logout</a>
        </div>
        <div class="container-content">
            <div class="container-kue">
                <?php foreach ($results as $result): ?>
                    <div class="card" style="width: 18rem;">
                        <img src="uploads/<?= htmlspecialchars($result['foto']) ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($result['nama']) ?></h5>
                            <p class="card-text">Harga : <?= htmlspecialchars($result['harga']) ?></p>
                            <p class="card-text">Stock : <?= htmlspecialchars($result['stok']) ?></p>
                            <a href="edit_kue.php?id=<?= htmlspecialchars($result['id']) ?>" class="btn btn-warning">Edit</a>
                            <a href="delete.php?id=<?= htmlspecialchars($result['id']) ?>" class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <a href="tambah_kue.php" class="btn btn-primary" style="margin-top:25px">Tambah Kue</a>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</html>