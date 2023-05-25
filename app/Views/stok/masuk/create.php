<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add New Supplier</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Master</a></li>
                        <li class="breadcrumb-item"><a href="#">Supplier</a></li>
                        <li class="breadcrumb-item active">Add New Supplier</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- left column -->
            <!-- general form elements -->
            <div class="card card-primary">
                <!-- /.card-header -->
                <!-- form start -->
                <form action="<?= base_url('supplier/saveSupplier') ?>" method="POST" id="create-form" enctype="multipart/form-data">
                    <div class="card-body">
                        <input type="hidden" name="id">
                        <div class="form-group">
                            <input type="hidden" id="spareparts_id" name="spareparts_id">
                            <input type="hidden" name="tipe" value="masuk">
                            <label for="regular-form-1" class="control-label">Spare Parts</label><br>
                            <select class="form-control select2" name="spareparts_id" id="select2_spareparts_id" data-placeholder="Select a Produk" required>
                            <option></option>
                                <!-- <option value="" selected disabled>Cari produk</option> -->
                                <?php foreach ($spareparts_id as $key => $value) { ?>
                                    <option <?= !empty($request->getPost('spareparts_id')) && $request->getPost('spareparts_id') == $value->id ? 'selected' : '' ?> value="<?= $value->id ?>"><?= $value->kode_spareparts . ' - ' . $value->spareparts ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Spare Parts</label>
                            <input name="spareparts" id="spareparts" type="text" class="form-control" readonly disabled>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Alamat</label>
                            <input type="text" class="form-control" placeholder="Input Address" id="alamat" name="alamat" required="required" value="<?= !empty($request->getPost('alamat')) ? $request->getPost('alamat') : '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nomor Telepon</label>
                            <input type="number" class="form-control" placeholder="Input Number Telphone" id="no_telepon" name="no_telepon" required="required" value="<?= !empty($request->getPost('no_telepon')) ? $request->getPost('no_telepon') : '' ?>">
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="reset" form="create-form" class="btn btn-danger w-24">Reset</button>
                        <a class="btn btn-primary w-24 mr-1" href="<?= base_url('supplier/index/') ?>">Cancel</a>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
            <!--/.col (left) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>