<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">SiLaper Media Jaya</h1>
                            <h1 class="h5 text-gray-900 mb-5">Ganti Password Akun</h1>
                        </div>
                        <form class="user" method="POST" action="<?= base_url('auth/prosesgantipassword/' . $datatoken['kode_reset']); ?>">
                            <div class="form-group">
                                <div class="col-sm-12 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password Baru">
                                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Konfirmasi Password Baru">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Ganti Password
                            </button>
                            <hr>
                        </form>
                        <div class="text-center">
                            <!-- <a class="small" href="<?= base_url('Auth'); ?>">Already have an account? Login!</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>