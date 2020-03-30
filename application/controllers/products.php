<?php
class products extends CI_Controller 
{
    function __construct()
        {
            parent::__construct();
            if($this->session->userdata('logged_in') !== TRUE){
            redirect('login');
            }
            $this->load->model('mproducts');
        }
	
    function index()
    {
        $sub_id = 0;
        $products = $this->mproducts->GetPoroductsList();
        $raw['productslist'] = $products;
        $companyDropdown = $this->mproducts->getCompanyDrpdwn();
        $raw['companyDrpdwnList'] = $companyDropdown;
        $productDropdown = $this->mproducts->getProductDrpdwn();
        $raw['productDrpdwnList'] = $productDropdown;
        $categoryDropdown = $this->mproducts->getCategoryDrpdwn();
        $raw['categoryDrpdwnList'] = $categoryDropdown;
        $subcategoryDropdown = $this->mproducts->getSubCategoryDrpdwn($sub_id);
        $raw['subcategoryDrpdwnList'] = $subcategoryDropdown;
        $data['content'] = $this->load->view("backend/pages/products",$raw , true);
        $this->load->view("backend/template",$data);
    }
    
    function productfilter()
    {
        $sub_id = 0;
        $fk_company=$this->uri->segment(3);
        $fk_product=$this->uri->segment(4);
        $fk_category=$this->uri->segment(5);
        $fk_subcategory=$this->uri->segment(6);
        $products = $this->mproducts->GetPoroductsFilteredList($fk_company, $fk_product, $fk_category, $fk_subcategory);
        $raw['productslist'] = $products;
        $raw['selected_companyid'] = $fk_company;
        $raw['selected_productid'] = $fk_product;
        $raw['selected_categoryid'] = $fk_category;
        $raw['selected_subcategoryid'] = $fk_subcategory;
        $companyDropdown = $this->mproducts->getCompanyDrpdwn();
        $raw['companyDrpdwnList'] = $companyDropdown;
        $productDropdown = $this->mproducts->getProductDrpdwn();
        $raw['productDrpdwnList'] = $productDropdown;
        $categoryDropdown = $this->mproducts->getCategoryDrpdwn();
        $raw['categoryDrpdwnList'] = $categoryDropdown;
        if($fk_category !== 0){
            $subcategoryDropdown = $this->mproducts->getSubCategoryDrpdwn($fk_category);
        }else{
            $subcategoryDropdown = $this->mproducts->getSubCategoryDrpdwn($sub_id);
        }
        $raw['subcategoryDrpdwnList'] = $subcategoryDropdown;
        $data['content'] = $this->load->view("backend/pages/products",$raw , true);
        $this->load->view("backend/template",$data);
    }
    
    function add()
    {
        $id = 0;
        $subcategoriesdrpdwn=$this->mproducts->getSubCategoryDrpdwn($id);
        $raw['subcategoriesdrpdwnlist'] =  $subcategoriesdrpdwn;
        $data['content'] = $this->load->view('backend/pages/products/add',$raw , true);
        $this->load->view('backend/template',$data);
    }
    
    function joinProduct()
    {
        $raw = "";
        $data['content'] = $this->load->view('backend/pages/products/joinProduct',$raw , true);
        $this->load->view('backend/template',$data);
    }
    
    function joinProductList()
    {
        $products = $this->mproducts->GetJoinedPoroductsList();
        $raw['joinedproductslist'] = $products;
        $data['content'] = $this->load->view('backend/pages/products/joinProductList',$raw , true);
        $this->load->view('backend/template',$data);
    }
    
    function insert()
    {
        $results = $this->mproducts->InsertProducts();
        $this->session->set_flashdata('userdatasavestatus',$results);
        redirect('products','refresh');
    }
    function insertJoinData()
    {
        $results = $this->mproducts->InsertJoinData();
        $this->session->set_flashdata('userdatasavestatus',$results);
        redirect('products','refresh');
    }
    
    function edit()
    {
        $id = $this->uri->segment(3);
        $subcategory = $this->mproducts->GetEditSubCategoryListDrpDwn($id);
        $raw['subcategorylist'] = $subcategory;
        
        if(count($_POST)>0)
        {
            $this->db->where("id_product",$this->uri->segment(3));
            $this->db->update("products",$_POST);
            redirect("products");
        }
        
                $this->db->where("id_product", $this->uri->segment(3));
		$product = $this->db->get("products");
		$raw['products'] = $product->row();
                
            $data['content'] = $this->load->view("backend/pages/products/edit", $raw, true);
            $this->load->view("backend/template", $data);   
    }
    
