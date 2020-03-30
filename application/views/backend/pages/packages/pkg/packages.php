

<div class="row">
    <div class="col-md-12">
        <div class="card">

hhhhhhh
            <div class="card-body">

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

                                    $packagesdata = $this->mpackages->getListPackagesData($subcate->id, $package->id);
                                    ?>
                                    <div class="col-lg-3">
                                        <div class="row <?php echo $package->class; ?>">
                                            <?php
                                            foreach ($packagesdata as $pkdata) {
                                                $packagetitle = explode(' -', $pkdata->package_title);

                                                echo '<div class="col-lg-12  ' . $package->text_class . ' ">' . $packagetitle[0] . '</div>';
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