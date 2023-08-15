<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Spare Parts Details</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Spare Parts Details</li>
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
                        <div class="text-base"><?= isset($data['kode_spareparts']) ? $data['kode_spareparts'] : '' ?></div>
                    </div>

                    <div class="mt-3"><b>SPARE PARTS</b></div>
                    <div class="mt-1.5 flex items-center">
                        <div class="text-base"><?= isset($data['spareparts']) ? $data['spareparts'] : '' ?></div>
                    </div>

                    <div class="mt-3"><b>KATEGORI</b></div>
                    <div class="mt-1.5 flex items-center">
                        <div class="text-base"><?= isset($data['kategori']) ? $data['kategori'] : '' ?></div>
                    </div>

                    <div class="mt-3"><b>SUPPLIER</b></div>
                    <div class="mt-1.5 flex items-center">
                        <div class="text-base"><?= isset($data['nama']) ? $data['nama'] : '' ?></div>
                    </div>
                    <div class="mt-3"><b>HARGA</b></div>
                    <div class="mt-1.5 flex items-center">
                        <div class="text-base"><?= isset($data['harga']) ? $data['harga'] : '' ?></div>
                    </div>

                    <div class="mt-3"><b>STOK</b></div>
                    <div class="mt-1.5 flex items-center">
                        <div class="text-base"><?= isset($data['stok']) ? $data['stok'] : '' ?></div>
                    </div>

                </div>
                <div class="card-footer text-center">
                    <a href="<?= base_url('spareparts/editSpareParts/' . (isset($data['id']) ? $data['id'] : '')) ?>" class="btn btn btn-primary btn-sm rounded-0"><i class="fa fa-edit mr-2"></i> Edit</a>

                    <a href="<?= base_url('spareparts/deleteSpareParts/' . (isset($data['id']) ? $data['id'] : '')) ?>" class="btn btn btn-danger btn-sm rounded-0" id="deleteData" data-href="<?= base_url('spareparts/deleteSpareParts/' . (isset($data['id']) ? $data['id'] : '')) ?>" title="Delete Spare Part" onclick="return confirmDelete(event)"><i class="fa fa-trash mr-2"></i> Delete</a>

                    <a href="<?= base_url('spareparts/index') ?>" class="btn btn btn-light bg-gradient-light border btn-sm rounded-0"><i class="fa fa-angle-left mr-2"></i> Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>