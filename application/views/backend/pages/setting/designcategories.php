<div class="animated fadeIn"> 
    <?php
    // $this->load->view('backend/pages/setting/common/topmenu');
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2">
                    <?php
                    $this->load->view('backend/pages/setting/common/settingmenu');
                    ?>

                </div>
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">
                            <i class="icon-speedometer"></i>
                            <span><?php echo ucfirst($this->uri->segment(2)); ?></span>


                        </div>
                        <?php
                        $result = $this->session->flashdata('userdatasavestatus');
                        if (!empty($result)) {
                            echo '<div class="alert alert-success"><strong>' . $result . '</strong></div>';
                        }
                        ?>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12"> 
                                    <div class="float-right">
                                        <button type="button" data-toggle="modal" data-target="#addDesignMenuModal" class="btn btn-outline-primary  btn-sm "><i class="fa fa-plus"></i> Add Cate</button>
                                    </div>

                                </div>
                            </div>
                            <hr>
                            <table class="table table-striped table-bordered datatable" id="categoriestable">
                                <tbody>
                                <ul class="list-group">
                                    <?php
                                    $baseurl = base_url();
                                    foreach ($listDesignCategories as $category) {
                                        $id = $category->title;
                                        $url = "deletedesigncategories/$id";
                                        ?>
                                        <li class="list-group-item list-group-item-light"><span class="text-success text-uppercase"><?php echo $category->title; ?></span><div class="float-right"><a href="#"><i class="fas fa-angle-down text-danger"></i></a> <a href="#"><i class="fas fa-angle-up text-success"></i></a> | <a href="#" ><i class="far fa-edit text-primary"></i></a> | <a href="<?php echo $url; ?>"><i class="fas fa-trash-alt text-danger"></i></a></div>
                                            <?php
                                            if (!empty($category->subs)) {
                                                echo '<ul class="list-group list-group-flush">';
                                                foreach ($category->subs as $sub) {
                                                    $subid = $sub->mobilemenu_id;
                                                    $suburl = "deletedesignsubcategories/$subid";
                                                    echo '<li class="list-group-item"><span class="text-primary" style="text-transform: capitalize;"> - ' . $sub->title . '</span> <div class="float-right"><a href="#"><i class="fas fa-angle-down text-danger"></i></a> <a href="#"><i class="fas fa-angle-up text-success"></i></a> | <a href="#" ><i class="far fa-edit text-primary"></i></a> | <a href="' . $suburl . '"><i class="fas fa-trash-alt text-danger"></i></a></div></li>';
                                                }
                                                echo '</ul>';
                                            }
                                            ?>
                                        </li>

                                        <?php
                                    }
                                    ?>
                                </ul>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="addDesignMenuModal">
    <div class="modal-dialog">
        <form method="post" action="<?php echo base_url();?><?php echo $this->uri->segment(1); ?>/addmobilemenu">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title float-left"><i class="fa fa-folder-open"></i> Add Menu</h4>
                </div>
                <div class="modal-body">

                  <div class="form-group row">
                    <label class="col-md-4 col-form-label" >Category</label>
                    <div class="col-md-8">
                        <?php
                        echo form_dropdown('fk_category',$categorieslist,'','data-rel="chosen" id="fk_category" class="form-control" style="text-transform: capitalize;" onchange="updateDesignSubCategory(options[selectedIndex].value)"');
                        ?>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-4 col-form-label" >SubCategory</label>
                    <div class="col-md-8">
                       <div>
                        <select name="subcategory" id="subcategory" data-rel="chosen" class="form-control" onchange="updateSettingDesignUrl(options[selectedIndex].value)" style="text-transform: capitalize;">
                            <option value="0">Select SubCategory</option>
                        </select>
                        </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-4 col-form-label" >Url</label>
                    <div class="col-md-8">
                        <input type="text" id="design_url" name="design_url" class="form-control" readonly />
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-4 col-form-label" >Icon Class</label>
                    <div class="col-md-8">
                        <input type="text" name="icon" class="form-control" />
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-4 col-form-label">Status</label>
                    <div class="col-md-8">
                        <select name="status" class="custom-select">
                            <option selected value="1">Active</option>
                            <option  value="0">Not Active</option>
                        </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-4 col-form-label" >Order By</label>
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