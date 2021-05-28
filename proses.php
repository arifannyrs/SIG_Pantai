<!-- Proses Login -->
<?php
// Script jika tombol login diklik
if (isset($_POST["login"])) {

	//mengecek value data yang di kirimkan dari form login, ada yg kosong atau tidak
	if ($_POST["username"] == "" | $_POST["password"] == "") {
		echo '<script>
            alert("Jangan ada yang kosong !");
            window.location="' . $base_url . '/index.php";
            </script>';
		return false;
	}

	//Jika semua value data dari form login sudah benar atau tidak ada yang kosong script dibawah dapat dijalankan.
	$name = htmlspecialchars($_POST['username']);
	$password = md5($_POST['password']);

	//mengecek apakah ada data username pengguna login di dalam table login didatabase
	$login = mysqli_query($koneksi, "SELECT * FROM login WHERE username='$name'");

	//jika datanya ada
	if (mysqli_num_rows($login) === 1) {

		//ambil data tersebut ke dalam variabel data
		$data = mysqli_fetch_assoc($login);

		//jika password sama dan levelnya == admin
		if ($password == $data["password"] && $data["level"] == "admin") {
			$_SESSION["username"] = $data["username"]; //buat session username
			$_SESSION["level"] = $data["level"]; //buat session level
			header('Location: ' . $base_url . '/admin/'); //redirect kehalaman admin.

			//jika password sama dan levelnya == pegawai 
		} else if ($password == $data["password"] && $data["level"] == "pegawai") {
			$_SESSION["username"] = $data["username"]; //buat session username
			$_SESSION["level"] = $data["level"]; //buat session level
			header('Location: ' . $base_url . '/pegawai/'); //redirect kehalaman pegawai.

			//jika password sama dan levelnya == pengunjung
		} else if ($password == $data["password"] && $data["level"] == "pengunjung") {
			$_SESSION["username"] = $data["username"]; //buat session username
			$_SESSION["level"] = $data["level"]; //buat session level
			header('Location: ' . $base_url . '/pengunjung/'); //redirect kehalaman pengunjung.

			//jika password tidak sama, dan level pengguna == admin atau level pengguna == pegawai atau level pengguna == pengunjung
		} else if ($password != $data["password"] && $data["level"] == "admin" | $data["level"] == "pegawai" | $data["level"] == "pengunjung") {
			//tampilkan notif ini, lalu redirect kembali ke halaman index.php atau ke form login.
			echo '<script>
                    alert("Username Atau Password Salah !");
                    window.location="' . $base_url . '/index.php";
                </script>';
			return false; //hentikan proses sampai sini.
		}

		//jika tidak ada data username dalam table login
	} else {
		//maka tampil notif dan redirect langsung ke halaman index.php atau form login
		echo '<script>
                    alert("Akun Tidak Ada Dalam Database !");
                    window.location="' . $base_url . '/index.php";
            </script>';
		return false;
	}
}

// Proses daftar user

//cek jika tombol register di klik
//maka jalankan script ini.
if (isset($_POST["register"])) {
	//cek value data yg dikirimkan dari form login, jika salah satu ada yg kosong
	if ($_POST["email"] == "" | $_POST["username"] == "" | $_POST["password"] == "") {
		//maka tampilkan notif dan lalu redirect kembali ke halaman register.
		echo '<script>
                alert("Jangan ada yang kosong !");
                windows.location="' . $base_url . '/register.php";
            </script>';
		return false; //hentikan proses sampai sini.
	}

	//Jika semua value data dari form register sudah benar atau salah satu tidak ada yang kosong
	//maka jalankan script ini.
	$email = $_POST["email"]; // $email yg di isi dng value email dari form register
	$username = $_POST["username"]; // $username yg di isi dng value username dari form register
	$password = md5($_POST["password"]); // $password yg di isi dng value password dari form register

	//cek adakah email si pengguna di table login.
	$cek = mysqli_query($koneksi, "SELECT * FROM login WHERE email='$email'");
	//jika hasil 1 artinya email si pengguna register sudah ada di table login
	if (mysqli_num_rows($cek) === 1) {
		//maka tampilkan notif ini
		echo '<script>
                 alert("Email ini sudah terdaftar, silahkan coba dengan email lain !");
                 window.location="' . $base_url . '/register.php";
             </script>';
		return false; //hentikan proses sampai sini.
	}

	//jika email si pengguna register tidak ada dlm table login
	//maka jalankan aksi penyimpanan data baru ke table login.
	$save = mysqli_query($koneksi, "INSERT INTO login(username,email,password) VALUES('$username', '$email', '$password')");
	//cek proses penyimpanan berhasil atau tidak
	//jika true artinya berhasil
	if ($save === true) {
		//maka tampilkan notif ini
		//lalu redirect ke halaman index.php atau halaman login.
		echo '<script>
                 alert("Selamat Daftar Berhasil...");
                 window.location="' . $base_url . '/index.php"; 
              </script>';
	} else {
		//jika proses gagal, tampilkan notif ini lalu redirect kembali ke halaman register.
		echo '<script>
                 alert("Maaf Daftar Gagal !");
                 window.location="' . $base_url . '/register.php";
              </script>';
		return false;
	}
}

