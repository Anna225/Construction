<?php

class setting extends MY_Controller {

    
    function __construct() {

        parent::__construct();
        $this->load->model('msetting');
        //$this->load->model('msetting');
        $this->load->helper('gloabls');
        
        if($this->session->userdata('logged_in') !== TRUE){
            redirect('login');
            }
      
    }

    // Main Data Functions Start

    function index() {

        $raw = array();
        // Insert Methods
        if (isset($_POST['name_categories'])) {
            $this->insertcategory();
        }
        if (isset($_POST['name_subcategories'])) {

            $this->insertsubcategory();
        }
        
        $this->data['content'] = $this->load->view("backend/pages/setting/dashborad", $raw, true);
        $this->load->view("backend/template", $this->data);
    }

    function categories() {

        // Insert Methods
        if (isset($_POST['name_categories'])) {
            $this->insertcategory();
        }
        if (isset($_POST['name_subcategories'])) {

            $this->insertsubcategory();
        }


        // DrpDwn Methods
        $drpdwnofficecategories = $this->msetting->getDrpDwnCategories();
        $raw['drpdwnofficecategories'] = $drpdwnofficecategories;

        // List Methods
        $raw['listofficecategories'] = $this->msetting->getListCategories();


        $this->data['content'] = $this->load->view("backend/pages/setting/categories", $raw, true);

        $this->load->view("backend/template", $this->data);
    }

    function designcategories() {

        // Insert Methods
        if (isset($_POST['name_categories'])) {
            $this->insertdesigncategory();
        }
        if (isset($_POST['name_subcategories'])) {

            $this->insertdesignsubcategory();
        }
        // DrpDwn Methods
        $drpdwndesigncategories = $this->msetting->getDrpDwnDesignCategories();
        $raw['drpdwnDesignCategories'] = $drpdwndesigncategories;
        $categorieslist = $this->msetting->getDrpDwnCategoriesList();
        $raw['categorieslist'] = $categorieslist;
        $raw['listDesignCategories'] = $this->msetting->getListDesignCategories();
        $this->data['content'] = $this->load->view("backend/pages/setting/designcategories", $raw, true);
        $this->load->view("backend/template", $this->data);
    }

    function types() {


        // Insert Methods
        if (isset($_POST['name'])) {
            $this->inserttypes();
        }

        // List Methods
        $raw['listofficetypes'] = $this->msetting->getListTypes();


        $this->data['content'] = $this->load->view("backend/pages/setting/types", $raw, true);
        $this->load->view("backend/template", $this->data);
    }

    function countries() {


        // Insert Methods
        if (isset($_POST['name'])) {
            $this->insertcountries();
        }

        // List Methods
        $raw['listsettingcountries'] = $this->msetting->getListCountris();

        // DrpDwn Methods
        $drpdwncountries = $this->msetting->getDrpDwnCountries();
        $raw['drpdwncountries'] = $drpdwncountries;


        $this->data['content'] = $this->load->view("backend/pages/setting/countries", $raw, true);
        $this->load->view("backend/template", $this->data);
    }

    function cities() {


        // Insert Methods
        if (isset($_POST['name'])) {
            $this->insertcities();
        }

        // List Methods
        $raw['listsettingcities'] = $this->msetting->getListCities();

        // DrpDwn Methods
        $drpdwncountries = $this->msetting->getDrpDwnCountries();
        $raw['drpdwncountries'] = $drpdwncountries;


        $this->data['content'] = $this->load->view("backend/pages/setting/cities", $raw, true);
        $this->load->view("backend/template", $this->data);
    }

    function societies() {


        // Insert Methods
        if (isset($_POST['name'])) {
            $this->insertsocieties();
        }

        // List Methods
        $raw['listsettingsocieties'] = $this->msetting->getListSocieties();

        // DrpDwn Methods
        $drpdwncountries = $this->msetting->getDrpDwnCountries();
        $raw['drpdwncountries'] = $drpdwncountries;
        
        $drpdwncities = $this->msetting->getDrpDwnCities();
        $raw['drpdwncities'] = $drpdwncities;


        $this->data['content'] = $this->load->view("backend/pages/setting/societies", $raw, true);
        $this->load->view("backend/template", $this->data);
    }

