<?php
// pengecekan session
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

require '../functions.php';

//ambil data dr url
$id = $_GET["id"];

$brg = query("SELECT barang.id_barang,barang.nama_barang, barang.harga, barang.stok, barang.gambar, satuan.nama_satuan, jenisbarang.nama_jenis FROM barang

JOIN satuan on barang.id_satuan = satuan.id_satuan
join jenisbarang on barang.id_jenis = jenisbarang.id_jenis WHERE id_barang = $id");

$satuan = $conn->query("SELECT * FROM satuan");
$jenis = $conn->query("SELECT * FROM jenisbarang");

//cek tombol submit sudah ditekan
if (isset($_POST["submit"])) {

  //cek data berhasil diubah
  if (ubahBarang($_POST) > 0) {
    echo "<script>
				alert ('Data Berhasil Diubah');
				document.location.href = 'index.php?halaman=dataBarang';
			</script>";
  } else {
    echo "<script>
        alert ('Data Gagal Diubah');
        document.location.href = 'index.php?halaman=dataBarang';
    </script>";
  }
}
?>
<div class="container-fluid">
  <h2 class="h3 mb-4 text-gray-800">Barang</h2>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm border-bottom-primary">
        <div class="card-header bg-white py-3">
          <div class="row">
            <div class="col">
              <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                Form Ubah Barang
              </h4>
            </div>
            <div class="col-auto">
              <a href="index.php?halaman=dataBarang" class="btn btn-sm btn-secondary btn-icon-split">
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
          <form method="post" action="" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $brg["id_barang"]; ?>">
            <input type="hidden" name="gambarLama" value="<?= $brg["gambar"]; ?>">

            <div class="row form-group">
              <label class="col-md-4 text-md-right"> Nama Barang </label>
              <div class="col-md-8">
                <input type="text" class="form-control" name="nama_barang" value="<?= $brg['nama_barang']; ?>">
              </div>
            </div>
            <div class="row form-group">
              <label class="col-md-4 text-md-right"> Harga Barang (Rp.) </label>
              <div class="col-md-8">
                <input type="text" class="form-control" name="harga" value="<?= $brg['harga']; ?>">
              </div>
            </div>
            <div class="row form-group">
              <!-- <label class="col-md-4 text-md-right"> Stok Barang </label> -->
              <div class="col-md-8">
                <input type="hidden" class="form-control" name="stok" value="<?= $brg['stok']; ?>">
              </div>
            </div>
            <div class="row form-group">
              <div class="col-md-8">
                <img src="img/<?= $brg['gambar']; ?>" width="200px" name="gambar" style="float: right;">
              </div>
            </div>
            <div class="row form-group">
              <label class="col-md-4 text-md-right"> Ganti Foto </label>
              <div class="col-md-8">
                <input type="file" class="form-control" name="gambar" id="gambar">
              </div>
            </div>
            <div class="row form-group">
              <label class="col-md-4 text-md-right">Satuan Barang</label>
              <div class="col-md-8">
                <select class="custom-select" id="nama_satuan" name="nama_satuan">
                  <?php foreach ($satuan as $s) : ?>
                    <option value="<?= $s["id_satuan"]; ?>"> <?= $s["nama_satuan"]; ?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
            <div class="row form-group">
              <label class="col-md-4 text-md-right">Jenis Barang</label>
              <div class="col-md-8">
                <select class="custom-select" id="nama_jenis" name="nama_jenis">
                  <?php foreach ($jenis as $j) : ?>
                    <option value="<?= $j["id_jenis"]; ?>"><?= $j["nama_jenis"]; ?></option>
                  <?php endforeach ?>
                </select>
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