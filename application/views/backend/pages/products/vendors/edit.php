<div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <strong>Basic Form</strong> Elements
                </div>
                <div class="card-body">
                  <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                   
                     <div class="form-group row">
                       <label class="col-md-3 col-form-label" for="date01">Select Vendors*</label>
                      <div class="col-md-3">
                           <div>
                              <?php echo form_dropdown('fk_vendors_prodvend',$vendorlist['options'],$vendorlist['select'],'data-rel="chosen" class="form-control"');?>
                            </div>
                       </div>
                    </div>
                     <div class="form-group row">
                       <label class="col-md-3 col-form-label" for="date01">Select Products*</label>
                      <div class="col-md-3">
                           <div>
                              <?php echo form_dropdown('fk_products_prodvend',$productslist['options'],$productslist['select'],'data-rel="chosen" class="form-control"');?>
                            </div>
                       </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="text-input">Order</label>
                      <div class="col-md-6">
                          <input type="text" id="text-input" name="order_prodvend" class="form-control" value="<?= $vendorsproducts->order_prodvend; ?>">
                        
                      </div>
                    </div>                      
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="select">Status</label>
                      <div class="col-md-4">
                        <select id="select" name="status_prodvend" class="form-control">

                            <option <?= ($vendorsproducts->status_prodvend)? "selected='selected'" : ""; ?> value="0">Active</option>
                            <option <?= ($vendorsproducts->status_prodvend)? "selected='selected'" : ""; ?> value="1">Not Active</option>
 
                        </select>
                      </div>
                    </div> 
                   <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="text-input">Date</label>
                      <div class="col-md-6">
                          <input type="text" id="text-input" name="date_prodvend" class="form-control" value="<?= $vendorsproducts->date_prodvend; ?>">
                        
                      </div>
                    </div>                      
                    
                    
 
                   
                   
                  <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>
                  <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
              
                     
                    
                  </form>
                </div>
                
                
              </div>
              
            </div>




