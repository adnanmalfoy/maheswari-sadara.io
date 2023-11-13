<?php

include "../functions.php";

if (isset($_POST["submit"])) {
   //cek apakah data berhasil dikirimkan atau tidak
   if (tambahPelanggan($_POST) > 0) {
      // var_dump($_POST);
      // die;
      echo "<script>
				alert ('Data Berhasil Ditambahkan');
				document.location.href = 'index.php?halaman=pelanggan';
			</script>";
   } else {
      echo "<script>
				alert ('Data Gagal Ditambahkan');
				document.location.href = 'index.php?halaman=pelanggan';
			</script>";
   }
}

$pelanggan = $conn->query("SELECT * FROM pelanggan");

?>

<div class="container-fluid">
   <h2 class="h3 mb-4 text-gray-800">Pelanggan</h2>

   <div class="card-shadow-sm border-bottom-primary">
      <div class="card-header bg-white py-3">
         <div class="row">
            <div class="col">
               <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                  Data Pelanggan
               </h4>
            </div>
            <div class="col-auto">
               <!-- Button trigger modal -->
               <button type="button" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#exampleModal">
                  <i class="fa fa-plus"></i>
                  Tambah Data Pelanggan
               </button>
            </div>
         </div>

         <div class="table-responsive">
            <table class="table table-striped table-bordered w-100 dt-responsive nowrap" id="dataTable" width="100%" cellspacing="0">
               <thead class="thead-light mt-2">
                  <tr>
                     <td width="50px">No.</td>
                     <td>Nama Pelanggan</td>
                     <td>Email</td>
                     <td>No. Telp</td>
                     <td>Alamat</td>
                     <td width="220px">Aksi</td>
                  </tr>
               </thead>

               <tbody>
                  <?php $i = 1; ?>
                  <?php global $conn; ?>
                  <?php foreach ($pelanggan as $row) : ?>
                     <tr>
                        <td><?= $i; ?></td>
                        <td><?= $row["nama"]; ?></td>
                        <td><?= $row["email"]; ?></td>
                        <td><?= $row["no_telp"]; ?></td>
                        <td><?= $row["alamat"]; ?></td>
                        <td align="center">
                           <a href="index.php?halaman=ubahPelanggan&id=<?= $row['id_pelanggan']; ?>" class="btn btn-warning"><i class="fas fa-trash mr-1"></i>Ubah</a>
                           <a href="index.php?halaman=hapusPelanggan&id=<?= $row['id_pelanggan']; ?>" onclick="return confirm('Yakin ?');" class="btn btn-danger"><i class="fas fa-trash mr-1"></i>Hapus</a>
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

<a class="scroll-to-top rounded" href="#page-top">
   <i class="fas fa-angle-up"></i>
</a>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Form Tambah Data Pelanggan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form method="post" action="" enctype="multipart/form-data">
               <div class="row form-group">
                  <label class="col-md-4 text-md-right">Nama Pelanggan</label>
                  <div class="col-md-8">
                     <input type="text" class="form-control" name="nama" required>
                  </div>
               </div>
               <div class="row form-group">
                  <label class="col-md-4 text-md-right">Email</label>
                  <div class="col-md-8">
                     <input type="text" class="form-control" name="email" required>
                  </div>
               </div>
               <div class="row form-group">
                  <label class="col-md-4 text-md-right">No Telp</label>
                  <div class="col-md-8">
                     <input type="text" class="form-control" name="no_telp" required>
                  </div>
               </div>
               <div class="row form-group">
                  <label class="col-md-4 text-md-right">Alamat</label>
                  <div class="col-md-8">
                     <input type="textarea" class="form-control" name="alamat" required>
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