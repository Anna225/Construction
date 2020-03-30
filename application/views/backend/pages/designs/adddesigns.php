<div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <strong>Add Design</strong>
                </div>
                  
                <div class="card-body">
                  <form action="<?php echo base_url().'designs/insertDesign'?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <input type="hidden" id="sectionname" name="sectionname" class="form-control" value="<?=$sectionname?>">

                    <div class="row">
                      <div class="col-md-7">
                        <div class="form-group row">
                           <label class="col-md-4 col-form-label" for="fk_category">Category*</label>
                          <div class="col-md-8">
                               <div>
                                <?php echo form_dropdown('fk_category',$categorieslist,'','data-rel="chosen" id="fk_category" class="form-control" onchange="updateSubCategoryProduct(options[selectedIndex].value)" style="text-transform: capitalize;"');
                                ?>
                                </div>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-md-4 col-form-label" for="subcategory">SubCategory*</label>
                          <div class="col-md-8">
                               <div>
                                <select id="subcategory" class="form-control" name="subcategory" style="text-transform: capitalize;"></select>
                                </div>
                           </div>
                        </div>
                      
                        <div class="form-group row">
                          <label class="col-md-4 col-form-label" for="design_name">Design Name*</label>
                          <div class="col-md-8">
                            <input type="text" id="design_name" name="design_name" class="form-control" placeholder="Enter design name" required>
                           
                          </div>
                        </div>
                        
                        <div class="form-group row">
                           <label class="col-md-4 col-form-label" for="upload_file">Image*</label>
                          <div class="col-md-8">
                               <div>
                                 <input type="file" id="upload_file" name="upload_file" class="form-control"  onchange="preViewImage(this, 'preview_project')" required>
                                </div>
                           </div>
                        </div>
                      </div>
                      <div class="col-md-5" align="center" style="margin-bottom:15px;">
                        <img id="preview_project" style="height: 200px;" />
                      </div>

                      <div class="col-md-12">     
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Add Design</button>
                        <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
                      </div>
                    </div>
                  </form>
                </div>
                
                
              </div>
              
            </div>
