<?php

class office extends MY_Controller {

    function __construct() {

        parent::__construct();
        $this->load->model('moffice');
        //$this->load->helper(array('url','html','form'));
        $this->load->model('msetting');
        
        if($this->session->userdata('logged_in') !== TRUE){
            redirect('login');
            }
    }

    // Main Data Functions Start

    function index() {
        
        $raw['reqcatemenu'] = $this->moffice->getReqCategories();
        
        $totalcleints = $this->moffice->countGraficTotalClients();
        $raw['totclients_chart'] = json_encode($totalcleints);
        
        $totalcleintsconst = $this->moffice->countGraficTotalConstClients();
        $raw['totconstclients_chart'] = json_encode($totalcleintsconst);
        
        $totalcleintsren= $this->moffice->countGraficTotalRenovaClients();
        $raw['totrenvclients_chart'] = json_encode($totalcleintsren);
        
        $totalcleintspro= $this->moffice->countGraficTotalProClients();
        $raw['totproptyclients_chart'] = json_encode($totalcleintspro);
        
        $totalcleintsdes= $this->moffice->countGraficTotalDesgClients();
        $raw['totdesgclients_chart'] = json_encode($totalcleintsdes);
        
        
        $this->data['content'] = $this->load->view("backend/pages/office/dashborad", $raw, true);
        $this->load->view("backend/template", $this->data);
    }

   
    
    function categories() {



        // Insert Methods
        if (isset($_POST['name_categories'])) {
            $this->insertofficecategory();
        }
        if (isset($_POST['name_subcategories'])) {

            $this->insertofficesubcategory();
        }


        // DrpDwn Methods
        $drpdwnofficecategories = $this->moffice->getDrpDwnOfficeCategories();
        $raw['drpdwnofficecategories'] = $drpdwnofficecategories;

        // List Methods
        $raw['listofficecategories'] = $this->moffice->getListOfficeCategories();


        $this->data['content'] = $this->load->view("backend/pages/office/categories", $raw, true);

        $this->load->view("backend/template", $this->data);
    }

    function types() {


        // Insert Methods
        if (isset($_POST['name'])) {
            $this->insertofficetypes();
        }

        // List Methods
        $raw['listofficetypes'] = $this->moffice->getListOfficeTypes();


        $this->data['content'] = $this->load->view("backend/pages/office/types", $raw, true);
        $this->load->view("backend/template", $this->data);
    }

    function clients() {

        // Insert Methods
        if (isset($_POST['name_clients'])) {
            $this->insertofficeclients();
        }


        if (isset($_POST['number_phone'])) {
            $this->insertofficeclientsphone();
        }

        // List Methods
        $raw['listofficeclients'] = $this->moffice->getListOfficeClients();
        
        $raw['reqcatemenu'] = $this->moffice->getReqCategories();
        
        // DrpDwn Lists
        $drpdwnofficecategories = $this->moffice->getDrpDwnOfficeCategories();
        $raw['drpdwnofficecategories'] = $drpdwnofficecategories;
        
        $drpdwnofficetypes = $this->moffice->getDrpDwnOfficeTypes();
        $raw['drpdwnofficetypes'] = $drpdwnofficetypes;
        
        $drpdwncities = $this->moffice->getDrpDwnCities();
        $raw['drpdwncities'] = $drpdwncities;

        $this->data['content'] = $this->load->view("backend/pages/office/clients", $raw, true);
        $this->load->view("backend/template", $this->data);
    }

