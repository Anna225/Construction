<div class="animated fadeIn">
    <div class="col-sm-12 ">
        
        <div class="card-group mb-2">
            <div class="card">
                <div class="card-header ">
                    <i class="fa fa-shopping-cart"></i> Orders Record
                </div>
                <div class="card-body py-2 px-6">
                    <div class="row"  style="text-transform: capitalize;">
                     
                      <div class="card col-sm-3">
                        <div class="card-body">
                            <div class="text-success text-uppercase font-weight-bold mb-2">
                               <?php echo $vendorname;?> 
                            </div>
                          <div class="small text-muted ">
                              Project: <span class="float-right"> <?php echo $projectname;?></span>
                          </div>
                          <div class="small text-muted ">
                              Client: <span class="status badge-pill status-success float-right"> <?php echo $projectclient;?></span>
                          </div>
                            <div class="small text-muted">
                             Address : <span class="float-right "><?php echo $projectaddress;?></span>   
                            </div>
                            
                        </div> 
                      </div>
                      <div class="card col-sm-3">
                        <div class="card-body">
                            <div class="text-danger text-uppercase font-weight-bold mb-2">
                               <?php echo $vendorname;?> 
                            </div>
                          <div class="small text-muted ">
                              Company: <span class="float-right"> <?php echo $vendorcompany;?></span>
                          </div>
                          <div class="small text-muted ">
