<?php
	include('../koneksi.php');
	include('fungsi.php');
	include('ceklogin.php');
	$jenis = $_GET['c'];

	include('../header.php');
?>
<section class="content">
	<h2 class="ui header">Perbandingan Alternatif &rarr; <?php echo getKriteriaNama($jenis-1) ?></h2>
	<?php showTabelPerbandingan($jenis,'alternatif'); ?>
</section>

<?php include('../footer.php'); ?>