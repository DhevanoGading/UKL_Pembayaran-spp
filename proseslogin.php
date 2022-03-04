<?php
session_start();
require_once("koneksi.php");
// Kita akan membuat proses login nya disini
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cari = mysqli_query($db, "SELECT * FROM petugas WHERE username='$username'");
    $hasil = mysqli_fetch_assoc($cari);
        // Jika data yang dicari kosong
        if(mysqli_num_rows($cari) == 0){
            echo "<center>Username belum terdaftar! <a href='login.php'>Kembali!</a></center>";
        }else{
            // Jika password tidak sesuai dengan yang ada di database
            if($hasil['password'] <> $password){
                echo "<center>Password salah! <a href='login.php'>Kembali!</a></center>";
            }else{
                // Jika user sesuai dengan database maka akan redirect ke halaman utama dan akan dibuatkan sesi
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['level'] = $hasil['level'];
                header("location: index.php");
            }
        }
}
?>