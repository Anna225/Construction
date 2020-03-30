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
                                        <button type="button" data-toggle="modal" data-target="#userModal3" class="btn btn-outline-primary btn-sm"><i class="fa fa-plus"></i> Add Data</button>
                                        <a href="packagesqty" target="_self" class="btn btn-outline-success  btn-sm"><i class="fa fa-reorder"></i> Quantity List</a>
                                        <a href="packagescosts" target="_self" class="btn btn-outline-success  btn-sm"><i class="fa fa-reorder"></i> Packages Costs</a>
                                        <a href="packages" target="_self" class="btn btn-outline-success  btn-sm"><i class="fa fa-reorder"></i> Packages </a>
                                   
                                    </div>

                                </div>
                            </div>
                            <hr>
                            <table class="table table-responsive-sm table-bordered table-striped table-sm">
                                <tbody>
                                <div class="row">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-3 text-center bg-danger text-white font-weight-bold">A+</div>
                                    <div class="col-lg-3 text-center bg-success text-white font-weight-bold">A</div>
                                    <div class="col-lg-3 text-center bg-primary text-white font-weight-bold">B</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-3">
                                        <div class="row package1">
                                            <div class="col-lg-12  text-muted font-weight-bold">Details</div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="row package2">
                                            <div class="col-lg-12  text-muted font-weight-bold">Details</div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="row package3">
                                            <div class="col-lg-12  text-muted font-weight-bold">Details</div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <?php
                                foreach ($listproductscate as $category) {

                                    $listproductssubcate = $this->mpackages->getListStagesSubCate($category->id);
                                    ?>
                                    <div class="row bg-greydark">
                                        <span class="text-white font-weight-bold producattitle text-uppercase"><?php echo $category->title; ?></span>
                                    </div> 

                                    <?php
                                    foreach ($listproductssubcate as $subcate) {
                                        
                                       
                                        ?> 
                                        <div class="row subcategory">


                                            <div class="col-lg-3">
                                                <i class="<?php echo $category->class; ?>"></i> <span class="text-muted textpadding font-weight-bold"><?php echo ucwords($subcate->title); ?></span>
                                            </div>
                                            
                                            <?php 
                                              
                                            foreach ($listpackages as $package) {
                                                   
                                                $packagesdata = $this->mpackages->getListPackagesData($subcate->id,$package->id);                                     
                                                
                                                ?>
                                            <div class="col-lg-3">
                                                <div class="row <?php echo $package->class; ?>">
                                                    <?php 
                                                    foreach ($packagesdata as $pkdata) 
                                                        {
                                                      $packagetitle = explode(' -',$pkdata->package_title);
                                                      
                                                        echo '<div class="col-lg-12  '.$package->text_class.' ">'.$packagetitle[0].'</div>';
                                                        
                                                      
                                                        }
                                                    ?>
                                                </div>
                                            </div> 
                                                <?php
                                                }
                                            
                                            ?>
                                            
                                            
                                            
                                        </div>



    <?php }
    ?>

                                <?php }
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



<div class="modal fade"  id="userModal3">
    <div class="modal-dialog">
        <form method="post" action="insertpackagedata">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title float-left"><i class="fa fa-folder-open"></i> Add Package Data</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <label class="col-md-10 col-form-label" for="text-input">Select Category</label>
                        <div class="col-md-10">
                            <div>
                                <select  onchange="updateStageSubCategory(options[selectedIndex].value)" class="form-control" name="" >
                                    <?php
                                    echo '<option value="0">Select Category</option>';
                                    $sql = "SELECT * FROM packages_stages_categories";
                                    $query = $this->db->query($sql)->result();
                                    foreach ($query as $record) {
                                        echo'<option value="' . $record->id . '">' . $record->title . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="col-md-10 col-form-label" for="focusedInput">Sub Category</label>
                        <div class="col-md-10">

                            <select id="prosubcategory" onchange="loadProductsOfSubStages(options[selectedIndex].value)" class="form-control" name="fk_stages_subcategories"></select>

                        </div>

                    </div>
                    
                    <label class="col-md-6 col-form-label" for="text-input">Select Package</label>
                    <div class="col-md-6">
                        <div>
                    <?php echo form_dropdown('fk_packages', $drpdwnpackages, '', 'data-rel="chosen" id="fk_packages" class="form-control"'); ?>
                        </div>
                    </div>
                    
                    <div>
                        <label class="col-md-10 col-form-label" for="focusedInput">Select Product</label>
                        <div class="col-md-10">

                            <select id="productitem"  class="form-control" name="fk_products_jn_substages"></select>

                        </div>

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


