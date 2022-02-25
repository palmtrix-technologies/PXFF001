</div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b></b> 
        </div>
        <strong>Copyright &copy; 2019-2020 &nbsp FERRY FOLKS logistics solutions| powered <a href="<?php echo base_url(); ?>user-home" > </a> by &nbsp <a href="http://www.palmtrix.com/"> Palmtrix Technologies llc</a>.</strong>
      </footer>
    </div><!-- ./wrapper -->

    
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url(); ?>/assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="<?php echo base_url(); ?>/assets/plugins/slimScroll/jquery.slimScroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo base_url(); ?>/assets/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>/assets/dist/js/app.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>/assets/js/wizard.js" type="text/javascript"></script>
 <!-- datatable -->
 <script src="<?php echo base_url(); ?>/assets/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>/assets/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    
                        
    <script src="<?php echo base_url(); ?>/assets/js/moment.js"></script>
 <!-- <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-flash-1.6.1/b-print-1.6.1/datatables.min.js"></script> -->
 <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.colVis.min.js"></script>
 <script src="<?php echo base_url(); ?>/assets/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>   
 <!-- map -->
 <script src="<?php echo base_url(); ?>/assets/js/plugins/maps/jvectormap/jvectormap.min.js" type="text/javascript"></script>   
 <script src="<?php echo base_url(); ?>/assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>

 <!-- <script src="<?php echo base_url(); ?>/assets/dist/js/demo.js" type="text/javascript"></script>    -->
 <script src="<?php echo base_url(); ?>/assets/plugins/chartjs/Chart.min.js" type="text/javascript"></script>
 <script src="<?php echo base_url(); ?>/assets/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>

   <script type="text/javascript">
      $(function () {
      
        $('.indexer').dataTable({
          "bPaginate": true,
          "bLengthChange": true,
          "bFilter": true,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": true,
            dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
        });
      });
    </script>
  <script>
     $(function () {
     $("#mytable").DataTable({
                  "paging": false,
                  "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
              dom: "Bfrtip",
              buttons: [
                {
                  extend: "copy",
                  className: "btn-sm"
                },
                {
                    extend: 'colvis',
                    collectionLayout: 'fixed two-column'
                },
                {
                  extend: "csv",
                  className: "btn-sm"
                },
                {
                  extend: "excel",
                  className: "btn-sm"
                },
                {
                  extend: "print",
                  className: "btn-sm",
                  tittle:'',
                    exportOptions: {
                  columns: ':visible'
                    },
                    customize: function (win) {
                        // $(win.document.body)
                        //     .css('font-size', '10pt')
                        //     // .prepend(
                        //     //     '<img src="<?php echo IMAGE_PATH.'header.png';?>" style="width:100%;" />'
                        //     );

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                },
              ],
              responsive: true
            });
          } );

</script>
 <script>
          $(document).ready(function() {
            // $('.dtnew').DataTable( {
            //         dom: 'Bfrtip',
            //         buttons: [
            //             {
            //                 extend: 'pdfHtml5',
            //                 orientation: 'landscape',
            //                 pageSize: 'LEGAL'
            //             }
            //         ]
            //     } );
            } );
      </script>

  </body>

</html>