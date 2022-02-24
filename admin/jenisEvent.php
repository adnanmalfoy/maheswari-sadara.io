<?php

include "../functions.php";

if (isset($_POST["submit"])) {
    //cek apakah data berhasil dikirimkan atau tidak
    if (tambahJenisEvent($_POST) > 0) {
        echo "<script>
				alert ('Data Berhasil Ditambahkan');
				document.location.href = 'index.php?halaman=jenisEvent';
			</script>";
    } else {
        echo "<script>
				alert ('Data Gagal Ditambahkan');
				document.location.href = 'index.php?halaman=jenisEvent';
			</script>";
    }
}

$jevent = $conn->query("SELECT jenisevent.id_jevent, event.nama_event, jenisevent.nama_jenis, event.id_event, jenisevent.tanggal FROM jenisevent

JOIN event ON jenisevent.id_event = event.id_event");

$result = mysqli_fetch_assoc($jevent);
// var_dump($result);
// die;

$event = $conn->query("SELECT * FROM event");
?>


<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Event</h1>

    <div class="card shadow-sm border-bottom-primary">
        <div class="card-header bg-white py-3">
            <div class="row">
                <div class="col">
                    <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                        Data Jenis
                    </h4>
                </div>
                <div class="col-auto">
                    <a class="btn btn-success btn-social" class="cetak" href="cetakEvent.php" target="_blank">
                        <i class="fa fa-print"></i> Cetak
                    </a>
                </div>
                <div class="col-auto">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary mb-3 btn-icon-split" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i>
                        Tambah Data Jenis Event
                    </button>
                </div>

            </div>

            <div class="card-shadow">
                <div class="card-body">
                    <table class="table table-bordered table-hover" width="100%" id="dataTable">
                        <thead class="thead-light" align="center">
                            <tr>
                                <td>No.</td>
                                <td>Nama Event</td>
                                <td>Jenis Event</td>
                                <td>Tanggal Event</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>

                        <tbody align="center">
                            <?php $i = 1; ?>
                            <?php global $conn; ?>
                            <?php foreach ($jevent as $row) : ?>
                                <tr>
                                    <td width="60px"><?= $i; ?></td>
                                    <td><?= $row["nama_event"]; ?></td>
                                    <td><?= $row["nama_jenis"]; ?></td>
                                    <td><?= $row["tanggal"]; ?></td>
                                    <td>
                                        <a href="index.php?halaman=ubahJenisEvent&id=<?= $row["id_jevent"]; ?>" class="btn btn-warning"><i class="fas fa-edit mr-1"></i>Ubah</a>
                                        <a href="index.php?halaman=hapusJenisEvent&id=<?= $row["id_jevent"]; ?>" onclick="return confirm('Yakin ?');" class="btn btn-danger"><i class="fas fa-trash mr-1"></i>Hapus</a>
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


<!-- Modal Tambah-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Tambah Data Jenis Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row form-group">
                        <label for="id_jevent" class="col-md-4 text-md-right">Nama Event</label>
                        <div class="col-md-7">
                            <div class="input-group">
                                <select class="custom-select" id="id_event" name="id_event">
                                    <option value="" selected disabled>Pilih Event</option>
                                    <?php foreach ($event as $e) : ?>
                                        <option value="<?= $e["id_event"]; ?>"><?= $e["nama_event"]; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="nama_event" class="col-md-4 text-md-right">Nama Jenis</label>
                        <div class="col-md-7">
                            <div class="input-group">
                                <input type="text" name="nama_jenis" class="form-control" required autofocus>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="tanggal" class="col-md-4 text-md-right">Tanggal</label>
                        <div class="col-md-7">
                            <div class="input-group">
                                <input type="date" name="tanggal" class="form-control" required>
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