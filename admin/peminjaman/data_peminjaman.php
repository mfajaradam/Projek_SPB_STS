<?php
include_once("../../controllers/database.php");

$query = tampil_peminjaman(
    // "SELECT * FROM peminjaman"
    "SELECT peminjaman.id, peminjaman.tgl_pinjam, peminjaman.tgl_kembali, peminjaman.no_identitas, user.nama, peminjaman.kode_barang, barang.nama_brg,peminjaman.jumlah, peminjaman.keperluan, peminjaman.status,peminjaman.id_login
    FROM peminjaman
    INNER JOIN barang ON peminjaman.kode_barang = barang.kode_barang
    INNER JOIN user ON peminjaman.no_identitas = user.no_identitas;
"
);

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
        .box {
            color: black;
            background-color: white;
            padding: 10px;
        }

        .tambah {
            margin-left: 570px;
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

    <!-- css tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

    <!-- js -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

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
                        <a class="collapse-item" href="../barang/data_barang.php">Barang</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="data_peminjaman.php">
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

                <!-- tabel barang -->
                <section>
                    <div class="container pb-5">
                        <div class="box">
                            <div class="row">
                                <div class="col">
                                    <h1 class="judul">Peminjaman</h1>
                                </div>
                                <div class="col mt-2 text-end">
                                    <a class="btn btn-success" href="tambah_data.php" role="button">
                                        <i class="bi bi-file-earmark-plus"></i> Tambah Data
                                    </a>
                                </div>
                            </div>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-striped" id="example" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Tanggal Pinjam</th>
                                            <th scope="col">Tanggal Kembali</th>
                                            <th scope="col">No Identitas</th>
                                            <th scope="col">Nama Peminjam</th>
                                            <th scope="col">Kode Barang</th>
                                            <th scope="col">Nama Barang</th>
                                            <th scope="col">Jumlah</th>
                                            <th scope="col">Keperluan</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">ID User</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1 ?>
                                        <?php foreach ($query as $data) : ?>
                                            <tr>
                                                <th scope="row"><?= $i; ?></th>
                                                <td><?= $data['tgl_pinjam'] ?></td>
                                                <td><?= $data['tgl_kembali'] ?></td>
                                                <td><?= $data['no_identitas'] ?></td>
                                                <td><?= $data['nama'] ?></td>
                                                <td><?= $data['kode_barang'] ?></td>
                                                <td><?= $data['nama_brg'] ?></td>
                                                <td><?= $data['jumlah'] ?></td>
                                                <td><?= $data['keperluan'] ?></td>
                                                <td><?= $data['status'] ?></td>
                                                <td><?= $data['id_login'] ?></td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a class="btn btn-primary" href="edit_data.php?id=<?= $data['id']; ?>" role="button">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                        <a class="btn btn-danger" href="hapus_data.php?id=<?= $data['id']; ?>" onclick="return confirm('yakin?, data mau dihapus');" role="button">
                                                            <i class="bi bi-trash-fill"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>


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

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

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

    <!-- js tables -->
    <script>
        new DataTable('#example');
    </script>

</body>

</html>