// Proses menampilkan level
if (isset($_SESSION["username"])) {
	$username = $_SESSION["username"]; //$username isi dng session username.
	//cocokan data pengguna berdasarkan $username.
	$data = mysqli_query($koneksi, "SELECT * FROM login WHERE username='$username'");
	//ambil data hasil pencocokan.
	$pengguna = mysqli_fetch_assoc($data);

	//data ini hanya untuk level admin
	if ($_SESSION["level"] == "admin") {
		//hitung semua pengguna
		$count = mysqli_query($koneksi, "SELECT * FROM login ORDER BY id DESC");
		$totalPengguna = mysqli_num_rows($count); //total pengguna
		//hitung semua admin
		$count = mysqli_query($koneksi, "SELECT * FROM login WHERE level='admin'");
		$totalAdmin = mysqli_num_rows($count); //total admin
		//hitung semua pengunjung
		$count = mysqli_query($koneksi, "SELECT * FROM login WHERE level='pegawai'");
		$totalPegawai = mysqli_num_rows($count); //total pegawai

		$count = mysqli_query($koneksi, "SELECT * FROM login WHERE level='pengunjung'");
		$totalPengunjung = mysqli_num_rows($count); //total pengunjung
	}
}

// Proses Tambah Pengguna oleh Admin
if (isset($_POST["tambah_pengguna"])) {
	if ($_POST["email"] == "" | $_POST["username"] == "" | $_POST["password"] == "" | $_POST["level"] == "") {
		echo '<script>
              alert("Jangan ada yang kosong !");
              windows.location="' . $base_url . '/admin/tambah-pengguna.php.php";
             </script>';
		return false;
	}
	$email = $_POST["email"];
	$level = $_POST["level"];
	$username = $_POST["username"];
	$password = md5($_POST["password"]);
	//cek
	$cek = mysqli_query($koneksi, "SELECT * FROM login WHERE email='$email'");
	if (mysqli_num_rows($cek) === 1) {
		echo '<script>
                 alert("Email ini sudah terdaftar, silahkan coba dengan email lain !");
                 window.location="' . $base_url . '/admin/tambah-pengguna.php";
              </script>';
		return false;
	}

	//Menyimpan data ke tabel login
	$save = mysqli_query($koneksi, "INSERT INTO login(username,email,password,level) VALUES('$username', '$email', '$password', '$level')");
	if ($save === true) {
		echo '<script>
                 alert("Pengguna Baru Berhasil Ditambahkan...");
                 window.location="' . $base_url . '/admin/data-pengguna.php";
              </script>';
	} else {
		echo '<script>
                 alert("Pengguna Baru Gagal Ditambahkan !");
                 window.location="' . $base_url . '/admin/tambah-pengguna.php";
              </script>';
		return false;
	}
}

//Proses edit pengguna
if (isset($_POST["edit_pengguna"])) {
	$id = $_POST["id"];
	$username = $_POST["username"];
	$email = $_POST["email"];
	$password = md5($_POST["password"]);
	
	//Menyimpan data ke tabel login
	$save = mysqli_query($koneksi,"UPDATE login SET username='$username', email='$email', password='$password' where id='$id'");
	if ($save === true) {
		echo '<script>
                 alert("Pengguna Baru Berhasil Ditambahkan...");
                 window.location="' . $base_url . '/admin/data-pengguna.php";
              </script>';
	} else {
		echo '<script>
                 alert("Pengguna Baru Gagal Ditambahkan !");
                 window.location="' . $base_url . '/admin/edit.php";
              </script>';
		return false;
	}
}

