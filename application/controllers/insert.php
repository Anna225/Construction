<?php

class insert extends CI_Controller {

    function __construct() {

        parent::__construct();
        $this->load->model('madmin');
        if($this->session->userdata('logged_in') !== TRUE){
            redirect('login');
            }
    }

    function index() {

        print_r($_POST());
    }
    
    function office() {

        $raw = array();
        $this->data['content'] = $this->load->view("backend/pages/office/dashborad", $raw, true);
        $this->load->view("backend/template", $this->data);
    }
    
    function officecategories()
    {
        //$categories = $this->madmin->LoadOfficeCategories();
        //$raw['officecategorieslist'] = $categories;
        
        $raw['categories'] = $this->madmin->get_categories();
       

        $this->data['content'] = $this->load->view("backend/pages/office/categories", $raw, true);
        $this->load->view("backend/template", $this->data);
    }

}
