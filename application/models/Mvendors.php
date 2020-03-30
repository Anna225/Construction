<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class Mvendors extends CI_Model {
        
        

        public function __construct()
        {
            parent::__construct();
            
        }

        function VendorsList()
        {
            $baseurl = base_url();
            $sql = "select * from vendors";
            $query = $this->db->query($sql)->result_array();
            $i = 0;
            foreach ($query as $key => $row) 
            {
              $var = '<a class="btn btn-success" href="'.$baseurl.'vendor/addproducts/'.$row['id_vendors'].'"><i class="fa fa-product-hunt"></i> Add </a>
                       <a class="btn btn-warning" href="'.$baseurl.'vendor/products/'.$row['id_vendors'].'"><i class="fa fa-product-hunt"></i> Load </a>
                       <a class="btn btn-warning" href="'.$baseurl.'invoices/createdinvoices/'.$row['id_vendors'].'"><i class="fa fa-product-hunt"></i>+Order</a>
                        <a class="btn btn-info" href="'.$baseurl.'vendor/edit/'.$row['id_vendors'].'"><i class="fa fa-edit "></i></a>
                        <a class="btn btn-danger" href="'.$baseurl.'vendor/delete/'.$row['id_vendors'].'"><i class="fa fa-trash-o "></i></a>';
                
                $i++;
        	$query[$key]['action'] = $var;  
                
            }
            $data['records'] = $query;
            return $data;
        }
        
        function VendorsInsert()
        {
            $data = array(
                        'name_vendors'=>$this->input->post('name_vendors'),
                        'company_vendors'=>$this->input->post('company_vendors'),
                        'contact_vendors'=>$this->input->post('contact_vendors'),
                        'adress_vendors'=>$this->input->post('adress_vendors'),
                        'status_vendors'=>$this->input->post('status_vendors'),
                        'added_date_vendors'=>$this->input->post('added_date_vendors')
                );
            $message = "Data inserted successfully";
            $this->db->insert('vendors',$data);
            return $message;
        }
        
        function DeleteVendors($id)
        {
         $this->db->where('id_vendors', $id);
         $this->db->delete('vendors');
            
            $message = " Data deleted successfully";
            return $message;   
        }
        
        function GetVendorsProducts($id)
        {
            $baseurl = base_url();
            $sql = "SELECT * FROM  prodvend p join products pd join vendors v join subcategories s join categories c
                    where p.fk_products_prodvend = pd.id_product and p.fk_vendors_prodvend = v.id_vendors and pd.fk_subcategories = s.id_subcategory and s.fk_category_subcategory = c.id_category and p.fk_vendors_prodvend =  '$id'";
            $query = $this->db->query($sql)->result_array();
            $i=0;
            foreach ($query as $key => $row) 
            {
              $var = '<a class="btn btn-success" href="#"><i class="fa fa-search-plus "></i></a>
                        <a class="btn btn-info" href="'.$baseurl.'vendor/editproducts/'.$row['id_prodvend'].'"><i class="fa fa-edit "></i></a>
                        <a class="btn btn-danger" href="'.$baseurl.'vendor/deleteproducts/'.$row['id_prodvend'].'/'.$this->uri->segment(3).'"><i class="fa fa-trash-o "></i></a>';
                
                $i++;
        	$query[$key]['action'] = $var;  
                
            }
            $data['records'] = $query;
            return $data;
            
        }
        
        function LoadVendor($id)
        {
          
            $sql="select * from vendors where id_vendors = '$id'";
            $records=$this->db->query($sql)->result();
            $drpdwn ="";
            foreach($records as $record)
            {
                $drpdwn[$record->id_vendors]=$record->name_vendors;
            }
            
           return $drpdwn;
            
          
        }
        
        function InsertVendorsProducts()
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
        
        function DeleteProducts($id)
        {
         $this->db->where('id_prodvend', $id);
         $this->db->delete('prodvend');
            
            $message = " Data deleted successfully";
            return $message;    
        }
        
        function getTotalVendorProductsId($id)
        {
            $sql = "select count(*) as totalproducts from prodvend p join vendors v join products pd where v.id_vendors = p.fk_vendors_prodvend and pd.id_product = p.fk_products_prodvend and v.id_vendors = $id ";
            $query = $this->db->query($sql);
            return $query->result();
            
        }
       
    }