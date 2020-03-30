<?php
class payments extends CI_Controller 
{
    function __construct()
        {
            parent::__construct();
            $this->load->helper('gloabls');
            if($this->session->userdata('logged_in') !== TRUE){
            redirect('login');
            }
            $this->load->model('mpayments');
        }
	
    function index()
    {
        $payments = $this->mpayments->Getpaymentslist();
        $raw['paymentslist'] = $payments;
        $data['content'] = $this->load->view("backend/pages/payments/payments",$raw , true);
        $this->load->view("backend/template",$data);
    }
    
    function payments()
    {
        $payments = $this->mpayments->Getpaymentslist();  
        $raw['paymentslist'] = $payments;
        $projectDropdown = $this->mpayments->GetProjectDrpdwn();
        $raw['projectDrpdwnList'] = $projectDropdown;
        $companyDropdown = $this->mpayments->GetCompanyDrpdwn();
        $raw['companyDrpdwnList'] = $companyDropdown;
        $categoryDropdown = $this->mpayments->GetCategoryDrpdwn();
        $raw['categoryDrpdwnList'] = $categoryDropdown;
        $data['content'] = $this->load->view("backend/pages/payments/payments",$raw , true);
        $this->load->view("backend/template",$data);  
    }
    
    function filter()
    {
        $fk_project=$this->uri->segment(3);
        $fk_company=$this->uri->segment(4);
        $fk_category=$this->uri->segment(5);
        $raw['selected_projectid'] = $fk_project;
        $raw['selected_companyid'] = $fk_company;
        $raw['selected_categoryid'] = $fk_category;
        $projectDropdown = $this->mpayments->GetProjectDrpdwn();
        $raw['projectDrpdwnList'] = $projectDropdown;
        $companyDropdown = $this->mpayments->GetCompanyDrpdwn();
        $raw['companyDrpdwnList'] = $companyDropdown;
        $categoryDropdown = $this->mpayments->GetCategoryDrpdwn();
        $raw['categoryDrpdwnList'] = $categoryDropdown;
        $payments = $this->mpayments->GetPaymentsFilteredList($fk_project, $fk_company, $fk_category);  
        $raw['paymentslist'] = $payments;
        $data['content'] = $this->load->view("backend/pages/payments/payments",$raw , true);
        $this->load->view("backend/template",$data);  
    }

    function updateCompanyList()
    {
        $id = $this->uri->segment(3);
        $sql = "
        select
        c.id,
        c.title
        from
        packages_companies c
        join packages_stg_jn_comp j
        where
        c.id = j.fk_companies AND
        j.fk_stages_categories = '".$id."'
        ";
        $companies= $this->db->query($sql);
        echo "<option value='0'>Select Company</option>";

        foreach($companies->result() as $rows)
            echo "<option value='{$rows->id}'>{$rows->title}</option>";

    }
    
    function credit()
    {
        $credit_payments = $this->mpayments->GetCreditPaymentList();  
        $raw['creditpaymentslist'] = $credit_payments;
        $projectDropdown = $this->mpayments->GetProjectListDrpdwn();
        $raw['projectDrpdwnList'] = $projectDropdown;
        if($this->input->post('daterange')){
            $raw['filter_date'] = $this->input->post('daterange');
        }
        $data['content'] = $this->load->view("backend/pages/payments/credit",$raw , true);
        $this->load->view("backend/template",$data);  
    }
    
    function creditPaymentsfilterByProject()
    {
        $id=$this->uri->segment(3);
        $credit_payments = $this->mpayments->GetCreditPaymentListByProject($id);  
        $raw['creditpaymentslist'] = $credit_payments;
        $projectDropdown = $this->mpayments->GetProjectListDrpdwn();
        $raw['projectDrpdwnList'] = $projectDropdown;
        $raw['selected_projectid'] = $id;
        $data['content'] = $this->load->view("backend/pages/payments/credit",$raw , true);
        $this->load->view("backend/template",$data);  
    }
    
    function creditPaymentsFilterByDate()
    {
        $filter_date=$this->uri->segment(3);
        $credit_payments = $this->mpayments->GetCreditPaymentListByDate($filter_date);  
        $raw['creditpaymentslist'] = $credit_payments;
        $projectDropdown = $this->mpayments->GetProjectListDrpdwn();
        $raw['projectDrpdwnList'] = $projectDropdown;
        $raw['filter_date'] = date("Y/m/d", ($filter_date + 3600*24));
        $data['content'] = $this->load->view("backend/pages/payments/credit",$raw , true);
        $this->load->view("backend/template",$data);  
    }

