<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Transaction Details of <?= $details['code'] ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Invoice Details</li>
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
                    <div class="lh-1">
                        <dl class="d-flex w-100">
                            <dt class="col-auto">Transaction Code:</dt>
                            <dd class="col-auto flex-shrink-1 flex-grow-1 px-2"><?= $details['code'] ?></dd>
                        </dl>
                        <dl class="d-flex w-100">
                            <dt class="col-auto">Transaction Date/Time:</dt>
                            <dd class="col-auto flex-shrink-1 flex-grow-1 px-2"><?= date("F d, Y h:i A", strtotime($details['created_at'])) ?></dd>
                        </dl>
                        <dl class="d-flex w-100">
                            <dt class="col-auto">Customer:</dt>
                            <dd class="col-auto flex-shrink-1 flex-grow-1 px-2"><?= $details['name_customer'] ?></dd>
                        </dl>
                    </div>

                    <h5 class="text-bold">Purchased Products</h5>
                    <hr>
                    <table class="table table-stripped table-bordered">
                        <colgroup>
                            <col width="10%">
                            <col width="50%">
                            <col width="20%">
                            <col width="20%">
                        </colgroup>
                        <thead>
                            <tr class="bg-gradient bg-primary text-light">
                                <th class="p1-text-center">Qty</th>
                                <th class="p1-text-center">Product</th>
                                <th class="p1-text-center">Unit Price</th>
                                <th class="p1-text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($items as $row) :
                            ?>
                                <tr>
                                    <td class="px-2 py-1 align-middle text-center"><?= number_format($row['quantity']) ?></td>
                                    <td class="px-2 py-1 align-middle"><?= $row['product'] ?></td>
                                    <td class="px-2 py-1 align-middle text-end"><?= number_format($row['price'], 2) ?></td>
                                    <td class="px-2 py-1 align-middle text-end"><?= number_format($row['price'] * $row['quantity'], 2) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr class="bg-greadient bg-warning text-dark">
                                <th class="p-1 text-end" colspan="3">Total Amount</th>
                                <th class="p-1 text-end"><?= number_format($details['total_amount'], 2) ?></th>
                            </tr>

                            <?php if (esc($details['discount']) != 0) : ?>
                                <tr class="bg-greadient bg-warning text-dark">
                                    <th class="p-1 text-end" colspan="3">Discount</th>
                                    <th class="p-1 text-end"><?= number_format($details['discount'], 2) ?> %</th>
                                </tr>
                            <?php endif; ?>

                            <tr class="bg-greadient bg-warning text-dark">
                                <th class="p-1 text-end" colspan="3">Grand Total</th>
                                <th class="p-1 text-end"><?= number_format(($details['grand_total']), 2) ?></th>
                            </tr>
                            <tr class="bg-greadient bg-warning text-dark">
                                <th class="p-1 text-end" colspan="3">Tendered Amount</th>
                                <th class="p-1 text-end"><?= number_format($details['tendered'], 2) ?></th>
                            </tr>
                            <tr class="bg-greadient bg-warning text-dark">
                                <th class="p-1 text-end" colspan="3">Change</th>
                                <th class="p-1 text-end"><?= number_format($details['tendered'] - ($details['grand_total']), 2) ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="card-footer text-center">
                    <a href="<?= base_url('pembayaran/daftar_invoice') ?>" class="btn btn btn-light bg-gradient border rounded-0"><i class="fa fa-angle-left"></i> Back to List</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card rounded-0">
        <div class="card-body">
            <div class="container-fluid">

            </div>
        </div>
    </div>
</div>