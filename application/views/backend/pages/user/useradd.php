<div class="col-md-6">
  <div class="card">
    <div class="card-header">
      <strong>Add User</strong>
    </div>

    <div class="card-body">
      <form action="<?php echo base_url().'user/insertuser'?>" method="post" enctype="multipart/form-data" class="form-horizontal">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-md-4 col-form-label" for="add_name">Name*</label>
              <div class="col-md-8">
                <input type="text" id="add_name" name="add_name" class="form-control" placeholder="Enter name" autocomplete="off" required >
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label" for="add_email">Email*</label>
              <div class="col-md-8">
                <input type="email" id="add_email" name="add_email" class="form-control" placeholder="Enter email"  autocomplete="off" required >
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label" for="add_password">Password*</label>
              <div class="col-md-8">
                <input type="text" id="add_password" name="add_password" class="form-control" placeholder="Enter password" autocomplete="off" required >
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label" for="add_role">User Role*</label>
              <div class="col-md-8">
                <select class="form-control" id="add_role" name="add_role" required >
                	<option value="0">Select User Role</option>
                	<option value="superadmin">Superadmin</option>
                	<option value="manager">Manager</option>
                	<option value="office member">Office member</option>
                	<option value="client">Client</option>
                </select>
              </div>
            </div>

          </div>
          <div class="col-md-12">
            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Add User</button>
            <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>