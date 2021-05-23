<?php
	include('../koneksi.php');
	include('./fungsi.php');

	include('../ahp.php');
?>
<section class="content">
	<h2 class="ui header">Perbandingan Kriteria</h2>
	<?php showTabelPerbandingan('kriteria','kriteria'); ?>
</section>

<?php include('../footer.php'); ?>