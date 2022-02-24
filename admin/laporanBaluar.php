<div class="container-fluid">
    <h2 class="h3 mb-4 text-gray-800">Cetak Barang</h2>

    <div class="card shadow-sm border-bottom-primary">
        <div class="card-header bg-white py-3">
            <div class="row">
                <div class="col">
                    <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                        Laporan Data Barang Keluar
                    </h4>
                </div>
            </div>

            <div class="box box-primary mt-5">
                <form action="cetakBaluar.php" method="post" role="form" class="form-horizontal" target="_blank">
                    <div class="box-body">

                        <div class="row mt-5">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="tgl_awal">Tanggal</label>
                                    <input type="date" class="col-md-6 ml-3" data-date-format="dd-mm-yyyy" name="tgl_awal" autocomplete="off" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tgl_akhir" style="margin-left: -130px;">s.d.</label>
                                    <input type="date" class="col-md-8 ml-3" data-date-format="dd-mm-yyyy" name="tgl_akhir" autocomplete="off" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-md-9 ml-auto">
                                        <button type="submit" class="btn btn-primary btn-social btn-submit">
                                            <i class="fa fa-print"></i> Cetak
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>


        </div>
    </div>
</div>