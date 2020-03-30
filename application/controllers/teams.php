<?php

class teams extends MY_Controller {

    function __construct() {

        parent::__construct();
        $this->load->model('mteams');
        
        if($this->session->userdata('logged_in') !== TRUE){
            redirect('login');
            }
    }

    function index() {

        $teams = $this->mteams->GetTeamsList();
        $raw['teamslist'] = $teams;
        $this->data['content'] = $this->load->view("backend/pages/teams/teamslist", $raw, true);
        $this->load->view("backend/template", $this->data);
    }
    
    function add() {

        $raw = array();
        $sub_id = 0;
        $categoryDropdown = $this->mteams->getCategoryDrpdwn();
        $raw['categoryDrpdwnList'] = $categoryDropdown;
        $subcategoryDropdown = $this->mteams->getSubCategoryDrpdwn($sub_id);
        $raw['subcategoryDrpdwnList'] = $subcategoryDropdown;
        $data['content'] = $this->load->view('backend/pages/teams/teamsadd',$raw , true);
        $this->load->view('backend/template',$data);
    }
    
    function insertteams() {
        
        $results = $this->mteams->InsertTeam();
        $this->session->set_flashdata('teamsdatasavestatus',$results);
        redirect("teams",'refresh');
    }

    function edit() {

        $this->db->where("team_id", $this->uri->segment(3));
        $teams = $this->db->get("teams");
        $raw['teams'] = $teams->row();
        $sub_id = 0;
        $categoryDropdown = $this->mteams->getCategoryDrpdwn();
        $raw['categoryDrpdwnList'] = $categoryDropdown;
        $subcategoryDropdown = $this->mteams->getEditSubCategoryDrpdwn($raw['teams']->fk_category);
        $raw['subcategoryDrpdwnList'] = $subcategoryDropdown;
        $data['content'] = $this->load->view("backend/pages/teams/teamsedit", $raw, true);
        $this->load->view("backend/template", $data);   
    }

    function editteams() {
        
        $results = $this->mteams->EditTeam();
        $this->session->set_flashdata('teamsdatasavestatus',$results);
        redirect("teams",'refresh');
    }
    
    function delete() {
        
        $results = $this->mteams->DeleteTeam($this->uri->segment(3));
        $this->session->set_flashdata('teamsdatasavestatus',$results);
        redirect("teams",'refresh');
    }
    
    function updateSubCategoryList() {
        $this->mteams->getSubCategoryDrpdwn($this->uri->segment(3));
    }
     
    function addmobilemenu(){
       $raw = array();
        if (isset($_POST['name'])) {
            $this->insertmobilemenu();
        } 
        $this->index();
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

        $results = $this->mteams->InsertMenuSection($insert_data);
        if ($results == 0) {
            
            $results = '<div class="alert alert-danger"><strong>Error ! Menu Already Added !</strong></div>';
        } else {
            $results = '<div class="alert alert-success"><strong>Successful !</strong> Data Added..</div>';
        } 
        $this->session->set_flashdata('userdatasavestatus', $results);
        redirect("$segment1/$segment2", 'refresh');
    }
}