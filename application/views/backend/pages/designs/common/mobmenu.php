<div class="row">
    <div class="col-md-12 leftmenu">
        <button type="button" data-toggle="modal" data-target="#addDesignMenuModal" class="btn btn-outline-muted btn-sm"><i class="fa fa-plus"></i></button> 
        <hr>
        <nav class="navbar navbar-expand-md navbar-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#topnavbar" aria-controls="topnavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="topnavbar" class="collapse navbar-collapse settingmenu ">
                <ul id="menu-main-menu" class="navbar-nav flex-column">
                    <?php
                    $baseurl = base_url();
                    
                     $activeurl = $this->uri->segment(2); 
                    
                     $setmenus = mobilemenu($activeurl);
                    
                    foreach ($setmenus as $menu) {
                        $url =  $menu->url;
                        $finalurl = substr($url, strpos($url, "/") + 1);
                        
                        if($activeurl == $finalurl){
                           
                            $fontcolor = 'class="bg-primary "';
                            $txtcolor = 'class="text-white font-weight-bold"';
                        }
                       
                        else{
                            $fontcolor = '';
                            $txtcolor = '';
                        }
                        
                        echo '<li '.$fontcolor.' style="text-transform: capitalize;"><a href="'.$baseurl.'' . $menu->url . '" '.$txtcolor.'><i class="' . $menu->icon . '"></i> ' . $menu->name . '</a></li>';
                    }
                    ?>
                </ul>

            </div>
        </nav>
    </div>
</div>