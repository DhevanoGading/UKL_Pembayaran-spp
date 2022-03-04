<?php
require_once("require.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Entry Transaksi</title>
</head>
<body>
    <div class="p-3 mb-2 bg-primary text-white">
        <!-- Panggil script header -->
        <?php require_once("header.php"); ?>
        <!-- Isi Konten -->
        <br>
        <center>
            <h3>Transaksi</h3>
            <p><a class="btn btn-success" href="tambah_transaksi.php">Tambah Data</a></p>
        </center>
        <table class="table table-success table-striped table-hover">
            <tr>
                <td><b>No. </b></td>
                <td><b>Nama Petugas</b></td>
                <td><b>Nama Siswa</b></td>
                <td><b>Tgl/Bulan/Tahun dibayar</b></td>
                <td><b>Tahun / Nominal harus dibayar</b></td>
                <td><b>Jumlah yang dibayar</b></td>
                <td><b>Status</b></td>
                <td><b>Aksi</b></td>
            </tr>
    <?php
    $totalDataHalaman = 5;
    $data = mysqli_query($db, "SELECT * FROM pembayaran");
    $hitung = mysqli_num_rows($data);
    $totalHalaman = ceil($hitung / $totalDataHalaman);
    $halAktif = (isset($_GET['hal'])) ? $_GET['hal'] : 1;
    $dataAwal = ($totalDataHalaman * $halAktif) - $totalDataHalaman;
    // Kita panggil tabel pembayaran
    // Setelah kita panggil, JOIN tabel yang ter relasi ke tabel pembayaran
    $sql = mysqli_query($db, "SELECT * FROM pembayaran
    JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas 
    JOIN siswa ON pembayaran.nisn = siswa.nisn
    JOIN spp ON pembayaran.id_spp = spp.id_spp
    ORDER BY tgl_bayar ASC LIMIT $dataAwal, $totalDataHalaman");
    $no = 1;
    while($r = mysqli_fetch_assoc($sql)){ ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $r['nama_petugas']; ?></td>
                <td><?= $r['nama']; ?></td>
                <td><?= $r['tgl_bayar'] . "/" . $r['bulan_dibayar'] . "/" . $r['tahun_dibayar']; ?></td>
                <td><?= $r['tahun'] . " | Rp. " . $r['nominal']; ?></td>
                <td><?= $r['jumlah_bayar']; ?></td>
                <td>
    <?php
    // Jika jumlah bayar sesuai dengan yang harus dibayar maka Status LUNAS
    if($r['jumlah_bayar'] == $r['nominal']){ ?>
                    <font style="color: darkgreen; font-weight: bold;">LUNAS</font>
    <?php }else{ ?>                             BELUM LUNAS <?php } ?> </td>
                <td>
    <?php
    // Jika siswa ingin membayar lunas sisa pembayaran
    if($r['jumlah_bayar'] == $r['nominal']){ echo "-";
    }else{ ?>
        <a href="?lunas&id=<?= $r['id_pembayaran']; ?>">BAYAR LUNAS</a>
    <?php } ?>  </td>
            </tr>
    <?php $no++; } ?>
        </table>
    <!-- Tampilkan tombol halaman -->
    <?php for($i=1; $i <= $totalHalaman; $i++): ?>
            <a class="btn btn-warning" href="?hal=<?= $i; ?>"><?= $i; ?></a>
    <?php endfor; ?>
    <!-- Selesai -->
    <br>
    <br>
    <br>
    </div>
</body>
</html>
<?php
// Ada siswa yang ingin membayar sisa pembayaran
if(isset($_GET['lunas'])){
    $id = $_GET['id'];
    $ambilData = mysqli_query($db, "SELECT * FROM pembayaran JOIN spp ON pembayaran.id_spp=spp.id_spp 
                                    WHERE id_pembayaran = '$id'");
    $row = mysqli_fetch_assoc($ambilData);
    $sisa = $row['nominal'] - $row['jumlah_bayar'];
    $hasil = $row['jumlah_bayar'] + $sisa;
    $update = mysqli_query($db, "UPDATE pembayaran SET jumlah_bayar='$hasil' WHERE id_pembayaran='$id'");
    if($update){
        header("location: transaksi.php");
    }
}
?>