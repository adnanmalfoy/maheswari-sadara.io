<?php

include "functions.php";

$barang = $conn->query("SELECT barang.id_barang,barang.nama_barang, barang.harga, barang.stok, barang.gambar, satuan.nama_satuan, jenisbarang.nama_jenis FROM barang

JOIN satuan on barang.id_satuan = satuan.id_satuan
join jenisbarang on barang.id_jenis = jenisbarang.id_jenis");


?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- My fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Viga">

  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <link href="assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link type="text/css" href="vendor/sb-admin2/css/sb-admin-2.min.css" rel="stylesheet">
  <title>Main Page</title>
</head>

<body>
  <?php include "menu.php"; ?>

  <div class="container">
    <!-- info panel -->
    <div class="row justify-content-center">
      <div class="col-lg-12 info-panel">
        <div class="row">
          <div class="col-lg">
            <h3 class="text-center">Daftar Barang Tersedia</h3>
            <hr />

            <?php foreach ($barang as $row) : ?>

              <div class="card my-3 ml-5 float-left" style="width : 18rem;">
                <img class="card-img-top ml-5 mt-4" src="admin/img/<?= $row["gambar"]; ?>">
                <div class="card-body">
                  <h4 class="card-title"><?= $row["nama_barang"]; ?></h4>
                  <p>Rp. <?= number_format($row["harga"]); ?></p>
                  <p>Sisa Stok : <?= $row["stok"]; ?> <?= $row["nama_satuan"]; ?></p>
                </div>
              </div>

            <?php endforeach ?>

          </div>
        </div>
      </div>
    </div>
    <!-- akhir info panel -->

    <a class="scroll-to-top rounded" href="#top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- footer -->
    <div class="row footer">
      <div class="col text-center">
        <p> <?= date('Y'); ?> All Rights Reserved by Maheswari Sadara</p>
      </div>
    </div> -->
    <!-- akhir footer-->
  </div>
  <script>
    $('html, body').animate({
      scrollTop: $("#elementID").offset().top
    }, 2000);
  </script>

  <!-- Bootstrap core JavaScript-->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="vendor/sb-admin2/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="vendor/sb-admin2/js/demo/datatables-demo.js"></script>

  <!-- Page level custom scripts -->
  <script src="vendor/js/demo/datatables-demo.js"></script>

  <!-- Javascript -->
  <script src="assets/js/script.js"></script>
</body>
</body>

</html>