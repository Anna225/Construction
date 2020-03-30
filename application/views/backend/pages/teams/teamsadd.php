<div class="col-md-6">
  <div class="card">
    <div class="card-header">
      <strong>Add Team</strong>
    </div>

    <div class="card-body">
      <form action="<?php echo base_url().'teams/insertteams'?>" method="post" enctype="multipart/form-data" class="form-horizontal">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-md-4 col-form-label" for="add_team_name">Team Name*</label>
              <div class="col-md-8">
                <input type="text" id="add_team_name" name="add_team_name" class="form-control" placeholder="Enter team name" autocomplete="off" required >
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label" for="fk_category">Category*</label>
              <div class="col-md-8">
                    <?php 
                    echo form_dropdown('fk_category', $categoryDrpdwnList, '', 'data-rel="chosen" id="fk_category" class="form-control" style="text-transform: capitalize;" onchange="updateSubCategoryInTeam()"'); ?>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label" for="fk_subcategory">SubCategory*</label>
              <div class="col-md-8">
                <select id="fk_subcategory" class="form-control" name="fk_subcategory" style="text-transform: capitalize;" >
                  <option value="0">Select SubCategories</option>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label" for="add_phone1">Phone1</label>
              <div class="col-md-8">
                <input type="text" id="add_phone1" name="add_phone1" class="form-control" placeholder="Enter phone1" autocomplete="off" required >
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label" for="add_phone2">Phone2</label>
              <div class="col-md-8">
                <input type="text" id="add_phone2" name="add_phone2" class="form-control" placeholder="Enter phone2" autocomplete="off" >
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label" for="add_date">Added Date*</label>
              <div class="col-md-8">
                <input type="text" id="add_date" name="add_date" class="form-control datepicker" value="<?=date("Y/m/d")?>" autocomplete="off" required >
              </div>
            </div>

          </div>
          <div class="col-md-12">
            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Add Team</button>
            <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>