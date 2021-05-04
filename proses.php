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
     	//jika password sama dan levelnya == pengunjung
    }else if($password == $data["password"] && $data["level"] == "pengunjung"){
        $_SESSION["username"] = $data["username"]; //buat session username
        $_SESSION["level"] = $data["level"]; //buat session level
        header('Location: '.$base_url.'/pengunjung/'); //redirect kehalaman pengunjung.

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

// Proses daftar user

//cek jika tombol register di klik
//maka jalankan script ini.
if(isset($_POST["register"])){
    //cek value data yg dikirimkan dari form login, jika salah satu ada yg kosong
    if($_POST["email"] =="" | $_POST["username"] == "" | $_POST["password"] == ""){
       //maka tampilkan notif dan lalu redirect kembali ke halaman register.
        echo'<script>
                alert("Jangan ada yang kosong !");
                windows.location="'.$base_url.'/register.php";
            </script>';
        return false;//hentikan proses sampai sini.
    }

    //Jika semua value data dari form register sudah benar atau salah satu tidak ada yang kosong
    //maka jalankan script ini.
    $email = $_POST["email"]; // $email yg di isi dng value email dari form register
    $username = $_POST["username"]; // $username yg di isi dng value username dari form register
    $password = md5($_POST["password"]); // $password yg di isi dng value password dari form register
   
    //cek adakah email si pengguna di table login.
    $cek = mysqli_query($conn,"SELECT * FROM login WHERE email='$email'");
    //jika hasil 1 artinya email si pengguna register sudah ada di table login
    if(mysqli_num_rows($cek) === 1){
       //maka tampilkan notif ini
       echo'<script>
                 alert("Email ini sudah terdaftar, silahkan coba dengan email lain !");
                 window.location="'.$base_url.'/register.php";
             </script>';
         return false; //hentikan proses sampai sini.
    }
 
    //jika email si pengguna register tidak ada dlm table login
    //maka jalankan aksi penyimpanan data baru ke table login.
    $save = mysqli_query($conn,"INSERT INTO login(username,email,password) VALUES('$username', '$email', '$password')");
    //cek proses penyimpanan berhasil atau tidak
    //jika true artinya berhasil
    if ($save === true) {
         //maka tampilkan notif ini
         //lalu redirect ke halaman index.php atau halaman login.
         echo'<script>
                 alert("Registrasi Berhasil...");
                 window.location="'.$base_url.'/index.php"; 
              </script>';
    }else{
          //jika proses gagal, tampilkan notif ini lalu redirect kembali ke halaman register.
          echo'<script>
                 alert("Registrasi Gagal !");
                 window.location="'.$base_url.'/register.php";
              </script>';
         return false;
    }
}