    function delete()
    {
       $id=$this->uri->segment(3);
    	$result=$this->mproducts->DeleteProducts($id);
    	$this->session->set_flashdata('userdatasavestatus',$result);
    	redirect('products','refresh');   
    }
    
    function selectsubcategory()
	{
		$this->db->where("fk_stages_categories", $this->uri->segment(3));
		$subcategories= $this->db->get("packages_stages_subcategories");
		//echo $this->db->last_query();
		echo "<option value='0'>Select SubCategories</option>";

		foreach($subcategories->result() as $rows)
			echo "<option value='{$rows->id}'>{$rows->title}</option>";

	}
    
    function selectcompany()
    {
        $this->db->where("fk_stages_categories", $this->uri->segment(3));
        $company_id= $this->db->get("packages_stg_jn_comp");
        //echo $this->db->last_query();
        echo "<option value='0'>Select Company</option>";

        foreach($company_id->result() as $rows){
            $this->db->where("id", $rows->fk_companies);
            $company_id = $this->db->get("packages_companies");
            $company_row = $company_id->row();

            $this->db->where("id", $company_row->fk_countries);
            $country_id = $this->db->get("countries");
            $country_row = $country_id->row();
            if($company_row->id)
                echo "<option value='{$company_row->id}'>{$company_row->title} - {$country_row->name}</option>";  
        }
    }
    
    function selectproduct()
	{
		$this->db->where("fk_subcategories", $this->uri->segment(3));
		$products= $this->db->get("products");
		
		//echo $this->db->last_query();
		echo "<option value='0'>Select SubCategories</option>";

		foreach($products->result() as $rows)
			echo "<option value='{$rows->id_product}'>{$rows->name_product}</option>";

	}
    
    function vendors()
    {
        $id = $this->uri->segment(3);
        $productsvendors = $this->mproducts->GetProductsVendors($id);
        $raw['productsvendorslist'] = $productsvendors;
        
        $data['content']= $this->load->view("backend/pages/products/vendors/vendors",$raw,true);
        $this->load->view("backend/template",$data);
    }
    
    function addvendors()
    {
        $id = $this->uri->segment(3);
        $products = $this->mproducts->LoadProducts($id);
        $raw['productlist'] = $products;
        
        $vendors = $this->mproducts->LoadVendors();
        $raw['vendorslist'] = $vendors;
        
        $data['content'] = $this->load->view('backend/pages/products/vendors/add',$raw , true);
        $this->load->view('backend/template',$data);
        
    }
    
    function insertvendors()
    {
        $id = $this->input->post("id");
        $results = $this->mproducts->InsertProductsVendors();
        $this->session->set_flashdata('userdatasavestatus',$results);
        redirect("products/vendors/$id",'refresh');
    }
    
     function editvendors()
    {
        $id = $this->uri->segment(3);
        $vendorlist = $this->mproducts->GetVenderListDrpDwn($id);
        $raw['vendorlist'] = $vendorlist;
        
        $productlist = $this->mproducts->GetProductListDrpDwn($id);
        $raw['productslist'] = $productlist;
        
        
        
        if(count($_POST)>0)
        {
            $id1 = $this->input->post('fk_products_prodvend');
            $this->db->where("id_prodvend",$id);
            $this->db->update("prodvend",$_POST);
            redirect("products/vendors/$id1");
        }
        
                $this->db->where("id_prodvend", $this->uri->segment(3));
		$products = $this->db->get("prodvend");
		$raw['vendorsproducts'] = $products->row();
                
            $data['content'] = $this->load->view("backend/pages/products/vendors/edit", $raw, true);
            $this->load->view("backend/template", $data);   
    }
    
    function deletevendors()
    {
       $id=$this->uri->segment(3);
       $productid=$this->uri->segment(4);
       
       
	$result=$this->mproducts->DeleteVendors($id);
	$this->session->set_flashdata('userdatasavestatus',$result);
	redirect("products/vendors/$productid",'refresh');   
    }
    
    function prodvend()
    {
        $products = $this->mproducts->GetProdVendList();
        $raw['productslist'] = $products;
        $data['content'] = $this->load->view("backend/pages/prodvend",$raw , true);
        $this->load->view("backend/template",$data);   
    }
    
    function deleteprodvend()
    {
       $id=$this->uri->segment(3);
	$result=$this->mproducts->DeletePredVend($id);
	$this->session->set_flashdata('userdatasavestatus',$result);
	redirect('products/prodvend','refresh');   
    }
}