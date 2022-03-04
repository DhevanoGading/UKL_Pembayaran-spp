<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <!-- Logika kita, Jika Level Admin Maka Fitur apa saja yang dapat diakses -->
    <?php
    $panggil = mysqli_query($db, "SELECT * FROM petugas WHERE username='$username'");
    $hasil = mysqli_fetch_assoc($panggil);
        if($hasil['level'] == "Administrator"){ ?>
          <nav class="navbar navbar-expand-lg navbar-light bg-light rounded-pill">
            <div class="container-fluid">
              <a class="navbar-brand" href="index.php">Pembayaran SPP</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
              <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link active" href="siswa.php">Data Siswa</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" href="petugas.php">Data Petugas</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" href="kelas.php">Data Kelas</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" href="spp.php">Data SPP</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" href="transaksi.php">Transaksi</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" href="history.php">History Pembayaran</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" href="logout.php">LogOut</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
    <?php
        }else if($hasil['level'] == "Petugas"){
          if($hasil['level'] == "Petugas") { ?>
            <nav class="navbar navbar-expand-lg navbar-light bg-light rounded-pill">
              <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Pembayaran SPP</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                  <ul class="navbar-nav">
                    <li class="nav-item">
                      <a class="nav-link active" href="transaksi.php">Transaksi</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="history.php">History Pembayaran</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="logout.php">LogOut</a>
                    </li>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
        <?php }else{
          alert("Anda tidak memiliki hak akses!"); } ?>
    <?php } ?>
</body>
</html>