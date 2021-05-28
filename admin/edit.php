<?php
    include('./ceklogin.php');
	$id = $_GET['id'];
	$data = mysqli_query($koneksi,"SELECT * FROM login WHERE id='$id'");
	while($val = mysqli_fetch_array($data)){
?>
<section class="content">
	<h2>Edit Pengguna</h2>

	<form class="ui form" method="post" action="">
		<div class="inline field">
        <ul>
            <label>Username</label>
			<input type="hidden" name="id" value="<?php echo $val['id'] ?>">
			<input type="text" name="username" value="<?php echo $val['username']; ?>">
        </ul>
        <ul>
            <label>Email</label>
			<input type="email" name="email" value="<?php echo $val['email']; ?>">
        </ul>
        <ul>
            <label>Password</label>
			<input type="password" name="password" value="<?php echo $val['password']; ?>">
		</div>
        </ul>
		<ul>
        <br>
		<input class="ui green button" type="submit" name="edit_pengguna" value="SIMPAN" href="data-pengguna.php">
        </ul>
    </form>
</section>

<?php include('../footer.php'); }?>