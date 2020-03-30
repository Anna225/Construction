<div class="animated fadeIn">
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-2">
                    <div class="card">

                        <div class="card-body">
                            <?php
                            $this->load->view('backend/pages/office/common/topmenumob');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-10">
                    
                    <div class="row">
                        <div class="col-sm-12">
                        <div class="card">
                             <div class="card-header">
                                    <i class="fa fa-group"></i>
                                    <span>Registered Clients</span>
                            </div>
                            <div class="card-body">
                              <div class="row">

                        <div class="col-sm-6 col-lg-3">
                            <div class="card">
                                <div class="card-block p-0 clearfix">
                                    <i class="far fa-building bg-success p-3 px-5 font-2xl mr-3 float-left"></i>
                                    <div class="h5 mb-0 pt-2 text-center"><?php echo $this->totconstclients; ?></div>
                                    <div class="text-muted text-uppercase font-weight-bold font-xs text-center">Construction</div>
                                </div>
                            </div>
                        </div>
                        <!--/.col-->
                        <div class="col-sm-6 col-lg-3">
                            <div class="card">
                                <div class="card-block p-0 clearfix">
                                    <i class="fas fa-tools bg-orange p-3 px-5 font-2xl mr-3 float-left"></i>
                                    <div class="h5 mb-0 pt-2 text-center"><?php echo $this->totrenovaclients; ?></div>
                                    <div class="text-muted text-uppercase font-weight-bold font-xs text-center">Renovation</div>
                                </div>
                            </div>
                        </div>
                        <!--/.col-->

                        <div class="col-sm-6 col-lg-3">
                            <div class="card">
                                <div class="card-block p-0 clearfix">
                                    <i class="fas fa-shopping-cart bg-primary p-3 px-5 font-2xl mr-3 float-left"></i>
                                    <div class="h5 mb-0 pt-2 text-center"><?php echo $this->totproptyclients; ?></div>
                                    <div class="text-muted text-uppercase font-weight-bold font-xs text-center">Propriety</div>
                                </div>
                            </div>
                        </div>
                        <!--/.col-->
                        <div class="col-sm-6 col-lg-3">
                            <div class="card">
                                <div class="card-block p-0 clearfix">
                                    <i class="fas fa-pencil-ruler bg-danger p-3 px-5 font-2xl mr-3 float-left"></i>
                                    <div class="h5 mb-0 pt-2 text-center"><?php echo $this->totdesigclients; ?></div>
                                    <div class="text-muted text-uppercase font-weight-bold font-xs text-center">Design</div>
                                </div>
                            </div>
                        </div>
                        <!--/.col-->
                    </div>
                        <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                      <div class="col-sm-9">
                                        <canvas id="myChart"></canvas>  
                                        </div>
                                        <div class="col-sm-3">
                                        <span class="text-info text-uppercase font-weight-bold">This Month</span>
                                        <span class="float-right"><i class="fas fa-arrow-circle-up text-success"></i> <span class="text-success font-weight-bold"> 15%</span></span>
                                        <hr>
                                        <div>
                                            <span class="text-muted text-uppercase font-xs text-left textpadding">Construction</span>
                                            <span class="float-right"><i class="fas fa-arrow-circle-up text-success "></i> <span class="text-success font-weight-bold"> 5%</span></span>
                                        </div>
                                        
                                        <div class="text-muted text-uppercase  font-xs text-left textpadding">Renovation</div>
                                        <div class="text-muted text-uppercase  font-xs text-left textpadding">Propriety</div>
                                        <div class="text-muted text-uppercase  font-xs text-left textpadding">Design</div>
                                        <br><br>
                                        <span class="text-info text-uppercase font-weight-bold">Last Month</span>
                                        <hr>
                                        <div class="text-muted text-uppercase  font-xs text-left textpadding">Construction</div>
                                        <div class="text-muted text-uppercase  font-xs text-left textpadding">Renovation</div>
                                        <div class="text-muted text-uppercase  font-xs text-left textpadding">Propriety</div>
                                        <div class="text-muted text-uppercase  font-xs text-left textpadding">Design</div>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                        </div>
                       
                    </div>   
                            </div>
                        
                        </div>
                            </div> 
                    </div>
                    
                    
                    

                </div>

                   


            </div>

        </div>
    </div>
</div>




</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script>

    var cData = JSON.parse(`<?php echo $totclients_chart; ?>`);
    var cData2 = JSON.parse(`<?php echo $totconstclients_chart; ?>`);
    var cData3 = JSON.parse(`<?php echo $totrenvclients_chart; ?>`);
    var cData4 = JSON.parse(`<?php echo $totproptyclients_chart; ?>`);
    var cData5 = JSON.parse(`<?php echo $totdesgclients_chart; ?>`);
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        labels: cData.label,
        type: 'line',

        // The data for our dataset
        data: {
            labels: cData.label,
            datasets: [{
                    label: 'Total',
                    backgroundColor: 'rgba(220,220,220,0.2)',
                    borderColor: 'rgba(0,204,102,0.2)',
                    pointBackgroundColor: 'rgba(220,220,220,1)',
                    pointBorderColor: 'rgba(0,204,102,0.2)',
                    data: cData.data
                },
                {
                    label: 'Construction',
                    backgroundColor: 'rgba(0,102,0,0.1)',
                    borderColor: '#006600',
                    pointBackgroundColor: 'rgba(0,102,0,0.1)',
                    pointBorderColor: '#006600',
                    data: cData2.data
                }
                ,
                {
                    label: 'Renovation',
                    backgroundColor: 'rgba(255,153,0,0.1)',
                    borderColor: '#FF9900',
                    pointBackgroundColor: 'rgba(255,153,0,0.1)',
                    pointBorderColor: '#FF9900',
                    data: cData3.data
                }
                ,
                {
                    label: 'Propriety',
                    backgroundColor: 'rgba(0,0,204,0.1)',
                    borderColor: '#0000CC',
                    pointBackgroundColor: 'rgba(0,0,204,0.1)',
                    pointBorderColor: '##0000CC',
                    data: cData4.data
                }
                ,
                {
                    label: 'Design',
                    backgroundColor: 'rgba(204,0,51,0.1)',
                    borderColor: '#CC0033',
                    pointBackgroundColor: 'rgba(204,0,51,0.1)',
                    pointBorderColor: '#FF9900',
                    data: cData5.data
                }
            ]
        },

        // Configuration options go here
        options: {}
    });
</script>