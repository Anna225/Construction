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
                                        <i class="icon-settings"></i>
                                        <span>List Tables</span>
                                    </div>
                                    <div class="card-body">
                                     
                                        <!--/ . col -->
                                   
                                    <table class="table table-responsive-sm table-hover table-outline mb-0">
                                    <tbody> 
                                    <?php
                                                
                                                if($getAllTables['records'] == NULL)
                                                    {
                                                      echo '<div class="alert alert-danger"><strong>Record not found!</strong></div>';  
                                                    } 
                                                    else
                                                    {
                                                        foreach ($getAllTables['records'] as $rows) 
                                                        {
                                                    echo 
                                                    '<tr>
                                                        <td class="font-weight-bold text-uppercase">
                                                            <div class="text-muted"> 
                                                                <i class="fa folder-open text-left"></i>
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
            <div class="col-lg-5">
                <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 ">
                                <div class="card">
                                    <div class="card-header">
                                        <i class="icon-settings "></i>
                                        <span>List Template Setting</span>
                                    </div>
                                    <div class="card-body">
                                     <!--/ . col -->
                                    <table class="table table-responsive-sm table-hover table-outline mb-0">
                                    <tbody> 
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


