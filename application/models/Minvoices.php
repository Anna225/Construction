<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class Minvoices extends CI_Model {
        
        

        public function __construct()
        {
            parent::__construct();
            
        }

        function GetOrdersList()
        {
            $baseurl = base_url();
            $sql = "
            select * 
            from 
            orders o 
            join orders_prodvend opv 
            join projects_list p 
            where 
            opv.fk_orders_opd = o.id_order and
            p.id_project = o.fk_project 
            group by o.id_order";
            $query = $this->db->query($sql)->result_array();
            $i = 0;
            foreach ($query as $key => $row) 
            {
              $var = '<a class="btn btn-info" href="'.$baseurl.'invoices/items/'.$row['id_order'].'"><i class="fa fa-edit "></i></a>
                        <a class="btn btn-danger" href="'.$baseurl.'invoices/deletecreatedinvoices/'.$row['id_order'].'"><i class="fa fa-trash-o "></i></a>';
                
                $i++;
        	$query[$key]['action'] = $var;  
                
            }
            $data['records'] = $query;
            return $data;
        }

        function GetOrdersListByOpen()
        {
            $baseurl = base_url();
            $sql = "
            select * 
            from 
            orders o 
            join orders_prodvend opv 
            join projects_list p 
            where 
            opv.fk_orders_opd = o.id_order and
            p.id_project = o.fk_project and
            o.status_payment_order = 0
            group by o.id_order";
            $query = $this->db->query($sql)->result_array();
            $i = 0;
            foreach ($query as $key => $row) 
            {
              $var = '<a class="btn btn-info" href="'.$baseurl.'invoices/items/'.$row['id_order'].'"><i class="fa fa-edit "></i></a>
                        <a class="btn btn-danger" href="'.$baseurl.'invoices/deletecreatedinvoices/'.$row['id_order'].'"><i class="fa fa-trash-o "></i></a>';
                
                $i++;
            $query[$key]['action'] = $var;  
                
            }
            $data['records'] = $query;
            return $data;
        }

        function GetOrdersListByClosed()
        {
            $baseurl = base_url();
            $sql = "
            select * 
            from 
            orders o 
            join orders_prodvend opv 
            join projects_list p 
            where 
            opv.fk_orders_opd = o.id_order and
            p.id_project = o.fk_project and
            o.status_payment_order = 1
            group by o.id_order";
            $query = $this->db->query($sql)->result_array();
            $i = 0;
            foreach ($query as $key => $row) 
            {
              $var = '<a class="btn btn-info" href="'.$baseurl.'invoices/items/'.$row['id_order'].'"><i class="fa fa-edit "></i></a>
                        <a class="btn btn-danger" href="'.$baseurl.'invoices/deletecreatedinvoices/'.$row['id_order'].'"><i class="fa fa-trash-o "></i></a>';
                
                $i++;
            $query[$key]['action'] = $var;  
                
            }
            $data['records'] = $query;
            return $data;
        }

        function GetOrdersFilteredList($fk_company, $fk_project)
        {
            $baseurl = base_url();
            $where = "";

            if($fk_company != 0){
                $where .= "o.fk_company = '".$fk_company."' and ";
            }else{
                $where .= "";
            }

            if($fk_project != 0){
                $where .= "o.fk_project = '".$fk_project."' and ";
            }else{
                $where .= "";
            }

            $sql = "
            select * 
            from 
            orders o 
            join orders_prodvend opv 
            join projects_list p 
            where 
            opv.fk_orders_opd = o.id_order and
            ".$where."
            p.id_project = o.fk_project
            group by o.id_order";
            $query = $this->db->query($sql)->result_array();
            $i = 0;
            foreach ($query as $key => $row) 
            {
              $var = '<a class="btn btn-info" href="'.$baseurl.'invoices/items/'.$row['id_order'].'"><i class="fa fa-edit "></i></a>
                        <a class="btn btn-danger" href="'.$baseurl.'invoices/deletecreatedinvoices/'.$row['id_order'].'"><i class="fa fa-trash-o "></i></a>';
                
                $i++;
            $query[$key]['action'] = $var;  
                
            }
            $data['records'] = $query;
            return $data;
        }

        function GetOpenedOrdersFilteredList($fk_company, $fk_project)
        {
            $baseurl = base_url();
            $where = "";

            if($fk_company != 0){
                $where .= "o.fk_company = '".$fk_company."' and ";
            }else{
                $where .= "";
            }

            if($fk_project != 0){
                $where .= "o.fk_project = '".$fk_project."' and ";
            }else{
                $where .= "";
            }

            $sql = "
            select * 
            from 
            orders o 
            join orders_prodvend opv 
            join projects_list p 
            where 
            opv.fk_orders_opd = o.id_order and
            p.id_project = o.fk_project and
            ".$where."
            o.status_payment_order = 0
            group by o.id_order";
            $query = $this->db->query($sql)->result_array();
            $i = 0;
            foreach ($query as $key => $row) 
            {
              $var = '<a class="btn btn-info" href="'.$baseurl.'invoices/items/'.$row['id_order'].'"><i class="fa fa-edit "></i></a>
                        <a class="btn btn-danger" href="'.$baseurl.'invoices/deletecreatedinvoices/'.$row['id_order'].'"><i class="fa fa-trash-o "></i></a>';
                
                $i++;
            $query[$key]['action'] = $var;  
                
            }
            $data['records'] = $query;
            return $data;
        }

        function GetClosedOrdersFilteredList($fk_company, $fk_project)
        {
            $baseurl = base_url();
            $where = "";

            if($fk_company != 0){
                $where .= "o.fk_company = '".$fk_company."' and ";
            }else{
                $where .= "";
            }

            if($fk_project != 0){
                $where .= "o.fk_project = '".$fk_project."' and ";
            }else{
                $where .= "";
            }

            $sql = "
            select * 
            from 
            orders o 
            join orders_prodvend opv 
            join projects_list p 
            where 
            opv.fk_orders_opd = o.id_order and
            p.id_project = o.fk_project and
            ".$where."
            o.status_payment_order = 1
            group by o.id_order";
            $query = $this->db->query($sql)->result_array();
            $i = 0;
            foreach ($query as $key => $row) 
            {
              $var = '<a class="btn btn-info" href="'.$baseurl.'invoices/items/'.$row['id_order'].'"><i class="fa fa-edit "></i></a>
                        <a class="btn btn-danger" href="'.$baseurl.'invoices/deletecreatedinvoices/'.$row['id_order'].'"><i class="fa fa-trash-o "></i></a>';
                
                $i++;
            $query[$key]['action'] = $var;  
                
            }
            $data['records'] = $query;
            return $data;
        }
        
        function GetOrderedItemsList($id)
        {
            $sql = "SELECT p.name_product FROM orders_prodvend op join prodvend pv join products p where op.fk_prodvend_opd = pv.id_prodvend and p.id_product = pv.fk_products_prodvend and op.fk_orders_opd = '$id' ";
            $query = $this->db->query($sql)->result_array();
            $data['records'] = $query;
            return $data;
            
        }
                
        function getOrdersListByVendors($id)
        {
            $baseurl = base_url();
            $sql = "select * from orders o join vendors v where v.id_vendors = o.fk_company and fk_company = $id";
            $query = $this->db->query($sql)->result_array();
            $i = 0;
            foreach ($query as $key => $row) 
            {
              $var = '<a class="btn btn-info" href="'.$baseurl.'invoices/items/'.$row['id_order'].'"><i class="fa fa-edit "></i></a>
                        <a class="btn btn-danger" href="'.$baseurl.'invoices/deletecreatedinvoices/'.$row['id_order'].'"><i class="fa fa-trash-o "></i></a>';
                
                $i++;
        	$query[$key]['action'] = $var;  
                
            }
            $data['records'] = $query;
            return $data;
        }

        function GetCompanyDrpdwn()
         {
           $sql="select c.id, c.title from packages_companies c join orders o where o.fk_company = c.id group by c.id";

           $records=$this->db->query($sql)->result();

           $drpdown=array();

           $drpdwn[0]="Select Company";

           foreach($records as $record)

           {

            $drpdwn[$record->id]=$record->title;

           }

           return $drpdwn;
         }

        function GetProjectDrpdwn()
         {
           $sql="select p.id_project, p.name_project from projects_list p join orders o where o.fk_project = p.id_project group by p.id_project";

           $records=$this->db->query($sql)->result();

           $drpdown=array();

           $drpdwn[0]="Select Project";

           foreach($records as $record)

           {

            $drpdwn[$record->id_project]=$record->name_project;

           }

           return $drpdwn;
         }

        
        function InsertInvoices()
        {
            $data = array(
                        'fk_company'=>$this->input->post('fk_company'),
                        'fk_project'=>$this->input->post('fk_project'),
                        'date_order'=>$this->input->post('date_order')
                );
            $message = "Data inserted successfully";
            $this->db->insert('orders',$data);
            return $message;
        }
        
        function getOrdersLastRow()
        {
            $sql = "SELECT MAX(`id_order`) as lastrecord from orders";
            $query = $this->db->query($sql);
            return $query->result();
        }
                
        function Deletecreatedinvoices($id)
        {
         $this->db->where('id_order', $id);
         $this->db->delete('orders');
            
            $message = " Data deleted successfully";
            return $message;   
        }
        
        function GetVendorList()
        {
            $select = array();
            $query=$this->db->get("vendors");
            foreach($query->result_array() as $rows)
            {
                $options [$rows['id_vendors']] = $rows['name_vendors'];
            }


            $data['options']=$options;
            $data['select']=$select;
            return $data;
	   }

        function GetProjectListDrpdwn()
        {
          
            $products= $this->db->get("projects_list");
            $records=$products->result();
            $drpdown=array();
            $drpdwn[0]="Select Project";
            foreach($records as $record)

            {

                $drpdwn[$record->id_project]=$record->name_project;

            }
            return $drpdwn;
          
        }

        function GetCategoryListDrpdwn()
        {
          
            $categories= $this->db->get("packages_stages_categories");
            $records=$categories->result();
            $drpdown=array();
            $drpdwn[0]="Select Category";
            foreach($records as $record)

            {

                $drpdwn[$record->id]=$record->title;

            }
            return $drpdwn;
          
        }

        function GetCompanyListDrpdwn()
        {
          
            $companies= $this->db->get("packages_companies");
            $records=$companies->result();
            $drpdown=array();
            $drpdwn[0]="Select Company";
            foreach($records as $record)

            {

                $drpdwn[$record->id]=$record->title;

            }
            return $drpdwn;
          
        }


        
         function GetVendorListByID($id)
        {
                $select = array();
		$query=$this->db->get_where('vendors',array('id_vendors'=>$id));
                foreach($query->result_array() as $rows)
                {
                    $options [$rows['id_vendors']] = $rows['name_vendors'];
                }
  
            
            $data['options']=$options;
            $data['select']=$select;
            return $data;
  
            
	}
        
        function GetitemsByOrderID($id)
        {
         $baseurl = base_url();
          $sql = "
                    select *, c.title AS category, sc.title AS subcategory, (op.qty_opd * op.price_opd) AS totalamount
                    from  
                    orders_prodvend op 
                    join orders o 
                    join products p 
                    join packages_stages_subcategories sc 
                    join packages_stages_categories c 
                    where 
                    op.fk_orders_opd = o.id_order and
                    p.id_product = op.fk_prodvend_opd and
                    p.fk_subcategories = sc.id and
                    sc.fk_stages_categories = c.id and 
                    o.id_order = $id";
            $query = $this->db->query($sql)->result_array();
            $i = 0;
            foreach ($query as $key => $row) 
            {
                $delvstatus = '';
                    if($row['status_delivery_opd']==1)
                        {
                        $delvstatus = '<a class="btn btn-success" href="'.$baseurl.'invoices/itemsnotdelivered/'.$row['id_opd'].'/'.$id.'"><i class="fa fa-truck "></i></a>';
                        }
                    else
                        {
                        $delvstatus ='<a class="btn btn-secondary" href="'.$baseurl.'invoices/itemsdelivered/'.$row['id_opd'].'/'.$id.'"><i class="fa fa-truck "></i></a>';
                        }
              $var = ''.$delvstatus.'
                        <a class="btn btn-danger" href="'.$baseurl.'invoices/deleteitems/'.$row['id_opd'].'/'.$id.'"><i class="fa fa-trash-o "></i></a>';
                
                $i++;
        	$query[$key]['action'] = $var;  
                
            }
            $data['records'] = $query;
            return $data;   
        }
        
        function GetProjectData($id)
        {
            $sql = "select * from projects_list p join orders o where  p.id_project = o.fk_project and o.id_order = $id";
            $query = $this->db->query($sql);
            return $query->result();
        }
        
        function GetProjectClients($id)
        {
            $sql = "select count(*) as projectclients from tbl_users u join orders o join projects_list p where  p.id_project = o.fk_project and p.joined_client = u.user_id and u.user_role = 'client' and o.id_order = $id";
            $query = $this->db->query($sql);
            return $query->result();
        }
        
        function GetVendorName($id)
        {
            $sql = "select * from orders od join vendors v where  v.id_vendors = od.fk_company and od.id_order = $id";
            $query = $this->db->query($sql);
            return $query->result();
        }

        function GetVendorCompany($id)
        {
          $sql = "select * from orders od join packages_companies c where  c.id = od.fk_company and od.id_order = $id";
            $query = $this->db->query($sql);
            return $query->result();   
        }

        function GetTotalVendorProducts($id)
        {
            $sql = "select count(*) as totalproducts from orders_prodvend where fk_orders_opd = $id";
            $query = $this->db->query($sql);
            return $query->result();
            
            
        }
        
        function GetOrderDate($id)
        {
            $sql = "select date_order from orders where id_order = $id";
            $query = $this->db->query($sql);
            return $query->result();
            
            
        }
        
        function GetOrderdedItems($id)
        {
            $sql = "select count(*) as totalordeditems from orders_prodvend o join orders od 
            where o.fk_orders_opd = od.id_order and od.id_order = $id ";
            $query = $this->db->query($sql);
            return $query->result();
        }
        
        function GetDeliveredItems($id)
        {
           $sql = "select count(*) as totaldelivereditems from orders_prodvend o join orders od 
            where o.fk_orders_opd = od.id_order and o.status_delivery_opd = 1 and od.id_order = $id ";
            $query = $this->db->query($sql);
            return $query->result();  
        }
        
        function DeleteItems($id)
        {
         $this->db->where('id_opd', $id);
         $this->db->delete('orders_prodvend');
            
            $message = " Data deleted successfully";
            return $message;   
        }
        
        function GetAllVendorProducts($id)
        {       
                $select = array();
/*		$sql = "select * from orders o join vendors v join prodvend p join products pd
                where o.fk_company = v.id_vendors and p.fk_vendors_prodvend = v.id_vendors and p.fk_products_prodvend = pd.id_product and o.id_order = $id";
*/        $sql = "
                select 
                p.id_product, 
                p.name_product 
                from 
                products p 
                join products_join_companies j
                join orders o 
                where 
                p.id_product = j.fk_product and 
                j.fk_company = o.fk_company and 
                o.id_order = $id";
                $query=$this->db->query($sql);
                $options = "";
                foreach($query->result_array() as $rows)
                {
                    $options [$rows['id_product']] = $rows['name_product'];
                }
            
            $data['options']=$options;
            $data['select']=$select;
            return $data;  
        }
        
        function InsertItemsForOrder()
        {
            $data = array(
                        'fk_prodvend_opd'=>$this->input->post('fk_prodvend_opd'),
                        'fk_orders_opd'=>$this->input->post('fk_orders_opd'),
                        'date_delivery_opd'=>$this->input->post('date_delivery_opd'),
                        'qty_opd'=>$this->input->post('qty_opd'),
                        'price_opd'=>$this->input->post('price_opd'),
                        'status_delivery_opd'=>$this->input->post('status_delivery_opd')
                );
            $message = "Data inserted successfully";
            $this->db->insert('orders_prodvend',$data);
            return $message;
        }
        
        function ChangeItemsDeliveryStatus($status)
        { 
            
            $sql="update orders_prodvend set status_delivery_opd=".$status.", date_delivery_opd = now()  where id_opd=".$this->uri->segment(3);
            $this->db->query($sql);
            $message="status updated successfully";
            return $message;
        }
        
        function GetOrdersPayments($id)
        {
         $baseurl = base_url();
         $sql ="select * from payments_opd p join orders o where o.id_order = p.fk_orders_prodvent and o.id_order = $id";
         $query = $this->db->query($sql)->result_array();
         $i = 0;
            foreach ($query as $key => $row) 
            {
              $var = '<a class="btn btn-info" href="'.$baseurl.'invoices/edit/'.$row['id_payment_opd'].'"><i class="fa fa-edit "></i></a>
                        <a class="btn btn-danger" href="'.$baseurl.'invoices/deletepayments/'.$row['id_payment_opd'].'/'.$id.'"><i class="fa fa-trash-o "></i></a>';
                
                $i++;
        	$query[$key]['action'] = $var;  
                
            }
            $data['records'] = $query;
            return $data;
        }
       
       function InsertOrderPayments()
        {
            $data = array(
                        'fk_orders_prodvent'=>$this->input->post('fk_orders_prodvent'),
                        'amount_payment_opd'=>$this->input->post('amount_payment_opd'),
                        'date_payment_opd'=>$this->input->post('date_payment_opd'),
                        'status_payment_opd'=>$this->input->post('status_payment_opd'),
                        'type_payment_opd'=>$this->input->post('type_payment_opd'),
                        'info_payment_opd'=>$this->input->post('info_payment_opd')
                );
            $message = "Data inserted successfully";
            $this->db->insert('payments_opd',$data);
            return $message;
        }
        
        function DeletePayments($id)
        {
         $this->db->where('id_payment_opd', $id);
         $this->db->delete('payments_opd');
            
            $message = " Data deleted successfully";
            return $message;   
        }
        
        function GetTotalOrdersAmount($id)
        {
         $sql = "select SUM(p.qty_opd * p.price_opd) as totalordersamount from orders o join orders_prodvend p where o.id_order = p.fk_orders_opd and o.id_order = $id";
            $query = $this->db->query($sql);
            return $query->result();   
        }
        
        function GetTotalPaymentPaid($id)
        {
         $sql = "select sum(amount_payment_opd) as totalpaidamount from payments_opd p join orders o where p.fk_orders_prodvent = o.id_order and o.id_order = $id";
            $query = $this->db->query($sql);
            return $query->result();   
        }
        
        function ChangeOrderPaymentStatus($status)
        {
            $sql="update orders set status_payment_order=".$status." where id_order=".$this->uri->segment(3);
            $this->db->query($sql);
            $message="status updated successfully";
            return $message;
        }
        
        function GetPaymentOrderStatus($id)
        {
         $sql = "select status_payment_order from orders where id_order = $id";
            $query = $this->db->query($sql);
            return $query->result();   
        }

        function InsertMenuSection($insert_data){
            $name = $insert_data['name'];
            $url = $insert_data['url'];
            $this->db->select('id');
            $query = $this->db->get_where('mobile_menu', array('name' => $name,'url' => $url));
            if ($query->num_rows() > 0) {
                return 0;
            } else {
                $this->db->insert('mobile_menu', $insert_data);
                return 1;
            }
        }
    }