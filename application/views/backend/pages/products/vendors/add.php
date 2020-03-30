<div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <strong>Add Reseller Data</strong> Sales
                </div>
                <div class="card-body">
                  <form action="<?php echo base_url().'products/insertvendors'?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                   
                    <div class="form-group row">
                       <label class="col-md-3 col-form-label" for="text-input">Select Products</label>
                      <div class="col-md-5">
                           <div>
                              <?php echo form_dropdown('fk_products_prodvend',$productlist,'','data-rel="chosen" id="select" class="form-control" style="text-transform: capitalize;"');?>
                            </div>
                       </div>
                    </div>
                      
                    <div class="form-group row">
                       <label class="col-md-3 col-form-label" for="text-input">Select Products</label>
                      <div class="col-md-5">
                           <div>
                              <?php echo form_dropdown('fk_vendors_prodvend',$vendorslist,'','data-rel="chosen" id="select" class="form-control" style="text-transform: capitalize;"');?>
                            </div>
                       </div>
                    </div>
                    
                      <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="select">Status </label>
                      <div class="col-md-5">
                        <select id="select" name="status_prodvend" class="form-control" style="text-transform: capitalize;">
                          <option value="0">Active</option>
                            <option value="1">Not Active</option>
 
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="text-input">Order</label>
                      <div class="col-md-5">
                        <input type="text" id="text-input" name="order_prodvend" class="form-control" style="text-transform: capitalize;" placeholder="Address Vendor">
                        
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="text-input">Today Date</label>
                      <div class="col-md-5">
                         <input type="text" id="text-input" name="date_prodvend" class="form-control" value="<?= date("Y/m/d"); ?>" style="text-transform: capitalize;">
                        
                      </div>
                    </div>
                   <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="text-input">Product Id</label>
                      <div class="col-md-5">
                          <input type="text" id="text-input " name="id" class="form-control" value="<?= $this->uri->segment(3); ?>" style="text-transform: capitalize;" readonly >
                        
                      </div>
                    </div>     
                  <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>
                  <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
              




  
                    
                  </form>
                </div>
                
                
              </div>
              
            </div>
