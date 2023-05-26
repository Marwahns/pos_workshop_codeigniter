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
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

    // Search in dropdown
    //Initialize Select2 Elements
    $('.select2').select2()

    $('#select2_spareparts_id').select2()

    //Initialize Select2 Elements
    $('#select2_spareparts_id').select2({
      theme: 'bootstrap4',
    })

    // $('#select2_spareparts_id').on('change', (event) => {
    //   getProduk(event.target.event).then(produk => {
    //     $('#spareparts').val(produk.spareparts);
    //   });
    // });

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

  });
</script>
</body>

</html>