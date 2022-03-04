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
    <title>CRUD Data Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div class="p-3 mb-2 bg-primary text-white">
        <!-- Panggil script header -->
        <?php require_once("header.php"); ?>
        <!-- Isi Konten -->
        <br>
            <center>
                <h3>Data Siswa</h3>
                <p><a class="btn btn-success" href="tambah_siswa.php">Tambah Data</a></p>
            </center>
        <table class="table table-success table-striped table-hover">
            <tr>
                <td><b>No. </b></td>
                <td><b>NISN</b></td>
                <td><b>NIS</b></td>
                <td><b>Nama Siswa</b></td>
                <td><b>Kelas</b.</td>
                <td><b>Alamat</b></td>
                <td><b>No. Telp</b></td>
                <td><b>Aksi</b></td>
            </tr>
    <?php
    // Kita Konfigurasi Pagging disini
    $totalDataHalaman = 5;
    $data = mysqli_query($db, "SELECT * FROM siswa");
    $hitung = mysqli_num_rows($data);
    $totalHalaman = ceil($hitung / $totalDataHalaman);
    $halAktif = (isset($_GET['hal'])) ? $_GET['hal'] : 1;
    $dataAwal = ($totalDataHalaman * $halAktif) - $totalDataHalaman;
    // Konfigurasi Selesai
    // Kita panggil tabel siswa
    // Setelah kita panggil, JOIN tabel yang ter relasi ke tabel siswa
    $sql = mysqli_query($db, "SELECT * FROM siswa
    JOIN kelas ON siswa.id_kelas = kelas.id_kelas
    ORDER BY nama LIMIT $dataAwal, $totalDataHalaman ");
    $no = 1;
    while($r = mysqli_fetch_assoc($sql)){ ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $r['nisn']; ?></td>
                <td><?= $r['nis']; ?></td>
                <td><?= $r['nama']; ?></td>
                <td><?= $r['nama_kelas'] . " | " . $r['kompetensi_keahlian']; ?></td>
                <td><?= $r['alamat']; ?></td>
                <td><?= $r['no_telp']; ?></td>
                <td><a class="btn btn-danger" href="?hapus&nisn=<?= $r['nisn']; ?>">Hapus</a> | 
                    <a class="btn btn-info" href="edit_siswa.php?nisn=<?= $r['nisn']; ?>">Edit</a</td>
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
    $nisn = $_GET['nisn'];
    $hapus = mysqli_query($db, "DELETE FROM siswa WHERE nisn='$nisn'");
    if($hapus){
        echo "<script>alert('Hapus Siswa Sukses');location.href='siswa.php'</script>";
    }else{
        echo "<script>alert('Maaf, data tersebut masih terhubung dengan data yang lain');
        </script>";
    }
}
?>