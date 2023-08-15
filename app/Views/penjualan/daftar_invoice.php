<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Invoice</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
                        <li class="breadcrumb-item active">Invoice</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <a class="btn btn-success" href="<?= base_url('pembayaran/download') ?>" style="margin-bottom: 10px; margin-left: 15px;"><i class="fas fa-file-excel"></i> Export</a>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="pesan" data-pesan="<?= session('pesan') ?>"></div>
                    <div class="table-responsive">
                        <!-- id="tabel-invoice" -->
                        <table id="example1" class="table table-bordered table-striped" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Invoice</th>
                                    <th>Tanggal</th>
                                    <!-- <th>Customer</th> -->
                                    <th>Grand Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($transactions) > 0) : ?>
                                    <?php $i = 1; ?>
                                    <?php foreach ($transactions as $row) : ?>
                                        <tr>
                                            <th><?= $i++; ?></th>
                                            <td><?= $row['code'] ?></td>
                                            <td><?= date("Y-m-d h:i A", strtotime($row['created_at'])) ?></td>
                                            <td><?= number_format($row['grand_total'], 2) ?></td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="<?= base_url('pembayaran/transaction_view/' . $row['id']) ?>" class="btn btn-default bg-gradient-light border text-dark rounded-0" title="Print"><i class="fa fa-eye"></i></a>
                                                    <a href="<?= base_url('pembayaran/cetak/' . $row['id']) ?>" class="btn btn-default bg-gradient-light border text-dark rounded-0" title="Print"><i class="fas fa-print"></i></a>
                                                    <!-- <a href="<?= base_url('pembayaran/generate/') . $row['id'] ?>" class="btn btn-primary rounded" title="Print Receipt"><i class="fa-solid fa-print"></i> Print Receipt</a> -->
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <div>
                            <?= $pager->makeLinks($page, $perPage, $total, 'custom_view') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>