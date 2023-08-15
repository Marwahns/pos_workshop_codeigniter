<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit This Record Supplier</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Supplier</a></li>
                        <li class="breadcrumb-item active">Edit Supplier</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <form action="<?= base_url('supplier/saveEditSupplier') ?>" method="POST" id="edit-form" enctype="multipart/form-data">
                    <div class="card-body">
                        <input type="hidden" name="id" value="<?= isset($data['id']) ? $data['id'] : '' ?>">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Kode Supplier</label>
                            <input type="text" class="form-control" id="kode_supplier" name="kode_supplier" readonly required="required" value="<?= isset($data['kode_supplier']) ? $data['kode_supplier'] : '' ?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required="required" value="<?= isset($data['nama']) ? $data['nama'] : '' ?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" required="required" value="<?= isset($data['alamat']) ? $data['alamat'] : '' ?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Nomor Telepon</label>
                            <input type="text" class="form-control" id="no_telepon" name="no_telepon" required="required" value="<?= isset($data['no_telepon']) ? $data['no_telepon'] : '' ?>">
                        </div>
                    </div>

                    <div class="card-footer">
                        <a class="btn btn-primary w-24 mr-1" href="<?= base_url('supplier/index/') ?>">Cancel</a>
                        <button type="button" id="updateData" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>