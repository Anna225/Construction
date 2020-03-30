<div class="animated fadeIn"> 
    <?php
    //$this->load->view('backend/pages/setting/common/topmenu');
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2">
                    
                    <?php
                        $this->load->view('backend/pages/setting/common/settingmenu');
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
                            echo $result;
                        }
                        ?>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12"> 
                                    <div class="float-right">
                                    <button type="button" data-toggle="modal" data-target="#userModal" class="btn btn-outline-primary  btn-sm "><i class="fa fa-plus"></i> Add</button>
                                    </div>
                                    
                                </div>
                            </div>
                            <hr>
                            <table class="table table-striped table-bordered datatable" id="categoriestable">
                                <tbody>
                                <ul class="list-group">
                                    <?php
                                    $baseurl = base_url();
                                    foreach ($listofficecategories as $reqcate) {
                                        $id = $reqcate->id_categories;
                                        $url = "deletereqcategories/$id";
                                        ?>
                                        <li class="list-group-item list-group-item-light">
                                            <span class="text-success "><i class="<?php echo $reqcate->class_categories; ?>"></i>  <?php echo $reqcate->name_categories; ?></span>
                                            <div class="float-right">
                                                <span class="text-muted"><?php echo $reqcate->orderby_categories; ?></span> | 
                                                <a href="#"><i class="fas fa-angle-down text-danger"></i></a> 
                                                <a href="#"><i class="fas fa-angle-up text-success"></i></a>
                                                | <a href="#" ><i class="far fa-edit text-primary"></i></a>
                                                | <a href="<?php echo $url; ?>"><i class="fas fa-trash-alt text-danger"></i></a>
                                            </div>
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
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="userModal">
    <div class="modal-dialog">
        <form method="post" id="user_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title float-left"><i class="fa fa-folder-open"></i> Add Category</h4>
                </div>
                <div class="modal-body">
                    <label class="col-md-8 col-form-label">Category Name</label>
                    <div class="col-md-8">
                        <input type="text" name="name_categories" id="name_categories" class="form-control" /> 
                    </div>
                    <label class="col-md-8 col-form-label" >Class</label>
                    <div class="col-md-8">
                        <input type="text" name="class_categories" id="class_categories" class="form-control" />
                    </div>
                     <label class="col-md-8 col-form-label" >Bg Colour</label>
                    <div class="col-md-8">
                        <input type="text" name="bg_colour" id="bg_colour" class="form-control" />
                    </div>
                    <label class="col-md-8 col-form-label" >Status</label>
                    <div class="col-md-8">
                        <input type="text" name="status_categories" id="status_categories" class="form-control" />
                    </div>
                    <label class="col-md-4 col-form-label">Order By</label>
                    <div class="col-md-4">
                        <input type="text" name="orderby_categories" id="orderby_categories" class="form-control" />
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


<script type="text/javascript" language="javascript">
    $(document).ready(function(){

    $(document).on('submit', '#user_form2', function(event){
    event.preventDefault();
            var name = $('#name_categories').val();
            var status = $('#status_categories').val();
            if (name != '' && status != '')
    {
    $.ajax({
    url:"<?php echo base_url() . 'setting/categories' ?>",
            method: 'POST',
            data: new FormData(this),
            contentTye:false,
            processData:false,
            success:function(data)
            {
            alert(data);
                    $('$user_form2')[0].reset();
                    $('#userModal2').modal('hide');
                    dataTable.ajax.reload();
            }
    });
    }
    else{
    alert("Put Data");
    }
    });
</script>
