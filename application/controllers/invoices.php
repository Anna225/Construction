<?php
class invoices extends CI_Controller 
{
    function __construct()
        {
            parent::__construct();
            $this->load->helper('gloabls');
            if($this->session->userdata('logged_in') !== TRUE){
            redirect('login');
            }
            $this->load->model('minvoices');
        }
	
    function index()
    {
        $orders = $this->minvoices->GetOrdersList();
        $raw['orderslist'] = $orders;
        $data['content'] = $this->load->view("backend/pages/invoices",$raw , true);
        $this->load->view("backend/template",$data);
    }
    
    function createdinvoices()
    {
        $id = $this->uri->segment(3);
        
        if($id!= NULL )
        {
          $orders = $this->minvoices->getOrdersListByVendors($id);  
        }
        else
        {
          $orders = $this->minvoices->GetOrdersList();  
        }
        
        $raw['orderslist'] = $orders;
        $companyDropdown = $this->minvoices->GetCompanyDrpdwn();
        $raw['companyDrpdwnList'] = $companyDropdown;
        $projectDropdown = $this->minvoices->GetProjectDrpdwn();
        $raw['projectDrpdwnList'] = $projectDropdown;
        $data['content'] = $this->load->view("backend/pages/invoices/createdinvoices",$raw , true);
        $this->load->view("backend/template",$data);  
    }
    
    function filterbyopen()
    {
        $companyDropdown = $this->minvoices->GetCompanyDrpdwn();
        $raw['companyDrpdwnList'] = $companyDropdown;
        $projectDropdown = $this->minvoices->GetProjectDrpdwn();
        $raw['projectDrpdwnList'] = $projectDropdown;
        $orders = $this->minvoices->GetOrdersListByOpen();  
        $raw['orderslist'] = $orders;
        $data['content'] = $this->load->view("backend/pages/invoices/openedinvoices",$raw , true);
        $this->load->view("backend/template",$data);  
    }
    
    function filterbyclosed()
    {
        $companyDropdown = $this->minvoices->GetCompanyDrpdwn();
        $raw['companyDrpdwnList'] = $companyDropdown;
        $projectDropdown = $this->minvoices->GetProjectDrpdwn();
        $raw['projectDrpdwnList'] = $projectDropdown;
        $orders = $this->minvoices->GetOrdersListByClosed();  
        $raw['orderslist'] = $orders;
        $data['content'] = $this->load->view("backend/pages/invoices/closedinvoices",$raw , true);
        $this->load->view("backend/template",$data);  
    }
    
    function filter()
    {
        $fk_company=$this->uri->segment(3);
        $fk_project=$this->uri->segment(4);
        $raw['selected_companyid'] = $fk_company;
        $raw['selected_projectid'] = $fk_project;
        $companyDropdown = $this->minvoices->GetCompanyDrpdwn();
        $raw['companyDrpdwnList'] = $companyDropdown;
        $projectDropdown = $this->minvoices->GetProjectDrpdwn();
        $raw['projectDrpdwnList'] = $projectDropdown;
        $orders = $this->minvoices->GetOrdersFilteredList($fk_company, $fk_project);  
        $raw['orderslist'] = $orders;
        $data['content'] = $this->load->view("backend/pages/invoices/createdinvoices",$raw , true);
        $this->load->view("backend/template",$data);  
    }
    
    function openedFilter()
    {
        $fk_company=$this->uri->segment(3);
        $fk_project=$this->uri->segment(4);
        $raw['selected_companyid'] = $fk_company;
        $raw['selected_projectid'] = $fk_project;
        $companyDropdown = $this->minvoices->GetCompanyDrpdwn();
        $raw['companyDrpdwnList'] = $companyDropdown;
        $projectDropdown = $this->minvoices->GetProjectDrpdwn();
        $raw['projectDrpdwnList'] = $projectDropdown;
        $orders = $this->minvoices->GetOpenedOrdersFilteredList($fk_company, $fk_project);  
        $raw['orderslist'] = $orders;
        $data['content'] = $this->load->view("backend/pages/invoices/openedinvoices",$raw , true);
        $this->load->view("backend/template",$data);  
    }
        