    function requests() {

        
        $seg3 = $this->uri->segment(3);
        $seg4 = $this->uri->segment(4);
        $seg5 = $this->uri->segment(5);
        $seg6 = $this->uri->segment(6);
        
        $raw['liststatuscategories'] = $this->msetting->getListStatusCategories();
        
        // Insert Methods
        if (isset($_POST['fk_clients'])) {
            $this->insertofficerequest();
        }
        
        // Update Methods
        if (isset($_POST['edit_fk_status'])) {
            
            $id = $_POST['edit_req_office_id'];
            $this->updateofficerequests($id);
        }
        
        $raw['reqcatemenu'] = $this->moffice->getReqCategories();
        
        $raw['listofficerequests'] = $this->moffice->getListOfficeRequests($seg3,$seg4,$seg5,$seg6);
        
         $raw['listofficecategories'] = $this->moffice->getMenuListCategories();
        
        
        // DrpDwn Lists
        $drpdwnofficecategories = $this->moffice->getDrpDwnOfficeCategories();
        $raw['drpdwnofficecategories'] = $drpdwnofficecategories;
        
        $drpdwnofficetypes = $this->moffice->getDrpDwnOfficeTypes();
        $raw['drpdwnofficetypes'] = $drpdwnofficetypes;
        
        $drpdwnreqcate = $this->moffice->getDrpDwnReqCategories();
        $raw['drpdwnreqcate'] = $drpdwnreqcate;
        
        $drpdwncities = $this->moffice->getDrpDwnCities();
        $raw['drpdwncities'] = $drpdwncities;
        
        $drpdwnstatuscate = $this->moffice->getDrpDwnStatusCategories();
        $raw['drpdwnstatuscate'] = $drpdwnstatuscate;
        
        
        
        $this->data['content'] = $this->load->view("backend/pages/office/requests", $raw, true);
        $this->load->view("backend/template", $this->data);
    }

    function addrequests(){
        $id = $this->uri->segment(3);
        
        // Insert Methods
        if (isset($_POST['fk_reqcategories'])) {
            $this->insertrequests($id);
        }
        
        // Update Methods
        if (isset($_POST['edit_id_requests'])) {
            $this->updaterequests($id);
        }
        
        $raw['clientprofiledata']=$this->moffice->getClientProfileData($id);
        
        $raw['clientrequests'] = $this->moffice->getClientRequests($id);
        
        $drpdwnreqcategories = $this->moffice->getDrpDwnReqCategories();
        $raw['drpdwnreqcategories'] = $drpdwnreqcategories;
        
        $raw['reqcatemenu'] = $this->moffice->getReqCategories();
        
        $this->data['content'] = $this->load->view("backend/pages/office/requests/add", $raw, true);
        $this->load->view("backend/template", $this->data); 
    }
    
    function quotations() {

        $seg1 = $this->uri->segment(1);
        $seg2 = $this->uri->segment(2);
        $byurl = "$seg1/$seg2";
        $seg3 = $this->uri->segment(3);
        $seg4 = $this->uri->segment(4);
        $seg5 = $this->uri->segment(5);
        $seg6 = $this->uri->segment(6);
        
        $raw['liststatuscategories'] = $this->msetting->getListStatusCategoriesByID($byurl);
        
        // Insert Methods
        if (isset($_POST['fk_clients'])) {
            $this->insertofficerequest();
        }
        
        // Update Methods
        if (isset($_POST['edit_fk_status'])) {
            
            $id = $_POST['edit_req_office_id'];
            $this->updateofficerequests($id);
        }
        
        $raw['reqcatemenu'] = $this->moffice->getReqCategories();
        
        $raw['listofficerequests'] = $this->moffice->getListQuotaionsRequests($seg2,$seg3,$seg4,$seg5,$seg6);
        
         $raw['listofficecategories'] = $this->moffice->getMenuListCategories();
        
        
        // DrpDwn Lists
        $drpdwnofficecategories = $this->moffice->getDrpDwnOfficeCategories();
        $raw['drpdwnofficecategories'] = $drpdwnofficecategories;
        
        $drpdwnofficetypes = $this->moffice->getDrpDwnOfficeTypes();
        $raw['drpdwnofficetypes'] = $drpdwnofficetypes;
        
        $drpdwnreqcate = $this->moffice->getDrpDwnReqCategories();
        $raw['drpdwnreqcate'] = $drpdwnreqcate;
        
        $drpdwncities = $this->moffice->getDrpDwnCities();
        $raw['drpdwncities'] = $drpdwncities;
        
        $drpdwnstatuscate = $this->moffice->getDrpDwnStatusCategories();
        $raw['drpdwnstatuscate'] = $drpdwnstatuscate;
        
        
        
        $this->data['content'] = $this->load->view("backend/pages/office/quotations", $raw, true);
        $this->load->view("backend/template", $this->data);
    }
    
