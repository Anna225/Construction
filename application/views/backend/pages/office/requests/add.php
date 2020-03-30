<div class="animated fadeIn">
    <?php
    $this->load->view('backend/pages/office/common/topmenu');
    ?>
    <?php
    foreach ($clientprofiledata as $profile) {
        if ($profile['fk_categories'] == 1) {

            $icon = '<i class="far fa-building"> </i>';
            $txtcolour = 'class="text-success h4"';
        } elseif ($profile['fk_categories'] == 2) {
            $icon = '<i class="fas fa-shopping-cart"></i>';
            $txtcolour = 'class="text-primary h4"';
        } elseif ($profile['fk_categories'] == 3) {
            $icon = '<i class="fas fa-tools"></i>';
            $txtcolour = 'class="text-orange h4"';
        } elseif ($profile['fk_categories'] == 4) {
            $icon = '<i class="fas fa-pencil-ruler"></i>';
            $txtcolour = 'class="text-danger h4"';
        }
        if ($profile['refby_clients'] == 1)  {

            $refby = '<i class="fab fa-facebook-square"></i>';
        } else {
            $refby = '';
        }
        $clientname = $profile['name_clients'];
        $addeddate = $profile['date_clients'];
        $name_categories = $profile['fk_categories'];
        $cnic = $profile['cnic_clients'];
    }
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-5">
                            <h3 class="card-title clearfix mb-0 text-muted"><i class="fa fa-group text-muted"></i> Client Profile</h3>
                            <br>
                        </div>
                    </div>
                    <hr class="m-0">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="callout callout-info">
                                <small class="text-muted">Name & Phone</small>
                                <br>
                                <strong class="h2 text-primary"><?php echo $refby; ?> <?php echo $clientname; ?></strong><span class="h5 float-right"><i class='fas fa-heart text-orange'></i> | <i class='fas fa-house-damage text-success'></i></span>
                                <br>
                                <br><p class="text-muted"><i class="fas fa-calendar-day"></i> <?php echo $addeddate; ?></p>
                                <i class="fas fa-phone text-success"><small class="h6 text-primary"> 0347-1041006</small></i>
                                <br>
                                <i class="fab fa-whatsapp text-success"><small class="h6 text-primary"> 0347-1041006</small></i>

                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="callout callout-success">
                                <small class="text-muted">Interested In </small>
                                <br>
                                <span <?php echo $txtcolour; ?>> <?php echo $icon; ?> <b><?php echo $name_categories; ?> </b></span>
                                <br>
                                

                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="callout callout-muted">
                                <small class="text-muted">Cnic </small>
                                <br>
                                <span class="text-muted h4"> <i class="fas fa-map-marker-alt"></i> <b><?php echo $cnic; ?> </b></span>
                                <br>
                                <br>
                                <br><p class="text-muted">Address</p>
                                <span class="text-muted h4"><i class="far fa-address-card"></i> </span>

                            </div>
                        </div>
                    </div>
                    <!--/.row-->
                    <br>
                    <!--/.table-->
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
    <hr class="m-0">
    <?php
    $result = $this->session->flashdata('userdatasavestatus');
    if (!empty($result)) {
        echo '<div class="alert alert-success"><strong>' . $result . '</strong></div>';
    }
    ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-2">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" data-toggle="modal" data-target="#modalMeeting"  class="btn btn-outline-primary btn-sm"><i class="fa fa-plus fa-lg"></i>&nbsp; Add</button>  
                        </div>
                        <div class="card-body">
                            <ul class="reqmenus">
                                <?php
                                foreach ($reqcatemenu as $reqmenu) {
                                    echo '<li><button type="button"  class="open-Meetings btn btn-outline-info btn-sm btn-block ' . $reqmenu['bg_colour'] . '"><i class="' . $reqmenu['class_categories'] . '"></i> ' . $reqmenu['name_categories'] . '</button></li>';
                                }
                                ?>
                            </ul>
                        </div>



                    </div>
                </div>
                <div class="col-sm-10">
                    <div class="card">

                        <div class="card-body">
                            <table class="table table-responsive-sm table-hover table-outline mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Request</th>
                                        <th>Interested In</th>
                                        <th>Location</th>
                                        <th>Exp Date</th>
                                        <th class="text-center">Status</th>
                                        <th>Progress</th>
                                        <th class="text-center"><i class="icon-settings"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
