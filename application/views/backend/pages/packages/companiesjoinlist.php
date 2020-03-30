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
                                        <button type="button" data-toggle="modal" data-target="#userModal" class="btn btn-outline-primary  btn-sm "><i class="fa fa-plus"></i> Add Company</button>
                                        <button type="button" data-toggle="modal" data-target="#joinModal" class="btn btn-outline-primary btn-sm"><i class="fa fa-plus"></i> Join Stages</button>
                                        <a href="companies" target="_self" class="btn btn-outline-success  btn-sm"><i class="fa fa-reorder"></i> Companies List</a>
                                    <a href="companiesjoinlist" target="_self" class="btn btn-outline-success  btn-sm"><i class="fa fa-reorder"></i> Join List</a>
                                    
                                    </div>

                                </div>
                            </div>
                            <hr>
                            <table class="table table-responsive-sm table-bordered table-striped table-sm">
                                <tbody>
                                
                                <?php
                                foreach ($listproductscate as $category) {

                                    $listjoincompany = $this->mpackages->getJoinCompaniesList($category->id);
                                    ?>
                                    <div class="row bg-greydark">
                                        <span class="text-white font-weight-bold producattitle text-uppercase"><?php echo $category->title; ?></span>
                                    </div> 

                                    <?php
                                    foreach ($listjoincompany as $company) 
                                        {
                                        ?> 
                                        <div class="row subcategory">


                                            <div class="col-lg-3">
                                                <i class="<?php echo $category->class; ?>"></i> <span class="text-muted textpadding font-weight-bold"><?php echo ucwords($company->companytitle); ?> - <?php echo ucwords($company->countryname); ?></span>
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

        <form method="post" action="insertcompany">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title float-left"><i class="fa fa-folder-open"></i> Add Company</h4>
                </div>
                <div class="modal-body">
                    
                    
                    
                    <label class="col-md-8 col-form-label">Name</label>
                    <div class="col-md-8">
                        <input type="text" name="title" id="name_categories" class="form-control" />
                    </div>
                    <label class="col-md-6 col-form-label" for="text-input">Select Country</label>
                      <div class="col-md-6">
                           <div>
                              <?php echo form_dropdown('fk_countries',$drpdwncountries,'','data-rel="chosen" id="fk_cateoffice" class="form-control"');?>
                            </div>
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

<div class="modal fade" id="joinModal">
    <div class="modal-dialog">
        <form method="post" action="insertjoinstgcomp">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title float-left"><i class="fa fa-folder-open"></i> Join Stages</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <label class="col-md-6 col-form-label" for="text-input">Select Stage</label>
                        <div class="col-md-6">
                            <div>
                                <select  onchange="updateSubCategory(options[selectedIndex].value)" class="form-control" name="fk_stages_categories" >
                                    <?php
                                    echo '<option value="0">Select</option>';
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
                        <label class="col-md-6 col-form-label" for="text-input">Select Company</label>
                        <div class="col-md-6">
                            <div>
                                <select  onchange="updateSubCategory(options[selectedIndex].value)" class="form-control" name="fk_companies" >
                                    <?php
                                    echo '<option value="0">Select</option>';
                                    $sql2 = "SELECT * FROM packages_companies";
                                    $query2 = $this->db->query($sql2)->result();
                                    foreach ($query2 as $record2) {
                                        echo'<option value="' . $record2->id . '">' . $record2->title . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
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

