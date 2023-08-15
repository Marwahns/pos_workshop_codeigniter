<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Profile</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                            </div>
                            <h3 class="profile-username text-center"></h3>
                            <p class="text-muted text-center">Tanggal Daftar : <?= esc(date('d M Y', strtotime(get_user('created_at')))); ?></p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <form action="<?= base_url('profile/saveUpdateAccountProfile'); ?>" method="post" enctype="multipart/form-data" id="editProfileForm">
                                <input type="hidden" name="id" value="<?= get_user('id') ?>">

                                <div class="form-group row">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nama" id="nama" value="<?= get_user('nama') ?>">
                                        <small class="invalid-feedback"></small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="username" id="username" value="<?= get_user('username') ?>" readonly>
                                        <small class="invalid-feedback"></small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Alamat Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="email" id="email" value="<?= get_user('email') ?>" readonly>
                                        <small class="invalid-feedback"></small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" name="password" id="password" autocomplete="off">
                                        <small class="text-danger">Kosongkan jika tidak ingin diganti!</small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <textarea name="alamat" id="alamat" class="form-control"><?= get_user('alamat') ?></textarea>
                                        <small class="invalid-feedback"></small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <input type="hidden" name="id_status" value="<?= get_user('id_status') ?>">
                                    <input type="hidden" name="id_role" value="<?= get_user('id_role') ?>">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->