<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mglobal extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    // List

    
    
    function countTotalClients(){
    $sql = "SELECT count(*) as totalclients FROM office_clients";    
    $query = $this->db->query($sql)->result();    
    return $query;
    }

    function countTotConstClients(){
       $sql = "select count(*) as totconstclients
                from office_clients oc join office_categories ct
                where ct.id_categories = oc.fk_categories
                and ct.id_categories = 1";    
    $query = $this->db->query($sql)->result();    
    return $query;
    }
    
    
    
    function countTotRenvClients(){
        $sql = "select count(*) as totrenovaclients
                from office_clients oc join office_categories ct
                where ct.id_categories = oc.fk_categories
                and ct.id_categories = 2";    
    $query = $this->db->query($sql)->result();    
    return $query;
    }
    
    function countTotDesignClients(){
        $sql = "select count(*) as totdesignclients
                from office_clients oc join office_categories ct
                where ct.id_categories = oc.fk_categories
                and ct.id_categories = 3";    
    $query = $this->db->query($sql)->result();    
    return $query;
    }
    
    function countTotPropClients(){
        $sql = "select count(*) as totpropclients
                from office_clients oc join office_categories ct
                where ct.id_categories = oc.fk_categories
                and ct.id_categories = 4";    
    $query = $this->db->query($sql)->result();    
    return $query;
    }
    
    function countTotPendingRequests(){
      $sql = "select count(*) as pendingrequests from office_requests where fk_status = 0";    
    $query = $this->db->query($sql)->result();    
    return $query;
    }
    
    
    function countTotalCountries(){
       $sql = "select count(*) as totcountries from countries";    
    $query = $this->db->query($sql)->result();    
    return $query;  
        
    }
    
    function countTotalCities(){
        $sql = "select count(*) as totcities from cities";    
    $query = $this->db->query($sql)->result();    
    return $query; 
        
    }
    
     function countTotalSocieties(){
        $sql = "select count(*) as totsocieties from societies";    
    $query = $this->db->query($sql)->result();    
    return $query; 
        
    }
}
