<div class="animated fadeIn">
  <div class="col-sm-12 ">
    <div class="card">
      <div class="card-header ">
        <i class="fa fa-edit"></i> User List
         <a href="<?php echo base_url() ;?>user/add" class="btn btn-outline-secondary btn-sm float-right font-sm"><i class="fa fa-user-plus"></i> Add User</a>
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
              <th>Email</th>
              <th>Role</th>
              <th>Login Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
                foreach ($userlist['records'] as $rows ) 

                {
                    $userid = $rows['user_id'];
                    echo '
                        <tr>
                           <td>'.$userid.'</td>
                           <td>'.$rows['user_name'].'</td>
                           <td>'.$rows['user_email'].'</td>
                           <td>'.$rows['user_role'].'</td>
                           <td>'.$rows['last_login_date'].'</td>
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