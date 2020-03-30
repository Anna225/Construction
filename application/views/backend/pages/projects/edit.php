<div class="col-md-7">
  <div class="card">
    <div class="card-header">
      <strong>Edit Projects</strong>
    </div>

    <div class="card-body">
      <form action="<?php echo base_url().'projects/updateProjects/'.$projects->id_project?>" method="post" enctype="multipart/form-data" class="form-horizontal">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-md-4 col-form-label" for="pj_nameEdit">Name*</label>
              <div class="col-md-8">
                <input type="text" id="pj_nameEdit" name="pj_nameEdit" class="form-control" value="<?=$projects->name_project?>" required >
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label" for="pj_addressEdit">Address*</label>
              <div class="col-md-8">
                <input type="text" id="pj_addressEdit" name="pj_addressEdit" class="form-control" value="<?=$projects->address_project?>" required >
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label" for="pj_clientEdit">Join Client</label>
              <div class="col-md-8">
                <?php 
                  echo form_dropdown('pj_clientEdit', $clientDrpdwnList, $projects->joined_client, 'data-rel="chosen" id="pj_clientEdit" class="form-control" style="text-transform: capitalize;"'); 
                ?>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label" for="pj_amount_clientEdit">Amount Project</label>
              <div class="col-md-8">
                <input type="text" id="pj_amount_clientEdit" name="pj_amount_clientEdit" class="form-control" placeholder="Enter amount" value="<?=$projects->amount_project?>" >
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label" for="pj_startdateEdit">Start Date*</label>
              <div class="col-md-8">
                <input type="text" id="pj_startdateEdit" name="pj_startdateEdit" class="form-control datepicker" value="<?=$projects->start_date?>" value="<?=date("Y/m/d")?>" required >
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label" for="pj_enddateEdit">End Date*</label>
              <div class="col-md-8">
                <input type="text" id="pj_enddateEdit" name="pj_enddateEdit" class="form-control datepicker" value="<?=$projects->end_date?>" required >
              </div>
            </div>
            
            <div class="form-group row">
              <label class="col-md-4 col-form-label" for="fk_status">Status</label>
              <div class="col-md-8">
                  <select id="fk_status" name="fk_status" class="form-control">
                    <option value="0" <?php if($projects->fk_status == 0) echo "selected";?>>Pending</option>
                    <option value="1" <?php if($projects->fk_status == 1) echo "selected";?>>Under Construction</option>
                    <option value="2" <?php if($projects->fk_status == 2) echo "selected";?>>Completed</option>
                  </select>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label" for="pj_imageEdit">Image*</label>
              <div class="col-md-8">
                <input type="file" id="pj_imageEdit" name="pj_imageEdit" class="form-control" onchange="preViewImage(this, 'preview_projectEdit')" >
              </div>
            </div>
          </div>
          <div class="col-md-6" align="center" style="margin-bottom:15px;">
            <img src="<?=base_url().$projects->images_project?>" " id="preview_projectEdit" style="width: 100%;" />
          </div>
          <div class="col-md-12">
            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Update Project</button>
            <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>