    function addcreditpayments()
    {
        $projects = $this->mpayments->GetProjectListDrpdwn();
        $raw['projectlist'] = $projects;
        $data['content'] = $this->load->view('backend/pages/payments/addcredit',$raw , true);
        $this->load->view('backend/template',$data);
    }
    
    function insertCreditPayment()
    {
        
        $results = $this->mpayments->InsertCreditPayments();
        $this->session->set_flashdata('userdatasavestatus',$results);
        $creditpayment = $this->mpayments->GetCreditPaymentList();
        $raw['creditpaymentslist'] = $creditpayment;
        $projectDropdown = $this->mpayments->GetProjectListDrpdwn();
        $raw['projectDrpdwnList'] = $projectDropdown;

        $data['content'] = $this->load->view("backend/pages/payments/credit",$raw , true);
        $this->load->view("backend/template",$data);  
    }
    
    function editCreditPayment()
    {
        $id=$this->uri->segment(3);
        $results = $this->mpayments->EditCreditPayments($id);
        $this->session->set_flashdata('userdatasavestatus',$results);
        $creditpayment = $this->mpayments->GetCreditPaymentList();
        $raw['creditpaymentslist'] = $creditpayment;
        $projectDropdown = $this->mpayments->GetProjectListDrpdwn();
        $raw['projectDrpdwnList'] = $projectDropdown;

        $data['content'] = $this->load->view("backend/pages/payments/credit",$raw , true);
        $this->load->view("backend/template",$data);  
    }
    
   function editCreditItems()
    {
        
        $this->db->where("id_credit", $this->uri->segment(3));
        $creditpayments = $this->db->get("payments_credit");
        $raw['creditpayments'] = $creditpayments->row();

        $projects = $this->mpayments->GetProjectListDrpdwn();
        $raw['projectlist'] = $projects;
        $data['content'] = $this->load->view("backend/pages/payments/editcredit", $raw, true);
        $this->load->view("backend/template", $data);   
    }
    
    function deleteCreditItems()
    {
        $id=$this->uri->segment(3);
        $result=$this->mpayments->DeleteCreditItems($id);
        $this->session->set_flashdata('userdatasavestatus',$result);
        $creditpayment = $this->mpayments->GetCreditPaymentList();
        $raw['creditpaymentslist'] = $creditpayment;
        $projectDropdown = $this->mpayments->GetProjectListDrpdwn();
        $raw['projectDrpdwnList'] = $projectDropdown;

        $data['content'] = $this->load->view("backend/pages/payments/credit",$raw , true);
        $this->load->view("backend/template",$data);  
    }
    
    function asign()
    {
        $asign_payments = $this->mpayments->GetAsignPaymentList();  
        $raw['asignpaymentslist'] = $asign_payments;
        $projectDropdown = $this->mpayments->GetProjectListDrpdwn();
        $raw['projectDrpdwnList'] = $projectDropdown;
        $teams = $this->mpayments->GetTeamListDrpdwn();
        $raw['teamDrpdwnList'] = $teams;
        $data['content'] = $this->load->view("backend/pages/payments/asign",$raw , true);
        $this->load->view("backend/template",$data);  
    }
    
    function asignPaymentsFilter()
    {
        $fk_project=$this->uri->segment(3);
        $fk_team=$this->uri->segment(4);
        $asign_payments = $this->mpayments->GetAsignPaymentListFilter($fk_project, $fk_team);  
        $raw['asignpaymentslist'] = $asign_payments;
        $projectDropdown = $this->mpayments->GetProjectListDrpdwn();
        $raw['projectDrpdwnList'] = $projectDropdown;
        $teams = $this->mpayments->GetTeamListDrpdwn();
        $raw['teamDrpdwnList'] = $teams;
        $raw['selected_projectid'] = $fk_project;
        $raw['selected_teamid'] = $fk_team;
        $data['content'] = $this->load->view("backend/pages/payments/asign",$raw , true);
        $this->load->view("backend/template",$data);  
    }
    
    function asignPaymentsFilterByDate()
    {
        $filter_date=$this->uri->segment(3);
        $asign_payments = $this->mpayments->GetAsignPaymentListByDate($filter_date);  
        $raw['asignpaymentslist'] = $asign_payments;
        $projectDropdown = $this->mpayments->GetProjectListDrpdwn();
        $raw['projectDrpdwnList'] = $projectDropdown;
        $raw['filter_date'] = date("Y/m/d", ($filter_date + 3600*24));
        $data['content'] = $this->load->view("backend/pages/payments/asign",$raw , true);
        $this->load->view("backend/template",$data);  
    }

