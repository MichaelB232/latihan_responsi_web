<?php
session_start();

include("koneksi.php");
if (empty($_SESSION['username'])) {
    header("location:login.php");
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $file = $_FILES['foto']['name'];

    $ekstensi_available = array('png', 'jpg');
    $x = explode('.', $file);
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['foto']['size'];
    $file_tmp = $_FILES['foto']['tmp_name'];
    if (in_array($ekstensi, $ekstensi_available)) {
        if ($ukuran < 1044070) {
            move_uploaded_file($file_tmp, 'uploads/' . $file);
            $query = mysqli_prepare($connection, "INSERT INTO kue (nama,harga,stok,foto) VALUES(?,?,?,?)");
            $query->bind_param("siis", $nama, $harga, $stok, $file);
            if ($query->execute()) {
                echo ("Kue berhasil ditambahkan");
                header("location:dashboard.php");
            } else {
                echo ("Gagal menambahkan kue");
            }
        } else {
            echo ("Ukurane terlalu besar");
        }
    } else {
        echo ("Ekstensi file yang diupload tidak diperbolehkan");
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
        display: flex;
        align-items: center;
        justify-content: center;
        height: 90vh;
    }

    .container-gw {
        /* background-color: cyan; */
        width: 500px;
        height: 475px;
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

    /* button {
        width: 70px;
        border-radius: 5px;
        padding: 5px;
    } */
</style>

<body>
    <div class="container-gw">
        <div class="container-form">
            <h1 style="margin-top: 25px;margin-bottom: 20px;">Tambah Kue</h1>
            <form action="tambah_kue.php" method="POST" enctype="multipart/form-data">
                <label for="foto">Foto</label><br>
                <input type="file" name="foto"><br>
                <label for="nama">Nama Produk</label><br>
                <input type="text" name="nama" required><br>
                <label for="harga">Harga</label><br>
                <input type="text" name="harga" required><br>
                <label for="stok">Stok</label><br>
                <input type="text" name="stok" required><br><br>
                <button type="submit" class="btn btn-primary">Tambah</button>
                <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
            </form>

        </div>
    </div>

</body>


</html>