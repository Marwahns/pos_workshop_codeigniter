<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add This Record Spare Parts</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Spare Parts</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <form action="<?= base_url('spareparts/saveSpareParts') ?>" method="POST" id="edit-form" enctype="multipart/form-data">
                    <div class="card-body">
                        <input type="hidden" name="id" value="<?= isset($data['id']) ? $data['id'] : '' ?>">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Kode Spare Parts</label>
                            <input type="text" class="form-control" id="kode_spareparts" name="kode_spareparts" readonly required="required" value="<?= isset($data['kode_spareparts']) ? $data['kode_spareparts'] : '' ?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Spare Parts</label>
                            <input type="text" class="form-control" id="spareparts" name="spareparts" required="required" value="<?= isset($data['spareparts']) ? $data['spareparts'] : '' ?>">
                        </div>

                        <div class="form-group">
                            <label for="regular-form-1" class="control-label">Supplier</label><br>
                            <select class="form-control select2" name="supplier_id" id="supplier_id" required>
                                <option value="" selected disabled>Pilih Supplier</option>
                                <?php foreach ($supplier_id as $key => $value) { ?>
                                    <option <?= isset($data['supplier_id']) && $data['supplier_id'] == $value->id ? 'selected' : '' ?> value="<?= $value->id ?>"><?= $value->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="regular-form-1" class="control-label">Kategori</label><br>
                            <select class="form-control select2" name="kategori_id" id="kategori_id" required>
                                <option value="" selected disabled>Pilih Kategori</option>
                                <?php foreach ($kategori_id as $key => $value) { ?>
                                    <option <?= isset($data['kategori_id']) && $data['kategori_id'] == $value->id ? 'selected' : '' ?> value="<?= $value->id ?>"><?= $value->kategori ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Harga</label>
                            <input type="text" class="form-control" id="harga" name="harga" required="required" value="<?= isset($data['harga']) ? $data['harga'] : '' ?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Stok</label>
                            <input type="text" class="form-control" id="stok" name="stok" required="required" value="<?= isset($data['stok']) ? $data['stok'] : '' ?>">
                        </div>
                    </div>

                    <div class="card-footer">
                        <a class="btn btn-primary w-24 mr-1" href="<?= base_url('supplier/index/') ?>">Cancel</a>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>

                </form>

            </div>
        </div>
    </section>
</div>