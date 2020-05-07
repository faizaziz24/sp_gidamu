    <script src="<?php echo base_url(); ?>assets/js/common.js" type="text/javascript" ></script>
    <!-- ID Name -->
    <script src="<?php echo base_url(); ?>assets/js/add-id.js" type="text/javascript"></script>    
    <script src="<?php echo base_url(); ?>assets/js/edit-id.js" type="text/javascript"></script>    
    <!-- DataTables -->
    <script src="<?php echo base_url(); ?>assets/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <!-- bootstrap datepicker -->
    <script src="<?php echo base_url(); ?>assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/app.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.validate.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/validation.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo base_url(); ?>assets/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url(); ?>assets/select2/dist/js/select2.full.min.js"></script>
    <!-- page script -->
    <script>
      $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable({
          'paging'      : true,
          'lengthChange': false,
          'searching'   : false,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : false
        })

        $('#datepicker').datepicker({
          autoclose: true,
          format: 'yyyy-mm-dd'
        })

        $('.textarea').wysihtml5()

        $('.select2').select2()
      })
    </script>
  </body>
</html>