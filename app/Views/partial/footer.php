<footer class="main-footer">
  <div class="float-right d-none d-sm-block">
    <b>Version</b> 3.2.0
  </div>
  <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url('adminLTE/plugins/jquery/jquery.min.js') ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('adminLTE/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('adminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js') ?>"></script>
<script src="<?= base_url('adminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('adminLTE/plugins/jszip/jszip.min.js') ?>"></script>
<script src="<?= base_url('adminLTE/plugins/pdfmake/pdfmake.min.js') ?>"></script>
<script src="<?= base_url('adminLTE/plugins/pdfmake/vfs_fonts.js') ?>"></script>
<script src="<?= base_url('adminLTE/plugins/datatables-buttons/js/buttons.html5.min.js') ?>"></script>
<script src="<?= base_url('adminLTE/plugins/datatables-buttons/js/buttons.print.min.js') ?>"></script>
<script src="<?= base_url('adminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js') ?>"></script>

<!-- ChartJS -->
<script src="<?= base_url('adminLTE/plugins/chart.js/Chart.min.j') ?>"></script>
<!-- Sparkline -->
<script src="<?= base_url('adminLTE/plugins/sparklines/sparkline.js') ?>"></script>
<!-- JQVMap -->
<script src="<?= base_url('adminLTE/plugins/jqvmap/jquery.vmap.min.js') ?>"></script>
<script src="<?= base_url('adminLTE/plugins/jqvmap/maps/jquery.vmap.usa.js') ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url('adminLTE/plugins/jquery-knob/jquery.knob.min.js') ?>"></script>
<!-- daterangepicker -->
<script src="<?= base_url('adminLTE/plugins/moment/moment.min.js') ?>"></script>
<script src="<?= base_url('adminLTE/plugins/daterangepicker/daterangepicker.js') ?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('adminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') ?>"></script>
<!-- Summernote -->
<script src="<?= base_url('adminLTE/plugins/summernote/summernote-bs4.min.js') ?>"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('adminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>"></script>

<!-- Search in dropdown -->
<!-- Select2 -->
<script src="<?= base_url('adminLTE/plugins/select2/js/select2.full.min.js') ?>"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="<?= base_url('adminLTE/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') ?>"></script>
<!-- InputMask -->
<script src="<?= base_url('adminLTE/plugins/moment/moment.min.js') ?>"></script>
<script src="<?= base_url('adminLTE/plugins/inputmask/jquery.inputmask.min.js') ?>"></script>
<!-- bootstrap color picker -->
<script src="<?= base_url('adminLTE/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') ?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('adminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') ?>"></script>
<!-- BS-Stepper -->
<script src="<?= base_url('adminLTE/plugins/bs-stepper/js/bs-stepper.min.js') ?>"></script>
<!-- dropzonejs -->
<script src="<?= base_url('adminLTE/plugins/dropzone/min/dropzone.min.js') ?>"></script>

<script src="<?= base_url() ?>/js/jquery-3.6.0.min.js"></script>

<!-- AdminLTE App -->
<!-- <script src="<?= base_url('adminLTE/dist/js/adminlte.js') ?>"></script> -->

<!-- <script src="../../plugins/datatables/jquery.dataTables.min.js"></script> -->
<!-- <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script> -->
<!-- <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script> -->
<!-- <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script> -->
<!-- <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script> -->
<!-- <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script> -->
<!-- <script src="../../plugins/jszip/jszip.min.js"></script> -->
<!-- <script src="../../plugins/pdfmake/pdfmake.min.js"></script> -->
<!-- <script src="../../plugins/pdfmake/vfs_fonts.js"></script> -->
<!-- <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script> -->
<!-- <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script> -->
<!-- <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script> -->
<!-- AdminLTE App -->
<script src="<?= base_url('adminLTE/dist/js/adminlte.min.js') ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('adminLTE/dist/js/demo.js') ?>"></script>
<!-- Page specific script -->
<script>
  // detailKeranjang() // pertama halaman dibuka load detail keranjang
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
    // $('#gtotal').text(parseFloat(total).toLocaleString('en-US', {
    $('#gtotal').val(parseFloat(total).toLocaleString('en-US', {
      style: 'decimal',
      maximumFractionDigits: 2,
      minimumFractionDigits: 2
    }))
    $('#sub_total').val(parseFloat(total).toLocaleString('en-US', {
      style: 'decimal',
      maximumFractionDigits: 2,
      minimumFractionDigits: 2
    }))
    $('[name="total_amount"]').val(total)
    
    $('#tampilkan_total').text(parseFloat(total).toLocaleString('en-US', {
      style: 'decimal',
      maximumFractionDigits: 2,
      minimumFractionDigits: 2
    }))
    $('[name="total_amount"]').val(total)

    if($('#tampilkan_total' > 0)){
      $('#tendered').prop('disabled', false)
    } 

    if($('#tendered' > 0)){
      $('#save_transaction').prop('disabled', false)
    } 

  }

  $(function() {
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
      $('#select2_pelanggan_id').prop('disabled', true)

      $('#cancel_payment').prop('disabled', false)

    })

    $('[name="tendered"]').on('input change', function() {
      var tendered = $(this).val()
      var amount = $('[name="total_amount"]').val()
      tendered = tendered > 0 ? tendered : 0;
      amount = amount > 0 ? amount : 0;
      var change = parseFloat(tendered) - parseFloat(amount);
      console.log(change)
      // $('#change').text(parseFloat(change).toLocaleString('en-US', {
        $('#change').val(parseFloat(change).toLocaleString('en-US', {
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

    // Search in dropdown
    //Initialize Select2 Elements
    $('.select2').select2()

    $('#select2_spareparts_id').select2()
    $('#select2_products').select2()

    //Initialize Select2 Elements
    $('#select2_spareparts_id').select2({
      theme: 'bootstrap4',
    })

    $('#select2_spareparts_id').on('change', (event) => {
      getProduk(event.target.event).then(produk => {
        $('#spareparts_stok_masuk').val(produk.spareparts);
      });
    });

    async function getProduk(id) {
      let response = await fetch('spareparts/home/' + id)
      let data = await response.json();

      return data;
    }

    //Date picker
    $('#reservationdate').datetimepicker({
      format: 'L'
    });

    $('#select2_spareparts_id').on('change', (event) => {
      getBarang(event.target.value).then(spareparts_id => {
        $('#spareparts').val(spareparts_id.spareparts);
        $('#stok').val(spareparts_id.stok);
        $('#kategori_id').val(spareparts_id.kategori_id);
        $('#supplier_id').val(spareparts_id.supplier_id);
      });

    });

    $('#select2_spareparts_stok_masuk').on('change', (event) => {
      getBarang(event.target.value).then(spareparts_id => {
        $('#spareparts').val(spareparts_id.spareparts);
        $('#stok').val(spareparts_id.stok);
        $('#kategori_id').val(spareparts_id.kategori_id);
        $('#supplier_id').val(spareparts_id.supplier_id);
      });

    });

    // Get Data Product pada halaman sales
    $('#select2_products').on('change', (event) => {
      getBarang(event.target.value).then(spareparts_id => {
        $('#spareparts').val(spareparts_id.spareparts);
        $('#barcode').val(spareparts_id.spareparts);
        $('#stok').val(spareparts_id.stok);
        $('#tampil-stok').text(spareparts_id.stok)

        if (spareparts_id.stok > 0) {
          // $('#tambah').prop('disabled', false)
          $('#jumlah_item').prop('disabled', false)
        } else {
          // $('#tambah').prop('disabled', true)
          $('#jumlah_item').prop('disabled', true)
        }

      });

    });

    $('#jumlah_item').on('keyup', function(e) {
      let jumlah = parseInt(e.target.value)
      let barcode = $('#barcode').val()

      if (isNaN(jumlah) || jumlah == 0) {
        $('#tambah').prop('disabled', true)
      } else {
        // dari sini
        $.ajax({
          url: "<?= base_url('penjualan/cekStok') ?>",
          data: {
            barcode: barcode,
          },
          dataType: 'json',
          success: (respon) => {
            if (jumlah > respon.stok) {
              Swal.fire({
                title: `Jumlah melebihi stok, maksimal ${respon.stok}`,
                icon: 'warning',
              }).then((res) => {
                e.target.value = 1
              })
            }
          },
        })
        //sampe sini
        $('#tambah').prop('disabled', false)
      }
    })

    // Select Type Pelanggan pada halaman sales
    $('#select_pelanggan').on('change', (event) => {
      getBarang(event.target.value).then(spareparts_id => {
        $('#spareparts').val(spareparts_id.spareparts);
        $('#stok').val(spareparts_id.stok);
        $('#tampil-stok').text(spareparts_id.stok)

        if (spareparts_id.stok > 0) {
          $('#add_item').prop('disabled', false)
        } else {
          $('#add_item').prop('disabled', true)
        }

      });

    });

    // Select Type Pelanggan pada halaman sales yang bener
    $('#select2_pelanggan_id').on('change', (event) => {
      getPelanggan(event.target.value).then(pelanggan_id => {
        $('#customer').val(pelanggan_id.nama);
      });

    });

    async function getBarang(id) {
      let response = await fetch('/api/home/' + id)
      let data = await response.json();

      return data;
    }

    async function getSupplier(id) {
      let response = await fetch('/api/home/' + id)
      let data = await response.json();

      return data;
    }

    async function getPelanggan(id) {
      let response = await fetch('/api/home/' + id)
      let data = await response.json();

      return data;
    }

    $('#tambah').on('click', function(e) {
      $('#select_pelanggan').prop('disabled', true)
      tambahKeKranjang()
    })

    $('#jumlah').on('keypress', function(e) {
      if (e.keyCode === 13 && e.target.value != '') {
        tambahKeKranjang()
      }
    })

    function tambahKeKranjang() {
      let iditem = $('#iditem').val()
      let barcode = $('#barcode').val()
      let nama = $('#nama').val()
      let harga = $('#harga').val()
      let stok = parseInt($('#stok').val())
      let jumlah = parseInt($('#jumlah').val())

      $.ajax({
        url: "<?= base_url('penjualan/tambah') ?>",
        method: 'post',
        data: {
          [$('#token').attr('name')]: $('#token').val(),
          iditem: iditem,
          barcode: barcode,
          nama: nama,
          harga: harga,
          jumlah: jumlah,
          stok: stok,
        },
        success: function(response) {
          if (response.status) {
            detailKeranjang()
            $('#jumlah').val('').prop('disabled', true)
            $('#tambah').prop('disabled', true)
            $('#barcode').val('').focus()
            $('#tampil-stok').text('')
            toastr.success(response.pesan, 'Sukses', {
              timeOut: 500
            })
          } else {
            toastr.error(response.pesan)
          }
        },
      })
      $('#batal').prop('disabled', false)
    }

    /**
     * Menampilkan detail isi keranjang
     */
    function detailKeranjang() {
      let keranjang = ''
      $.ajax({
        url: "<?= base_url('penjualan/keranjang') ?>",
        dataType: 'json',
        success: function(response) {
          $('#invoice').text(response.invoice) // menampilkan no invoice
          $('#tampilkan_total').text(rupiah(response.sub_total)) // menampilkan total harga
          $('#sub_total').val(response.sub_total) // isi value sub_total
          $('#total_akhir').val(response.sub_total) // isi value total_akhir
          // menampilkan detail keranjang
          if (response.keranjang.length === 0) {
            keranjang = `<tr><td colspan="7" class="text-center">Keranjang masih kosong</td></tr>`
            $('#diskon').prop('disabled', true)
            $('#tunai').prop('disabled', true)
            $('#catatan').prop('disabled', true)
            $('#batal').prop('disabled', true)
          } else {
            $('#diskon').prop('disabled', false)
            $('#tunai').prop('disabled', false)
            $('#catatan').prop('disabled', false)
            $('#batal').prop('disabled', false)
            // $("#tunai").val(0);

            $.each(response.keranjang, function(i, data) {
              keranjang += `<tr>
						<td>${data.barcode}</td>
						<td>${data.nama}</td>
						<td>${data.harga}</td>
						<td>${data.jumlah}</td>
						<td>${data.diskon}</td>
						<td>${data.total}</td>
						<td>
							<button class="btn btn-success btn-sm" id="edit-item" data-toggle="modal" data-target="#modal-item-edit" data-id="${data.id}" data-barcode="${data.barcode}" data-item="${data.nama}" data-harga="${data.harga}" data-jumlah="${data.jumlah}" data-diskon="${data.diskon}" data-subtotal="${data.total}" data-stok="${data.stok}"><i class="fa fa-edit"></i></button>
							<button class="btn btn-danger btn-sm" id="hapus-item" data-id="${data.id}"><i class="fa fa-trash"></i></button>
						</td>
						</tr>`
            })
          }
          $('tbody').html(keranjang)
        },
      })
    }

  });
</script>
</body>

</html>