    function meetings() {

        
         $seg1 = $this->uri->segment(1);
        $seg2 = $this->uri->segment(2);
        $byurl = "$seg1/$seg2";
        $seg3 = $this->uri->segment(3);
        $seg4 = $this->uri->segment(4);
        $seg5 = $this->uri->segment(5);
        $seg6 = $this->uri->segment(6);
        
        $raw['liststatuscategories'] = $this->msetting->getListStatusCategoriesByID($byurl);
        
        // Insert Methods
        if (isset($_POST['fk_clients'])) {
            $this->insertofficerequest();
        }
        
        // Update Methods
        if (isset($_POST['edit_fk_status'])) {
            
            $id = $_POST['edit_req_office_id'];
            $this->updateofficerequests($id);
        }
        
        $raw['reqcatemenu'] = $this->moffice->getReqCategories();
        
        $raw['listofficerequests'] = $this->moffice->getListQuotaionsRequests($seg2,$seg3,$seg4,$seg5,$seg6);
        
         $raw['listofficecategories'] = $this->moffice->getMenuListCategories();
        
        
        // DrpDwn Lists
        $drpdwnofficecategories = $this->moffice->getDrpDwnOfficeCategories();
        $raw['drpdwnofficecategories'] = $drpdwnofficecategories;
        
        $drpdwnofficetypes = $this->moffice->getDrpDwnOfficeTypes();
        $raw['drpdwnofficetypes'] = $drpdwnofficetypes;
        
        $drpdwnreqcate = $this->moffice->getDrpDwnReqCategories();
        $raw['drpdwnreqcate'] = $drpdwnreqcate;
        
        $drpdwncities = $this->moffice->getDrpDwnCities();
        $raw['drpdwncities'] = $drpdwncities;
        
        $drpdwnstatuscate = $this->moffice->getDrpDwnStatusCategories();
        $raw['drpdwnstatuscate'] = $drpdwnstatuscate;
        
        
        
        $this->data['content'] = $this->load->view("backend/pages/office/meetings", $raw, true);
        $this->load->view("backend/template", $this->data);
    }

    function drawings() {

        
         $seg1 = $this->uri->segment(1);
        $seg2 = $this->uri->segment(2);
        $byurl = "$seg1/$seg2";
        $seg3 = $this->uri->segment(3);
        $seg4 = $this->uri->segment(4);
        $seg5 = $this->uri->segment(5);
        $seg6 = $this->uri->segment(6);
        
        $raw['liststatuscategories'] = $this->msetting->getListStatusCategoriesByID($byurl);
        
        // Insert Methods
        if (isset($_POST['fk_clients'])) {
            $this->insertofficerequest();
        }
        
        // Update Methods
        if (isset($_POST['edit_fk_status'])) {
            
            $id = $_POST['edit_req_office_id'];
            $this->updateofficerequests($id);
        }
        
        $raw['reqcatemenu'] = $this->moffice->getReqCategories();
        
        $raw['listofficerequests'] = $this->moffice->getListQuotaionsRequests($seg2,$seg3,$seg4,$seg5,$seg6);
        
         $raw['listofficecategories'] = $this->moffice->getMenuListCategories();
        
        
        // DrpDwn Lists
        $drpdwnofficecategories = $this->moffice->getDrpDwnOfficeCategories();
        $raw['drpdwnofficecategories'] = $drpdwnofficecategories;
        
        $drpdwnofficetypes = $this->moffice->getDrpDwnOfficeTypes();
        $raw['drpdwnofficetypes'] = $drpdwnofficetypes;
        
        $drpdwnreqcate = $this->moffice->getDrpDwnReqCategories();
        $raw['drpdwnreqcate'] = $drpdwnreqcate;
        
        $drpdwncities = $this->moffice->getDrpDwnCities();
        $raw['drpdwncities'] = $drpdwncities;
        
        $drpdwnstatuscate = $this->moffice->getDrpDwnStatusCategories();
        $raw['drpdwnstatuscate'] = $drpdwnstatuscate;
        
        
        
        $this->data['content'] = $this->load->view("backend/pages/office/drawings", $raw, true);
        $this->load->view("backend/template", $this->data);
    }
    
