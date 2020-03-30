<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller 
{
    public $totclients = "";

    public function __construct()
    {
        parent::__construct();

        $this->load->model('mglobal');
       
        $totalclients =  $this->mglobal->countTotalClients();
        $this->totclients = $totalclients[0]->totalclients;
        
        $totconstclients = $this->mglobal->countTotConstClients();
        $this->totconstclients = $totconstclients[0]->totconstclients;
        
        $totdesignclients = $this->mglobal->countTotDesignClients();
        $this->totdesigclients = $totdesignclients[0]->totdesignclients;
        
        $totrenovaclients = $this->mglobal->countTotRenvClients();
        $this->totrenovaclients = $totrenovaclients[0]->totrenovaclients;
        
        $totpropclients = $this->mglobal->countTotPropClients();
        $this->totproptyclients = $totpropclients[0]->totpropclients;
        
        $totpendingrequests = $this->mglobal->countTotPendingRequests();
        $this->totpendingrequests = $totpendingrequests[0]->pendingrequests;
        
        $totcountries = $this->mglobal->countTotalCountries();
        $this->totcountires = $totcountries[0]->totcountries;
        
        $totcities = $this->mglobal->countTotalCities();
        $this->totcities = $totcities[0]->totcities;
        
        $totsocieties = $this->mglobal->countTotalSocieties();
        $this->totsocieties = $totsocieties[0]->totsocieties;
        
        
        
        
        
    }

   
}

