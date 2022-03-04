<?php
require_once("require.php");
$id = $_GET['id'];
$spp = mysqli_query($db, "SELECT * FROM spp WHERE id_spp='$id'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit data SPP</title>
</head>
<body>
    <!-- Panggil header -->
    <?php require("header.php"); ?>
    <!-- Konten -->
    <h3>Edit data SPP</h3>
<?php
while($row = mysqli_fetch_assoc($spp)){?>
    <form action="" method="POST">
        <table cellpadding="5">
            <input type="hidden" name="id" value="<?= $row['id_spp']; ?>">
            <tr>
                <td>Tahun :</td>
                <td><input type="text" name="tahun" value="<?= $row['tahun']; ?>"></td>
            </tr>
            <tr>
                <td>Nominal :</td>
                <td><input type="text" name="nominal" value="<?= $row['nominal']; ?>"></td>
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
    $tahun = $_POST['tahun'];
    $nominal = $_POST['nominal'];
    $update = mysqli_query($db, "UPDATE spp SET tahun='$tahun', nominal='$nominal'
                                 WHERE spp.id_spp='$id'");
        if($update){
            echo "<script>alert('Update SPP Sukses');location.href='spp.php'</script>";
        }else{
            echo "<script>alert('Gagal'); </script>";
        }
}
?>