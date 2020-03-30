<div class="animated fadeIn">
    <div class="col-sm-12 ">
      <div class="row">
          <div class="col-md-2">
              <?php
                  $this->load->view('backend/pages/designs/common/mobmenu');
              ?>
          </div>
          <div class="col-md-10">
            <div class="card">
                <div class="card-header "  style="text-transform: capitalize;">
                  <i class="fa fa-edit"></i> <?=$this->uri->segment(2)?> Designs
                  
                   <a href="<?php echo base_url() ;?>designs/adddesigns/<?php echo $this->uri->segment(2);?>" class="btn btn-outline-secondary btn-sm float-right font-sm"><i class="fa fa-plus"></i> Add Design</a>
                  
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
/*                    if(isset($selected_projectid)){
                      $selected_projectid = $selected_projectid;
                    }else{
                      $selected_projectid = "";
                    }

                    echo form_dropdown('fk_project', $projectDrpdwnList, $selected_projectid, 'data-rel="chosen" id="fk_project" class="form-control" style="text-transform: capitalize;" onchange="creditPaymentsFilterByProject()"'); 
*/                    ?>
                </div>

                <div class="col-sm-2">
                    <?php
/*                      if(isset($filter_date)){
                        $filter_date = $filter_date;
                      }else{
                        $filter_date = "";
                      }
*/                    ?>

                    <input type="text" id="start_date_credit" name="start_date_credit" class="form-control datepicker" placeholder="Select Start Date" style="display: none;">
                </div>
                <div class="col-sm-8" style="display: none;">
                  <div class="row">
                      <div class="col-sm-6 py-1 text-white  centered" >   
                          <div class="text-muted text-center font-weight-bold text-uppercase">
                              <a href="/dairy/milkproduction/all"><button type="button" class="btn btn-outline-primary btn-sm">All</button></a>
                              <a href="/dairy/milkproduction/today"><button type="button" class="btn btn-outline-primary btn-sm">Today</button></a>
                              <a href="/dairy/milkproduction/week"><button type="button" class="btn btn-outline-primary btn-sm">This Week</button></a>
                              <a href="/dairy/milkproduction/month"><button type="button" class="btn btn-outline-primary btn-sm">This Month</button></a>
                              <a href="/dairy/milkproduction/year"><button type="button" class="btn btn-outline-primary btn-sm">This Year</button></a>
                          </div>
                      </div>
                      <div class="col-sm-6" > 
                          <form action="<?php echo base_url()?>" method="post" enctype="multipart/form-data" class="form-horizont">
                            <fieldset class="form-group">
                              <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                              <input name="daterange" class="form-control" type="text">
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
                        <th>Image</th>
                        <th>Design Name</th>
                        <th>Category</th>
                        <th>SubCategory</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      foreach ($designslist['records'] as $rows )
                      {
                         if(!empty($rows['icon_class']))
                         {
                          $icon_class = '<i class="'.$rows['icon_class'].'"></i>';   
                         }
                         else
                         {
                          $icon_class = '';    
                         }
                         $temp = "'".$rows['design_name']."', '".base_url().$rows['image_url']."', '".$rows['icon_class']."'";
                          echo '
                              <tr style="text-transform: capitalize; cursor: pointer;">
                              
                                 <td>
                                    <div class="text-muted font-weight-bold mb-2">
                                        <span>'.$rows['id'].'</span>
                                    </div>  
                                 </td>
                                 <td onclick="designModal('.$temp.')">
                                    <div class="text-muted font-weight-bold mb-2">
                                      <img src="'.base_url().$rows['image_url'].'" style="height: 60px;">
                                    </div>  
                                 </td>
                                 <td>
                                    <div class="text-muted font-weight-bold mb-2">
                                        <span>'.$rows['design_name'].'</span>
                                    </div>  
                                 </td>
                                 <td>
                                    <div class="text-muted font-weight-bold mb-2">
                                        <span>'.$icon_class.' '.$rows['category'].'</span>
                                    </div>  
                                 </td>
                                 <td>
                                    <div class="text-muted font-weight-bold mb-2">
                                        <span>'.$rows['subcategory'].'</span>
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

    <div class="modal fade" id="viewDesignImageModal">
      <div class="modal-dialog" style="-webkit-transform: translate(0,5%); -o-transform: translate(0,5%); transform: translate(0,5%);">
        <div style="text-transform: capitalize; color: #ffffff;">
          <div class="row">
            <div class="col-md-12"><button type="button" class="close" data-dismiss="modal">&times;</button></div>
            <div class="col-md-12" id="image_view"></div>
            <div class="col-md-12" id="image_title"></div>
          </div>
        </div>
      </div>
    </div>


<div class="modal fade" id="addDesignMenuModal">
    <div class="modal-dialog">
        <form method="post" action="<?php echo base_url();?><?php echo $this->uri->segment(1); ?>/addmobilemenu">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title float-left"><i class="fa fa-folder-open"></i> Add Menu</h4>
                </div>
                <div class="modal-body">

                  <div class="form-group row">
                    <input type="hidden" name="maincate" class="form-control" value="<?php echo $this->uri->segment(1); ?>" />    
                    <input type="hidden" name="segment2" class="form-control" value="<?php echo $this->uri->segment(2); ?>" />  
                    <label class="col-md-4 col-form-label" >Category</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" style="text-transform: capitalize;" value="<?=$this->uri->segment(2)?>" readonly />
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-4 col-form-label" >SubCategory</label>
                    <div class="col-md-8">
                       <div>
                        <?php 
                        $design_url = "'".$this->uri->segment(2)."'";
                        echo form_dropdown('fk_subcategory',$subcategorieslist,'','data-rel="chosen" id="fk_subcategory" class="form-control" onchange="updateDesignUrl('.$design_url.', options[selectedIndex].value)" style="text-transform: capitalize;"');
                        ?>
                        </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-4 col-form-label" >Url</label>
                    <div class="col-md-8">
                        <input type="text" id="design_url" name="design_url" class="form-control" readonly />
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-4 col-form-label" >Icon Class</label>
                    <div class="col-md-8">
                        <input type="text" name="icon" class="form-control" />
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-4 col-form-label">Status</label>
                    <div class="col-md-8">
                        <select name="status" class="custom-select">
                            <option selected value="1">Active</option>
                            <option  value="0">Not Active</option>
                        </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-4 col-form-label" >Order By</label>
                    <div class="col-md-8">
                        <input type="text" name="orderby" class="form-control" />
                    </div>
                  </div>
                <div class="modal-footer">
                    <input type="submit" name="action" value="Add" class="btn btn-success"/>
                    <input type="hidden" name="action" class="btn btn-success" value="Add" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>  