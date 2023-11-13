<?php ob_start();

require '../functions.php';
require_once('../vendor/dompdf/autoload.inc.php');

$id = $_GET["id"];

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$hari_ini = date("d-m-Y");
$no = 1;

$pmsn = $conn->query("SELECT pemesanan.id_pesanan,pelanggan.id_pelanggan, pelanggan.nama, pelanggan.alamat,pemesanan.jenis_produk, pemesanan.tanggal FROM pemesanan JOIN pelanggan on pemesanan.id_pelanggan = pelanggan.id_pelanggan WHERE id_pesanan = $id");
// var_dump($pmsn);
// die;

$html = '<title>Laporan Pemesanan</title><link rel="stylesheet" type="text/css" href="../assets/css/laporan.css">';
$html .= '<h1>Laporan Pemesanan</h1>';
$html .= '<div id="isi">
        <table border="1" cellpadding="10" cellspacing="0" width="100%">
            <thead style="background:#e8ecee">
            <tr class="tr-title">
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Produk</th>
                <th>Alamat Pelanggan</th>
                <th>Tanggal Pemesan</th>
            </tr>
            </thead>';

$html .= '<tbody>';
$no = 1;
while ($row = mysqli_fetch_array($pmsn)) {
    $html .= "<tr>
 <td>" . $no . "</td>
 <td>" . $row['nama'] . "</td>
 <td>" . $row['jenis_produk'] . "</td>
 <td>" . $row['alamat'] . "</td>
 <td>" . $row['tanggal'] . "</td>
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
$content = ob_get_clean();
$content = '<page style="font-family: freeserif">' . ($content) . '</page>';

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'potrait');
$dompdf->render();
$dompdf->stream('laporan_pemesanan.pdf');
