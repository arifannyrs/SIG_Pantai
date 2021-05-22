<?php
	include('../koneksi.php');
	include('../proses.php');

	include('../header.php');
?>
<section class="content">
	<h2 class="ui header">Perbandingan Kriteria</h2>
	<?php showTabelPerbandingan('kriteria','kriteria'); ?>
</section>

<?php include('../footer.php'); ?>