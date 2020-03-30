<div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <strong>Create Labour Payment</strong>
                </div>
                  
                <div class="card-body">
                  <form action="<?php echo base_url().'payments/insertLabourPayment'?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                    
                    <div class="form-group row">
                       <label class="col-md-3 col-form-label" for="paid_amount_labour">Paid Amount*</label>
                      <div class="col-md-4">
                           <div>
                             <input type="text" id="paid_amount_labour" name="paid_amount_labour" class="form-control" placeholder="Enter amount" required>
                            </div>
                       </div>
                    </div>
                    <div class="form-group row">
                       <label class="col-md-3 col-form-label" for="fk_project">Select Project*</label>
                      <div class="col-md-4">
                           <div>
                              <?php echo form_dropdown('fk_project',$projectlist,'','data-rel="chosen" id="fk_project" class="form-control" style="text-transform: capitalize;"');?>
                            </div>
                       </div>
                    </div>
                    <div class="form-group row">
                       <label class="col-md-3 col-form-label" for="fk_team">Select Team*</label>
                      <div class="col-md-4">
                           <div>
                              <?php echo form_dropdown('fk_team',$teamDrpdwnList,'','data-rel="chosen" id="fk_team" class="form-control" style="text-transform: capitalize;"');?>
                            </div>
                       </div>
                    </div>
                    <div class="form-group row">
                       <label class="col-md-3 col-form-label" for="paid_date_labour">Select Date*</label>
                      <div class="col-md-4">
                           <div>
                             <input type="text" id="paid_date_labour" name="paid_date_labour" class="form-control datepicker" value="<?= date("Y/m/d"); ?>" required>
                            </div>
                       </div>
                    </div>
                  
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="type_payment_labour">Paid Type*</label>
                      <div class="col-md-4">
                        <select id="type_payment_labour" name="type_payment_labour" class="form-control">
                          <option value="1">Cash</option>
                          <option value="2">Bank Cheque</option>
                          <option value="3">Online</option>
                        </select>
                        
                      </div>
                    </div>
                    
                    <div class="form-group row">
                       <label class="col-md-3 col-form-label" for="paid_info_labour">Comment</label>
                      <div class="col-md-4">
                           <div>
                             <input type="text" id="paid_info_labour" name="paid_info_labour" class="form-control" placeholder="Enter comment" required>
                            </div>
                       </div>
                    </div>
                       
                  <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Create Credit Payment</button>
                  <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
                  </form>
                </div>
                
                
              </div>
              
            </div>