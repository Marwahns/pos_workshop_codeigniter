<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Record Category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Record Category</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <form action="<?= base_url('kategori/saveKategori') ?>" method="POST" id="edit-form" enctype="multipart/form-data">
                    <div class="card-body">
                        <input type="hidden" name="id" value="<?= isset($data['id']) ? $data['id'] : '' ?>">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Kode Kategori</label>
                            <input type="text" class="form-control" id="kode_kategori" name="kode_kategori" readonly required="required" value="<?= isset($data['kode_kategori']) ? $data['kode_kategori'] : '' ?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Kategori</label>
                            <input type="text" class="form-control" id="kategori" name="kategori" required="required" value="<?= isset($data['kategori']) ? $data['kategori'] : '' ?>">
                        </div>

                    </div>

                    <div class="card-footer">
                        <a class="btn btn-primary w-24 mr-1" href="<?= base_url('kategori/index/') ?>">Cancel</a>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>

                </form>

            </div>
        </div>
    </section>
</div>