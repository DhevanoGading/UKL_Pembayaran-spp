<?php
require_once("require.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah SPP</title>
</head>
<body class="p-3 mb-2 bg-primary text-white">
    <!-- Panggil header -->
    <?php require("header.php"); ?>
    <!-- Konten -->
    <form action="" method="POST">
        <div class="modal-dialog text-black">
          <div class="modal-content">
            <div class="modal-header">
              <h4>Tambah SPP</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>Tahun</label>
                  <div class="col-sm-12">
                    <input type="text" name="tahun" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label>Nominal</label>
                  <div class="col-sm-12">
                    <input type="text" name="nominal" class="form-control">
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
    $tahun = $_POST['tahun'];
    $nominal = $_POST['nominal'];
    $simpan = mysqli_query($db, "INSERT INTO spp VALUES(NULL, '$tahun', '$nominal')");
    if($simpan){
      echo "<script>alert('Tambah SPP Sukses');location.href='spp.php'</script>";
    }else{
        echo "<script>alert('Data sudah ada');</script>";
    }
}
?>