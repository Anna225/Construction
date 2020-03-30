<div class="animated fadeIn">
    <?php
    // $this->load->view('backend/pages/setting/common/topmenu');
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
<div class="col-md-2">
                    <?php
                    $this->load->view('backend/pages/packages/common/settingmenu');
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
                                        <button type="button" data-toggle="modal" data-target="#userModal" class="btn btn-outline-primary  btn-sm "><i class="fa fa-plus"></i> Add Cate</button>
                                        <button type="button" data-toggle="modal" data-target="#userModal2" class="btn btn-outline-success btn-sm"><i class="fa fa-plus"></i> Add Sub</button>
                                        
                                    </div>

                                </div>
                            </div>
                            <hr>
                            <table class="table table-responsive-sm table-bordered table-striped table-sm">
                                <tbody>
                                
                                <?php
                                foreach ($listproductscate as $category) {

                                    $listproductssubcate = $this->mpackages->getListStagesSubCate($category->id);
                                    ?>
                                    <div class="row bg-greydark">
                                        <span class="text-white font-weight-bold producattitle text-uppercase"><?php echo $category->title; ?></span>
                                    </div> 

                                    <?php
                                    foreach ($listproductssubcate as $subcate) 
                                        {
                                        ?> 
                                        <div class="row subcategory">


                                            <div class="col-lg-3">
                                                <i class="<?php echo $category->class; ?>"></i> <span class="text-muted textpadding font-weight-bold"><?php echo ucwords($subcate->title); ?></span>
                                            </div>
                                         </div>

                                <?php }
                                
                                        }
                                ?>
                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>



<div class="modal fade" id="userModal">
    <div class="modal-dialog">

        <form method="post" action="insertstagecate">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title float-left"><i class="fa fa-folder-open"></i> Add Category</h4>
                </div>
                <div class="modal-body">
                    <label class="col-md-8 col-form-label">Category Name</label>
                    <div class="col-md-8">
                        <input type="text" name="title" id="name_categories" class="form-control" />
                    </div>

                    <label class="col-md-8 col-form-label">Type</label>
                    <div class="col-md-8">
                        <label class="radio-inline" for="inline-radio1">
                            <input type="radio" id="inline-radio1" name="fk_catetype" value="1"> Grey
                        </label>
                        <label class="radio-inline" for="inline-radio2">
                            <input type="radio" id="inline-radio2" name="fk_catetype" value="2"> Finishing
                        </label>
                        <label class="radio-inline" for="inline-radio3">
                            <input type="radio" id="inline-radio3" name="fk_catetype" value="3"> Grey & Finishing
                        </label>
                    </div>
                    <div>
                        <label class="col-md-8 col-form-label" for="select">Status</label>
                        <div class="col-md-4">
                            <select id="select" name="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Not Active</option>
                            </select>
                        </div>
                    </div>

                    <label class="col-md-8 col-form-label">Image Url</label>
                    <div class="col-md-8">
                        <input type="text" name="icon_image" class="form-control" />
                    </div>

                    <label class="col-md-4 col-form-label">Order By</label>
                    <div class="col-md-4">
                        <input type="text" name="orderby" id="orderby_categories" class="form-control" />
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


<div class="modal fade"  id="userModal2">
    <div class="modal-dialog">
        <form method="post" action="insertstagessubcate">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title float-left"><i class="fa fa-folder-open"></i> Add Sub Category</h4>
                </div>
                <div class="modal-body">
                    <label class="col-md-6 col-form-label" for="text-input">Select Category</label>
                    <div class="col-md-6">
                        <div>
                <?php echo form_dropdown('fk_stages_categories', $drpdwnofficecategories, '', 'data-rel="chosen" id="fk_stages_categories" class="form-control"'); ?>
                        </div>
                    </div>
                    <label class="col-md-8 col-form-label">Sub Category Name</label>
                    <div class="col-md-8">
                        <input type="text" name="title" id="name_subcategories" class="form-control" />
                    </div>
                    <label class="col-md-8 col-form-label" >Status</label>
                    <div class="col-md-8">
                        <input type="text" name="status" id="status_subcategories" class="form-control" />
                    </div>
                    <label class="col-md-4 col-form-label">Order By</label>
                    <div class="col-md-4">
                        <input type="text" name="orderby" id="orderby_subcategories" class="form-control" />
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




