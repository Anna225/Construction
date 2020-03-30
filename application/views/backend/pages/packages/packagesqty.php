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
                                        <button type="button" data-toggle="modal" data-target="#userModal3" class="btn btn-outline-primary btn-sm"><i class="fa fa-plus"></i> Add Quantity</button>
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
                                    <div class="col-lg-3 text-center bg-danger text-white font-weight-bold">5 Marla</div>
                                    <div class="col-lg-3 text-center bg-success text-white font-weight-bold">10 Marla</div>
                                    <div class="col-lg-3 text-center bg-primary text-white font-weight-bold">20 Marla</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-3">
                                        <div class="row package1">
                                            <div class="col-lg-8  text-muted font-weight-bold">Quantity</div>
                                            <div class="col-lg-4  text-muted font-weight-bold">Unit</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="row package2">
                                            <div class="col-lg-8  text-muted font-weight-bold">Quantity</div>
                                            <div class="col-lg-4  text-muted font-weight-bold">Unit</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="row package3">
                                            <div class="col-lg-8  text-muted font-weight-bold">Quantity</div>
                                            <div class="col-lg-4  text-muted font-weight-bold">Unit</div>
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
                                                foreach ($listhouses as $houses) {

                                                $packagesquantities = $this->mpackages->getListPackagesQty($subcate->id, $houses->id);
                                                
                                                
                                                ?>
                                                <div class="col-lg-3">
                                                    <div class="row <?php echo $houses->class; ?>">
                                                <?php
                                                foreach ($packagesquantities as $qty) {

                                                                $typepd = $qty->type;

                                                                if ($typepd == 0) {
                                                                    $typeproduct = "";
                                                                } elseif ($typepd == 1) {
                                                                    $typeproduct = " mm";
                                                                } elseif ($typepd == 2) {
                                                                    $typeproduct = " m";
                                                                } elseif ($typepd == 3) {
                                                                    $typeproduct = " sqft";
                                                                } elseif ($typepd == 4) {
                                                                    $typeproduct = " qty";
                                                                } elseif ($typepd == 5) {
                                                                    $typeproduct = " ft";
                                                                } else {
                                                                    $typeproduct = "";
                                                                }

                                                                echo '<div class="col-lg-8  ' . $houses->text_class . ' ">' . $qty->qty . '</div>
                                                         <div class="col-lg-4  ' . $houses->text_class . ' ">' . $typeproduct . '</div>';
                                                            }
                                                            ?>
                                                    </div>
                                                </div> 
                                                        <?php
                                                    }
                                                    ?>



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



<div class="modal fade"  id="userModal3">
    <div class="modal-dialog">
        <form method="post" action="insertpackagesqty">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title float-left"><i class="fa fa-folder-open"></i> Add Package Qty</h4>
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

                            <select id="prosubcategory" onchange="updateTeams(options[selectedIndex].value)" class="form-control" name="fk_stages_subcategories"></select>

                        </div>

                    </div>
                    <div>
                        <label class="col-md-6 col-form-label" for="text-input">Select Package</label>
                    <div class="col-md-6">
                        <div>
                    <?php echo form_dropdown('fk_packages', $drpdwnpackages, '', 'data-rel="chosen" id="fk_packages" class="form-control"'); ?>
                        </div>
                    </div>
                    </div>
                    <div>
                        <label class="col-md-6 col-form-label" for="text-input">Select Houses</label>
                        <div class="col-md-6">
                            <div>
<?php echo form_dropdown('fk_packages_houses', $drpdwnhouses, '', 'data-rel="chosen" id="fk_packages_houses" class="form-control"'); ?>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="col-md-8 col-form-label">Quantity</label>
                        <div class="col-md-8">
                            <input type="text" name="qty" id="name_clients" class="form-control" />
                        </div>
                    </div>
                    <div>
                        <label class="col-md-8 col-form-label">Type</label>
                        <div class="col-md-8">
                            <label class="radio-inline" for="inline-radio0">
                                <input type="radio" id="inline-radio3" name="type" value="0"> Na
                            </label>
                            <label class="radio-inline" for="inline-radio1">
                                <input type="radio" id="inline-radio1" name="type" value="1"> MM
                            </label>
                            <label class="radio-inline" for="inline-radio2">
                                <input type="radio" id="inline-radio2" name="type" value="2"> Meter
                            </label>
                            <label class="radio-inline" for="inline-radio3">
                                <input type="radio" id="inline-radio3" name="type" value="3"> Sqft
                            </label>
                            <label class="radio-inline" for="inline-radio4">
                                <input type="radio" id="inline-radio3" name="type" value="4"> Ft
                            </label>
                            <label class="radio-inline" for="inline-radio5">
                                <input type="radio" id="inline-radio3" name="type" value="5"> Qty
                            </label>

                        </div>
                    </div>
                 <div>
                                <label class="col-md-3 col-form-label" for="select">Status</label>
                                <div class="col-md-4">
                                    <select id="select" name="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Not Active</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label class="col-md-8 col-form-label">Order By</label>
                                <div class="col-md-8">
                                    <input type="text" name="orderby" id="phone_clients" class="form-control" />
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


