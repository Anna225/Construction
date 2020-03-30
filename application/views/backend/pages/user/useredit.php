<div class="col-md-6">
  <div class="card">
    <div class="card-header">
      <strong>Edit User</strong>
    </div>

    <div class="card-body">
      <form action="<?php echo base_url().'user/edituser/'.$user->user_id?>" method="post" enctype="multipart/form-data" class="form-horizontal">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-md-4 col-form-label" for="edit_name">Name*</label>
              <div class="col-md-8">
                <input type="text" id="edit_name" name="edit_name" class="form-control" value="<?=$user->user_name?>" autocomplete="off" required >
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label" for="edit_email">Email*</label>
              <div class="col-md-8">
                <input type="email" id="edit_email" name="edit_email" class="form-control" value="<?=$user->user_email?>"  autocomplete="off" required >
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label" for="edit_password">Password*</label>
              <div class="col-md-8">
                <input type="text" id="edit_password" name="edit_password" class="form-control" placeholder="Enter password" autocomplete="off" >
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label" for="edit_role">User Role*</label>
              <div class="col-md-8">
                <select class="form-control" id="edit_role" name="edit_role" required >
                	<option value="0">Select User Role</option>
                	<option value="superadmin" <?php if($user->user_role == 'superadmin') echo 'selected';?> >Superadmin</option>
                	<option value="manager" <?php if($user->user_role == 'manager') echo 'selected';?> >Manager</option>
                	<option value="office member" <?php if($user->user_role == 'office member') echo 'selected';?> >Office member</option>
                	<option value="client" <?php if($user->user_role == 'client') echo 'selected';?> >Client</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Update User</button>
            <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>