<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add New Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('users/index') ?>">Pengguna</a></li>
                        <li class="breadcrumb-item active">Add New Users</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- left column -->
            <!-- general form elements -->
            <div class="card card-primary">
                <!-- /.card-header -->
                <!-- form start -->
                <form action="<?= base_url('users/saveAccount') ?>" method="POST" id="create-form" enctype="multipart/form-data">
                    <div class="card-body">
                        <input type="hidden" name="id">
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input type="text" class="form-control" placeholder="Input Name" id="nama" name="nama" required="required" value="<?= !empty($request->getPost('nama')) ? $request->getPost('nama') : '' ?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Alamat</label>
                            <input type="text" class="form-control" placeholder="Input Alamat" id="alamat" name="alamat" required="required" value="<?= !empty($request->getPost('alamat')) ? $request->getPost('alamat') : '' ?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" class="form-control" placeholder="Input Username" id="username" name="username" required="required" value="<?= !empty($request->getPost('username')) ? $request->getPost('username') : '' ?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" placeholder="Input Email" id="email" name="email" required="required" value="<?= !empty($request->getPost('email')) ? $request->getPost('email') : '' ?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="text" class="form-control" placeholder="Input Password" id="password" name="password" required="required" value="<?= !empty($request->getPost('password')) ? $request->getPost('password') : '' ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="regular-form-1" class="control-label">Hak Akses</label><br>
                            <select class="form-control select2" name="id_role" id="id_role" required>
                                <option value="" selected disabled>Pilih Role</option>
                                <?php foreach ($id_role as $key => $value) { ?>
                                    <option <?= !empty($request->getPost('id_role')) && $request->getPost('id_role') == $value->id ? 'selected' : '' ?> value="<?= $value->id ?>"><?= $value->role ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="regular-form-1" class="control-label">Status Account</label><br>
                            <select class="form-control select2" name="id_status" id="id_status" required>
                                <option value="" selected disabled>Pilih Status Account</option>
                                <?php foreach ($id_status as $key => $value) { ?>
                                    <option <?= !empty($request->getPost('id_status')) && $request->getPost('id_status') == $value->id ? 'selected' : '' ?> value="<?= $value->id ?>"><?= $value->status ?></option>
                                <?php } ?>
                            </select>
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="reset" form="create-form" class="btn btn-danger w-24">Reset</button>
                        <a class="btn btn-primary w-24 mr-1" href="<?= base_url('users/index/') ?>">Cancel</a>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
            <!--/.col (left) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>