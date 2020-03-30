<?php

class packages extends MY_Controller {

    function __construct() {

        parent::__construct();
        $this->load->model('mpackages');
         $this->load->model('msetting');
        $this->load->helper('gloabls');
        $this->load->helper(array('form', 'url'));
        $this->load->library('pdf');
        
        if($this->session->userdata('logged_in') !== TRUE){
            redirect('login');
            }
    }

    // Main Data Functions Start

    function index() {

        // DrpDwn Methods
        $drpdwnofficecategories = $this->mpackages->getDrpDwnProductsCate();
        $raw['drpdwnofficecategories'] = $drpdwnofficecategories;

        $drpdwnpackages = $this->mpackages->getDrpDwnPackages();
        $raw['drpdwnpackages'] = $drpdwnpackages;
        
        // List Methods
        $raw['listproductscate'] = $this->mpackages->getListStagesCate();

        $raw['listpackages'] = $this->mpackages->getListPackages();
        
        $this->data['content'] = $this->load->view("backend/pages/packages/dashborad", $raw, true);
        $this->load->view("backend/template", $this->data);
    }
    
    function stagecategories(){
        // DrpDwn Methods
        $drpdwnofficecategories = $this->mpackages->getDrpDwnProductsCate();
        $raw['drpdwnofficecategories'] = $drpdwnofficecategories;

        $drpdwnpackages = $this->mpackages->getDrpDwnPackages();
        $raw['drpdwnpackages'] = $drpdwnpackages;
        
        // List Methods
        $raw['listproductscate'] = $this->mpackages->getListStagesCate();

        $raw['listpackages'] = $this->mpackages->getListPackages();
        
        $this->data['content'] = $this->load->view("backend/pages/packages/stagescategories", $raw, true);

        $this->load->view("backend/template", $this->data);
    }
    
    function packages() {

        // DrpDwn Methods
        $drpdwnofficecategories = $this->mpackages->getDrpDwnProductsCate();
        $raw['drpdwnofficecategories'] = $drpdwnofficecategories;

        $drpdwnpackages = $this->mpackages->getDrpDwnPackages();
        $raw['drpdwnpackages'] = $drpdwnpackages;
        
        // List Methods
        $raw['listproductscate'] = $this->mpackages->getListStagesCate();

        $raw['listpackages'] = $this->mpackages->getListPackages();
        
        $this->data['content'] = $this->load->view("backend/pages/packages/packages", $raw, true);

        $this->load->view("backend/template", $this->data);
    }
    
    function packages2() {

        // DrpDwn Methods
        $drpdwnofficecategories = $this->mpackages->getDrpDwnProductsCate();
        $raw['drpdwnofficecategories'] = $drpdwnofficecategories;

        $drpdwnpackages = $this->mpackages->getDrpDwnPackages();
        $raw['drpdwnpackages'] = $drpdwnpackages;
        
        // List Methods
        $raw['listproductscate'] = $this->mpackages->getListStagesCate();

        $raw['listpackages'] = $this->mpackages->getListPackages();
        
        $this->data['content'] = $this->load->view("backend/pages/packages/pkg/packages", $raw, true);

        $this->load->view("backend/template2", $this->data);
    }
    
    function packagesqty(){
        
        // DrpDwn Methods
        $drpdwnofficecategories = $this->mpackages->getDrpDwnProductsCate();
        $raw['drpdwnofficecategories'] = $drpdwnofficecategories;

        $drpdwnhouses= $this->mpackages->getDrpDwnHouses();
        $raw['drpdwnhouses'] = $drpdwnhouses;
        
        $drpdwnpackages = $this->mpackages->getDrpDwnPackages();
        $raw['drpdwnpackages'] = $drpdwnpackages;
        
        // List Methods
        $raw['listproductscate'] = $this->mpackages->getListStagesCate();

        
        
        $raw['listhouses'] = $this->mpackages->getListHouses();
        
        $this->data['content'] = $this->load->view("backend/pages/packages/packagesqty", $raw, true);

        $this->load->view("backend/template", $this->data);
    }
    
    function packagescosts(){
        
        // DrpDwn Methods
        $drpdwnofficecategories = $this->mpackages->getDrpDwnProductsCate();
        $raw['drpdwnofficecategories'] = $drpdwnofficecategories;

        $drpdwnhouses= $this->mpackages->getDrpDwnHouses();
        $raw['drpdwnhouses'] = $drpdwnhouses;
        
        // List Methods
        $raw['listproductscate'] = $this->mpackages->getListStagesCate();

        
        $raw['listpackages'] = $this->mpackages->getListPackages();
        
        
        $this->data['content'] = $this->load->view("backend/pages/packages/packagescosts", $raw, true);

        $this->load->view("backend/template", $this->data);
    }
    
    
    function companies() {

        // DrpDwn Methods
        $drpdwnofficecategories = $this->mpackages->getDrpDwnProductsCate();
        $raw['drpdwnprodcutscategories'] = $drpdwnofficecategories;

        $drpdwnpackages = $this->mpackages->getDrpDwnPackages();
        $raw['drpdwnpackages'] = $drpdwnpackages;
        
        $drpdwncountries = $this->msetting->getDrpDwnCountries();
        $raw['drpdwncountries'] = $drpdwncountries;
        // List Methods
        
        
        $raw['listcompanies'] = $this->mpackages->getListComapnies();
        
        $this->data['content'] = $this->load->view("backend/pages/packages/companies", $raw, true);

        $this->load->view("backend/template", $this->data);
        
     }
     
