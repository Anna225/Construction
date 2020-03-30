<?php

class projects extends MY_Controller {

    function __construct() {

        parent::__construct();
        $this->load->model('mprojects');
        $this->load->helper('gloabls');
        if($this->session->userdata('logged_in') !== TRUE){
            redirect('login');
            }
    }

    // Main Data Functions Start
    // function index() {

    //     $raw = array();
    //     $this->data['content'] = $this->load->view("backend/pages/office/dashborad", $raw, true);
    //     $this->load->view("backend/template", $this->data);
    // }

    function index() {

        $projects = $this->mprojects->GetProjectsList();
        $raw['projectslist'] = $projects;

        $clientDropdown = $this->mprojects->GetClientDrpdwn();
        $raw['clientDrpdwnList'] = $clientDropdown;
        $this->data['content'] = $this->load->view("backend/pages/projects/dashborad", $raw, true);
        $this->load->view("backend/template", $this->data);
    }

    function pendingproject() {

        $projects = $this->mprojects->GetProjectsListByPending();
        $raw['projectslist'] = $projects;

        $clientDropdown = $this->mprojects->GetClientDrpdwn();
        $raw['clientDrpdwnList'] = $clientDropdown;
        $this->data['content'] = $this->load->view("backend/pages/projects/dashborad", $raw, true);
        $this->load->view("backend/template", $this->data);
    }

    function underconstruction() {

        $projects = $this->mprojects->GetProjectsListByProgress();
        $raw['projectslist'] = $projects;

        $clientDropdown = $this->mprojects->GetClientDrpdwn();
        $raw['clientDrpdwnList'] = $clientDropdown;
        $this->data['content'] = $this->load->view("backend/pages/projects/dashborad", $raw, true);
        $this->load->view("backend/template", $this->data);
    }

    function completedproject() {

        $projects = $this->mprojects->GetProjectsListByCompleted();
        $raw['projectslist'] = $projects;

        $clientDropdown = $this->mprojects->GetClientDrpdwn();
        $raw['clientDrpdwnList'] = $clientDropdown;
        $this->data['content'] = $this->load->view("backend/pages/projects/dashborad", $raw, true);
        $this->load->view("backend/template", $this->data);
    }

    function totalcost() {
        $id = $this->uri->segment(3);
        $categories = $this->mprojects->GetProjectsTotalCostCategories($id);
        $raw['categoryList'] = $categories;

        $this->data['content'] = $this->load->view("backend/pages/projects/totalcost", $raw, true);
        $this->load->view("backend/template", $this->data);
    }
    
    function addprojects() {

        $raw = array(); 
        $clientDropdown = $this->mprojects->GetClientDrpdwn();
        $raw['clientDrpdwnList'] = $clientDropdown;
        $data['content'] = $this->load->view('backend/pages/projects/add',$raw , true);
        $this->load->view('backend/template',$data);
    }
    
    function joinClient() {

        $this->mprojects->ajaxJoinClient();
    }
    
    function insertcreatedprojects() {
        
        $results = $this->mprojects->InsertProjects();
        $this->session->set_flashdata('userdatasavestatus',$results);
        redirect("projects",'refresh');
    }
    
    function updateProjects() {
        
        $results = $this->mprojects->ChangeEditProject();
        $this->session->set_flashdata('userdatasavestatus',$results);
        redirect("projects",'refresh');
    }
    
    function deleteCreatedProjects() {
        
        $results = $this->mprojects->deleteProjects($this->uri->segment(3));
        $this->session->set_flashdata('userdatasavestatus',$results);
        redirect("projects",'refresh');
    }

    function edit() {

        $this->db->where("id_project", $this->uri->segment(3));
        $projects = $this->db->get("projects_list");
        $raw['projects'] = $projects->row();
        
        $clientDropdown = $this->mprojects->GetClientDrpdwn();
        $raw['clientDrpdwnList'] = $clientDropdown;
        $data['content'] = $this->load->view("backend/pages/projects/edit", $raw, true);
        $this->load->view("backend/template", $data);   
    }


    function ajaxGetProject() {

        $this->mprojects->ajaxGetProjectsById();
    }

    // Not USING
    function categories() {



        // Insert Methods
        if (isset($_POST['name_categories'])) {
            $this->insertofficecategory();
        }
        if (isset($_POST['name_subcategories'])) {

            $this->insertofficesubcategory();
        }


        // DrpDwn Methods
        $drpdwnofficecategories = $this->moffice->getDrpDwnOfficeCategories();
        $raw['drpdwnofficecategories'] = $drpdwnofficecategories;

        // List Methods
        $raw['listofficecategories'] = $this->moffice->getListOfficeCategories();


        $this->data['content'] = $this->load->view("backend/pages/office/categories", $raw, true);

        $this->load->view("backend/template", $this->data);
    }

    function types() {


        // Insert Methods
        if (isset($_POST['name'])) {
            $this->insertofficetypes();
        }

        // List Methods
        $raw['listofficetypes'] = $this->moffice->getListOfficeTypes();


        $this->data['content'] = $this->load->view("backend/pages/office/types", $raw, true);
        $this->load->view("backend/template", $this->data);
    }

