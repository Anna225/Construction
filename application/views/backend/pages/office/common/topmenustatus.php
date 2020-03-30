                            <div class="container">
                                <?php
                                    $baseurl2 = base_url(); 
                                    $seg1 = $this->uri->segment(1);
                                    $seg2 = $this->uri->segment(2);
                                    $seg3 = $this->uri->segment(3);
                                    $seg4 = $this->uri->segment(4);
                                    
                                    if($seg3 == 'bymaincate' || $seg3 == 'bysubcate' )
                                    {
                                    $byurl = "$baseurl2$seg1/$seg2/$seg3/$seg4";
                                    $urlst = "$byurl/bystatus";
                                    }
                                    
                                    else{
                                    $byurl = "$baseurl2$seg1/$seg2";
                                    $urlst = "$byurl/bystatus";   
                                    }
                                   foreach ($liststatuscategories as $stcate) {
                                        $idst = $stcate->id_categories;
                                        $byrequrl = "$seg1/$seg2";
                                        
                                        if($seg2 == 'requests')
                                        {
                                            $count = $this->moffice->countTotalRequestsByStatus($idst);
                                        }
                                        else{
                                            $count = $this->moffice->countTotalRequestsByStatusAndCate($idst,$byrequrl);
                                        }
                                        ?>
                                    
                                        <a href="<?php echo $urlst; ?>/<?php echo $idst; ?>">
                                        <button type="button" class="badge badge-pill badge-<?php echo $stcate->bg_colour; ?>"><i class="<?php echo $stcate->class_categories; ?>"></i> <?php echo $stcate->name_categories; ?> <span class="counter float-right"> <?php echo $count[0]->countreq; ?></span> </button>
                                        </a>
                                        <?php
                                    }
                                    ?>
                              </div> 