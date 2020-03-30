<div class="animated fadeIn">
    <div class="col-sm-12 ">
      <div class="row">
          <div class="col-md-2">
              <?php
                  $this->load->view('backend/pages/invoices/common/mobmenu');
              ?>
          </div>
          <div class="col-md-10">
            <div class="card">
                <div class="card-header ">
                  <i class="fa fa-edit"></i> Opened Invoices
                  
                   <a href="<?php echo base_url() ;?>invoices/addcreatedinvoices" class="btn btn-outline-secondary btn-sm float-right font-sm"><i class="fa fa-plus-circle"></i> Add Invoices</a>
                  
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

                    echo form_dropdown('fk_company', $companyDrpdwnList, $selected_companyid, 'data-rel="chosen" id="fk_company" class="form-control" style="text-transform: capitalize;" onchange="openedInvoicesFilter()"'); ?>
                </div>
                <div class="col-sm-2">
                    <?php 
                    if(isset($selected_projectid)){
                      $selected_projectid = $selected_projectid;
                    }else{
                      $selected_projectid = "";
                    }

                    echo form_dropdown('fk_project', $projectDrpdwnList, $selected_projectid, 'data-rel="chosen" id="fk_project" class="form-control" style="text-transform: capitalize;" onchange="openedInvoicesFilter()"'); ?>
                </div>
                
            </div>  
        </div>

                <div class="card-body table-responsive">
                  <table class="table table-striped table-bordered datatable">
                    <thead>
                      <tr>
                        <th># Order</th>
                        <th>Vendor</th>
                        <th>Amount</th>
                        <th>Paid Amount</th>
                        <th>Balance</th>
                        <th>Date Order</th>
                        <th>Ordered Items</th>
                        <th>Delivered Items</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    
                      <?php
                            $baseurl = base_url();
                                foreach ($orderslist['records'] as $rows )
    				{
                                    $orderid = $rows['id_order'];
                                    
                                    $totalordersamount = $this->minvoices->GetTotalOrdersAmount($orderid);
                                    $getamounts= $totalordersamount[0]->totalordersamount;
                                    
                                    $amounts = number_format((float)$getamounts,2,'.','');
                                    
                                    $totalamountpaid = $this->minvoices->GetTotalPaymentPaid($orderid);
                                    $getpaidamount= $totalamountpaid[0]->totalpaidamount;
                                    
                                    $paidamount = number_format((float)$getpaidamount,2,'.','');
                                    
                                    $getrestamount = $amounts - $paidamount;
                                    
                                    $restamounts = number_format((float)$getrestamount,2,'.','');
                                    
                                    $orderpaymentstatus = $this->minvoices->GetPaymentOrderStatus($orderid);
                                    $orderpystatus= $orderpaymentstatus[0]->status_payment_order;
                                    
                                    $orderdeditems = $this->minvoices->GetOrderdedItems($orderid);
                                    $totalordereditems= $orderdeditems[0]->totalordeditems;
            
                                    $delivereditems = $this->minvoices->GetDeliveredItems($orderid);
                                    $totaldelivereditems= $delivereditems[0]->totaldelivereditems;
                                    
                                    $vendorcompany = $this->minvoices->GetVendorCompany($orderid);
                                    $vendorcompanyname = $vendorcompany[0]->title;
                                    
                                    $getordereditems = $this->minvoices->GetOrderedItemsList($orderid);
                                    
                                    
                                    if($orderpystatus == 1)
                                    {
                                        
                                        $pystatus = '<a  href="'.$baseurl.'invoices/orderpymnotclearedstatusmain/'.$orderid.'"><span class="status badge-pill status-danger ">Closed</span></a>';
                                    }
                                    else
                                    {
                                        $pystatus = '<a  href="'.$baseurl.'invoices/orderpymclearedstatusmain/'.$orderid.'"><span class="status badge-pill status-success  ">Open</span></a>'; 
                                    }
                                    
                                    if($restamounts == 0 || $restamounts == 0.00 )
                                    {
                                        $restamountfont = 'muted';
                                    }
                                    elseif($restamounts < 0) 
                                    {
                                      $restamountfont = 'warning';  
                                    }
                                    
                                    else 
                                    {
                                        $restamountfont = 'danger';
                                    }
                                   
                                    echo '
                                        <tr style="text-transform: capitalize;">
                                        
                                           <td>'.$orderid.'</td>
                                           <td>
                                           '.$rows['name_project'].'
                                           <div class="small text-muted ">
                                                 <span class="float-left">'.$vendorcompanyname.'</span>
                                                </div>
                                            </td>
                                           <td>
                                                <div class="text-primary text-uppercase font-weight-bold mb-2">
                                                    <span>'.$amounts.' PKR</span>
                                                </div>  
                                           </td>
                                           <td>
                                                <div class="text-success text-uppercase font-weight-bold mb-2">
                                                    <span>'.$paidamount.' PKR</span>
                                                </div>  
                                           </td>
                                           <td>
                                                <div class="text-'.$restamountfont.' text-uppercase  font-weight-bold mb-2">
                                                    <span>'.$restamounts.' PKR</span>
                                                </div>  
                                           </td>
                                           <td>'.$rows['date_order'].'</td>
                                          <td>
                                                <div class="text-muted">
                                                    <span class="status badge-pill status-success">'.$totalordereditems.' </span> 
                                                    
                                                    <span class="small float-right" >
                                                    
                                                    </span>
                                                </div>
                                           </td> 
                                           <td>
                                                <div class="text-muted">
                                                    <span class="status badge-pill badge-warning">'.$totaldelivereditems.'</span>   
                                                </div>
                                           </td>
                                            <td> 
                                           <div class="small text-muted float-center ">
                                                '.$pystatus.'
                                                </div> 
                                            </td> 
                                           
                                           
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
        </div>
    </div>