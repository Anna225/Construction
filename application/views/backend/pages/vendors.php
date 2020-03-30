<div class="animated fadeIn">
     <div class="col-sm-12 ">
   
         <div class="card">
            <div class="card-header ">
              <i class="fa fa-edit"></i> Sales - Summary
              
              <button type="button" class="btn btn-outline-secondary btn-sm float-right font-sm">
               <a href="<?php echo base_url() ;?>vendor/add"><i class="fa fa-plus-circle"></i> Add Vendors</a>
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
              <table class="table table-striped table-bordered datatable ">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Company</th>
                    <th>Contact</th>
                    <th>Address</th>
                    
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    
                  <?php
                            
                            foreach ($vendorslist['records'] as $rows )
				{
                               
                               $totproducts = $this->mvendors->getTotalVendorProductsID($rows['id_vendors']);
                               $tot = $totproducts[0]->totalproducts;
                               
                               $status = $rows['status_vendors'];
                               
                               if($status == 0)
                               {
                                $status = '<span class="status status-success">Active</span>';   
                               }
                               else if($status == 1)
                               {
                               $status = '<span class="status status-danger">Not Active</span>';    
                               }
                               
                                echo '
                                    <tr>
                                    
                                       <td>'.$rows['id_vendors'].'</td>
                                       <td>'.$rows['name_vendors'].'<span class="status badge-pill badge-warning float-right ">'.$tot.'</span></td>
                                       <td>'.$rows['company_vendors'].'</td>
                                       <td>'.$rows['contact_vendors'].'</td>
                                       <td>'.$rows['adress_vendors'].'</td>    
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