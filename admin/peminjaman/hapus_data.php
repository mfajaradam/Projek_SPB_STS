<?php
include_once("../../controllers/database.php");

$ids = $_GET["id"];

if (hapus_peminjaman($ids) > 0) {
    echo "
                <script>
                    alert ('Pinjam berhasil dihapus!');
                    document.location.href = 'data_peminjaman.php';
                </script>
            ";
} else {
    echo "
                <script>
                    alert ('Pinjam gagal dihapus!');
                    document.location.href = 'data_peminjaman.php';
                </script>
            ";
}
