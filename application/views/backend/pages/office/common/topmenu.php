<div class="row">
        <div class="col-lg-12">
            <div class="topmenu">
             <div class="card">
                <div class="card-body">
                    <div class="smallmenu col-lg-1 col-md-2 col-xs-6">
                        <a class="quick-button small" href="<?php echo base_url(); ?>office">
                            <i class="icon-speedometer"></i>
                            <p>Dashboard</p>
                        </a>
                    </div>
                    
                    <div class="smallmenu col-lg-1 col-md-2 col-xs-6">
                        <a class="quick-button small includer" href="<?php echo base_url(); ?>office/clients">
                            <i class="fa fa-group"></i>
                            <p>Clients</p>
                            <span class="badge badgerouaded badge-success"><?php echo $this->totclients; ?></span>
                        </a>
                    </div>
                    <div class="smallmenu col-lg-1 col-md-2 col-xs-6">
                        <a class="quick-button small" href="<?php echo base_url(); ?>office/requests">
                            <i class="fa fa-envelope"></i>
                            <p>Requests</p>
                            <span class="badge badgerouaded badge-danger"><?php echo $this->totpendingrequests; ?></span>
                        </a>
                    </div>
                    

                    <div class="smallmenu col-lg-1 col-md-2 col-xs-6">
                        <a class="quick-button small" href="<?php echo base_url(); ?>office/meetings">
                            <i class="fa fa-calendar-check-o"></i>
                            <p>Meetings</p>
                        </a>
                    </div>

                    <div class="smallmenu col-lg-1 col-md-2 col-xs-6">
                        <a class="quick-button small" href="<?php echo base_url(); ?>office/quotations">
                            <i class="fa fa-table"></i>
                            <p>Quotations</p>
                        </a>
                    </div>
                    
                    <div class="smallmenu col-lg-1 col-md-2 col-xs-6">
                        <a class="quick-button small" href="<?php echo base_url(); ?>office/buysale">
                            <i class="fa fa-cart-plus"></i>
                            <p>Buy & Sale</p>
                        </a>
                    </div>

                    <div class="smallmenu col-lg-1 col-md-2 col-xs-6">
                        <a class="quick-button small" href="<?php echo base_url(); ?>office/calls">
                            <i class="fa fa-phone"></i>
                            <p>Calls</p>
                        </a>
                    </div>
                    <div class="smallmenu col-lg-1 col-md-2 col-xs-6">
                        <a class="quick-button small" href="<?php echo base_url(); ?>office/tasks">
                            <i class="fa fa-tasks"></i>
                            <p>Tasks</p>
                        </a>
                    </div>
                    <div class="smallmenu col-lg-1 col-md-2 col-xs-6">
                        <a class="quick-button small" href="<?php echo base_url(); ?>office/alerts">
                            <i class="fa fa-bullhorn"></i>
                            <p>Alerts</p>
                        </a>
                    </div>
                    <div class="smallmenu col-lg-1 col-md-2 col-xs-6">
                        <a class="quick-button small" href="<?php echo base_url(); ?>office/pending">
                            <i class="fa fa-spinner"></i>
                            <p>Pending</p>
                        </a>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>   
            </div>
            
        </div>
    </div>