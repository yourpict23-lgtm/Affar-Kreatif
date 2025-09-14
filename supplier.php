<?php
require 'function.php';
require 'cek.php';

// Proses input supplier
if (isset($_POST['tambah'])) {
    $supplier = $_POST['supplier'];
    $telepon = $_POST['telepon'];
    // Normalisasi nomor telepon
    $telepon = preg_replace('/[^0-9]/', '', $telepon); // Hapus karakter non angka
    if (substr($telepon, 0, 1) == '0') {
        $telepon = '62' . substr($telepon, 1); // Ganti 0 di depan dengan 62
    }
    $email = $_POST['email'];
    $produk = $_POST['produk'];
    $area = $_POST['area'];
    $map = $_POST['map'];
    $note = $_POST['note'];

    $insert = mysqli_query($conn, "INSERT INTO supplier (supplier, telepon, email, produk, area, map, note) VALUES ('$supplier', '$telepon', '$email', '$produk', '$area', '$map', '$note')");
    if ($insert) {
        echo "<script>alert('Data supplier berhasil ditambah');window.location.href='supplier.php';</script>";
    } else {
        echo "<script>alert('Gagal menambah data');</script>";
    }
}
    // Proses hapus supplier
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $delete = mysqli_query($conn, "DELETE FROM supplier WHERE idsupplier='$id'");
    if ($delete) {
        echo "<script>window.location.href='supplier.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data');</script>";
    }
}
    // Proses edit supplier
if (isset($_POST['edit'])) {
    $id = $_POST['idsupplier'];
    $supplier = $_POST['supplier_edit'];
    $telepon = $_POST['telepon_edit'];
    $email = $_POST['email_edit'];
    $produk = $_POST['produk_edit'];
    $area = $_POST['area_edit'];
    $map = $_POST['map_edit'];
    $note = $_POST['note_edit'];

    $update = mysqli_query($conn, "UPDATE supplier SET supplier='$supplier', telepon='$telepon', email='$email', produk='$produk', area='$area', map='$map', note='$note' WHERE idsupplier='$id'");
    if ($update) {
        echo "<script>window.location.href='supplier.php';</script>";
    } else {
        echo "<script>alert('Gagal mengedit data');</script>";
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

    <title>Supplier</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-text mx-3">Operations Bussiness</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <!-- Nav Item - Tables -->
            <li class="nav-item active">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Supplier</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

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
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="logout.php">
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

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Supplier</h1>
                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Supplier</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <!-- Tombol Input Supplier -->
                                <button type="button" class="btn btn-sm btn-primary mb-2" data-toggle="modal" data-target="#modalInputSupplier">
                                    + Input Supplier
                                </button>  
                                <!-- Modal Input Supplier -->
                                <div class="modal fade" id="modalInputSupplier" tabindex="-1" role="dialog" aria-labelledby="modalInputSupplierLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <form method="POST" action="">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="modalInputSupplierLabel">Tambah Supplier</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Nama Supplier</label>
                                                <input type="text" name="supplier" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Telepon</label>
                                                <input type="text" name="telepon" class="form-control" required placeholder="Contoh : 081234567890 atau 6281234567890">
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" name="email" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Produk</label>
                                                <input type="text" name="produk" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Area</label>
                                                <input type="text" name="area" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Map</label>
                                                <input type="text" name="map" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Note</label>
                                                <input type="text" name="note" class="form-control">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                          <button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
                                        </div>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Supplier</th>
                                            <th>Telepon</th>
                                            <th>Email</th>
                                            <th>Produk</th>
                                            <th>Area</th>
                                            <th>Map</th>
                                            <th>Note</th>
                                            <th>Id</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = mysqli_query($conn, "SELECT * FROM supplier");
                                        while ($row = mysqli_fetch_assoc($query)) {
                                        ?>
                                        <tr>
                                            <td><?= htmlspecialchars($row['supplier']); ?></td>
                                            <td><?= htmlspecialchars($row['telepon']); ?></td>
                                            <td><?= htmlspecialchars($row['email']); ?></td>
                                            <td><?= htmlspecialchars($row['produk']); ?></td>
                                            <td><?= htmlspecialchars($row['area']); ?></td>
                                            <td><?= htmlspecialchars($row['map']); ?></td>
                                            <td><?= htmlspecialchars($row['note']); ?></td>
                                            <td><?= htmlspecialchars($row['idsupplier']); ?></td>
                                            <td>
                                                <!-- Action dropdown/tombol -->
                                                 <div class="dropdown">
                                                   <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                     Actions
                                                   </button>
                                                   <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                     <a class="dropdown-item" href="https://wa.me/<?= $row['telepon']; ?>" target="_blank">Hubungi</a>
                                                     <a class="dropdown-item" href="<?= htmlspecialchars($row['map']); ?>" target="_blank">Lihat Lokasi</a>
                                                     <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editModal<?= $row['idsupplier']; ?>">Edit</a>
                                                     <a class="dropdown-item" href="supplier.php?hapus=<?= $row['idsupplier']; ?>" onclick="return confirm('Yakin hapus?')">Delete</a>
                                                   </div>
                                                 </div>
                                            </td>
                                        </tr>
                                        <!-- Modal Edit Supplier -->
<div class="modal fade" id="editModal<?= $row['idsupplier']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $row['idsupplier']; ?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="POST" action="">
      <input type="hidden" name="idsupplier" value="<?= $row['idsupplier']; ?>">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel<?= $row['idsupplier']; ?>">Edit Supplier</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>Nama Supplier</label>
                <input type="text" name="supplier_edit" class="form-control" value="<?= htmlspecialchars($row['supplier']); ?>" required>
            </div>
            <div class="form-group">
                <label>Telepon</label>
                <input type="text" name="telepon_edit" class="form-control" value="<?= htmlspecialchars($row['telepon']); ?>" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email_edit" class="form-control" value="<?= htmlspecialchars($row['email']); ?>" required>
            </div>
            <div class="form-group">
                <label>Produk</label>
                <input type="text" name="produk_edit" class="form-control" value="<?= htmlspecialchars($row['produk']); ?>" required>
            </div>
            <div class="form-group">
                <label>Area</label>
                <input type="text" name="area_edit" class="form-control" value="<?= htmlspecialchars($row['area']); ?>" required>
            </div>
            <div class="form-group">
                <label>Map</label>
                <input type="text" name="map_edit" class="form-control" value="<?= htmlspecialchars($row['map']); ?>">
            </div>
            <div class="form-group">
                <label>Note</label>
                <input type="text" name="note_edit" class="form-control" value="<?= htmlspecialchars($row['note']); ?>">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" name="edit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
      </div>
    </form>
  </div>
</div>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
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

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>