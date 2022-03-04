<?php
session_start();
require_once("koneksi.php");
// Jika sesi dari login belum dibuat maka akan kita kembalikan ke halaman login
if(!isset($_SESSION['nisn'])){
    header("location: login_siswa.php");
}else{
    // Jika sudah dibuatkan sesi maka akan kita masukkan kedalam variabel
    $nisn = $_SESSION['nisn'];
}
$siswa = mysqli_query($db, "SELECT * FROM siswa 
JOIN kelas ON siswa.id_kelas=kelas.id_kelas 
WHERE nisn='$nisn'");
$result = mysqli_fetch_assoc($siswa);
$pembayaran = mysqli_query($db, "SELECT * FROM pembayaran 
JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas 
JOIN spp ON pembayaran.id_spp = spp.id_spp
WHERE nisn='$nisn'
ORDER BY tgl_bayar");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Halaman Utama</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<div class="p-3 mb-2 bg-primary text-white">
<nav class="navbar navbar-expand-lg navbar-light bg-light rounded-pill">
  <div class="container-fluid">
    <a class="navbar-brand" href="index_siswa.php">Pembayaran SPP</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="#biodata">Biodata</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#history">History Pembayaran</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="logout.php">LogOut</a>
        </li>
        </li>
      </ul>
    </div>
  </div>
</nav>
<br>
<center>
    <h2>Selamat Datang, <?= $result['nama']; ?></h2>
    <h3>Biodata Kamu</h3>
</center>
</div>
<center>
<table cellpadding="5" id="biodata">
<tr>
<td>NISN</td>
<td>:</td>
<td><?= $result['nisn']; ?></td>
</tr>
<tr>
<td>NIS</td>
<td>:</td>
<td><?= $result['nis']; ?></td>
</tr>
<tr>
<td>Nama</td>
<td>:</td>
<td><?= $result['nama']; ?></td>
</tr>
<tr>
<td>Kelas</td>
<td>:</td>
<td><?= $result['nama_kelas'] . " | " . $result['kompetensi_keahlian']; ?></td>
</tr>
<tr>
<td>Alamat</td>
<td>:</td>
<td><?= $result['alamat']; ?></td>
</tr>
</table>
<hr />
<p><h2>History Pembayaran Kamu</p></h2>
</center>
    <table id="history" class="table table-primary table-striped table-hover">
        <tr>
            <td>No. </td>
            <td>Dibayarkan kepada</td>
            <td>Tgl. Pembayaran</td>
            <td>Tahun | Nominal yang harus dibayar</td>
            <td>Jumlah yang dibayarkan</td>
            <td>Status</td>
        </tr>
<?php
$no = 1;
while($r = mysqli_fetch_assoc($pembayaran)){ ?>
        <tr>
            <td><?= $no; ?></td>
            <td><?= $r['nama_petugas']; ?></td>
            <td><?= $r['tgl_bayar'] . "/" . $r['bulan_dibayar'] . "/" . $r['tahun_dibayar']; ?></td>
            <td><?= $r['tahun'] . " | Rp. " . $r['nominal']; ?></td>
            <td><?= $r['jumlah_bayar']; ?></td>
            <td>
<?php
// Jika jumlah bayar sesuai dengan yang harus dibayar maka Status LUNAS
if($r['jumlah_bayar'] == $r['nominal']){ ?>
                <font style="color: darkgreen; font-weight: bold;">LUNAS</font>
<?php }else{ ?>                             BELUM LUNAS <?php } ?> </td>
        </tr>
    <?php $no++; } ?>
    </table>
            <hr />
</body>
</html>