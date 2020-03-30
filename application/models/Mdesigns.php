<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class Mdesigns extends CI_Model {
        
        

        public function __construct()
        {
            parent::__construct();
            
        }

        function GetCategoryDrpdwn()
         {
           $sql="select * from packages_stages_categories";
           $records=$this->db->query($sql)->result();
           $drpdown=array();
           $drpdwn[0]="Select Category";
           foreach($records as $record)
           {
            $drpdwn[$record->id]=$record->title;
           }
           return $drpdwn;
         }
        
        function GetProjectListDrpdwn()
        {
          
            $products= $this->db->get("projects_list");
            $records=$products->result();
            $drpdown=array();
            $drpdwn[0]="Select Project";
            foreach($records as $record)

            {

                $drpdwn[$record->id_project]=$record->name_project;

            }
            return $drpdwn;
          
        }

        function GetCategoryListDrpdwn()
        {
          
            $categories= $this->db->get("packages_stages_categories");
            $records=$categories->result();
            $drpdown=array();
            $drpdwn[0]="Select Category";
            foreach($records as $record)

            {

                $drpdwn[$record->id]=$record->title;

            }
            return $drpdwn;
          
        }

        function GetSubCategoryDrpdwn($id)
        {
            $this->db->where('fk_stages_categories', $id);
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

        function GetSubCategoryDrpdwnBySection($section)
        {

            $this->db->where('title', $section);
            $category= $this->db->get("packages_stages_categories");
            $category_row=$category->row();
            $this->db->where('fk_stages_categories', $category_row->id);
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

        function GetCompanyListDrpdwn()
        {
          
            $companies= $this->db->get("packages_companies");
            $records=$companies->result();
            $drpdown=array();
            $drpdwn[0]="Select Company";
            foreach($records as $record)

            {

                $drpdwn[$record->id]=$record->title;

            }
            return $drpdwn;
          
        }

        function GetTeamListDrpdwn()
        {
          
            $teams= $this->db->get("teams");
            $records=$teams->result();
            $drpdown=array();
            $drpdwn[0]="Select Team";
            foreach($records as $record)

            {

                $drpdwn[$record->team_id]=$record->team_name;

            }
            return $drpdwn;
          
        }

        function GetDesignsList($section, $submenu)
        {
            $baseurl = base_url();
            if(isset($submenu) && !empty($submenu)){
                $where =  "and s.id=".$submenu;
            }else{
               $where = ""; 
            }
            $sql = "select d.*, c.title as category, c.class as icon_class, s.title as subcategory from designs d join packages_stages_categories c join packages_stages_subcategories s where d.fk_category = c.id and d.fk_subcategory = s.id and c.title= '".$section."'".$where;
            $query = $this->db->query($sql)->result_array();
            $i = 0;
            foreach ($query as $key => $row) 
            {
                $var = '<a class="btn btn-info" href="'.$baseurl.'designs/editDesignItems/'.$row['id'].'/'.$this->uri->segment(2).'"><i class="fa fa-edit "></i></a>
                        <a class="btn btn-danger" href="'.$baseurl.'designs/deleteDesignItems/'.$row['id'].'/'.$this->uri->segment(2).'"><i class="fa fa-trash-o "></i></a>';

                $i++;
                $query[$key]['action'] = $var;  
                
            }
            $data['records'] = $query;
            return $data;
        }

        function InsertDesigns() {

            $config['upload_path']   = 'uploads/designs/';
            $config['allowed_types'] = '*';
            $config['file_name']     = 'design'.getdate()[0];
            $this->load->library('upload', $config);
            if ( $this->upload->do_upload('upload_file')){
                true;
            }else{
                false;
            }
            $name = $_FILES["upload_file"]["name"];
            $ext = end((explode(".", $name))); # extra () to prevent notice
            $data = array(
                        'fk_category'=>$this->input->post('fk_category'),
                        'fk_subcategory'=>$this->input->post('subcategory'),
                        'design_name'=>$this->input->post('design_name'),
                        'image_url'=>$config['upload_path'].$config['file_name'].".".$ext
                );

            $message = "Data inserted successfully";
            $this->db->insert('designs',$data);
            return $message;
        }

        function EditDesigns($id)
        {
            $this->db->where('id', $id);
            $query = $this->db->get('designs');
            $row = $query->row(); 
            $image_file = $row->image_url;

            if(isset($_FILES["upload_file"]["name"]) && !empty($_FILES["upload_file"]["name"])) {
                if(file_exists($image_file)){
                    unlink($image_file);
                }

                $config['upload_path']   = 'uploads/designs/';
                $config['allowed_types'] = '*';
                $config['file_name']     = 'design'.getdate()[0];
                $this->load->library('upload', $config);
                if ( $this->upload->do_upload('upload_file')){
                    true;
                }else{
                    false;
                }
                $name = $_FILES["upload_file"]["name"];
                $ext = end((explode(".", $name))); # extra () to prevent notice

                $this->db->set('image_url', $config['upload_path'].$config['file_name'].".".$ext);
            }
            $this->db->set('fk_category', $this->input->post('fk_category'));
            $this->db->set('fk_subcategory', $this->input->post('subcategory'));
            $this->db->set('design_name', $this->input->post('design_name'));

            $this->db->where('id', $this->uri->segment(3));
            $this->db->update('designs');
            $message="status updated successfully";
            return $message;
        }
        
        function DeleteDesignItems($id)
        {
         $this->db->where('id', $id);
         $this->db->delete('designs');
            
            $message = " Data deleted successfully";
            return $message;   
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