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
                        <li class="breadcrumb-item active">Penjualan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="<?= base_url("pembayaran/save_transaction") ?>" id="transaction-form" method="POST" onkeydown="return event.key != 'Enter';">
                <?= csrf_field(); ?>
                <input type="hidden" name="total_amount" value="0">
                <div class="row">
                    <!-- Card 1 -->
                    <div class="col-md-6">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <!-- Tanggal -->
                                <div class="form-group row d-none">
                                    <label for="tanggal" class="col-sm-3 col-form-label">Tanggal</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" name="tanggal" id="tanggal" value="<?= date('Y-m-d') ?>">
                                    </div>
                                </div>

                                <!-- Kasir -->
                                <div class="form-group row">
                                    <label for="user" class="col-sm-3 col-form-label">Kasir</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="user" id="user" readonly value="<?= get_user('nama') ?>">
                                    </div>
                                </div>

                                <!-- Pelanggan -->
                                <div class="form-group row">
                                    <label for="pelanggan" class="col-sm-3 col-form-label">Pelanggan</label>
                                    <div class="col-sm-9">
                                        <select id="select2_pelanggan_id" name="pelanggan_id" class="form-control">
                                            <option value="" disabled selected>Select Type Customer</option>
                                            <?php foreach ($pelanggan as $key => $value) { ?>
                                                <option <?= !empty($request->getPost('customer')) && $request->getPost('customer') == $value->id ? 'selected' : '' ?> value="<?= $value->id ?>"><?= $value->nama ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <!-- Nama Customer -->
                                    <!-- <input type="text" class="form-control" id="nama_customer" name="nama_customer" disabled value="<?= date('Y-m-d') ?>"> -->
                                    <input type="hidden" name="nama_customer" id="nama_customer" class="form-control" readonly>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <!-- Invoice -->
                                <div class="text-right">
                                    <h4>Invoice : <span class="text-bold" id="invoice"><?= $invoice ?></span></h4>
                                    <h1><span class="text-bold text-danger" id="tampilkan_total">0</span></h1>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="product" class="control-label">Choose Product</label>
                                    <!-- <select id="product" class="form-control select2"> -->
                                    <select id="product" class="form-control">
                                        <option value="" disabled selected></option>
                                        <?php
                                        foreach ($products as $row) :
                                        ?>
                                            <option value="<?= $row['id'] ?>" data-price="<?= $row['harga'] ?>" data-stok="<?= $row['stok'] ?>"><?= $row['kode_spareparts'] . " - " . $row['spareparts'] ?></option>
                                        <?php endforeach; ?>
                                    </select>

                                    <!-- Stok -->
                                    <p id="lblStok" class="mt-2"><span>Stok: </span><span id="show_stok"> -</span></p>
                                </div>

                                <div class="form-group text-right">
                                    <button class="btn btn-primary" type="button" id="add_item" disabled> Tambah</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- <hr> -->
                <!-- .row -->

                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-primary card-outline">
                            <div class="p-0 table-responsive">
                                <table class="table table-bordered table-striped">
                                    <colgroup>
                                        <col width="5%">
                                        <col width="15%">
                                        <col width="30%">
                                        <col width="5%">
                                        <col width="15%">
                                        <col width="20%">
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th class="p-1 text-center"></th>
                                            <th class="p-1 text-center">QTY</th>
                                            <th class="p-1 text-center">Product</th>
                                            <th class="p-1 text-center">Stok</th>
                                            <th class="p-1 text-center">Unit Price</th>
                                            <th class="p-1 text-center">Total</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- .row -->

                <div id="product-list">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-primary">
                                <div class="p-0 table-responsive">
                                    <table class="table table-bordered table-striped" id="item-table">
                                        <colgroup>
                                            <col width="5%">
                                            <col width="15%">
                                            <col width="30%">
                                            <col width="5%">
                                            <col width="15%">
                                            <col width="20%">
                                        </colgroup>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="clearfix py-1"></div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            </div>
        </div>
        <!-- ##### -->

        <div class="row">
            <div class="col-md-4">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <!-- Sub Total -->
                        <div class="form-group row">
                            <label for="sub_total" class="col-sm-5 col-form-label">Sub Total</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control text-right" name="sub_total" id="sub_total" value="0" readonly>
                            </div>
                        </div>

                        <!-- Discount Total -->
                        <div class="form-group row">
                            <label for="diskon" class="col-sm-5 col-form-label">Discount Total (%)</label>
                            <div class="col-sm-7">
                                <input type="number" class="form-control text-right" name="diskon" id="diskon" min="0" placeholder="0">
                            </div>
                        </div>

                        <!-- Total Akhir -->
                        <div class="form-group row">
                            <label for="total_akhir" class="col-sm-5 col-form-label">Grand Total</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control text-right" name="total_akhir" id="gtotal" min="0" placeholder="0" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- .col-md-4 -->
            <div class="col-md-4">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <!-- Cash -->
                        <div class="form-group row">
                            <label for="tunai" class="col-sm-5 col-form-label">Cash</label>
                            <div class="col-sm-7">
                                <input type="number" class="form-control text-right" name="tendered" id="tendered" min="0" placeholder="0" readonly>
                            </div>
                        </div>

                        <!-- Change -->
                        <div class=" form-group row">
                            <label for="kembalian" class="col-sm-5 col-form-label">Change</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control text-right" name="kembalian" id="change" placeholder="0" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- .col-md-4 -->
            <!-- <div class="col-md-3">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="catatan">Note</label>
                                    <textarea class="form-control" name="catatan" id="catatan" rows="3" disabled></textarea>
                                </div>
                            </div>
                        </div>
                    </div> -->
            <!-- .col-md-3 -->
            <div class="col-md-4">
                <div class="card card-primary card-outline">
                    <!-- Button -->
                    <div class="card-body">
                        <!-- ## class="btn btn-warning disabled" -->
                        <p><a href="<?= base_url('pembayaran/index') ?>" class="btn btn-warning" id="cancel_payment"><i class="fa fa-refresh"></i> Cancel</a></p>
                        <p><button type="button" class="btn btn-success" id="save_transaction" disabled><i class="fa fa-paper-plane"></i> Process Payment</button></p>
                    </div>
                </div>
            </div>
            <!-- .col-md-3 -->
        </div>
        <!-- .row -->
        </form>
        <!-- <div class="card-footer text-center">
            <button class="btn btn-primary rounded-0" id="save_transaction" type="button"><i class="fa fa-save"></i> Save Transaction</button>
        </div> -->
    </section>
</div><!-- /.container-fluid -->

<noscript id="item-clone">
    <tr>
        <td class="py-1 px-2 align-middle text-center">
            <input type="hidden" name="product_id[]">
            <input type="hidden" name="price[]" value="0">
            <button class="btn btn-outline-danger btn-sm rounded-0 rem_item" type="button"><i class="fa fa-times"></i></button>
        </td>
        <td class="py-1 px-2 align-middle">
            <input type="number" class="form-control form-control-sm rounded-0 text-center" name="quantity[]" id="qty_produk" required="required" min="1" value="1">
        </td>
        <td class="py-1 px-2 align-middle product_item"></td>
        <td class="py-1 px-2 align-middle stok text-end" id="stok_produk"></td>
        <td class="py-1 px-2 align-middle unit_price text-end"></td>
        <td class="py-1 px-2 align-middle total_price text-end">0.00</td>
    </tr>
</noscript>