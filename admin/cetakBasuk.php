<?php

ob_start();
include "../functions.php";
require_once('../vendor/dompdf/autoload.inc.php');

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$hari_ini = date("d-m-Y");
$no = 1;

// ambil data hasil submit dari form
$tgl1     = $_POST['tgl_awal'];
$explode  = explode('-', $tgl1);
$tgl_awal = $explode[2] . "-" . $explode[1] . "-" . $explode[0];

$tgl2      = $_POST['tgl_akhir'];
$explode   = explode('-', $tgl2);
$tgl_akhir = $explode[2] . "-" . $explode[1] . "-" . $explode[0];

$basuk = $conn->query("SELECT barang_masuk.id_barang_masuk, barang.nama_barang, barang.stok ,barang_masuk.jumlah_masuk, barang_masuk.tanggal_masuk FROM barang_masuk

JOIN barang ON barang_masuk.id_barang = barang.id_barang
");

$admin = query("SELECT * from admin");

$html = '<title>Laporan Stok Barang</title><link rel="stylesheet" type="text/css" href="../assets/css/laporan.css">';

$html .= '
<body>
    <center>
        <h3>Laporan Data Barang Masuk</h3>
    </center>
    <hr /><br />';

$html .= "<center>Tanggal " . tanggal($tgl_awal) . " s.d. " . tanggal($tgl_akhir) . " </center><br />";

$html .= '<div id="isi">
        <table width="100%" border="0.3" cellpadding="0" cellspacing="0">
            <thead style="background:#e8ecee">
                <tr class="tr-title">
                    <th height="20" align="center" valign="middle">NO.</th>
                    <th height="20" align="center" valign="middle">TANGGAL</th>
                    <th height="20" align="center" valign="middle">NAMA BARANG</th>
                    <th height="20" align="center" valign="middle">JUMLAH MASUK</th>
                    <th height="20" align="center" valign="middle">STOK</th>
                </tr>
            </thead>';

$html .= '
            <tbody>';
// tampilkan data
while ($data = mysqli_fetch_assoc($basuk)) {
    $tanggal       = $data['tanggal_masuk'];
    $exp           = explode(' - ', $tanggal);
    $tanggal_keluar = tanggal($exp[2] . "-" . $exp[1] . "-" . $exp[0]);

    // menampilkan isi tabel dari database ke tabel di aplikasi
    $html .= "<tr>
                        <td width='40' height='13' align='center' valign='middle'>" . $no . "</td>
                        <td width='120' height='13' align='center' valign='middle'>" . $data['tanggal_masuk'] . "</td>
                        <td width='210' height='13' align='center' valign='middle'>" . $data['nama_barang'] . "</td>
                        <td width='50' height='13' align='center' valign='middle'>" . $data['jumlah_masuk'] . "</td>
                        <td width='50' height='13' align='center' valign='middle'>" . $data['stok'] . "</td>
                    </tr>";
    $no++;
}

$html .= '            </tbody>
        </table>';

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
//==========================================================================================================
$content = ob_get_clean();
$content = '<page style="font-family: freeserif">' . ($content) . '</page>';
// panggil library html2pdf

$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'potrait');
// Rendering dari HTML Ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream('laporan_barang_masuk.pdf');
