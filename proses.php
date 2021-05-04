<!-- Proses Login -->
<?php
// Script jika tombol login diklik
if(isset($_POST["login"])){

    //mengecek value data yang di kirimkan dari form login, ada yg kosong atau tidak
    if($_POST["username"] == "" | $_POST["password"] == ""){
        echo'<script>
            alert("Jangan ada yang kosong !");
            window.location="'.$base_url.'/index.php";
            </script>';
        return false;
    }
    
    //Jika semua value data dari form login sudah benar atau tidak ada yang kosong script dibawah dapat dijalankan.
    $name = htmlspecialchars($_POST['username']);
    $password = md5($_POST['password']);
    
    //mengecek apakah ada data username pengguna login di dalam table login didatabase
    $login = mysqli_query($conn,"SELECT * FROM login WHERE username='$name'");
    
    //jika datanya ada
    if(mysqli_num_rows($login) ===1){
    
    //ambil data tersebut ke dalam variabel data
    $data = mysqli_fetch_assoc($login);    
    
    //cek jika password sama dan levelnya == admin
    if($password == $data["password"] && $data["level"] == "admin"){
        $_SESSION["username"] = $data["username"]; //buat session username
     	$_SESSION["level"] = $data["level"]; //buat session level
        header('Location: '.$base_url.'/admin/'); //redirect kehalaman admin.

    //jika password tidak sama, dan level pengguna == admin atau level pengguna == pengunjung
    }else if($password != $data["password"] && $data["level"] == "admin" | $data["level"] == "pegawai"| $data["level"] == "pengunjung"){
        //tampilkan notif ini, lalu redirect kembali ke halaman index.php atau ke form login.
            echo'<script>
                    alert("Nama Atau Password Salah !");
                    window.location="'.$base_url.'/index.php";
                </script>';
            return false; //hentikan proses sampai sini.
        }

    //jika tidak ada data username dalam table login
    }else{
        //maka tampil notif dan redirect langsung ke halaman index.php atau form login
        echo'<script>
                    alert("Akun Tidak Ada Dalam Database !");
                    window.location="'.$base_url.'/index.php";
            </script>';
        return false;
    }
}