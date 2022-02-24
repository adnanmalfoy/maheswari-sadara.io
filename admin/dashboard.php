<?php

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require "../functions.php";

$barang = mysqli_query($conn, "SELECT * FROM barang WHERE status = 1");
$jmlBarang = mysqli_num_rows($barang);

$stok = mysqli_query($conn, "SELECT SUM(stok) FROM barang WHERE status = 1");

$basuk = $conn->query("SELECT barang_masuk.tanggal_masuk, barang.nama_barang, barang_masuk.jumlah_masuk 
FROM barang_masuk JOIN barang ON barang_masuk.id_barang = barang.id_barang");

$baluar = $conn->query("SELECT barang_keluar.tanggal_keluar, barang.nama_barang, barang_keluar.jumlah_keluar 
FROM barang_keluar JOIN barang ON barang_keluar.id_barang = barang.id_barang");

$barang_min = $conn->query("SELECT * from barang WHERE stok <= 3 AND status = 1");

$jevent = $conn->query("SELECT jenisevent.id_jevent, event.nama_event, jenisevent.nama_jenis, event.id_event, jenisevent.tanggal FROM jenisevent

JOIN event ON jenisevent.id_event = event.id_event");

$pelanggan = mysqli_query($conn, "SELECT * FROM pelanggan");
$jmlPel = mysqli_num_rows($pelanggan);

$jmlEvent = mysqli_num_rows($jevent);
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-3 col-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Data Barang</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jmlBarang; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-folder fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <?php while ($data = mysqli_fetch_array($stok)) : ?>
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Stok Barang</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?= number_format($data['SUM(stok)']) ?>
                                        <?php endwhile ?>
                                        </div>
                                </div>
                                <div class="col-auto">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Data Event</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jmlEvent; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-folder fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Pelanggan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jmlPel; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-folder fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header bg-success py-3">
                    <h6 class="m-0 font-weight-bold text-white text-center">Transaksi Terakhir Barang Masuk</h6>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0 table-sm table-striped text-center">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Barang</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php global $conn; ?>
                            <?php foreach ($basuk as $row) : ?>
                                <tr>
                                    <td><strong><?= $row["tanggal_masuk"]; ?></strong></td>
                                    <td><?= $row["nama_barang"]; ?></td>
                                    <td><span class="badge badge-success"><?= $row["jumlah_masuk"]; ?></span></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header bg-danger py-3">
                    <h6 class="m-0 font-weight-bold text-white text-center">Transaksi Terakhir Barang Keluar</h6>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0 table-sm table-striped text-center">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Barang</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($baluar as $row) : ?>
                                <tr>
                                    <td><strong><?= $row["tanggal_keluar"]; ?></strong></td>
                                    <td><?= $row["nama_barang"]; ?></td>
                                    <td><span class="badge badge-danger"><?= $row["jumlah_keluar"]; ?></span></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header bg-info py-3">
                    <h6 class="m-0 font-weight-bold text-white text-center">Data Event</h6>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0 table-sm table-striped text-center">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Nama Event</th>
                                <th>Jenis Event</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php global $conn; ?>
                            <?php foreach ($jevent as $row) : ?>
                                <tr>
                                    <td><strong><?= $row["tanggal"]; ?></strong></td>
                                    <td><?= $row["nama_event"]; ?></td>
                                    <td><?= $row["nama_jenis"]; ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header bg-warning py-3">
                    <h6 class="m-0 font-weight-bold text-white text-center">Stok Barang Minimum</h6>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0 text-center table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Barang</th>
                                <th>Stok</th>
                                <th>Pasok</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($barang_min) :
                                foreach ($barang_min as $b) :
                            ?>
                                    <tr>
                                        <td><?= $b['nama_barang']; ?></td>
                                        <td><?= $b['stok']; ?></td>
                                        <td>
                                            <a href="index.php?halaman=barangMasuk" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="3" class="text-center">
                                        Tidak ada barang stok minim
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>