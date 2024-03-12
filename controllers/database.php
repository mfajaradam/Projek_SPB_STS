<?php
$conn = mysqli_connect("localhost", "root", "", "sistem_peminjaman_barang");

function cek_login($username, $password)
{
    global $conn;
    $uname = $username;
    $upass = $password;

    $sqls = mysqli_query($conn, "SELECT * FROM user WHERE username = '$uname' AND password = MD5('$upass')");

    $result = mysqli_num_rows($sqls);
    if ($result > 0) {
        $sql = mysqli_fetch_array($sqls);
        $_SESSION['id'] = $sql['id'];
        $_SESSION["username"] = $sql['username'];
        $_SESSION["role"] = $sql['role'];
        return true;
    } else {
        return false;
    }
}

function total_data($query)
{
    global $conn;

    $sql = mysqli_query($conn, $query);
    $rows = [];
    while ( $row = mysqli_fetch_array($sql) ) {
        $rows[] = $row;
    }
    return $rows;
}

// BARANG
// menampilkan data barang
function tampil_data($query)
{
    global $conn;
    $sql = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($sql)) {
        $rows[] = $row;
    }
    return $rows;
}

// menambah data barang
function tambah_barang($data)
{
    global $conn;

    $kode_barang = htmlspecialchars($data['kode_barang']);
    $nama_barang = htmlspecialchars($data['nama_barang']);
    $kategori = htmlspecialchars($data['kategori']);
    $merk = htmlspecialchars($data['merk']);
    $jumlah = htmlspecialchars($data['jumlah']);

    $sql = mysqli_query($conn, "INSERT INTO barang (id,kode_barang,nama_brg,kategori,merk,jumlah) VALUES (null, '$kode_barang', '$nama_barang' , '$kategori', '$merk' , '$jumlah')");
    return $sql;
}

// mengubah data barang
function ubah_barang($data)
{
    global $conn;

    $id = $data["id"];
    $kode_barang = htmlspecialchars($data['kode_barang']);
    $nama_barang = htmlspecialchars($data['nama_barang']);
    $kategori = htmlspecialchars($data['kategori']);
    $merk = htmlspecialchars($data['merk']);
    $jumlah = htmlspecialchars($data['jumlah']);

    $query = "UPDATE barang set
                kode_barang = '$kode_barang',
                nama_brg = '$nama_barang',
                kategori = '$kategori',
                merk = '$merk',
                jumlah = '$jumlah'
                WHERE id = '$id';
                ";
    $sql = mysqli_query($conn, $query);
    return $sql;
}

// hapus data barang
function hapus_barang($ids)
{
    global $conn;

    $sql = mysqli_query($conn, "DELETE FROM barang WHERE id = '$ids'");
    return $sql;
}


// USER
// Menampikan data user role peminjam
function tampil_user($query)
{
    global $conn;
    $sql = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($sql)) {
        $rows[] = $row;
    }
    return $rows;
}

// Menambahkan data user
function tambah_user($data)
{
    global $conn;

    $no_identitas = htmlspecialchars($data['no_identitas']);
    $nama = htmlspecialchars($data['nama']);
    $status = htmlspecialchars($data['status']);
    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars($data['password']);
    $role = htmlspecialchars($data['role']);
    $passmd5 = md5($password);

    $sql = mysqli_query($conn, "INSERT INTO user (id,no_identitas,nama,status,username,password,role) VALUES (null,'$no_identitas','$nama','$status','$username','$passmd5','$role')");
    return $sql;
}

// Mengubah data user
function edit_user($data)
{
    global $conn;

    $id = $data["id"];
    $no_identitas = htmlspecialchars($data['no_identitas']);
    $nama = htmlspecialchars($data['nama']);
    $status = htmlspecialchars($data['status']);
    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars($data['password']);
    $role = htmlspecialchars($data['role']);
    $passmd5 = md5($password);

    $query = "UPDATE user set
    no_identitas = '$no_identitas',
    nama = '$nama',
    status = '$status',
    username = '$username',
    password = '$passmd5',
    role = '$role'
    WHERE id = '$id';
    ";
    $sql = mysqli_query($conn, $query);
    return $sql;
}

// Menghapus data user
function hapus_user($ids)
{
    global $conn;

    $sql = mysqli_query($conn, "DELETE FROM user WHERE id = '$ids'");
    return $sql;
}


// PEMINJAMAN
// Menampilkan data
function tampil_peminjaman($query)
{
    global $conn;
    $sql = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($sql)) {
        $rows[] = $row;
    }
    return $rows;
}

// Menambah peminjaman
function tambah_peminjaman($data)
{
    global $conn;

    $tanggal_peminjaman = htmlspecialchars($data['tanggal_pinjam']);
    $tanggal_kembali = htmlspecialchars($data['tanggal_kembali']);
    $no_identitas = htmlspecialchars($data['no_identitas']);
    $kode_barang = htmlspecialchars($data['kode_barang']);
    $jumlah = htmlspecialchars($data['jumlah']);
    $keperluan = htmlspecialchars($data['keperluan']);
    $status = htmlspecialchars($data['status']);
    $id_login = htmlspecialchars($data['id_user']);

    $sql = mysqli_query($conn, "INSERT INTO peminjaman (id,tgl_pinjam,tgl_kembali,no_identitas,kode_barang,jumlah,keperluan,status,id_login) VALUES (null,'$tanggal_peminjaman','$tanggal_kembali','$no_identitas','$kode_barang','$jumlah','$keperluan','$status','$id_login')");
    return $sql;
}

// Mengubah peminjaman
function ubah_pinjam($data)
{
    global $conn;

    $id = $data["id"];
    $tanggal_peminjaman = htmlspecialchars($data['tanggal_pinjam']);
    $tanggal_kembali = htmlspecialchars($data['tanggal_kembali']);
    $no_identitas = htmlspecialchars($data['no_identitas']);
    $kode_barang = htmlspecialchars($data['kode_barang']);
    $jumlah = htmlspecialchars($data['jumlah']);
    $keperluan = htmlspecialchars($data['keperluan']);
    $status = htmlspecialchars($data['status']);
    $id_login = htmlspecialchars($data['id_user']);

    $query = "UPDATE peminjaman set
    tgl_pinjam = '$tanggal_peminjaman',
    tgl_kembali = '$tanggal_kembali',
    no_identitas = '$no_identitas',
    kode_barang = '$kode_barang',
    jumlah = '$jumlah',
    keperluan = '$keperluan',
    status = '$status',
    id_login = '$id_login'
    WHERE id = '$id';
    ";
    $sql = mysqli_query($conn, $query);
    return $sql;
}

// Menghapus data pinjam
function hapus_peminjaman($id)
{
    global $conn;

    $sql = mysqli_query($conn, "DELETE FROM peminjaman WHERE id = '$id'");
    return $sql;
}

function getTopPinjam() {
    global $conn;
    $sql = mysqli_query($conn,"
        SELECT peminjaman.kode_barang, barang.nama_brg, COUNT(peminjaman.kode_barang)
        as jumlah FROM barang INNER JOIN peminjaman ON barang.kode_barang = peminjaman.kode_barang
        GROUP BY barang.kode_barang, barang.nama_brg;
    ");
    $rows = [];
    while ($row = mysqli_fetch_array($sql)) {
        $rows[] = $row;
    }
    return $rows;
}