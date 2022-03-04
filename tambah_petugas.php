<?php
require_once("require.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Petugas</title>
</head>
<body class="p-3 mb-2 bg-primary text-white">
    <!-- Panggil header -->
    <?php require("header.php"); ?>
    <!-- Konten -->
    <form action="" method="POST">
        <div class="modal-dialog text-black">
          <div class="modal-content">
            <div class="modal-header">
              <h4>Tambah Petugas</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>Username</label>
                  <div class="col-sm-12">
                    <input type="text" name="user" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <div class="col-sm-12">
                  <input type="text" name="pass" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label>Nama</label>
                  <div class="col-sm-12">
                    <input type="text" name="nama" class="form-control">
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
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $nama = $_POST['nama'];
    $simpan = mysqli_query($db, "INSERT INTO petugas VALUES(NULL, '$user', '$pass', '$nama', 'Petugas')");
    if($simpan){
      echo "<script>alert('Tambah Petugas Sukses');location.href='petugas.php'</script>";
        }else{
            echo "<script>alert('Data sudah ada');</script>";
        }
}
?>