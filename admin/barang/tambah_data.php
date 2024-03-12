<?php
include_once("../../controllers/database.php");

if (isset($_POST['submit'])) {
    if (tambah_barang($_POST) > 0) {
        echo "
            <script>
                alert ('Barang berhasil ditambahkan!');
                document.location.href = 'data_barang.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert ('Barang gagal ditambahkan!');
                document.location.href = 'data_barang.php';
            </script>
        ";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ADMIN | PETUGAS</title>

    <style>
        .form {
            margin: auto;
        }

        .button {
            width: 90px;
            margin-left: 670px;
        }
    </style>

    <script>
        function displayDateTime() {
            var date = new Date(); // Mendapatkan objek Date yang mewakili waktu saat ini
            var dateTimeString = date.toLocaleString(); // Mendapatkan tanggal dan waktu dalam format lokal
            document.getElementById("datetime").innerText = dateTimeString;
        }

        // Memanggil fungsi displayDateTime setiap detik
        setInterval(displayDateTime, 1000);
    </script>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- icon bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
    <?php
    session_start();
    if ($_SESSION['status'] != "login") {
        header("location:../../login.php?msg=belumlogin");
    }
    ?>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-info sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="gambar">
                    <img src="../../images/logo-bn666.png" alt="bn666" width="50">
                </div>
                <div class="sidebar-brand-text mx-3">SPB BN666</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="../index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="bi bi-clipboard2-fill"></i>
                    <span>Master</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">List data:</h6>
                        <a class="collapse-item" href="../user/data_user.php">User</a>
                        <a class="collapse-item" href="data_barang.php">Barang</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="../peminjaman/data_peminjaman.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Peminjaman</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                    <div class="row">
                            <div class="col-9">
                                <div class="sidebar-brand-text">
                                    <h1 style="margin-right: 730px; margin-top: 10px;">Admin</h1>
                                </div>
                            </div>
                            <div class="col-3">
                                <div id="datetime" style="margin-top: 24px;"></div>
                            </div>
                        </div>
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['username']; ?></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="../../logout.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Form -->
                    <div class="form card text-dark bg-white mb-3" style="max-width: 50rem;">
                        <div class="card-body">
                            <h5 class="card-title mb-4">
                                Tambah Data Barang
                                <i class="bi bi-box"></i>
                            </h5>
                            <form action="" method="post">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="kodebarang" placeholder="kode barang" name="kode_barang" required>
                                    <label for="kodebarang">Kode Barang</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="namabarang" placeholder="nama barang" name="nama_barang" required>
                                    <label for="namabarang">Nama Barang</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="ktg" placeholder="kategori" name="kategori" name="kategori" required>
                                    <label for="ktg">Kategori</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="merk" placeholder="merk" name="merk" required>
                                    <label for="merk">Merk</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="jumlah" placeholder="jumlah" name="jumlah" required>
                                    <label for="jumlah">Jumlah</label>
                                </div>
                        </div>
                        <div class="card-footer">
                            <div class="tombol">
                                <button type="submit" class="button btn btn-success" name="submit">
                                    <i class="bi bi-plus-circle-fill"></i>
                                    Kirim
                                </button>
                            </div>
                        </div>
                        </form>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->

</body>

</html>