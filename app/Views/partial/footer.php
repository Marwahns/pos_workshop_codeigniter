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
<!-- AdminLTE App -->
<script src="<?= base_url('adminLTE/dist/js/adminlte.min.js') ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('adminLTE/dist/js/demo.js') ?>"></script>

<!-- Page specific script -->
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

    $('[name="grand_total"]').val(total)

    $('#tampilkan_total').text(parseFloat(total).toLocaleString('en-US', {
      style: 'decimal',
      maximumFractionDigits: 2,
      minimumFractionDigits: 2
    }))

    if ($('#tampilkan_total' > 0)) {
      $('#tendered').prop('disabled', false)
      $('#save_transaction').prop('disabled', false)
    }

    // if($('#tendered' > 0)){
    //   $('#save_transaction').prop('disabled', false)
    // } 
    $('#change').val(0 - total)
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
        tr.find('.rem_item').click(function() {
          if (confirm("Are you sure to remove this item") === true) {
            tr.remove()
            calculate_total()
          }
        })
        tr.find('[name="quantity[]"]').on('change input', function() {
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

        $('#show_stok').text('')
      }

    })

    $('[name="diskon"]').on('input change', function() {
      var diskon = $(this).val()
      var sub_total = $('[name="total_amount"]').val()
      var totalDiskon = parseFloat(diskon / 100) * parseFloat(sub_total)
      diskon = diskon > 0 ? diskon : 0;
      sub_total = sub_total > 0 ? sub_total : 0;
      var calculateDiskon = parseFloat(sub_total) - parseFloat(totalDiskon);
      console.log(calculateDiskon)
      $('#gtotal').val(parseFloat(calculateDiskon).toLocaleString('en-US', {
        style: 'decimal',
        maximumFractionDigits: 2,
        minimumFractionDigits: 2
      }))

      $('#change').val(0 - calculateDiskon)

      // calculate_total()
    })


    $('[name="tendered"]').on('input change', function() {
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
      if (amount < 0) {
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
        $('#stokKeluar').val(spareparts_id.stok);
        $('#kategori_id').val(spareparts_id.kategori_id);
        $('#supplier_id').val(spareparts_id.supplier_id);
      });

    });

    $('#jumlahKeluar').on('input change', function() {
      var stok = $('#stokKeluar').val()
      var jumlah = $('#jumlahKeluar').val()
      if (jumlah > stok) {
        alert('Jumlah melebihi stok, maksimal ' + stok, '', {
          timeOut: 500,
        })
        $('#btn_stok_keluar').prop('disabled', true)
        $('#jumlah').val(0) // set jumlah quantity menjadi 

      } else if(jumlah == 0) {
        $('#btn_stok_keluar').prop('disabled', true)
      } else{
        $('#btn_stok_keluar').prop('disabled', false)
      }

    })

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

    // Select Type Pelanggan pada halaman sales
    $('#select_pelanggan').on('change', (event) => {
      getBarang(event.target.value).then(spareparts_id => {
        $('#spareparts').val(spareparts_id.spareparts);
        $('#stok').val(spareparts_id.stok);
        $('#tampil-stok').text(spareparts_id.stok)

        // if (spareparts_id.stok > 0) {
        //   $('#add_item').prop('disabled', false)
        // } else {
        //   $('#add_item').prop('disabled', true)
        // }

      });

    });

    // Select Type Pelanggan pada halaman sales yang bener
    $('#select2_pelanggan_id').on('change', (event) => {
      getPelanggan(event.target.value).then(pelanggan => {
        $('#nama_customer').val(pelanggan.nama);
        if ($('#nama_customer' == 'Membership')) {
          $('#diskon').prop('disabled', false)
        }
      });

    });

    $('#product').on('change', (event) => {
      getBarang(event.target.value).then(products => {
        $('#show_stok').text(products.stok);

        if (products.stok < 1) {
          $('#add_item').prop('disabled', true)
          alert('Produk Habis')
          $('#show_stok').text('');
        }

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
      let response = await fetch('/api/pelanggan/' + id)
      let data = await response.json();

      return data;
    }

  });
</script>
</body>

</html>