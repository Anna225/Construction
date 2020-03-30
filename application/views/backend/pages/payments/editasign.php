<div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <strong>Edit Asign Project</strong>
                </div>
                  
                <div class="card-body">
                  <form action="<?php echo base_url().'payments/editAsignPayment/'.$asignpayments->id_asign?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                    
                    <div class="form-group row">
                       <label class="col-md-3 col-form-label" for="fk_team">Select Team*</label>
                      <div class="col-md-4">
                           <div>
                              <?php echo form_dropdown('fk_team', $teamslist, $asignpayments->fk_team,'data-rel="chosen" id="fk_team" class="form-control" style="text-transform: capitalize;"');?>
                            </div>
                       </div>
                    </div>

                    <div class="form-group row">
                       <label class="col-md-3 col-form-label" for="agreed_amount">Agreed Amount*</label>
                      <div class="col-md-4">
                           <div>
                             <input type="text" id="agreed_amount" name="agreed_amount" class="form-control" value="<?=$asignpayments->agreed_amount?>" required>
                            </div>
                       </div>
                    </div>
                    <div class="form-group row">
                       <label class="col-md-3 col-form-label" for="fk_project">Select Project*</label>
                      <div class="col-md-4">
                           <div>
                              <?php echo form_dropdown('fk_project', $projectlist, $asignpayments->fk_project,'data-rel="chosen" id="fk_project" class="form-control" style="text-transform: capitalize;"');?>
                            </div>
                       </div>
                    </div>
                    <div class="form-group row">
                       <label class="col-md-3 col-form-label" for="fk_category">Select Category*</label>
                      <div class="col-md-4">
                           <div>
                              <?php echo form_dropdown('fk_category', $categorieslist, $asignpayments->fk_category,'data-rel="chosen" id="fk_category" class="form-control" onchange="updateSubCategoryProduct(options[selectedIndex].value)" style="text-transform: capitalize;"');?>
                            </div>
                       </div>
                    </div>
                    <div class="form-group row">
                       <label class="col-md-3 col-form-label" for="subcategory">Select SubCategory*</label>
                      <div class="col-md-4">
                           <div>
                              <?php echo form_dropdown('subcategory', $subcategorieslist, $asignpayments->fk_subcategory,'data-rel="chosen" id="subcategory" class="form-control" style="text-transform: capitalize;"');?>
                            </div>
                       </div>
                    </div>
                    <div class="form-group row">
                       <label class="col-md-3 col-form-label" for="start_date">Start Date*</label>
                      <div class="col-md-4">
                           <div>
                             <input type="text" id="start_date" name="start_date" class="form-control datepicker" value="<?= date("Y/m/d"); ?>"required>
                            </div>
                       </div>
                    </div>
                    <div class="form-group row">
                       <label class="col-md-3 col-form-label" for="target_date">Target Date*</label>
                      <div class="col-md-4">
                           <div>
                             <input type="text" id="target_date" name="target_date" class="form-control datepicker" value="<?= date("Y/m/d"); ?>"required>
                            </div>
                       </div>
                    </div>
                     
                  <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Update Asign Project</button>
                  <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
                  </form>
                </div>
              </div>
            </div>