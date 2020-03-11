<footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0.1
      </div>
      <strong>Copyright &copy; 2020 <a href="#">Novrian Syah (E1E1 14 028)</a>.</strong> All rights
      reserved.
    </div>
  </footer>
</div>

<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/fastclick/fastclick.js"></script>
<script src="<?php echo base_url();?>assets/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/js/demo.js"></script>
<script>
  $(function () {
    $(".select2").select2();
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true,
      format:'yyyy-mm-dd'
    });
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
<script>
  function f(x)
  {
    $('#datepickertanggal'+x).datepicker({
      autoclose: true,
      format:'yyyy-mm-dd'
    });   
  }


  var i = 1;
  while(i <= 100000){
    f(i);
    i=i+1;
  }
  
</script>
</body>
</html>