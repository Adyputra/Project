<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?> </h1>

    <div class="row">
        <div class="col-lg-5">

            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

            <?= $this->session->flashdata('message'); ?>

            <form action="<?= base_url('management/editsubmenu/' . $menu['id']); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Title Management</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?= $menu['title'] ?>" placeholder="Title Submenu Management">
                        <?= form_error('title', '<small class="text-danger pl-3">', '</small>'); ?>

                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->