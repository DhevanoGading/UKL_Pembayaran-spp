<?php
require_once("require.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kelas</title>
</head>
<body>
    <!-- Panggil header -->
    <?php require("header.php"); ?>
    <!-- Konten -->
    <h3>Tambah Kelas</h3>
    <form action="" method="POST">
        <table cellpadding="5">
            <tr>
                <td>Nama Kelas :</td>
                <td><input type="text" name="nama"></td>
            </tr>
            <tr>
                <td>Kompetensi Keahlian :</td>
                <td><input type="text" name="kk"></td>
            </tr>
            <tr>
                <td colspan="2"><button type="submit" name="simpan">Simpan</button></td>
            </tr>
        </table>
    </form>
<hr />
            <!-- Panggil footer -->
    <?php require("footer.php"); ?>
</body>
</html>
<?php
// Proses Simpan
if(isset($_POST['simpan'])){
    $nama = $_POST['nama'];
    $kk = $_POST['kk'];
    $simpan = mysqli_query($db, "INSERT INTO kelas VALUES(NULL, '$nama', '$kk')");
        if($simpan){
            echo "<script>alert('Tambah Kelas Sukses');location.href='kelas.php'</script>";
        }else{
            echo "<script>alert('Data sudah ada');</script>";
        }
}
?>