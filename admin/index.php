<?php
session_start();
include("../koneksi.php");
include("./fungsi.php");
include("../header.php");


if (!isset($_SESSION["username"])) {
    echo '<script>
                alert("Mohon login dahulu !");
                window.location="../index.php";
             </script>';
    return false;
}

if ($_SESSION["level"] != "admin") {
    echo '<script>
                alert("Maaf Anda Tidak Berhak Ke Halaman ini !");
                window.location="../' . $_SESSION["level"] . '/";
             </script>';
    return false;
}
?>

<?php include("../footer.php"); ?>