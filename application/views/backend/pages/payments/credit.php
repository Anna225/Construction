<div class="animated fadeIn">
    <div class="col-sm-12 ">
      <div class="row">
          <div class="col-md-2">
              <?php
                  $this->load->view('backend/pages/payments/common/mobmenu');
              ?>
          </div>
          <div class="col-md-10">
            <div class="card">
                <div class="card-header ">
                  <i class="fa fa-edit"></i> Credit Payments
                  
                   <a href="<?php echo base_url() ;?>payments/addcreditpayments" class="btn btn-outline-secondary btn-sm float-right font-sm"><i class="fa fa-plus"></i> Add Credit</a>
                  
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
                    if(isset($selected_projectid)){
                      $selected_projectid = $selected_projectid;
                    }else{
                      $selected_projectid = "";
                    }

                    echo form_dropdown('fk_project', $projectDrpdwnList, $selected_projectid, 'data-rel="chosen" id="fk_project" class="form-control" style="text-transform: capitalize;" onchange="creditPaymentsFilterByProject()"'); ?>
                </div>

                <div class="col-sm-7">
                  <div class="row">
                      <div class="col-sm-6 py-1 text-white  centered" >   
                          <div class="text-muted text-center font-weight-bold text-uppercase">
                              <a href="<?php echo base_url()?>payments/credit/all"><button type="button" class="btn btn-outline-primary btn-sm">All</button></a>
                              <a href="<?php echo base_url()?>payments/credit/today"><button type="button" class="btn btn-outline-primary btn-sm">Today</button></a>
                              <a href="<?php echo base_url()?>payments/credit/week"><button type="button" class="btn btn-outline-primary btn-sm">This Week</button></a>
                              <a href="<?php echo base_url()?>payments/credit/month"><button type="button" class="btn btn-outline-primary btn-sm">This Month</button></a>
                              <a href="<?php echo base_url()?>payments/credit/year"><button type="button" class="btn btn-outline-primary btn-sm">This Year</button></a>
                          </div>
                      </div>
                      <div class="col-sm-6" > 
                          <form action="<?php echo base_url()?>payments/credit" method="post" enctype="multipart/form-data" class="form-horizont">
                            <fieldset class="form-group">
                              <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                              <input name="daterange" class="form-control" type="text" value="<?php if(isset($filter_date)) echo $filter_date; ?>">
                              <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>
                              </div>
                            </fieldset>
                          </form>
                      </div> 
                  </div>
                </div>
                
            </div>  
        </div>

                <div class="card-body table-responsive">
                  <table class="table table-striped table-bordered datatable">
                    <thead>
                      <tr>
                        <th># ID</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Project</th>
                        <th>Paid By</th>
                        <th>Balance</th>
                        <th>Comment</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    
                      <?php
                            $baseurl = base_url();
                                foreach ($creditpaymentslist['records'] as $rows )
    				                    {
                                    $creditid = $rows['id_credit'];
                                    if($rows['type_payment_credit'] == 1)
                                    {
                                        $type = "Cash";
                                    }
                                    elseif ($rows['type_payment_credit'] == 2) 
                                    {
                                    $type = "Bank Cheque";
                                     }
                                     elseif($rows['type_payment_credit'] == 3)
                                    {
                                    $type ="Online";     
                                    }
                                    else
                                    {
                                     $type = "Others";
                                    }

                                    $restamounts = $rows['balance'];
                                    $restamounts = number_format((float)$restamounts,2,'.','');
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
                                        
                                           <td>
                                                <div class="text-muted font-weight-bold mb-2">
                                                    <span>'.$creditid.'</span>
                                                </div>  
                                           </td>
                                           <td>
                                                <div class="text-muted font-weight-bold mb-2">
                                                    <span>'.$rows['date_payment_credit'].'</span>
                                                </div>  
                                           </td>
                                           <td>
                                                <div class="text-success font-weight-bold mb-2">
                                                    <span>'.$rows['amount_payment_credit'].' PKR</span>
                                                </div>  
                                            </td>
                                           <td>
                                                <div class="text-muted font-weight-bold mb-2">
                                                    <span>'.$rows['name_project'].'</span>
                                                </div>  
                                           </td>
                                           <td>
                                                <div class="text-muted font-weight-bold mb-2">
                                                    <span>'.$type.'</span>
                                                </div>  
                                           </td>
                                           <td>
                                                <div class="text-'.$restamountfont.' font-weight-bold mb-2">
                                                    <span>'.$restamounts.' PRK</span>
                                                </div>  
                                           </td>
                                           <td>
                                                <div class="text-muted font-weight-bold mb-2">
                                                    <span>'.$rows['info_payment_credit'].'</span>
                                                </div>  
                                           </td>
                                           <td>
                                                <div class="text-muted font-weight-bold mb-2">
                                                    <span>'.$rows['action'].'</span>
                                                </div>  
                                           </td>
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