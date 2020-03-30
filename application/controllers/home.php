<?php

class home extends CI_Controller {

    function __construct() {

        parent::__construct();
        
        
    }

    function index() {

        $raw = array();
        $this->load->view("frontend/pages/home", $raw);
    }
    

}
