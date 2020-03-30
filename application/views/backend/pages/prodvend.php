<div class="animated fadeIn">
     <div class="col-sm-12 ">
    <div class="card">
            <div class="card-header ">
              <i class="fa fa-edit"></i> Sales - Summary
              
               <a href="<?php echo base_url() ;?>products/add" class="btn btn-outline-secondary btn-sm float-right font-sm"><i class="fa fa-plus-circle"></i> Add Products</a>
              <a href="<?php echo base_url() ;?>products/prodvend" class="btn btn-warning btn-sm float-right font-sm"><i class="fa fa-product-hunt"></i> Load All </a>
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
            <div class="card-body">
              <table class="table table-striped table-bordered datatable">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Sub Category</th>
                    <th>Category</th>
                    <th>Vendor</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    
                  <?php
           
                            foreach ($productslist['records'] as $rows )
				{
                               
                               $status = $rows['status_prodvend'];
                               
                               if($status == 0)
                               {
                                $status = '<span class="badge badge-success">Active</span>';   
                               }
                               else if($status == 1)
                               {
                               $status = '<span class="badge badge-danger">Not Active</span>';    
                               }
                               
                                echo '
                                    <tr>
                                    
                                       <td>'.$rows['id_prodvend'].'</td>
                                       <td>'.$rows['name_product'].'</td>
                                       <td>'.$rows['name_subcategory'].'</td>
                                       
                                       <td><i class="'.$rows['logoclass_category'].'"></i>  '.$rows['name_category'].'</td>
                                        <td>'.$rows['name_vendors'].'</td>
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