


<footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="admin-template/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="admin-template/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="admin-template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="admin-template/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="admin-template/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="admin-template/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="admin-template/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="admin-template/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="admin-template/plugins/moment/moment.min.js"></script>
<script src="admin-template/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="admin-template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="admin-template/plugins/summernote/summernote-bs4.min.js"></script>

<!-- editor summer note -->

<!-- CodeMirror -->
<script src="admin-template/plugins/codemirror/codemirror.js"></script>
<script src="admin-template/plugins/codemirror/mode/css/css.js"></script>
<script src="admin-template/plugins/codemirror/mode/xml/xml.js"></script>
<script src="admin-template/plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>

<!-- overlayScrollbars -->
<script src="admin-template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="admin-template/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="admin-template/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="admin-template/js/pages/dashboard.js"></script>





<!-- Select2 -->
<script src="admin-template/plugins/select2/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="admin-template/plugins/inputmask/jquery.inputmask.min.js"></script>


<script>
  $(function () {
    // Summernote
    $('#summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>


</body>
</html>