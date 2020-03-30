<!-- <script>
   function updateSubCategory(id)
    {
    d = new Date();
    u = "<?php echo base_url() ;?>products/selectsubcategory/"+id+"/"+d.getTime();
    //alert(u);
    $("#subcategory").load(u);
   }
   function updateProducts(id2)
   {
    d2 = new Date();
    u2 = "<?php echo base_url() ;?>products/selectproduct/"+id2+"/"+d2.getTime();
   // alert(u2);
    $("#fkproduct").load(u2);   
   }
</script>
 --><div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <strong>Create Invoice</strong>
                </div>
                  
                <div class="card-body">
                  <form action="<?php echo base_url().'invoices/insertcreatedinvoices'?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                    
                    <div class="form-group row">
                       <label class="col-md-3 col-form-label" for="date01">Select Project*</label>
                      <div class="col-md-3">
                           <div>
                              <?php echo form_dropdown('fk_project',$projectlist,'','data-rel="chosen" class="form-control" style="text-transform: capitalize;"');?>
                            </div>
                       </div>
                    </div>
                    <div class="form-group row">
                       <label class="col-md-3 col-form-label" for="date01">Select Category*</label>
                      <div class="col-md-3">
                           <div>
                              <?php echo form_dropdown('fk_category',$categorylist,'','data-rel="chosen" class="form-control" id="fk_category" style="text-transform: capitalize;" onchange="updateCompanyList()"');?>
                            </div>
                       </div>
                    </div>
                    <div class="form-group row">
                       <label class="col-md-3 col-form-label" for="date01">Select Company*</label>
                      <div class="col-md-3">
                           <div>
                              <select id="fk_company" class="form-control" name="fk_company" style="text-transform: capitalize;">
                                <option value="0">Select Company</option>
                                </select>
                            </div>
                       </div>
                    </div>
                    
                  
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="text-input">Order Date</label>
                      <div class="col-md-3">
                         <input type="text" id="text-input" name="date_order" class="form-control" value="<?= date("Y/m/d"); ?>">
                        
                      </div>
                    </div>
                       
                  <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Create Invoice</button>
                  <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
                  </form>
                </div>
                
                
              </div>
              
            </div>
