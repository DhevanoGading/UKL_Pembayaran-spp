<?php
require_once("require.php");
if($_SESSION['level'] === 'Petugas'){
    echo "<script>alert('Hak akses salah!');location.href='login.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD Data SPP</title>
</head>
<body>
    <div class="p-3 mb-2 bg-primary text-white">
    <!-- Panggil script header -->
    <?php require_once("header.php"); ?>
    <!-- Isi Konten -->
    <br>
        <center>
            <h3>SPP</h3>
            <p><a class="btn btn-success" href="tambah_spp.php">Tambah Data</a></p>
        </center>
    <table class="table table-success table-striped table-hover">
        <tr>
            <td><b>No. </b></td>
            <td><b>Tahun</b></td>
            <td><b>Nominal</b?</td>
            <td><b>Aksi</b></td>
        </tr>
<?php
// Kita Konfigurasi Pagging disini
$totalDataHalaman = 5;
$data = mysqli_query($db, "SELECT * FROM spp");
$hitung = mysqli_num_rows($data);
$totalHalaman = ceil($hitung / $totalDataHalaman);
$halAktif = (isset($_GET['hal'])) ? $_GET['hal'] : 1;
$dataAwal = ($totalDataHalaman * $halAktif) - $totalDataHalaman;
// Konfigurasi Selesai
// Kita panggil tabel spp
$sql = mysqli_query($db, "SELECT * FROM spp ORDER BY tahun ASC LIMIT $dataAwal, $totalDataHalaman");
$no = 1;
while($r = mysqli_fetch_assoc($sql)){ ?>
        <tr>
            <td><?= $no ?></td>
            <td><?= $r['tahun']; ?></td>
            <td><?= "Rp. " . $r['nominal']; ?></td>
            <td><a class="btn btn-danger" href="?hapus&id=<?= $r['id_spp']; ?>">Hapus</a> | 
                <a class="btn btn-info" href="edit_spp.php?id=<?= $r['id_spp']; ?>">Edit</a</td>
        </tr>
<?php $no++; } ?>
    </table>
<!-- Tampilkan tombol halaman -->
<?php for($i=1; $i <= $totalHalaman; $i++): ?>
        <a class="btn btn-warning" href="?hal=<?= $i; ?>"><?= $i; ?></a>
<?php endfor; ?>
<!-- Selesai -->
<br>
</div>
</body>
</html>
<?php
// Tombol Hapus ditekan
if(isset($_GET['hapus'])){
    $id = $_GET['id'];
    $hapus = mysqli_query($db, "DELETE FROM spp WHERE id_spp='$id'");
    if($hapus){
        echo "<script>alert('Hapus SPP Sukses');location.href='spp.php'</script>";
    }else{
        echo "<script>alert('Maaf, data tersebut masih terhubung dengan data yang lain');
        </script>";
    }
}
?>