<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add New Stok Masuk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
                        <li class="breadcrumb-item active">Add Stok Masuk</li>
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
                <form action="<?= base_url('stok/saveStokMasuk') ?>" method="POST" id="create-form" enctype="multipart/form-data">
                    <div class="card-body">
                        <input type="hidden" name="id">
                        <!-- Date -->
                        <div class="form-group">
                            <label class="control-label" for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= esc(date('Y-m-d')) ?>">
                            <small class="invalid-feedback"></small>
                        </div>

                        <!-- Barcode -->
                        <div class="form-group">
                            <input type="hidden" id="spareparts_id" name="spareparts_id">
                            <input type="hidden" name="tipe" value="masuk">
                            <label for="regular-form-1" class="control-label">Barcode</label><br>
                            <select class="form-control select2" name="spareparts_id" id="select2_spareparts_id" data-placeholder="Select a Produk" required>
                                <option></option>
                                <!-- <option value="" selected disabled>Cari produk</option> -->
                                <?php foreach ($spareparts_id as $key => $value) { ?>
                                    <option <?= !empty($request->getPost('spareparts_id')) && $request->getPost('spareparts_id') == $value->id ? 'selected' : '' ?> value="<?= $value->id ?>"><?= $value->kode_spareparts . ' - ' . $value->spareparts ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <!-- Spare Parts -->
                        <div class="form-group">
                            <label for="spareparts">Spare Parts</label>
                            <input type="text" name="spareparts" id="spareparts" class="form-control" readonly required>
                        </div>

                        <!-- Kategori dan Stok -->
                        <div class="form-group">
                            <label for="unit" class="regular-form-1">Kategori</label>
                            <input type="text" class="form-control" id="kategori_id" name="kategori_id" disabled value="-">
                            <label for="stok" class="regular-form-1">Stok</label>
                            <input type="text" class="form-control" id="stok" name="stok" disabled value="-">
                        </div>

                        <!-- Supplier -->
                        <div class="form-group">
                            <label for="exampleInputEmail1">Supplier</label>
                            <input name="supplier_id" id="supplier_id" type="text" class="form-control" readonly required value="<?= !empty($request->getPost('supplier_id')) ? $request->getPost('supplier_id') : '' ?>">
                        </div>

                        <!-- Jumlah -->
                        <div class="form-group">
                            <label for="exampleInputPassword1">Jumlah</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" required="required" value="<?= !empty($request->getPost('jumlah')) ? $request->getPost('jumlah') : '' ?>">
                        </div>

                        <!-- Keterangan -->
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan</label>
                            <input type="text" class="form-control" onkeyup="autofill()" id="keterangan" name="keterangan" required="required" value="<?= !empty($request->getPost('keterangan')) ? $request->getPost('keterangan') : '' ?>">
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="reset" form="create-form" class="btn btn-danger w-24">Reset</button>
                        <a class="btn btn-primary w-24 mr-1" href="<?= base_url('stok/index/') ?>">Cancel</a>
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
</div>
</body>