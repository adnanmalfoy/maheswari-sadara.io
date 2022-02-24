<?php

include "../functions.php";

//cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
    //cek apakah data berhasil dikirimkan atau tidak
    if (tambahBaluar($_POST) > 0) {

        echo "<script>
				alert ('Data Berhasil Ditambahkan');
				document.location.href = 'index.php?halaman=barangKeluar';
			</script>";
    } else {
        echo "<script>
				alert ('Data Gagal Ditambahkan');
				document.location.href = 'index.php?halaman=barangKeluar';
			</script>";
    }
}

$barang = $conn->query("SELECT barang_keluar.id_barang_keluar, barang.nama_barang, barang.stok ,barang_keluar.jumlah_keluar, barang_keluar.tanggal_keluar FROM barang_keluar

LEFT JOIN barang ON barang_keluar.id_barang = barang.id_barang");

$brg = $conn->query("SELECT * FROM barang WHERE stok > 0");

?>
<div class="container-fluid">
    <h2 class="h3 mb-4 text-gray-800">Barang</h2>

    <div class="card shadow-sm border-bottom-primary">
        <div class="card-header bg-white py-3">
            <div class="row">
                <div class="col">
                    <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                        Riwayat Data Barang Keluar
                    </h4>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-primary my-2 btn-icon-split" data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-plus mr-3"></i>Tambah Data Barang Keluar</button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped w-100 dt-responsive nowrap" id="dataTable">
                    <thead align="center">
                        <tr>
                            <th>No. </th>
                            <th>Nama Barang</th>
                            <th>Jumlah Keluar</th>
                            <th>Tanggal Keluar</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody align="center">
                        <?php $i = 1; ?>
                        <?php global $conn; ?>
                        <?php foreach ($barang as $row) : ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $row["nama_barang"]; ?></td>
                                <td><?= $row["jumlah_keluar"]; ?></td>
                                <td><?= $row["tanggal_keluar"]; ?></td>
                                <td><?= $row["stok"]; ?></td>
                                <td>
                                    <a href="index.php?halaman=hapusBaluar&id=<?= $row['id_barang_keluar']; ?>" onclick="return confirm('Yakin ?');" class="btn btn-danger"><i class="fa fa-trash mr-2"></i>Hapus</a>
                                </td>
                                <?php $i++; ?>
                            <?php endforeach ?>
                            </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Modal Tambah-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="row form-group">
                        <label class="col-md-4 text-md-right" for="id_barang">Barang</label>
                        <div class="col-md-5">
                            <div class="input-group">
                                <select name="id_barang" id="id_barang" class="custom-select">
                                    <option value="" selected disabled>Pilih Barang</option>
                                    <?php foreach ($brg as $row) : ?>
                                        <option value="<?= $row["id_barang"]; ?>"><?= $row["nama_barang"]; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-4 text-md-right" for="jumlah_keluar">Jumlah Keluar</label>
                        <div class="col-md-5">
                            <div class="input-group">
                                <input type="number" name="jumlah_keluar" id="jumlah_keluar" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-4 text-md-right" for="tanggal">Tanggal Keluar</label>
                        <div class="col-md-5">
                            <div class="input-group">
                                <input type="date" name="tanggal_keluar" class="form-control" required>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="submit">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>