<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kategori Details</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Kategorir Details</li>
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
                    <div><b>KODE KATEGORI</b></div>
                    <div class="mt-1.5 flex items-center">
                        <div class="text-base"><?= isset($data['kode_kategori']) ? $data['kode_kategori'] : '' ?></div>
                    </div>
                    <div class="mt-3"><b>KATEGORI</b></div>
                    <div class="mt-1.5 flex items-center">
                        <div class="text-base"><?= isset($data['kategori']) ? $data['kategori'] : '' ?></div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a href="<?= base_url('kategori/editKategori/' . (isset($data['id']) ? $data['id'] : '')) ?>" class="btn btn btn-primary btn-sm rounded-0"><i class="fa fa-edit mr-2"></i> Edit</a>
                    <a href="<?= base_url('kategori/deleteKategori/' . (isset($data['id']) ? $data['id'] : '')) ?>" class="btn btn btn-danger btn-sm rounded-0" onclick="if(confirm('Are you sure to delete this record details?') === false) event.preventDefault()"><i class="fa fa-trash mr-2"></i> Delete</a>
                    <a href="<?= base_url('kategori/index') ?>" class="btn btn btn-light bg-gradient-light border btn-sm rounded-0"><i class="fa fa-angle-left mr-2"></i> Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>