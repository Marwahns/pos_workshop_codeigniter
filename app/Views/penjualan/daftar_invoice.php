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

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="pesan" data-pesan="<?= session('pesan') ?>"></div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="tabel-invoice" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Invoice</th>
                                    <th>Tanggal</th>
                                    <th>Customer</th>
                                    <th>Total Amount</th>
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
                                            <td><?= $row['customer'] ?></td>
                                            <td><?= number_format($row['total_amount'], 2) ?></td>
                                            <!-- <td><?= $row->invoice ?></td>
                                            <td><?= $row->tanggal ?></td> -->
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="<?= base_url('pembayaran/transaction_view/' . $row['id']) ?>" class="btn btn-default bg-gradient-light border text-dark rounded-0" title="Print"><i class="fa fa-eye"></i></a>
                                                    <a href="<?= base_url('/penjualan/cetak' . $row['id']) ?>" class="btn btn-default bg-gradient-light border text-dark rounded-0" title="Print"><i class="fas fa-print"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</div>
</body>

<!-- <?= $this->section('js'); ?> -->
<script>
    $(document).ready(function() {
        let pesan = $(".pesan").data('pesan')
        if (pesan != '') {
            toastr.error(pesan)
        }
        const table = $("#tabel-invoice").DataTable({
            proseccing: true,
            serverSide: true,
            order: [
                [1, "desc"]
            ],
            ajax: {
                url: `${BASE_URL}/penjualan/invoice`
            },
            //optional
            "lengthMenu": [
                [5, 10],
                [5, 10]
            ],
            "columns": [{
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'invoice'
                },
                {
                    data: 'tanggal'
                },
                {
                    render: function(data, type, row) {
                        let html = `<button class="btn btn-success btn-sm print" data-id='${row.id}'><i class="fas fa-print"></i></button>`;
                        return html;
                    }
                }
            ],
            columnDefs: [{
                    targets: 0,
                    width: "5%"
                },
                {
                    targets: [0, 3],
                    className: "text-center"
                },
                {
                    targets: [0, 3],
                    orderable: false
                },
                {
                    targets: [0, 2, 3],
                    searchable: false
                }
            ]
        });
        $(document).on('click', '.print', function(e) {
            window.open(`${BASE_URL}/penjualan/cetak/` + $(this).data('id'))
        });
    });
</script>

<!-- <?php $this->endSection(); ?> -->