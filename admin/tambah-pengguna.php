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

    <div class="kotak_login">
        <p class="tulisan_login">Silahkan login</p>
        <form action="" method="post">
            <label>Username</label>
            <input type="text" name="username" class="form_login" placeholder="Username .." required="required">

            <label>Email</label>
            <input type="email" name="email" class="form_login" placeholder="Alamat Email .." required="required">

            <select name="level" class="form_login" required>
                <option disabled selected>-Silahkan Pilih Level-</option>
                <option value="admin">Admin</option>
                <option value="pegawai">Pegawai</option>
                <option value="pengunjung">Pengunjung</option>
            </select>

            <label>Password</label>
            <input type="password" name="password" class="form_login" placeholder="Password .." required="required">
            <button type="submit" name="tambah_pengguna" class="tombol_login">Tambah Pengguna</button>
        </form>

        <p>
            Kembali ke <a href="index.php">Dashboard</a>
        </p>
    </div>
    </div>
    </div>
</body>

</html>