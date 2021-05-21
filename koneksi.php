<?php
	// connection
	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$db   = 'sig_pantai';

	$koneksi = mysqli_connect($host,$user,$pass);

	if (!$koneksi)
	{
		echo "Tidak dapat terkoneksi dengan server";
		exit();
	}

	if(!mysqli_select_db($koneksi, $db))
	{
		echo "Tidak dapat menemukan database";
		exit();
	}
    $base_url = "http://localhost:8080/sig_pantai/";
?>