    function reqcategories() {

        // Insert Methods
        if (isset($_POST['name_categories'])) {
            $this->insertreqcategory();
        }
        
        // DrpDwn Methods
        $drpdwnofficecategories = $this->msetting->getDrpDwnCategories();
        $raw['drpdwnofficecategories'] = $drpdwnofficecategories;

        // List Methods
        $raw['listofficecategories'] = $this->msetting->getListReqCategories();


        $this->data['content'] = $this->load->view("backend/pages/setting/reqcategories", $raw, true);

        $this->load->view("backend/template", $this->data);
    }
    
     function rqcatejoinstatuscate() {

        // Insert Methods
        if (isset($_POST['name_categories'])) {
            $this->insertreqcategory();
        }
        
        // Insert Methods
        if (isset($_POST['fk_req_categories'])) {
            $this->insertreqcatestatuscate();
        }
        
        // DrpDwn Methods
        $drpdwnofficecategories = $this->msetting->getDrpDwnCategories();
        $raw['drpdwnofficecategories'] = $drpdwnofficecategories;

        // List Methods
        $raw['listofficecategories'] = $this->msetting->getListReqCategories();


        $this->data['content'] = $this->load->view("backend/pages/setting/reqcatejoinstatuscate", $raw, true);

        $this->load->view("backend/template", $this->data);
    }
    
    function statuscategories(){
        

        
        // Insert Methods
        if (isset($_POST['name_categories'])) {
            $this->insertstatuscategory();
        }
        
        // Insert Methods
        if (isset($_POST['fk_req_categories'])) {
            $this->insertreqcatestatuscate();
        }
        // List Methods
        $raw['liststatuscategories'] = $this->msetting->getListStatusCategories();
        
        $this->data['content'] = $this->load->view("backend/pages/setting/statuscategories", $raw, true);
        $this->load->view("backend/template", $this->data);
        
    }
    
    function addmobilemenu(){
        
       $raw = array();
      
     // Insert Methods
        if (isset($_POST['name'])) {
            
            
            $this->insertmobilemenu();
        
            
        } 
        
        $this->data['content'] = $this->load->view("backend/pages/setting/statuscategories", $raw, true);
        $this->load->view("backend/template", $this->data);
        
        
    }
    
    // Main Functions Ended !
    // Insert Data Functions Start
    function insertmobilemenu(){
        $segment2 = $this->input->post("segment2");
        $segment1 = $this->input->post("maincate");
        $insert_data = array(
            'mainsection' => $this->input->post("maincate"),
            'name' => $this->input->post("name"),
            'url' => $this->input->post("url"),
            'icon' => $this->input->post("icon"),
            'orderby' => $this->input->post("orderby"),
            'status' => $this->input->post("status"),
        );

        $results = $this->msetting->InsertMenuSection($insert_data);
        if ($results == 0) {
            
            $results = '<div class="alert alert-danger"><strong>Error ! Menu Already Added !</strong></div>';
        } else {
            $results = '<div class="alert alert-success"><strong>Successful !</strong> Data Added..</div>';
        } 
        $this->session->set_flashdata('userdatasavestatus', $results);
        redirect("$segment1/$segment2", 'refresh');
    }
    
    function insertcategory() {
        $insert_data = array(
            'name_categories' => $this->input->post("name_categories"),
            'status_categories' => $this->input->post("status_categories"),
            'orderby_categories' => $this->input->post("orderby_categories")
        );

        $this->msetting->InsertCategories($insert_data);
        $results = "Data Inserted";
        $this->session->set_flashdata('userdatasavestatus', $results);
    }
    
    function insertreqcatestatuscate(){
        $insert_data = array(
            'fk_req_categories' => $this->input->post("fk_req_categories"),
            'fk_status_categories' => $this->input->post("fk_status_categories"),
            'status' => $this->input->post("status"),
            'orderby' => $this->input->post("orderby")
            
        );

        $results = $this->msetting->InsertReqctJoinStct($insert_data);
        if ($results == 0) {
            $results = '<div class="alert alert-danger"><strong>Error ! Already Joined !</strong></div>';
        } else {
            $results = '<div class="alert alert-success"><strong>Successful !</strong> Data Added..</div>';
        } 
        $this->session->set_flashdata('userdatasavestatus', $results);
    }
    
