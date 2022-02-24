<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

$conn = mysqli_connect("localhost", "root", "", "maheswari");

function load($load)
{
  global $conn;
  $result = mysqli_query($conn, $load);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows = $row;
  }
  return $rows;
}
$admin = load("SELECT * FROM admin");

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>
    <?php
    if (isset($_GET['halaman'])) {
      if ($_GET['halaman'] == "dataBarang") {
        echo 'Data Barang';
      } else if ($_GET['halaman'] == 'jenisBarang') {
        echo 'Jenis Barang';
      } else if ($_GET['halaman'] == 'satuanBarang') {
        echo 'Satuan Barang';
      } else if ($_GET['halaman'] == 'jenisEvent') {
        echo 'Jenis Event';
      } else if ($_GET['halaman'] == 'ubahBarang') {
        echo 'Ubah Barang';
      } else if ($_GET['halaman'] == 'tambahEvent') {
        echo 'Tambah Event';
      } else if ($_GET['halaman'] == 'ubahJenisEvent') {
        echo 'Ubah Jenis Event';
      } else if ($_GET['halaman'] == 'dataEvent') {
        echo 'Data Event';
      } else if ($_GET['halaman'] == 'barangMasuk') {
        echo 'Barang Masuk';
      } else if ($_GET['halaman'] == 'barangKeluar') {
        echo 'Barang Keluar';
      } else if ($_GET['halaman'] == 'profile') {
        echo 'Profile';
      } else if ($_GET['halaman'] == 'ubahProfile') {
        echo 'Ubah Profile';
      } else if ($_GET['halaman'] == 'dashboard') {
        echo 'Dashboard';
      } else if ($_GET['halaman'] == 'laporanBasuk') {
        echo 'Laporan Barang Masuk';
      } else if ($_GET['halaman'] == 'laporanBaluar') {
        echo 'Laporan Barang Keluar';
      } else if ($_GET['halaman'] == 'pemesanan') {
        echo 'Pemesanan';
      } else if ($_GET['halaman'] == 'ubahPelanggan') {
        echo 'Ubah Pelanggan';
      } else if ($_GET['halaman'] == 'tambahPemesanan') {
        echo 'Tambah Pemesanan';
      } else if ($_GET['halaman'] == 'pelanggan') {
        echo 'Pelanggan';
      } else if ($_GET['halaman'] == 'detail') {
        echo 'Detail';
      } else if ($_GET['halaman'] == 'ubahPemesanan') {
        echo 'Ubah Pemesanan';
      } else {
        echo 'Home';
      }
    }
    ?>
  </title>

  <!-- Custom fonts for this template-->
  <link href="../assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../vendor/sb-admin2/css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php?halaman=dashboard">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Maheswari Sadara</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="index.php?halaman=dashboard">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Master Data
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed py-2" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Barang</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white collapse-inner rounded">
            <h6 class="collapse-header">Barang</h6>
            <a class="collapse-item" href="index.php?halaman=satuanBarang">Satuan Barang</a>
            <a class="collapse-item" href="index.php?halaman=jenisBarang">Jenis Barang</a>
            <a class="collapse-item" href="index.php?halaman=dataBarang">Data Barang</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-cog"></i>
          <span>Event</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Event</h6>
            <a class="collapse-item" href="index.php?halaman=dataEvent">Data Event</a>
            <a class="collapse-item" href="index.php?halaman=jenisEvent">Jenis Event</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed pt-0" href="#" data-toggle="collapse" data-target="#transaksi" aria-expanded="true" aria-controls="transaksi">
          <i class="fas fa-fw fa-code"></i>
          <span>Transaksi</span>
        </a>
        <div id="transaksi" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Transaksi</h6>
            <a class="collapse-item" href="index.php?halaman=pelanggan">Pelanggan</a>
            <a class="collapse-item" href="index.php?halaman=pemesanan">Pemesanan</a>
          </div>
        </div>
      </li>

      <hr class="sidebar-divider">
      <!-- Heading -->
      <div class="sidebar-heading">
        Transaksi
      </div>

      <li class="nav-item">
        <a class="nav-link pb-0" href="index.php?halaman=barangMasuk">
          <i class="fas fa-fw fa-download"></i>
          <span>Barang Masuk</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?halaman=barangKeluar">
          <i class="fas fa-fw fa-upload"></i>
          <span>Barang Keluar</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Reports
      </div>
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReport" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-cog"></i>
          <span>Cetak Laporan</span>
        </a>
        <div id="collapseReport" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Reports</h6>
            <a class="collapse-item" href="index.php?halaman=laporanBasuk">Barang Masuk</a>
            <a class="collapse-item" href="index.php?halaman=laporanBaluar">Barang Keluar</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Addons
      </div>

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="logout.php">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Logout</span></a>

      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $admin["nama"]; ?></span>
                <img class="img-profile rounded-circle" src="img/<?= $admin["gambar"]; ?>">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="index.php?halaman=profile">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="index.php?halaman=ubahProfile">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="tabel">
            <?php
            if (isset($_GET['halaman'])) {
              if ($_GET['halaman'] == "dataBarang") {
                include 'dataBarang.php';
              } else if ($_GET['halaman'] == "jenisBarang") {
                include 'jenisBarang.php';
              } else if ($_GET['halaman'] == "satuanBarang") {
                include 'satuanBarang.php';
              } else if ($_GET['halaman'] == "jenisEvent") {
                include 'jenisEvent.php';
              } else if ($_GET['halaman'] == "hapusSatuan") {
                include 'hapusSatuan.php';
              } else if ($_GET['halaman'] == "ubahBarang") {
                include 'ubahBarang.php';
              } else if ($_GET['halaman'] == "hapusBarang") {
                include 'hapusBarang.php';
              } else if ($_GET['halaman'] == "hapusJenisBarang") {
                include 'hapusJenisBarang.php';
              } else if ($_GET['halaman'] == "hapusJenisEvent") {
                include 'hapusJenisEvent.php';
              } else if ($_GET['halaman'] == "tambahEvent") {
                include 'tambahEvent.php';
              } else if ($_GET['halaman'] == "ubahJenisEvent") {
                include 'ubahJenisEvent.php';
              } else if ($_GET['halaman'] == "hapusEvent") {
                include 'hapusEvent.php';
              } else if ($_GET['halaman'] == "dataEvent") {
                include 'dataEvent.php';
              } else if ($_GET['halaman'] == "barangMasuk") {
                include 'barangMasuk.php';
              } else if ($_GET['halaman'] == "barangKeluar") {
                include 'barangKeluar.php';
              } else if ($_GET['halaman'] == "hapusBasuk") {
                include 'hapusBasuk.php';
              } else if ($_GET['halaman'] == "hapusBaluar") {
                include 'hapusBaluar.php';
              } else if ($_GET['halaman'] == "profile") {
                include 'profile.php';
              } else if ($_GET['halaman'] == "ubahProfile") {
                include 'ubahProfile.php';
              } else if ($_GET['halaman'] == "dashboard") {
                include 'dashboard.php';
              } else if ($_GET['halaman'] == "laporanBasuk") {
                include 'laporanBasuk.php';
              } else if ($_GET['halaman'] == "laporanBaluar") {
                include 'laporanBaluar.php';
              } else if ($_GET['halaman'] == "pemesanan") {
                include 'pemesanan.php';
              } else if ($_GET['halaman'] == "ubahPelanggan") {
                include 'ubahPelanggan.php';
              } else if ($_GET['halaman'] == "tambahPemesanan") {
                include 'tambahPemesanan.php';
              } else if ($_GET['halaman'] == "pelanggan") {
                include 'pelanggan.php';
              } else if ($_GET['halaman'] == "hapusPelanggan") {
                include 'hapusPelanggan.php';
              } else if ($_GET['halaman'] == "detail") {
                include 'detail.php';
              } else if ($_GET['halaman'] == "cetakPesan") {
                include 'cetakPesan.php';
              } else if ($_GET['halaman'] == "ubahPemesanan") {
                include 'ubahPemesanan.php';
              } else if ($_GET['halaman'] == "hapusPemesanan") {
                include 'hapusPemesanan.php';
              } else {
                include 'home.php';
              }
            }
            ?>
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Maheswari Sadara</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../vendor/sb-admin2/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="../assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="../vendor/sb-admin2/js/demo/datatables-demo.js"></script>

  <!-- Page level custom scripts -->
  <script src="../vendor/js/demo/datatables-demo.js"></script>

  <!-- Javascript -->
  <script src="../assets/js/script.js"></script>
</body>

</html>