<?php


//pengecekan session
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require '../functions.php';

//ambil data dr url
$id = $_GET["id"];

$jevent = query("SELECT jenisevent.id_jevent, event.nama_event, jenisevent.nama_jenis, event.id_event, jenisevent.tanggal FROM jenisevent

JOIN event ON jenisevent.id_event = event.id_event");

$event = $conn->query("SELECT * FROM event");

//cek tombol submit sudah ditekan
if (isset($_POST["submit"])) {

    //cek data berhasil diubah
    if (ubahJenisEvent($_POST) > 0) {
        echo "<script>
				alert ('Data Berhasil Diubah');
				document.location.href = 'index.php?halaman=jenisEvent';
			</script>";
    } else {
        echo "<script>
        alert ('Data Gagal Diubah');
        document.location.href = 'index.php?halaman=jenisEvent';
    </script>";
    }
}
?>

<div class="container-fluid">
    <h2 class="h3 mb-4 text-gray-800">Event</h2>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-bottom-primary">
                <div class="card-header bg-white py-3">
                    <div class="row">
                        <div class="col">
                            <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                                Form Ubah Event
                            </h4>
                        </div>
                        <div class="col-auto">
                            <a href="index.php?halaman=jenisEvent" class="btn btn-sm btn-secondary btn-icon-split">
                                <span class="icon">
                                    <i class="fa fa-arrow-left"></i>
                                </span>
                                <span class="text">
                                    Kembali
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?= $jevent["id_jevent"]; ?>">
                        <div class="row form-group">
                            <label class="col-md-4 text-md-right">Nama Event</label>
                            <div class="col-md-8">
                                <select class="custom-select" id="nama_event" name="nama_event">
                                    <?php foreach ($event as $row) : ?>
                                        <option value="<?= $row["id_event"]; ?>"> <?= $row["nama_event"]; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4 text-md-right"> Nama Jenis Event </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="nama_jenis" value="<?= $jevent['nama_jenis']; ?>">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4 text-md-right"> Tanggal Event </label>
                            <div class="col-md-8">
                                <input type="date" class="form-control" name="tanggal" value="<?= $jevent['tanggal']; ?>">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary" name="submit"> Ubah</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>