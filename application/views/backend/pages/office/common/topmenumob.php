<ul class="reqmenus">
    <?php
    $baseurl = base_url();
    foreach ($reqcatemenu as $reqmenu) {

        
        $reqcateid = $reqmenu['id_categories'];
        $countallrequests = $this->moffice->countAllRequests();
        $countpending = $this->moffice->countAllPendingReq($reqcateid);
        $countconfirmed = $this->moffice->countAllConfirmedReq($reqcateid);
        $countprogress = $this->moffice->countAllProgressReq($reqcateid);
        $countdealing = $this->moffice->countAllDealingReq($reqcateid);
        $countmaking = $this->moffice->countAllMakingReq($reqcateid);
        $countwaiting = $this->moffice->countAllWaitingReq($reqcateid);
        
        
        if ($reqmenu['show_counter'] == 1) {
            
            if($reqcateid == 8){
                
             $finalcounter =  $countallrequests[0]->tot;  
            
             
            }
            else{
                
            $finalcounter = array_sum([$countpending[0]->tot , $countconfirmed[0]->tot , $countprogress[0]->tot , $countdealing[0]->tot , $countmaking[0]->tot , $countwaiting[0]->tot]);
            
            
            }
            if($finalcounter == 0)
            {
              $showcounter = '';  
            }
            else{
             $showcounter = '<span class="counter">' . $finalcounter . '</span>';   
            }
            
        
            
        } else {
            $showcounter = '';
        }

        echo '<li><a class="open-Meetings btn btn-outline-info btn-sm btn-block font-weight-bold" href="' . $baseurl . '' . $reqmenu['url_categories'] . '"><i class="' . $reqmenu['class_categories'] . '"></i> ' . $reqmenu['name_categories'] . ' ' . $showcounter . '</a></li>';
    }
    ?>
</ul>
