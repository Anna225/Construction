<?php
class vendor extends CI_Controller 
{
    function __construct()
        {
            parent::__construct();
            if($this->session->userdata('logged_in') !== TRUE){
            redirect('login');
            }
            $this->load->model('mvendors');
        }
	
    function index()
    {
        $vendorslist = $this->mvendors->VendorsList();
        $raw['vendorslist'] = $vendorslist;
        
        $data['content'] = $this->load->view("backend/pages/vendors",$raw , true);
        $this->load->view("backend/template",$data);
    }
    
    function add()
    {
        $raw = array();
        $data['content'] = $this->load->view('backend/pages/vendors/add',$raw , true);
        $this->load->view('backend/template',$data);
    }
    
    function insert()
    {
        $results = $this->mvendors->VendorsInsert();
        $this->session->set_flashdata('userdatasavestatus',$results);
        redirect('vendor','refresh');
    }
    
    function edit()
    {
        if(count($_POST)>0)
        {
            $this->db->where("id_vendors",$this->uri->segment(3));
            $this->db->update("vendors",$_POST);
            redirect("vendor");
        }
        
                $this->db->where("id_vendors", $this->uri->segment(3));
		$feeds = $this->db->get("vendors");
		$raw['vendorsfeeds'] = $feeds->row();
                
            $data['content'] = $this->load->view("backend/pages/vendors/edit", $raw, true);
            $this->load->view("backend/template", $data);   
    }
    
    function delete()
    {
       $id=$this->uri->segment(3);
	$result=$this->mvendors->DeleteVendors($id);
	$this->session->set_flashdata('userdatasavestatus',$result);
	redirect('vendor','refresh');   
    }
    
    function products()
    {
        $id = $this->uri->segment(3);
        $vendorsproducts = $this->mvendors->GetVendorsProducts($id);
        $raw['vendorproductslist'] = $vendorsproducts;
        
        $data['content'] = $this->load->view("backend/pages/vendors/products/products",$raw , true);
        $this->load->view("backend/template",$data);
    }
    
    function addproducts()
    {
        $id = $this->uri->segment(3);
        $vendors = $this->mvendors->LoadVendor($id);
        $raw['vendorlist'] = $vendors;
        $data['content'] = $this->load->view('backend/pages/vendors/products/add',$raw , true);
        $this->load->view('backend/template',$data);
        
    }
    
    function insertproducts()
    {
        $id = $this->input->post("id");
        $results = $this->mvendors->InsertVendorsProducts();
        $this->session->set_flashdata('userdatasavestatus',$results);
        redirect("vendor/products/$id",'refresh');
    }
    
    function editproducts()
    {
        $id = $this->uri->segment(3);
        $vendorlist = $this->mvendors->GetVenderListDrpDwn($id);
        $raw['vendorlist'] = $vendorlist;
        
        $productlist = $this->mvendors->GetProductListDrpDwn($id);
        $raw['productslist'] = $productlist;
        
        
        
        if(count($_POST)>0)
        {
            $id1 = $this->input->post('fk_vendors_prodvend');
            $this->db->where("id_prodvend",$id);
            $this->db->update("prodvend",$_POST);
            redirect("vendor/products/$id1");
        }
        
                $this->db->where("id_prodvend", $this->uri->segment(3));
		$products = $this->db->get("prodvend");
		$raw['vendorsproducts'] = $products->row();
                
            $data['content'] = $this->load->view("backend/pages/vendors/products/edit", $raw, true);
            $this->load->view("backend/template", $data);   
    }
    
    function deleteproducts()
    {
       $id=$this->uri->segment(3);
       $vendorid=$this->uri->segment(4);
       
       
	$result=$this->mvendors->DeleteProducts($id);
	$this->session->set_flashdata('userdatasavestatus',$result);
	redirect("vendor/products/$vendorid",'refresh');   
    }
}