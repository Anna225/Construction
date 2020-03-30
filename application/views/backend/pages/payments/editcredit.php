<div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <strong>Edit Credit Payment</strong>
                </div>
                  
                <div class="card-body">
                  <form action="<?php echo base_url().'payments/editCreditPayment/'.$creditpayments->id_credit?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                    
                    <div class="form-group row">
                       <label class="col-md-3 col-form-label" for="paid_amount_creditEdit">Paid Amount*</label>
                      <div class="col-md-4">
                           <div>
                             <input type="text" id="paid_amount_creditEdit" name="paid_amount_creditEdit" class="form-control" value="<?=$creditpayments->amount_payment_credit;?>" required>
                            </div>
                       </div>
                    </div>
                    <div class="form-group row">
                       <label class="col-md-3 col-form-label" for="fk_project">Select Project*</label>
                      <div class="col-md-4">
                           <div>
                              <?php echo form_dropdown('fk_project',$projectlist, $creditpayments->fk_project,'data-rel="chosen" id="fk_project" class="form-control" style="text-transform: capitalize;"');?>
                            </div>
                       </div>
                    </div>
                    <div class="form-group row">
                       <label class="col-md-3 col-form-label" for="paid_date_creditEdit">Select Date*</label>
                      <div class="col-md-4">
                           <div>
                             <input type="text" id="paid_date_creditEdit" name="paid_date_creditEdit" class="form-control datepicker" value="<?=$creditpayments->date_payment_credit ?>"required>
                            </div>
                       </div>
                    </div>
                  
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="type_payment_creditEdit">Paid Type*</label>
                      <div class="col-md-4">
                        <select id="type_payment_creditEdit" name="type_payment_creditEdit" class="form-control">
                          <option value="1" <?php if($creditpayments->type_payment_credit == 1) echo "selected";?>>Cash</option>
                          <option value="2" <?php if($creditpayments->type_payment_credit == 2) echo "selected";?>>Bank Cheque</option>
                          <option value="3" <?php if($creditpayments->type_payment_credit == 3) echo "selected";?>>Online</option>
                        </select>
                        
                      </div>
                    </div>
                    
                    <div class="form-group row">
                       <label class="col-md-3 col-form-label" for="paid_info_creditEdit">Comment</label>
                      <div class="col-md-4">
                           <div>
                             <input type="text" id="paid_info_creditEdit" name="paid_info_creditEdit" class="form-control" placeholder="Enter comment" value="<?=$creditpayments->info_payment_credit ?>" required>
                            </div>
                       </div>
                    </div>
                       
                  <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Update Credit Payment</button>
                  <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
                  </form>
                </div>
                
                
              </div>
              
            </div>