    function closedFilter()
    {
        $fk_company=$this->uri->segment(3);
        $fk_project=$this->uri->segment(4);
        $raw['selected_companyid'] = $fk_company;
        $raw['selected_projectid'] = $fk_project;
        $companyDropdown = $this->minvoices->GetCompanyDrpdwn();
        $raw['companyDrpdwnList'] = $companyDropdown;
        $projectDropdown = $this->minvoices->GetProjectDrpdwn();
        $raw['projectDrpdwnList'] = $projectDropdown;
        $orders = $this->minvoices->GetClosedOrdersFilteredList($fk_company, $fk_project);  
        $raw['orderslist'] = $orders;
        $data['content'] = $this->load->view("backend/pages/invoices/closedinvoices",$raw , true);
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

    
    function addcreatedinvoices()
    {
        $id = $this->uri->segment(3);
        if($id != NULL)
        {
          $vendor = $this->minvoices->GetVendorListByID($id);  
        }
        else
        {
          $projects = $this->minvoices->GetProjectListDrpdwn();
          $categories = $this->minvoices->GetCategoryListDrpdwn();
        }
        
        $raw['projectlist'] = $projects;
        $raw['categorylist'] = $categories;
        $data['content'] = $this->load->view('backend/pages/invoices/add',$raw , true);
        $this->load->view('backend/template',$data);
    }
    
    function insertcreatedinvoices()
    {
        
        $results = $this->minvoices->InsertInvoices();
        $this->session->set_flashdata('userdatasavestatus',$results);
        
        $getorderslastid = $this->minvoices->getOrdersLastRow();
        $id = $getorderslastid[0]->lastrecord;
        
        redirect("invoices/items/$id",'refresh');
    }
    
    function deletecreatedinvoices()
    {
       $id=$this->uri->segment(3);
	$result=$this->minvoices->Deletecreatedinvoices($id);
	$this->session->set_flashdata('userdatasavestatus',$result);
	redirect('invoices/createdinvoices','refresh');   
    }
    
    function items()
    {
        
        $id = $this->uri->segment(3);
        
        if($items = $this->minvoices->GetitemsByOrderID($id)){
            $raw['itemsorderlist'] = $items;
        }else{
            $raw['itemsorderlist'] = "";
        }
        
        if($projectname = $this->minvoices->GetProjectData($id)){
            $raw['projectname'] = $projectname[0]->name_project;
        }else{
            $raw['projectname'] = "";
        }
        
        if($projectclient = $this->minvoices->GetProjectClients($id)){
            $raw['projectclient'] = $projectclient[0]->projectclients;
        }else{
            $raw['projectclient'] = "";
        }
        
        if($projectaddress = $this->minvoices->GetProjectData($id)){
            $raw['projectaddress'] = $projectaddress[0]->address_project;
        }else{
            $raw['projectaddress'] = "";
        }
        
        if($vendorname = $this->minvoices->GetVendorName($id)){
            $raw['vendorname'] = $vendorname[0]->name_vendors;
        }else{
            $raw['vendorname'] = "";
        }
        
        if($vendorcompany = $this->minvoices->GetVendorCompany($id)){
            $raw['vendorcompany'] = $vendorcompany[0]->title;
        }else{
            $raw['vendorcompany'] = ""; 
        }
        
        if($vendordate = $this->minvoices->GetVendorName($id)){
            $raw['vendordate'] = $vendordate[0]->added_date_vendors;
        }else{
            $raw['vendordate'] = "";  
        }
        
        if($vendorproducts = $this->minvoices->GetTotalVendorProducts($id)){
            $raw['vendorproduct'] = $vendorproducts[0]->totalproducts;
        }else{
           $raw['vendorproduct'] = ""; 
        }
        
        
        $raw['ordernumber'] = $id;
        
        if($orderdate = $this->minvoices->GetOrderDate($id)){
            $raw['orderdate'] = $orderdate[0]->date_order;
        }else{
            $raw['orderdate'] = "";
        }
        
        if($orderdeditems = $this->minvoices->GetOrderdedItems($id)){
            $raw['orderitems']= $orderdeditems[0]->totalordeditems;
        }else{
            $raw['orderitems']= "";
        }
        
        if($delivereditems = $this->minvoices->GetDeliveredItems($id)){
            $raw['delivereditems']= $delivereditems[0]->totaldelivereditems;
        }else{
            $raw['delivereditems']= "";
        }
        
        if($productlist = $this->minvoices->GetAllVendorProducts($id)){
            $raw['productlist'] = $productlist;
        }else{
            $raw['productlist'] = "";
        }
        
        if($payment = $this->minvoices->GetOrdersPayments($id)){
            $raw['orderspaymentlist'] = $payment;
        }else{
            $raw['orderspaymentlist'] = "";
        }
        
        if($totalordersamount = $this->minvoices->GetTotalOrdersAmount($id)){
            $gettotalordersamount= $totalordersamount[0]->totalordersamount;
            $raw['totalordersamount'] = number_format((float)$gettotalordersamount,2,'.','');

        }else{
            $gettotalordersamount= "";
            $raw['totalordersamount'] = "";
        }
        
        
        if($totalamountpaid = $this->minvoices->GetTotalPaymentPaid($id)){
            $gettotalamountpaid = $totalamountpaid[0]->totalpaidamount;
            $raw['totalamountpaid'] = number_format((float)$gettotalamountpaid,2,'.','');
        }else{
            $gettotalamountpaid = "";
            $raw['totalamountpaid'] = "";
        }
        
        $rests = $raw['totalordersamount'] - $raw['totalamountpaid'];
        
        $raw['rest'] = number_format((float)$rests,2,'.','');
        
        if($orderpaymentstatus = $this->minvoices->GetPaymentOrderStatus($id)){
            $raw['orderpystatus']= $orderpaymentstatus[0]->status_payment_order;
        }else{
            $raw['orderpystatus']= "";
        }
        
        
        
        $data['content'] = $this->load->view("backend/pages/invoices",$raw , true);
        $this->load->view("backend/template",$data);
    }
    
    function deleteitems()
    {
        $id=$this->uri->segment(3);
        $id2 = $this->uri->segment(4);
	$result=$this->minvoices->DeleteItems($id);
	$this->session->set_flashdata('userdatasavestatus',$result);
	redirect("invoices/items/$id2",'refresh');  
    }
    
    function insertitems()
    {
        $id = $this->input->post('fk_orders_opd');
        $results = $this->minvoices->InsertItemsForOrder();
        $this->session->set_flashdata('userdatasavestatus',$results);
        redirect("invoices/items/$id",'refresh');
    }
    
    function itemsdelivered()
        {
            $id = $this->uri->segment(4);
            $result=$this->minvoices->ChangeItemsDeliveryStatus(1);
            $this->session->set_flashdata('message',$result);
            redirect("invoices/items/$id",'refresh');
        }	
    
    function itemsnotdelivered()
        {
            $id = $this->uri->segment(4);
            $result=$this->minvoices->ChangeItemsDeliveryStatus(0);
            $this->session->set_flashdata('message',$result);
            redirect("invoices/items/$id",'refresh');
        }
    
    function insertpayments()
       {
        $id = $this->input->post('fk_orders_prodvent');
        $results = $this->minvoices->InsertOrderPayments();
        $this->session->set_flashdata('userdatasavestatus',$results);
        redirect("invoices/items/$id",'refresh');
    }  
    
    function deletepayments()
    {
        $id=$this->uri->segment(3);
        $id2 = $this->uri->segment(4);
	$result=$this->minvoices->DeletePayments($id);
	$this->session->set_flashdata('userdatasavestatus',$result);
	redirect("invoices/items/$id2",'refresh');  
    }
    
    function orderpymclearedstatus()
        {
            $id = $this->uri->segment(3);
            $result=$this->minvoices->ChangeOrderPaymentStatus(1);
            $this->session->set_flashdata('message',$result);
            redirect("invoices/items/$id",'refresh');
        }	
    
    function orderpymnotclearedstatus()
        {
            $id = $this->uri->segment(3);
            $result=$this->minvoices->ChangeOrderPaymentStatus(2);
            $this->session->set_flashdata('message',$result);
            redirect("invoices/items/$id",'refresh');
        }
        
    function orderpymclearedstatusmain()
        {
            
            $result=$this->minvoices->ChangeOrderPaymentStatus(1);
            $this->session->set_flashdata('message',$result);
            redirect("invoices/createdinvoices",'refresh');
        }	
    
    function orderpymnotclearedstatusmain()
        {
            
            $result=$this->minvoices->ChangeOrderPaymentStatus(2);
            $this->session->set_flashdata('message',$result);
            redirect("invoices/createdinvoices",'refresh');
        }
     
    function addmobilemenu(){
       $raw = array();
        if (isset($_POST['name'])) {
            $this->insertmobilemenu();
        } 
        $this->createdinvoices();
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

        $results = $this->minvoices->InsertMenuSection($insert_data);
        if ($results == 0) {
            
            $results = '<div class="alert alert-danger"><strong>Error ! Menu Already Added !</strong></div>';
        } else {
            $results = '<div class="alert alert-success"><strong>Successful !</strong> Data Added..</div>';
        } 
        $this->session->set_flashdata('userdatasavestatus', $results);
        redirect("$segment1/$segment2", 'refresh');
    }
}