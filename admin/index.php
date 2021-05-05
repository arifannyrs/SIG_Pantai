<?php
session_start();
include("../koneksi.php");
include("../proses.php");

if (!isset($_SESSION["username"])) {
  echo '<script>
                alert("Mohon login dahulu !");
                window.location="../index.php";
             </script>';
  return false;
}

if ($_SESSION["level"] != "admin") {
  echo '<script>
                alert("Maaf Anda Tidak Berhak Ke Halaman ini !");
                window.location="../' . $_SESSION["level"] . '/";
             </script>';
  return false;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>SIG PANTAI</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>

<body>

    <p>
        <center>
            <img src='../img/Kabupaten.png' width='120' height='140'></a>
        </center>

    <h1>Sistem Informasi Geografis Pemetaan Objek Wisata Pantai
        <br /> Kecamatan Tanggunggunung Kabupaten Tulungagung
    </h1>

    <div class="kotak_dashboard">
        <h3 align="center">Selamat Datang <?= $pengguna["level"]; ?></h3>
        <hr>
        <p class="centered">
            <a href="data-pengguna.php" class="tombol_login">DATA PENGGUNA</a>
            <a href="tambah-pengguna.php" class="tombol_login">TAMBAH PENGGUNA</a>
            <a href="../logout.php" class="tombol_keluar">KELUAR</a>
        </p>

        <hr>
        <div class="tulisan_login">
            Grafik Data
        </div>
        <div class="box-chart">
            <ul class="list-chart">
                <li class="bg-black" style="height: <?= $totalPengguna * 10; ?>px;"><span class="detail-chart">Total
                        Data:
                        <?= $totalPengguna; ?></span></li>
                <li class="bg-orange" style="height: <?= $totalAdmin * 10; ?>px;"><span class="detail-chart">Total Data:
                        <?= $totalAdmin; ?></span></li>
                <li class="bg-red" style="height: <?= $totalPegawai * 10; ?>px;"><span class="detail-chart">Total Data:
                        <?= $totalPegawai; ?></span></li>
                <li class="bg-ungu" style="height: <?= $totalPengunjung * 10; ?>px;"><span class="detail-chart">Total
                        Data:
                        <?= $totalPengunjung; ?></span></li>
            </ul>

            <ul>
                <li class="legend-title">Pengguna</li>
                <li class="legend-title">Admin</li>
                <li class="legend-title">Pegawai</li>
                <li class="legend-title">Pengunjung</li>
            </ul>
        </div>
    </div>

    </div>
    </div>
</body>

</html>