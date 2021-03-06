<div class="animated fadeIn">
    <?php
    $this->load->view('backend/pages/office/common/topmenu');
    ?>
    
    

    <div class="row">
        
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-block p-0 clearfix">
                    <i class="far fa-building bg-success p-3 px-5 font-2xl mr-3 float-left"></i>
                    <div class="h5 mb-0 pt-2 text-center"><?php echo $this->totconstclients;?></div>
                    <div class="text-muted text-uppercase font-weight-bold font-xs text-center">Construction</div>
                </div>
            </div>
        </div>
        <!--/.col-->
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-block p-0 clearfix">
                    <i class="fas fa-tools bg-orange p-3 px-5 font-2xl mr-3 float-left"></i>
                    <div class="h5 mb-0 pt-2 text-center"><?php echo $this->totrenovaclients;?></div>
                    <div class="text-muted text-uppercase font-weight-bold font-xs text-center">Renovation</div>
                </div>
            </div>
        </div>
        <!--/.col-->
        
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-block p-0 clearfix">
                    <i class="fas fa-shopping-cart bg-primary p-3 px-5 font-2xl mr-3 float-left"></i>
                    <div class="h5 mb-0 pt-2 text-center"><?php echo $this->totproptyclients;?></div>
                    <div class="text-muted text-uppercase font-weight-bold font-xs text-center">Propriety</div>
                </div>
            </div>
        </div>
        <!--/.col-->
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-block p-0 clearfix">
                    <i class="fas fa-pencil-ruler bg-danger p-3 px-5 font-2xl mr-3 float-left"></i>
                    <div class="h5 mb-0 pt-2 text-center"><?php echo $this->totdesigclients;?></div>
                    <div class="text-muted text-uppercase font-weight-bold font-xs text-center">Design</div>
                </div>
            </div>
        </div>
        <!--/.col-->

        

       
    </div>
    
    <div class="col-sm-12 ">
        <div class="card">
            <div class="card-header">
                <i class="icon-speedometer"></i>
                <span><?php echo ucfirst($this->uri->segment(2)); ?></span>

                <div class="card-actions ">
                    <button type="button"  data-toggle="modal" data-target="#userModal" class="btn btn-info">+ Add</button>
                </div>
            </div>


            <hr class="m-0">
            <?php
            $result = $this->session->flashdata('userdatasavestatus');
            if (!empty($result)) {
                echo '<div class="alert alert-success"><strong>' . $result . '</strong></div>';
            }
            ?>
            <hr class="m-0">
            <div class="card-body">
                <table class="table table-striped table-bordered datatable" id="clienttable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Interested In</th>
                            <th>Location</th>
                            <th>Contact</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        foreach ($listofficeclients['records'] as $rows) {
                            $id = $rows['id_clients'];
                            
                            $pharray = $this->moffice->getPhoneNumbers($id);
                            $arrlength = count($pharray);
                            
                            if($rows['name_categories'] == "Construction"){
                                
                                $icon = '<i class="far fa-building"> </i>';
                                $txtcolour = 'class="text-success"';
                            }
                            elseif($rows['name_categories'] == "Propriety"){
                                $icon = '<i class="fas fa-shopping-cart"></i>';
                                $txtcolour = 'class="text-primary"';
                            }
                           
                            elseif($rows['name_categories'] == "Renovation"){
                                $icon = '<i class="fas fa-tools"></i>';
                                $txtcolour = 'class="text-orange"';
                            }
                            elseif($rows['name_categories'] == "Design"){
                                $icon = '<i class="fas fa-pencil-ruler"></i>';
                                $txtcolour = 'class="text-danger"';
                            }
                            
                            if(($rows['refby_clients'] == "Facebook") || ($rows['refby_clients'] == "facebook")){
                                
                                $refby = '<i class="fab fa-facebook-square"></i>';
                                
                            }
                            else{
                                $refby = '';
                            }
                            
                            echo "<tr><td>" . $rows['id_clients'] . "</td>
                                       <td><span " .$txtcolour. "><b>  $refby ". $rows['name_clients'] . "</b></span><div> ". $rows['date_clients'] . "</div></td>
                                        <td " .$txtcolour. ">" .$icon. " ". $rows['name_categories'] . "<div> ". $rows['typename'] ." <i class='fas fa-angle-right'></i> ". $rows['name_subcategories'] ."  </div></td>
                                       <td>" . $rows['city_clients'] . " <i class='fas fa-angle-right'></i> " . $rows['society_clients'] . "</td>
                                       <td>";

                            foreach ($pharray as $value) {
                                if($value['type_phone'] == 2)
                                {
                                    $phicon = '<i class="fab fa-whatsapp text-muted"></i>';
                                }
                                else{
                                    $phicon = '<i class="fas fa-phone text-muted"></i>';
                                }
                                $phnum = $value['number_phone'];
                                echo "$phicon  $phnum";
                                echo "<br>";
                            }

                            echo "</td><td>" . $rows['action'] . "</td>
                                        </tr>";
 
                            
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="userModal">
    <div class="modal-dialog modal-lg">
        <form method="post" id="user_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title float-left"><i class="fa fa-folder-open"></i> Add Clients</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <div>
                                        <label class="col-md-8 col-form-label">Name</label>
                                        <div class="col-md-8">
                                            <input type="text" name="name_clients" id="name_clients" class="form-control" />
                                        </div>
                                    </div>
                                    <div>
                                        <label class="col-md-6 col-form-label" for="text-input">Select Category</label>
                                        <div class="col-md-6">
                                            <div>
                                                <select  onchange="updateSubCategory(options[selectedIndex].value)" class="form-control" name="" >
                                                    <?php
                                                    echo '<option value="0">Select Category</option>';
                                                    $sql = "SELECT * FROM office_categories";
                                                    $query = $this->db->query($sql)->result();
                                                    foreach ($query as $record) {
                                                        echo'<option value="' . $record->id_categories . '">' . $record->name_categories . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="col-md-6 col-form-label" for="focusedInput">Sub Category</label>
                                        <div class="col-md-6">

                                            <select id="subcategory" onchange="updateTeams(options[selectedIndex].value)" class="form-control" name="fk_office_subcategories"></select>

                                        </div>

                                    </div>

                                    <div>
                                        <label class="col-md-6 col-form-label" for="text-input">Select Types</label>
                                        <div class="col-md-6">
                                            <div>
                                                <?php echo form_dropdown('fk_office_types', $drpdwnofficetypes, '', 'data-rel="chosen" id="select" class="form-control"'); ?>
                                            </div>
                                        </div>  
                                    </div> 
                                </div>
                                
                                <div class="col-6">
                                    <div>
                                        <label class="col-md-4 col-form-label">City</label>
                                        <div class="col-md-4">
                                            <input type="text" name="city_clients" id="address_clients" class="form-control" />
                                        </div>
                                    </div>
                                    <div>
                                        <label class="col-md-6 col-form-label">Society</label>
                                        <div class="col-md-6">
                                            <input type="text" name="society_clients" id="address_clients" class="form-control" />
                                        </div>
                                    </div>
                                    <div>
                                        <label class="col-md-6 col-form-label">Full Addrees</label>
                                        <div class="col-md-6">
                                            <input type="text" name="address_clients" id="address_clients" class="form-control" />
                                        </div>
                                    </div>
                                    <div>
                                        <label class="col-md-6 col-form-label">Ref By</label>
                                        <div class="col-md-6">
                                            <input type="text" name="refby_clients" id="address_clients" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="modal-footer">
                        <input type="submit" name="action" value="Add" class="btn btn-success"/>
                        <input type="hidden" name="action" class="btn btn-success" value="Add" />
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
        </form>
    </div>
</div>
</div>

<div class="modal fade" id="phoneModal">
    <div class="modal-dialog">
        <form method="post" id="phone_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title float-left"><i class="fa fa-folder-open"></i> Add Phone</h4>
                </div>
                <div class="modal-body">
                    <label class="col-md-8 col-form-label">Number</label>
                    <div class="col-md-8">
                        <input type="text" name="number_phone" id="number_phone" class="form-control" />
                    </div>
                    <label class="col-md-8 col-form-label">Phone Type</label>
                    <div class="col-md-8">
                    <select name="type_phone" class="custom-select">
                    <option value="1">Calls</option>
                    <option selected value="2">WhatsApp</option>
                    </select>
                     </div>
                    
                    <label class="col-md-8 col-form-label" >Client ID</label>
                    <div class="col-md-8">
                        <input type="text" name="fk_office_clients" id="fk_office_clients" class="form-control" />
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
            var name = $('#name_clients').val();
            if (name != '' && status != '')
    {
    $.ajax({
    url:"<?php echo base_url() . 'office/clients' ?>",
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
            $(document).on('submit', '#phone_form', function(event){
    event.preventDefault();
            var number = $('#number_phone').val();
            if (number != '')
    {
    $.ajax({
    url:"<?php echo base_url() . 'office/clients' ?>",
            method: 'POST',
            data: new FormData(this),
            contentTye:false,
            processData:false,
            success:function(data)
            {
            alert(data);
                    $('#phone_form')[0].reset();
                    $('#phoneModal').modal('hide');
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

