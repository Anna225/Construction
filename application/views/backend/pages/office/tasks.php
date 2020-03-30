<div class="animated fadeIn">
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-2">
                    <div class="card">
                        <div class="card-body">
                            <ul class="reqmenus">
                                 <?php
                                $this->load->view('backend/pages/office/common/topmenumob');
                            ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-10">
                     <?php
                                    $this->load->view('backend/pages/office/common/allothercategories');
                                ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                              <?php
                                    $this->load->view('backend/pages/office/common/topmenustatus');
                                ?>
                            </div>
                        </div>
                        
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <i class="icon-speedometer"></i>
                            <span><?php echo ucfirst($this->uri->segment(2)); ?></span>

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
                                        <th class='hiden'>1</th>
                                        <th>Name</th>
                                        <th>Interested In</th>
                                        <th>Location</th>
                                        <th>Action</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th class='hiden'>1</th>
                                        <th class='hiden'>1</th>
                                        <th class='hiden'>1</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    foreach ($listofficerequests['records'] as $rows) {
                                        $id = $rows['id_clients'];

                                        $pharray = $this->moffice->getPhoneNumbers($id);
                                        $arrlength = count($pharray);
                                        if ($rows['updateddtae'] == "0000-00-00 00:00:00") {
                                            $updatedate = '';
                                        } else {
                                            $updatedate = "Updated : " . $rows['updateddtae'] . "";
                                        }
                                        if ($rows['maincateid'] == 1) {

                                            $icon = '<i class="far fa-building"> </i>';
                                            $txtcolour = 'class="text-success"';
                                        } elseif ($rows['maincateid'] == 2) {
                                            $icon = '<i class="fas fa-shopping-cart"></i>';
                                            $txtcolour = 'class="text-orange"';
                                        } elseif ($rows['maincateid'] == 3) {
                                            $icon = '<i class="fas fa-tools"></i>';
                                            $txtcolour = 'class="text-primary"';
                                        } elseif ($rows['maincateid'] == 4) {
                                            $icon = '<i class="fas fa-pencil-ruler"></i>';
                                            $txtcolour = 'class="text-danger"';
                                        }

                                        if ($rows['refid'] == 1) {

                                            $refby = '<i class="fab fa-facebook-square"></i>';
                                        } else {
                                            $refby = '';
                                        }
                                        
                                        if($rows['byteam'] == 1){
                                            $team = "Usman";
                                        }
                                        elseif($rows['byteam'] == 2){
                                            $team = "Umar";
                                        }
                                        elseif($rows['byteam'] == 3){
                                            $team = "Shahab";
                                        }
                                        elseif($rows['byteam'] == 4){
                                            $team = "Umair";
                                        }
                                        elseif($rows['byteam'] == 5){
                                            $team = "Sufyian";
                                        }
                                        else{
                                            $team = "";
                                        }
                                        

                                        echo "<tr >
                                <td class='hiden'>" . $rows['id_requests'] . "</td>
                               <td " . $txtcolour . "><span><b>  $refby " . $rows['clientname'] . "</b></span>
                                <div >";
                                        foreach ($pharray as $value) {
                                            if ($value['type_phone'] == 2) {
                                                $phicon = '<i class="fab fa-whatsapp text-muted"></i>';
                                            } else {
                                                $phicon = '<i class="fas fa-phone text-muted"></i>';
                                            }
                                            $phnum = $value['number_phone'];
                                            echo "$phicon  $phnum";
                                            echo "<br>";
                                        }
                                        echo "</div>
                                </td>
                                <td " . $txtcolour . ">" . $icon . " " . $rows['maincatename'] . "<div> " . $rows['typename'] . " <i class='fas fa-angle-right'></i> " . $rows['subcatename'] . "  </div></td>
                                <td " . $txtcolour . ">" . $rows['cityname'] . " <i class='fas fa-angle-right'></i> " . $rows['socityname'] . " <div><i class='fas fa-angle-right'></i> " . $rows['reqaddress'] . "</div></td>
                                 <td><span class='text-muted'><i class='" . $rows['reqcateclassname'] . "'></i><b> " . $rows['reqcatename'] . "</b></span><div> " . $rows['reqdate'] . "</div></td>
                                <td><span class='badge badge-pill badge-" . $rows['statuscatebgcolour'] . "'><i class='" . $rows['statuscateclassname'] . "'></i> " . $rows['statuscatename'] . "</span><div><div class='tooltip2'>Message<span class='tooltiptext2'>" . $rows['reqnote'] . "<div>" . $updatedate . "</div></span></div> - By <span class='font-weight-bold'>" . $team . " </span></div></td>
                                <td>" . $rows['action'] . "</td>
                                <td class='hiden'>" . $rows['reqnote'] . "</td>
                                <td class='hiden'>" . $rows['idreqstatus'] . "</td>
                                <td class='hiden'>" . $rows['idreqcate'] . "</td>

                                </tr>";
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


<div class="modal fade" id="userModal">
    <div class="modal-dialog modal-lg">
        <form method="post" id="user_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title float-left"><i class="fa fa-folder-open"></i> Add Request</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-4">
                                    <div>
                                        <label class="col-md-10 col-form-label">Name</label>
                                        <div class="col-md-10">
                                            <select  onchange="updateSubCategory(options[selectedIndex].value)" class="form-control" name="fk_clients" >
                                                <?php
                                                $sql3 = "SELECT * FROM `office_clients` WHERE id_clients = (SELECT MAX(id_clients) from office_clients)";
                                                $query2 = $this->db->query($sql3)->result();
                                                foreach ($query2 as $record2) {
                                                    echo'<option value="' . $record2->id_clients . '">' . $record2->name_clients . '</option>';
                                                }
                                                ?>
                                            </select>

                                        </div>
                                    </div>
                                    <div>
                                        <label class="col-md-10 col-form-label" for="text-input">Select Category</label>
                                        <div class="col-md-10">
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
                                        <label class="col-md-10 col-form-label" for="focusedInput">Sub Category</label>
                                        <div class="col-md-10">

                                            <select id="subcategory" onchange="updateTeams(options[selectedIndex].value)" class="form-control" name="fk_office_subcategories"></select>

                                        </div>

                                    </div>

                                    <div>
                                        <label class="col-md-10 col-form-label" for="text-input">Select Types</label>
                                        <div class="col-md-10">
                                            <div>
                                                <?php echo form_dropdown('fk_office_types', $drpdwnofficetypes, '', 'data-rel="chosen" id="select" class="form-control"'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div>
                                        <label class="col-md-10 col-form-label" for="text-input">Select City</label>
                                        <div class="col-md-10">
                                            <div>
                                                <select  onchange="updateSocitiesList(options[selectedIndex].value)" class="form-control" name="fk_city" >
                                                    <?php
                                                    echo '<option value="0">Select City</option>';
                                                    $sql2 = "SELECT * FROM cities";
                                                    $query3 = $this->db->query($sql2)->result();
                                                    foreach ($query3 as $record2) {
                                                        echo'<option value="' . $record2->id . '">' . $record2->name . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="col-md-10 col-form-label" for="focusedInput">Society</label>
                                        <div class="col-md-10">

                                            <select id="societies" class="form-control" name="fk_societies"></select>

                                        </div>

                                    </div>
                                    <div>
                                        <label class="col-md-10 col-form-label">Full Addrees</label>
                                        <div class="col-md-10">
                                            <input type="text" name="address_clients" id="address_clients" class="form-control" />
                                        </div>
                                    </div>


                                </div>

                                <div class="col-4">


                                    <div>
                                        <label class="col-md-10 col-form-label" for="text-input">Select Action</label>
                                        <div class="col-md-10">
                                            <div>
                                                <?php echo form_dropdown('fk_reqcategory', $drpdwnreqcate, '', 'data-rel="chosen" id="select" class="form-control" onchange="updateReqCate(options[selectedIndex].value)"'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="col-md-10 col-form-label" for="focusedInput">Select Status</label>
                                        <div class="col-md-10">

                                            <select id="statuscate" class="form-control" name="fk_status"></select>

                                        </div>

                                    </div>
                                    <div>
                                        <label class="col-md-10 col-form-label">Notes:</label>
                                        <div class="col-md-10">
                                            <textarea id="textarea-input" name="note" rows="3" class="form-control" placeholder="Content.."></textarea></div>
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

<!-- Edit Meeting ######################################### -->

<div class="modal fade" id="editmodal" role="dialog">
    <div class="modal-dialog">
        <form method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title float-left"><i class="fa fa-folder-open"></i> Edit Meeting Data</h4>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="edit_req_office_id" id="edit_req_office_id">

                    <div>
                        <label class="col-md-10 col-form-label" for="focusedInput">Select Status</label>
                        <div class="col-md-10">

                            <select id="edit_fk_status" class="form-control" name="edit_fk_status"></select>

                        </div>

                    </div>
                    <label class="col-md-8 col-form-label">Updated By</label>
                    <div class="col-md-8">
                        <select name="byteam" class="custom-select">
                            <option selected value="1">Usman</option>
                            <option  value="2">Umar</option>
                            <option  value="3">Shahab</option>
                            <option  value="4">Umair</option>
                            <option value="5">Sufiyan</option>
                        </select>
                    </div>
                    <div>
                        <label class="col-md-10 col-form-label">Notes:</label>
                        <div class="col-md-10">
                            <textarea id="edit_note" name="edit_note" rows="3" class="form-control" placeholder="Content.."></textarea></div>
                    </div>



                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" >Update</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery.min.js"></script>

<script type="text/javascript" language="javascript">
                                                    $(document).ready(function(){

                                                    $(document).on('submit', '#user_form', function(event){
                                                    event.preventDefault();
                                                            var name = $('#name_clients').val();
                                                            if (name != '' && status != '')
                                                    {
                                                    $.ajax({
                                                    url:"<?php echo base_url() . 'office/requests' ?>",
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
                                                            )};</script>

<script type="text/javascript" language="javascript">

    $(document).ready(function () {
    $('.editbutton').on('click', function () {

    $('#editmodal').modal('show');
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function () {
    return $(this).text();
    }).get();
            reqcategoires = data[9];
            statuscategories = data[8];
            dt = new Date();
            u2 = "http://localhost/builders/extra/selectreqcateallstatus/" + reqcategoires + "/" + statuscategories + "/" + dt.getTime();
            //alert(u2);
            $("#edit_fk_status").load(u2);
            $('#edit_note').val(data[7]);
            // $('#idstatuscate').val(data[8]);
            $('#edit_req_office_id').val(data[0]);
            //$('#idreqcate').val(data[9]);
    });
    });
</script>



