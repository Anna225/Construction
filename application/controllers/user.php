<?php

class user extends MY_Controller {

    function __construct() {

        parent::__construct();
        $this->load->model('muser');
        
        if($this->session->userdata('logged_in') !== TRUE){
            redirect('login');
            }
    }

    function index() {

        $users = $this->muser->GetUserList();
        $raw['userlist'] = $users;
        $this->data['content'] = $this->load->view("backend/pages/user/userlist", $raw, true);
        $this->load->view("backend/template", $this->data);
    }
    
    function add() {

        $raw = array();
        $data['content'] = $this->load->view('backend/pages/user/useradd',$raw , true);
        $this->load->view('backend/template',$data);
    }
    
    function insertuser() {
        
        $results = $this->muser->InsertUser();
        $this->session->set_flashdata('userdatasavestatus',$results);
        redirect("user",'refresh');
    }

    function edit() {

        $this->db->where("user_id", $this->uri->segment(3));
        $user = $this->db->get("tbl_users");
        $raw['user'] = $user->row();
        $data['content'] = $this->load->view("backend/pages/user/useredit", $raw, true);
        $this->load->view("backend/template", $data);   
    }

    function edituser() {
        
        $results = $this->muser->EditUser();
        $this->session->set_flashdata('userdatasavestatus',$results);
        redirect("user",'refresh');
    }
    
    function delete() {
        
        $results = $this->muser->deleteUser($this->uri->segment(3));
        $this->session->set_flashdata('userdatasavestatus',$results);
        redirect("user",'refresh');
    }

    function ajaxGetProject() {

        $this->muser->ajaxGetProjectsById();
    }

}