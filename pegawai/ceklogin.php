<?php

if (!isset($_SESSION)) {
	session_start();
}

if (!isset($_SESSION["username"])) {
	echo '<script>
				  alert("Mohon login dahulu !");
				  window.location="../index.php";
			   </script>';
	return false;
}

if ($_SESSION["level"] != "pegawai") {
	echo '<script>
				  alert("Maaf Anda Tidak Berhak Ke Halaman ini !");
				  window.location="../' . $_SESSION["level"] . '/";
			   </script>';
	return false;
}
