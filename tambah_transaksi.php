<?php
require_once("require.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah data transaksi</title>
</head>
<body class="p-3 mb-2 bg-primary text-white">
    <?php require("header.php"); ?>
    <form action="" method="POST">
        <div class="modal-dialog text-black">
          <div class="modal-content">
            <div class="modal-header">
              <h4>Tambah Transaksi</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>Petugas</label>
                  <div class="col-sm-12">
                  <select class="form-control" name="petugas">
                        <?php
                        // Kita akan ambil Nama Petugas yang ada pada tabel Petugas
                        $petugas = mysqli_query($db, "SELECT * FROM petugas");
                        while($r = mysqli_fetch_assoc($petugas)){ ?>
                        <option value="<?= $r['id_petugas']; ?>"><?= $r['nama_petugas']; ?></option>
                        <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label>Siswa</label>
                  <div class="col-sm-12">
                  <select class="form-control" name="nisn">
                        <?php
                        // Sekarang kita ambil NISN Siswa 
                        $siswa = mysqli_query($db, "SELECT * FROM siswa");
                        while($r = mysqli_fetch_assoc($siswa)){ ?>
                        <option value="<?= $r['nisn']; ?>"><?= $r['nama']; ?></option>
                        <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label>Tgl. / Bulan / Tahun bayar</label>
                  <div class="col-sm-12">
                    <input type="text" name="tgl" class="form-control">
                    <input type="text" name="bulan" class="form-control">
                    <input type="text" name="tahun" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label>SPP / Nominal yang dibayar</label>
                  <div class="col-sm-12">
                  <select class="form-control" name="spp">
                        <?php
                        // Ambil juga data SPP
                        $spp = mysqli_query($db, "SELECT * FROM spp");
                        while($r = mysqli_fetch_assoc($spp)){ ?>
                        <option value="<?= $r['id_spp']; ?>">
                        <?= $r['tahun'] . " | " . $r['nominal']; ?></option>
                        <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label>Jumlah Bayar</label>
                  <div class="col-sm-12">
                    <input type="text" name="jumlah" placeholder="1000000" class="form-control">
                  </div>
                </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-sm btn-success" name="simpan">
                  Simpan
                </button>
              </div>
            </div>
        </div>
    </form>
    <hr />
</body>
</html>
<?php
// Kita simpan proses simpan datanya disini
if(isset($_POST['simpan'])){
    $petugas = $_POST['petugas'];
    $nama = $_POST['nisn'];
    $tgl = $_POST['tgl']; $bulan = $_POST['bulan']; $tahun = $_POST['tahun'];
    $spp = $_POST['spp'];
    $cek = mysqli_query($db, "SELECT * FROM pembayaran WHERE nisn='$nama'");
    $ambil = mysqli_fetch_assoc($cek);
    $jumlah = $_POST['jumlah'];
    if($spp == $ambil['id_spp']){
        echo "<script>alert('Tahun spp tersebut sudah ada pada siswa');</script>";
    }else{
        $s = mysqli_query($db,"INSERT INTO pembayaran VALUES
                (NULL, '$petugas', '$nama', '$tgl', '$bulan', '$tahun', '$spp', '$jumlah')");
    // Arahkan ke menu transaksi
    if($s){
      echo "<script>alert('Tambah Transaksi Sukses');location.href='transaksi.php'</script>";
}else{
        echo "<script>alert('gagal');</script>";
    }}}
    ?>