<?php
include_once("../../controllers/database.php");

$ids = $_GET["id"];

if (hapus_barang($ids) > 0) {
    echo "
                <script>
                    alert ('Barang berhasil dihapus!');
                    document.location.href = 'data_barang.php';
                </script>
            ";
} else {
    echo "
                <script>
                    alert ('Barang gagal dihapus!');
                    document.location.href = 'data_barang.php';
                </script>
            ";
}
