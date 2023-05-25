<?= $this->extend('templates/template-menu-bar') ?>
<?= $this->section('content'); ?>

<a class="btn btn-success" href="<?= base_url('spareparts/createSpareParts') ?>" style="margin-bottom: 10px;"><i class="fa fa-plus mr-2"></i> Add New Stok Masuk</a>

<table class="table mt-5">
    <colgroup>
        <col width="10%">
        <col width="20%">
        <col width="20%">
        <col width="15%">
        <col width="15%">
        <col width="20%">
    </colgroup>
    <thead>
        <tr class="bg-gray-700 dark:bg-dark-1 text-white">
            <th class="whitespace-nowrap">#</th>
            <th class="whitespace-nowrap">Barcode</th>
            <th class="whitespace-nowrap">Spare parts</th>
            <th class="whitespace-nowrap">Jumlah</th>
            <th class="whitespace-nowrap">Tanggal</th>
            <th class="whitespace-nowrap">Stok</th>
            <th class="whitespace-nowrap text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($tb_stok) > 0) : ?>
            <?php $i = 1 ?>
            <?php foreach ($tb_stok as $row) : ?>
                <tr>
                    <th class="border-b dark:border-dark-5"><?= $i++; ?></th>
                    <td class="border-b dark:border-dark-5"><?= $row->barcode ?></td>
                    <td class="border-b dark:border-dark-5"><?= $row->spareparts ?></td>
                    <td class="border-b dark:border-dark-5"><?= $row->jumlah ?></td>
                    <td class="border-b dark:border-dark-5"><?= $row->tanggal ?></td>
                    <td class="border-b dark:border-dark-5"><?= $row->stok ?></td>
                    <td class="border-b dark:border-dark-5">
                        <div class="btn-group btn-group-sm">
                            <a href="<?= base_url('spareparts/view_detailSpareParts/' . $row->id) ?>" class="btn btn-default bg-gradient-light border text-dark rounded-0" title="View Spare Parts"><i class="fa fa-eye"></i></a>

                            <a href="#" class="btn btn-danger rounded-0" data-id="<?= $row->id ?>" title="Delete Spare Parts" data-toggle="modal" data-target="#delete-modal-preview"><i class="fa fa-trash"></i></a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
<?php $this->endSection(); ?>