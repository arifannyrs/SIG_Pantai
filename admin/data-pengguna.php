<?php 
	include('./ceklogin.php');
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
					<form method="post" action="data-pengguna.php">
                        <a href="edit.php?id=<?php echo $val['id']; ?>" name="edit_pengguna" class="ui mini teal left labeled icon button"><i class="right edit icon"></i>EDIT</a>
						<a href="hapus.php?id=<?php echo $val['id']; ?>" name="hapus_pengguna" class="ui mini red left labeled icon button"><i class="right remove icon"></i>HAPUS</button>
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