// print_r($clientrequests);
foreach ($clientrequests as $req) {

    $baseurl = base_url();
    $clientid = $this->uri->segment(3);
    
    
    if ($req['updateddate'] == '0000-00-00 00:00:00') {

        $updateddate = '';
    } else {
        $updateddate = $req['updateddate'];
    }

    if ($req['reqstatus'] == 0) {
        $reqstatus = 'Pending';
        $colour = 'pending';
    } elseif ($req['reqstatus'] == 1) {
        $reqstatus = 'Confirmed';
        $colour = 'confirmed';
    } elseif ($req['reqstatus'] == 2) {
        $reqstatus = 'Canceled';
        $colour = 'canceled';
    } elseif ($req['reqstatus'] == 3) {
        $reqstatus = 'Met';
        $colour = 'approved';
    }


    echo '<tr class="' . $req['bgcolour'] . '"><td>' . $req['id_requests'] . '</td>
                                <td class="text-primary"><i class="' . $req['reqclass'] . '"></i><strong> ' . $req['reqcate'] . '</span></strong><br><span class="text-primary small">' . $req['reqdate'] . '</span></td>
                                <td class="text-primary small">' . $req['maincate'] . '<br> -- ' . $req['subcate'] . '<br> --- ' . $req['marla'] . '<br></td>
                                <td class="text-primary small">' . $req['cityname'] . '<br> -- ' . $req['societyname'] . '<br> --- ' . $req['adr'] . '<br></td>
                                <td class="text-primary"><strong>' . $req['dateexp'] . '</strong></td>
                                <td class="text-center"><span class="badge badge-pill badge-' . $colour . '">' . $reqstatus . '</span><div class="text-primary small">' . $updateddate . '</div></td>
                               <td class="text-primary">' . $req['progst'] . '</td>
                                <td class="text-center"><button type="button" class="btn btn-info editbutton"><i class="icon-settings"></i></button> | <a href="'.$baseurl.'office/deleterequest/'.$req['id_requests'].'/'.$clientid.'" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a></td>
                               <td class="hiden">' . $req['reqcateid'] . '</td>
                                </tr>';
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
<!-- Add Meeting ######################################### -->

<div class="modal fade" id="modalMeeting" role="dialog">
    <div class="modal-dialog">
        <form method="post" id="phone_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title float-left"><i class="fa fa-folder-open"></i> Add Phone</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group row">

                        <label class="col-md-3 col-form-label" for="text-input">Category</label>
                        <div class="col-md-4">
                        <?php echo form_dropdown('fk_reqcategories', $drpdwnreqcategories, '', 'data-rel="chosen" id="select" class="form-control"'); ?>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="text-input">Meeting Date</label>
                        <div class="col-md-4">
                            <input type="text" id="text-input" name="exdate_requests" class="form-control" value="<?= date("Y/m/d"); ?>">

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="select">Status</label>
                        <div class="col-md-4">
                            <select id="select" name="status_requests" class="form-control">
                                <option value="0">Pending</option>
                                <option value="1">Confirmed</option>
                                <option value="2">Canceled</option>
                                <option value="3">Met</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="text-input">Progress</label>
                        <div class="col-md-4">
                            <input type="text" id="text-input" name="progress_requests" class="form-control" placeholder="Progress %">

                        </div>
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
        <form method="post" id="editmodal_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title float-left"><i class="fa fa-folder-open"></i> Edit Meeting Data</h4>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="edit_id_requests" id="edit_id_requests">

                    <div class="form-group row">

                        <label class="col-md-3 col-form-label" for="text-input">Category</label>
                        <div class="col-md-4">
<?php echo form_dropdown('edit_fk_reqcategories', $drpdwnreqcategories, '', 'data-rel="chosen" id="reqcate" class="form-control"'); ?>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="text-input">Exp Date</label>
                        <div class="col-md-4">
                            <input type="text" id="exdate_requests" name="exdate_requests" class="form-control">

                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="select">Status</label>
                        <div class="col-md-4">
                            <select id="edit_status_requests" name="status_requests" class="form-control">
                                <option value="0">Pending</option>
                                <option value="1">Confirmed</option>
                                <option value="2">Canceled</option>
                                <option value="3">Met</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="text-input">Progress</label>
                        <div class="col-md-4">
                            <input type="text" id="progress_requests" name="progress_requests" class="form-control" placeholder="Progress %">

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit"  id="updatedata" class="btn btn-primary" >Update</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery.min.js"></script>



<script>

    $(document).on('submit', '#meeting_form', function (event) {
        event.preventDefault();
        var number = $('#fk_reqcategories').val();
        if (number !== '')
        {
            $.ajax({
                url: "<?php echo base_url() . 'office/addrequests' ?>",
                method: 'POST',
                data: new FormData(this),
                contentTye: false,
                processData: false,
                success: function (data)
                {
                    alert(data);
                    $('#meeting_form')[0].reset();
                    $('#modalMeeting').modal('hide');
                    dataTable.ajax.reload();
                }
            });
        } else {
            alert("Put Data");
        }
    });

    $(document).on('click', '.updatedata', function (event) {
        event.preventDefault();
        var number = $('#edit_id_requests').val();
        if (number !== '')
        {
            $.ajax({
                url: "<?php echo base_url() . 'office/addrequests' ?>",
                method: 'POST',
                data: new FormData(this),
                contentTye: false,
                processData: false,
                success: function (data)
                {
                    alert(data);
                    $('#editmodal_form')[0].reset();
                    $('#editmodal').modal('hide');
                    dataTable.ajax.reload();
                }
            });
        } else {
            alert("Put Data");
        }
    });

    /*$(document).on("click", ".open-Meetings", function () {
     var fk_reqcategories = $(this).data('id');
     
     $('#idreqcategory').html(fk_reqcategories);
     $("#fk_reqcategories").val(fk_reqcategories);
     
     });*/


    $(document).ready(function () {
        $('.editbutton').on('click', function () {

            $('#editmodal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);
            if (data[5] === 'Pending') {
                var st = 0;
            } else if (data[5] === 'Confirmed') {
                var st = 1;
            } else if (data[5] === 'Canceled') {
                var st = 2;
            } else {
                var st = 3;
            }
            $('#edit_id_requests').val(data[0]);
            $('#edit_status_requests').val(st);
            $('#progress_requests').val(data[6]);
            $('#exdate_requests').val(data[4]);
            $('#reqcate').val(data[8]);



        });

    });

</script>




