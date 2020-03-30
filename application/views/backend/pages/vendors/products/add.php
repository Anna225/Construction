<script>
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
<div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <strong>Add Reseller Data</strong>Sales
                </div>
                <div class="card-body">
                  <form action="<?php echo base_url().'vendor/insertproducts'?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                   
                    <div class="form-group row">
                       <label class="col-md-3 col-form-label" for="text-input">Select Vendor</label>
                      <div class="col-md-3">
                           <div>
                              <?php echo form_dropdown('fk_vendors_prodvend',$vendorlist,'','data-rel="chosen" id="select" class="form-control"');?>
                            </div>
                       </div>
                    </div>
                      
                    <div class="form-group row">
                       <label class="col-md-3 col-form-label" for="text-input">Select Category*</label>
                      <div class="col-md-3">
                           <div>
                              <select  onchange="updateSubCategory(options[selectedIndex].value)" class="form-control" name="" >
                                <?php
                                           echo '<option value="0">Select Category</option>';
                                           $sql = "SELECT * FROM categories";
                                           $sql=$this->db->query($sql)->result();
                                            foreach($sql as  $record)
                                                {
                                                    echo'<option value="'.$record->id_category.'">'.$record->name_category.'</option>';
                                                }?>
                              </select>
                            </div>
                       </div>
                    </div> 
                  
                   
                    <div class="form-group row">
                       <label class="col-md-3 col-form-label" for="focusedInput">Sub Category</label>
                      <div class="col-md-3">
                           <div>
                              <select id="subcategory" onchange="updateProducts(options[selectedIndex].value)" class="form-control" name="">
                                </select>
                            </div>
                       </div>
                    </div> 
                    
                    <div class="form-group row">
                       <label class="col-md-3 col-form-label" for="focusedInput">Select Products</label>
                      <div class="col-md-3">
                           <div>
                              <select id="fkproduct"  class="form-control" name="fk_products_prodvend">
                                </select>
                            </div>
                       </div>
                    </div> 
                    
                      <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="select">Status </label>
                      <div class="col-md-4">
                        <select id="select" name="status_prodvend" class="form-control">
                          <option value="0">Active</option>
                            <option value="1">Not Active</option>
 
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="text-input">Order</label>
                      <div class="col-md-3">
                        <input type="text" id="text-input" name="order_prodvend" class="form-control" placeholder="Address Vendor">
                        
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="text-input">Today Date</label>
                      <div class="col-md-3">
                         <input type="text" id="text-input" name="date_prodvend" class="form-control" value="<?= date("Y/m/d"); ?>">
                        
                      </div>
                    </div>
                   <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="text-input">Vendor Id</label>
                      <div class="col-md-2">
                          <input type="text" id="text-input " name="id" class="form-control" value="<?= $this->uri->segment(3); ?>">
                        
                      </div>
                    </div>     
                  <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>
                  <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
              




  
                    
                  </form>
                </div>
                
                
              </div>
              
            </div>
