<?php
// pengecekan session
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require '../functions.php';

$id = $_GET["id"];

$pmsn = query("SELECT pemesanan.id_pesanan,pelanggan.id_pelanggan, pelanggan.email, pelanggan.nama, pelanggan.alamat,pemesanan.jenis_produk, pemesanan.tanggal FROM pemesanan

JOIN pelanggan on pemesanan.id_pelanggan = pelanggan.id_pelanggan WHERE id_pesanan = $id");

//cek tombol submit sudah ditekan
if (isset($_POST["submit"])) {

    //cek data berhasil diubah
    if (ubahPemesanan($_POST) > 0) {
        echo "<script>
				alert ('Data Berhasil Diubah');
				document.location.href = 'index.php?halaman=pemesanan';
			</script>";
    } else {
        var_dump($_POST);
        die;
        echo "<script>
        alert ('Data Gagal Diubah');
        document.location.href = 'index.php?halaman=pemesanan';
    </script>";
    }
}
?>
<div class="container-fluid">
    <h2 class="h3 mb-4 text-gray-800">Pemesanan</h2>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-bottom-primary">
                <div class="card-header bg-white py-3">
                    <div class="row">
                        <div class="col">
                            <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                                Form Ubah Pemesanan
                            </h4>
                        </div>
                        <div class="col-auto">
                            <a href="index.php?halaman=pemesanan" class="btn btn-sm btn-secondary btn-icon-split">
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
                    <form method="post" action="">
                        <input type="hidden" name="id" value="<?= $pmsn["id_pesanan"]; ?>">

                        <div class="row form-group">
                            <label class="col-md-4 text-md-right"> Nama Pelanggan </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="nama" value="<?= $pmsn['nama']; ?>">
                            </div>
                        </div>
                        <!-- <div class="row form-group">
                            <label class="col-md-4 text-md-right"> Alamat</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" disabled name="alamat" value="<?= $pmsn['alamat']; ?>">
                            </div>
                        </div> -->
                        <div class="row form-group">
                            <label class="col-md-4 text-md-right"> Jenis Produk</label>
                            <div class="col-md-8">
                                <input type="textarea" class="form-control" name="jenis_produk" value="<?= $pmsn['jenis_produk']; ?>">
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-md-4 text-md-right"> Tanggal</label>
                            <div class="col-md-8">
                                <input type="date" class="form-control" name="tanggal" value="<?= $pmsn['tanggal']; ?>">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary" name="submit">Ubah</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>