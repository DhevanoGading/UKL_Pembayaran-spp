<?php
require_once("require.php");
$id = $_GET['id'];
$petugas = mysqli_query($db, "SELECT * FROM petugas WHERE id_petugas='$id'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit data Petugas</title>
</head>
<body>
    <!-- Panggil header -->
    <?php require("header.php"); ?>
    <!-- Konten -->
    <h3>Edit data Petugas</h3>
<?php
while($row = mysqli_fetch_assoc($petugas)){?>
    <form action="" method="POST">
        <table cellpadding="5">
            <input type="hidden" name="id" value="<?= $row['id_petugas']; ?>">
            <tr>
                <td>Username :</td>
                <td><input type="text" name="user" value="<?= $row['username']; ?>"></td>
            </tr>
            <tr>
                <td>Password :</td>
                <td><input type="text" name="pass" value="<?= $row['password']; ?>"></td>
            </tr>
            <tr>
                <td>Nama Petugas :</td>
                <td><input type="text" name="nama" value="<?= $row['nama_petugas']; ?>"></td>
            </tr>
            <tr>
                <td colspan="2"><button type="submit" name="simpan">Simpan</button></td>
            </tr>
        </table>
    </form>
<?php } ?>
<hr />
    <!-- Panggil footer -->
    <?php require("footer.php"); ?>
</body>
</html>
<?php
// Proses update
if(isset($_POST['simpan'])){
    $id = $_POST['id'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $nama = $_POST['nama'];
    $update = mysqli_query($db, "UPDATE petugas SET username='$user',
                                 password='$pass', nama_petugas='$nama'
                                 WHERE petugas.id_petugas='$id'");
        if($update){
            echo "<script>alert('update Petugas Sukses');location.href='petugas.php'</script>";
        }else{
            echo "<script>alert('Gagal'); </script>";
        }
}
?>