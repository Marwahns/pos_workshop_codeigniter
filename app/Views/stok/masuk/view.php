<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Supplier Details</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Supplier Details</li>
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
                    <div><b>KODE SUPPLIER</b></div>
                    <div class="mt-1.5 flex items-center">
                        <div class="text-base"><?= isset($data['kode_supplier']) ? $data['kode_supplier'] : '' ?></div>
                    </div>
                    <div class="mt-3"><b>NAMA</b></div>
                    <div class="mt-1.5 flex items-center">
                        <div class="text-base"><?= isset($data['nama']) ? $data['nama'] : '' ?></div>
                    </div>
                    <div class="mt-3"><b>ALAMAT</b></div>
                    <div class="mt-1.5 flex items-center">
                        <div class="text-base"><?= isset($data['alamat']) ? $data['alamat'] : '' ?></div>
                    </div>
                    <div class="mt-3"><b>NOMOR TELEPON</b></div>
                    <div class="mt-1.5 flex items-center">
                        <div class="text-base"><?= isset($data['no_telepon']) ? $data['no_telepon'] : '' ?></div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a href="<?= base_url('supplier/editSupplier/' . (isset($data['id']) ? $data['id'] : '')) ?>" class="btn btn btn-primary btn-sm rounded-0"><i class="fa fa-edit mr-2"></i> Edit</a>
                    <a href="<?= base_url('supplier/deleteSupplier/' . (isset($data['id']) ? $data['id'] : '')) ?>" class="btn btn btn-danger btn-sm rounded-0" onclick="if(confirm('Are you sure to delete this contact details?') === false) event.preventDefault()"><i class="fa fa-trash mr-2"></i> Delete</a>
                    <a href="<?= base_url('supplier/index') ?>" class="btn btn btn-light bg-gradient-light border btn-sm rounded-0"><i class="fa fa-angle-left mr-2"></i> Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>