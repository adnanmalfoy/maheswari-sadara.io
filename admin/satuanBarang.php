<?php

include "../functions.php";

if (isset($_POST["submit"])) {
    //cek apakah data berhasil dikirimkan atau tidak
    if (tambahSatuanBarang($_POST) > 0) {
        echo "<script>
				alert ('Data Berhasil Ditambahkan');
				document.location.href = 'index.php?halaman=satuanBarang';
			</script>";
    } else {
        echo "<script>
				alert ('Data Gagal Ditambahkan');
				document.location.href = 'index.php?halaman=satuanBarang';
			</script>";
    }
}

$satuan = $conn->query("SELECT * FROM satuan");
?>

<div class="container-fluid">
    <h2 class="h3 mb-4 text-gray-800">Barang</h2>

    <div class="card shadow-sm border-bottom-primary">
        <div class="card-header bg-white py-3">
            <div class="row">
                <div class="col">
                    <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                        Data Satuan
                    </h4>
                </div>
                <div class="col-auto">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus mr-3"></i>
                        Tambah Data Satuan
                    </button>
                </div>
            </div>
            <div class="card-shadow">
                <div class="card-body">
                    <table class="table table-bordered table-hover" width="100%">
                        <thead class="thead-light" align="center">
                            <tr>
                                <td>No.</td>
                                <td>Nama Satuan</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>

                        <tbody align="center">
                            <?php $i = 1; ?>
                            <?php global $conn; ?>
                            <?php foreach ($satuan as $row) : ?>
                                <tr>
                                    <td width="60px"><?= $i; ?></td>
                                    <td><?= $row["nama_satuan"]; ?></td>
                                    <td width="120px">
                                        <a href="index.php?halaman=hapusSatuan&id=<?= $row["id_satuan"]; ?>" onclick="return confirm('Yakin ?');" class="btn btn-danger"><i class="fas fa-trash mr-1"></i>Hapus</a>
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
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Tambah Satuan Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="nama_satuan">Nama Satuan</label>
                        <input type="text" name="nama_satuan" class="form-control" autofocus>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="submit">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>