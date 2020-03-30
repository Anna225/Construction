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
                          <input type="text" id="text-input" name="name_vendors" class="form-control" value="<?= $vendorsfeeds->name_vendors; ?>">
                        
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="text-input">Company   </label>
                      <div class="col-md-6">
                          <input type="text" id="text-input" name="company_vendors" class="form-control" value="<?= $vendorsfeeds->company_vendors; ?>">
                        
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="text-input">Contact</label>
                      <div class="col-md-6">
                          <input type="text" id="text-input" name="contact_vendors" class="form-control" value="<?= $vendorsfeeds->contact_vendors; ?>">
                        
                      </div>
                    </div>                      
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="text-input">Address</label>
                      <div class="col-md-6">
                          <input type="text" id="text-input" name="adress_vendors" class="form-control" value="<?= $vendorsfeeds->adress_vendors; ?>">
                        
                      </div>
                    </div>                      
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="text-input">Date</label>
                      <div class="col-md-6">
                          <input type="text" id="text-input" name="added_date_vendors" class="form-control" value="<?= $vendorsfeeds->added_date_vendors; ?>">
                        
                      </div>
                    </div>                      
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="select">Status</label>
                      <div class="col-md-4">
                        <select id="select" name="status_vendors" class="form-control">

                            <option <?= ($vendorsfeeds->status_vendors)? "selected='selected'" : ""; ?> value="0">Active</option>
                            <option <?= ($vendorsfeeds->status_vendors)? "selected='selected'" : ""; ?> value="1">Not Active</option>
 
                        </select>
                      </div>
                    </div> 
                    
 
                   
                   
                  <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>
                  <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
              
                     
                    
                  </form>
                </div>
                
                
              </div>
              
            </div>




