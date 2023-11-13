<?php
ob_start();

require '../functions.php';
require_once('../vendor/dompdf/autoload.inc.php');

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$hari_ini = date("d-m-Y");
$no = 1;

$jevent = $conn->query("SELECT jenisevent.id_jevent, event.nama_event, jenisevent.nama_jenis, event.id_event, jenisevent.tanggal FROM jenisevent

JOIN event ON jenisevent.id_event = event.id_event");

$count = mysqli_num_rows($jevent);

$html = '<title>Laporan Stok Barang</title><link rel="stylesheet" type="text/css" href="../assets/css/laporan.css">';

$html .= '<center><h3>Daftar Data Event</h3></center><hr/><br/>';

$html .= '<div id="isi">
        <table border="1" cellpadding="10" cellspacing="0" width="100%">
            <thead style="background:#e8ecee">
            <tr class="tr-title">
                <th>No</th>
                <th>Nama Event</th>
                <th>Jenis Event</th>
                <th>Tanggal Event</th>
            </tr>
            </thead>';

$html .= '<tbody>';
$no = 1;
while ($row = mysqli_fetch_array($jevent)) {
    $html .= "<tr>
 <td>" . $no . "</td>
 <td>" . $row['nama_event'] . "</td>
 <td>" . $row['nama_jenis'] . "</td>
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

$html .= "</html>";
$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'potrait');
// Rendering dari HTML Ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream('laporan_event.pdf');
