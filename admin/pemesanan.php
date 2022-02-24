<?php
require "../functions.php";

$pmsn = $conn->query("SELECT pemesanan.id_pesanan,pelanggan.id_pelanggan, pelanggan.email, pelanggan.nama, pemesanan.alamat,pemesanan.jenis_produk, pemesanan.tanggal FROM pemesanan

JOIN pelanggan on pemesanan.id_pelanggan = pelanggan.id_pelanggan");

$result = mysqli_fetch_assoc($pmsn);

?>

<div class="container-fluid">
    <h2 class="h3 mb-3 text-gray-800">Data Pemesanan</h2>
    <div class="card-shadow-sm border-bottom-primary">
        <div class="card-header bg-white py-3">
            <div class="row">
                <div class="col">
                    <h4 class="h5 align-middle m-0 font-weight-bold text-primary mb-3">
                        Data Pemesanan
                    </h4>
                </div>
                <div class="col-auto">
                    <a href="index.php?halaman=tambahPemesanan" class="btn btn-primary"><i class="fa fa-plus mr-3"></i>Tambah Data Pemesanan</a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered w-100 dt-responsive nowrap" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>Alamat</th>
                            <th>Jenis Produk</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php global $conn; ?>
                        <?php foreach ($pmsn as $row) : ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $row["nama"]; ?></td>
                                <td><?= $row["alamat"]; ?></td>
                                <td><?= $row["jenis_produk"]; ?></td>
                                <td><?= $row["tanggal"]; ?></td>
                                <td>
                                    <a href="index.php?halaman=detail&id=<?= $row["id_pesanan"] ?>" class="btn btn-success"><i class="fas fa-info"></i></a>
                                    <a href="index.php?halaman=ubahPemesanan&id=<?= $row["id_pesanan"] ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                    <a href="index.php?halaman=hapusPemesanan&id=<?= $row["id_pesanan"] ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php $i++ ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>