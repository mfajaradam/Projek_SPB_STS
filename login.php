<?php
include_once("controllers/database.php");
session_start();
if (isset($_POST['submit'])) {
  $username = $_POST['usernames'];
  if (cek_login($_POST['usernames'], $_POST['passwords'])) {
    $_SESSION['username'] = $username;
    $_SESSION['status'] = "login";
    if ($_SESSION['role'] == "admin") {
      header("location:admin/index.php");
    } else {
      header("location:member/index.php");
    }
  } else {
    header("location:login.php?msg=gagal");
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Login</title>

  <style>
    .img {
      margin-top: 40px;
      margin-left: 120px;
    }

    h2 {
      margin-left: 57px;
    }
  </style>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet" />
</head>

<body class="bg-gradient-info">
  <div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-gradient-primary">
                <div class="img">
                  <img src="images/logo-bn666.png" alt="" width="200">
                </div>
                <div class="judul text-white">
                  <h2 style="font-size: 24px; margin-top: 30px;">SMK BAKTI NUSANTARA 666</h2>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">LOGIN</h1>
                  </div>
                  <form class="user" method="post">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" name="usernames" aria-describedby="emailHelp" placeholder="Username" />
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="passwords" placeholder="Password" />
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck" />
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <div class="d-grid gap-2">
                      <button class="btn btn-primary btn-user btn-block" type="submit" name="submit">Kirim</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
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
</body>

</html>