<?php

include "../functions.php";

if (isset($_POST["submit"])) {
    //cek apakah data berhasil dikirimkan atau tidak
    if (tambahJenisBarang($_POST) > 0) {
        echo "<script>
				alert ('Data Berhasil Ditambahkan');
				document.location.href = 'index.php?halaman=jenisBarang';
			</script>";
    } else {
        echo "<script>
				alert ('Data Gagal Ditambahkan');
				document.location.href = 'index.php?halaman=jenisBarang';
			</script>";
    }
}

$jenis = $conn->query("SELECT * FROM jenisbarang");
?>

<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Barang</h1>

    <div class="card shadow-sm border-bottom-primary">
        <div class="card-header bg-white py-3">
            <div class="row">
                <div class="col">
                    <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                        Data Jenis
                    </h4>
                </div>
                <div class="col-auto">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary my-2 btn-icon-split" data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-plus mr-3"></i>
                        Tambah Jenis Barang
                    </button>
                </div>
            </div>

            <div class="card-shadow">
                <div class="card-body">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead class="thead-light" align="center">
                            <tr>
                                <td>No.</td>
                                <td>Nama Jenis Barang</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>

                        <tbody align="center">
                            <?php $i = 1; ?>
                            <?php global $conn; ?>
                            <?php foreach ($jenis as $row) : ?>
                                <tr>
                                    <td width="60px"><?= $i; ?></td>
                                    <td><?= $row["nama_jenis"]; ?></td>
                                    <td width="120px">
                                        <a href="index.php?halaman=hapusJenisBarang&id=<?= $row["id_jenis"]; ?>" onclick="return confirm('Yakin ?');" class="btn btn-danger"><i class="fas fa-trash mr-1"></i>Hapus</a>
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
                <h5 class="modal-title" id="exampleModalLabel">Form Tambah Jenis Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="nama_jenis">Nama Jenis</label>
                        <input type="text" name="nama_jenis" class="form-control">
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