    function insertreqcategory(){
        $insert_data = array(
            'name_categories' => $this->input->post("name_categories"),
            'status_categories' => $this->input->post("status_categories"),
            'orderby_categories' => $this->input->post("orderby_categories"),
            'class_categories' => $this->input->post("class_categories"),
            'bg_colour' => $this->input->post("bg_colour")
        );

        $this->msetting->InsertReqCategories($insert_data);
        $results = "Data Inserted";
        $this->session->set_flashdata('userdatasavestatus', $results);
    }
    function insertstatuscategory(){
        $insert_data = array(
            'name_categories' => $this->input->post("name_categories"),
            'status_categories' => $this->input->post("status_categories"),
            'orderby_categories' => $this->input->post("orderby_categories"),
            'class_categories' => $this->input->post("class_categories"),
            'bg_colour' => $this->input->post("bg_colour")
            
        );
        $this->msetting->InsertStatusCategories($insert_data);
        $results = "Data Inserted";
        $this->session->set_flashdata('userdatasavestatus', $results);
    }
    function insertsubcategory() {

        $insert_data = array(
            'name_subcategories' => $this->input->post("name_subcategories"),
            'status_subcategories' => $this->input->post("status_subcategories"),
            'orderby_subcategories' => $this->input->post("orderby_subcategories"),
            'fk_office_categories' => $this->input->post("fk_office_categories"),
        );

        $this->msetting->InsertSubCategoires($insert_data);
        $results = "Sub Category Data Inserted";
        $this->session->set_flashdata('userdatasavestatus', $results);
    }

    function inserttypes() {
        $insert_data = array(
            'name' => $this->input->post("name"),
            'status' => $this->input->post("status"),
            'orderby' => $this->input->post("orderby")
        );

       $results =   $this->msetting->InsertTypes($insert_data);
       
        
        if ($results == 0) {
            $results = '<div class="alert alert-danger"><strong>Error ! Types Already Added !</strong></div>';
        } else {
            $results = '<div class="alert alert-success"><strong>Successful !</strong> Data Added..</div>';
        } 
        $this->session->set_flashdata('userdatasavestatus', $results);
    }

    function insertcountries() {
        $insert_data = array(
            'name' => $this->input->post("name"),
            'status' => $this->input->post("status"),
            'orderby' => $this->input->post("orderby")
        );

        $results  = $this->msetting->InsertCountries($insert_data);
        
        if ($results == 0) {
            $results = '<div class="alert alert-danger"><strong>Error ! Country Already Added !</strong></div>';
        } else {
            $results = '<div class="alert alert-success"><strong>Successful !</strong> Data Added..</div>';
        } 
        $this->session->set_flashdata('userdatasavestatus', $results);
    }

    function insertcities() {
        $insert_data = array(
            'name' => $this->input->post("name"),
            'fk_countries' => $this->input->post("fk_countries"),
            'status' => $this->input->post("status"),
            'orderby' => $this->input->post("orderby")
        );

        $results = $this->msetting->InsertCity($insert_data);
        if ($results == 0) {
            $results = '<div class="alert alert-danger"><strong>Error ! City Already Added !</strong></div>';
        } else {
            $results = '<div class="alert alert-success"><strong>Successful !</strong> Data Added..</div>';
        } 
        $this->session->set_flashdata('userdatasavestatus', $results);
    }

    function insertsocieties() {
        $insert_data = array(
            'name' => $this->input->post("name"),
            'fk_cities' => $this->input->post("fk_cities"),
            'status' => $this->input->post("status"),
            'orderby' => $this->input->post("orderby")
        );
        $results = $this->msetting->InsertSociety($insert_data);

        if ($results == 0) {
            $results = '<div class="alert alert-danger"><strong>Error ! Society Already Added !</strong></div>';
        } else {
            $results = '<div class="alert alert-success"><strong>Successful !</strong> Data Added..</div>';
        }
        $this->session->set_flashdata('userdatasavestatus', $results);
    }

