// Stok Masuk
$('#select2_spareparts_stok_masuk').on('change', (event) => {
    getBarang(event.target.value).then(spareparts_id => {
        $('#spareparts').val(spareparts_id.spareparts);
        $('#stok').val(spareparts_id.stok);
        $('#stok_kategori_id').val(spareparts_id.kategori_id);
        $('#txtKategori').val(spareparts_id.kategori);
        $('#stok_supplier_id').val(spareparts_id.supplier_id);
        $('#txtSupplier').val(spareparts_id.supplier);
        console.log(spareparts_id.kategori_id)
    });
});

// Stok Keluar
$('#select2_spareparts_id').select2()
//Initialize Select2 Elements
$('#select2_spareparts_id').select2({
    theme: 'bootstrap4',
})

$('#select2_spareparts_id').on('change', (event) => {
    getBarang(event.target.value).then(spareparts_id => {
        $('#spareparts').val(spareparts_id.spareparts);
        $('#stokKeluar').val(spareparts_id.stok);
        $('#stok_kategori_id').val(spareparts_id.kategori_id);
        $('#txtKategori').val(spareparts_id.kategori);
        $('#stok_supplier_id').val(spareparts_id.supplier_id);
        $('#txtSupplier').val(spareparts_id.supplier);
        $('#stok').val(spareparts_id.stok);
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

$('#select2_spareparts_stok_masuk').select2()

$('#jumlah').on('input change', function () {
    var stok = $('#stok').val()
    if ($(this).val() > stok) {
        alert('Melebihi limit stok')
        $(this).val(stok)
    }
})