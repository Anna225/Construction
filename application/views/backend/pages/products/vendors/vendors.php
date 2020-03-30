<div class="animated fadeIn">
     <div class="col-sm-12 ">
    <div class="card">
            <div class="card-header ">
              <i class="fa fa-edit">Add Vendors Products</i>
              
              <button type="button" class="btn btn-outline-secondary btn-sm float-right font-sm">
               <a href="<?php echo base_url() ;?>products/addvendors/<?php echo $this->uri->segment(3); ?>"><i class="fa fa-plus-circle"></i> Add Products</a>
              </button>
              <button type="button" class="btn btn-warning btn-sm float-right font-sm">
              <a href="<?php echo base_url() ;?>products/prodvend"><i class="fa fa-product-hunt"></i> Load All </a>
               </button>
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
                    
                    <th>Product Name</th>
                    <th>Sub Category</th>
                    <th>Category</th>
                    <th>Vendor Name</th>
                    <th>Date</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    
                  <?php
           
                            foreach ($productsvendorslist['records'] as $rows )
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
                                       <td><i class="'.$rows['logoclass_category'].'"></i> '.$rows['name_category'].'</td>
                                       <td>'.$rows['name_vendors'].'</td>
                                       <td>'.$rows['date_prodvend'].'</td>
                                       <td>'.$rows['order_prodvend'].'</td>    
                                       
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