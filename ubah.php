<?php
session_start();
// Jika tidak bisa login maka balik ke login.php
// jika masuk ke halaman ini melalui url, maka langsung menuju halaman login
if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}

// Memanggil atau membutuhkan file function.php
require 'function.php';

// Mengambil data dari id_buku dengan fungsi get
$id_buku = $_GET['id_buku'];

// Mengambil data dari table buku dari id_buku yang tidak sama dengan 0
$buku = query("SELECT * FROM buku WHERE id_buku = $id_buku")[0];

// Jika fungsi ubah lebih dari 0/data terubah, maka munculkan alert dibawah
if (isset($_POST['ubah'])) {
    if (ubah($_POST) > 0) {
        echo "<script>
                alert('Data buku berhasil diubah!');
                document.location.href = 'index.php';
            </script>";
    } else {
        // Jika fungsi ubah dibawah dari 0/data tidak terubah, maka munculkan alert dibawah
        echo "<script>
                alert('Data buku gagal diubah!');
            </script>";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <!-- Font Google -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <!-- Own CSS -->
    <link rel="stylesheet" href="css/style.css">

    <title>Tambah Data | PHP Native | CRUD</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-uppercase">
        <div class="container">
            <a class="navbar-brand" href="index.php">PHP Native | CRUD</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Close Navbar -->

    <!-- Container -->
    <div class="container">
        <div class="row my-2">
            <div class="col-md">
                <h3 class="fw-bold text-uppercase"><i class="bi bi-pencil-square"></i>&nbsp;Ubah Data buku</h3>
            </div>
            <hr>
        </div>
        <div class="row my-2">
            <div class="col-md">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="gambarLama" value="<?= $buku['gambar']; ?>">
                    <div class="mb-3">
                        <label for="id_buku" class="form-label">id_buku</label>
                        <input type="number" class="form-control w-50" id="id_buku" value="<?= $buku['id_buku']; ?>" name="id_buku" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="judul" class="form-label">judul</label>
                        <input type="text" class="form-control w-50" id="judul" value="<?= $buku['judul']; ?>" name="judul" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="pengarang" class="form-label">Pengarang</label>
                        <input type="text" class="form-control w-50" id="pengarang" value="<?= $buku['pengarang']; ?>" name="pengarang" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="penerbit" class="form-label">Penerbit</label>
                        <input type="text" class="form-control w-50" id="penerbit" value="<?= $buku['penerbit']; ?>" name="penerbit" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label>Genre</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="genre" id="fiksi" value="fiksi" <?php if ($buku['genre'] == 'fiksi') { ?> checked='' <?php } ?>>
                            <label class="form-check-label" for="fiksi">fiksi</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="genre" id="non-fiksi" value="non-fiksi" <?php if ($buku['genre'] == 'non-fiksi') { ?> checked='' <?php } ?>>
                            <label class="form-check-label" for="non-fiksi">non-fiksi</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">kategori</label>
                        <select class="form-select w-50" id="kategori" name="kategori">
                            <option disabled selected value>--------------------------------------------Pilih kategori--------------------------------------------</option>
                            <option value="Komik" <?php if ($buku['kategori'] == 'Komik') { ?> selected='' <?php } ?>>Komik</option>
                            <option value="Sains" <?php if ($buku['kategori'] == 'Sains') { ?> selected='' <?php } ?>>Sains</option>
                            <option value="Ekonomi" <?php if ($buku['kategori'] == 'Ekonomi') { ?> selected='' <?php } ?>>Ekonomi</option>
                            <option value="Sejarah" <?php if ($buku['kategori'] == 'Sejarah') { ?> selected='' <?php } ?>>Sejarah</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-Mail</label>
                        <input type="email" class="form-control w-50" id="email" value="<?= $buku['email']; ?>" name="email" autocomplete="off" required>
                     
                        
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar <i>(Saat ini)</i></label> <br>
                        <img src="img/<?= $buku['gambar']; ?>" width="50%" style="margin-bottom: 10px;">
                        <input class="form-control form-control-sm w-50" id="gambar" name="gambar" type="file">
                    </div>
                    <div class="mb-3">
                        <label for="fax" class="form-label">Fax</label>
                        <textarea class="form-control w-50" id="fax" rows="5" name="fax" autocomplete="off"><?= $buku['fax']; ?></textarea>
                    </div>
                    <hr>
                    <a href="index.php" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-warning" name="ubah">Ubah</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Close Container -->
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>