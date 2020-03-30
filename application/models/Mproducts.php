<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class MProducts extends CI_Model {
        
        

        public function __construct()
        {
            parent::__construct();
            
        }

        function GetPoroductsList()
        {
            $baseurl = base_url();
            // $sql = "select * from products p join subcategories s join categories c where s.id_subcategory = p.fk_subcategories and c.id_category = s.fk_category_subcategory";
            $sql = "
            select 
            p.id_product, 
            p.name_product, 
            s.title as subcategory, 
            c.title as category, 
            c.class as icon_class, 
            p.status_product as status
            from 
            products p 
            join packages_stages_subcategories s 
            join packages_stages_categories c 
            where 
            s.id = p.fk_subcategories and 
            c.id = s.fk_stages_categories";
            $query = $this->db->query($sql)->result_array();
            $i = 0;
            foreach ($query as $key => $row) 
            {
                $sql1 = "
                select 
                c.title as company 
                from 
                products_join_companies j
                join packages_companies c 
                where
                j.fk_product = ". $row['id_product'] ." and 
                j.fk_company = c.id";
                $query1 = $this->db->query($sql1)->result_array();
                $company_names = "";
                foreach ($query1 as $key1 => $row1) 
                {
                    $company_names .= $row1['company'].", ";
                }

                $query[$key]['companies'] = $company_names;  

               $var = '<a class="btn btn-success" href="'.$baseurl.'products/addvendors/'.$row['id_product'].'"><i class="fa fa-user-circle"></i> Add </a>
                       <a class="btn btn-warning" href="'.$baseurl.'products/vendors/'.$row['id_product'].'"><i class="fa fa-user-circle"></i> Load </a>
                        <a class="btn btn-info" href="'.$baseurl.'products/edit/'.$row['id_product'].'"><i class="fa fa-edit "></i></a>
                        <a class="btn btn-danger" href="'.$baseurl.'products/delete/'.$row['id_product'].'"><i class="fa fa-trash-o "></i></a>';
                
                $i++;
        	   $query[$key]['action'] = $var;  
                
            }
            $data['records'] = $query;
            return $data;
        }

        function GetPoroductsFilteredList($fk_company, $fk_product, $fk_category, $fk_subcategory)
        {
            $baseurl = base_url();
            $where = "";
            if($fk_company != 0){
                $where .= "j.fk_company = '".$fk_company."' and ";
            }else{
                $where .= "";
            }

            if($fk_product != 0){
                $where .= "p.id_product = '". $fk_product ."' and ";
            }else{
                $where .= "";
            }

            if($fk_category != 0){
                $where .= "c.id = '".$fk_category."' and ";
            }else{
                $where .= "";
            }

            if($fk_subcategory != 0){
                $where .= "s.id = '".$fk_subcategory."' and ";
            }else{
                $where .= "";
            }

            $sql = "
            select 
            p.id_product, 
            p.name_product, 
            s.title as subcategory, 
            c.title as category, 
            c.class as icon_class, 
            p.status_product as status
            from 
            products p 
            join packages_stages_subcategories s 
            join packages_stages_categories c 
            join products_join_companies j 
            where 
            j.fk_product = p.id_product and 
            s.id = p.fk_subcategories and
            ".$where." 
            c.id = s.fk_stages_categories
            group by p.id_product";
            $query = $this->db->query($sql)->result_array();
            $i = 0;
            foreach ($query as $key => $row) 
            {
                $sql1 = "
                select 
                c.title as company 
                from 
                products_join_companies j
                join packages_companies c 
                where
                j.fk_product = ". $row['id_product'] ." and 
                j.fk_company = c.id";
                $query1 = $this->db->query($sql1)->result_array();
                $company_names = "";
                foreach ($query1 as $key1 => $row1) 
                {
                    $company_names .= $row1['company'].", ";
                }

                $query[$key]['companies'] = $company_names;  
                $var = '<a class="btn btn-success" href="'.$baseurl.'products/addvendors/'.$row['id_product'].'"><i class="fa fa-user-circle"></i> Add </a>
                       <a class="btn btn-warning" href="'.$baseurl.'products/vendors/'.$row['id_product'].'"><i class="fa fa-user-circle"></i> Load </a>
                        <a class="btn btn-info" href="'.$baseurl.'products/edit/'.$row['id_product'].'"><i class="fa fa-edit "></i></a>
                        <a class="btn btn-danger" href="'.$baseurl.'products/delete/'.$row['id_product'].'"><i class="fa fa-trash-o "></i></a>';
                
                $i++;
                $query[$key]['action'] = $var;  
                
            }
            $data['records'] = $query;
            return $data;
        }

        function GetJoinedPoroductsList()
        {
            $baseurl = base_url();
            // $sql = "select * from products p join subcategories s join categories c where s.id_subcategory = p.fk_subcategories and c.id_category = s.fk_category_subcategory";
            $sql = "
            select 
            p.id_product, 
            p.name_product, 
            c.title AS company 
            from 
            products_join_companies j
            join products p 
            join packages_companies c 
            where 
            j.fk_product = p.id_product AND 
            j.fk_company = c.id
            group by j.fk_product";
            $query = $this->db->query($sql)->result_array();
            foreach ($query as $key => $row) 
            {
                $sql1 = "
                select 
                c.title as company 
                from 
                products_join_companies j
                join packages_companies c 
                where
                j.fk_product = ". $row['id_product'] ." and 
                j.fk_company = c.id";
                $query1 = $this->db->query($sql1)->result_array();
                $company_names = "";
                foreach ($query1 as $key1 => $row1) 
                {
                    $company_names .= $row1['company'].", ";
                }

                $query[$key]['companies'] = $company_names;  
                
            }
            $data['records'] = $query;
            return $data;
        }
        
        function InsertProducts()
        {
            $data = array(
                        'name_product'=>$this->input->post('name_product'),
                        'fk_subcategories'=>$this->input->post('fk_subcategories'),
                        'status_product'=>$this->input->post('status_product'),
                        'order_product'=>$this->input->post('order_product')
                );
            $message = "Data inserted successfully";
            $this->db->insert('products',$data);
            return $message;
        }
        
        function InsertJoinData()
        {
            $query = $this->db->query('SELECT * FROM products_join_companies WHERE fk_product = "'. $this->input->post('fk_product') .'" AND fk_company = "'. $this->input->post('fk_company') .'"');
            $check_row = $query->num_rows();
            $data = array(
                        'fk_product'=>$this->input->post('fk_product'),
                        'fk_company'=>$this->input->post('fk_company')
                );
            if($check_row > 0){
                $message = "Data already joined";
            }else{
                $message = "Data joined successfully";
                $this->db->insert('products_join_companies',$data);
            }
            return $message;
        }
        
        function DeleteProducts($id)
        {
         $this->db->where('id_product', $id);
         $this->db->delete('products');
            
            $message = " Data deleted successfully";
            return $message;   
        }
        
        function getSubCategoryDrpdwn($id)
        {
          
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

        function getCompanyDrpdwn()
         {
           $sql="select id,title from packages_companies ";

           $records=$this->db->query($sql)->result();

           $drpdown=array();

           $drpdwn[0]="Select Company";

           foreach($records as $record)

           {

            $drpdwn[$record->id]=$record->title;

           }

           return $drpdwn;
         }

        function getProductDrpdwn()
         {
           $sql="select id_product, name_product from products ";

           $records=$this->db->query($sql)->result();

           $drpdown=array();

           $drpdwn[0]="Select Product";

           foreach($records as $record)

           {

            $drpdwn[$record->id_product]=$record->name_product;

           }

           return $drpdwn;
         }

        function getCategoryDrpdwn()
         {
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

      
        function GetEditSubCategoryListDrpDwn($id)
        {
		$query=$this->db->get_where('products',array('id_product'=>$id));
                foreach($query->result() as $rows)
                {
                    $categoryparrent=array(
                    'fk_subcategory'=>$rows->fk_subcategories
                     );
                }
  
            
            $select = array();
  
            $query1=$this->db->get('subcategories');
                foreach($query1->result_array() as $row)
                {
                    /////////Your Condition ////////////
                    if($row['id_subcategory'] == $categoryparrent['fk_subcategory'])
                    {            
                    $options [$row['id_subcategory']] = $row['name_subcategory'];
                    $select = $row['id_subcategory'] ; 
                    }
                    else
                    {
                    $options [$row['id_subcategory']] = $row['name_subcategory'];
                    }
                }
  
            $data['options']=$options;
            $data['select']=$select;
            return $data;
	}
        
        function GetProductsVendors($id)
        {
            $baseurl = base_url();
            if($id != NULL)
            {
            $sql = "SELECT * FROM  prodvend p join products pd join vendors v join subcategories s join categories c
                    where p.fk_products_prodvend = pd.id_product and p.fk_vendors_prodvend = v.id_vendors and pd.fk_subcategories = s.id_subcategory and s.fk_category_subcategory = c.id_category and p.fk_products_prodvend =  '$id'";
            }
            else
            {
             $sql = "SELECT * FROM  prodvend p join products pd join vendors v join subcategories s join categories c
                    where p.fk_products_prodvend = pd.id_product and p.fk_vendors_prodvend = v.id_vendors and pd.fk_subcategories = s.id_subcategory and s.fk_category_subcategory = c.id_category";   
            }
            $query = $this->db->query($sql)->result_array();
            $i=0;
            foreach ($query as $key => $row) 
            {
              $var = '<a class="btn btn-success" href="'.$baseurl.'invoices/add/'.$row['id_prodvend'].'"><i class="fa fa-search-plus "></i></a>
                        <a class="btn btn-info" href="'.$baseurl.'products/editvendors/'.$row['id_prodvend'].'"><i class="fa fa-edit "></i></a>
                        <a class="btn btn-danger" href="'.$baseurl.'products/deletevendors/'.$row['id_prodvend'].'/'.$this->uri->segment(3).'"><i class="fa fa-trash-o "></i></a>';
                
                $i++;
        	$query[$key]['action'] = $var;  
                
            }
            $data['records'] = $query;
            return $data;
            
        }
        
        function LoadProducts($id)
        {
          
            $sql="select * from products where id_product = '$id'";
            $records=$this->db->query($sql)->result();
            $drpdwn ="";
            foreach($records as $record)
            {
                $drpdwn[$record->id_product]=$record->name_product;
            }
            
           return $drpdwn;
            
          
        }
        
        function LoadVendors()
        {
          
            $sql="select * from vendors";
            $records=$this->db->query($sql)->result();
            $drpdwn ="";
            foreach($records as $record)
            {
                $drpdwn[$record->id_vendors]=$record->name_vendors;
            }
            
           return $drpdwn;
            
          
        }
        
        function InsertProductsVendors()
        {
           $data = array(
                        'fk_products_prodvend'=>$this->input->post('fk_products_prodvend'),
                        'fk_vendors_prodvend'=>$this->input->post('fk_vendors_prodvend'),
                        'date_prodvend'=>$this->input->post('date_prodvend'),
                        'status_prodvend'=>$this->input->post('status_prodvend'),
                        'order_prodvend'=>$this->input->post('order_prodvend')
                        
                );
            $message = "Data inserted successfully";
            $this->db->insert('prodvend',$data);
            return $message;  
        }
        
        function GetVenderListDrpDwn($id)
	{
		$query=$this->db->get_where('prodvend',array('id_prodvend'=>$id));
                foreach($query->result() as $rows)
                {
                    $vendorparrent=array(
                    'fk_vendors'=>$rows->fk_vendors_prodvend
                     );
                }
  
            
            $select = array();
  
            $query1=$this->db->get('vendors');
                foreach($query1->result_array() as $row)
                {
                    /////////Your Condition ////////////
                    if($row['id_vendors'] == $vendorparrent['fk_vendors'])
                    {            
                    $options [$row['id_vendors']] = $row['name_vendors'];
                    $select = $row['id_vendors'] ; 
                    }
                    else
                    {
                    $options [$row['id_vendors']] = $row['name_vendors'];
                    }
                }
  
            $data['options']=$options;
            $data['select']=$select;
            return $data;
	}
        
        function GetProductListDrpDwn($id)
	{
		$query=$this->db->get_where('prodvend',array('id_prodvend'=>$id));
                foreach($query->result() as $rows)
                {
                    $productparrent=array(
                    'fk_products'=>$rows->fk_products_prodvend
                     );
                }
  
            
            $select = array();
  
            $query1=$this->db->get('products');
                foreach($query1->result_array() as $row)
                {
                    /////////Your Condition ////////////
                    if($row['id_product'] == $productparrent['fk_products'])
                    {            
                    $options [$row['id_product']] = $row['name_product'];
                    $select = $row['id_product'] ; 
                    }
                    else
                    {
                    $options [$row['id_product']] = $row['name_product'];
                    }
                }
  
            $data['options']=$options;
            $data['select']=$select;
            return $data;
	}
        
        function DeleteVendors($id)
        {
         $this->db->where('id_prodvend', $id);
         $this->db->delete('prodvend');
            
            $message = " Data deleted successfully";
            return $message;    
        }
        
        function GetProdVendList()
        {
            $baseurl = base_url();
            $sql = "select * from prodvend p join products pd join vendors v join subcategories s join categories c
                    where p.fk_products_prodvend = pd.id_product and v.id_vendors = p.fk_vendors_prodvend and pd.fk_subcategories = s.id_subcategory and c.id_category = s.fk_category_subcategory";
            $query = $this->db->query($sql)->result_array();
            $i = 0;
            foreach ($query as $key => $row) 
            {
              $var = '<a class="btn btn-danger" href="'.$baseurl.'products/deleteprodvend/'.$row['id_prodvend'].'"><i class="fa fa-trash-o "></i></a>';
                
                $i++;
        	$query[$key]['action'] = $var;  
                
            }
            $data['records'] = $query;
            return $data;
        }
        
        function DeletePredVend($id)
        {
         $this->db->where('id_prodvend', $id);
         $this->db->delete('prodvend');
            
            $message = " Data deleted successfully";
            return $message;   
        }
        
        function getTotalVendors($id)
        {
            $sql = "select count(*) as totalproducts from prodvend p join vendors v join products pd where v.id_vendors = p.fk_vendors_prodvend and pd.id_product = p.fk_products_prodvend and pd.id_product = $id ";
            $query = $this->db->query($sql);
            return $query->result();
            
        }
    }