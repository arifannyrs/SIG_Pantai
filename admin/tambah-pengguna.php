<?php
    include('./ceklogin.php');
?>
<section class="content">
	<h2>Tambah Pengguna</h2>

	<form class="ui form" method="post" action="">
		<div class="inline field">
        <ul>
            <label>Username</label>
			<input type="text" name="username" placeholder="username">
        </ul>
        <ul>
            <label>Email</label>
			<input type="email" name="email" placeholder="email">
        </ul>
        <ul>
            <label>Level</label>
            <select name="level" required>
                <option disabled selected>-Silahkan Pilih Level-</option>
                <option value="pegawai">Pegawai</option>
                <option value="pengunjung">Pengunjung</option>
            </select>
        </ul>
        <ul>
            <label>Password</label>
			<input type="password" name="password" placeholder="password">
		</div>
        </ul>
		<ul>
        <br>
		<input class="ui green button" type="submit" name="tambah_pengguna" value="SIMPAN" href="data-pengguna.php">
        </ul>
    </form>
</section>

<?php include('../footer.php'); ?>