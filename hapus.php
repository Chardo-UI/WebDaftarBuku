<?php
session_start();
// // Jika tidak bisa login maka balik ke login.php
// jika masuk ke halaman ini melalui url, maka langsung menuju halaman login
if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}
// Memanggil atau membutuhkan file function.php
require 'function.php';

// Mengambil data dari id_buku dengan fungsi get
$id_buku = $_GET['id_buku'];

// Jika fungsi hapus lebih dari 0/data terhapus, maka munculkan alert dibawah
if (hapus($id_buku) > 0) {
    echo "<script>
                alert('Data Buku berhasil dihapus!');
                document.location.href = 'index.php';
            </script>";
} else {
    // Jika fungsi hapus dibawah dari 0/data tidak terhapus, maka munculkan alert dibawah
    echo "<script>
            alert('Data Buku gagal dihapus!');
        </script>";
}
