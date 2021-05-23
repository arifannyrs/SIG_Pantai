<?php 
	session_start();
	include('../koneksi.php');
	include('../proses.php');

	if(!isset($_SESSION["username"])){
		echo'<script>
				  alert("Mohon login dahulu !");
				  window.location="../index.php";
			   </script>';
		return false;
	}
  
	if($_SESSION["level"] != "admin"){
		  echo'<script>
				  alert("Maaf Anda Tidak Berhak Ke Halaman ini !");
				  window.location="../'.$_SESSION["level"].'/";
			   </script>';
		  return false;
	}

	include('../user.php');
?>

<section class="content">
    <h2 class="ui header">Data Pengguna</h2>

    <table class="ui celled table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Level</th>
				<th>Password</th>
                <th>Tanggal Daftar</th>
            </tr>
        </thead>
        <tbody>

            <?php
                       $no = 1;
                       $pg = mysqli_query($koneksi,"SELECT * FROM login ORDER BY id DESC");
                       $jumlahPengguna = mysqli_num_rows($pg);
                       while ($val = mysqli_fetch_assoc($pg)) {
                    ?>
            <tr>
                <td><?=$no;?>.</b></td>
                <td><?=$val["username"];?></td>
                <td><?=$val["email"];?></td>
                <td><?=$val["level"];?></td>
                <td><?=$val["password"];?></td>
				<td><?=$val["date"];?></td>
				<td class="right aligned collapsing">
					<form method="post" action="kriteria.php">
						<input type="hidden" name="id" value="<?php echo $row['id'] ?>">
						<button type="submit" name="edit" class="ui mini teal left labeled icon button"><i class="right edit icon"></i>EDIT</button>
						<button type="submit" name="delete" class="ui mini red left labeled icon button"><i class="right remove icon"></i>DELETE</button>
					</form>
				</td>
			</tr>
            <?php $no++; } ?>
        </tbody>
        <tfoot class="full-width">
            <tr>
                <th colspan="3">
                    <a href="tambah-pengguna.php">
                        <div class="ui right floated small primary labeled icon button">
                            <i class="plus icon"></i>Tambah
                        </div>
                    </a>
                </th>
            </tr>
        </tfoot>
    </table>

    <br>

</section>

<?php include('../footer.php'); ?>