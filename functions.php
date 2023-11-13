<?php
$conn = mysqli_connect("localhost", "root", "", "maheswari");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows = $row;
    }
    return $rows;
}

function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    //cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        echo "<script>
			alert('Pilih gambar dahulu');
			</script>";
        return false;
    }

    $ekstensiValid = ['jpg', 'jpeg', 'png', 'bmp'];
    $ekstensi = explode('.', $namaFile);
    $ekstensi = strtolower(end($ekstensi));

    if (!in_array($ekstensi, $ekstensiValid)) {
        echo "<script>
			alert('Bukan gambar nih');
			</script>";
        return false;
    }

    if ($ukuranFile > 2000000) {
        echo "<script>
			alert('Ukuran terlalu besar');
			</script>";
        return false;
    }

    //generate gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensi;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
    return $namaFileBaru;
}

function registrasi($data)
{
    global $conn;

    $nama = htmlspecialchars(stripslashes($data["nama"]));
    $username = htmlspecialchars(strtolower(stripslashes($data["username"])));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    $email = htmlspecialchars(strtolower($data["email"]));
    $no_telp = htmlspecialchars($data["no_telp"]);
    $alamat = htmlspecialchars($data["alamat"]);

    //upload gambar
    $gambar = upload();

    if (!$gambar) {
        return false;
    }

    //cek user sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM `admin` WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('Username yang dipilih sudah terdaftar!')
            </script>";
        return false;
    }

    //cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
            alert('Password tidak sesuai');
        </script>";
        return false;
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO `admin` VALUES('', '$nama','$username', '$password', '$email', '$no_telp', '$alamat', '$gambar')");

    return mysqli_affected_rows($conn);
}


