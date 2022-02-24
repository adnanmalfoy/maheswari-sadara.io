<?php

include "functions.php";

$jevent = $conn->query("SELECT * FROM jenisevent");
$result = mysqli_num_rows($jevent);

$diklat = $conn->query("SELECT * FROM jenisevent WHERE id_event = 6");
$seminar = $conn->query("SELECT * FROM jenisevent WHERE id_event = 7");
$workshop = $conn->query("SELECT * FROM jenisevent WHERE id_event = 8");

$i = 1;

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
    <link rel="icon" class="fas fa-hand-receiving">
    <title>Event Page</title>
</head>

<body>
    <?php include "menu.php"; ?>

    <div class="container">
        <!-- info panel -->
        <div class="row justify-content-center">
            <div class="col-lg-12 info-panel">
                <div class="row">
                    <div class="col-lg">
                        <h3 class="text-center">Data Event</h3>
                        <hr />
                        <div class="row mx-3">
                            <div class="col-md-4">
                                <h4>Diklat</h4>
                                <p align="justify">Diklat merupakan singkatan dari pendidikan dan pelatihan. Diklat adalah serangkaian proses untuk meningkatkan keterampilan dan pengetahuan seorang pegawai demi tercapainya tujuan suatu organisasi. </p>
                                <h4 class="mb-3">List Diklat</h4>
                                <?php foreach ($diklat as $row) : ?>
                                    <p><?= $i; ?>. <?= $row["nama_jenis"]; ?> <?= $row["tanggal"]; ?> </p>
                                <?php endforeach ?>
                            </div>
                            <div class="col-md-4">
                                <h4>Seminar</h4>
                                <p align="justify">
                                    Seminar adalah suatu pertemuan sekelompok orang yang diselenggarakan untuk membahas suatu masalah dan mencari solusi ilmiah terhadap permasalahan tersebut.
                                </p>
                                <h4 class="mb-3">List Seminar</h4>
                                <?php foreach ($seminar as $row) : ?>
                                    <p><?= $i; ?>. <?= $row["nama_jenis"]; ?> <?= $row["tanggal"]; ?></p>
                                    <?php $i++; ?>
                                <?php endforeach ?>
                            </div>
                            <div class="col-md-4">
                                <h4>Workshop</h4>
                                <p align="justify">
                                    Workshop adalah suatu pertemuan yang mana sekelompok orang memiliki minat, keahlian, ataupun profesi pada bidang tertentu yang terlibat aktif dalam suatu diskusi dan kegiatan intensif pada suatu subjek maupun proyek tertentu.
                                </p>
                                <h4 class="mb-3">List Workshop</h4>
                                <?php foreach ($workshop as $row) : ?>
                                    <p><?= $i; ?>. <?= $row["nama_jenis"]; ?> <?= $row["tanggal"]; ?></p>
                                    <?php $i++; ?>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- akhir info panel -->

        <!-- footer -->
        <div class="row footer">
            <div class="col text-center">
                <p> <?= date('Y'); ?> All Rights Reserved by Maheswari Sadara</p>
            </div>
        </div> -->
        <!-- akhir footer-->
    </div>

    <!-- Optional JavaScript -->
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