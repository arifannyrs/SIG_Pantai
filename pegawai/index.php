
<?php
include('../koneksi.php');
include('fungsi.php');
include('ceklogin.php');
include('../proses.php');

// header
include('../header.php');

?>

<section class="content">
			<h2 class="ui header">Selamat Datang <?= $pengguna["level"]; ?>! </h2>

	</section>

<?php include('../footer.php'); ?>