    function companiesjoinlist() {

        // DrpDwn Methods
        $drpdwnofficecategories = $this->mpackages->getDrpDwnProductsCate();
        $raw['drpdwnprodcutscategories'] = $drpdwnofficecategories;

        $drpdwnpackages = $this->mpackages->getDrpDwnPackages();
        $raw['drpdwnpackages'] = $drpdwnpackages;
        
        $drpdwncountries = $this->msetting->getDrpDwnCountries();
        $raw['drpdwncountries'] = $drpdwncountries;
        // List Methods
       
        $raw['listproductscate'] = $this->mpackages->getListStagesCate();
        
        $raw['listcompanies'] = $this->mpackages->getListComapnies();
        
        $this->data['content'] = $this->load->view("backend/pages/packages/companiesjoinlist", $raw, true);

        $this->load->view("backend/template", $this->data);
        
     }
    
    function products(){
    $raw['listproductscate'] = $this->mpackages->getListStagesCate();
    
    $raw['listpackagesproducts'] = $this->mpackages->getListPackagesProducts(); 
    
    $drpdwnpackages = $this->mpackages->getDrpDwnPackages();
    $raw['drpdwnpackages'] = $drpdwnpackages;
        
    $this->data['content'] = $this->load->view("backend/pages/packages/products", $raw, true);
    $this->load->view("backend/template", $this->data);    
    
    
    } 
    
    function productslist(){
     
    $raw['listproductscate'] = $this->mpackages->getListStagesCate();
    $raw['listpackagesproducts'] = $this->mpackages->getListJoinPackagesProducts(); 
      
    $drpdwnpackages = $this->mpackages->getDrpDwnPackages();
    $raw['drpdwnpackages'] = $drpdwnpackages;
    
    $this->data['content'] = $this->load->view("backend/pages/packages/productsjoinlist", $raw, true);
    $this->load->view("backend/template", $this->data);   
        
    }
     
    function addmobilemenu(){
       $raw = array();
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

        $results = $this->mpackages->InsertMenuSection($insert_data);
        if ($results == 0) {
            
            $results = '<div class="alert alert-danger"><strong>Error ! Menu Already Added !</strong></div>';
        } else {
            $results = '<div class="alert alert-success"><strong>Successful !</strong> Data Added..</div>';
        } 
        $this->session->set_flashdata('userdatasavestatus', $results);
        redirect("$segment1/$segment2", 'refresh');
    }
    
// Main Functions Ended !
    // Insert Data Functions Start
    function insertstagecate() {
       
        
        $message = $this->mpackages->InsertStagesCate();    
        $this->session->set_flashdata('userdatasavestatus', $message);
        redirect("packages/stagecategories", 'refresh');
            
          
        }
    
    function insertcompany(){
       
       $title =  strtolower($this->input->post("title"));
       
       
       $sql = "select id from packages_companies where title = '$title'";
        
       $query=$this->db->query($sql);
	if ($query->num_rows())
	{
            $message="Unable to Add ! This Company Already Exists";
	}
        else
            {
            $insert_data = array(
            'title' => $title,
            'status' => $this->input->post("status"),
            'orderby' => $this->input->post("orderby"),
            'fk_countries' => $this->input->post("fk_countries")
            
            
                );

            $this->mpackages->InsertCompany($insert_data);
            $message = "Data Inserted";
            
            }
            
        $this->session->set_flashdata('userdatasavestatus', $message);
        redirect("packages/companies", 'refresh');
            
          
        }  
      
    function insertjoinstgcomp(){
        
       $fk_stage = $this->input->post("fk_stages_categories");
       $fk_company = $this->input->post("fk_companies");
       
       $sql = "select id from packages_stg_jn_comp where fk_stages_categories = $fk_stage and fk_companies = $fk_company";
       
       $query=$this->db->query($sql);
	if ($query->num_rows())
	{
            $message="Unable to Add ! This SubCategory Already Exists";
	}
        else
            {
            $insert_data = array(
            'fk_stages_categories' => $fk_stage,
            'fk_companies' => $fk_company,
            'orderby' => $this->input->post("orderby"),
            'status' => $this->input->post("status")
            
                );

            $this->mpackages->InsertJoinStageCompany($insert_data);
            $message = "Data Inserted";
            
            }
            
        $this->session->set_flashdata('userdatasavestatus', $message);
        redirect("packages/companiesjoinlist", 'refresh');
            
    }    
        
