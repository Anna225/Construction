<div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <strong>Join Product</strong>
                </div>
                <div class="card-body">
                  <form action="<?php echo base_url().'products/insertJoinData'?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                   
                      
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="text-input">Product Name*</label>
                      <div class="col-md-5">
                        <select class="form-control" name="fk_product" style="text-transform: capitalize;">
                          <?php
                            echo '<option value="0">Select Product</option>';
                            $sql = "SELECT * FROM products";
                            $sql=$this->db->query($sql)->result();
                            foreach($sql as  $record)
                            {
                              echo'<option value="'.$record->id_product.'">'.$record->name_product.'</option>';
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                      <div class="form-group row">
                       <label class="col-md-3 col-form-label" for="text-input">Company Name*</label>
                      <div class="col-md-5">
                        <select class="form-control" name="fk_company" style="text-transform: capitalize;" required >
                          <?php
                            echo '<option value="0">Select Company</option>';
                            $sql = "SELECT * FROM packages_companies";
                            $sql=$this->db->query($sql)->result();
                            foreach($sql as  $record)
                            {
                              echo'<option value="'.$record->id.'">'.$record->title.'</option>';
                            }
                          ?>
                        </select>
                       </div>
                    </div> 
                      
                  <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>
                  <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
                  </form>
                </div>
              </div>
            </div>