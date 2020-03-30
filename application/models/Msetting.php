<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Msetting extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // List

    function getListCategories() {

        $query = $this->db->get('office_categories');
        $return = array();

        foreach ($query->result() as $category) {
            $return[$category->id_categories] = $category;
            $return[$category->id_categories]->subs = $this->getListSubcategories($category->id_categories); // Get the categories sub categories
        }

        return $return;
    }

    function getListDesignCategories() {

        $sql = "select
        c.id,
        c.title,
        m.name
        from
        packages_stages_categories c
        join mobile_menu m
        where
        m.mainsection = c.title
        group by c.id";

        $records = $this->db->query($sql)->result();
        foreach ($records as $category) {
            $return[$category->id] = $category;
            $return[$category->id]->subs = $this->getListDesignSubcategories($category->id); 
        }

        return $return;
    }

    function getListReqCategories() {

        $this->db->from('req_categories');
        $this->db->order_by("orderby_categories", "asc");
        $query = $this->db->get();
        return $query->result();
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
    
    function getListDesignSubcategories($fk_category) {
        $sql = "select
        s.id,
        s.title,
        m.id as mobilemenu_id
        from
        packages_stages_subcategories s
        join packages_stages_categories c
        join mobile_menu m
        where 
        c.id = s.fk_stages_categories and
        c.id = $fk_category and
        m.name = s.title";
        $records = $this->db->query($sql)->result();
        return $records;
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

    function getDrpDwnDesignCategories() {
        $sql = "select * from packages_stages_categories";
        $records = $this->db->query($sql)->result();
        $drpdwn = array();
        $drpdwn[0] = "Select Category";
        foreach ($records as $record) {
            $drpdwn[$record->id] = $record->title;
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

    function getDrpDwnCategoriesList()
     {
       $sql="select id, title from packages_stages_categories ";

       $records=$this->db->query($sql)->result();

       $drpdown=array();

       $drpdwn[0]="Select Category";

       foreach($records as $record)

       {

        $drpdwn[$record->id]=$record->title;

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
}
