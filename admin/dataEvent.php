<?php

include "../functions.php";

if (isset($_POST["submit"])) {
    //cek apakah data berhasil dikirimkan atau tidak
    if (tambahEvent($_POST) > 0) {
        // var_dump($_POST);
        // die;
        echo "<script>
				alert ('Data Berhasil Ditambahkan');
				document.location.href = 'index.php?halaman=dataEvent';
			</script>";
    } else {
        echo "<script>
				alert ('Data Gagal Ditambahkan');
				document.location.href = 'index.php?halaman=dataEvent';
			</script>";
    }
}

$event = $conn->query("SELECT * FROM `event`");

?>

<div class="container-fluid">
    <h2 class="h3 mb-4 text-gray-800">Event</h2>

    <div class="card-shadow-sm border-bottom-primary">
        <div class="card-header bg-white py-3">
            <div class="row">
                <div class="col">
                    <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                        Data Event
                    </h4>
                </div>
                <div class="col-auto">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-plus"></i>
                        Tambah Data Event
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-bordered w-100 dt-responsive nowrap" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light mt-2">
                        <tr>
                            <td width="100px">No.</td>
                            <td>Nama Event</td>
                            <td align="center">Aksi</td>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $i = 1; ?>
                        <?php global $conn; ?>
                        <?php foreach ($event as $row) : ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $row["nama_event"]; ?></td>
                                <td width="150px" align="center">
                                    <a href="index.php?halaman=hapusEvent&id=<?= $row['id_event']; ?>" onclick="return confirm('Yakin ?');" class="btn btn-danger"><i class="fas fa-trash mr-1"></i>Hapus</a>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Tambah Data Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="row form-group">
                        <label for="nama_event" class="col-md-4 text-md-right">Nama Event</label>
                        <div class="col-md-7">
                            <div class="input-group">
                                <input type="text" name="nama_event" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row form-group">
                        <label for="tanggal" class="col-md-4 text-md-right">Tanggal</label>
                        <div class="col-md-7">
                            <div class="input-group">
                                <input type="date" name="tanggal" class="form-control" required>
                            </div>
                        </div>
                    </div> -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="submit">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>