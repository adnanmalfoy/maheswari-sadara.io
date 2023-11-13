<?php

include "../functions.php";
$plg = $conn->query("SELECT * FROM pelanggan");

$result = mysqli_fetch_assoc($plg);

if (isset($_POST["submit"])) {

  if (tambahPesanan($_POST) > 0) {
    echo "<script>
    alert ('Data Berhasil Ditambahkan');
    document.location.href = 'index.php?halaman=pemesanan';
  </script>";
  } else {
    echo "<script>
    alert ('Data Gagal Ditambahkan');
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
                Form Tambah Pemesanan
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
          <form method="post" action="" enctype="multipart/form-data">
            <div class="row form-group">
              <label for="nama_pelanggan" class=" col-md-4 text-md-right">Nama Pelanggan</label>
              <div class="col-md-8">
                <div class="input-group">
                  <select class="custom-select" id="nama_pelanggan" name="nama_pelanggan">
                    <option value="" selected disabled>Pilih Nama Pelanggan</option>
                    <?php foreach ($plg as $s) : ?>
                      <option value="<?= $s["id_pelanggan"]; ?>"><?= $s["nama"]; ?></option>
                    <?php endforeach ?>
                  </select>
                  <div class="input-group-append">
                    <a class="btn btn-primary" href="index.php?halaman=pelanggan"><i class="fa fa-plus"></i></a>
                  </div>
                </div>
              </div>
            </div>
            <div class="row form-group">
              <label class="col-md-4 text-md-right">Nama Produk</label>
              <div class="col-md-8">
                <input type="text" class="form-control" name="produk">
              </div>
            </div>
            <div class="row form-group">
              <label class="col-md-4 text-md-right">Alamat Pemesanan</label>
              <div class="col-md-8">
                <input type="text" class="form-control" name="alamat">
              </div>
            </div>
            <div class="row form-group">
              <label class="col-md-4 text-md-right">Tanggal Pemesanan</label>
              <div class="col-md-8">
                <input type="date" class="form-control" name="tanggal">
              </div>
            </div>
            <div class="row form-group">
              <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary" name="submit">Tambah</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    var app = {
      show: function() {
        $.ajax({
          url: "show.php",
          method: "GET",
          success: function(data) {
            $("#barang").html(data)
          }
        })
      },
      tampil: function() {
        var barang = $(this).val();
        $.ajax({
          url: "data.php",
          method: "POST",
          data: {
            barang: id_barang
          },
          success: function(data) {
            $("#jenisProduk").html(data)
          }
        })
      }
    }
    app.show();
    $(document).on("change", "#barang", app.tampil)
  })
</script>