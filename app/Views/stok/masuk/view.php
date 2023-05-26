<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Stok Masuk Details</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Stok Masuk</a></li>
                        <li class="breadcrumb-item active">Stok Masuk Details</li>
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
                    <div><b>BARCODE</b></div>
                    <div class="mt-1.5 flex items-center">
                        <?php foreach ($join_spareparts as $key => $value) { ?>
                            <?= isset($data['spareparts_id']) && $data['spareparts_id'] == $value['spareparts_id'] ? $value['kode_spareparts'] : ''; ?>
                        <?php } ?>
                    </div>

                    <div class="mt-3"><b>PRODUK</b></div>
                    <div class="mt-1.5 flex items-center">
                        <?php foreach ($join_spareparts as $key => $value) { ?>
                            <?= isset($data['spareparts_id']) && $data['spareparts_id'] == $value['spareparts_id'] ? $value['spareparts'] : ''; ?>
                        <?php } ?>
                    </div>

                    <div class="mt-3"><b>JUMLAH</b></div>
                    <div class="mt-1.5 flex items-center">
                        <div class="text-base"><?= isset($data['jumlah']) ? $data['jumlah'] : '' ?></div>
                    </div>
                    <div class="mt-3"><b>SUPPLIER</b></div>
                    <div class="mt-1.5 flex items-center">
                        <?php foreach ($join_supplier as $key => $value) { ?>
                            <?= isset($data['supplier_id']) && $data['supplier_id'] == $value['supplier_id'] ? $value['nama'] : ''; ?>
                        <?php } ?>
                    </div>

                    <div class="mt-3"><b>KETERANGAN</b></div>
                    <div class="mt-1.5 flex items-center">
                        <div class="text-base"><?= isset($data['keterangan']) ? $data['keterangan'] : '' ?></div>
                    </div>

                    <div class="mt-3"><b>TANGGAL</b></div>
                    <div class="mt-1.5 flex items-center">
                        <div class="text-base"><?= isset($data['created_at']) ? $data['created_at'] : '' ?></div>
                    </div>

                    <div class="mt-3"><b>TIPE STOK</b></div>
                    <div class="mt-1.5 flex items-center">
                        <div class="text-base"><?= isset($data['tipe']) ? $data['tipe'] : '' ?></div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a href="<?= base_url('stok/deleteStokMasuk/' . (isset($data['id']) ? $data['id'] : '')) ?>" class="btn btn btn-danger btn-sm rounded-0" onclick="if(confirm('Are you sure to delete this contact details?') === false) event.preventDefault()"><i class="fa fa-trash mr-2"></i> Delete</a>
                    <a href="<?= base_url('stok/index') ?>" class="btn btn btn-light bg-gradient-light border btn-sm rounded-0"><i class="fa fa-angle-left mr-2"></i> Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>