    function addasignpayments()
    {
        $teams = $this->mpayments->GetTeamListDrpdwn();
        $raw['teamslist'] = $teams;
        $projects = $this->mpayments->GetProjectListDrpdwn();
        $raw['projectlist'] = $projects;
        $categories = $this->mpayments->GetCategoryDrpdwn();
        $raw['categorieslist'] = $categories;
        $data['content'] = $this->load->view('backend/pages/payments/addasign',$raw , true);
        $this->load->view('backend/template',$data);
    }
    
    function insertAsignPayment()
    {
        
        $results = $this->mpayments->InsertAsignPayments();
        $this->session->set_flashdata('userdatasavestatus',$results);
        $asignpayment = $this->mpayments->GetAsignPaymentList();
        $raw['asignpaymentslist'] = $asignpayment;
        $projectDropdown = $this->mpayments->GetProjectListDrpdwn();
        $raw['projectDrpdwnList'] = $projectDropdown;

        $data['content'] = $this->load->view("backend/pages/payments/asign",$raw , true);
        $this->load->view("backend/template",$data);  
    }
    
    function editAsignPayment()
    {
        $id=$this->uri->segment(3);
        $results = $this->mpayments->EditAsignPayments($id);
        $this->session->set_flashdata('userdatasavestatus',$results);
        $asignpayment = $this->mpayments->GetAsignPaymentList();
        $raw['asignpaymentslist'] = $asignpayment;
        $projectDropdown = $this->mpayments->GetProjectListDrpdwn();
        $raw['projectDrpdwnList'] = $projectDropdown;

        $data['content'] = $this->load->view("backend/pages/payments/asign",$raw , true);
        $this->load->view("backend/template",$data);  
    }
    
   function editAsignItems()
    {
        
        $this->db->where("id_asign", $this->uri->segment(3));
        $asignpayments = $this->db->get("payments_asign");
        $raw['asignpayments'] = $asignpayments->row();
        $teams = $this->mpayments->GetTeamListDrpdwn();
        $raw['teamslist'] = $teams;
        $projects = $this->mpayments->GetProjectListDrpdwn();
        $raw['projectlist'] = $projects;
        $categories = $this->mpayments->GetCategoryDrpdwn();
        $raw['categorieslist'] = $categories;
        $subcategories = $this->mpayments->GetSubCategoryDrpdwn($raw['asignpayments']->fk_category);
        $raw['subcategorieslist'] = $subcategories;
        $data['content'] = $this->load->view("backend/pages/payments/editasign", $raw, true);
        $this->load->view("backend/template", $data);   
    }
    
    function deleteAsignItems()
    {
        $id=$this->uri->segment(3);
        $result=$this->mpayments->DeleteAsignItems($id);
        $this->session->set_flashdata('userdatasavestatus',$result);
        $asignpayment = $this->mpayments->GetAsignPaymentList();
        $raw['asignpaymentslist'] = $asignpayment;
        $projectDropdown = $this->mpayments->GetProjectListDrpdwn();
        $raw['projectDrpdwnList'] = $projectDropdown;

        $data['content'] = $this->load->view("backend/pages/payments/asign",$raw , true);
        $this->load->view("backend/template",$data);  
    }

    function ajaxGetCreditPayments() {

        $this->mprojects->ajaxGetCreditPaymentsByDate();
    }

    function labour()
    {
        $labourpayments = $this->mpayments->GetLabourPaymentslist();  
        $raw['labourpaymentslist'] = $labourpayments;
        $projectDropdown = $this->mpayments->GetProjectListDrpdwn();
        $raw['projectDrpdwnList'] = $projectDropdown;
        $teams = $this->mpayments->GetTeamListDrpdwn();
        $raw['teamDrpdwnList'] = $teams;
        $data['content'] = $this->load->view("backend/pages/payments/labour",$raw , true);
        $this->load->view("backend/template",$data);  
    }
    
    function labourPaymentsfilter()
    {
        $fk_project=$this->uri->segment(3);
        $fk_team=$this->uri->segment(4);
        $raw['selected_projectid'] = $fk_project;
        $raw['selected_teamid'] = $fk_team;
        $labour_payments = $this->mpayments->GetLabourPaymentFilteredList($fk_project, $fk_team);  
        $raw['labourpaymentslist'] = $labour_payments;
        $projectDropdown = $this->mpayments->GetProjectListDrpdwn();
        $raw['projectDrpdwnList'] = $projectDropdown;
        $teams = $this->mpayments->GetTeamListDrpdwn();
        $raw['teamDrpdwnList'] = $teams;
        $data['content'] = $this->load->view("backend/pages/payments/labour",$raw , true);
        $this->load->view("backend/template",$data);  
    }
    