    function calls() {

        
        $seg1 = $this->uri->segment(1);
        $seg2 = $this->uri->segment(2);
        $byurl = "$seg1/$seg2";
        $seg3 = $this->uri->segment(3);
        $seg4 = $this->uri->segment(4);
        $seg5 = $this->uri->segment(5);
        $seg6 = $this->uri->segment(6);
        
        $raw['liststatuscategories'] = $this->msetting->getListStatusCategoriesByID($byurl);
        
        // Insert Methods
        if (isset($_POST['fk_clients'])) {
            $this->insertofficerequest();
        }
        
        // Update Methods
        if (isset($_POST['edit_fk_status'])) {
            
            $id = $_POST['edit_req_office_id'];
            $this->updateofficerequests($id);
        }
        
        $raw['reqcatemenu'] = $this->moffice->getReqCategories();
        
        $raw['listofficerequests'] = $this->moffice->getListQuotaionsRequests($seg2,$seg3,$seg4,$seg5,$seg6);
        
         $raw['listofficecategories'] = $this->moffice->getMenuListCategories();
        
        
        // DrpDwn Lists
        $drpdwnofficecategories = $this->moffice->getDrpDwnOfficeCategories();
        $raw['drpdwnofficecategories'] = $drpdwnofficecategories;
        
        $drpdwnofficetypes = $this->moffice->getDrpDwnOfficeTypes();
        $raw['drpdwnofficetypes'] = $drpdwnofficetypes;
        
        $drpdwnreqcate = $this->moffice->getDrpDwnReqCategories();
        $raw['drpdwnreqcate'] = $drpdwnreqcate;
        
        $drpdwncities = $this->moffice->getDrpDwnCities();
        $raw['drpdwncities'] = $drpdwncities;
        
        $drpdwnstatuscate = $this->moffice->getDrpDwnStatusCategories();
        $raw['drpdwnstatuscate'] = $drpdwnstatuscate;
        
        
        
        $this->data['content'] = $this->load->view("backend/pages/office/calls", $raw, true);
        $this->load->view("backend/template", $this->data);
    }
    
    function visits() {

        
         $seg1 = $this->uri->segment(1);
        $seg2 = $this->uri->segment(2);
        $byurl = "$seg1/$seg2";
        $seg3 = $this->uri->segment(3);
        $seg4 = $this->uri->segment(4);
        $seg5 = $this->uri->segment(5);
        $seg6 = $this->uri->segment(6);
        
        $raw['liststatuscategories'] = $this->msetting->getListStatusCategoriesByID($byurl);
        
        // Insert Methods
        if (isset($_POST['fk_clients'])) {
            $this->insertofficerequest();
        }
        
        // Update Methods
        if (isset($_POST['edit_fk_status'])) {
            
            $id = $_POST['edit_req_office_id'];
            $this->updateofficerequests($id);
        }
        
        $raw['reqcatemenu'] = $this->moffice->getReqCategories();
        
        $raw['listofficerequests'] = $this->moffice->getListQuotaionsRequests($seg2,$seg3,$seg4,$seg5,$seg6);
        
         $raw['listofficecategories'] = $this->moffice->getMenuListCategories();
        
        
        // DrpDwn Lists
        $drpdwnofficecategories = $this->moffice->getDrpDwnOfficeCategories();
        $raw['drpdwnofficecategories'] = $drpdwnofficecategories;
        
        $drpdwnofficetypes = $this->moffice->getDrpDwnOfficeTypes();
        $raw['drpdwnofficetypes'] = $drpdwnofficetypes;
        
        $drpdwnreqcate = $this->moffice->getDrpDwnReqCategories();
        $raw['drpdwnreqcate'] = $drpdwnreqcate;
        
        $drpdwncities = $this->moffice->getDrpDwnCities();
        $raw['drpdwncities'] = $drpdwncities;
        
        $drpdwnstatuscate = $this->moffice->getDrpDwnStatusCategories();
        $raw['drpdwnstatuscate'] = $drpdwnstatuscate;
        
        
        
        $this->data['content'] = $this->load->view("backend/pages/office/visits", $raw, true);
        $this->load->view("backend/template", $this->data);
    }
    