    function clients() {

        // Insert Methods
        if (isset($_POST['name_clients'])) {
            $this->insertofficeclients();
        }


        if (isset($_POST['number_phone'])) {
            $this->insertofficeclientsphone();
        }

        // List Methods
        $raw['listofficeclients'] = $this->moffice->getListOfficeClients();
        
        // DrpDwn Lists
        $drpdwnofficecategories = $this->moffice->getDrpDwnOfficeCategories();
        $raw['drpdwnofficecategories'] = $drpdwnofficecategories;
        
        $drpdwnofficetypes = $this->moffice->getDrpDwnOfficeTypes();
        $raw['drpdwnofficetypes'] = $drpdwnofficetypes;

        $this->data['content'] = $this->load->view("backend/pages/office/clients", $raw, true);
        $this->load->view("backend/template", $this->data);
    }

    function requests() {

                // List Methods
        $raw['listofficerequests'] = $this->moffice->getListOfficeRequests();
        
        $pendingconsreq = $this->moffice->countReqConstPend();
        $raw['totConstPendReq'] = $pendingconsreq[0]->totalcounted;
        
        $dealingconsreq = $this->moffice->countReqConstDeal();
        $raw['totConstDealReq'] = $dealingconsreq[0]->totalcounted;
        
        $doneconsreq = $this->moffice->countReqConstDone();
        $raw['totConstDoneReq'] = $doneconsreq[0]->totalcounted;
        
        $rejectedconsreq = $this->moffice->countReqConstReje();
        $raw['totConstRejeReq'] = $rejectedconsreq[0]->totalcounted;
        
        $totalconsreq = $this->moffice->countTotConstRequesrs();
        $raw['totConstReq'] = $totalconsreq[0]->totalcounted;
        
        $totalrenvreq = $this->moffice->countTotRenvRequesrs();
        $raw['totRenvReq'] = $totalrenvreq[0]->totalcounted;
        
        $totalpropreq = $this->moffice->countTotPropRequesrs();
        $raw['totPropReq'] = $totalpropreq[0]->totalcounted;
        
        $totaldesgreq = $this->moffice->countTotDesgRequesrs();
        $raw['totDesgReq'] = $totaldesgreq[0]->totalcounted;
        
        $pendingrenvreq = $this->moffice->countReqRenvPend();
        $raw['totRenvPendReq'] = $pendingrenvreq[0]->totalcounted;
        
        $dealingrenvreq = $this->moffice->countReqRenvDeal();
        $raw['totRenvDealReq'] = $dealingrenvreq[0]->totalcounted;
        
        $donerenvreq = $this->moffice->countReqRenvDone();
        $raw['totRenvDoneReq'] = $donerenvreq[0]->totalcounted;
        
        $rejectedrenvreq = $this->moffice->countReqRenvReje();
        $raw['totRenvRejeReq'] = $rejectedrenvreq[0]->totalcounted;
        
        $pendingpropreq = $this->moffice->countReqPropPend();
        $raw['totPropPendReq'] = $pendingpropreq[0]->totalcounted;
        
        $dealingpropreq = $this->moffice->countReqPropDeal();
        $raw['totPropDealReq'] = $dealingpropreq[0]->totalcounted;
        
        $donepropreq = $this->moffice->countReqPropDone();
        $raw['totPropDoneReq'] = $donepropreq[0]->totalcounted;
        
        $rejectedpropreq = $this->moffice->countReqPropReje();
        $raw['totPropRejeReq'] = $rejectedpropreq[0]->totalcounted;
        
        $pendingdesgreq = $this->moffice->countReqDesgPend();
        $raw['totDesgPendReq'] = $pendingdesgreq[0]->totalcounted;
        
        $dealingdesgreq = $this->moffice->countReqDesgDeal();
        $raw['totDesgDealReq'] = $dealingdesgreq[0]->totalcounted;
        
        $donedesgreq = $this->moffice->countReqDesgDone();
        $raw['totDesgDoneReq'] = $donedesgreq[0]->totalcounted;
        
        $rejecteddesgreq = $this->moffice->countReqDesgReje();
        $raw['totDesgRejeReq'] = $rejecteddesgreq[0]->totalcounted;
        
        
        // DrpDwn Lists
        $drpdwnofficecategories = $this->moffice->getDrpDwnOfficeCategories();
        $raw['drpdwnofficecategories'] = $drpdwnofficecategories;
        
        $drpdwnofficetypes = $this->moffice->getDrpDwnOfficeTypes();
        $raw['drpdwnofficetypes'] = $drpdwnofficetypes;
        
        $this->data['content'] = $this->load->view("backend/pages/office/requests", $raw, true);
        $this->load->view("backend/template", $this->data);
    }

    function meetings() {

        $raw = array();
        $this->data['content'] = $this->load->view("backend/pages/office/meetings", $raw, true);
        $this->load->view("backend/template", $this->data);
    }

    function quotations() {

        $raw = array();
        $this->data['content'] = $this->load->view("backend/pages/office/quotations", $raw, true);
        $this->load->view("backend/template", $this->data);
    }

