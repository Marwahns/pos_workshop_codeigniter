<footer class="main-footer">
  <div class="float-right d-none d-sm-block">
    <b>Version</b> 3.2.0
  </div>
  <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">Martz & AdminLTE.io</a>.</strong> All rights reserved.
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
<!-- <script src="<?= base_url('adminLTE/plugins/jquery-ui/jquery-ui.min.js') ?>"></script> -->
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

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- js -->
<script src="<?= base_url('adminLTE/plugins/dropzone/min/dropzone.min.js') ?>"></script>
<script src="<?= base_url('js/stok.js') ?>"></script>
<script src="<?= base_url('js/sales.js') ?>"></script>
<script src="<?= base_url('js/product.js') ?>"></script>

<!-- Page specific script -->
<script>
  // Alert Success_message
  <?php if (session()->has('success_message')) : ?>
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 2000,
    });

    Toast.fire({
      icon: 'success',
      title: '<?= session('success_message') ?>',
      // customClass: {
      //   container: 'alert-info' // Make sure 'alert-info' is a Bootstrap class
      // }
    });
  <?php endif; ?>

  // Alert permission
  <?php if (session()->has('permission')) : ?>
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: '<?= session('permission') ?>',
    })
  <?php endif; ?>

  // Alert Sign In
  <?php if (session()->has('signIn_message')) : ?>
    const ToastSignIn = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 2000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    })

    ToastSignIn.fire({
      icon: 'success',
      title: 'Signed in successfully'
    })
  <?php endif; ?>

  // Button Update
  $('#updateData').click(function() {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, update it!'
    }).then((result) => {
      if (result.isConfirmed) {
        $('#edit-form').submit();
      }
    })
  })

  // Button Delete
  function confirmDelete(event) {
    event.preventDefault(); // Mencegah navigasi langsung ke tautan

    const dataHref = event.target.getAttribute('data-href');
    console.log(dataHref); // Debugging output

    Swal.fire({
      title: 'Are you sure delete?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        // var dataHref = event.target.getAttribute('data-href');
        console.log(dataHref); // Debugging output
        window.location.href = dataHref;
      }
    });

    return false; // Menghentikan navigasi langsung di sini
  }
</script>
</body>

</html>