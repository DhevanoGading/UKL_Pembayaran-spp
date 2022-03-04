<?php
require_once("require.php");
// session_start();
if($_SESSION['level'] === 'Petugas'){
    echo "<script>alert('Hak akses salah!');location.href='login.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD Data Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div class="p-3 mb-2 bg-primary text-white" >
        <!-- Panggil script header -->
        <?php require_once("header.php"); ?>
        <!-- Isi Konten -->
        <div class="p-3 mb-2 bg-primary text-white">
            <center>
                <h3>Petugas</h3>
                <p><a class="btn btn-success" href="tambah_petugas.php">Tambah Data</a></p>
            </center>
        </div>
        <table class="table table-success table-striped table-hover">
            <tr>
                <td><b>No. </b></td>
                <td><b>Username</b></td>
                <td><b>Password</b></td>
                <td><b>Nama Petugas</b></td>
                <td><b>Level</b></td>
                <td><b>Aksi</b></td>
            </tr>
    <?php
    // Kita buat konfigurasi pagging
    $jmlhDataHal = 5;
    $data = mysqli_query($db, "SELECT * FROM petugas");
    $jmlhData = mysqli_num_rows($data);
    $jmlhHal = ceil($jmlhData / $jmlhDataHal);
    $halAktif = (isset($_GET['hal'])) ? $_GET['hal'] : 1;
    $dataAwal = ($jmlhData * $halAktif) - $jmlhData;
    // Konfigurasi Selesai
    // Kita panggil tabel petugas
    $sql = mysqli_query($db, "SELECT * FROM petugas LIMIT $dataAwal, $jmlhDataHal");
    $no = 1;
    while($r = mysqli_fetch_assoc($sql)){ ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $r['username']; ?></td>
                <td><?= $r['password']; ?></td>
                <td><?= $r['nama_petugas']; ?></td>
                <td><?= $r['level']; ?></td>
                <td><a class="btn btn-danger" href="?hapus&id=<?= $r['id_petugas']; ?>">Hapus</a> | 
                    <a class="btn btn-info" href="edit_petugas.php?id=<?= $r['id_petugas']; ?>">Edit</a</td>
            </tr>
    <?php $no++; } ?>
        </table>
    <!-- Sekarang kita buat tombol halamannya -->
    <?php for($i=1; $i <= $jmlhHal; $i++): ?>
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
    $hapus = mysqli_query($db, "DELETE FROM petugas WHERE id_petugas='$id'");
    if($hapus){
        echo "<script>alert('Hapus Petugas Sukses');location.href='petugas.php'</script>";
    }else{
        echo "<script>alert('Maaf, data tersebut masih terhubung dengan data yang lain');
        </script>";
    }
}
?>