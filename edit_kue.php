<?php
session_start();
include("koneksi.php");
if (empty($_SESSION['username'])) {
    header("location:login.php");
}
$id_kue = $_GET['id'];

$stmt = mysqli_query($connection, "SELECT * FROM kue WHERE id='$id_kue'");
$produk = $stmt->fetch_assoc();
// var_dump($produk);
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
        display: flex;
        align-items: center;
        justify-content: center;
        height: 90vh;
    }

    .container-gw {
        /* background-color: cyan; */
        width: 500px;
        height: 550px;
        box-shadow: 2px 2px 5px black;
    }

    .container-form {
        margin-left: 25px;
    }

    input {
        border: 2px solid gray;
        padding: 5px;
        border-radius: 5px;
        width: 95%;
        box-sizing: border-box;
        margin-top: 5px;
    }

    .button-gw {
        margin-top: 18px;
    }
</style>

<body>
    <div class="container-gw">
        <div class="container-form">
            <h1 style="margin-top: 25px;margin-bottom: 20px;">Tambah Kue</h1>
            <img src="uploads/<?= $produk['foto']; ?>" width="150">
            <form action="edit_process.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" value="<?= $id_kue ?>" name="id">
                <input type="hidden" name="foto_lama" value="<?= $produk['foto'] ?>">
                <label for="foto">Foto</label><br>
                <input type="file" name="foto"><br>
                <label for=" name">Nama Produk</label><br>
                <input type="text" name="nama" required value="<?= htmlspecialchars($produk['nama']) ?>"><br>
                <label for="harga">Harga</label><br>
                <input type="text" name="harga" required value="<?= htmlspecialchars($produk['harga']) ?>"><br>
                <label for="stok">Stok</label><br>
                <input type="text" name="stok" required value="<?= htmlspecialchars($produk['stok']) ?>">
                <div class="button-gw">
                    <button class="btn btn-warning" type="submit">Simpan Perubahan</button>
                    <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
                </div>

            </form>
        </div>
    </div>

</body>

</html>