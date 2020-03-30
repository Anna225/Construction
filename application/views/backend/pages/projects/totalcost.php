<div class="animated fadeIn">
    <?php
    // $this->load->view('backend/pages/setting/common/topmenu');
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="icon-speedometer"></i>
                            <span>Project Total Cost List</span>


                        </div>
                        <?php
                        $result = $this->session->flashdata('userdatasavestatus');
                        if (!empty($result)) {
                            echo '<div class="alert alert-success"><strong>' . $result . '</strong></div>';
                        }
                        ?>
                            <div class="card-body table-responsive">
                                <div class="row">
                                    <div class="col-md-5">                            
                                        <?php
                                        foreach ($categoryList as $category) {
                                            $listsubcate = $this->mprojects->getTotalCostSubCateList($category->project_id, $category->id);
                                            $category_amount = $this->mprojects->getTotalCostCateAmount($category->project_id, $category->id);
                                            ?>
                                            <div class="row bg-greydark">
                                                <div class="col-md-6">
                                                    <p class="text-white font-weight-bold producattitle text-uppercase"><?php echo $category->title; ?></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="text-white font-weight-bold producattitle"><?php echo $category_amount->category_amount; ?></p>
                                                </div>
                                            </div> 

                                            <?php
                                            foreach ($listsubcate as $subcate) {
                                                $subcate_amount = $this->mprojects->getTotalCostSubCateAmount($category->project_id, $category->id, $subcate->id);
                                               
                                                ?> 
                                                <div class="row subcategory">
                                                    <div class="col-md-6">
                                                        <i class="<?php echo $category->class; ?>"></i> <span class="text-muted textpadding font-weight-bold"><?php echo ucwords($subcate->title); ?></span>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <p class="text-muted font-weight-bold producattitle"><?php echo $subcate_amount->subcate_amount; ?></p>
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
        </div>
    </div>
</div>