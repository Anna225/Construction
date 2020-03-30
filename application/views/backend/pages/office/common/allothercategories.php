<div class="row">
                        <?php
                        $baseurl = base_url();
                        $segment2 = $this->uri->segment(2);
                        foreach ($listofficecategories as $category) {
                            
                           //print_r($category); 
                           $subcate = $this->moffice->getListSubcategories($category->id_categories);
                           $countreq = $this->moffice->countTotalReqOfQout($category->id_categories,$segment2);
                            
                           ?>

                            <div class="col-sm-6 col-lg-3">
                                <div class="card">
                                    <div class="card-header p-0 clearfix">
                                        <i class="<?php echo $category->icon_categories; ?> <?php echo $category->bg_colour_categoires; ?> p-2 px-4 font-2xl mr-3 float-left"></i>
                                        <a href="<?php echo $baseurl; ?>office/<?php echo $segment2; ?>/bymaincate/<?php echo $category->id_categories; ?>"><div class="<?php echo $category->textclass_categories; ?> text-uppercase p-2 font-weight-bold font-lg text-center"><?php echo $category->name_categories; ?></div></a>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                        foreach ($subcate as $subc) {
                                            
                                            $count = $this->moffice->countTotalRequestsOfReqCate($subc->id_subcategories,$segment2);
                                            
                                            echo "<a href='".$baseurl."office/".$segment2."/bysubcate/".$subc->id_subcategories."'><span class='float-left " . $category->textclass_categories . "'>" . $subc->name_subcategories . "</span><div class='" . $category->textclass_categories . " text-right font-weight-bold'>".$count[0]->total."</div></a>";
                                        }
                                        ?>
                                    </div>
                                    <div class="card-footer">
                                        <span class="float-left <?php echo $category->textclass_categories; ?> font-weight-bold">Total</span>
                                        <div class="<?php echo $category->textclass_categories; ?> text-right font-weight-bold"><?php echo $countreq[0]->alltotal; ?></div>

                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>