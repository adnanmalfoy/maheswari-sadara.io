<?php

include "../functions.php";

//cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
  //cek apakah data berhasil dikirimkan atau tidak
  if (tambahBarang($_POST) > 0) {
    echo "<script>
				alert ('Data Berhasil Ditambahkan');
				document.location.href = 'index.php?halaman=dataBarang';
			</script>";
  } else {
    echo "<script>
				alert ('Data Gagal Ditambahkan');
				document.location.href = 'index.php?halaman=dataBarang';
			</script>";
  }
}

//barang harus join
$barang = $conn->query("SELECT barang.id_barang,barang.nama_barang, barang.harga, barang.stok, barang.gambar, satuan.nama_satuan, jenisbarang.nama_jenis FROM barang

JOIN satuan on barang.id_satuan = satuan.id_satuan
join jenisbarang on barang.id_jenis = jenisbarang.id_jenis
WHERE status = '1'");

$satuan = $conn->query("SELECT * FROM satuan");
$jenis = $conn->query("SELECT * FROM jenisbarang");
?>

<div class="container-fluid">
  <h2 class="h3 mb-3 text-gray-800">Barang</h2>

  <div class="card-shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
      <div class="row">
        <div class="col">
          <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
            Data Barang
          </h4>
        </div>
        <div class="col-auto">
          <a class="btn btn-success btn-social my-2" class="cetak" href="cetakBarang.php" target="_blank">
            <i class="fa fa-print"></i> Cetak
          </a>
        </div>
        <div class="col-auto">
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary my-2 btn-icon-split" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-plus mr-3"></i>Tambah Data Barang </button>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-striped w-100 dt-responsive nowrap" id="dataTable" width="100%" cellspacing="0">
          <thead class="thead-light">
            <tr>
              <th>No</th>
              <th width="235px">Nama Barang</th>
              <th width="115px">Harga Rp.</th>
              <th>Stock</th>
              <th>Gambar</th>
              <th>Satuan</th>
              <th>Jenis Barang</th>
              <th>Aksi</th>
            </tr>
          </thead>

          <tbody>
            <?php $i = 1; ?>
            <?php global $conn; ?>
            <?php foreach ($barang as $row) : ?>
              <tr>
                <td><?= $i; ?></td>
                <td><?= $row["nama_barang"]; ?></td>
                <td>Rp. <?= number_format($row["harga"]); ?></td>
                <td><?= $row["stok"]; ?></td>
                <td><img src="img/<?= $row["gambar"]; ?>" width="80px"></td>
                <td><?= $row["nama_satuan"]; ?></td>
                <td><?= $row["nama_jenis"]; ?></td>
                <td>
                  <a href="index.php?halaman=ubahBarang&id=<?= $row['id_barang']; ?>" class="btn btn-warning"><i class="fas fa-edit mr-1"></i>Ubah</a>
                  <a href="index.php?halaman=hapusBarang&id=<?= $row["id_barang"]; ?>" onclick="return confirm('Yakin ingin menghapus ?');" class="btn btn-danger"><i class="fas fa-trash mr-1"></i>Hapus</a>
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
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="row form-group">
            <label for="nama" class="col-md-4 text-md-right">Nama Barang</label>
            <div class="col-md-7">
              <div class="input-group">
                <input type="text" name="nama_barang" class="form-control" required autofocus>
              </div>
            </div>
          </div>
          <div class="row form-group">
            <label for="harga" class="col-md-4 text-md-right">Harga Barang</label>
            <div class="col-md-7">
              <div class="input-group">
                <input type="text" name="harga" class="form-control" required>
              </div>
            </div>
          </div>
          <div class="row form-group">
            <!-- <label for="stok" class="col-md-4 text-md-right">Stok</label> -->
            <div class="col-md-7">
              <div class="input-group">
                <input type="hidden" name="stok" class="form-control" required>
              </div>
            </div>
          </div>
          <div class="row form-group">
            <label for="gambar" class="col-md-4 text-md-right">Gambar</label>
            <div class="col-md-7">
              <div class="input-group">
                <input type="file" name="gambar" class="form-control" required>
              </div>
            </div>
          </div>
          <div class="row form-group">
            <label for="id_satuan" class=" col-md-4 text-md-right">Satuan Barang</label>
            <div class="col-md-7">
              <div class="input-group">
                <select class="custom-select" id="id_satuan" name="id_satuan">
                  <option value="" selected disabled>Pilih Satuan</option>
                  <?php foreach ($satuan as $s) : ?>
                    <option value="<?= $s["id_satuan"]; ?>"><?= $s["nama_satuan"]; ?></option>
                  <?php endforeach ?>
                </select>
                <div class="input-group-append">
                  <a class="btn btn-primary" href="index.php?halaman=satuanBarang"><i class="fa fa-plus"></i></a>
                </div>
              </div>
            </div>
          </div>
          <div class="row form-group">
            <label for="id_jenis" class="col-md-4 text-md-right">Jenis Barang</label>
            <div class="col-md-7">
              <div class="input-group">
                <select class="custom-select" id="id_jenis" name="id_jenis">
                  <option value="" selected disabled>Pilih Jenis</option>
                  <?php foreach ($jenis as $j) : ?>
                    <option value="<?= $j["id_jenis"]; ?>"><?= $j["nama_jenis"]; ?></option>
                  <?php endforeach ?>
                </select>
                <div class="input-group-append">
                  <a class="btn btn-primary" href="index.php?halaman=jenisBarang"><i class="fa fa-plus"></i></a>
                </div>
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