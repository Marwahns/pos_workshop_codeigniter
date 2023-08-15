<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>List of Category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Master</li>
                        <li class="breadcrumb-item"><a href="<?= base_url('kategori/index') ?>">Kategori</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <a class="btn btn-success" href="<?= base_url('kategori/createKategori') ?>" style="margin-bottom: 10px; margin-left: 15px;"><i class="fa fa-plus mr-2"></i> Add New Kategori</a>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- <div class="card-header">
                            <h3 class="card-title">DataTable with default features</h3>
                        </div> -->
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <colgroup>
                                    <col width="10%">
                                    <col width="70%">
                                    <col width="20%">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kategori</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($tb_kategori) > 0) : ?>
                                        <?php $i = 1; ?>
                                        <?php foreach ($tb_kategori as $row) : ?>
                                            <tr>
                                                <th><?= $i++; ?></th>
                                                <td><?= $row->kategori ?></td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="<?= base_url('kategori/view_detailKategori/' . $row->id) ?>" class="btn btn-default bg-gradient-light border text-dark rounded-0" title="View Kategori"><i class="fa fa-eye"></i></a>

                                                        <a href="<?= base_url('kategori/editKategori/' . $row->id) ?>" class="btn btn-primary rounded-0" title="Edit Kategori"><i class="fa fa-edit"></i></a>

                                                        <a id="deleteData" href="<?= base_url('kategori/deleteKategori/' . $row->id) ?>" data-href="<?= base_url('kategori/deleteKategori/' . $row->id) ?>" class="btn btn-danger rounded-0" title="Delete Kategori" onclick="return confirmDelete(event)"><i class="fa fa-trash"></i></a>
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