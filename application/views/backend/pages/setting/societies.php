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
                                    <button type="button" data-toggle="modal" data-target="#userModal" class="btn btn-outline-primary  btn-sm "><i class="fa fa-plus"></i> Add Society</button>
                                    </div>
                                    
                                </div>
                            </div>
                            <hr>
                            <table class="table table-striped table-bordered datatable" id="categoriestable">
                                <tbody>
                                <ul class="list-group">
                                    <?php
                                    $baseurl = base_url();
                                    foreach ($listsettingsocieties as $society) {
                                        $id = $society->id;
                                        $fkcity = $society->fk_cities;

                                        $cityname = $this->msetting->getCityName($fkcity);


                                        $url = "deletesociety/$id";
                                        ?>
                                        <li class="list-group-item list-group-item-light">
                                            <span class="text-success"><?php echo $society->name; ?> - (<?php echo $cityname; ?>) </span>
                                            <div class="float-right">
                                                <span class="text-muted"><?php echo $society->orderby; ?></span> | 
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
                    <h4 class="modal-title float-left"><i class="fa fa-folder-open"></i> Add Society</h4>
                </div>
                <div class="modal-body">
                    <label class="col-md-6 col-form-label" for="text-input">Select City</label>
                    <div class="col-md-6">
                        <div>
                            <?php echo form_dropdown('fk_cities', $drpdwncities, '', 'data-rel="chosen" id="fk_cateoffice" class="form-control"'); ?>
                        </div>
                    </div>
                    <label class="col-md-8 col-form-label">Society Name</label>
                    <div class="col-md-8">
                        <input type="text" name="name" id="name" class="form-control" /> 
                    </div>
                    <label class="col-md-8 col-form-label" >Status</label>
                    <div class="col-md-8">
                        <input type="text" name="status" id="status" class="form-control" />
                    </div>
                    <label class="col-md-4 col-form-label">Order By</label>
                    <div class="col-md-4">
                        <input type="text" name="orderby" id="orderby" class="form-control" />
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


    $(document).on('submit', '#user_form', function(event){
    event.preventDefault();
            var name = $('#name').val();
            var status = $('#status').val();
            if (name != '' && status != '')
    {
    $.ajax({
    url:"<?php echo base_url() . 'setting/societies' ?>",
            method: 'POST',
            data: new FormData(this),
            contentTye:false,
            processData:false,
            success:function(data)
            {
            alert(data);
                    $('$user_form')[0].reset();
                    $('#userModal').modal('hide');
                    dataTable.ajax.reload();
            }
    });
    }
    else{
    alert("Put Data");
    }
    });
            )};
</script>