//Proses Hapus Pengguna
if (isset($_POST["hapus_pengguna"])) {
	$id = $_GET["id"];

	$cek = mysqli_query($koneksi, "SELECT * FROM login WHERE id='$id'");
	if (mysqli_num_rows($cek) === 1) {
		echo '<script>
                 alert("Nama tidak terdaftar, silahkan coba dengan email lain !");
                 window.location="' . $base_url . '/admin/data-pengguna.php";
              </script>';
		return false;
	}
}

if (isset($_POST['submit'])) {
	$jenis = $_POST['jenis'];

	// jumlah kriteria
	if ($jenis == 'kriteria') {
		$n		= getJumlahKriteria();
	} else {
		$n		= getJumlahAlternatif();
	}

	// memetakan nilai ke dalam bentuk matrik
	// x = baris
	// y = kolom
	$matrik = array();
	$urut 	= 0;

	for ($x = 0; $x <= ($n - 2); $x++) {
		for ($y = ($x + 1); $y <= ($n - 1); $y++) {
			$urut++;
			$pilih	= "pilih" . $urut;
			$bobot 	= "bobot" . $urut;
			if ($_POST[$pilih] == 1) {
				$matrik[$x][$y] = $_POST[$bobot];
				$matrik[$y][$x] = 1 / $_POST[$bobot];
			} else {
				$matrik[$x][$y] = 1 / $_POST[$bobot];
				$matrik[$y][$x] = $_POST[$bobot];
			}


			if ($jenis == 'kriteria') {
				inputDataPerbandinganKriteria($x, $y, $matrik[$x][$y]);
			} else {
				inputDataPerbandinganAlternatif($x, $y, ($jenis - 1), $matrik[$x][$y]);
			}
		}
	}

	// diagonal --> bernilai 1
	for ($i = 0; $i <= ($n - 1); $i++) {
		$matrik[$i][$i] = 1;
	}

	// inisialisasi jumlah tiap kolom dan baris kriteria
	$jmlmpb = array();
	$jmlmnk = array();
	for ($i = 0; $i <= ($n - 1); $i++) {
		$jmlmpb[$i] = 0;
		$jmlmnk[$i] = 0;
	}

	// menghitung jumlah pada kolom kriteria tabel perbandingan berpasangan
	for ($x = 0; $x <= ($n - 1); $x++) {
		for ($y = 0; $y <= ($n - 1); $y++) {
			$value		= $matrik[$x][$y];
			$jmlmpb[$y] += $value;
		}
	}


	// menghitung jumlah pada baris kriteria tabel nilai kriteria
	// matrikb merupakan matrik yang telah dinormalisasi
	for ($x = 0; $x <= ($n - 1); $x++) {
		for ($y = 0; $y <= ($n - 1); $y++) {
			$matrikb[$x][$y] = $matrik[$x][$y] / $jmlmpb[$y];
			$value	= $matrikb[$x][$y];
			$jmlmnk[$x] += $value;
		}

		// nilai priority vektor
		$pv[$x]	 = $jmlmnk[$x] / $n;

		// memasukkan nilai priority vektor ke dalam tabel pv_kriteria dan pv_alternatif
		if ($jenis == 'kriteria') {
			$id_kriteria = getKriteriaID($x);
			inputKriteriaPV($id_kriteria, $pv[$x]);
		} else {
			$id_kriteria	= getKriteriaID($jenis - 1);
			$id_alternatif	= getAlternatifID($x);
			inputAlternatifPV($id_alternatif, $id_kriteria, $pv[$x]);
		}
	}

	// cek konsistensi
	$eigenvektor = getEigenVector($jmlmpb, $jmlmnk, $n);
	$consIndex   = getConsIndex($jmlmpb, $jmlmnk, $n);
	$consRatio   = getConsRatio($jmlmpb, $jmlmnk, $n);

	if ($jenis == 'kriteria') {
		include('output.php');
	} else {
		include('bobot_hasil.php');
	}
}
?>