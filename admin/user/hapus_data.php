<?php
include_once("../../controllers/database.php");

$ids = $_GET["id"];

if (hapus_user($ids) > 0) {
    echo "
                <script>
                    alert ('User berhasil dihapus!');
                    document.location.href = 'data_user.php';
                </script>
            ";
} else {
    echo "
                <script>
                    alert ('User gagal dihapus!');
                    document.location.href = 'data_user.php';
                </script>
            ";
}
