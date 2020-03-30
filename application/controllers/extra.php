<?php

class extra extends MY_Controller {

    function __construct() {

        parent::__construct();
        $this->load->model('mextra');
        if($this->session->userdata('logged_in') !== TRUE){
            redirect('login');
            }
    }

    // Main Data Functions Start

    function index() {

        $raw = array();
        $this->data['content'] = $this->load->view("backend/pages/office/dashborad", $raw, true);
        $this->load->view("backend/template", $this->data);
    }

    function selectproductsofsubstages(){
        
        $fk_substages = $this->uri->segment(3);
        $sql = "select ps.package_title as packagetitle ,p.type as typeproduct ,ps.rate as productprice ,sc.class as stageclass ,ps.id as prodcutsid,p.title as productname , pb.title as substagename , sc.title as stagename , ct.name as countryname , cp.title as companyname , pg.title as packagename from packages_products_jn_substages ps join packages_stages_subcategories pb join packages_products p join packages_companies cp join countries ct join packages pg join packages_stages_categories sc where ps.fk_stages_subcategories = pb.id and p.id = ps.fk_packages_products and p.fk_companies = cp.id and cp.fk_countries = ct.id and ps.fk_packages = pg.id and sc.id = pb.fk_stages_categories and ps.fk_stages_subcategories = $fk_substages";
        $query = $this->db->query($sql);
        
        
        //echo $this->db->last_query();
        echo "<option value='0'>Select Prodcuts</option>";

        foreach ($query->result() as $rows)
            echo "<option value='{$rows->prodcutsid}'>{$rows->packagetitle}</option>";
    }
    
    function selectsubcategory() {
        $this->db->where("fk_office_categories", $this->uri->segment(3));
        $subcategories = $this->db->get("office_subcategories");

        //echo $this->db->last_query();
        echo "<option value='0'>Select SubCategories</option>";

        foreach ($subcategories->result() as $rows)
            echo "<option value='{$rows->id_subcategories}'>{$rows->name_subcategories}</option>";
    }
    
    
    function selectstagesubcategory() {
        $this->db->where("fk_stages_categories", $this->uri->segment(3));
        $subprocategories = $this->db->get("packages_stages_subcategories");

        //echo $this->db->last_query();
        echo "<option value='0'>Select SubCategories</option>";

        foreach ($subprocategories->result() as $rows)
            echo "<option value='{$rows->id}'>{$rows->title}</option>";
    }
    
    function selectspackagesproducts(){
        
        $this->db->where("fk_companies", $this->uri->segment(3));
        $subprocategories = $this->db->get("packages_products");

        //echo $this->db->last_query();
        echo "<option value='0'>Select Products</option>";

        foreach ($subprocategories->result() as $rows)
            echo "<option value='{$rows->id}'>{$rows->title}</option>";
        
    }
    
    function selectsocieties() {
        $this->db->where("fk_cities", $this->uri->segment(3));
        $societies = $this->db->get("societies");

        
        //echo $this->db->last_query();
        echo "<option value='0'>Select Society</option>";

        foreach ($societies->result() as $rows)
            echo "<option value='{$rows->id}'>{$rows->name}</option>";
    }
    
    function selectreqcatestatus(){
        
        $id = $this->uri->segment(3);
       
        $sql = "SELECT s.id_categories , s.name_categories
                FROM reqct_jn_stct rs join req_categories c join status_categories s 
                WHERE rs.fk_req_categories = c.id_categories and s.id_categories = rs.fk_status_categories and fk_req_categories = $id";
        
        $records = $this->db->query($sql);
        
        //echo $this->db->last_query();
        echo "<option value='0'>Select Status</option>";

        foreach ($records->result() as $rows)
            echo "<option value='{$rows->id_categories}'>{$rows->name_categories}</option>"; 
        
    }
    
    function selectreqcateallstatus(){
        
        $req_categories = $this->uri->segment(3);
        //$status_categories = $this->uri->segment(4);
        
        $sql = "SELECT s.id_categories , s.name_categories
                FROM reqct_jn_stct rs join req_categories c join status_categories s 
                WHERE rs.fk_req_categories = c.id_categories and s.id_categories = rs.fk_status_categories and fk_req_categories = $req_categories";
        
        $records = $this->db->query($sql);
        
        //echo $this->db->last_query();
        echo "<option value='0'>Select Status</option>";

        foreach ($records->result() as $rows)
            echo "<option value='{$rows->id_categories}'>{$rows->name_categories}</option>"; 
        
    }
    
    

}
