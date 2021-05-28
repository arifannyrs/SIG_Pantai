<?php
include("ceklogin.php");
$id = $_GET['id'];
//query untuk delete data
//Menyimpan data ke tabel login
$save = mysqli_query($koneksi, "DELETE FROM login WHERE id='$id'");
if ($save === true) {
    echo '<script>
             alert("Pengguna Berhasil Dihapus...");
             window.location="' . $base_url . '/admin/data-pengguna.php";
          </script>';
} else {
    echo '<script>
             alert("Pengguna Gagal Dihapus !");
             window.location="' . $base_url . '/admin/data-pengguna.php";
          </script>';
    return false;
}
