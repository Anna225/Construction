<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mteams extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    // List

   function GetTeamsList() {

        $baseurl = base_url();
        $sql = "select *, c.title as category, s.title as subcategory from teams t join packages_stages_categories c join packages_stages_subcategories s where t.fk_category = c.id and t.fk_subcategory = s.id";
        $query = $this->db->query($sql)->result_array();
        $i = 0;
        foreach ($query as $key => $row) 
        {

        $var = '<a class="btn btn-info" href="'.$baseurl.'teams/edit/'.$row['team_id'].'"><i class="fa fa-edit "></i></a>
            <a class="btn btn-danger" href="'.$baseurl.'teams/delete/'.$row['team_id'].'"><i class="fa fa-trash-o "></i></a>';

            $query[$key]['action'] = $var;
            $i++;
        }
        $data['records'] = $query;
        return $data;
    }
    //Insert

    function InsertTeam() {
        $data = array(
                    'team_name'=>$this->input->post('add_team_name'),
                    'fk_category'=>$this->input->post('fk_category'),
                    'fk_subcategory'=>$this->input->post('fk_subcategory'),
                    'phone1'=>$this->input->post('add_phone1'),
                    'phone2'=>$this->input->post('add_phone2'),
                    'added_date'=>$this->input->post('add_date')
            );

        $message = "Data inserted successfully";
        $this->db->insert('teams',$data);
        return $message;
    }

    function EditTeam(){

        $this->db->set('team_name', $this->input->post('edit_team_name'));
        $this->db->set('fk_category', $this->input->post('fk_category'));
        $this->db->set('fk_subcategory', $this->input->post('fk_subcategory'));
        $this->db->set('phone1', $this->input->post('edit_phone1'));
        $this->db->set('phone2', $this->input->post('edit_phone2'));
        $this->db->set('added_date', $this->input->post('edit_date'));
        $this->db->where('team_id', $this->uri->segment(3));
        $this->db->update('teams');
        $message="status updated successfully";
        return $message;
    }
 
    // Delete

    function DeleteTeam($id) {
        $this->db->where('team_id', $id);
        $this->db->delete('teams');
        $message = " User Data deleted successfully";
        return $message;
    }

    function getCategoryDrpdwn() {
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
        
    function getSubCategoryDrpdwn($id) {
        $this->db->where("fk_stages_categories", $id);
        $subcategories= $this->db->get("packages_stages_subcategories");
        echo "<option value='0'>Select SubCategories</option>";
        foreach ($subcategories->result() as $rows)
            echo "<option value='{$rows->id}'>{$rows->title}</option>";
    }
        
    function getEditSubCategoryDrpdwn($id) {
        $this->db->where("fk_stages_categories", $id);
        $subcategories= $this->db->get("packages_stages_subcategories");
        $records=$subcategories->result();
        $drpdown=array();
        $drpdwn[0]="Select SubCategory";
        foreach($records as $record)
        {

        $drpdwn[$record->id]=$record->title;

        }
        return $drpdwn;
    }
    
    function InsertMenuSection($insert_data){
            $name = $insert_data['name'];
            $url = $insert_data['url'];
            $this->db->select('id');
            $query = $this->db->get_where('mobile_menu', array('name' => $name,'url' => $url));
            if ($query->num_rows() > 0) {
                return 0;
            } else {
                $this->db->insert('mobile_menu', $insert_data);
                return 1;
            }
        }
}