<div class="col-md-7">
  <div class="card">
    <div class="card-header">
      <strong>Add Projects</strong>
    </div>

    <div class="card-body">
      <form action="<?php echo base_url().'projects/insertcreatedprojects'?>" method="post" enctype="multipart/form-data" class="form-horizontal">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-md-4 col-form-label" for="pj_name">Name*</label>
              <div class="col-md-8">
                <input type="text" id="pj_name" name="pj_name" class="form-control" placeholder="Enter name" required >
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label" for="pj_address">Address*</label>
              <div class="col-md-8">
                <input type="text" id="pj_address" name="pj_address" class="form-control" placeholder="Enter address" required >
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label" for="pj_client">Join Client</label>
              <div class="col-md-8">
                <?php echo form_dropdown('pj_client', $clientDrpdwnList, '', 'data-rel="chosen" id="pj_client" class="form-control" style="text-transform: capitalize;"'); ?>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label" for="pj_amount_client">Amount Project</label>
              <div class="col-md-8">
                <input type="text" id="pj_amount_client" name="pj_amount_client" class="form-control" placeholder="Enter amount" >
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label" for="pj_startdate">Start Date*</label>
              <div class="col-md-8">
                <input type="text" id="pj_startdate" name="pj_startdate" class="form-control datepicker" placeholder="Enter start date" value="<?=date("Y/m/d")?>" required >
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label" for="pj_enddate">End Date*</label>
              <div class="col-md-8">
                <input type="text" id="pj_enddate" name="pj_enddate" class="form-control datepicker" placeholder="Enter end date" required >
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label" for="fk_status">Status</label>
              <div class="col-md-8">
                  <select id="fk_status" name="fk_status" class="form-control">
                    <option value="0">Pending</option>
                    <option value="1">Under Construction</option>
                    <option value="2">Completed</option>
                  </select>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label" for="pj_image">Image*</label>
              <div class="col-md-8">
                <input type="file" id="pj_image" name="pj_image" class="form-control" onchange="preViewImage(this, 'preview_project')" required >
              </div>
            </div>
          </div>
          <div class="col-md-6" align="center" style="margin-bottom:15px;">
            <img id="preview_project" style="width: 100%;" />
          </div>
          <div class="col-md-12">
            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Create Project</button>
            <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>