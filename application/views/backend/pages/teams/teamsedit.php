<div class="col-md-6">
  <div class="card">
    <div class="card-header">
      <strong>Edit Team</strong>
    </div>

    <div class="card-body">
      <form action="<?php echo base_url().'teams/editteams/'.$teams->team_id?>" method="post" enctype="multipart/form-data" class="form-horizontal">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label class="col-md-4 col-form-label" for="edit_team_name">Team Name*</label>
              <div class="col-md-8">
                <input type="text" id="edit_team_name" name="edit_team_name" class="form-control" value="<?=$teams->team_name?>" autocomplete="off" required >
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label" for="fk_category">Category*</label>
              <div class="col-md-8">
                    <?php 
                    $selected_categoryid = $teams->fk_category;
                    if(isset($selected_categoryid)){
                      $selected_categoryid = $selected_categoryid;
                    }else{
                      $selected_categoryid = "";
                    }
                    echo form_dropdown('fk_category', $categoryDrpdwnList, $selected_categoryid, 'data-rel="chosen" id="fk_category" class="form-control" style="text-transform: capitalize;" onchange="updateSubCategoryInTeam()"'); ?>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label" for="fk_subcategory">SubCategory*</label>
              <div class="col-md-8">
                    <?php 
                    $selected_subcategoryid = $teams->fk_subcategory;
                    if(isset($selected_subcategoryid)){
                      $selected_subcategoryid = $selected_subcategoryid;
                    }else{
                      $selected_subcategoryid = "";
                    }
                    echo form_dropdown('fk_subcategory', $subcategoryDrpdwnList, $selected_subcategoryid, 'data-rel="chosen" id="fk_subcategory" class="form-control" style="text-transform: capitalize;"'); ?>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label" for="edit_phone1">Phone1</label>
              <div class="col-md-8">
                <input type="text" id="edit_phone1" name="edit_phone1" class="form-control" value="<?=$teams->phone1?>" autocomplete="off" required >
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label" for="edit_phone2">Phone2</label>
              <div class="col-md-8">
                <input type="text" id="edit_phone2" name="edit_phone2" class="form-control" value="<?=$teams->phone2?>" autocomplete="off" >
              </div>
            </div>

            <div class="form-group row">
              <label class="col-md-4 col-form-label" for="edit_date">Added Date*</label>
              <div class="col-md-8">
                <input type="text" id="edit_date" name="edit_date" class="form-control datepicker" value="<?=$teams->added_date?>" autocomplete="off" required >
              </div>
            </div>

          </div>
          <div class="col-md-12">
            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Update Team</button>
            <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>