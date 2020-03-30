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
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <i class="icon-speedometer"></i>
                            <span><?php echo ucfirst($this->uri->segment(2)); ?></span>
                        </div>


                        <hr class="m-0">
                        <?php
                        $result = $this->session->flashdata('userdatasavestatus');
                        if (!empty($result)) {
                            echo '<div class="alert alert-success"><strong>' . $result . '</strong></div>';
                        }
                        ?>
                        <hr class="m-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="float-right">
                                        <button type="button" data-toggle="modal" data-target="#userModal" class="btn btn-outline-primary  btn-sm "><i class="fa fa-plus"></i> Add Product</button>
                                        <button type="button" data-toggle="modal" data-target="#joinModal" class="btn btn-outline-primary btn-sm"><i class="fa fa-plus"></i> Join Stages</button>
                                        <a href="products" target="_self" class="btn btn-outline-success  btn-sm"><i class="fa fa-reorder"></i> Products List</a>
                                        <a href="companiesjoinlist" target="_self" class="btn btn-outline-success  btn-sm"><i class="fa fa-reorder"></i> Join List</a>
                                         </div>

                                </div>
                            </div>
                            <hr>
                            <table class="table table-striped table-bordered datatable" id="clienttable">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Stage</th>
                                        <th>Company</th>
                                        <th>Package</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($listpackagesproducts['records'] as $rows) {
                                       
                                       $typepd = $rows['typeproduct'];
                                       
                                       if($typepd == 0){
                                           $typeproduct = "";
                                       }
                                       elseif($typepd == 1){
                                           $typeproduct = " mm";
                                       }
                                       elseif($typepd == 2){
                                           $typeproduct = " m";
                                       }
                                       elseif($typepd == 3){
                                           $typeproduct = " sqft";
                                       }
                                       elseif($typepd == 4){
                                           $typeproduct = " qty";
                                       }
                                       elseif($typepd == 5){
                                           $typeproduct = " ft";
                                       }
                                       else{
                                          $typeproduct = ""; 
                                       }
                                       
                                       $pkg = $rows['packagename'];
                                        
                                       if($pkg == "A+")
                                       {
                                           $bgclass = "text-danger font-weight-bold";
                                       }
                                       elseif($pkg == "A"){
                                           $bgclass = "text-success font-weight-bold";
                                       }
                                       elseif($pkg == "B"){
                                            $bgclass = "text-primary font-weight-bold"; 
                                       }
                                        echo "<tr class='$bgclass'>
                                            <td>" . $rows['productname'] . "  " . $typeproduct . "</td>
                                            <td><i class='" . $rows['stageclass'] . "'> </i> " . ucwords($rows['substagename']) . "<div>" . ucwords($rows['stagename']) . "</div></td>
                                            <td>" . ucwords($rows['companyname']) . "<div> " . $rows['countryname'] . " </div></td>
                                            <td>" . $rows['packagename'] . " <div> " . $rows['productprice'] . " Rs </div></td>
                                            <td>" . $rows['action'] . "</td>
                                            </tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">

                        <div class="card-body ">

                            <?php
                            foreach ($listproductscate as $category) {

                                $listproductssubcate = $this->mpackages->getListStagesSubCate($category->id);
                                ?>
                                <div class="row bg-greydark">
                                    <span class="text-white font-weight-bold producattitle text-uppercase"><?php echo $category->title; ?></span>
                                </div>

                                <?php
                                foreach ($listproductssubcate as $subcate) {
                                    
                                    $countprodcusts = $this->mpackages->countProdOfSubStages($subcate->id);
                                    
                                    $finalcounter = $countprodcusts[0]->totproducts;
                                    
                                    if($finalcounter != NULL && $finalcounter != 0){
                                        
                                        $showcounter = '<span class="counter">' . $finalcounter . '</span>'; 
                                    }
                                    elseif($finalcounter == 0){
                                        $showcounter = "";
                                    }
                                    else{
                                       $showcounter = ""; 
                                    }
                                    
                                    
                                    ?>
                                    <div class="row subcategory">


                                        <div class="col-lg-12">
                                            <i class="<?php echo $category->class; ?>"></i> <span class="text-muted textpadding font-weight-bold"><?php echo ucwords($subcate->title); ?> <span class="float-right"><?php echo $showcounter; ?></span>
                                        </div>
                                    </div>

                                <?php
                                }
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="userModal">
    <div class="modal-dialog modal-lg">
        <form method="post" action="insertpkgproducts">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title float-left"><i class="fa fa-folder-open"></i> Add Clients</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-8">

                            <div>
                                <label class="col-md-8 col-form-label">Product Name</label>
                                <div class="col-md-8">
                                    <input type="text" name="title" id="name_clients" class="form-control" />
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
                                <label class="col-md-6 col-form-label" for="text-input">Select Category</label>
                                <div class="col-md-6">
                                    <div>
                                        <select  onchange="updateSubCategory(options[selectedIndex].value)" class="form-control" name="fk_companies" >
                                            <?php
                                            echo '<option value="0">Select Company</option>';
                                            $sql = "SELECT * FROM packages_companies";
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
                    </div>
                </div>
                <br>
                <div class="modal-footer">
                    <input type="submit" name="action" value="Add" class="btn btn-success"/>
                    <input type="hidden" name="action" class="btn btn-success" value="Add" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="joinModal">
    <div class="modal-dialog modal-lg">
        <form method="post" action="insertjoinproductsubstages">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title float-left"><i class="fa fa-folder-open"></i> Join Stages</h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6"><div>
                                    <div>
                                        <label class="col-md-10 col-form-label" for="text-input">Select Stage</label>
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
                                        <label class="col-md-10 col-form-label" for="focusedInput">Sub Stage</label>
                                        <div class="col-md-8">

                                            <select id="prosubcategory" onchange="updateTeams(options[selectedIndex].value)" class="form-control" name="fk_stages_subcategories"></select>

                                        </div>

                                    </div>

                                    <div>
                                        <label class="col-md-10 col-form-label" for="text-input">Select Company</label>
                                        <div class="col-md-10">
                                            <div>
                                                <select  onchange="updatePackagesProducts(options[selectedIndex].value)" class="form-control" name="" >
                                                    <?php
                                                    echo '<option value="0">Select Company</option>';
                                                    $sql = "SELECT * FROM packages_companies";
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
                                        <label class="col-md-10 col-form-label" for="focusedInput">Select Product</label>
                                        <div class="col-md-8">

                                            <select id="packagesproducts" onchange="updateTeams(options[selectedIndex].value)" class="form-control" name="fk_packages_products"></select>

                                        </div>

                                    </div>

                                    <label class="col-md-6 col-form-label" for="text-input">Select Package</label>
                                    <div class="col-md-6">
                                        <div>
                                            <?php echo form_dropdown('fk_packages', $drpdwnpackages, '', 'data-rel="chosen" id="fk_packages" class="form-control"'); ?>
                                        </div>
                                    </div>

                                    <br>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="col-md-8 col-form-label" >Rate</label>
                                <div class="col-md-4">
                                    <input type="text" name="rate" class="form-control" />
                                </div>
                                <label class="col-md-8 col-form-label" >Rate Given By</label>
                                <div class="col-md-6">
                                    <input type="text" name="vendor" class="form-control" />
                                </div>
                                
                                <label class="col-md-8 col-form-label" >Qty (If Diffrent)</label>
                                <div class="col-md-6">
                                    <input type="text" name="qty" class="form-control" />
                                </div>
                                
                                <label class="col-md-6 col-form-label">Status</label>
                                <div class="col-md-6">
                                    <select name="status" class="custom-select">
                                        <option selected value="1">Active</option>
                                        <option  value="0">Not Active</option>
                                    </select>
                                </div>

                                <label class="col-md-8 col-form-label" >Order By</label>
                                <div class="col-md-4">
                                    <input type="text" name="orderby" class="form-control" />
                                </div>
                                <div>
                                <label class="col-md-8 col-form-label">Package Title</label>
                                <div class="col-md-8">
                                    <input type="text" name="package_title" id="phone_clients" class="form-control" />
                                </div>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>





                    <div class="modal-footer">
                        <input type="submit" name="action" value="Add" class="btn btn-success"/>
                        <input type="hidden" name="action" class="btn btn-success" value="Add" />
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>