function tambahBarang($data)
{
    global $conn;

    $nama_barang = htmlspecialchars($data["nama_barang"]);
    $harga = htmlspecialchars(($data["harga"]));
    $stok = htmlspecialchars($data["stok"]);
    $gambar = upload();
    if (!$gambar) {
        return false;
    }
    $id_satuan = htmlspecialchars($data["id_satuan"]);
    $id_jenis = htmlspecialchars(($data["id_jenis"]));

    $query = "INSERT INTO barang VALUES
                ('', '$nama_barang', '$harga', 0, '$gambar', '$id_satuan', '$id_jenis', '1')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function ubahBarang($data)
{
    global $conn;

    $id = $data["id"];
    $nama_barang = htmlspecialchars($data["nama_barang"]);
    $harga = htmlspecialchars(($data["harga"]));
    $stok = htmlspecialchars($data["stok"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);
    $nama_satuan = htmlspecialchars($data["nama_satuan"]);
    $nama_jenis = htmlspecialchars($data["nama_jenis"]);

    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }
    $query = "UPDATE barang SET
                    nama_barang = '$nama_barang',
                    harga = '$harga',
                    stok = '$stok',
                    gambar = '$gambar',
                    id_satuan = '$nama_satuan',
                    id_jenis = '$nama_jenis'
                WHERE id_barang = $id
    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapusBarang($id)
{
    global $conn;
    // mysqli_query($conn, "DELETE FROM barang WHERE id_barang = $id");
    mysqli_query($conn, "UPDATE barang SET status = '0' WHERE id_barang = $id");
    return mysqli_affected_rows($conn);
}

function tambahSatuanBarang($data)
{
    global $conn;

    $nama_satuan = htmlspecialchars($data["nama_satuan"]);

    $query = "INSERT INTO satuan VALUES
                ('', '$nama_satuan')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapusSatuan($id_satuan)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM satuan WHERE id_satuan = $id_satuan");
    return mysqli_affected_rows($conn);
}

function tambahJenisBarang($data)
{
    global $conn;

    $nama_jenis = htmlspecialchars($data["nama_jenis"]);

    $query = "INSERT INTO jenisbarang VALUES
                ('', '$nama_jenis')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapusJenisBarang($id_jenis)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM jenisbarang WHERE id_jenis = $id_jenis");
    return mysqli_affected_rows($conn);
}

function tambahEvent($data)
{
    global $conn;

    $nama_event = htmlspecialchars($data["nama_event"]);

    $query = "INSERT INTO event VALUES
                ('', '$nama_event')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function tambahJenisEvent($data)
{
    global $conn;

    $nama_jenis = htmlspecialchars($data["nama_jenis"]);
    $jenis_event = htmlspecialchars($data["id_event"]);
    $tanggal = htmlspecialchars($data["tanggal"]);

    $query = "INSERT INTO jenisevent VALUES
                ('', '$jenis_event','$nama_jenis','$tanggal')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapusEvent($id_event)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM `event` WHERE id_event = $id_event");
    return mysqli_affected_rows($conn);
}

function hapusJenisEvent($id_jevent)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM jenisevent WHERE id_jevent = $id_jevent");
    return mysqli_affected_rows($conn);
}

function ubahJenisEvent($data)
{
    global $conn;

    $id = $data["id"];
    $nama_event = htmlspecialchars($data["nama_event"]);
    $nama_jenis = htmlspecialchars($data["nama_jenis"]);
    $tanggal = htmlspecialchars($data["tanggal"]);

    $query = "UPDATE jenisevent SET
                    id_event = '$nama_event',
                    nama_jenis = '$nama_jenis',
                    tanggal = '$tanggal'
                WHERE id_jevent = $id
    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function tambahBasuk($data)
{
    global $conn;

    $id_barang = htmlspecialchars($data["id_barang"]);
    $jumlah_masuk = htmlspecialchars($data["jumlah_masuk"]);
    $tanggal_masuk = htmlspecialchars($data["tanggal_masuk"]);

    $query = "INSERT INTO barang_masuk VALUES
                ('', '$id_barang', '$jumlah_masuk', '$tanggal_masuk')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapusBasuk($id_barang_masuk)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM barang_masuk WHERE id_barang_masuk = $id_barang_masuk");
    return mysqli_affected_rows($conn);
}

function tambahBaluar($data)
{
    global $conn;

    $id_barang = htmlspecialchars($data["id_barang"]);
    $jumlah_keluar = htmlspecialchars($data["jumlah_keluar"]);
    $tanggal_keluar = htmlspecialchars($data["tanggal_keluar"]);

    $query = "INSERT INTO barang_keluar VALUES
                ('', '$id_barang', '$jumlah_keluar', '$tanggal_keluar')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapusBaluar($id_barang_keluar)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM barang_keluar WHERE id_barang_keluar = $id_barang_keluar");
    return mysqli_affected_rows($conn);
}

function ubahProfile($data)
{
    global $conn;

    $id_admin = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $username = htmlspecialchars(($data["username"]));
    $password = $data["password"];
    $email = htmlspecialchars($data["email"]);
    $no_telp = htmlspecialchars($data["no_telp"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $query = "UPDATE admin SET
                    nama = '$nama',
                    username = '$username',
                    password = '$password',
                    email = '$email',
                    gambar = '$gambar',
                    no_telp = '$no_telp',
                    alamat = '$alamat'
                WHERE id_admin = $id_admin
    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function ubahPelanggan($data)
{
    global $conn;

    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $no_telp = htmlspecialchars($data["no_telp"]);
    $alamat = htmlspecialchars($data["alamat"]);

    $query = "UPDATE `pelanggan` SET
                    nama = '$nama',
                    email = '$email',
                    no_telp = '$no_telp',
                    alamat = '$alamat'
                WHERE id_pelanggan = $id
    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapusPelanggan($id_pelanggan)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM pelanggan WHERE id_pelanggan = $id_pelanggan");
    return mysqli_affected_rows($conn);
}

function tambahPelanggan($data)
{
    global $conn;

    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $no_telp = htmlspecialchars($data["no_telp"]);
    $alamat = htmlspecialchars($data["alamat"]);

    $query = "INSERT INTO pelanggan VALUES
                ('', '$nama', '$email', '$no_telp', '$alamat')
    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function tambahPesanan($data)
{
    global $conn;

    $nama_pelanggan = htmlspecialchars($data["nama_pelanggan"]);
    $produk = htmlspecialchars($data["produk"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $tanggal = htmlspecialchars($data["tanggal"]);

    $query = "INSERT INTO pemesanan VALUES 
            ('', '$nama_pelanggan', '$produk', '$alamat' ,'$tanggal')
    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function ubahPemesanan($data)
{
    global $conn;

    $id = $data["id"];
    $nama_pelanggan = htmlspecialchars($data["nama"]);
    $jenis_produk = htmlspecialchars($data["jenis_produk"]);
    $tanggal = htmlspecialchars($data["tanggal"]);

    $query = "UPDATE pemesanan SET
                    id_pelanggan = '$nama_pelanggan',
                    jenis_produk = '$jenis_produk',
                    tanggal = '$tanggal'
                WHERE id_pesanan = $id 
    ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapusPemesanan($id_pemesanan)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM pemesanan WHERE id_pesanan = $id_pemesanan");
    return mysqli_affected_rows($conn);
}


function tanggal($tgl)
{
    $tanggal    = explode('-', $tgl);
    $kdbl        = $tanggal[1];

    if ($kdbl == '01') {
        $nbln = 'Januari';
    } else if ($kdbl == '02') {
        $nbln = 'Februari';
    } else if ($kdbl == '03') {
        $nbln = 'Maret';
    } else if ($kdbl == '04') {
        $nbln = 'April';
    } else if ($kdbl == '05') {
        $nbln = 'Mei';
    } else if ($kdbl == '06') {
        $nbln = 'Juni';
    } else if ($kdbl == '07') {
        $nbln = 'Juli';
    } else if ($kdbl == '08') {
        $nbln = 'Agustus';
    } else if ($kdbl == '09') {
        $nbln = 'September';
    } else if ($kdbl == '10') {
        $nbln = 'Oktober';
    } else if ($kdbl == '11') {
        $nbln = 'November';
    } else if ($kdbl == '12') {
        $nbln = 'Desember';
    } else {
        $nbln = '';
    }

    $tgl_ind = $tanggal[0] . " " . $nbln . " " . $tanggal[2];
    return $tgl_ind;
}
