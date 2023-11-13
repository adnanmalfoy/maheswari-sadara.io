<?php

include "../functions.php";

//cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
    //cek apakah data berhasil dikirimkan atau tidak
    if (tambahBasuk($_POST) > 0) {

        echo "<script>
				alert ('Data Berhasil Ditambahkan');
				document.location.href = 'index.php?halaman=barangMasuk';
			</script>";
    } else {
        echo "<script>
				alert ('Data Gagal Ditambahkan');
				document.location.href = 'index.php?halaman=barangMasuk';
			</script>";
    }
}

$barang = $conn->query("SELECT barang_masuk.id_barang_masuk, barang.nama_barang, barang.stok ,barang_masuk.jumlah_masuk, barang_masuk.tanggal_masuk FROM barang_masuk

LEFT JOIN barang ON barang_masuk.id_barang = barang.id_barang");

$brg = $conn->query("SELECT * FROM barang");

$hari_ini = date("d-m-Y");

?>
<div class="container-fluid">
    <h2 class="h3 mb-4 text-gray-800">Barang</h2>

    <div class="card shadow-sm border-bottom-primary">
        <div class="card-header bg-white py-3">
            <div class="row">
                <div class="col">
                    <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                        Riwayat Data Barang Masuk
                    </h4>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-primary my-2 btn-icon-split" data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-plus mr-3"></i>Tambah Data Barang Masuk</button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped w-100 dt-responsive nowrap" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light mt-2" align="center">
                        <tr>
                            <th>No.</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Masuk</th>
                            <th>Tanggal Masuk</th>
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
                                <td><?= $row["jumlah_masuk"]; ?></td>
                                <td><?= $row["tanggal_masuk"]; ?></td>
                                <td><?= $row["stok"]; ?></td>
                                <td>
                                    <a href="index.php?halaman=hapusBasuk&id=<?= $row['id_barang_masuk']; ?>" onclick="return confirm('Yakin ?');" class="btn btn-danger"><i class="fas fa-trash mr-1"></i>Hapus</a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach ?>
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
                        <label class="col-md-4 text-md-right" for="jumlah_masuk">Jumlah Masuk</label>
                        <div class="col-md-5">
                            <div class="input-group">
                                <input type="number" name="jumlah_masuk" id="jumlah_masuk" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-md-4 text-md-right" for="tanggal">Tanggal Masuk</label>
                        <div class="col-md-5">
                            <div class="input-group">
                                <input type="date" name="tanggal_masuk" class="form-control" required>
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