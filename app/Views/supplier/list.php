<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>List of Supplier</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">List of Supplier</li>
                        <li class="breadcrumb-item"><a href="<?= base_url('supplier/index') ?>">Supplier</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <a class="btn btn-success" href="<?= base_url('supplier/createSupplier') ?>" style="margin-bottom: 10px; margin-left: 15px;"><i class="fa fa-plus mr-2"></i> Add New Supplier</a>

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
                                    <col width="30%">
                                    <col width="20%">
                                    <col width="20%">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Nomor Telepon</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($tb_supplier) > 0) : ?>
                                        <?php $i = 1; ?>
                                        <?php foreach ($tb_supplier as $row) : ?>
                                            <tr>
                                                <th><?= $i++; ?></th>
                                                <td><?= $row->nama ?></td>
                                                <td><?= $row->alamat ?></td>
                                                <td><?= $row->no_telepon ?></td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="<?= base_url('supplier/view_detailSupplier/' . $row->id) ?>" class="btn btn-default bg-gradient-light border text-dark rounded-0" title="View Supplier"><i class="fa fa-eye"></i></a>

                                                        <a href="<?= base_url('supplier/editSupplier/' . $row->id) ?>" class="btn btn-primary rounded-0" title="Edit Supplier"><i class="fa fa-edit"></i></a>

                                                        <a id="deleteData" href="<?= base_url('supplier/deleteSupplier/' . $row->id) ?>" data-href="<?= base_url('supplier/deleteSupplier/' . $row->id) ?>" class="btn btn-danger rounded-0" title="Delete Supplier" onclick="return confirmDelete(event)"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <div>
                                <?= $pager->makeLinks($page, $perPage, $total, 'custom_view') ?>
                            </div>
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
</script>