    function buysale() {

        
         $seg1 = $this->uri->segment(1);
        $seg2 = $this->uri->segment(2);
        $byurl = "$seg1/$seg2";
        $seg3 = $this->uri->segment(3);
        $seg4 = $this->uri->segment(4);
        $seg5 = $this->uri->segment(5);
        $seg6 = $this->uri->segment(6);
        
        $raw['liststatuscategories'] = $this->msetting->getListStatusCategoriesByID($byurl);
        
        // Insert Methods
        if (isset($_POST['fk_clients'])) {
            $this->insertofficerequest();
        }
        
        // Update Methods
        if (isset($_POST['edit_fk_status'])) {
            
            $id = $_POST['edit_req_office_id'];
            $this->updateofficerequests($id);
        }
        
        $raw['reqcatemenu'] = $this->moffice->getReqCategories();
        
        $raw['listofficerequests'] = $this->moffice->getListQuotaionsRequests($seg2,$seg3,$seg4,$seg5,$seg6);
        
         $raw['listofficecategories'] = $this->moffice->getMenuListCategories();
        
        
        // DrpDwn Lists
        $drpdwnofficecategories = $this->moffice->getDrpDwnOfficeCategories();
        $raw['drpdwnofficecategories'] = $drpdwnofficecategories;
        
        $drpdwnofficetypes = $this->moffice->getDrpDwnOfficeTypes();
        $raw['drpdwnofficetypes'] = $drpdwnofficetypes;
        
        $drpdwnreqcate = $this->moffice->getDrpDwnReqCategories();
        $raw['drpdwnreqcate'] = $drpdwnreqcate;
        
        $drpdwncities = $this->moffice->getDrpDwnCities();
        $raw['drpdwncities'] = $drpdwncities;
        
        $drpdwnstatuscate = $this->moffice->getDrpDwnStatusCategories();
        $raw['drpdwnstatuscate'] = $drpdwnstatuscate;
        
        
        
        $this->data['content'] = $this->load->view("backend/pages/office/buysale", $raw, true);
        $this->load->view("backend/template", $this->data);
    }
    
    function tasks() {

        
        $seg1 = $this->uri->segment(1);
        $seg2 = $this->uri->segment(2);
        $byurl = "$seg1/$seg2";
        $seg3 = $this->uri->segment(3);
        $seg4 = $this->uri->segment(4);
        $seg5 = $this->uri->segment(5);
        $seg6 = $this->uri->segment(6);
        
        $raw['liststatuscategories'] = $this->msetting->getListStatusCategoriesByID($byurl);
        
        // Insert Methods
        if (isset($_POST['fk_clients'])) {
            $this->insertofficerequest();
        }
        
        // Update Methods
        if (isset($_POST['edit_fk_status'])) {
            
            $id = $_POST['edit_req_office_id'];
            $this->updateofficerequests($id);
        }
        
        $raw['reqcatemenu'] = $this->moffice->getReqCategories();
        
        $raw['listofficerequests'] = $this->moffice->getListQuotaionsRequests($seg2,$seg3,$seg4,$seg5,$seg6);
        
         $raw['listofficecategories'] = $this->moffice->getMenuListCategories();
        
        
        // DrpDwn Lists
        $drpdwnofficecategories = $this->moffice->getDrpDwnOfficeCategories();
        $raw['drpdwnofficecategories'] = $drpdwnofficecategories;
        
        $drpdwnofficetypes = $this->moffice->getDrpDwnOfficeTypes();
        $raw['drpdwnofficetypes'] = $drpdwnofficetypes;
        
        $drpdwnreqcate = $this->moffice->getDrpDwnReqCategories();
        $raw['drpdwnreqcate'] = $drpdwnreqcate;
        
        $drpdwncities = $this->moffice->getDrpDwnCities();
        $raw['drpdwncities'] = $drpdwncities;
        
        $drpdwnstatuscate = $this->moffice->getDrpDwnStatusCategories();
        $raw['drpdwnstatuscate'] = $drpdwnstatuscate;
        
        
        
        $this->data['content'] = $this->load->view("backend/pages/office/tasks", $raw, true);
        $this->load->view("backend/template", $this->data);
    }
    
