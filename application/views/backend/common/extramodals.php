
<!-- Extra Modal For Add Setting Menus -->
<div class="modal fade" id="addSettingMenuModal">
    <div class="modal-dialog">
        <form method="post" action="<?php echo base_url();?><?php echo $this->uri->segment(1); ?>/addmobilemenu">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title float-left"><i class="fa fa-folder-open"></i> Add Menu</h4>
                </div>
                <div class="modal-body">
                    <div>
                        
                    <input type="hidden" name="maincate" class="form-control" value="<?php echo $this->uri->segment(1); ?>" />    
                    <input type="hidden" name="segment2" class="form-control" value="<?php echo $this->uri->segment(2); ?>" />  
                    
                    <label class="col-md-8 col-form-label" >Name Category</label>
                    <div class="col-md-8">
                        <input type="text" name="name" class="form-control" />
                    </div>
                    <label class="col-md-8 col-form-label" >Url</label>
                    <div class="col-md-8">
                        <input type="text" name="url" class="form-control" />
                    </div>
                    <label class="col-md-8 col-form-label" >Icon Class</label>
                    <div class="col-md-8">
                        <input type="text" name="icon" class="form-control" />
                    </div>
                    <label class="col-md-6 col-form-label">Status</label>
                    <div class="col-md-6">
                        <select name="status" class="custom-select">
                            <option selected value="1">Active</option>
                            <option  value="0">Not Active</option>
                        </select>
                    </div>
                    <label class="col-md-8 col-form-label" >Order By</label>
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