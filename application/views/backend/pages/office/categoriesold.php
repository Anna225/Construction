<div class="animated fadeIn"> 
<?php 
                $this->load->view('backend/pages/office/menu');
        ?>
<div class="card-header container-fluid">
  <div class="row">
    <div class="col-md-10">
      <h3 class="w-100 p-3">Categories</h3>
    </div>
    <div class="col-md-2 float-right">
      <button class="btn btn-primary" >Add</button>
      <button class="btn btn-primary" style="margin-left: 1em">Edit</button>
     </div>
  </div>
</div>    
<div class="card">
        <div class="col-sm-8 col-lg-12">
            <div class="row">
                <div class="col-sm-8">
                    <small class="h2 text-success text-uppercase font-weight-bold">
                        <?php echo $this->session->flashdata('userdatasavestatus'); ?>
                    </small>
                </div>
                
            </div>  
        </div>
                <hr class="m-0">
            <div class="card-body">
              <table class="table table-striped table-bordered datatable">
                
                <tbody>
                    <ul class="list-group">
                        <?php 
                            foreach ($categories as $category)
                            {
                        ?>
                        <li class="list-group-item list-group-item-light"><span class="text-success text-uppercase"><?php echo $category->name_cateoffice; ?></span><div class="float-right"><a href="#"><i class="fas fa-angle-down text-danger"></i></a> <a href="#"><i class="fas fa-angle-up text-success"></i></a> | <a href="http://localhost/builders/admin/categories/edit/" ><i class="far fa-edit text-primary"></i></a> | <a href="#"><i class="fas fa-trash-alt text-danger"></i></a></div>
                            <?php
                            if(!empty($category->subs)) 
                            { 
                                echo '<ul class="list-group list-group-flush">';
                                    foreach ($category->subs as $sub)  
                                        {
                                            echo '<li class="list-group-item"><span class="text-primary"> - ' . $sub->name_subcateoffice . '</span> <div class="float-right"><a href="#"><i class="fas fa-angle-down text-danger"></i></a> <a href="#"><i class="fas fa-angle-up text-success"></i></a> | <a href="#" ><i class="far fa-edit text-primary"></i></a> | <a href="#"><i class="fas fa-trash-alt text-danger"></i></a></div></li>';
                                        }
                                echo '</ul>';
                            }
                            ?>
                            </li>
                            
                            <?php
                            }
                            ?>
                    </ul>
   
                </tbody>
              </table>
            </div>
          </div>
    
    
</div>