    function buysale() {

        $raw = array();
        $this->data['content'] = $this->load->view("backend/pages/office/buysale", $raw, true);
        $this->load->view("backend/template", $this->data);
    }

    function calls() {

        $raw = array();
        $this->data['content'] = $this->load->view("backend/pages/office/calls", $raw, true);
        $this->load->view("backend/template", $this->data);
    }

    function tasks() {

        $raw = array();
        $this->data['content'] = $this->load->view("backend/pages/office/tasks", $raw, true);
        $this->load->view("backend/template", $this->data);
    }

    function alerts() {

        $raw = array();
        $this->data['content'] = $this->load->view("backend/pages/office/alerts", $raw, true);
        $this->load->view("backend/template", $this->data);
    }

    function pending() {

        $raw = array();
        $this->data['content'] = $this->load->view("backend/pages/office/pending", $raw, true);
        $this->load->view("backend/template", $this->data);
    }

    // Main Functions Ended !
    // Insert Data Functions Start
    function insertofficecategory() {
        $insert_data = array(
            'name_categories' => $this->input->post("name_categories"),
            'status_categories' => $this->input->post("status_categories"),
            'orderby_categories' => $this->input->post("orderby_categories")
        );

        $this->moffice->InsertOfficeCategories($insert_data);
        $results = "Data Inserted";
        $this->session->set_flashdata('userdatasavestatus', $results);
    }

    function insertofficesubcategory() {

        $insert_data = array(
            'name_subcategories' => $this->input->post("name_subcategories"),
            'status_subcategories' => $this->input->post("status_subcategories"),
            'orderby_subcategories' => $this->input->post("orderby_subcategories"),
            'fk_office_categories' => $this->input->post("fk_office_categories"),
        );

        $this->moffice->InsertOfficeSubCategoires($insert_data);
        $results = "Sub Category Data Inserted";
        $this->session->set_flashdata('userdatasavestatus', $results);
    }

    function insertofficetypes() {
        $insert_data = array(
            'name' => $this->input->post("name"),
            'status' => $this->input->post("status"),
            'orderby' => $this->input->post("orderby")
        );

        $this->moffice->InsertOfficeTypes($insert_data);
        $results = "Data Inserted";
        $this->session->set_flashdata('userdatasavestatus', $results);
    }

    function insertofficeclients() {
        $date = date("Y-m-d");
        
        $insert_data = array(
            'name_clients' => $this->input->post("name_clients"),
            'fk_office_subcategories' => $this->input->post("fk_office_subcategories"),
            'fk_office_types' => $this->input->post("fk_office_types"),
            'city_clients' => $this->input->post("city_clients"),
            'society_clients' => $this->input->post("society_clients"),
            'refby_clients' => $this->input->post("refby_clients"),
            'date_clients' => $date
            
        );
        
        $this->moffice->InsertOfficeClients($insert_data);
        $results = "Data Inserted";
        $this->session->set_flashdata('userdatasavestatus', $results);
    }

    function insertofficeclientsphone() {
        $insert_data = array(
            'number_phone' => $this->input->post("number_phone"),
            'type_phone' => $this->input->post("type_phone"),
            'fk_office_clients' => $this->input->post("fk_office_clients")
        );

        $this->moffice->InsertOfficeClientsPhones($insert_data);
        $results = "Office Clients Phone Number Added!";
        $this->session->set_flashdata('userdatasavestatus', $results);
    }

    // Insert Data Functions Ended !
    // Update Data Function Start
    // Update Data Functions Ended !
    // Delete Data Functions Start
    function deleteofficecategories() {
        $id = $this->uri->segment(3);
        $result = $this->moffice->DeleteOfficeCategories($id);
        $this->session->set_flashdata('userdatasavestatus', $result);
        redirect('office/categories', 'refresh');
    }

    function deleteofficesubcategories() {
        $id = $this->uri->segment(3);
        $result = $this->moffice->DeleteOfficeSubCategories($id);
        $this->session->set_flashdata('userdatasavestatus', $result);
        redirect('office/categories', 'refresh');
    }

    function deleteofficetypes() {
        $id = $this->uri->segment(3);
        $result = $this->moffice->DeleteOfficeTypes($id);
        $this->session->set_flashdata('userdatasavestatus', $result);
        redirect('office/types', 'refresh');
    }

    function deleteofficeclients() {

        $id = $this->uri->segment(3);
        $result = $this->moffice->DeleteOfficeClients($id);
        $this->session->set_flashdata('userdatasavestatus', $result);
        redirect('office/clients', 'refresh');
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

        $results = $this->mprojects->InsertMenuSection($insert_data);
        if ($results == 0) {
            
            $results = '<div class="alert alert-danger"><strong>Error ! Menu Already Added !</strong></div>';
        } else {
            $results = '<div class="alert alert-success"><strong>Successful !</strong> Data Added..</div>';
        } 
        $this->session->set_flashdata('userdatasavestatus', $results);
        redirect("$segment1/$segment2", 'refresh');
    }
}