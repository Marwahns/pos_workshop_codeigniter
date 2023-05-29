<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit This Record User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Pengguna</a></li>
                        <li class="breadcrumb-item active">Account Users</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <form action="<?= base_url('users/saveEditAccount') ?>" method="POST" id="edit-form" enctype="multipart/form-data">
                    <div class="card-body">
                        <input type="hidden" name="id" value="<?= isset($data['id']) ? $data['id'] : '' ?>">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required="required" value="<?= isset($data['nama']) ? $data['nama'] : '' ?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" required="required" value="<?= isset($data['alamat']) ? $data['alamat'] : '' ?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required="required" value="<?= isset($data['username']) ? $data['username'] : '' ?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required="required" value="<?= isset($data['email']) ? $data['email'] : '' ?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="text" class="form-control" placeholder="Input Password" id="password" name="password" value="<?= !empty($request->getPost('password')) ? $request->getPost('password') : '' ?>">
                        </div>

                        <div class="form-group">
                            <label for="regular-form-1" class="control-label">Hak Akses</label><br>
                            <select class="form-control select" name="id_role" id="id_role" required>
                                <option value="" selected disabled>Pilih Role</option>
                                <?php foreach ($id_role as $key => $value) { ?>
                                    <option <?= isset($data['id_role']) && $data['id_role'] == $value->id ? 'selected' : '' ?> value="<?= $value->id ?>"><?= $value->role ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="regular-form-1" class="control-label">Status Account</label><br>
                            <select class="form-control select" name="id_status" id="id_status" required>
                                <option value="" selected disabled>Pilih Status Account</option>
                                <?php foreach ($id_status as $key => $value) { ?>
                                    <option <?= isset($data['id_status']) && $data['id_status'] == $value->id ? 'selected' : '' ?> value="<?= $value->id ?>"><?= $value->status ?></option>
                                <?php } ?>
                            </select>
                        </div>

                    </div>

                    <div class="card-footer">
                        <a class="btn btn-primary w-24 mr-1" href="<?= base_url('users/index/') ?>">Cancel</a>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>

                </form>

            </div>
        </div>
    </section>
</div>