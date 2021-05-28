<?php
//memulai session
session_start();
//cek jika sebelumnya sudah ada session level
//maka redirect ke halaman berdasarkan level si pengguna.
if (isset($_SESSION["level"])) {
    header('Location: ./' . $_SESSION["level"] . '/');
}

//include koneksi database
include("koneksi.php");
//include proses untuk merespon dari masing-masing action
include("proses.php");
?>

<!DOCTYPE html>
<html>

<head>
    <title>SIG PANTAI</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>

<body>

    <p>
        <center>
            <img src='./img/logo.png' width='120' height='140'></a>
        </center>

    <h1>Sistem Informasi Geografis Pemetaan Potensi<br /> Objek Wisata Pantai di Kabupaten Tulungagung</h1>

    <div class="kotak_login">
        <p class="tulisan_login">Silahkan Daftar</p>
        <form action="" method="post">
            <label>Username</label>
            <input type="text" name="username" class="form_login" placeholder="Username .." required="required">

            <label>Email</label>
            <input type="email" name="email" class="form_login" placeholder="Alamat Email .." required="required">

            <label>Password</label>
            <input type="password" name="password" class="form_login" placeholder="Password .." required="required">

            <button type="submit" name="register" class="tombol_login">DAFTAR</button>
        </form>
        <p>
            Kembali ke <a href="index.php">Login</a>
        </p>
    </div>
    </div>
    </div>
</body>

</html>