<!--                               Registered: <span class="float-right"> <?php echo $vendordate;?></span>
 -->                              Registered: <span class="float-right"> <?php echo $orderdate;?></span>
                          </div>
                            <div class="small text-muted">
                             Products : <span class="status badge-pill status-danger float-right "><?php echo $vendorproduct;?></span>   
                            </div>
                            
                        </div> 
                      </div>
                      <div class="card col-sm-3">
                        <div class="card-body">
                            <div class="text-success text-uppercase font-weight-bold mb-2">
                                Order Number : <span class="float-right"> <?php echo $ordernumber;?></span> 
                            </div>
                          <div class="small text-muted ">
                              Order Date: <span class="float-right"><?php echo $orderdate; ?></span>
                          </div>
                            <div class="small text-muted">
                             Items Ordered : <span class="status badge-pill status-success float-right "><?php echo $orderitems; ?></span>   
                            </div>
                          <div class="small text-muted ">
                             Items Delivered: <span class="status badge-pill badge-warning float-right "><?php echo $delivereditems; ?></span> 
                          </div>
                            
                        </div> 
                      </div>
                      <div class="card col-sm-3">
                        <div class="card-body">
                            <div class="text-primary text-uppercase font-weight-bold mb-2">
                                Total Amount : <span class="float-right"><?php echo $totalordersamount; ?> PKR</span> 
                            </div>
                          <div class="small text-muted "> 
                              Paid Amount: <span class="float-right text-success"> <?php echo $totalamountpaid; ?> PKR</span>
                          </div>
                          <div class="small text-muted ">
                              Balance: <span class="float-right text-danger"> <?php echo $rest; ?> PKR</span>
                          </div>
                            <?php 
                            $baseurl = base_url();
                            $id = $this->uri->segment(3);
                            if($orderpystatus == 1)
                            {
                                $pystatus = 'Status : <a  href="'.$baseurl.'invoices/orderpymnotclearedstatus/'.$id.'"><span class="status badge-pill status-danger float-right ">Closed</span></a>';
                            }
                            else
                            {
                               $pystatus = 'Status :<a  href="'.$baseurl.'invoices/orderpymclearedstatus/'.$id.'"><span class="status badge-pill status-success float-right ">Open</span></a>'; 
                            }
                            ?>
                            
                           <div class="small text-muted ">
                           <?php echo $pystatus; ?>
                          </div> 
                          
                            
                        </div> 
                      </div>
                    </div>
                  <div class="row  table-responsive">
                    <table class="table table-responsive-sm table-hover table-outline mb-0">
                    <thead class="thead-light">
                      <tr>
                        <th class="text-center"><i class="icon-people"></i></th>
                        <th>Product</th>
                        <th class="text-center">Category</th>
                        <th>Sub Category</th>
                        <th class="text-center">Quantity</th>
                        <th>Price</th>
                        <th class="text-center">Amount</th>
                        <th class="text-center">Delivery</th>
                        <th class="text-center"><i class="icon-settings"></i></th>
                      </tr>
                    </thead>
                    <tbody>
                        
                      <?php
           
                            foreach ($itemsorderlist['records'] as $rows )
				{
                                if($rows['status_delivery_opd'] == 1)
                                {
                                    $status = "Delivered";
                                    $class = "text-success";
                                }
                                else 
                                {
                                  $status = "Pending";
                                    $class = "text-muted";  
                                }
                                
                                $totamount = number_format((float)$rows['totalamount'],2,'.','');
                               
                                echo '
                                    <tr style="text-transform: capitalize;">
                                    
                                       <td class="text-center  font-weight-bold">
                                            <div class="text-muted font-weight-bold">
                                            '.$rows['id_opd'].'
                                            </div>
                                       </td>
                                       <td class="text-muted  font-weight-bold">
                                            <div">
                                            '.$rows['name_product'].'
                                            </div>
                                       </td>
                                       
                                       <td class="text-center text-muted font-weight-bold">
                                            <div">
                                            <i class="'.$rows['class'].'"></i> '.$rows['category'].'
                                            </div>
                                       </td> 
                                       <td class="text-muted  font-weight-bold">
                                            <div">
                                            '.$rows['subcategory'].'
                                            </div>
                                       </td> 
                                       <td class="text-muted text-center font-weight-bold">
                                            <div>
                                            '.$rows['qty_opd'].' Kg
                                            </div>     
                                       </td>
                                       <td class="text-muted font-weight-bold">
                                            <div>
                                            '.$rows['price_opd'].' Pkr
                                            </div>
                                        </td>
                                       <td class="text-center text-primary font-weight-bold">    
                                            <div>
                                            '.$totamount.' Pkr
                                            </div>
                                        </td>
                                       <td class="'.$class.' text-center">
                                            <div class=" font-weight-bold">
                                                <span>'.$status.'</span>
                                            </div>
                                            <div class="small text-muted">
                                                Date : '.$rows['date_delivery_opd'].'
                                             </div>
                                        </td>
                                       
                                       <td class="text-center">'.$rows['action'].'</td>   
                                    </tr>';									
				}			
                    ?>
                     
                      
                    </tbody>
                  </table>
                </div>
                   
                    
              </div>
            </div>
        </div>
        
        </div>
   
    <div class="col-sm-12">
              <div class="card">
                <div class="card-header">
                  <strong>Payments</strong>
                </div>
                <div class="card-body">
                  <div class="row">
                    <table class="table table-responsive-sm table-hover table-outline mb-0">
                    <thead class="thead-light">
                      <tr>
                        <th class="text-center"><i class="icon-people"></i></th>
                        <th class="text-center">Amount</th>
                        <th class="text-center">Date</th>
                        <th class="text-center">Type</th>
                        <th class="text-center">Details</th>
                        <th class="text-center">Status</th>
                        
                        <th class="text-center"><i class="icon-settings"></i></th>
                      </tr>
                    </thead>
                    <tbody>
                        
                      <?php
           
                            foreach ($orderspaymentlist['records'] as $rows )
				{
                                if($rows['status_payment_opd'] == 1)
                                {
                                    $status = "Recived";
                                    $class = "text-success";
                                }
                                else 
                                {
                                  $status = "Not Recived";
                                    $class = "text-danger";  
                                }
                                
                                if($rows['type_payment_opd'] == 1)
                                {
                                    $type = "Cash";
                                }
                                elseif ($rows['type_payment_opd'] == 2) 
                                {
                                $type = "Bank Cheque";
                                 }
                                 elseif($rows['type_payment_opd'] == 3)
                                {
                                $type ="Online";     
                                }
                                else
                                {
                                 $type = "Others";
                                }
                                echo '
                                    <tr>
                                    
                                       <td class="text-center  font-weight-bold">
                                            <div class="text-muted font-weight-bold">
                                            '.$rows['id_payment_opd'].'
                                            </div>
                                       </td>
                                       <td class="text-center text-primary font-weight-bold">
                                            <div">
                                            '.$rows['amount_payment_opd'].' Pkr
                                            </div>
                                       </td>
                                       <td class="text-muted text-center font-weight-bold">
                                            <div">
                                            '.$rows['date_payment_opd'].'
                                            </div>
                                       </td> 
                                       <td class="text-center text-muted font-weight-bold">
                                            <div">
                                            '.$type.'
                                            </div>
                                       </td> 
                                       <td class="text-center text-muted font-weight-bold">
                                            <div">
                                            '.$rows['info_payment_opd'].'
                                            </div>
                                       </td> 
                                       <td class="'.$class.' text-center font-weight-bold">
                                            <div>
                                            '.$status.'
                                            </div>     
                                       </td>
                                       
                                       
                                       <td class="text-center">'.$rows['action'].'</td>   
                                    </tr>';									
				}			
                    ?>
                     
                      
                    </tbody>
                  </table>
                </div>
                </div>
             </div>
              
     </div>
  
    
 <div class="col-sm-12">
            <div class="row">
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header">
                  <strong>Add Products</strong>
                </div>
                <div class="card-body">
                  <form action="<?php echo base_url().'invoices/insertitems'?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                    
                    <div class="form-group row">
                       <label class="col-sm-6 col-form-label" for="date01">Select Products*</label>
                      <div class="col-sm-4">
                           <div>
                              <?php echo form_dropdown('fk_prodvend_opd',$productlist['options'],$productlist['select'],'data-rel="chosen" class="form-control"');?>
                            </div>
                       </div>
                    </div>
                   <div class="form-group row">
                      <label class="col-sm-6 col-form-label" for="text-input">Fk Order</label>
                      <div class="col-sm-2">
                         <input type="text" id="text-input" name="fk_orders_opd" class="form-control" value="<?= $this->uri->segment(3); ?>">
                        
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-6 col-form-label" for="text-input">Qty / Kg</label>
                      <div class="col-sm-4">
                          <input type="text" id="text-input" name="qty_opd" class="form-control" placeholder="Add Qty /Kg" value="">
                        
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-6 col-form-label" for="text-input">Price</label>
                      <div class="col-sm-4">
                          <input type="text" id="text-input" name="price_opd" class="form-control" placeholder="Add Price" value="">
                        
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-6 col-form-label" for="select">Delivery Status </label>
                      <div class="col-md-3">
                        <select id="select" name="status_delivery_opd" class="form-control">
                          <option value="0">Not Delivered</option>
                            <option value="1">Delivered</option>
 
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-6 col-form-label" for="text-input">Delivery Date</label>
                      <div class="col-sm-3">
                         <input type="text" id="text-input" name="date_delivery_opd" class="form-control" value="<?= date("Y/m/d"); ?>">
                        
                      </div>
                    </div>
                  <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Add Products</button>
                  <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
                </form>
                </div>
              </div>
              <!--/.card-->
            </div>
            <!--/.col-->
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header">
                  <strong>Add Payments</strong>
                </div>
                <div class="card-body">
                  <form action="<?php echo base_url().'invoices/insertpayments'?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                    
                    
                    <div class="form-group row">
                      <label class="col-sm-6 col-form-label" for="text-input">Amount</label>
                      <div class="col-sm-4">
                          <input type="text" id="text-input" name="amount_payment_opd" class="form-control" placeholder="Amount PKR" value="">
                        
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-6 col-form-label" for="select">Type </label>
                      <div class="col-md-3">
                        <select id="select" name="type_payment_opd" class="form-control">
                          <option value="1">Cash</option>
                          <option value="2">Bank Cheque</option>
                          <option value="3">Online</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-6 col-form-label" for="text-input">Info</label>
                      <div class="col-sm-4">
                          <input type="text" id="text-input" name="info_payment_opd" class="form-control" placeholder="Cheque Number etc" value="">
                        
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-6 col-form-label" for="select">Status </label>
                      <div class="col-md-3">
                        <select id="select" name="status_payment_opd" class="form-control">
                          <option value="1">Recived</option>
                          <option value="2">Not Recived</option>
                          
                        </select>
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label class="col-sm-6 col-form-label" for="text-input">Payment Date</label>
                      <div class="col-sm-3">
                         <input type="text" id="text-input" name="date_payment_opd" class="form-control" value="<?= date("Y/m/d"); ?>">
                        
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-6 col-form-label" for="text-input">Fk Order</label>
                      <div class="col-sm-2">
                         <input type="text" id="text-input" name="fk_orders_prodvent" class="form-control" value="<?= $this->uri->segment(3); ?>">
                        
                      </div>
                    </div>
                  <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Add Payments</button>
                  <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
                </form>
                </div>
              </div>
            </div>
            <!--/.col-->
          </div>
 </div>  
</div>


