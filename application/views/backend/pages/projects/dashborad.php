<div class="animated fadeIn"> 
    <?php
    //$this->load->view('backend/pages/office/common/topmenu');
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2">
                    <?php
                        $this->load->view('backend/pages/projects/common/mobmenu');
                    ?>
                </div>
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header ">
                          <i class="fa fa-edit"></i> Projects

                           <a href="<?php echo base_url() ;?>projects/addprojects" class="btn btn-outline-secondary btn-sm float-right font-sm"><i class="fa fa-plus-circle"></i> Add Projects</a>
                        </div>
                            <hr class="m-0">
                            <hr class="m-0">
                        <div class="col-sm-8 col-lg-12">
                            <div class="row">
                                <div class="col-sm-8">
                                    <small class="h2 text-success text-uppercase font-weight-bold">
                                        <?php echo $this->session->flashdata('userdatasavestatus'); ?>
                                    </small>
                                    <small class="h2 text-success text-uppercase font-weight-bold" id="join_result" style="display: none;">Joined Successfully!</small>
                                </div>
                            </div>  
                        </div>
                            <hr class="m-0">
                        <div class="card-body table-responsive">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped table-bordered datatable">
                                        <thead>
                                            <tr>
                                                <th># </th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Joined Client</th>
                                                <th>Amount Project</th>
                                                <th>Address</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            foreach ($projectslist['records'] as $rows ) 

                                            {
                                                $projectid = $rows['id_project'];

                                                if($rows['fk_status'] == 0){
                                                    $button_class = "badge-pending";
                                                    $icon_class = "fa fa-circle-o-notch fa-spin fa-lg";
                                                    $status_text = " Pending ";
                                                }else if($rows['fk_status'] == 1){
                                                    $button_class = "badge-confirmed";
                                                    $icon_class = "fa fa-hourglass-start fa-lg";
                                                    $status_text = " Progress.. ";
                                                }else if($rows['fk_status'] == 2){
                                                    $button_class = "badge-approved";
                                                    $icon_class = "fa fa-check fa-lg";
                                                    $status_text = " Completed ";
                                                }
                                               
                                                echo '
                                                    <tr style="cursor: pointer;">
                                                       <td>'.$projectid.'</td>
                                                       <td onclick="projectModal('.$projectid.')"><img src="'.base_url().$rows['images_project'].'" style="height:60px;" /></td>
                                                       <td>'.$rows['name_project'].'</td>
                                                       <td>'.form_dropdown('fk_client', $clientDrpdwnList, $rows['joined_client'], 'data-rel="chosen" class="form-control text-muted font-weight-bold" style="text-transform: capitalize;" onchange="projectJoinClient('.$projectid.', options[selectedIndex].value)"').'</td>
                                                       <td class="text-success font-weight-bold">'.$rows['amount_project'].'</td>
                                                       <td>'.$rows['address_project'].'</td>
                                                       <td>'.$rows['start_date'].'</td>
                                                       <td>'.$rows['end_date'].'</td>
                                                       <td>
                                                           <button type="button" class="badge badge-pill '.$button_class.'">
                                                                <i class="'.$icon_class.'"></i>'.$status_text.'
                                                           </button>
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
        </div>
    </div>
</div>

 <div class="modal fade" id="viewProjectModal">
    <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title float-left"><i class="fa fa-folder-open"></i> View Project</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="card bg-light" id="projectModalContent">
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
    </div>
</div>
