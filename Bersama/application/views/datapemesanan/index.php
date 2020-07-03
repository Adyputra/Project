<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->


    <!-- <head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?> </h1>
  <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    </head>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3" marginright="20">
            <h6 class="m-0 font-weight-bold text-primary">Data Pemesanan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Kode Penjualan</th>
                            <th>Id Produk</th>
                            <th>Id Customer</th>
                            <th>Kode Akun Bank</th>
                            <th>qty</th>
                            <th>last price</th>
                            <th>unik</th>
                            <th>status</th>
                            <th>alamat kirim</th>
                            <th>no hp</th>
                            <th>catatan member</th>
                            <th>bukti tf</th>
                            <th>catatan status</th>
                            <th>create at</th>
                        </tr>
                    </thead>
                    <?php
                    foreach ($penjualan as $row) {
                    ?>
                        <tbody>
                            <tr>
                                <td><?php echo $row->kode_penjualan; ?></td>
                                <td><?php echo $row->id_produk; ?></td>
                                <td><?php echo $row->id_customer; ?></td>
                                <td><?php echo $row->kode_akunbank; ?></td>
                                <td><?php echo $row->qty; ?></td>
                                <td><?php echo $row->last_price; ?></td>
                                <td><?php echo $row->unik; ?></td>
                                <td><?php echo $row->status; ?></td>
                                <td><?php echo $row->alamat_kirim; ?></td>
                                <td><?php echo $row->no_hp; ?></td>
                                <td><?php echo $row->catatan_member; ?></td>
                                <td><?php echo $row->bukti_tf; ?></td>
                                <td><?php echo $row->catatan_status; ?></td>
                                <td><?php echo $row->create_at; ?></td>
                            </tr>
                        <?php
                    }
                        ?>
                        </tbody>
                </table>
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
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->