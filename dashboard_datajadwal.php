<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}

$sql = "SELECT COUNT(*) as total FROM tbl_jadwal";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_rows = $row['total'];
} else {
    $total_rows = 0;
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
        <title>Data Jadwal</title>
        <link href="assets/styles/dashboard-style.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="dashboard-admin.php">Dashboard Admin</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Data Master</div>
                            <a class="nav-link" href="dashboard_admin.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Data User
                            </a>
                            <a class="nav-link" href="dashboard_datajadwal.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Data Jadwal
                            </a>
                            <a class="nav-link" href="dashboard_datadonasi.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Data Donasi
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php echo $_SESSION['admin_name'] ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Data Jadwal</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">List data jadwal website NutriShare</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Total Jadwal: <?php echo $total_rows;?></div>
                                        <div class="card-footer d-flex align-items-center justify-content-between">
                                            <a class="small text-white stretched-link" href="#dataTable">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <!-- Button to Open the Modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah">
                                Tambah Data
                                </button>
                                <a href="export_data_jadwal.php" class="btn btn-info">Export Data</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Nomor</th>
                                                <th>Tanggal</th>
                                                <th>Keterangan</th>
                                                <th>Nama Koordinator</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $ambilsemuadatajadwal = mysqli_query($conn, "select * from tbl_jadwal");
                                            $i = 1;
                                            while ($data = mysqli_fetch_array($ambilsemuadatajadwal)) {
                                                $id = $data['id_jadwal'];
                                                $tgl = $data['tanggal'];
                                                $ket = $data['keterangan_jadwal'];
                                                $koor = $data['nama_koor'];
                                                $id_user = $data['id_user'];
                                            ?> 
                                            <tr>
                                                <td><?=$i++;?></td>
                                                <td><?=$tgl;?></td>
                                                <td><?=$ket;?></td>
                                                <td><?=$koor;?></td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$id;?>">Edit</button>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$id;?>">Delete</button>
                                                </td>
                                            </tr>

                                                <!-- edit modal -->
                                                <div class="modal fade" id="edit<?=$id;?>">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                        <h4 class="modal-title">Edit Data</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                                
                                                        <!-- Modal body -->
                                                        <form method="post">
                                                        <div class="modal-body">
                                                        <input type="hidden" name="id" value="<?php echo $id;?>">
                                                        Tanggal
                                                        <input type="date" name="tgl" value="<?=$tgl;?>" class="form-control" required>
                                                        <br>
                                                        Keterangan Jadwal
                                                        <input type="varchar" name="ket" value="<?=$ket;?>" class="form-control" required>
                                                        <br>
                                                        Koordinator
                                                        <select name="koor" required>
                                                            <?php
                                                            $type = "koor";
                                                            $ambildatauser = mysqli_query($conn, "select id_user, nama_user from tbl_user where user_type='$type'");
                                                            while ($data = mysqli_fetch_array($ambildatauser)) {
                                                                if ($data['id_user'] == $id_user) {
                                                                    echo "<option value='" . $data["id_user"] . "' selected>" . $data["nama_user"] . "</option>";
                                                                } else {
                                                                    echo "<option value='" . $data["id_user"] . "'>" . $data["nama_user"] . "</option>";
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                        <br>
                                                        <br>
                                                        <button type="submit" class="btn btn-primary" name="updatejadwal">Submit</button>
                                                        </div>
                                                        </form>  

                                                    </div>
                                                    </div>
                                                </div>

                                                <!-- delete modal -->
                                                <div class="modal fade" id="delete<?=$id;?>">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                        <h4 class="modal-title">Delete Data</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                                
                                                        <!-- Modal body -->
                                                        <form method="post">
                                                        <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus data ini?
                                                        <input type="hidden" name="id" value="<?php echo $id;?>">
                                                        <br>
                                                        <br>
                                                        <button type="submit" class="btn btn-danger" name="deletejadwal">Submit</button>
                                                        </div>
                                                        </form>  

                                                    </div>
                                                    </div>
                                                </div>


                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; NutriShare 2024</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>

    <!-- The Modal -->
    <div class="modal fade" id="tambah">
        <div class="modal-dialog">
        <div class="modal-content">
      
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Tambah Data</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <form method="post">
            <div class="modal-body">
                Tanggal
                <input type="date" name="tgl" placeholder="Tanggal" class="form-control" required>
                <br>
                Keterangan Jadwal
                <input type="varchar" name="ket" placeholder="Keterangan" class="form-control" required>
                <br>
                Koordinator
                <select name="koor" required>
                <?php
                $type = "koor";
                $ambildatauser = mysqli_query($conn, "select id_user, nama_user from tbl_user where user_type='$type'");
                while ($data = mysqli_fetch_array($ambildatauser)) {
                    echo "<option value='" . $data["id_user"] . "'>" . $data["nama_user"] . "</option>";
                }
                ?>
                </select>
                <input type="hidden" name="id_koor" value="<?$data["id_user"]?>">
                <br>
                <br>
                <button type="submit" class="btn btn-primary" name="addnewjadwal">Submit</button>
            </div>
            </form>
        </div>
    </div>
</html>
