 <!-- Custom scripts required by this view -->
   

<!-- Bootstrap and necessary plugins -->
  <script src="<?php echo base_url() ;?>vendors/js/jquery.min.js"></script>
  <script src="<?php echo base_url() ;?>vendors/js/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script> 
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url() ;?>vendors/js/pace.min.js"></script>
  

  <!-- Plugins and scripts required by all views 
  <script src="<?php echo base_url() ;?>vendors/js/Chart.min.js"></script>
  -->
  

  <!-- Clever main scripts -->

  <script src="<?php echo base_url() ;?>js/app.js"></script>
  <script src="<?php echo base_url() ;?>js/builders.js"></script>

  

 
 
    <!-- Plugins and scripts required by this views -->
  <script src="<?php echo base_url() ;?>vendors/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url() ;?>vendors/js/dataTables.bootstrap4.min.js"></script>

  <!-- Custom scripts required by this view -->
  <script src="<?php echo base_url() ;?>js/views/tables.js"></script>
  <script src="<?php echo base_url() ;?>js/views/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url() ;?>js/views/bootstrap-datepicker.min.js"></script>
  

  <!-- JS code -->

<!-- Plugins and scripts required by this views -->
  <script src="<?php echo base_url() ;?>vendors/js/toastr.min.js"></script>
  <script src="<?php echo base_url() ;?>vendors/js/gauge.min.js"></script>
  <script src="<?php echo base_url() ;?>vendors/js/moment.min.js"></script>
  <script src="<?php echo base_url() ;?>vendors/js/daterangepicker.min.js"></script>

   <script src="<?php echo base_url() ;?>js/views/main.js"></script>
<!--JS below-->

  <script>
      
      
    function updateCategoriesOrderBy(id)
            {
                var va=document.getElementById("orderby"+id).value;
                
                u = "<?php echo base_url() ;?>setting/updatefeedscategoryorder/"+id+"/"+va;
                
                $("#orderby"+id).load(u);
            }
            
            

</script>