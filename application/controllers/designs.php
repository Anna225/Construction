<?php
class designs extends CI_Controller 
{
    function __construct()
        {
            parent::__construct();
            $this->load->helper('gloabls');
            if($this->session->userdata('logged_in') !== TRUE){
            redirect('login');
            }
            $this->load->model('mdesigns');
        }
	
    function index($section, $submenu)
    {
        $raw = array();
        $designs = $this->mdesigns->GetDesignsList($section, $submenu);
        $raw['designslist'] = $designs;
        $subcategories = $this->mdesigns->GetSubCategoryDrpdwnBySection($this->uri->segment(2));
        $raw['subcategorieslist'] = $subcategories;
        $data['content'] = $this->load->view("backend/pages/designs/designs",$raw , true);
        $this->load->view("backend/template",$data);
    }
    
    // function wood()
    // {
    //     $credit_designs = $this->mdesigns->GetCreditPaymentList();  
    //     $raw['creditdesignslist'] = $credit_designs;
    //     $projectDropdown = $this->mdesigns->GetProjectListDrpdwn();
    //     $raw['projectDrpdwnList'] = $projectDropdown;
    //     $data['content'] = $this->load->view("backend/pages/designs/designs",$raw , true);
    //     $this->load->view("backend/template",$data);  
    // }
    
    function wood()
    {
        $this->index($this->uri->segment(2), $this->uri->segment(3));  
    }
    
    function ceiling()
    {
        $this->index($this->uri->segment(2), $this->uri->segment(3));  
    }

    function adddesigns()
    {
        $get_section = $this->uri->segment(3);
        $raw['sectionname'] = $get_section;
        $categories = $this->mdesigns->GetCategoryDrpdwn();
        $raw['categorieslist'] = $categories;
        $data['content'] = $this->load->view('backend/pages/designs/adddesigns',$raw , true);
        $this->load->view('backend/template',$data);
    }
    
    function insertDesign()
    {
        $results = $this->mdesigns->InsertDesigns();
        $this->session->set_flashdata('userdatasavestatus',$results);
        redirect("designs/".$this->input->post('sectionname'), 'refresh');
    }
    
   function editDesignItems()
    {
        
        $this->db->where("id", $this->uri->segment(3));
        $designs = $this->db->get("designs");
        $raw['designs'] = $designs->row();

        $categories = $this->mdesigns->GetCategoryDrpdwn();
        $raw['categorieslist'] = $categories;
        $subcategories = $this->mdesigns->GetSubCategoryDrpdwn($raw['designs']->fk_category);
        $raw['subcategorieslist'] = $subcategories;
        $raw['sectionname'] = $this->uri->segment(4);
        $data['content'] = $this->load->view("backend/pages/designs/editdesigns", $raw, true);
        $this->load->view("backend/template", $data);   
    }

    function editDesign()
    {
        $id=$this->uri->segment(3);
        $results = $this->mdesigns->EditDesigns($id);
        $this->session->set_flashdata('userdatasavestatus',$results);
        redirect("designs/".$this->input->post('sectionname'), 'refresh');
    }
    
    function deleteDesignItems()
    {
        $id=$this->uri->segment(3);
        $result=$this->mdesigns->DeleteDesignItems($id);
        $this->session->set_flashdata('userdatasavestatus',$result);
        redirect("designs/".$this->uri->segment(4), 'refresh');
    }
     
    function addmobilemenu(){
       $raw = array();
        if (isset($_POST['design_url'])) {
            $this->insertmobilemenu();
        } 
        $this->index();
    }
    
    // Main Functions Ended !
    // Insert Data Functions Start
    function insertmobilemenu(){
        $segment2 = $this->input->post("segment2");
        $segment1 = $this->input->post("maincate");

        $this->db->where('id', $this->input->post("fk_subcategory"));
        $subcategories= $this->db->get("packages_stages_subcategories");
        $records_row=$subcategories->row();
        $insert_data = array(
            'mainsection' => $segment2,
            'name' => $records_row->title,
            'url' => $this->input->post("design_url"),
            'icon' => $this->input->post("icon"),
            'orderby' => $this->input->post("orderby"),
            'status' => $this->input->post("status"),
        );

        $results = $this->mdesigns->InsertMenuSection($insert_data);
        if ($results == 0) {
            
            $results = '<div class="alert alert-danger"><strong>Error ! Menu Already Added !</strong></div>';
        } else {
            $results = '<div class="alert alert-success"><strong>Successful !</strong> Data Added..</div>';
        } 
        $this->session->set_flashdata('userdatasavestatus', $results);
        redirect("$segment1/$segment2", 'refresh');
    }
}