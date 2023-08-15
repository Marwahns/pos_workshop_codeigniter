<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>List of Account Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('users/index') ?>">Pengguna</a></li>
                        <li class="breadcrumb-item active">List of Account Users</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <a class="btn btn-success" href="<?= base_url('users/createUsers') ?>" style="margin-bottom: 10px; margin-left: 15px;"><i class="fa fa-plus mr-2"></i> Add New Users</a>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <colgroup>
                                    <col width="10%">
                                    <col width="20%">
                                    <col width="20%">
                                    <col width="15%">
                                    <col width="15%">
                                    <col width="20%">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($tb_users) > 0) : ?>
                                        <?php $i = 1; ?>
                                        <?php foreach ($tb_users as $row) : ?>
                                            <tr>
                                                <th><?= $i++; ?></th>
                                                <td><?= $row->nama ?></td>
                                                <td><?= $row->username ?></td>
                                                <td><?= $row->role ?></td>
                                                <td><?= $row->status ?></td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="<?= base_url('users/view_detailUsers/' . $row->id) ?>" class="btn btn-default bg-gradient-light border text-dark rounded-0" title="View Spare Parts"><i class="fa fa-eye"></i></a>

                                                        <a href="<?= base_url('users/editUsers/' . $row->id) ?>" class="btn btn-primary rounded-0" title="Edit Spare Parts"><i class="fa fa-edit"></i></a>

                                                        <a id="deleteData" href="<?= base_url('users/deleteUsers/' . $row->id) ?>" data-href="<?= base_url('users/deleteUsers/' . $row->id) ?>" class="btn btn-danger rounded-0" title="Delete User" onclick="return confirmDelete(event)"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
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