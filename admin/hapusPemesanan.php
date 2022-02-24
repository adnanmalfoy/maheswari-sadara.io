<?php

//pengecekan session
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require "../functions.php";

$id = $_GET["id"];

if (hapusPemesanan($id) > 0) {
    echo "<script>
			alert ('Data Berhasil Dihapus');
			document.location.href = 'index.php?halaman=pemesanan';
		</script>";
} else {
    echo "<script>
	alert ('Data Gagal Dihapus');
	document.location.href = 'index.php?halaman=pemesanan';
	</script>
	";
}
