<?php
require_once("require.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Siswa</title>
</head>
<body class="p-3 mb-2 bg-primary text-white">
    <!-- Panggil header -->
    <?php require("header.php"); ?>
    <!-- Konten -->
    <form action="" method="POST">
        <div class="modal-dialog text-black">
          <div class="modal-content">
            <div class="modal-header">
              <h4>Tambah Siswa</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>NISN</label>
                  <div class="col-sm-12">
                    <input type="text" name="nisn" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label>NIS</label>
                  <div class="col-sm-12">
                  <input type="text" name="nis" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label>Nama</label>
                  <div class="col-sm-12">
                    <input type="text" name="nama" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label>Kelas</label>
                  <div class="col-sm-12">
                    <select class="form-control" name="kelas">
                        <?php
                        $kelas = mysqli_query($db, "SELECT * FROM kelas");
                        while($r = mysqli_fetch_assoc($kelas)){ ?>
                        <option value="<?= $r['id_kelas']; ?>"><?= $r['nama_kelas'] . " | "
                        . $r['kompetensi_keahlian']; ?></option>
                        <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label>Alamat</label>
                  <div class="col-sm-12">
                    <input type="text" name="alamat" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label>No. Telp</label>
                  <div class="col-sm-12">
                    <input type="text" name="no" class="form-control">
                  </div>
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
// Proses Simpan
if(isset($_POST['simpan'])){
    $nisn = $_POST['nisn'];
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $alamat = $_POST['alamat'];
    $no = $_POST['no'];
    $simpan = mysqli_query($db, "INSERT INTO siswa VALUES
    ('$nisn', '$nis', '$nama', '$kelas', '$alamat', '$no')");
        if($simpan){
           echo "<script>alert('Tambah Siswa Sukses');location.href='siswa.php'</script>";
        }else{
            echo "<script>alert('Data sudah ada');</script>";
        }
}
?>