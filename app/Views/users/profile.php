<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Pengguna</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
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
                                <img class="img-fluid img-circle avatar" src="<?= base_url('adminLTE/dist/img/avatar.jpg' . esc($user->avatar)) ?>">
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
                        <?= form_open_multipart(base_url('/auth/do_update_profile'), ['csrf_id' => 'token']); ?>
                            <?= csrf_field(); ?>
                            <div class="card-body">

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
                                        <input type="text" class="form-control" name="username" id="username" value="<?= get_user('username') ?>">
                                        <small class="invalid-feedback"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Alamat Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="email" id="email" value="<?= get_user('email') ?>">
                                        <small class="invalid-feedback"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" name="password" id="password" autocomplete="off">
                                        <small class="text-danger">Kosongkan jika tidak ingin di ganti!</small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <textarea name="alamat" id="alamat" class="form-control"><?= get_user('alamat') ?></textarea>
                                        <small class="invalid-feedback"></small>
                                    </div>
                                </div>
                                <!-- <div class="form-group row">
                                <label for="avatar" class="col-sm-2 col-form-label">Photo Profile</label>
                                <div class="col-sm-2 d-none">
                                    <img class="img-thumbnail" id="img-preview">
                                </div>
                                <div class="col-sm-4">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="avatar" name="avatar">
                                        <label class="custom-file-label" for="avatar">Upload Photo</label>
                                        <small class="invalid-feedback"></small>
                                    </div>
                                </div>
                                </div> -->

                                <div class="form-group row">
                                    <input type="hidden" name="id" value="<?= get_user('id') ?>">
                                    <input type="hidden" name="id_rol" value="<?= get_user('id_role') ?>">
                                    <input type="hidden" name="id_status" value="<?= get_user('id_status') ?>">
                                    <input type="hidden" name="avatarLama" id="avatarLama" value="<?= esc($user->avatar); ?>">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" id="simpan" class="btn btn-success">Simpan</button>
                                    </div>
                                </div>
                            </div><!-- /.card-body -->
                        <?= form_close(); ?>
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