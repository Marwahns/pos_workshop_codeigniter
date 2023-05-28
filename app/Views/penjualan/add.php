<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sales</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
                        <li class="breadcrumb-item active">Sales</li>
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
                            <input type="hidden" class="form-control" id="tanggal" name="tanggal" disabled value="<?= esc(date('Y-m-d')) ?>">
                        </div>

                        <!-- Type Pelanggan -->
                        <div class="form-group">
                            <input type="hidden" id="spareparts_id" name="spareparts_id">
                            <input type="hidden" name="tipe" value="masuk">
                            <label for="regular-form-1" class="control-label">Choose Type Pelanggan</label><br>
                            <select class="form-control" name="spareparts_id" id="select_pelanggan" data-placeholder="Choose Product" required>
                                <option value="" disabled>Choose Type Pelanggan</option>
                                <?php foreach ($pelanggan as $key => $value) { ?>
                                    <option <?= !empty($request->getPost('pelanggan_id')) && $request->getPost('pelanggan_id') == $value->id ? 'selected' : '' ?> value="<?= $value->id ?>"><?= $value->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <!-- Barcode -->
                        <div class="form-group">
                            <input type="hidden" id="iditem">
                            <input type="hidden" name="tipe" value="masuk">
                            <label for="regular-form-1" class="control-label">Choose Product</label><br>
                            <select class="form-control select2" name="spareparts_id" id="select2_products" data-placeholder="Choose Product" required>
                                <option></option>
                                <?php foreach ($products as $key => $value) { ?>
                                    <option <?= !empty($request->getPost('spareparts_id')) && $request->getPost('spareparts_id') == $value->id ? 'selected' : '' ?> value="<?= $value->id ?>"><?= $value->kode_spareparts . ' - ' . $value->spareparts ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <!-- Kategori dan Stok -->
                        <div class="form-group">
                            <!-- <label for="stok" class="regular-form-1">Stok</label> -->
                            <!-- <input type="text" class="form-control" id="stok" name="stok" disabled value="-" > -->
                            <span class="text-muted" id="tampil-stok"></span>
                        </div>
                        <!-- <button class="btn btn-primary bg-gradient rounded-0 btn-sm" type="button" id="add_item" disabled><i class="far fa-plus-square"></i> Add Item</button> -->

                        <!-- Jumlah -->
                        <div class="form-group row">
                                <label for="jumlah" class="col-sm-3 col-form-label">Jumlah</label>
                                <div class="col-sm-5">
                                    <!-- <input type="number" class="form-control" name="jumlah" id="jumlah" min="1" disabled> -->
                                    <input type="number" class="form-control" name="jumlah" id="jumlah" min="1" disabled>
                                </div>
                                <div class="col-sm-4">
                                    <!-- <button type="button" id="tambah" class="btn btn-primary" disabled>Tambah</button> -->
                                    <button type="button" id="add_item" class="btn btn-primary" disabled>Tambah</button>
                                </div>
                            </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <!-- <button type="reset" form="create-form" class="btn btn-danger w-24">Reset</button>
                        <a class="btn btn-primary w-24 mr-1" href="<?= base_url('stok/index/') ?>">Cancel</a>
                        <button type="submit" class="btn btn-success">Save</button> -->
                    </div>
                </form>
            </div>
            <!-- /.card -->
            <!--/.col (left) -->
        </div><!-- /.container-fluid -->
    </section>
    <div class="card rounded-0">
        <div class="card-body">
            <div class="container-fluid">
                <form action="<?= base_url("Main/save_transaction") ?>" id="transaction-form" method="POST" onkeydown="return event.key != 'Enter';">
                    <input type="hidden" name="total_amount" value="0">
                    <fieldset class="border pb-3 rounded-0 mb-3">
                        <legend class="px-3 mx-3">Add Product</legend>
                        <div class="container-fluid">
                            <div class="row align-items-end">

                                <!-- Barcode -->
                                <div class="form-group">
                                    <input type="hidden" id="spareparts_id" name="spareparts_id">
                                    <input type="hidden" name="tipe" value="masuk">
                                    <label for="regular-form-1" class="control-label">Choose Product</label><br>
                                    <select class="form-control select2" name="spareparts_id" id="select2_products" data-placeholder="Choose Product" required>
                                        <?php foreach ($products as $key => $value) { ?>
                                            <option <?= !empty($request->getPost('spareparts_id')) && $request->getPost('spareparts_id') == $value->id ? 'selected' : '' ?> value="<?= $value->id ?>"><?= $value->kode_spareparts . ' - ' . $value->spareparts ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <button class="btn btn-primary bg-gradient rounded-0 btn-sm" type="button" id="add_item"><i class="far fa-plus-square"></i> Add Item</button>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <hr>
                    <div>
                        <table class="table table-bordered">
                            <colgroup>
                                <col width="5%">
                                <col width="15%">
                                <col width="30%">
                                <col width="20%">
                                <col width="20%">
                            </colgroup>
                            <thead>
                                <tr class="bg-gradient bg-primary text-light">
                                    <th class="p-1 text-center"></th>
                                    <th class="p-1 text-center">QTY</th>
                                    <th class="p-1 text-center">Product</th>
                                    <th class="p-1 text-center">Unit Price</th>
                                    <th class="p-1 text-center">Total</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div id="product-list">
                        <table class="table table-bordered table-striped" id="item-table">
                            <colgroup>
                                <col width="5%">
                                <col width="15%">
                                <col width="30%">
                                <col width="20%">
                                <col width="20%">
                            </colgroup>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <table class="table table-bordered">
                            <colgroup>
                                <col width="5%">
                                <col width="15%">
                                <col width="30%">
                                <col width="20%">
                                <col width="20%">
                            </colgroup>
                            <tfoot>
                                <tr class="bg-warning bg-gradient bg-opacity-25 text-dark">
                                    <th class="p-1 text-center" colspan="4">Total Amount</th>
                                    <th class="p-1 text-end h4 mb-0" id="gtotal">0.00</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="clearfix py-1"></div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <label for="customer" class="control-label">Customer name</label>
                            <input type="text" class="form-control rounded-0" id="customer" name="customer" required="required">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="mb-3">
                                <label for="tendered" class="control-label">Tendered Amount</label>
                                <input type="number" step="any" class="form-control rounded-0" id="tendered" name="tendered" required="required">
                            </div>
                            <div class="h4 mb-0 fw-bolder text-end"><span class="text-muted">Change:</span> <span class="ms-2" id="change">0.00</span></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-footer text-center">
            <button class="btn btn-primary rounded-0" id="save_transaction" type="button"><i class="fa fa-save"></i> Save Transaction</button>
        </div>
    </div>
    <noscript id="item-clone">
        <tr>
            <td class="py-1 px-2 align-middle text-center">
                <input type="hidden" name="product_id[]">
                <input type="hidden" name="price[]" value="0">
                <button class="btn btn-outline-danger btn-sm rounded-0 rem_item" type="button"><i class="fa fa-times"></i></button>
            </td>
            <td class="py-1 px-2 align-middle">
                <input type="number" class="form-control form-control-sm rounded-0 text-center" name="quantity[]" required="required" min="1" value="1">
            </td>
            <td class="py-1 px-2 align-middle product_item"></td>
            <td class="py-1 px-2 align-middle unit_price text-end"></td>
            <td class="py-1 px-2 align-middle total_price text-end">0.00</td>
        </tr>
    </noscript>
</div>
</div>
</body>
<script>
    function calculate_total() {
        var total = 0;
        $('#item-table tbody tr').each(function() {
            var tp = 0;
            var price = $(this).find('[name="price[]"]').val()
            var qty = $(this).find('[name="quantity[]"]').val()
            price = price > 0 ? price : 0;
            qty = qty > 0 ? qty : 0;
            tp = parseFloat(price) * parseFloat(qty);
            total += parseFloat(tp)
            $(this).find('.total_price').text(parseFloat(tp).toLocaleString('en-US', {
                style: 'decimal',
                maximumFractionDigits: 2,
                minimumFractionDigits: 2
            }))
        })
        $('#gtotal').text(parseFloat(total).toLocaleString('en-US', {
            style: 'decimal',
            maximumFractionDigits: 2,
            minimumFractionDigits: 2
        }))
        $('[name="total_amount"]').val(total)
    }
    $(function() {
        $('#product').select2({
            placeholder: 'Please Select Here',
            width: '100%',
        })

        $('#add_item').click(function() {
            var pid = $('#product').val()
            if ($('#item-table tbody tr[data-id="' + pid + '"]').length > 0) {
                $('#item-table tbody tr[data-id="' + pid + '"]').find('[name="quantity[]"]').val(parseInt($('#item-table tbody tr[data-id="' + pid + '"]').find('[name="quantity[]"]').val()) + 1).trigger('change')
                $('#product').val('').trigger('change')
                return false;
            }
            var pname = $('#product option[value="' + pid + '"]').text()
            var price = $('#product option[value="' + pid + '"]').attr('data-price')
            var tr = $($('noscript#item-clone').html()).clone()
            tr.attr('data-id', pid)
            tr.find('[name="product_id[]"]').val(pid)
            tr.find('[name="price[]"]').val(price)
            tr.find('.product_item').text(pname)
            tr.find('.unit_price').text(parseFloat(price).toLocaleString('en-US', {
                style: 'decimal',
                maximumFractionDigits: 2,
                minimumFractionDigits: 2
            }))
            tr.find('.total_price').text(parseFloat(price).toLocaleString('en-US', {
                style: 'decimal',
                maximumFractionDigits: 2,
                minimumFractionDigits: 2
            }))
            $('#item-table tbody').append(tr)
            $('#product').val('').trigger('change')
            calculate_total()
            tr.find('.rem_item').click(function() {
                if (confirm("Are you sure to remove this item") === true) {
                    tr.remove()
                    calculate_total()
                }
            })
            tr.find('[name="quantity[]"]').on('change input', function() {
                calculate_total()
            })
        })
        $('[name="tendered"]').on('input change', function() {
            var tendered = $(this).val()
            var amount = $('[name="total_amount"]').val()
            tendered = tendered > 0 ? tendered : 0;
            amount = amount > 0 ? amount : 0;
            var change = parseFloat(tendered) - parseFloat(amount);
            console.log(change)
            $('#change').text(parseFloat(change).toLocaleString('en-US', {
                style: 'decimal',
                maximumFractionDigits: 2,
                minimumFractionDigits: 2
            }))
        })

        $('#save_transaction').click(function() {
            if ($('#item-table tbody tr').length <= 0) {
                alert("Please add at least 1 item first.")
                return false;
            }
            var tendered = $('[name="tendered"]').val()
            var amount = $('[name="total_amount"]').val()
            if (parseFloat(tendered) < parseFloat(amount)) {
                alert("Invalid tendered amount.")
                return false;
            }
            $('#transaction-form').submit()
        })
    })
</script>