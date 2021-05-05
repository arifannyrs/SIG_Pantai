<?php
session_start();
include("../koneksi.php");
include("../proses.php");

if (!isset($_SESSION["username"])) {
    echo '<script>
                alert("Mohon login dahulu !");
                window.location="' . $base_url . '/";
             </script>';
    return false;
}

if ($_SESSION["level"] != "pegawai") {
    echo '<script>
                alert("Maaf Anda Tidak Berhak Ke Halaman ini !");
                window.location="' . $base_url . '/' . $_SESSION["level"] . '/";
             </script>';
    return false;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>SIG PANTAI</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body>

    <p>
        <center>
            <img src='../img/logokab.png' width='120' height='140'></a>
        </center>

    <h1>Sistem Informasi Geografis Pemetaan Potensi<br /> Objek Wisata Pantai di Kabupaten Tulungagung</h1>

    <div class="kotak_dashboard">
        <center>
            <h3>Selamat Datang <?= $pengguna["level"]; ?></h3>
            <hr>
            <p>
                <a href="../logout.php" class="tombol_login">KELUAR</a>
        </center>
        </p>
    </div>
</body>

</html>