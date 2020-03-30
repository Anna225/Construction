<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mprojects extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    // List

   function GetProjectsList() {

        $baseurl = base_url();
        $sql = "select * from projects_list";
        $query = $this->db->query($sql)->result_array();
        $i = 0;
        foreach ($query as $key => $row) 
        {
          $var = '<a class="btn btn-info" href="'.$baseurl.'projects/edit/'.$row['id_project'].'"><i class="fa fa-edit "></i></a>
                    <a class="btn btn-danger" href="'.$baseurl.'projects/deleteCreatedProjects/'.$row['id_project'].'"><i class="fa fa-trash-o "></i></a>
                    <a class="btn btn-success" href="'.$baseurl.'projects/totalcost/'.$row['id_project'].'"><i class="fa fa-money "></i></a>';
            
            $i++;
        $query[$key]['action'] = $var;  
            
        }
        $data['records'] = $query;
        return $data;
    }

   function GetProjectsListByPending() {

        $baseurl = base_url();
        $sql = "select * from projects_list where fk_status = '0'";
        $query = $this->db->query($sql)->result_array();
        $i = 0;
        foreach ($query as $key => $row) 
        {
          $var = '<a class="btn btn-info" href="'.$baseurl.'projects/edit/'.$row['id_project'].'"><i class="fa fa-edit "></i></a>
                    <a class="btn btn-danger" href="'.$baseurl.'projects/deleteCreatedProjects/'.$row['id_project'].'"><i class="fa fa-trash-o "></i></a>';
            
            $i++;
        $query[$key]['action'] = $var;  
            
        }
        $data['records'] = $query;
        return $data;
    }

   function GetProjectsListByProgress() {

        $baseurl = base_url();
        $sql = "select * from projects_list where fk_status = '1'";
        $query = $this->db->query($sql)->result_array();
        $i = 0;
        foreach ($query as $key => $row) 
        {
          $var = '<a class="btn btn-info" href="'.$baseurl.'projects/edit/'.$row['id_project'].'"><i class="fa fa-edit "></i></a>
                    <a class="btn btn-danger" href="'.$baseurl.'projects/deleteCreatedProjects/'.$row['id_project'].'"><i class="fa fa-trash-o "></i></a>';
            
            $i++;
        $query[$key]['action'] = $var;  
            
        }
        $data['records'] = $query;
        return $data;
    }

   function GetProjectsListByCompleted() {

        $baseurl = base_url();
        $sql = "select * from projects_list where fk_status = '2'";
        $query = $this->db->query($sql)->result_array();
        $i = 0;
        foreach ($query as $key => $row) 
        {
          $var = '<a class="btn btn-info" href="'.$baseurl.'projects/edit/'.$row['id_project'].'"><i class="fa fa-edit "></i></a>
                    <a class="btn btn-danger" href="'.$baseurl.'projects/deleteCreatedProjects/'.$row['id_project'].'"><i class="fa fa-trash-o "></i></a>';
            
            $i++;
        $query[$key]['action'] = $var;  
            
        }
        $data['records'] = $query;
        return $data;
    }

   function GetProjectsTotalCost($id) {

        $baseurl = base_url();
        $sql = "select  
            po.`id_payment_opd` AS invoice_id,
            po.`date_payment_opd` AS invoice_date,
            po.`amount_payment_opd` AS invoice_amount,
            plist.name_project AS project,
            com.title AS company,
            pcate.class AS category_class,
            pcate.title AS category,
            sc.title AS subcategory,
            po.amount_payment_opd
            FROM 
            `payments_opd` po
            JOIN `orders` o
            JOIN `orders_prodvend` op
            JOIN `products` p
            JOIN `packages_stages_subcategories` sc 
            JOIN `packages_stg_jn_comp` pcom
            JOIN `packages_companies` com
            JOIN `packages_stages_categories` pcate
            JOIN `projects_list` plist
            WHERE
            po.fk_orders_prodvent = o.id_order AND
            plist.id_project = o.fk_project AND
            pcom.fk_companies = o.fk_company AND
            pcom.fk_companies = com.id AND
            p.fk_subcategories = sc.id AND
            p.id_product = op.fk_prodvend_opd AND
            op.fk_orders_opd = o.id_order AND
            pcate.id = pcom.`fk_stages_categories`";
        $query = $this->db->query($sql)->result_array();
        $data['records'] = $query;
        return $data;
    }

   function GetProjectsTotalCostCategories($id) {

        $baseurl = base_url();
        $sql = "select
            plist.id_project as project_id,
            pcate.id,
            pcate.class,
            pcate.title
            FROM 
            `payments_opd` po
            JOIN `orders` o
            JOIN `orders_prodvend` op
            JOIN `products` p
            JOIN `packages_stages_subcategories` sc 
            JOIN `packages_stg_jn_comp` pcom
            JOIN `packages_companies` com
            JOIN `packages_stages_categories` pcate
            JOIN `projects_list` plist
            WHERE
            po.fk_orders_prodvent = o.id_order AND
            plist.id_project = o.fk_project AND
            plist.id_project = '".$id."' AND
            pcom.fk_companies = o.fk_company AND
            pcom.fk_companies = com.id AND
            p.fk_subcategories = sc.id AND
            p.id_product = op.fk_prodvend_opd AND
            op.fk_orders_opd = o.id_order AND
            pcate.id = pcom.`fk_stages_categories`
            GROUP BY pcate.id";
        $query = $this->db->query($sql)->result();
        $data = $query;
        return $data;
    }

   function getTotalCostSubCateList($projectId, $categoryId) {

        $baseurl = base_url();
        $sql = "select
            plist.id_project as project_id,
            pcate.id as category_id,
            sc.id,
            sc.title
            FROM 
            `payments_opd` po
            JOIN `orders` o
            JOIN `orders_prodvend` op
            JOIN `products` p
            JOIN `packages_stages_subcategories` sc 
            JOIN `packages_stg_jn_comp` pcom
            JOIN `packages_companies` com
            JOIN `packages_stages_categories` pcate
            JOIN `projects_list` plist
            WHERE
            po.fk_orders_prodvent = o.id_order AND
            plist.id_project = o.fk_project AND
            plist.id_project = '".$projectId."' AND
            pcom.fk_companies = o.fk_company AND
            pcom.fk_companies = com.id AND
            p.fk_subcategories = sc.id AND
            p.id_product = op.fk_prodvend_opd AND
            op.fk_orders_opd = o.id_order AND
            pcate.id = '".$categoryId."' AND
            pcate.id = pcom.`fk_stages_categories`
            GROUP BY sc.id";
        $query = $this->db->query($sql)->result();
        $data = $query;
        return $data;
    }

   function getTotalCostCateAmount($projectId, $categoryId) {

        $baseurl = base_url();
        $sql = "select
            sum(po.amount_payment_opd) as category_amount
            FROM 
            `payments_opd` po
            JOIN `orders` o
            JOIN `orders_prodvend` op
            JOIN `products` p
            JOIN `packages_stages_subcategories` sc 
            JOIN `packages_stg_jn_comp` pcom
            JOIN `packages_companies` com
            JOIN `packages_stages_categories` pcate
            JOIN `projects_list` plist
            WHERE
            po.fk_orders_prodvent = o.id_order AND
            plist.id_project = o.fk_project AND
            plist.id_project = '".$projectId."' AND
            pcom.fk_companies = o.fk_company AND
            pcom.fk_companies = com.id AND
            p.fk_subcategories = sc.id AND
            p.id_product = op.fk_prodvend_opd AND
            op.fk_orders_opd = o.id_order AND
            pcate.id = '".$categoryId."' AND
            pcate.id = pcom.`fk_stages_categories`
            GROUP BY po.amount_payment_opd";
        $query = $this->db->query($sql)->row();
        $data = $query;
        return $data;
    }

   function getTotalCostSubCateAmount($projectId, $categoryId, $subCategoryId) {

        $baseurl = base_url();
        $sql = "select
            sum(po.amount_payment_opd) as subcate_amount
            FROM 
            `payments_opd` po
            JOIN `orders` o
            JOIN `orders_prodvend` op
            JOIN `products` p
            JOIN `packages_stages_subcategories` sc 
            JOIN `packages_stg_jn_comp` pcom
            JOIN `packages_companies` com
            JOIN `packages_stages_categories` pcate
            JOIN `projects_list` plist
            WHERE
            po.fk_orders_prodvent = o.id_order AND
            plist.id_project = o.fk_project AND
            plist.id_project = '".$projectId."' AND
            pcom.fk_companies = o.fk_company AND
            pcom.fk_companies = com.id AND
            p.fk_subcategories = sc.id AND
            sc.id ='".$subCategoryId."' AND
            p.id_product = op.fk_prodvend_opd AND
            op.fk_orders_opd = o.id_order AND
            pcate.id = '".$categoryId."' AND
            pcate.id = pcom.`fk_stages_categories`
            GROUP BY po.amount_payment_opd";
        $query = $this->db->query($sql)->row();
        $data = $query;
        return $data;
    }

    function GetClientDrpdwn()
     {
       $sql="select * from tbl_users where user_role = 'client'";
       $records=$this->db->query($sql)->result();
       $drpdown=array();
       $drpdwn[0]="Select Client";
       foreach($records as $record)
       {
        $drpdwn[$record->user_id]=$record->user_name;
       }
       return $drpdwn;
     }

   function ajaxJoinClient() {
        $data = [
            'joined_client' => $this->input->post('joined_clientid'),
        ];
        $this->db->where('id_project', $this->input->post('project_id'));
        $query = $this->db->update('projects_list', $data);
        if($query){
            echo json_encode(array('value' => 'true'));
        }else{
            echo json_encode(array('value' => 'false'));
        }
    }

   function ajaxGetProjectsById() {

        $this->db->where('id_project', $this->input->post('id'));
        $query = $this->db->get('projects_list');
        $row = $query->result_array(); 
        echo json_encode(array('value' => $row[0]));
    }

    function getListOfficeCategories() {

        $query = $this->db->get('office_categories');
        $return = array();

        foreach ($query->result() as $category) {
            $return[$category->id_categories] = $category;
            $return[$category->id_categories]->subs = $this->getListOfficeSubcategories($category->id_categories); // Get the categories sub categories
        }

        return $return;
    }

    function getListOfficeSubcategories($id_office_categories) {
        $this->db->where('fk_office_categories', $id_office_categories);
        $query = $this->db->get('office_subcategories');
        return $query->result();
    }
    
    function getListOfficeTypes(){
        
        $this->db->from('office_types');
        $this->db->order_by("orderby", "asc");
        $query = $this->db->get(); 
        return $query->result();
    }
    
    function getListOfficeClients()
        {
           $baseurl = base_url();
           $sql = "select id_clients,name_clients , city_clients , society_clients , ot.name as typename, name_subcategories , name_categories,date_clients,refby_clients
from office_clients oc join office_types ot join office_subcategories os join office_categories ct
where oc.fk_office_types = ot.id and os.id_subcategories = oc.fk_office_subcategories and ct.id_categories = os.fk_office_categories order by id_clients desc
";
           $query=$this->db->query($sql)->result_array();
           $i=0;
           foreach($query as $key=> $row)
           {
               $id = $row['id_clients'];
                $var = '<button class="btn btn-muted" data-toggle="modal" data-target="#phoneModal"><i class="fas fa-phone text-muted"></i></button>
                        <button class="btn btn-muted" data-toggle="modal" data-target="#userModal"><i class="fab fa-facebook-square text-muted"></i></button>   
                        <a  href="'.$baseurl.'categories/edit/'.$id.'"><i class="fa fa-edit "></i></a>
                        <a  href="'.$baseurl.'office/deleteofficeclients/'.$id.'"><i class="fas fa-trash-alt text-danger"></i></a>';
                $i++;
                
               $query[$key]['action'] = $var;
               
                
            }
            $data['records'] = $query;
            return $data;
        }
    function getListOfficeRequests(){
        {
           $baseurl = base_url();
           $sql = "select id_requests,id_clients,name_clients,refby_clients,date_requests,budget_requests , name_subcategories,name_categories ,r.city_requests as city ,r.society_requests as society ,ty.name as typename
from office_requests r join office_clients c join office_subcategories s join office_categories ct join office_types ty
where r.fk_office_clients = c.id_clients and s.id_subcategories = r.fk_office_subcategories and ct.id_categories = s.fk_office_categories and
ty.id = r.fk_office_types";
           $query=$this->db->query($sql)->result_array();
           $i=0;
           foreach($query as $key=> $row)
           {
               $id = $row['id_requests'];
                $var = '<button class="btn btn-muted" data-toggle="modal" data-target="#phoneModal"><i class="fas fa-phone text-muted"></i></button>
                        <button class="btn btn-muted" data-toggle="modal" data-target="#userModal"><i class="fab fa-facebook-square text-muted"></i></button>   
                        <a  href="'.$baseurl.'categories/edit/'.$id.'"><i class="fa fa-edit "></i></a>
                        <a  href="'.$baseurl.'office/deleteofficeclients/'.$id.'"><i class="fas fa-trash-alt text-danger"></i></a>';
                $i++;
                
               $query[$key]['action'] = $var;
               
                
            }
            $data['records'] = $query;
            return $data;
        }
        
    }
    //Insert

    function InsertProjects() {

        $config['upload_path']   = 'uploads/projects/';
        $config['allowed_types'] = '*';
        $config['file_name']     = 'project'.getdate()[0];
        $this->load->library('upload', $config);
        if ( $this->upload->do_upload('pj_image')){
            true;
        }else{
            false;
        }
        $name = $_FILES["pj_image"]["name"];
        $ext = end((explode(".", $name))); # extra () to prevent notice
        $data = array(
                    'name_project'=>$this->input->post('pj_name'),
                    'address_project'=>$this->input->post('pj_address'),
                    'joined_client'=>$this->input->post('pj_client'),
                    'amount_project'=>$this->input->post('pj_amount_client'),
                    'start_date'=>$this->input->post('pj_startdate'),
                    'end_date'=>$this->input->post('pj_enddate'),
                    'fk_status'=>$this->input->post('fk_status'),
                    'images_project'=>$config['upload_path'].$config['file_name'].".".$ext
            );

        $message = "Data inserted successfully";
        $this->db->insert('projects_list',$data);
        return $message;
    }

    function ChangeEditProject(){

        $this->db->where('id_project', $this->uri->segment(3));
        $query = $this->db->get('projects_list');
        $row = $query->row(); 
        $image_file = $row->images_project;

        if(isset($_FILES["pj_imageEdit"]["name"]) && !empty($_FILES["pj_imageEdit"]["name"])) {
            if(file_exists($image_file)){
                unlink($image_file);
            }

            $config['upload_path']   = 'uploads/projects/';
            $config['allowed_types'] = '*';
            $config['file_name']     = 'project'.getdate()[0];
            $this->load->library('upload', $config);
            if ( $this->upload->do_upload('pj_imageEdit')){
                true;
            }else{
                false;
            }
            $name = $_FILES["pj_imageEdit"]["name"];
            $ext = end((explode(".", $name))); # extra () to prevent notice

            $this->db->set('images_project', $config['upload_path'].$config['file_name'].".".$ext);
        }
        $this->db->set('name_project', $this->input->post('pj_nameEdit'));
        $this->db->set('address_project', $this->input->post('pj_addressEdit'));
        $this->db->set('joined_client', $this->input->post('pj_clientEdit'));
        $this->db->set('amount_project', $this->input->post('pj_amount_clientEdit'));
        $this->db->set('start_date', $this->input->post('pj_startdateEdit'));
        $this->db->set('end_date', $this->input->post('pj_enddateEdit'));
        $this->db->set('fk_status', $this->input->post('fk_status'));

        $this->db->where('id_project', $this->uri->segment(3));
        $this->db->update('projects_list');
        $message="status updated successfully";
        return $message;
    }



    function InsertOfficeCategories($insert_data) {
        $this->db->insert('office_categories', $insert_data);
    }

    function InsertOfficeSubCategoires($insert_data) {
        $this->db->insert('office_subcategories', $insert_data);
    }
    
    function InsertOfficeTypes($insert_data) {
        $this->db->insert('office_types', $insert_data);
    }
    
    function InsertOfficeClients($insert_data){
        
        
        $this->db->insert('office_clients', $insert_data);
    }
    
    function InsertOfficeClientsPhones($insert_data){
       $this->db->insert('phone', $insert_data); 
    }
    // DrpDwn 

    function getDrpDwnOfficeCategories() {
        $sql = "select * from office_categories";
        $records = $this->db->query($sql)->result();
        $drpdown = array();
        $drpdwn[0] = "Select Category";
        foreach ($records as $record) {
            $drpdwn[$record->id_categories] = $record->name_categories;
        }

        return $drpdwn;
    }
    
    function getDrpDwnOfficeTypes() {
        $sql = "select * from office_types";
        $records = $this->db->query($sql)->result();
        $drpdown = array();
        $drpdwn[0] = "Select Types";
        foreach ($records as $record) {
            $drpdwn[$record->id] = $record->name;
        }

        return $drpdwn;
    }
    
    
    // Delete

    function deleteProjects($id) {
        $this->db->where('id_project', $id);
        $this->db->delete('projects_list');
        $message = " Projects Data deleted successfully";
        return $message;
    }

    function DeleteOfficeCategories($id) {
        $this->db->where('id_categories', $id);
        $this->db->delete('office_categories');
        $message = " Office Categories Data deleted successfully";
        return $message;
    }
    
    function DeleteOfficeSubCategories($id) {
        $this->db->where('id_subcategories', $id);
        $this->db->delete('office_subcategories');
        $message = "Office Sub Categories Data deleted successfully";
        return $message;
    }
    
    function DeleteOfficeTypes($id){
       $this->db->where('id', $id);
        $this->db->delete('office_types');
        $message = "Office Types Data deleted successfully";
        return $message; 
    }
    
    function DeleteOfficeClients($id){
       $this->db->where('id_clients', $id);
        $this->db->delete('office_clients');
        $message = "Office Types Data deleted successfully";
        return $message; 
    }
    
    // Special Methods
    
    function getPhoneNumbers($client_id){
        
       $sql = "select number_phone,type_phone from phone where fk_office_clients = $client_id";
            $query = $this->db->query($sql);
            return $query->result_array();
        
    }
    
    function countTotalClients(){
    $sql = "SELECT count(*) as totalclients FROM office_clients";    
    $query = $this->db->query($sql)->result();    
    return $query;
    }

    function countReqConstPend(){
    $sql = "select count(*) as totalcounted
        from office_requests r join office_subcategories s join office_categories c
        where  s.id_subcategories = r.fk_office_subcategories and c.id_categories = s.fk_office_categories and
        r.status_requests = 0 and id_categories = 1";    
    $query = $this->db->query($sql)->result();    
    return $query;  
    }
    
    function countReqConstDeal(){
    $sql = "select count(*) as totalcounted
        from office_requests r join office_subcategories s join office_categories c
        where  s.id_subcategories = r.fk_office_subcategories and c.id_categories = s.fk_office_categories and
        r.status_requests = 1 and id_categories = 1";    
    $query = $this->db->query($sql)->result();    
    return $query;  
    }
    
    function countReqConstDone(){
    $sql = "select count(*) as totalcounted
        from office_requests r join office_subcategories s join office_categories c
        where  s.id_subcategories = r.fk_office_subcategories and c.id_categories = s.fk_office_categories and
        r.status_requests = 2 and id_categories = 1";    
    $query = $this->db->query($sql)->result();    
    return $query;  
    }
    
    function countReqConstReje(){
    $sql = "select count(*) as totalcounted
        from office_requests r join office_subcategories s join office_categories c
        where  s.id_subcategories = r.fk_office_subcategories and c.id_categories = s.fk_office_categories and
        r.status_requests = 3 and id_categories = 1";    
    $query = $this->db->query($sql)->result();    
    return $query;  
    }
    
    function countTotConstRequesrs(){
    $sql = "select count(*) as totalcounted
    from office_requests r join office_subcategories s join office_categories c
    where  s.id_subcategories = r.fk_office_subcategories and c.id_categories = s.fk_office_categories 
    and c.id_categories = 1";    
    $query = $this->db->query($sql)->result();    
    return $query;  
    }
    
    

    
    function countReqRenvPend(){
    $sql = "select count(*) as totalcounted
        from office_requests r join office_subcategories s join office_categories c
        where  s.id_subcategories = r.fk_office_subcategories and c.id_categories = s.fk_office_categories and
        r.status_requests = 0 and id_categories = 2";    
    $query = $this->db->query($sql)->result();    
    return $query;  
    }
    
    function countReqRenvDeal(){
    $sql = "select count(*) as totalcounted
        from office_requests r join office_subcategories s join office_categories c
        where  s.id_subcategories = r.fk_office_subcategories and c.id_categories = s.fk_office_categories and
        r.status_requests = 1 and id_categories = 2";    
    $query = $this->db->query($sql)->result();    
    return $query;  
    }
    
    function countReqRenvDone(){
    $sql = "select count(*) as totalcounted
        from office_requests r join office_subcategories s join office_categories c
        where  s.id_subcategories = r.fk_office_subcategories and c.id_categories = s.fk_office_categories and
        r.status_requests = 2 and id_categories = 2";    
    $query = $this->db->query($sql)->result();    
    return $query;  
    }
    
    function countReqRenvReje(){
    $sql = "select count(*) as totalcounted
        from office_requests r join office_subcategories s join office_categories c
        where  s.id_subcategories = r.fk_office_subcategories and c.id_categories = s.fk_office_categories and
        r.status_requests = 3 and id_categories = 2";    
    $query = $this->db->query($sql)->result();    
    return $query;  
    }
    
    function countTotRenvRequesrs(){
    $sql = "select count(*) as totalcounted
    from office_requests r join office_subcategories s join office_categories c
    where  s.id_subcategories = r.fk_office_subcategories and c.id_categories = s.fk_office_categories 
    and c.id_categories = 2";    
    $query = $this->db->query($sql)->result();    
    return $query;  
    }
    
    function countReqPropPend(){
    $sql = "select count(*) as totalcounted
        from office_requests r join office_subcategories s join office_categories c
        where  s.id_subcategories = r.fk_office_subcategories and c.id_categories = s.fk_office_categories and
        r.status_requests = 0 and c.id_categories = 4";    
    $query = $this->db->query($sql)->result();    
    return $query;  
    }
    
    function countReqPropDeal(){
    $sql = "select count(*) as totalcounted
        from office_requests r join office_subcategories s join office_categories c
        where  s.id_subcategories = r.fk_office_subcategories and c.id_categories = s.fk_office_categories and
        r.status_requests = 1 and c.id_categories = 4";    
    $query = $this->db->query($sql)->result();    
    return $query;  
    }
    
    function countReqPropDone(){
    $sql = "select count(*) as totalcounted
        from office_requests r join office_subcategories s join office_categories c
        where  s.id_subcategories = r.fk_office_subcategories and c.id_categories = s.fk_office_categories and
        r.status_requests = 2 and c.id_categories = 4";    
    $query = $this->db->query($sql)->result();    
    return $query;  
    }
    
    function countReqPropReje(){
    $sql = "select count(*) as totalcounted
        from office_requests r join office_subcategories s join office_categories c
        where  s.id_subcategories = r.fk_office_subcategories and c.id_categories = s.fk_office_categories and
        r.status_requests = 3 and c.id_categories = 4";    
    $query = $this->db->query($sql)->result();    
    return $query;  
    }
    
     function countTotPropRequesrs(){
    $sql = "select count(*) as totalcounted
    from office_requests r join office_subcategories s join office_categories c
    where  s.id_subcategories = r.fk_office_subcategories and c.id_categories = s.fk_office_categories 
    and c.id_categories = 4";    
    $query = $this->db->query($sql)->result();    
    return $query;  
    }
    
    function countReqDesgPend(){
    $sql = "select count(*) as totalcounted
        from office_requests r join office_subcategories s join office_categories c
        where  s.id_subcategories = r.fk_office_subcategories and c.id_categories = s.fk_office_categories and
        r.status_requests = 0 and c.id_categories = 3";    
    $query = $this->db->query($sql)->result();    
    return $query;  
    }
    
    function countReqDesgDeal(){
    $sql = "select count(*) as totalcounted
        from office_requests r join office_subcategories s join office_categories c
        where  s.id_subcategories = r.fk_office_subcategories and c.id_categories = s.fk_office_categories and
        r.status_requests = 1 and c.id_categories = 3";    
    $query = $this->db->query($sql)->result();    
    return $query;  
    }
    
    function countReqDesgDone(){
    $sql = "select count(*) as totalcounted
        from office_requests r join office_subcategories s join office_categories c
        where  s.id_subcategories = r.fk_office_subcategories and c.id_categories = s.fk_office_categories and
        r.status_requests = 2 and c.id_categories = 3";    
    $query = $this->db->query($sql)->result();    
    return $query;  
    }
    
    function countReqDesgReje(){
    $sql = "select count(*) as totalcounted
        from office_requests r join office_subcategories s join office_categories c
        where  s.id_subcategories = r.fk_office_subcategories and c.id_categories = s.fk_office_categories and
        r.status_requests = 3 and c.id_categories = 3";    
    $query = $this->db->query($sql)->result();    
    return $query;  
    }
    
    function countTotDesgRequesrs(){
    $sql = "select count(*) as totalcounted
    from office_requests r join office_subcategories s join office_categories c
    where  s.id_subcategories = r.fk_office_subcategories and c.id_categories = s.fk_office_categories 
    and c.id_categories = 3";    
    $query = $this->db->query($sql)->result();    
    return $query;  
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