    // Insert Data Functions Ended !
    // Update Data Function Start
    // Update Data Functions Ended !
    // Delete Data Functions Start
    function deletecategories() {
        $id = $this->uri->segment(3);
        $result = $this->msetting->DeleteCategories($id);
        $this->session->set_flashdata('userdatasavestatus', $result);
        redirect('setting/categories', 'refresh');
    }

    function deletesubcategories() {
        $id = $this->uri->segment(3);
        $result = $this->msetting->DeleteSubCategories($id);
        $this->session->set_flashdata('userdatasavestatus', $result);
        redirect('setting/categories', 'refresh');
    }

    function deletetypes() {
        $id = $this->uri->segment(3);
        $result = $this->msetting->DeleteTypes($id);
        $this->session->set_flashdata('userdatasavestatus', $result);
        redirect('setting/types', 'refresh');
    }

    function deletecountries() {
        $id = $this->uri->segment(3);
        $result = $this->msetting->DeleteCountry($id);
        
        if ($result == 0) {
            $result = '<div class="alert alert-danger"><strong>Error !</strong>Unable to delete foreign key constant failed!</div>';
        } else {
            $result = '<div class="alert alert-success"><strong>Successful !</strong> Data Deleted..</div>';
        }
        
        $this->session->set_flashdata('userdatasavestatus', $result);
        redirect('setting/countries', 'refresh');
    }

    function deletecity() {
        $id = $this->uri->segment(3);
        $result = $this->msetting->DeleteCity($id);
        if ($result == 0) {
            $result = '<div class="alert alert-danger"><strong>Error !</strong>Unable to delete foreign key constant failed!</div>';
        } else {
            $result = '<div class="alert alert-success"><strong>Successful !</strong> Data Deleted..</div>';
        }
        $this->session->set_flashdata('userdatasavestatus', $result);
        redirect('setting/cities', 'refresh');
    }

    function deletesociety() {

        $id = $this->uri->segment(3);
        $result = $this->msetting->DeleteSociety($id);

        if ($result == 0) {
            $result = '<div class="alert alert-danger"><strong>Error !</strong>Unable to delete foreign key constant failed!</div>';
        } else {
            $result = '<div class="alert alert-success"><strong>Successful !</strong> Data Deleted..</div>';
        }

        $this->session->set_flashdata('userdatasavestatus', $result);

        redirect('setting/societies', 'refresh');
    }
    
    function deletereqcategories(){
         $id = $this->uri->segment(3);
        $result = $this->msetting->DeleteReqCategories($id);

        if ($result == 0) {
            $result = '<div class="alert alert-danger"><strong>Error !</strong>Unable to delete foreign key constant failed!</div>';
        } else {
            $result = '<div class="alert alert-success"><strong>Successful !</strong> Data Deleted..</div>';
        }

        $this->session->set_flashdata('userdatasavestatus', $result);

        redirect('setting/reqcategories', 'refresh');
    }
    
    function deletestatuscategories()
    {
         $id = $this->uri->segment(3);
        $result = $this->msetting->DeleteStatusCategories($id);

        if ($result == 0) {
            $result = '<div class="alert alert-danger"><strong>Error !</strong>Unable to delete foreign key constant failed!</div>';
        } else {
            $result = '<div class="alert alert-success"><strong>Successful !</strong> Data Deleted..</div>';
        }

        $this->session->set_flashdata('userdatasavestatus', $result);

        redirect('setting/statuscategories', 'refresh');
    }
    // Delete Data Functions Ended !

    function selectsubcategory()
    {
        $sql = "select
        s.id,
        s.title
        from
        packages_stages_subcategories s
        join packages_stages_categories c
        where
        c.id = s.fk_stages_categories and
        c.id = '".$this->uri->segment(3)."'";
        $subcategories= $this->db->query($sql)->result();
        //echo $this->db->last_query();
        echo "<option value='0'>Select SubCategories</option>";

        foreach($subcategories as $rows)
            echo "<option value='{$rows->title}'>{$rows->title}</option>";

    }

}
