<div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <strong>Edit Labour Payment</strong>
                </div>
                  
                <div class="card-body">
                  <form action="<?php echo base_url().'payments/editLabourPayment/'.$labourpayments->id_labour?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                    
                    <div class="form-group row">
                       <label class="col-md-3 col-form-label" for="paid_amount_labourEdit">Paid Amount*</label>
                      <div class="col-md-4">
                           <div>
                             <input type="text" id="paid_amount_labourEdit" name="paid_amount_labourEdit" class="form-control" value="<?=$labourpayments->amount_payment_labour?>" required>
                            </div>
                       </div>
                    </div>
                    <div class="form-group row">
                       <label class="col-md-3 col-form-label" for="fk_project">Select Project*</label>
                      <div class="col-md-4">
                           <div>
                              <?php echo form_dropdown('fk_project',$projectlist, $labourpayments->fk_project, 'data-rel="chosen" id="fk_project" class="form-control" style="text-transform: capitalize;"');?>
                            </div>
                       </div>
                    </div>
                    <div class="form-group row">
                       <label class="col-md-3 col-form-label" for="fk_team">Select Team*</label>
                      <div class="col-md-4">
                           <div>
                              <?php echo form_dropdown('fk_team',$teamDrpdwnList, $labourpayments->fk_team, 'data-rel="chosen" id="fk_team" class="form-control" style="text-transform: capitalize;"');?>
                            </div>
                       </div>
                    </div>
                    <div class="form-group row">
                       <label class="col-md-3 col-form-label" for="paid_date_labourEdit">Select Date*</label>
                      <div class="col-md-4">
                           <div>
                             <input type="text" id="paid_date_labourEdit" name="paid_date_labourEdit" class="form-control datepicker" value="<?=$labourpayments->date_payment_labour?>" required>
                            </div>
                       </div>
                    </div>
                  
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="type_payment_labourEdit">Paid Type*</label>
                      <div class="col-md-4">
                        <select id="type_payment_labourEdit" name="type_payment_labourEdit" class="form-control">
                          <option value="1" <?php if($labourpayments->type_payment_labour == 1) echo "selected";?>>Cash</option>
                          <option value="2" <?php if($labourpayments->type_payment_labour == 2) echo "selected";?>>Bank Cheque</option>
                          <option value="3" <?php if($labourpayments->type_payment_labour == 3) echo "selected";?>>Online</option>
                        </select>
                        
                      </div>
                    </div>
                    
                    <div class="form-group row">
                       <label class="col-md-3 col-form-label" for="paid_info_labourEdit">Comment</label>
                      <div class="col-md-4">
                           <div>
                             <input type="text" id="paid_info_labourEdit" name="paid_info_labourEdit" class="form-control" value="<?=$labourpayments->info_payment_labour?>" required>
                            </div>
                       </div>
                    </div>
                       
                  <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Update Credit Payment</button>
                  <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
                  </form>
                </div>
                
                
              </div>
              
            </div>