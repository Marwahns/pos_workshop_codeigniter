<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add New Spare Parts</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Master</a></li>
                        <li class="breadcrumb-item"><a href="#">Spare Parts</a></li>
                        <li class="breadcrumb-item active">Add New Spare Parts</li>
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
                <form action="<?= base_url('spareparts/saveSpareParts') ?>" method="POST" id="create-form" enctype="multipart/form-data">
                    <div class="card-body">
                        <input type="hidden" name="id">
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kode Spare Parts</label>
                            <input name="kode_spareparts" id="kode_spareparts" type="text" class="form-control" readonly value="<?= $kode_spareparts; ?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Spare Parts</label>
                            <input type="text" class="form-control" placeholder="Input Name Spare Parts" id="spareparts" name="spareparts" required="required" value="<?= !empty($request->getPost('spareparts')) ? $request->getPost('spareparts') : '' ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="regular-form-1" class="control-label">Supplier</label><br>
                            <select class="form-control select2" name="supplier_id" id="supplier_id" required>
                                <option value="" selected disabled>Pilih Supplier</option>
                                <?php foreach ($supplier_id as $key => $value) { ?>
                                    <option <?= !empty($request->getPost('supplier_id')) && $request->getPost('supplier_id') == $value->id ? 'selected' : '' ?> value="<?= $value->id ?>"><?= $value->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="regular-form-1" class="control-label">Kategori</label><br>
                            <select class="form-control select2" name="kategori_id" id="kategori_id" required>
                                <option value="" selected disabled>Pilih Kategori</option>
                                <?php foreach ($kategori_id as $key => $value) { ?>
                                    <option <?= !empty($request->getPost('kategori_id')) && $request->getPost('kategori_id') == $value->id ? 'selected' : '' ?> value="<?= $value->id ?>"><?= $value->kategori ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Harga</label>
                            <input type="number" class="form-control" placeholder="Input Harga" id="harga" name="harga" required="required" value="<?= !empty($request->getPost('harga')) ? $request->getPost('harga') : '' ?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Stok</label>
                            <input type="number" class="form-control" placeholder="Input Stok" id="stok" name="stok" required="required" value="<?= !empty($request->getPost('stok')) ? $request->getPost('stok') : '' ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Choose image</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                                <small class="invalid-feedback"></small>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="reset" form="create-form" class="btn btn-danger w-24">Reset</button>
                        <a class="btn btn-primary w-24 mr-1" href="<?= base_url('spareparts/index/') ?>">Cancel</a>
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