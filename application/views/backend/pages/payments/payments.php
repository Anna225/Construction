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
                  <i class="fa fa-edit"></i> Invoice Payments
                  
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
        <div class="col-sm-12 col-lg-12" style="margin-top: 20px;">
            <div class="row">
                <div class="col-sm-2">
                    <?php 
                    if(isset($selected_projectid)){
                      $selected_projectid = $selected_projectid;
                    }else{
                      $selected_projectid = "";
                    }

                    echo form_dropdown('fk_project', $projectDrpdwnList, $selected_projectid, 'data-rel="chosen" id="fk_project" class="form-control" style="text-transform: capitalize;" onchange="paymentsFilter()"'); ?>
                </div>

                <div class="col-sm-2">
                    <?php 
                    if(isset($selected_companyid)){
                      $selected_companyid = $selected_companyid;
                    }else{
                      $selected_companyid = "";
                    }

                    echo form_dropdown('fk_company', $companyDrpdwnList, $selected_companyid, 'data-rel="chosen" id="fk_company" class="form-control" style="text-transform: capitalize;" onchange="paymentsFilter()"'); ?>
                </div>

                <div class="col-sm-2">
                    <?php 
                    if(isset($selected_categoryid)){
                      $selected_categoryid = $selected_categoryid;
                    }else{
                      $selected_categoryid = "";
                    }

                    echo form_dropdown('fk_category', $categoryDrpdwnList, $selected_categoryid, 'data-rel="chosen" id="fk_category" class="form-control" style="text-transform: capitalize;" onchange="paymentsFilter()"'); ?>
                </div>
                <div class="col-sm-6">
                  <div class="row">
                      <div class="col-sm-6 py-1 text-white  centered" >   
                          <div class="text-muted text-center font-weight-bold text-uppercase">
                              <a href="<?php echo base_url()?>payments/payments/all"><button type="button" class="btn btn-outline-primary btn-sm">All</button></a>
                              <a href="<?php echo base_url()?>payments/payments/today"><button type="button" class="btn btn-outline-primary btn-sm">Today</button></a>
                              <a href="<?php echo base_url()?>payments/payments/week"><button type="button" class="btn btn-outline-primary btn-sm">This Week</button></a>
                              <a href="<?php echo base_url()?>payments/payments/month"><button type="button" class="btn btn-outline-primary btn-sm">This Month</button></a>
                              <a href="<?php echo base_url()?>payments/payments/year"><button type="button" class="btn btn-outline-primary btn-sm">This Year</button></a>
                          </div>
                      </div>
                      <div class="col-sm-6" > 
                          <form action="<?php echo base_url()?>payments/payments" method="post" enctype="multipart/form-data" class="form-horizont">
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
                        <th># Invoice No</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Project</th>
                        <th>Company</th>
                        <th>Category</th>
                      </tr>
                    </thead>
                    <tbody>
                    
                      <?php
                            $baseurl = base_url();
                                foreach ($paymentslist['records'] as $rows )
    				                    {
                                    $inoviceid = $rows['invoice_id'];
                                   
                                    echo '
                                        <tr style="text-transform: capitalize;">
                                        
                                           <td>
                                                <div class="text-muted font-weight-bold mb-2">
                                                    <span>'.$inoviceid.'</span>
                                                </div>  
                                           </td>
                                           <td>
                                                <div class="text-muted font-weight-bold mb-2">
                                                    <span>'.$rows['invoice_date'].'</span>
                                                </div>  
                                            </td>
                                           <td>
                                                <div class="text-success font-weight-bold mb-2">
                                                    <span>'.$rows['invoice_amount'].' PKR</span>
                                                </div>  
                                           </td>
                                           <td>
                                                <div class="text-muted font-weight-bold mb-2">
                                                    <span>'.$rows['project'].'</span>
                                                </div>  
                                           </td>
                                           <td>
                                                <div class="text-muted font-weight-bold mb-2">
                                                    <span>'.$rows['company'].'</span>
                                                </div>  
                                           </td>
                                           <td>
                                                <div class="text-muted font-weight-bold mb-2">
                                                    <i class="'.$rows['category_class'].'"></i> <span>'.$rows['category'].'</span>
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