<div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <strong>Basic Form</strong> Elements
                </div>
                <div class="card-body">
                  <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                   
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="text-input">Name</label>
                      <div class="col-md-6">
                          <input type="text" id="text-input" name="name_product" class="form-control" value="<?= $products->name_product; ?>">
                        
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="text-input">Company   </label>
                      <div class="col-md-6">
                          <input type="text" id="text-input" name="company_product" class="form-control" value="<?= $products->company_product; ?>">
                        
                      </div>
                    </div>
                    <div class="form-group row">
                       <label class="col-md-3 col-form-label" for="date01">Sub Category*</label>
                      <div class="col-md-3">
                           <div>
                              <?php echo form_dropdown('fk_subcategories',$subcategorylist['options'],$subcategorylist['select'],'data-rel="chosen" class="form-control"');?>
                            </div>
                       </div>
                    </div> 
                    
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="text-input">Order</label>
                      <div class="col-md-6">
                          <input type="text" id="text-input" name="order_product" class="form-control" value="<?= $products->order_product; ?>">
                        
                      </div>
                    </div>                      
                                         
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="select">Status</label>
                      <div class="col-md-4">
                        <select id="select" name="status_product" class="form-control">

                            <option <?= ($products->status_product)? "selected='selected'" : ""; ?> value="0">Active</option>
                            <option <?= ($products->status_product)? "selected='selected'" : ""; ?> value="1">Not Active</option>
 
                        </select>
                      </div>
                    </div> 
                    
 
                   
                   
                  <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>
                  <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
              
                     
                    
                  </form>
                </div>
                
                
              </div>
              
            </div>




