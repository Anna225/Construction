<div class="animated fadeIn">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12 text-center text-uppercase">
                <?php
                $alert = "";
                $result = $this->session->flashdata('message');
                $comments = $this->session->flashdata('comments');
                if ($result == 2) {
                    $alert = '<div class="alert alert-danger"><strong>Failed!</strong> ' . $comments . '</div>';
                } elseif ($result == 1) {
                    $alert = '<div class="alert alert-success"><strong>Success!</strong> ' . $comments . '</div>';
                } else {
                    $alert = "";
                }
                echo $alert;
                ?>

            </div>  
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                         <i class="fa fa-reorder"></i> <?php echo $tablename;?>
                                                        </div>
                                                        <div class="col-lg-6 text-right">
                                                            <button type="button" class="btn btn-outline-secondary btn-sm float-right font-sm">
                                                                <a href="<?php echo base_url() ;?>add/<?php echo $name ;?>"><i class="fa fa-plus-circle"></i> Add</a>
                                                            </button>   
                                                        </div>
                                                    </div>    
                                                </div>
                                             </div>
                                            <div class="card-body">
                                                <table class="table table-striped table-bordered datatable">
                                                    <thead>
                                                        <tr>
                                                            <?php
                                                            foreach ($getAllTabelsThs['records'] as $rows) {
                                                                // get comments and make if array
                                                                $getcomments = $rows['cmt'];
                                                                $commentsarray = (explode("|", $getcomments));


                                                                // LoadView == 1 show data of th
                                                                if ($commentsarray[1] == 1) 
                                                                {
                                                                    $columnname = $rows['columnname'];
                                                                    
                                                                    $getlabelname = strstr($columnname, '_', true);
                                                                    
                                                                    if($getlabelname == "status")
                                                                    {
                                                                        $statusarray = (explode("_", $columnname));
                                                                        $thname = ucfirst($statusarray[1]);
                                                                         
                                                                    }
                                                                    elseif($getlabelname == "date")
                                                                    {
                                                                        $datearray = (explode("_", $columnname));
                                                                        $thname = ucfirst($datearray[1]);
                                                                         
                                                                    }
                                                                    elseif($getlabelname == "fk1")
                                                                    {
                                                                        $thname = ucfirst($columnname);
                                                                         
                                                                    }
                                                                    else
                                                                    {
                                                                        $thname = ucfirst(strstr($columnname, '_', true));
                                                                    }
                                                                    echo '<th>' . $thname . '</th>';
                                                                } 
                                                                else 
                                                                {
                                                                    echo'';
                                                                }
                                                            }
                                                            echo '<th>Action</th>';
                                                            ?>  
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $baseurl = base_url() ;
                                                        $gettablename = $this->uri->segment(2);
                                                        
                                                        foreach ($getAllTables['records'] as $rows) 
                                                        {
                                                            echo '<tr>';
                                                            foreach ($totalrows['records'] as $value) 
                                                            {
                                                                // get comments and make if array
                                                                $getcomments = $value['cmt'];
                                                                $commentsarray =  (explode("|",$getcomments));
                                                                
                                                                // LoadView == 1 show data of tds
                                                                if($commentsarray[1] == 1)
                                                                  {
                                                                    echo '<td>' . $rows['' . $value['tdtablename'] . ''] . '</td>';
                                                                  }
                                                                 else
                                                                  {
                                                                     echo '';
                                                                  } 
                                                            }
                                                            echo '<td>'.$rows['action'].'</td>';
                                                            echo '</tr>';
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
                    <!--/. col -->
                </div>   
            </div>
        </div>
    </div>
</div>


