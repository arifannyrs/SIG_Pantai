<?php
  session_start();
  include("../koneksi.php");
  include("../proses.php");

  if(!isset($_SESSION["username"])){
      echo'<script>
                alert("Mohon login dahulu !");
                window.location="'.$base_url.'/";
             </script>';
      return false;
  }

  if($_SESSION["level"] != "pengunjung"){
        echo'<script>
                alert("Maaf Anda Tidak Berhak Ke Halaman ini !");
                window.location="'.$base_url.'/'.$_SESSION["level"].'/";
             </script>';
        return false;
  }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>SIG PANTAI</title>
        <link rel="stylesheet" type="text/css" href="../style.css">
    </head>
    <body>
        <p align="center"><a href="<?=$base_url;?>/logout.php" class="tombol_keluar">KELUAR</a></p>           
    </body>
</html>