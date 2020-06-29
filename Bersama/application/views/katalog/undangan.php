<!-- Begin Page Content -->
<div class="container-fluid">
<div class="container-fluid">
<a href="<?php echo base_url('katalog/index') ?>" class="btn btn-light btn-icon-split">
    <span class="icon text-gray-600">
    <i class="fas fa-arrow-right"></i>
    </span>
    <span class="text">Kembali</span>
</a>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?> </h1>
    <?php
        foreach ($tbundangan as $row) {
    ?>
    <div class="row">
        
    </div>
    <div class="card mb-3" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="<?= base_url('assets/img/profile/') . $row->image; ?> " class="card-img">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                <h5 class="card-title"><?php echo $row->nama_undangan; ?></h5>
                <p class="card-text"><?php echo $row->deskripsi; ?></p>
                <p class="card-text"><?php echo $row->harga; ?></p>
                </div>
            </div>
        </div>
    </div>
<?php
        }
?>
</div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->