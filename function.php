<?php
// Koneksi Database
$koneksi = mysqli_connect("localhost", "root", "", "buku");

// membuat fungsi query dalam bentuk array
function query($query)
{
    // Koneksi database
    global $koneksi;

    $result = mysqli_query($koneksi, $query);

    // membuat varibale array
    $rows = [];

    // mengambil semua data dalam bentuk array
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

// Membuat fungsi tambah
function tambah($data)
{
    global $koneksi;

    $id_buku = htmlspecialchars($data['id_buku']);
    $judul = htmlspecialchars($data['judul']);
    $pengarang = htmlspecialchars($data['pengarang']);
    $penerbit = $data['penerbit'];
    $genre = $data['genre'];
    $kategori = $data['kategori'];
    $email = htmlspecialchars($data['email']);
    $gambar = upload();
    $fax = htmlspecialchars($data['fax']);

    if (!$gambar) {
        return false;
    }

    $sql = "INSERT INTO buku VALUES ('$id_buku','$judul','$pengarang','$penerbit','$genre','$kategori','$email','$gambar','$fax')";

    mysqli_query($koneksi, $sql);

    return mysqli_affected_rows($koneksi);
}

// Membuat fungsi hapus
function hapus($id_buku)
{
    global $koneksi;

    mysqli_query($koneksi, "DELETE FROM buku WHERE id_buku = $id_buku");
    return mysqli_affected_rows($koneksi);
}

// Membuat fungsi ubah
function ubah($data)
{
    global $koneksi;

    $id_buku = $data['id_buku'];
    $judul = htmlspecialchars($data['judul']);
    $pengarang = htmlspecialchars($data['pengarang']);
    $penerbit = $data['penerbit'];
    $genre = $data['genre'];
    $kategori = $data['kategori'];
    $fax = htmlspecialchars($data['fax']);
    $email = htmlspecialchars($data['email']);

    $gambarLama = $data['gambarLama'];

    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $sql = "UPDATE buku SET judul = '$judul', pengarang = '$pengarang', penerbit = '$penerbit', genre = '$genre', kategori = '$kategori', email = '$email', gambar = '$gambar', fax = '$fax' WHERE id_buku = $id_buku";

    mysqli_query($koneksi, $sql);

    return mysqli_affected_rows($koneksi);
}

// Membuat fungsi upload gambar
function upload()
{
    // Syarat
    $judulFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // Jika tidak mengupload gambar atau tidak memenuhi persyaratan diatas maka akan menampilkan alert dibawah
    if ($error === 4) {
        echo "<script>alert('Pilih gambar terlebih dahulu!');</script>";
        return false;
    }

    // format atau ekstensi yang diperbolehkan untuk upload gambar adalah
    $extValid = ['jpg', 'jpeg', 'png'];
    $ext = explode('.', $judulFile);
    $ext = strtolower(end($ext));

    // Jika format atau ekstensi bukan gambar maka akan menampilkan alert dibawah
    if (!in_array($ext, $extValid)) {
        echo "<script>alert('Yang anda upload bukanlah gambar!');</script>";
        return false;
    }

    // Jika ukuran gambar lebih dari 3.000.000 byte maka akan menampilkan alert dibawah
    if ($ukuranFile > 3000000) {
        echo "<script>alert('Ukuran gambar anda terlalu besar!');</script>";
        return false;
    }

    // judul gambar akan berubah angka acak/unik jika sudah berhasil tersimpan
    $judulFileBaru = uniqid();
    $judulFileBaru .= '.';
    $judulFileBaru .= $ext;

    // memindahkan file ke dalam folde img dengan judul baru
    move_uploaded_file($tmpName, 'img/' . $judulFileBaru);

    return $judulFileBaru;
}
