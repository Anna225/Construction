<div class="animated fadeIn">
    <div class="col-sm-12 ">
        <div class="card">
            <div class="col-sm-4">
                1
            </div>
            <div class="col-sm-6">
               2 
            </div>
        </div>
    </div>
    
    <div class="col-sm-12 ">
    <div class="card">
            <div class="card-header ">
              <div class="row">
              <div class="col-sm-6 ">
              <i class="fa fa-edit"></i> Sales - Summary
              </div>
              <div class="col-sm-6 ">
                 <a href="<?php echo base_url() ;?>products/joinProduct"  class="btn btn-outline-secondary btn-sm float-right font-sm"><i class="fa fa-plus-circle"></i> Join Product</a>

                 <a href="<?php echo base_url() ;?>products/add"  class="btn btn-outline-secondary btn-sm float-right font-sm"><i class="fa fa-plus-circle"></i> Add Products</a>

                <a href="<?php echo base_url() ;?>products/prodvend" class="btn btn-warning btn-sm float-right font-sm"><i class="fa fa-product-hunt"></i> Load All </a>
            </div>
          </div>
            </div>
        
        
        <hr class="m-0">
        
        <hr class="m-0">
        <div class="col-sm-8 col-lg-12">
            <div class="row">
                <div class="col-sm-8">
                    <small class="h2 text-success text-uppercase font-weight-bold">
                        <?php echo $this->session->flashdata('userdatasavestatus'); ?>
                    </small>
                </div>
                
            </div>  
        </div>

        <hr class="m-0">
        <div class="col-sm-8 col-lg-12" style="margin-top: 20px;">
            <div class="row">
                <div class="col-sm-2">
                    <?php 
                    if(isset($selected_companyid)){
                      $selected_companyid = $selected_companyid;
                    }else{
                      $selected_companyid = "";
                    }

                    echo form_dropdown('fk_company', $companyDrpdwnList, $selected_companyid, 'data-rel="chosen" id="fk_company" class="form-control" style="text-transform: capitalize;" onchange="productsFilter()"'); ?>
                </div>
                <div class="col-sm-2">
                    <?php 
                    if(isset($selected_productid)){
                      $selected_productid = $selected_productid;
                    }else{
                      $selected_productid = "";
                    }

                    echo form_dropdown('fk_product', $productDrpdwnList, $selected_productid, 'data-rel="chosen" id="fk_product" class="form-control" style="text-transform: capitalize;" onchange="productsFilter()"'); ?>
                </div>
                <div class="col-sm-2">
                    <?php 
                    if(isset($selected_categoryid)){
                      $selected_categoryid = $selected_categoryid;
                    }else{
                      $selected_categoryid = "";
                    }

                    echo form_dropdown('fk_category', $categoryDrpdwnList, $selected_categoryid, 'data-rel="chosen" id="fk_category" class="form-control" style="text-transform: capitalize;" onchange="productsFilter()"'); ?>
                </div>
                <div class="col-sm-2">
                    <?php 
                    if(isset($selected_subcategoryid)){
                      $selected_subcategoryid = $selected_subcategoryid;
                    }else{
                      $selected_subcategoryid = "";
                    }
                    //print_r($selected_subcategoryid);exit;
                    echo form_dropdown('fk_subcategory', $subcategoryDrpdwnList, $selected_subcategoryid, 'data-rel="chosen" id="fk_subcategory" class="form-control" style="text-transform: capitalize;" onchange="productsFilter()"'); ?>
                </div>
                
            </div>  
        </div>
                
            <div class="card-body table-responsive">
              <table class="table table-striped table-bordered datatable">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Joined companies</th>
                    <th>Sub Category</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    
                  <?php
           
                            foreach ($productslist['records'] as $rows )
				{
                               $totalproducts = $this->mproducts->getTotalVendors($rows['id_product']);
                               $totalp = $totalproducts[0]->totalproducts;
                               $status = $rows['status'];
                               
                               if($status == 0)
                               {
                                $status = '<span class="status status-success">Active</span>';   
                               }
                               else if($status == 1)
                               {
                               $status = '<span class="status status-danger">Not Active</span>';    
                               }

                               if(!empty($rows['icon_class']))
                               {
                                $icon_class = '<i class="'.$rows['icon_class'].'"></i>';   
                               }
                               else
                               {
                                $icon_class = '';    
                               }
                               
                                echo '
                                    <tr style="text-transform: capitalize;">
                                    
                                       <td>'.$rows['id_product'].'</td>
                                       <td>'.$rows['name_product'].' <span class="status badge-pill badge-warning float-right ">'.$totalp.'</span></td>
                                       <td>'.$rows['companies'].'</td>
                                       <td>'.$rows['subcategory'].'</td>
                                       <td>'.$icon_class.' '.$rows['category'].'</td>
                                       <td>'.$status.'</td>
                                       <td>'.$rows['action'].'</td>   
                                    </tr>';									
				}			
                    ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>