    function labourPaymentsFilterByDate()
    {
        $filter_date=$this->uri->segment(3);
        $labour_payments = $this->mpayments->GetLabourPaymentListByDate($filter_date);  
        $raw['labourpaymentslist'] = $labour_payments;
        $projectDropdown = $this->mpayments->GetProjectListDrpdwn();
        $raw['projectDrpdwnList'] = $projectDropdown;
        $teams = $this->mpayments->GetTeamListDrpdwn();
        $raw['teamDrpdwnList'] = $teams;
        $raw['filter_date'] = date("Y/m/d", ($filter_date + 3600*24));
        $data['content'] = $this->load->view("backend/pages/payments/labour",$raw , true);
        $this->load->view("backend/template",$data);  
    }

    function addlabourpayments()
    {
        $projects = $this->mpayments->GetProjectListDrpdwn();
        $raw['projectlist'] = $projects;
        $teams = $this->mpayments->GetTeamListDrpdwn();
        $raw['teamDrpdwnList'] = $teams;
        $data['content'] = $this->load->view('backend/pages/payments/addlabour',$raw , true);
        $this->load->view('backend/template',$data);
    }
    
    function insertLabourPayment()
    {
        
        $results = $this->mpayments->InsertLabourPayments();
        $this->session->set_flashdata('userdatasavestatus',$results);
        $labourpayment = $this->mpayments->GetLabourPaymentsList();
        $raw['labourpaymentslist'] = $labourpayment;
        $projectDropdown = $this->mpayments->GetProjectListDrpdwn();
        $raw['projectDrpdwnList'] = $projectDropdown;
        $teams = $this->mpayments->GetTeamListDrpdwn();
        $raw['teamDrpdwnList'] = $teams;
        $data['content'] = $this->load->view("backend/pages/payments/labour",$raw , true);
        $this->load->view("backend/template",$data);  
    }
    
    function editLabourPayment()
    {
        $id=$this->uri->segment(3);
        $results = $this->mpayments->EditLabourPayments($id);
        $this->session->set_flashdata('userdatasavestatus',$results);
        $labourpayment = $this->mpayments->GetLabourPaymentsList();
        $raw['labourpaymentslist'] = $labourpayment;
        $projectDropdown = $this->mpayments->GetProjectListDrpdwn();
        $raw['projectDrpdwnList'] = $projectDropdown;
        $teams = $this->mpayments->GetTeamListDrpdwn();
        $raw['teamDrpdwnList'] = $teams;
        $data['content'] = $this->load->view("backend/pages/payments/labour",$raw , true);
        $this->load->view("backend/template",$data);  
    }
    
   function editLabourItems()
    {
        
        $this->db->where("id_labour", $this->uri->segment(3));
        $labourpayments = $this->db->get("payments_labour");
        $raw['labourpayments'] = $labourpayments->row();

        $projects = $this->mpayments->GetProjectListDrpdwn();
        $raw['projectlist'] = $projects;
        $teams = $this->mpayments->GetTeamListDrpdwn();
        $raw['teamDrpdwnList'] = $teams;

        $data['content'] = $this->load->view("backend/pages/payments/editlabour", $raw, true);
        $this->load->view("backend/template", $data);   
    }
    
    function deleteLabourItems()
    {
        $id=$this->uri->segment(3);
        $result=$this->mpayments->DeleteLabourItems($id);
        $this->session->set_flashdata('userdatasavestatus',$result);
        $labourpayment = $this->mpayments->GetLabourPaymentsList();
        $raw['labourpaymentslist'] = $labourpayment;
        $projectDropdown = $this->mpayments->GetProjectListDrpdwn();
        $raw['projectDrpdwnList'] = $projectDropdown;
        $teams = $this->mpayments->GetTeamListDrpdwn();
        $raw['teamDrpdwnList'] = $teams;
        $data['content'] = $this->load->view("backend/pages/payments/labour",$raw , true);
        $this->load->view("backend/template",$data);  
    }
     
    function addmobilemenu(){
       $raw = array();
        if (isset($_POST['name'])) {
            $this->insertmobilemenu();
        } 
        $this->payments();
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

        $results = $this->mpayments->InsertMenuSection($insert_data);
        if ($results == 0) {
            
            $results = '<div class="alert alert-danger"><strong>Error ! Menu Already Added !</strong></div>';
        } else {
            $results = '<div class="alert alert-success"><strong>Successful !</strong> Data Added..</div>';
        } 
        $this->session->set_flashdata('userdatasavestatus', $results);
        redirect("$segment1/$segment2", 'refresh');
    }
}