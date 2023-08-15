<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User Details</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Pengguna</a></li>
                        <li class="breadcrumb-item active">User Details</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div><b>NAMA</b></div>
                    <div class="mt-1.5 flex items-center">
                        <div class="text-base"><?= isset($data['nama']) ? $data['nama'] : '' ?></div>
                    </div>

                    <div class="mt-3"><b>USERNAME</b></div>
                    <div class="mt-1.5 flex items-center">
                        <div class="text-base"><?= isset($data['username']) ? $data['username'] : '' ?></div>
                    </div>

                    <div class="mt-3"><b>EMAIL</b></div>
                    <div class="mt-1.5 flex items-center">
                        <div class="text-base"><?= isset($data['email']) ? $data['email'] : '' ?></div>
                    </div>

                    <!-- <div class="mt-3"><b>PASSWORD HASH</b></div>
                    <div class="mt-1.5 flex items-center">
                        <div class="text-base"><?= isset($data['password']) ? $data['password'] : '' ?></div>
                    </div> -->

                    <div class="mt-3"><b>ROLE</b></div>
                    <div class="mt-1.5 flex items-center">
                        <div class="text-base"><?= isset($data['role']) ? $data['role'] : '' ?></div>
                    </div>

                    <div class="mt-3"><b>STATUS</b></div>
                    <div class="mt-1.5 flex items-center">
                        <div class="text-base"><?= isset($data['status']) ? $data['status'] : '' ?></div>
                    </div>

                    <div class="mt-3"><b>ALAMAT</b></div>
                    <div class="mt-1.5 flex items-center">
                        <div class="text-base"><?= isset($data['alamat']) ? $data['alamat'] : '' ?></div>
                    </div>

                </div>
                <div class="card-footer text-center">
                    <a href="<?= base_url('users/editUsers/' . (isset($data['id']) ? $data['id'] : '')) ?>" class="btn btn btn-primary btn-sm rounded-0"><i class="fa fa-edit mr-2"></i> Edit</a>

                    <a href="<?= base_url('users/deleteUsers/' . (isset($data['id']) ? $data['id'] : '')) ?>" class="btn btn btn-danger btn-sm rounded-0" id="deleteData" data-href="<?= base_url('users/deleteUsers/' . (isset($data['id']) ? $data['id'] : '')) ?>" title="Delete User" onclick="return confirmDelete(event)"><i class="fa fa-trash mr-2"></i> Delete</a>

                    <a href="<?= base_url('users/index') ?>" class="btn btn btn-light bg-gradient-light border btn-sm rounded-0"><i class="fa fa-angle-left mr-2"></i> Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>