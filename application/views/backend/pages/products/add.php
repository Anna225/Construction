<div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <strong>Add Products</strong>
                </div>
                <div class="card-body">
                  <form action="<?php echo base_url().'products/insert'?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                   
                      
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="text-input">Name</label>
                      <div class="col-md-5">
                        <input type="text" id="text-input" name="name_product" class="form-control" placeholder="Product Name">
                        
                      </div>
                    </div>
                      <div class="form-group row">
                       <label class="col-md-3 col-form-label" for="text-input">Category*</label>
                      <div class="col-md-5">
                           <div>
                              <select  onchange="updateSubCategoryProduct(options[selectedIndex].value)" class="form-control" name="" style="text-transform: capitalize;">
                                <?php
                                           echo '<option value="0">Select Category</option>';
                                           $sql = "SELECT * FROM packages_stages_categories";
                                           $sql=$this->db->query($sql)->result();
                                            foreach($sql as  $record)
                                                {
                                                    echo'<option value="'.$record->id.'">'.$record->title.'</option>';
                                                }?>
                              </select>
                            </div>
                       </div>
                    </div> 
                   
                    <div class="form-group row">
                       <label class="col-md-3 col-form-label" for="focusedInput">Sub Category</label>
                      <div class="col-md-5">
                           <div>
                              <select id="subcategory" class="form-control" name="fk_subcategories" style="text-transform: capitalize;">
                                <option value="0">Select SubCategory</option>
                                </select>
                            </div>
                       </div>
                    </div> 

                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="select">Status </label>
                      <div class="col-md-5">
                        <select id="select" name="status_product" class="form-control">
                          <option value="0">Active</option>
                          <option value="1">Not Active</option>
 
                        </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="text-input">Order By</label>
                      <div class="col-md-5">
                        <input type="text" id="order_product" name="order_product" class="form-control" placeholder="Order by" >
                      </div>
                    </div>
                      
                  <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>
                  <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
                  </form>
                </div>
              </div>
            </div>