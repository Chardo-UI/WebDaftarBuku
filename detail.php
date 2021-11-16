<?php
// Memanggil atau membutuhkan file function.php
require 'function.php';

// Jika dataSiswa diklik maka
if (isset($_POST['dataSiswa'])) {
    $output = '';

    // mengambil data siswa dari id_buku yang berasal dari dataSiswa
    $sql = "SELECT * FROM buku WHERE id_buku = '" . $_POST['dataSiswa'] . "'";
    $result = mysqli_query($koneksi, $sql);

    $output .= '<div class="table-responsive">
                        <table class="table table-bordered">';
    foreach ($result as $row) {
        $output .= '<tr align="center">
                            <td colspan="2"><img src="img/' . $row['gambar'] . '" width="50%"></td>
                        </tr>
                        <tr>
                            <th width="40%">id_buku</th>
                            <td width="60%">' . $row['id_buku'] . '</td>
                        </tr>
                        <tr>
                            <th width="40%">Judul</th>
                            <td width="60%">' . $row['judul'] . '</td>
                        </tr>
                        <tr>
                            <th width="40%">Pengarang</th>
                            <td width="60%">' . $row['pengarang'] .'</td>
                        </tr>
                        <tr>
                            <th width="40%">Penerbit</th>
                            <td width="60%">' . $row['penerbit'] . '</td>
                        </tr>
                        <tr>
                            <th width="40%">genre</th>
                            <td width="60%">' . $row['genre'] . '</td>
                        </tr>
                        <tr>
                            <th width="40%">Kategori</th>
                            <td width="60%">' . $row['kategori'] . '</td>
                        </tr>
                        
                        <tr>
                            <th width="40%">Fax</th>
                            <td width="60%">' . $row['fax'] . '</td>
                        </tr>
                            <th width="40%">E-mail</th>
                            <td width="60%">' . $row['email'] . '</td>
                        </tr>

                        ';
    }
    $output .= '</table></div>';
    // Tampilkan $output
    echo $output;
}