    function alerts() {

        
        $seg1 = $this->uri->segment(1);
        $seg2 = $this->uri->segment(2);
        $byurl = "$seg1/$seg2";
        $seg3 = $this->uri->segment(3);
        $seg4 = $this->uri->segment(4);
        $raw['liststatuscategories'] = $this->msetting->getListStatusCategoriesByID($byurl);
        
        // Insert Methods
        if (isset($_POST['fk_clients'])) {
            $this->insertofficerequest();
        }
        
        // Update Methods
        if (isset($_POST['edit_fk_status'])) {
            
            $id = $_POST['edit_req_office_id'];
            $this->updateofficerequests($id);
        }
        
        $raw['reqcatemenu'] = $this->moffice->getReqCategories();
        
        $raw['listofficerequests'] = $this->moffice->getListOfficeRequests($seg3,$seg4);
        
         $raw['listofficecategories'] = $this->moffice->getMenuListCategories();
        
        
        // DrpDwn Lists
        $drpdwnofficecategories = $this->moffice->getDrpDwnOfficeCategories();
        $raw['drpdwnofficecategories'] = $drpdwnofficecategories;
        
        $drpdwnofficetypes = $this->moffice->getDrpDwnOfficeTypes();
        $raw['drpdwnofficetypes'] = $drpdwnofficetypes;
        
        $drpdwnreqcate = $this->moffice->getDrpDwnReqCategories();
        $raw['drpdwnreqcate'] = $drpdwnreqcate;
        
        $drpdwncities = $this->moffice->getDrpDwnCities();
        $raw['drpdwncities'] = $drpdwncities;
        
        $drpdwnstatuscate = $this->moffice->getDrpDwnStatusCategories();
        $raw['drpdwnstatuscate'] = $drpdwnstatuscate;
        
        
        
        $this->data['content'] = $this->load->view("backend/pages/office/requests", $raw, true);
        $this->load->view("backend/template", $this->data);
    }

   

    // Main Functions Ended !
    // Insert Data Functions Start
    function insertofficecategory() {
        $insert_data = array(
            'name_categories' => $this->input->post("name_categories"),
            'status_categories' => $this->input->post("status_categories"),
            'orderby_categories' => $this->input->post("orderby_categories")
        );

        $this->moffice->InsertOfficeCategories($insert_data);
        $results = "Data Inserted";
        $this->session->set_flashdata('userdatasavestatus', $results);
    }

    function insertofficesubcategory() {

        $insert_data = array(
            'name_subcategories' => $this->input->post("name_subcategories"),
            'status_subcategories' => $this->input->post("status_subcategories"),
            'orderby_subcategories' => $this->input->post("orderby_subcategories"),
            'fk_office_categories' => $this->input->post("fk_office_categories"),
        );

        $this->moffice->InsertOfficeSubCategoires($insert_data);
        $results = "Sub Category Data Inserted";
        $this->session->set_flashdata('userdatasavestatus', $results);
    }

    function insertofficetypes() {
        $insert_data = array(
            'name' => $this->input->post("name"),
            'status' => $this->input->post("status"),
            'orderby' => $this->input->post("orderby")
        );

        $this->moffice->InsertOfficeTypes($insert_data);
        $results = "Data Inserted";
        $this->session->set_flashdata('userdatasavestatus', $results);
    }

    function insertofficeclients() {
        $date = date("Y-m-d");
        
        $cleanphone = $this->input->post("phone_clients");
        $cleanphone = str_replace('-', '', $cleanphone);
        $finalphone = preg_replace('/[^A-Za-z0-9\-]/', '', $cleanphone);
         
        $insert_data = array(
            'name_clients' => $this->input->post("name_clients"),
            'fk_categories' => $this->input->post("fk_categories"),
            'cnic_clients' => $this->input->post("cnic_clients"),
            'refby_clients' => $this->input->post("refby_clients"),
            'fk_status' => $this->input->post("fk_status"),
            'phone_clients' => $finalphone,
            'date_clients' => $date
            
        );
        
       $results = $this->moffice->InsertOfficeClients($insert_data);
        
        $this->session->set_flashdata('userdatasavestatus', $results);
    }

