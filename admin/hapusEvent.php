<?php

//pengecekan session
if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
}

require "../functions.php";

$id = $_GET["id"];

if (hapusEvent($id) > 0) {
	echo "<script>
			alert ('Data Berhasil Dihapus');
			document.location.href = 'index.php?halaman=dataEvent';
		</script>";
} else {
	echo "<script>
			document.location.href = 'index.php?halaman=dataEvent';
		</script>";
}
