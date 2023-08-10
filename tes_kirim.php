<?php
include_once("helper/koneksi.php");
include_once("helper/function.php");

$login = cekSession();
if ($login == 0) {
    redirect("login.php");
}

if (post("pesan")) {
    $nomor = post("nomor");
    $pesan = post("pesan");

    //toastr_set("error", "fitur dimatikan sementara"); 

    $res = sendMSG($nomor, $pesan);
    if ($res['status'] == "true") {
        toastr_set("success", "Pesan terkirim");
    } else {
        toastr_set("error", $res['msg']);
    }
}
else if (post("nomormedia")) {
    $nomor = post("nomormedia");
    $pesan = post("pesan1");
    //$sender = post("sender");
    $url = post("linkmedia");
    $a = explode('/', $url);
    $filename = $a[count($a) - 1];
    $a2 = explode('.', $filename);
    //$namefile = $a2[count($a2) - 2];
    $filetype = $a2[count($a2) - 1];
    //$res = sendMedia($nomor, $pesan, $sender, $filetype, $namefile, $url);
	$res = sendIMG($nomor, $pesan,    $url);
    if ($res['status'] == "true") {
        toastr_set("success", "Pesan terkirim");
    } else {
        toastr_set("error", $res['msg']);
    }
}else{
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

    <title>Wa Blast - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" />
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
         <?php include "menu.php"; ?>
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

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                        </li>


                        <!-- Nav Item - Messages -->

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['username'] ?></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
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
				<div class="row">
                    <!-- DataTales Example -->
                    <div class="card shadow col-md-5 mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tes Kirim Pesan</h6>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <label> Nomor </label><br>
                                
								<input class="form-control" type="text" name="nomor" placeholder="08xxxxxxxx" required>
                                <br>
                                <label> Pesan </label>
                                <input class="form-control" type="text" name="pesan" required>
                                <br>
                                <button class="btn btn-success" type="submit">Kirim</button>
                            </form>
                        </div>
                    </div>
					<div class="card shadow  col-md-5 ml-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tes Kirim Media</h6>
                <p clas="small-text">Memungkinkan untuk mengirim jpg png dan pdf</p>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <label> Nomor Tujuan</label>
                    <input class="form-control" type="text" name="nomormedia" placeholder="08xxxxxxxx" required>
                    <br>
                    <label> Pesan </label>
                    <input class="form-control" type="text" name="pesan1">
                    <p class="small-text">Isi jika mengirim image</p>
                    
                    <label> Link Media </label>
                    <input class="form-control" type="text" name="linkmedia" required>
                    <p class="small-text">jpg/png/jpeg/pdf</p>
                    <p class="small-text">support png,jpg dan pdf</p>
                    
                    <!-- <label> Type File </label>
                    <input class="form-control" type="text" name="filetype" required>
                    <p class="small-text">jpg/png/jpeg/pdf</p>
                    <br> -->
                    <button class="btn btn-success" type="submit">Kirim</button>
                </form>
            </div>
        </div>
                </div>
                <!-- /.container-fluid -->
</div>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include "footer.php"; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
    <script>
        <?php

        toastr_show();

        ?>
    </script>
</body>

</html>