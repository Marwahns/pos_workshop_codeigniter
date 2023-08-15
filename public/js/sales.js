// function perhitungan belanja
function calculate_total() {
    var total = 0;
    $('#item-table tbody tr').each(function () {
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

    // Total Akhir
    $('#gtotal').val(parseFloat(total).toLocaleString('en-US', {
        style: 'decimal',
        maximumFractionDigits: 2,
        minimumFractionDigits: 2
    }))

    // Sub Total
    $('#sub_total').val(parseFloat(total).toLocaleString('en-US', {
        style: 'decimal',
        maximumFractionDigits: 2,
        minimumFractionDigits: 2
    }))

    $('[name="total_amount"]').val(total)

    $('[name="grand_total"]').val(total)

    $('#tampilkan_total').text(parseFloat(total).toLocaleString('en-US', {
        style: 'decimal',
        maximumFractionDigits: 2,
        minimumFractionDigits: 2
    }))

    if ($('#tampilkan_total' > 0)) {
        $('#tendered').prop('readonly', false)
    }

    $('#change').val(0 - total)
}

$(function () {
    // DataTable dengan bootstrap
    $("#example1").DataTable({
        "bPaginate": false,
        "paging": false,
        "info": false,
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
        "bPaginate": false,
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": false,
        "autoWidth": false,
        "responsive": true,
    });

    $('#product').select2()

    // Penambahan produk ke keranjang belanja
    $('#add_item').click(function () {
        if ($('#nama_customer').val() == "") {
            alert("Please select type customer")
        } else {
            var pid = $('#product').val()
            if ($('#item-table tbody tr[data-id="' + pid + '"]').length > 0) {
                $('#item-table tbody tr[data-id="' + pid + '"]').find('[name="quantity[]"]').val(parseInt($('#item-table tbody tr[data-id="' + pid + '"]').find('[name="quantity[]"]').val()) + 1).trigger('change')
                $('#product').val('').trigger('change')
                return false;
            }
            var pname = $('#product option[value="' + pid + '"]').text()
            var stok = $('#product option[value="' + pid + '"]').attr('data-stok')
            var price = $('#product option[value="' + pid + '"]').attr('data-price')
            var tr = $($('noscript#item-clone').html()).clone()
            tr.attr('data-id', pid)
            tr.find('[name="product_id[]"]').val(pid)
            tr.find('[name="price[]"]').val(price)
            tr.find('.product_item').text(pname)
            tr.find('.stok').text(stok)
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
            tr.find('.rem_item').click(function () {
                if (confirm("Are you sure to remove this item") === true) {
                    tr.remove()
                    calculate_total()
                }
            })
            tr.find('[name="quantity[]"]').on('change input', function () {
                var qty = tr.find('[name="quantity[]"]').val()
                if (qty > stok) {
                    alert('Jumlah melebihi stok, maksimal ' + stok, '', {
                        timeOut: 500,
                    })
                    tr.find('[name="quantity[]"]').val(1) // set jumlah quantity menjadi 1
                }

                calculate_total()
            })

            $('#select2_pelanggan_id').prop('disabled', true)
            $('#cancel_payment').prop('disabled', false)
            $('#show_stok').text('-')
        }

    })

    // Diskon
    $('#diskon').prop('disabled', true)
    $('[name="diskon"]').on('input change', function () {
        var diskon = $(this).val()
        var sub_total = $('[name="total_amount"]').val()
        var totalDiskon = parseFloat(diskon / 100) * parseFloat(sub_total)
        diskon = diskon > 0 ? diskon : 0;
        sub_total = sub_total > 0 ? sub_total : 0;
        var calculateDiskon = parseFloat(sub_total) - parseFloat(totalDiskon);

        if (diskon > 10) {
            alert('Diskon tidak boleh melebihi 10%')
            $('#diskon').val(0) // set jumlah diskon menjadi 0
        }

        console.log(calculateDiskon)
        $('#gtotal').val(parseFloat(calculateDiskon).toLocaleString('en-US', {
            style: 'decimal',
            maximumFractionDigits: 2,
            minimumFractionDigits: 2
        }))

        $('#tampilkan_total').text(parseFloat(calculateDiskon).toLocaleString('en-US', {
            style: 'decimal',
            maximumFractionDigits: 2,
            minimumFractionDigits: 2
        }))

        $('#change').val(0 - calculateDiskon)

    })

    // Input nominal cash
    $('[name="tendered"]').on('input change', function () {
        var diskon = $('#diskon').val()
        var sub_total = $('[name="total_amount"]').val()
        var totalDiskon = parseFloat(diskon / 100) * parseFloat(sub_total)
        diskon = diskon > 0 ? diskon : 0;
        sub_total = sub_total > 0 ? sub_total : 0;
        var calculateDiskon = parseFloat(sub_total) - parseFloat(totalDiskon);

        var tendered = $(this).val()
        // var amount = $('[name="grand_total"]').val()
        tendered = tendered > 0 ? tendered : 0;
        // var change = parseFloat(tendered) - parseFloat(amount)
        var change = parseFloat(tendered) - parseFloat(calculateDiskon)
        console.log(change)
        $('#change').val(parseFloat(change).toLocaleString('en-US', {
            style: 'decimal',
            maximumFractionDigits: 2,
            minimumFractionDigits: 2
        }))

        if (parseFloat($('#change').val()) < 0) {
            $('#save_transaction').prop('disabled', true)
        } else {
            $('#save_transaction').prop('disabled', false)
        }

    })

    // Button Process Payment, menyimpan transaksi
    $('#save_transaction').click(function () {
        if ($('#item-table tbody tr').length <= 0) {
            alert("Please add at least 1 item first.")
            return false;
        }
        var tendered = $('[name="tendered"]').val()
        var amount = $('[name="total_amount"]').val()
        var change = $('[name="kembalian"]').val()

        if (parseFloat(change) >= 0) {
            $('#select2_pelanggan_id').val('');
            // return true;

            Swal.fire({
                title: 'Are you sure?',
                text: 'Continue Payment',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#transaction-form').submit();
                }
            });
        }

        if (parseFloat(tendered) < parseFloat(amount)) {
            alert("Invalid tendered amount")
            return false;
        }

        if (parseFloat(amount) < 0) {
            alert("Invalid tendered amount")
            return false;
        }

        // $('#transaction-form').submit()

    })

    // Search in dropdown
    //Initialize Select2 Elements
    // $('.select2').select2()

    $('#select2_products').select2()

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    $('#jumlah').on('input change', function () {
        var stok = $('#stokKeluar').val()
        var jumlah = $('#jumlah').val()
        var calculate = stok - jumlah
        console.log(jumlah)

        if (calculate < 0) {
            alert('Jumlah melebihi stok, maksimal ' + stok, '', {
                timeOut: 500,
            })
            $('#jumlah').val(1) // set jumlah menjadi 1
        } else if (jumlah == 0) {
            alert('Jumlah tidak boleh 0', {
                timeOut: 500,
            })
            $('#jumlah').val(1) // set jumlah menjadi 1    
        } else {
            $('#btn_stok_keluar').prop('disabled', false)
        }

    })

    // Select Type Pelanggan pada halaman sales
    $('#select_pelanggan').on('change', (event) => {
        getBarang(event.target.value).then(spareparts_id => {
            $('#spareparts').val(spareparts_id.spareparts);
            $('#stok').val(spareparts_id.stok);
            $('#tampil-stok').text(spareparts_id.stok)
        });

    });

    // Dapatkan referensi ke elemen <select> menggunakan ID
    var selectElement = document.getElementById("select2_pelanggan_id");

    // Tangkap peristiwa perubahan nilai
    selectElement.addEventListener("change", function () {
        // Dapatkan nilai yang dipilih
        var selectedValue = selectElement.value;

        // Dapatkan teks dari opsi yang dipilih
        var selectedText = selectElement.options[selectElement.selectedIndex].text;

        // Tampilkan alert dengan teks yang dipilih
        $('#nama_customer').val(selectedValue);

        if (selectedText == 'Membership') {
            $('#diskon').prop('disabled', false)
        } else {
            $('#diskon').val('0')
            $('#diskon').prop('disabled', true)
        }

    });

    $('#product').on('change', (event) => {
        getBarang(event.target.value).then(products => {
            $('#show_stok').text(products.stok);

            if (products.stok < 1) {
                $('#show_stok').text('');
                $('#add_item').prop('disabled', true)
                alert('Produk Habis')
            } else {
                $('#add_item').prop('disabled', false)
            }

        });

    });

    // Mengambil data produk (spareparts) dari database
    async function getBarang(id) {
        let response = await fetch('/api/home/' + id)
        let data = await response.json();

        return data;
    }

    // Mengambil data pelanggan dari database
    async function getPelanggan(id) {
        let response = await fetch('/api/pelanggan/' + id)
        let data = await response.json();

        return data;
    }

    $('#diskon').val('');
});