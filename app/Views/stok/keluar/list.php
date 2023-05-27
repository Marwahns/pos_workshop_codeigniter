<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>List of Stok Keluar Spare Parts</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">List of Stok Keluar Spare Parts</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <a class="btn btn-success" href="<?= base_url('stok/createStokKeluar') ?>" style="margin-bottom: 10px; margin-left: 15px;"><i class="fa fa-plus mr-2"></i> Add New Stok Keluar Spare Parts</a>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <colgroup>
                                    <!-- <col width="10%">
                                    <col width="20%">
                                    <col width="20%">
                                    <col width="15%">
                                    <col width="15%">
                                    <col width="20%"> -->
                                    <col width="10%">
                                    <!-- <col width="20%"> -->
                                    <col width="30%">
                                    <col width="15%">
                                    <col width="25%">
                                    <col width="20%">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Barcode</th>
                                        <th>Spare parts</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($tb_stok) > 0) : ?>
                                        <?php $i = 1; ?>
                                        <?php foreach ($tb_stok as $row) : ?>
                                            <tr>
                                                <th><?= $i++; ?></th>
                                                <td><?= $row->kode_spareparts ?></td>
                                                <td><?= $row->spareparts_id ?></td>
                                                <td><?= $row->jumlah ?></td>
                                                <td><?= $row->created_at ?></td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="<?= base_url('stok/view_detailStokKeluar/' . $row->id) ?>" class="btn btn-default bg-gradient-light border text-dark rounded-0" title="View Spare Parts"><i class="fa fa-eye"></i></a>
                                                        
                                                        <a href="<?= base_url('stok/deleteStokKeluar/' . $row->id) ?>" class="btn btn-danger rounded-0" title="Delete Spare Parts"><i class="fa fa-trash"></i></a>
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

<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>