    function insertstagessubcate() {
       
       $title =  strtolower($this->input->post("title"));
       
       
       $sql = "select id from packages_stages_subcategories where title = '$title'";
        
       $query=$this->db->query($sql);
	if ($query->num_rows())
	{
            $message="Unable to Add ! This SubCategory Already Exists";
	}
        else
            {
            $insert_data = array(
            'title' => $title,
            'status' => $this->input->post("status"),
            'orderby' => $this->input->post("orderby"),
            'fk_stages_categories' => $this->input->post("fk_stages_categories")
            
                );

            $this->mpackages->InsertStagesSubCate($insert_data);
            $message = "Data Inserted";
            
            }
            
        $this->session->set_flashdata('userdatasavestatus', $message);
        redirect("packages/stagecategories", 'refresh');
            
          
        }    
        
    function insertpackagedata() {

        
        $pk_package = $this->input->post("fk_packages");
        $fk_stages_subcategoires = $this->input->post("fk_stages_subcategories");

        $sql = "select id from packages_data where fk_packages = $pk_package and fk_stages_subcategories = $fk_stages_subcategoires";

        $query = $this->db->query($sql);
        if ($query->num_rows()) {
            $message = "Data Already Exists";
        } else 
            { 
            $insert_data = array(
                
                'fk_products_jn_substages' => $this->input->post("fk_products_jn_substages"),
                'fk_packages' => $pk_package,
                'fk_stages_subcategories' => $fk_stages_subcategoires
            );

            $this->mpackages->InsertPackageData($insert_data);
            $message = "Data Inserted";
        }





        $this->session->set_flashdata('userdatasavestatus', $message);
        redirect("packages/packages", 'refresh');
    }

    function insertpkgproducts(){

        $title = $this->input->post("title");
        
        $pk_company = $this->input->post("fk_companies");
        

        $sql = "select id from packages_products where title = '$title' and fk_companies = $pk_company";

        $query = $this->db->query($sql);
        if ($query->num_rows()) {
            $message = "Product Already Exists In This Company !";
        } 
        else {
            
            $insert_data = array(
                'title' => $title,
                'type' => $this->input->post("type"),
                'status' => $this->input->post("status"),
                'orderby' => $this->input->post("orderby"),
                'fk_companies' => $pk_company,
                
            );

            $this->mpackages->InsertPackageProducts($insert_data);
            $message = "Data Inserted";
        }





        $this->session->set_flashdata('userdatasavestatus', $message);
        redirect("packages/products", 'refresh');
    }
    
    function insertjoinproductsubstages(){
        
            $fk_subsates = $this->input->post("fk_stages_subcategories");
            $fk_products = $this->input->post("fk_packages_products");
            $fk_packages  = $this->input->post("fk_packages");
            
            $sql = "select id from packages_products_jn_substages where fk_stages_subcategories = $fk_subsates and fk_packages_products = $fk_products and fk_packages = $fk_packages";
            
            $query = $this->db->query($sql);
                
            if ($query->num_rows()) 
                {
                    $message = "Product to this stage with this package is already added !";
                } 
            else 
                {
                    
                        $insert_data = array(
                       'fk_stages_subcategories' => $this->input->post("fk_stages_subcategories"),
                       'fk_packages_products' => $this->input->post("fk_packages_products"),
                       'fk_packages' => $this->input->post("fk_packages"),
                       'rate' => $this->input->post("rate"),
                       'vendor' => $this->input->post("vendor"),
                       'qty' => $this->input->post("qty"),
                       'status' => $this->input->post("status"),
                       'orderby' => $this->input->post("orderby"),
                       'package_title' => $this->input->post("package_title")
                       );

                       $this->mpackages->InsertJoinProductsToSubSatges($insert_data);
                       $message = "Data Inserted";

                }
            $this->session->set_flashdata('userdatasavestatus', $message);
            redirect("packages/productslist", 'refresh');
        
    }
    
    
    function insertpackagesqty(){
        
        
        $insert_data = array(
                       'qty' => $this->input->post("qty"),
                       'fk_stages_subcategories' => $this->input->post("fk_stages_subcategories"),
                        'fk_packages_houses' => $this->input->post("fk_packages_houses"),
                       'type' => $this->input->post("type"),
                       'status' => $this->input->post("status"),
                       'orderby' => $this->input->post("orderby"),
                       'fk_packages' => $this->input->post("fk_packages")

                       );

                       $this->mpackages->InsertPackagesQty($insert_data);
                       $message = "Data Inserted";
                       
        $this->session->set_flashdata('userdatasavestatus', $message);
        redirect("packages/packagesqty", 'refresh');
        
    }
    // Insert Data Functions Ended !
    // Update Data Function Start
    // Update Data Functions Ended !
    // Delete Data Functions Start
    function deleteprodcate() {
        $id = $this->uri->segment(3);
        $result = $this->mpackages->DeleteOfficeCategories($id);
        $this->session->set_flashdata('userdatasavestatus', $result);
        redirect('packages/productscate', 'refresh');
    }

    

    // Delete Data Functions Ended !    
}