    function insertofficerequest(){
        $date = date("Y-m-d");
        
        $insert_data = array(
            'fk_office_subcategories' => $this->input->post("fk_office_subcategories"),
            'fk_office_clients' => $this->input->post("fk_clients"),
            'fk_office_types' => $this->input->post("fk_office_types"),
            'fk_city' => $this->input->post("fk_city"),
            'fk_society' => $this->input->post("fk_societies"),
            'address_clients' => $this->input->post("address_clients"),
            'fk_status' => $this->input->post("fk_status"),
            'note' => $this->input->post("note"),
            'fk_reqcategory' => $this->input->post("fk_reqcategory"),
            'date_requests' => $date
            
        );
        
        $this->moffice->InsertOfficeRequests($insert_data);
        $results = "Data Inserted";
        $this->session->set_flashdata('userdatasavestatus', $results);
        
    }
    
    function insertrequests($id){
    
        $date = date("Y-m-d");
        $insert_data = array(
            'fk_office_clients' => $id,
            'fk_reqcategories' => $this->input->post("fk_reqcategories"),
            'exdate_requests' => $this->input->post("exdate_requests"),
            'status_requests' => $this->input->post("status_requests"),
            'progress_requests' => $this->input->post("progress_requests"),
            'date_requests' => $date
            
        );
        
        $this->moffice->InsertRequests($insert_data);
        $results = "Data Inserted";
        $this->session->set_flashdata('userdatasavestatus', $results);
        
    }
    function insertofficeclientsphone() {
        $insert_data = array(
            'number_phone' => $this->input->post("number_phone"),
            'type_phone' => $this->input->post("type_phone"),
            'fk_office_clients' => $this->input->post("fk_office_clients")
        );

        $this->moffice->InsertOfficeClientsPhones($insert_data);
        $results = "Office Clients Phone Number Added!";
        $this->session->set_flashdata('userdatasavestatus', $results);
    }

    // Insert Data Functions Ended !
    // Update Data Function Start
    
    function updaterequests($id){
        
        $reqid =  $this->input->post('edit_id_requests');
        $record=array(
            'progress_requests' => $this->input->post('progress_requests'),
            'status_requests' => $this->input->post('status_requests'),
            'exdate_requests' => $this->input->post('exdate_requests')
            
            
                );
        
        
        $this->db->where('id_requests',$reqid);	
        $this->db->update('requests', $record);
        
        $results = "Data Updated";
        $this->session->set_flashdata('userdatasavestatus', $results);
        
        redirect("office/addrequests/$id", 'refresh');
        
    }
    
    function updateofficerequests($id){
        
       $status =  $this->input->post('edit_fk_status');
       if($status == 0 || $status == NULL)
       {
          $status = 1; 
       }
        $record=array(
            'fk_status' => $status,
            'byteam' => $this->input->post('byteam'),
            'note' => $this->input->post('edit_note')
            );
        
        
        $this->db->where('id_requests',$id);	
        $this->db->update('office_requests', $record);
        
        $results = "Data Updated";
        $this->session->set_flashdata('userdatasavestatus', $results);
        
        redirect($_SERVER['HTTP_REFERER'], 'refresh');
        
    }
    
    // Update Data Functions Ended !
    // Delete Data Functions Start

    function deleterequest(){
      $requestid = $this->uri->segment(3);
      
      
        $result = $this->moffice->DeleteRequests($requestid);
        $this->session->set_flashdata('userdatasavestatus', $result);
        redirect("office/requests", 'refresh');
    }
            
    function deleteofficecategories() {
        $id = $this->uri->segment(3);
        $result = $this->moffice->DeleteOfficeCategories($id);
        $this->session->set_flashdata('userdatasavestatus', $result);
        redirect('office/categories', 'refresh');
    }

    function deleteofficesubcategories() {
        $id = $this->uri->segment(3);
        $result = $this->moffice->DeleteOfficeSubCategories($id);
        $this->session->set_flashdata('userdatasavestatus', $result);
        redirect('office/categories', 'refresh');
    }

    function deleteofficetypes() {
        $id = $this->uri->segment(3);
        $result = $this->moffice->DeleteOfficeTypes($id);
        $this->session->set_flashdata('userdatasavestatus', $result);
        redirect('office/types', 'refresh');
    }

    function deleteofficeclients() {

        $id = $this->uri->segment(3);
        $this->moffice->DeletePhoneNumbers($id);
        $result = $this->moffice->DeleteOfficeClients($id);
        
        $this->session->set_flashdata('userdatasavestatus', $result);
        redirect('office/clients', 'refresh');
    }

    // Delete Data Functions Ended !    
}
