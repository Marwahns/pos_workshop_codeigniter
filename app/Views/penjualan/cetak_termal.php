<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bengkel ABC | Cetak Struk</title>
    <style>
        html {
            font-family: "Verdana, Arial";
            color: #333;
        }

        .container {
            width: 80mm;
            font-size: 12px;
            padding: 5px;
        }

        .title {
            text-align: center;
            font-size: 13px;
            padding-bottom: 5px;
            border-bottom: 1px dashed;
        }

        .title h2,
        p {
            margin-bottom: 0;
            margin-top: 0;
        }

        .head {
            margin-top: 5px;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid;
        }

        .table {
            width: 100%;
            font-size: 11px;
        }

        .kiri {
            text-align: left;
        }

        .kanan {
            text-align: right;
        }

        .terimakasih {
            margin-top: 10px;
            padding-top: 10px;
            text-align: center;
            border-top: 1px dashed;
        }

        @media print {
            @page {
                width: 80mm;
                margin: 0mm;
            }
        }
    </style>
</head>

<body onload="print()">
    <div class="container">
        <div class="title">
            <h2>Bengkel ABC</h2>
            <p>Depok, Jawa Barat</p>
            <p>0213456789</p>
        </div>
        <div class="head">
            <table class="table">
                <tr>
                    <td class="kiri"><?= date("d F Y H:i", strtotime(esc($items[0]['created_at']))) ?></td>
                </tr>
                <tr>
                    <td class="kiri"><?= esc($items[0]['code']); ?></td>
                    <td class="kanan">Pelanggan :</td>
                    <td class="kanan"><?= esc($items[0]['name_customer']); ?></td>
                </tr>

            </table>
        </div>
        <div class="items">
            <table class="table">
                <?php $diskon = 0; ?>
                <?php foreach (esc($items) as $data) : ?>
                    <tr>
                        <td class="kiri"><?= esc($data['spareparts']); ?></td>
                        <td class="kanan"><?= esc($data['quantity']); ?> x </td>
                        <td class="kanan"><?= rupiah(esc($data['price'])); ?></td>
                        <td class="kanan"><?= rupiah(esc($data['price'] * $data['quantity'])); ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="5" style="border-bottom:1px solid; "></td>
                </tr>
                <tr>
                    <td colspan="4" class="kanan">Sub Total</td>
                    <td class="kanan"><?= rupiah(esc($items[0]['total_amount'])); ?></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="3" style="border-bottom: 1px dashed;"></td>
                </tr>
                <?php if (esc($data['discount']) != 0) : ?>
                    <tr>
                        <td colspan="4" class="kanan">Diskon Pembelian</td>
                        <td class="kanan"><?= esc($items[0]['discount']); ?> %</td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <td colspan="4" class="kanan">Total Akhir</td>
                    <td class="kanan"><?= rupiah(esc($items[0]['grand_total'])); ?></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="3" style="border-bottom: 1px dashed;"></td>
                </tr>
                <tr>
                    <td colspan="4" class="kanan">Tunai</td>
                    <td class="kanan"><?= rupiah(esc($items[0]['tendered'])); ?></td>
                </tr>
                <tr>
                    <td colspan="4" class="kanan">Kembalian</td>
                    <td class="kanan"><?= rupiah(esc($items[0]['tendered'] - ($items[0]['grand_total']))); ?></td>
                </tr>
                <!-- <tr>
                    <td colspan="4" class="kanan">Catatan</td>
                </tr> -->
            </table>
        </div>

        <div class="terimakasih">
            ~~~~~ Terima Kasih ~~~~~
        </div>
    </div>
</body>

</html>

<script>
    function printContent(el) {
        var restorepage = $('body').html();
        var printcontent = $('#' + el).clone();
        $('body').empty().html(printcontent);
        window.print();
        $('body').html(restorepage);
    }
</script>