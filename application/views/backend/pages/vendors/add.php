<div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <strong>Add Reseller Data</strong>Sales
                </div>
                <div class="card-body">
                  <form action="<?php echo base_url().'vendor/insert'?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                   
                      
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="text-input">Name</label>
                      <div class="col-md-3">
                        <input type="text" id="text-input" name="name_vendors" class="form-control" placeholder="Name Vendor">
                        
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="text-input">Company</label>
                      <div class="col-md-3">
                        <input type="text" id="text-input" name="company_vendors" class="form-control" placeholder="Vendor Company">
                        
                      </div>
                    </div>
                       <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="text-input">Contact</label>
                      <div class="col-md-3">
                        <input type="text" id="text-input" name="contact_vendors" class="form-control" placeholder="Contact Vendor">
                        
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="text-input">Address</label>
                      <div class="col-md-3">
                        <input type="text" id="text-input" name="adress_vendors" class="form-control" placeholder="Address Vendor">
                        
                      </div>
                    </div>
                      <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="select">Status </label>
                      <div class="col-md-4">
                        <select id="select" name="status_vendors" class="form-control">
                          <option value="0">Active</option>
                            <option value="1">Not Active</option>
 
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="text-input">Today Date</label>
                      <div class="col-md-3">
                         <input type="text" id="text-input" name="added_date_vendors" class="form-control" value="<?= date("Y/m/d"); ?>">
                        
                      </div>
                    </div>
                      
                  <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>
                  <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
              




  
                    
                  </form>
                </div>
                
                
              </div>
              
            </div>
