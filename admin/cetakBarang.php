<?php
ob_start();

require '../functions.php';
require_once('../vendor/dompdf/autoload.inc.php');

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$hari_ini = date("d-m-Y");
$no = 1;

//barang harus join
$barang = $conn->query("SELECT barang.id_barang,barang.nama_barang, barang.harga, barang.stok, barang.gambar, satuan.nama_satuan, jenisbarang.nama_jenis FROM barang

JOIN satuan on barang.id_satuan = satuan.id_satuan
join jenisbarang on barang.id_jenis = jenisbarang.id_jenis");

$count = mysqli_num_rows($barang);

$admin = query("SELECT * from admin");

$html = '<title>Laporan Stok Barang</title><link rel="stylesheet" type="text/css" href="../assets/css/laporan.css">';

$html .= '<center><h3>Daftar Data Barang</h3></center><hr/><br/>';

$html .= '
        <div id="isi">
          <table border="1" cellpadding="10" cellspacing="0" width="100%">
            <thead style="background:#e8ecee">
              <tr class="tr-title">
                <th>No</th>
                <th>Nama Barang</th>
                <th>Harga Barang</th>
                <th>Stok</th>
                <th>Satuan</th>
                <th>Jenis Barang</th>
              </tr>
            </thead>';

$html .= '<tbody>';
$no = 1;
while ($row = mysqli_fetch_array($barang)) {
  $html .= "<tr>
 <td>" . $no . "</td>
 <td>" . $row['nama_barang'] . "</td>
 <td>" . $row['harga'] . "</td>
 <td>" . $row['stok'] . "</td>
 <td>" . $row['nama_satuan'] . "</td>
 <td>" . $row['nama_jenis'] . "</td>
 </tr>";
  $no++;
}

$html .= '</tbody>
        </table>';

$html .= "<br/>";

$html .= "

<div id='footer-tanggal'>
Tangerang Selatan, " . tanggal($hari_ini) . "
</div><br><br><br><br><br>

<div id='footer-nama'>
H. Syuhada, SH.
</div>

<div id='footer-jabatan'>
Dir. CV. Maheswari Sadara
</div>
    </div>
</body>

</html>";

$html .= "</html>";
$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'potrait');
// Rendering dari HTML Ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream('laporan_barang.pdf');
