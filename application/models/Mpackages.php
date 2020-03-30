<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mpackages extends CI_Model {

    public function __construct() {
        parent::__construct();
         $this->load->helper(array('form', 'url'));
    }

    // List

    function getListStagesCate() {

        $query = $this->db->get('packages_stages_categories');
        $return = array();

        foreach ($query->result() as $category) {
            $return[$category->id] = $category;
            $return[$category->id]->subs = $this->getListStagesSubCate($category->id); // Get the categories sub categories
        }

        return $return;
    }

    
    function getListStagesSubCate($id) {
        $this->db->where('fk_stages_categories', $id);
        $query = $this->db->get('packages_stages_subcategories');
        return $query->result();
    }
    
    function getListComapnies(){
        
        $query = $this->db->get('packages_companies');
        return $query->result();  
        
    }
    
    function getListPackagesData($subcateid,$packageid){
        $sql = "select * 
from packages_data pd join packages_products_jn_substages p
where pd.fk_products_jn_substages = p.id and
pd.fk_stages_subcategories = $subcateid and pd.fk_packages = $packageid";
        $records = $this->db->query($sql)->result();
        return $records;
    }
    
   function getListPackageCosts($packageid , $substageid)
    {
    
       $sql = "select * from packages_data d join packages_products_jn_substages s where d.fk_products_jn_substages = s.id and d.fk_packages = $packageid and d.fk_stages_subcategories = $substageid";
       $records = $this->db->query($sql)->result();
       return $records;
       
    }
    
    function getListQtyOfTenMarla($substageid , $housetype){
      $sql = "select * from packages_quantity where fk_stages_subcategories = $substageid  and fk_packages_houses = $housetype";  
      $records = $this->db->query($sql)->result();
       return $records;
     }
     
    function getListPackagesQty($subcateid,$houseid)
    {
        $sql = "select * from packages_quantity where fk_stages_subcategories = $subcateid and fk_packages_houses = $houseid";
        $records = $this->db->query($sql)->result();
        return $records;
    }
    
    
    function getJoinCompaniesList($fk_stagescate){
         $sql = "select c.title as companytitle , ct.name as countryname from packages_stg_jn_comp pj join packages_stages_categories sc join packages_companies c join countries ct where ct.id = c.fk_countries and pj.fk_stages_categories = sc.id and c.id = pj.fk_companies and  pj.fk_stages_categories = $fk_stagescate";
        $records = $this->db->query($sql)->result();
        return $records;
    }
    
    function getListPackages(){
        
        $query = $this->db->get('packages');
        return $query->result();
    }
    
    function getListHouses(){
        
        $query = $this->db->get('packages_houses');
        return $query->result();
    }
    
    
    function getListPackagesProducts() {
        $baseurl = base_url();
        $sql = "select p.id as prodcutsid ,p.title as producttitle , c.title as companytitle, cy.name as countrytitle 
                from packages_products p join packages_companies c join countries cy where p.fk_companies = c.id and cy.id = c.fk_countries";
        $query = $this->db->query($sql)->result_array();
        $i = 0;
        foreach ($query as $key => $row) {
            $id = $row['prodcutsid'];
            $var = '<a  href="' . $baseurl . 'packages/deletepackagesproducts/' . $id . '"><button class="btn btn-muted"><i class="fas fa-trash-alt text-danger"></i></button></a>';
            $i++;

            $query[$key]['action'] = $var;
        }
        $data['records'] = $query;
        return $data;
    }
    
    
    function getListJoinPackagesProducts() {
        $baseurl = base_url();
        $sql = "select p.type as typeproduct ,ps.rate as productprice ,sc.class as stageclass ,ps.id as prodcutsid,p.title as productname , pb.title as substagename , sc.title as stagename , ct.name as countryname , cp.title as companyname , pg.title as packagename from packages_products_jn_substages ps join packages_stages_subcategories pb join packages_products p join packages_companies cp join countries ct join packages pg join packages_stages_categories sc where ps.fk_stages_subcategories = pb.id and p.id = ps.fk_packages_products and p.fk_companies = cp.id and cp.fk_countries = ct.id and ps.fk_packages = pg.id and sc.id = pb.fk_stages_categories";
        $query = $this->db->query($sql)->result_array();
        $i = 0;
        foreach ($query as $key => $row) {
            $id = $row['prodcutsid'];
            $var = '<a  href="' . $baseurl . 'packages/deletejnprodsubstagelist/' . $id . '"><button class="btn btn-muted"><i class="fas fa-trash-alt text-danger"></i></button></a>';
            $i++;

            $query[$key]['action'] = $var;
        }
        $data['records'] = $query;
        return $data;
    }
    
    
    function InsertStagesCate() {
        
        $title =  strtolower($this->input->post("title"));
       
        
       $sql = "select id from packages_stages_categories where title = '$title'";
        
       $query=$this->db->query($sql);
	if ($query->num_rows())
	{
            $message="Unable to Add ! This Category Already Exists";
	}
        else
            {
            $data = array(
                'title' => $title,
                'status' => $this->input->post("status"),
                'orderby' => $this->input->post("orderby"),
                'fk_catetype' => $this->input->post("fk_catetype"),
                 'icon_image' => $this->input->post("icon_image")
            );

            
                $message = " Data inserted successfully without";
                $this->db->insert('packages_stages_categories', $data);
                return $message;
            
          }
      }
    
    function InsertStagesSubCate($insert_data) {
        $this->db->insert('packages_stages_subcategories', $insert_data);
    }
    
    function InsertCompany($insert_data){
      $this->db->insert('packages_companies', $insert_data);  
    }
    
    function InsertJoinStageCompany($insert_data){
        
        $this->db->insert('packages_stg_jn_comp', $insert_data); 
    }
    
    
    function InsertPackageData($insert_data){
        $this->db->insert('packages_data', $insert_data);
    }
    
    function InsertPackageProducts($insert_data){
        $this->db->insert('packages_products', $insert_data);
    }
    
    function InsertPackagesQty($insert_data)
    {
        $this->db->insert('packages_quantity', $insert_data);
    }
    function InsertJoinProductsToSubSatges($insert_data){
        $this->db->insert('packages_products_jn_substages', $insert_data);
    }
    
    function getDrpDwnProductsCate() {
        $sql = "select * from packages_stages_categories";
        $records = $this->db->query($sql)->result();
        $drpdwn = array();
        $drpdwn[0] = "Select Products Cate";
        foreach ($records as $record) {
            $drpdwn[$record->id] = $record->title;
        }

        return $drpdwn;
    }
    
    function getDrpDwnPackages() {
        $sql = "select * from packages";
        $records = $this->db->query($sql)->result();
        $drpdwn = array();
        $drpdwn[0] = "Select Package";
        foreach ($records as $record) {
            $drpdwn[$record->id] = $record->title;
        }

        return $drpdwn;
    }
   
    function getDrpDwnHouses(){
        $sql = "select * from packages_houses";
        $records = $this->db->query($sql)->result();
        $drpdwn = array();
        $drpdwn[0] = "Select Houses";
        foreach ($records as $record) {
            $drpdwn[$record->id] = $record->title;
        }

        return $drpdwn;
    }
    function getListStatusCategories(){

        $this->db->from('status_categories');
        $this->db->order_by("orderby_categories", "asc");
        $query = $this->db->get();
        return $query->result();
    }
    
    function getListStatusCategoriesById($byurl){
        $sql = "select * from reqct_jn_stct rs join req_categories rc join status_categories sc
                where rc.id_categories = rs.fk_req_categories and sc.id_categories = rs.fk_status_categories and rc.url_categories = '$byurl'";
    
        $records = $this->db->query($sql)->result();
        
        return $records;
    }
    
    function getListSubcategories($id_office_categories) {
        $this->db->where('fk_office_categories', $id_office_categories);
        $query = $this->db->get('office_subcategories');
        return $query->result();
    }

    function getListTypes() {

        $this->db->from('office_types');
        $this->db->order_by("orderby", "asc");
        $query = $this->db->get();
        return $query->result();
    }

    function getListCountris() {

        $this->db->from('countries');
        $this->db->order_by("orderby", "asc");
        $query = $this->db->get();
        return $query->result();
    }

    function getListCities() {

        $this->db->from('cities');
        $this->db->order_by("orderby", "asc");
        $query = $this->db->get();
        return $query->result();
    }

    function getListSocieties() {
        $this->db->from('societies');
        $this->db->order_by("orderby", "asc");
        $query = $this->db->get();
        return $query->result();
    }

    function getReqCateJoinStatusCateList($id){
        
        $sql = "select *,rs.orderby,sc.name_categories as stcatename,sc.class_categories as stcateclass,sc.bg_colour as stcatebgcolour from reqct_jn_stct rs join req_categories rc join status_categories sc
                where rc.id_categories = rs.fk_req_categories and sc.id_categories = rs.fk_status_categories
                and rc.id_categories = '$id' ORDER BY orderby ASC ";
        $records = $this->db->query($sql)->result();
        
        return $records;
    }
    function getCityName($fkcity){
        $sql = "SELECT c.name as cityname FROM societies s join cities c  WHERE c.id = s.fk_cities and s.fk_cities  = $fkcity";
        $records = $this->db->query($sql)->result();
        
        return $records[0]->cityname;
        
    }
    
    function InsertCategories($insert_data) {
        $this->db->insert('office_categories', $insert_data);
    }
    
    function InsertReqCategories($insert_data){
        $this->db->insert('req_categories', $insert_data);
    }
    
    function InsertReqctJoinStct($insert_data){
        
        $reqcateid = $insert_data['fk_req_categories'];
        $statusid = $insert_data['fk_status_categories'];
        
        $this->db->select('id');
        $query = $this->db->get_where('reqct_jn_stct', array('fk_req_categories' => $reqcateid,'fk_status_categories' => $statusid));
        
        //$sql = "select id from reqct_jn_stct where fk_req_categories = '$reqcateid' and fk_status_categories = '$statusid' ";
        //$query = $this->db->query($sql)->result_result();
        
        
        
        if ($query->num_rows() > 0) {
            return 0;
        
            
        } else {
            
            $this->db->insert('reqct_jn_stct', $insert_data);

            return 1;
        }
        
        
        
    }
    
    function InsertMenuSection($insert_data){
        
        $name = $insert_data['name'];
        $url = $insert_data['url'];
        
        $this->db->select('id');
        $query = $this->db->get_where('mobile_menu', array('name' => $name,'url' => $url));
        
        //$sql = "select id from reqct_jn_stct where fk_req_categories = '$reqcateid' and fk_status_categories = '$statusid' ";
        //$query = $this->db->query($sql)->result_result();
        
        
        
        if ($query->num_rows() > 0) {
            return 0;
        
            
        } else {
            
            $this->db->insert('mobile_menu', $insert_data);

            return 1;
        }
        
        
        
    }
    
    
    function InsertStatusCategories($insert_data) {
        $this->db->insert('status_categories', $insert_data);
    }
    
    function InsertSubCategoires($insert_data) {
        $this->db->insert('office_subcategories', $insert_data);
    }

    function InsertTypes($insert_data) {
        
        $name = $insert_data['name'];

        $this->db->select('id');
        $query = $this->db->get_where('office_types', array('name' => $name));
        
        if ($query->num_rows() > 0) {
            return 0;
        
            
        } else {
            
            $this->db->insert('office_types', $insert_data);

            return 1;
        }
        
        
        
    }

    function InsertCountries($insert_data) {
        
        
        $name = $insert_data['name'];

        $this->db->select('id');
        $query = $this->db->get_where('countries', array('name' => $name));
        if ($query->num_rows() > 0) {
            return 0;
        } else {
            $this->db->insert('countries', $insert_data);

            return 1;
        }
    }

    function InsertCity($insert_data) {
        
        $name = $insert_data['name'];

        $this->db->select('id');
        $query = $this->db->get_where('cities', array('name' => $name));
        if ($query->num_rows() > 0) {
            return 0;
        } else {
            $this->db->insert('cities', $insert_data);

            return 1;
        }
        
        
    }

    function InsertSociety($insert_data) {


        $this->db->insert('societies', $insert_data);

            return 1;
    }

    function getDrpDwnCategories() {
        $sql = "select * from office_categories";
        $records = $this->db->query($sql)->result();
        $drpdwn = array();
        $drpdwn[0] = "Select Category";
        foreach ($records as $record) {
            $drpdwn[$record->id_categories] = $record->name_categories;
        }

        return $drpdwn;
    }

    function getDrpDwnTypes() {
        $sql = "select * from office_types";
        $records = $this->db->query($sql)->result();
        $drpdwn = array();
        $drpdwn[0] = "Select Types";
        foreach ($records as $record) {
            $drpdwn[$record->id] = $record->name;
        }

        return $drpdwn;
    }

    function getDrpDwnCountries() {
        $sql = "select * from countries";
        $records = $this->db->query($sql)->result();
        $drpdwn = array();
        $drpdwn[0] = "Select Countries";
        foreach ($records as $record) {
            $drpdwn[$record->id] = $record->name;
        }

        return $drpdwn;
    }
    function getDrpDwnCities(){
     $sql = "select * from cities";
        $records = $this->db->query($sql)->result();
        $drpdwn = array();
        $drpdwn[0] = "Select City";
        foreach ($records as $record) {
            $drpdwn[$record->id] = $record->name;
        }

        return $drpdwn;   
        
    }
    // Delete

    function DeleteCategories($id) {
        
        $sql="select id_subcategories from office_subcategories where fk_office_categories=$id";
	$query=$this->db->query($sql);
	if ($query->num_rows())
	{
            $message="Unable to delete foreign key constant failed!";
	}
        else{
            $this->db->where('id_categories', $id);
            $this->db->delete('office_categories');
            $message = " Office Categories Data deleted successfully"; 
        }
        
        
        return $message;
    }

    function DeleteSubCategories($id) {
        $sql="select id_requests from office_requests where fk_office_subcategories=$id";
	$query=$this->db->query($sql);
	if ($query->num_rows())
	{
            $message="Unable to delete foreign key constant failed!";
	}
        else
            {
                $this->db->where('id_subcategories', $id);
                $this->db->delete('office_subcategories');
                $message = "Office Sub Categories Data deleted successfully"; 
            }
        
        
        return $message;
    }

    function DeleteTypes($id) {
        $sql="select id_requests from office_requests where fk_office_types=$id";
	$query=$this->db->query($sql);
	if ($query->num_rows())
	{
            $message="Unable to delete foreign key constant failed!";
	}
        else
            {
        $this->db->where('id', $id);
        $this->db->delete('office_types');
        $message = "Office Types Data deleted successfully";
            }
        return $message;
    }

    function DeleteCountry($id) {
        $sql="select id from cities where fk_countries=$id";
		$query=$this->db->query($sql);
		if ($query->num_rows())
		{
			$message= 0 ;
		}
                else{
                    $this->db->where('id', $id);
                    $this->db->delete('countries');
                    $message = 1;   
                }
        
        
        
        
        //else 0 if cant delete
        return $message;
    }

    function DeleteCity($id) {
        $sql="select id from societies where fk_cities=$id";
		$query=$this->db->query($sql);
		if ($query->num_rows())
		{
			$message= 0 ;
		}
                else{
                   $this->db->where('id', $id);
                   $this->db->delete('cities');
                   $message = 1;
        
                }
        //else 0 if cant delete 
        return $message;
    }

    function DeleteSociety($id) {
        $sql="select id_requests from office_requests where fk_society=$id";
		$query=$this->db->query($sql);
		if ($query->num_rows())
		{
			$message= 0 ;
		}
                else{
                   $this->db->where('id', $id);
                    $this->db->delete('societies');
                    $message = 1;  
                }

       
        //else 0 if cant delete
        return $message;
    }

    function DeleteReqCategories($id){
        $sql="select id_requests from office_requests where fk_reqcategory=$id";
		$query=$this->db->query($sql);
		
                if ($query->num_rows() || $id == 8 || $id == 9 || $id == 11)
		{
			$message= 0 ;
		}
                else{
                    
                    $this->db->where('id_categories', $id);
                    $this->db->delete('req_categories');
                    $message = 1;  
                }

       
        //else 0 if cant delete
        return $message;
    }
    function DeleteStatusCategories($id){
       $sql="select id from reqct_jn_stct where fk_status_categories=$id";
		$query=$this->db->query($sql);
		
                if ($query->num_rows())
		{
			$message= 0 ;
		}
                else{
                    
                    $this->db->where('id_categories', $id);
                    $this->db->delete('status_categories');
                    $message = 1;  
                }

       
        //else 0 if cant delete
        return $message; 
    }
    
    function countProdOfSubStages($substageid){
        $sql = "select count(*) as totproducts from packages_products_jn_substages ps join packages_stages_subcategories pb join packages_products p join packages_companies cp join countries ct join packages pg join packages_stages_categories sc where ps.fk_stages_subcategories = pb.id and p.id = ps.fk_packages_products and p.fk_companies = cp.id and cp.fk_countries = ct.id and ps.fk_packages = pg.id and sc.id = pb.fk_stages_categories and ps.fk_stages_subcategories = $substageid";
        $query = $this->db->query($sql)->result();
        return $query;
    }
}
