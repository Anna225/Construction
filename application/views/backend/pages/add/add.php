<div class="animated fadeIn">
    <div class="col-lg-12">
        <div class="row">
          <div class="col-lg-12 text-center text-uppercase">
                <?php
                $alert = "";
                $result = $this->session->flashdata('message');
                $comments = $this->session->flashdata('comments');
                if ($result == 2) 
                {
                    $alert = '<div class="alert alert-danger"><strong>Failed!</strong> ' . $comments . '</div>';
                } elseif ($result == 1) 
                {
                    $alert = '<div class="alert alert-success"><strong>Success!</strong> ' . $comments . '</div>';
                } else 
                    {
                    $alert = "";
                }
                echo $alert;
                ?>

            </div>  
        </div>
        <div class="row">
            <div class="col-lg-7">
             <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Add <?php echo $tablename ?></strong>
                                    </div>
                                    
                                    <div class="card-body">
                                        <form action="<?php echo base_url() . 'insert' ?>/<?php echo $tablename ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                                            <?php
                                            foreach ($tablecolumns['records'] as $rows) 
                                                {
                                                $name = $rows['columnname'];
                                                
                                                // convereted comments to array
                                                $getcomments = $rows['cmt'];
                                                $commentsarray =  (explode("|",$getcomments));
                                                
                                                
                                                //Get Label name column before _
                                                $getlabelname = strstr($name, '_', true);
                                                
                                                // Get status label names
                                                if($getlabelname != "status")
                                                {
                                                    $lablenameuppercase = ucfirst($getlabelname);
                                                }
                                                else
                                                {
                                                   // converted status value in array for status label names
                                                   $statusarray =  (explode("_",$name));
                                                   $status = ucfirst($statusarray[0]);
                                                   $statusof = ucfirst($statusarray[1]);
                                                   $lablenameuppercase  = "$status $statusof";
                                                }
                                                
                                                
                                                //extra not used
                                                // Check first three letters if its an fks
                                                //$resultfk1 = substr($getfk1, 0, 3);
                                                
                                                
                                                // AddView in comment is == 1 so show data 
                                                if($commentsarray[0] == 1)
                                                {
                                                    // Type 1
                                                     if(($commentsarray[2] == 1))
                                                     {
                                                       echo '<div class="form-group row">
                                                                <label class="col-lg-2 col-form-label" for="text-input">' . $lablenameuppercase . '</label>
                                                                <div class="col-lg-6">
                                                                    <input type="text" id="text-input" name="'.$name.'" class="form-control" placeholder="' . $lablenameuppercase . '" >
                                                                </div>
                                                            </div>';  
                                                     } 
                                                     // Type 2
                                                     elseif(($commentsarray[2] == 2))
                                                     {
                                                        // Get table name of fk after _ 
                                                        $fklabeldrpdown = substr($name, strpos($name, "_") + 1);
                                                        
                                                        // Get fk drpdwn label name with first letter uppercase
                                                        $fklabelname = ucfirst($fklabeldrpdown);
                                                        
                                                        $fkdrpdwn = $this->madd->getFkDrpDwn($fklabeldrpdown);
                                                        $drpdwn = form_dropdown("$name", $fkdrpdwn, '', 'data-rel="chosen" id="select" class="form-control"');

                                                            echo '<div class="form-group row">
                                                            <label class="col-lg-2 col-form-label" for="text-input">' . $fklabelname . '</label>
                                                            <div class="col-lg-4">
                                                                <div>
                                                                ' . $drpdwn . ' 
                                                                </div>
                                                            </div>
                                                            </div>';  
                                                     } 
                                                     // Type 3
                                                     elseif(($commentsarray[2] == 3))
                                                     {
                                                       echo '<div class="form-group row">
                                                                <label class="col-lg-2 col-form-label" for="text-input">' . $lablenameuppercase . '</label>
                                                                <div class="col-lg-8">
                                                                    <input type="text" id="text-input" name="'.$name.'" class="form-control" placeholder="' . $lablenameuppercase . '" >
                                                                </div>
                                                            </div>';  
                                                     } 
                                                     // Type 4
                                                     elseif(($commentsarray[2] == 4))
                                                     {
                                                       echo '<div class="form-group row">
                                                                <label class="col-lg-2 col-form-label" for="text-input">' . $lablenameuppercase . '</label>
                                                                <div class="col-lg-2">
                                                                    <input type="text" id="text-input" name="'.$name.'" class="form-control" placeholder="' . $lablenameuppercase . '" >
                                                                </div>
                                                            </div>';  
                                                     } 
                                                     // Type 5
                                                     elseif(($commentsarray[2] == 5))
                                                     {
                                                        $todaydate =  date("Y/m/d");
                                                       echo '<div class="form-group row">
                                                                <label class="col-lg-2 col-form-label" for="text-input">' . $lablenameuppercase . '</label>
                                                                <div class="col-lg-4">
                                                                    <input type="text" id="text-input" name="'.$name.'" class="form-control" value="'.$todaydate.'" >
                                                                </div>
                                                            </div>';  
                                                     } 
                                                     // Type 6
                                                     elseif(($commentsarray[2] == 6))
                                                     {
                                                       echo '<div class="form-group row">
                                                                <label class="col-lg-2 col-form-label" for="select">' . $lablenameuppercase . '</label>
                                                                <div class="col-lg-4">
                                                                <select id="select" name="' . $name . '" class="form-control">
                                                                    <option value="1">Active</option>
                                                                    <option value="0">Not Active</option>
                                                                </select>
                                                                </div>
                                                               </div>'; 
                                                     } 
                                                     // Type 7
                                                     elseif(($commentsarray[2] == 7))
                                                     {
                                                       echo '<div class="form-group row">
                                                                <label class="col-lg-2 col-form-label" for="select">' . $lablenameuppercase . '</label>
                                                                <div class="col-lg-4">
                                                                <select id="select" name="' . $name . '" class="form-control">
                                                                    <option value="0">Pending</option>
                                                                    <option value="1">Approved</option>
                                                                    <option value="2">Cancelled</option>
                                                                    <option value="3">Delivered</option>
                                                                    <option value="4">Shipped</option>
                                                                </select>
                                                                </div>
                                                               </div>';   
                                                     } 
                                                     // Type 8
                                                     elseif(($commentsarray[2] == 8))
                                                     {
                                                        echo '<div class="form-group row">
                                                                <label class="col-lg-2 col-form-label" for="select">' . $lablenameuppercase . '</label>
                                                                <div class="col-lg-4">
                                                                <select id="select" name="' . $name . '" class="form-control">
                                                                    <option value="0">Yes</option>
                                                                    <option value="1">No</option>
                                                                </select>
                                                                </div>
                                                               </div>';  
                                                     } 
                                                     // Type 9
                                                     elseif(($commentsarray[2] == 9))
                                                     {
                                                       echo '<div class="form-group row">
                                                                <label class="col-lg-2 col-form-label" for="select">' . $lablenameuppercase . '</label>
                                                                <div class="col-lg-4">
                                                                <select id="select" name="' . $name . '" class="form-control">
                                                                    <option value="1">Alive</option>
                                                                    <option value="0">Dead</option>
                                                                </select>
                                                                </div>
                                                               </div>';  
                                                     } 
                                                     // Type 10
                                                     elseif(($commentsarray[2] == 10))
                                                     {
                                                       echo '<div class="form-group row">
                                                                <label class="col-lg-2 col-form-label" for="select">' . $lablenameuppercase . '</label>
                                                                <div class="col-lg-4">
                                                                <select id="select" name="' . $name . '" class="form-control">
                                                                    <option value="1">Female</option>
                                                                    <option value="0">Male</option>
                                                                </select>
                                                                </div>
                                                               </div>';  
                                                     } 
                                                     // Type 11
                                                     elseif(($commentsarray[2] == 11))
                                                     {
                                                       echo '<div class="form-group row">
                                                                <label class="col-lg-2 col-form-label" for="select">' . $lablenameuppercase . '</label>
                                                                <div class="col-lg-4">
                                                                <select id="select" name="' . $name . '" class="form-control">
                                                                    <option value="1">Local</option>
                                                                    <option value="0">Imported</option>
                                                                </select>
                                                                </div>
                                                               </div>';  
                                                     } 
                                                }
                                                
                                                else 
                                                {
                                                 echo '';   
                                                }
                                                
                                                
                                                
                                                
                                            }
                                            ?>

                                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>
                                            <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
         <!--/. col -->
        </div>   
            </div>
            <div class="col-lg-5">
                <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <i class="icon-settings"></i>
                                        <span>Add Template Setting</span>
                                    </div>
                                    <div class="card-body ">
                                    <table class="table table-responsive-sm table-hover table-outline mb-0">
                                    <tbody> 
                                    <!--/ . col -->
                                    
                                    <?php
                                    if($allTemplateTableList['records'] == NULL)
                                    {
                                       echo '<div class="alert alert-danger"><strong>Record not found!</strong></div>';    
                                    }
                                    else
                                    {
                                        
                                     foreach ($allTemplateTableList['records'] as $rows) 
                                                {
                                                    
                                                     echo 
                                                    '<tr>
                                                        <td class="font-weight-bold text-uppercase">
                                                            <div class="text-muted"> 
                                                                <i class="fa fa-bars text-left"></i>
                                                                ' . $rows['name'] . '
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="badge badge-pill badge-success text-white font-xs">' . $rows['counttables'] . '</span>
                                                            <div class="text-muted b-t-1 "> <small> Records</small></div>
                                                        </td>    
                                                        <td class="text-right">
                                                            <div class="text-muted">' . $rows['action'] . '</div>
                                                        </td>
                                                    </tr>';
                                                }   
                                    }
                                                
                                                ?>
                                        </tbody>
                                    </table>    
                                        <!--/ . col -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
         <!--/. col -->
        </div>
            </div>
        </div>
        
    </div>
</div>

                      
                    