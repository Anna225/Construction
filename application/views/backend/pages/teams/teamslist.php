<div class="animated fadeIn">
  <div class="col-sm-12 ">
    <div class="card">
      <div class="card-header ">
        <i class="fa fa-edit"></i> Team List
         <a href="<?php echo base_url() ;?>teams/add" class="btn btn-outline-secondary btn-sm float-right font-sm"><i class="fa fa-user-plus"></i> Add Team</a>
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
      <div class="card-body table-responsive">
        <table class="table table-striped table-bordered datatable">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Category</th>
              <th>Subcategory</th>
              <th>Phone1</th>
              <th>Phone2</th>
              <th>Added Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
                foreach ($teamslist['records'] as $rows ) 

                {
                    $teamid = $rows['team_id'];
                    echo '
                        <tr style="text-transform: capitalize;">
                          <td>
                            <div class="text-muted font-weight-bold mb-2">
                                <span>'.$teamid.'</span>
                            </div>  
                          </td>
                          
                          <td>
                            <div class="text-muted font-weight-bold mb-2">
                                <span>'.$rows['team_name'].'</span>
                            </div>  
                          </td>
                          
                          <td>
                            <div class="text-muted font-weight-bold mb-2">
                                <i class="'.$rows['class'].'"></i> <span>'.$rows['category'].'</span>
                            </div>  
                          </td>
                          
                          <td>
                            <div class="text-muted font-weight-bold mb-2">
                                <span>'.$rows['subcategory'].'</span>
                            </div>  
                          </td>
                          
                          <td>
                            <div class="text-muted font-weight-bold mb-2">
                                <span>'.$rows['phone1'].'</span>
                            </div>  
                          </td>
                          
                          <td>
                            <div class="text-muted font-weight-bold mb-2">
                                <span>'.$rows['phone2'].'</span>
                            </div>  
                          </td>
                          
                          <td>
                            <div class="text-muted font-weight-bold mb-2">
                                <span>'.$rows['added_date'].'</span>
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