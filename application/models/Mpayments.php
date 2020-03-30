<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class Mpayments extends CI_Model {
        
        

        public function __construct()
        {
            parent::__construct();
            
        }

        function GetPaymentsList()
        {
            $baseurl = base_url();
            $where = "";
            if($filterdate=$this->uri->segment(3)) {
                if($filterdate == "all"){
                    $where .= "";
                }else if($filterdate == "today"){
                    $filter_date = strtotime(date("Y-m-d")) - 24*60*60;;
                    $where .= "UNIX_TIMESTAMP(po.date_payment_opd) >= $filter_date and ";
                }else if($filterdate == "week"){
                    $filter_date = strtotime("monday this week");
                    $where .= "UNIX_TIMESTAMP(po.date_payment_opd) >= $filter_date and ";
                }else if($filterdate == "month"){
                    $filter_date = strtotime(date("Y-m-01")) - 24*60*60;
                    $where .= "UNIX_TIMESTAMP(po.date_payment_opd) >= $filter_date and ";
                }else if($filterdate == "year"){
                    $filter_date = strtotime(date("Y-01-01"));
                    $where .= "UNIX_TIMESTAMP(po.date_payment_opd) >= $filter_date and ";
                }
            }

            if($filterdate = $this->input->post('daterange')) {
                $date_array = explode(" - ", $filterdate);
                $start_date = trim(strtotime($date_array[0])) - 24*60*60;
                $end_date = trim(strtotime($date_array[1]));
                if($start_date == $end_date){
                    $where = "(UNIX_TIMESTAMP(po.date_payment_opd) >= $start_date) AND ";
                }else{
                    $where .= "((UNIX_TIMESTAMP(po.date_payment_opd) >= $start_date) AND (UNIX_TIMESTAMP(po.date_payment_opd) <= $end_date)) AND ";
                }
            }

            $sql = "
            select  
            po.`id_payment_opd` as invoice_id,
            po.`date_payment_opd` as invoice_date,
            po.`amount_payment_opd` as invoice_amount,
            plist.name_project as project,
            com.title AS company,
            pcate.class AS category_class,
            pcate.title AS category
            from 
            `payments_opd` po
            join `orders` o
            join `packages_stg_jn_comp` pcom
            join `packages_companies` com
            join `packages_stages_categories` pcate
            join `projects_list` plist
            where
            po.fk_orders_prodvent = o.id_order AND
            plist.id_project = o.fk_project AND
            pcom.fk_companies = o.fk_company AND
            pcom.fk_companies = com.id AND
            ". $where ."
            pcate.id = pcom.`fk_stages_categories`";
            $query = $this->db->query($sql)->result_array();
            $data['records'] = $query;
            return $data;
        }

        function GetPaymentsFilteredList($fk_project, $fk_company, $fk_category)
        {
            $baseurl = base_url();
            $where = "";

            if($fk_project != 0){
                $where .= "o.fk_project = '".$fk_project."' AND ";
            }else{
                $where .= "";
            }

            if($fk_company != 0){
                $where .= "o.fk_company = '".$fk_company."' AND ";
            }else{
                $where .= "";
            }

            if($fk_category != 0){
                $where .= "pcate.id = '".$fk_category."' AND ";
            }else{
                $where .= "";
            }

            $sql = "
            select  
            po.`id_payment_opd` as invoice_id,
            po.`date_payment_opd` as invoice_date,
            po.`amount_payment_opd` as invoice_amount,
            plist.name_project as project,
            com.title AS company,
            pcate.class AS category_class,
            pcate.title AS category
            from 
            `payments_opd` po
            join `orders` o
            join `packages_stg_jn_comp` pcom
            join `packages_companies` com
            join `packages_stages_categories` pcate
            join `projects_list` plist
            where
            po.fk_orders_prodvent = o.id_order AND
            plist.id_project = o.fk_project AND
            ".$where."
            pcom.fk_companies = o.fk_company AND
            pcom.fk_companies = com.id AND
            pcate.id = pcom.`fk_stages_categories`";
            $query = $this->db->query($sql)->result_array();
            $data['records'] = $query;
            return $data;
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

        function GetCompanyDrpdwn()
         {
           $sql="select pc.id, pc.title from orders o join packages_companies pc where o.fk_company = pc.id";
           $records=$this->db->query($sql)->result();
           $drpdown=array();
           $drpdwn[0]="Select Company";
           foreach($records as $record)
           {
            $drpdwn[$record->id]=$record->title;
           }
           return $drpdwn;
         }

        function GetCategoryDrpdwn()
         {
           $sql="select * from packages_stages_categories";
           $records=$this->db->query($sql)->result();
           $drpdown=array();
           $drpdwn[0]="Select Category";
           foreach($records as $record)
           {
            $drpdwn[$record->id]=$record->title;
           }
           return $drpdwn;
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

        function GetSubCategoryDrpdwn($id)
        {
            $this->db->where('fk_stages_categories', $id);
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

        function GetTeamListDrpdwn()
        {
          
            $teams= $this->db->get("teams");
            $records=$teams->result();
            $drpdown=array();
            $drpdwn[0]="Select Team";
            foreach($records as $record)

            {

                $drpdwn[$record->team_id]=$record->team_name;

            }
            return $drpdwn;
          
        }

        function GetCreditPaymentList()
        {
            $baseurl = base_url();
            $where = "";
            if($filterdate=$this->uri->segment(3)) {
                if($filterdate == "all"){
                    $where .= "";
                }else if($filterdate == "today"){
                    $filter_date = strtotime(date("Y-m-d")) - 24*60*60;;
                    $where .= "UNIX_TIMESTAMP(c.date_payment_credit) >= $filter_date and ";
                }else if($filterdate == "week"){
                    $filter_date = strtotime("monday this week");
                    $where .= "UNIX_TIMESTAMP(c.date_payment_credit) >= $filter_date and ";
                }else if($filterdate == "month"){
                    $filter_date = strtotime(date("Y-m-01")) - 24*60*60;
                    $where .= "UNIX_TIMESTAMP(c.date_payment_credit) >= $filter_date and ";
                }else if($filterdate == "year"){
                    $filter_date = strtotime(date("Y-01-01"));
                    $where .= "UNIX_TIMESTAMP(c.date_payment_credit) >= $filter_date and ";
                }
            }

            if($filterdate = $this->input->post('daterange')) {
                $date_array = explode(" - ", $filterdate);
                $start_date = trim(strtotime($date_array[0])) - 24*60*60;
                $end_date = trim(strtotime($date_array[1]));
                if($start_date == $end_date){
                    $where = "(UNIX_TIMESTAMP(c.date_payment_credit) >= $start_date) AND ";
                }else{
                    $where .= "((UNIX_TIMESTAMP(c.date_payment_credit) >= $start_date) AND (UNIX_TIMESTAMP(c.date_payment_credit) <= $end_date)) AND ";
                }
            }

            $sql = "select c.*, pj.name_project from payments_credit c join projects_list pj where ".$where." c.fk_project = pj.id_project";

            $query = $this->db->query($sql)->result_array();
            $i = 0;
            foreach ($query as $key => $row) 
            {
                $var = '<a class="btn btn-info" href="'.$baseurl.'payments/editCreditItems/'.$row['id_credit'].'"><i class="fa fa-edit "></i></a>
                        <a class="btn btn-danger" href="'.$baseurl.'payments/deleteCreditItems/'.$row['id_credit'].'"><i class="fa fa-trash-o "></i></a>';

                $i++;
                $query[$key]['action'] = $var;  
                
            }
            $data['records'] = $query;
            return $data;
        }

        function GetCreditPaymentListByProject($id)
        {
            $baseurl = base_url();
            $sql = "select c.*, pj.name_project from payments_credit c join projects_list pj where c.fk_project = pj.id_project and pj.id_project = $id";
            $query = $this->db->query($sql)->result_array();
            $i = 0;
            foreach ($query as $key => $row) 
            {
                $var = '<a class="btn btn-info" href="'.$baseurl.'payments/editCreditItems/'.$row['id_credit'].'"><i class="fa fa-edit "></i></a>
                        <a class="btn btn-danger" href="'.$baseurl.'payments/deleteCreditItems/'.$row['id_credit'].'"><i class="fa fa-trash-o "></i></a>';

                $i++;
                $query[$key]['action'] = $var;  
                
            }
            $data['records'] = $query;
            return $data;
        }

        function InsertCreditPayments()
        {

            $amount_sql = "select amount_project FROM projects_list WHERE id_project = '".$this->input->post('fk_project')."'";
            $amount_project = $this->db->query($amount_sql)->row()->amount_project;

            $current_sql = "select sum(amount_payment_credit) as balance FROM payments_credit WHERE fk_project = '".$this->input->post('fk_project')."'";
            $amount_current = $this->db->query($current_sql)->row()->balance;
            $balance = ($amount_project - ($this->input->post('paid_amount_credit') + $amount_current)); 

            $data = array(
                        'amount_payment_credit'=>$this->input->post('paid_amount_credit'),
                        'fk_project'=>$this->input->post('fk_project'),
                        'date_payment_credit'=>$this->input->post('paid_date_credit'),
                        'type_payment_credit'=>$this->input->post('type_payment_credit'),
                        'info_payment_credit'=>$this->input->post('paid_info_credit'),
                        'balance'=>$balance
                );
            $message = "Data inserted successfully";
            $this->db->insert('payments_credit',$data);
            return $message;
        }

        function EditCreditPayments($id)
        {
            $amount_sql = "select amount_project FROM projects_list WHERE id_project = '".$this->input->post('fk_project')."'";
            $amount_project = $this->db->query($amount_sql)->row()->amount_project;

            $current_sql = "select sum(amount_payment_credit) as balance FROM payments_credit WHERE fk_project = '".$this->input->post('fk_project')."' and id_credit <> $id";
            $amount_current = $this->db->query($current_sql)->row()->balance;
            $balance = ($amount_project - ($this->input->post('paid_amount_creditEdit') + $amount_current)); 
            $data = array(
                        'amount_payment_credit'=>$this->input->post('paid_amount_creditEdit'),
                        'fk_project'=>$this->input->post('fk_project'),
                        'date_payment_credit'=>$this->input->post('paid_date_creditEdit'),
                        'type_payment_credit'=>$this->input->post('type_payment_creditEdit'),
                        'info_payment_credit'=>$this->input->post('paid_info_creditEdit'),
                        'balance'=>$balance
                );
            $message = "Data Updated successfully";
            $this->db->where('id_credit', $id);
            $this->db->update('payments_credit',$data);
            return $message;
        }
        
        function DeleteCreditItems($id)
        {
         $this->db->where('id_credit', $id);
         $this->db->delete('payments_credit');
            
            $message = " Data deleted successfully";
            return $message;   
        }

        function GetAsignPaymentList()
        {
            $baseurl = base_url();
            $where = "";
            if($filterdate=$this->uri->segment(3)) {
                if($filterdate == "all"){
                    $where .= "";
                }else if($filterdate == "today"){
                    $filter_date = strtotime(date("Y-m-d")) - 24*60*60;;
                    $where .= "UNIX_TIMESTAMP(a.start_date) >= $filter_date and ";
                }else if($filterdate == "week"){
                    $filter_date = strtotime("monday this week");
                    $where .= "UNIX_TIMESTAMP(a.start_date) >= $filter_date and ";
                }else if($filterdate == "month"){
                    $filter_date = strtotime(date("Y-m-01")) - 24*60*60;
                    $where .= "UNIX_TIMESTAMP(a.start_date) >= $filter_date and ";
                }else if($filterdate == "year"){
                    $filter_date = strtotime(date("Y-01-01"));
                    $where .= "UNIX_TIMESTAMP(a.start_date) >= $filter_date and ";
                }
            }

            if($filterdate = $this->input->post('daterange')) {
                $date_array = explode(" - ", $filterdate);
                $start_date = trim(strtotime($date_array[0])) - 24*60*60;
                $end_date = trim(strtotime($date_array[1]));
                if($start_date == $end_date){
                    $where = "(UNIX_TIMESTAMP(a.start_date) >= $start_date) AND ";
                }else{
                    $where .= "((UNIX_TIMESTAMP(a.start_date) >= $start_date) AND (UNIX_TIMESTAMP(a.start_date) <= $end_date)) AND ";
                }
            }
           
            $sql = "select a.*, t.team_name, pj.name_project, s.title as subcategory from payments_asign a join teams t join projects_list pj join packages_stages_subcategories s where a.fk_team = t.team_id and a.fk_project = pj.id_project and ".$where." a.fk_subcategory = s.id";
            $query = $this->db->query($sql)->result_array();
            $i = 0;
            foreach ($query as $key => $row) 
            {
                $var = '<a class="btn btn-info" href="'.$baseurl.'payments/editAsignItems/'.$row['id_asign'].'"><i class="fa fa-edit "></i></a>
                        <a class="btn btn-danger" href="'.$baseurl.'payments/deleteAsignItems/'.$row['id_asign'].'"><i class="fa fa-trash-o "></i></a>';

                $i++;
                $query[$key]['action'] = $var;  
                
            }
            $data['records'] = $query;
            return $data;
        }

        function GetAsignPaymentListFilter($fk_project, $fk_team)
        {
            $baseurl = base_url();
            $where = "";
            if($fk_project != 0){
                $where .= "a.fk_project = '".$fk_project."' AND ";
            }else{
                $where .= "";
            }

            if($fk_team != 0){
                $where .= "t.team_id = '".$fk_team."' AND ";
            }else{
                $where .= "";
            }

            $sql = "select a.*, t.team_name, pj.name_project, s.title as subcategory from payments_asign a join teams t join projects_list pj join packages_stages_subcategories s where a.fk_team = t.team_id and a.fk_project = pj.id_project and ". $where ." a.fk_subcategory = s.id";
            $query = $this->db->query($sql)->result_array();
            $i = 0;
            foreach ($query as $key => $row) 
            {
                $var = '<a class="btn btn-info" href="'.$baseurl.'payments/editAsignItems/'.$row['id_asign'].'"><i class="fa fa-edit "></i></a>
                        <a class="btn btn-danger" href="'.$baseurl.'payments/deleteAsignItems/'.$row['id_asign'].'"><i class="fa fa-trash-o "></i></a>';

                $i++;
                $query[$key]['action'] = $var;  
                
            }
            $data['records'] = $query;
            return $data;
        }

        function InsertAsignPayments()
        {

            $data = array(
                        'fk_team'=>$this->input->post('fk_team'),
                        'agreed_amount'=>$this->input->post('agreed_amount'),
                        'fk_project'=>$this->input->post('fk_project'),
                        'fk_category'=>$this->input->post('fk_category'),
                        'fk_subcategory'=>$this->input->post('subcategory'),
                        'start_date'=>$this->input->post('start_date'),
                        'target_date'=>$this->input->post('target_date')
                );
            $message = "Data inserted successfully";
            $this->db->insert('payments_asign',$data);
            return $message;
        }

        function EditAsignPayments($id)
        {
            $data = array(
                        'fk_team'=>$this->input->post('fk_team'),
                        'agreed_amount'=>$this->input->post('agreed_amount'),
                        'fk_project'=>$this->input->post('fk_project'),
                        'fk_category'=>$this->input->post('fk_category'),
                        'fk_subcategory'=>$this->input->post('subcategory'),
                        'start_date'=>$this->input->post('start_date'),
                        'target_date'=>$this->input->post('target_date')
                );
            $message = "Data Updated successfully";
            $this->db->where('id_asign', $id);
            $this->db->update('payments_asign',$data);
            return $message;
        }
        
        function DeleteAsignItems($id)
        {
         $this->db->where('id_asign', $id);
         $this->db->delete('payments_asign');
            
            $message = " Data deleted successfully";
            return $message;   
        }

        function GetLabourPaymentsList()
        {
            $baseurl = base_url();
            $where = "";
            if($filterdate=$this->uri->segment(3)) {
                if($filterdate == "all"){
                    $where .= "";
                }else if($filterdate == "today"){
                    $filter_date = strtotime(date("Y-m-d")) - 24*60*60;;
                    $where .= "UNIX_TIMESTAMP(l.date_payment_labour) >= $filter_date and ";
                }else if($filterdate == "week"){
                    $filter_date = strtotime("monday this week");
                    $where .= "UNIX_TIMESTAMP(l.date_payment_labour) >= $filter_date and ";
                }else if($filterdate == "month"){
                    $filter_date = strtotime(date("Y-m-01")) - 24*60*60;
                    $where .= "UNIX_TIMESTAMP(l.date_payment_labour) >= $filter_date and ";
                }else if($filterdate == "year"){
                    $filter_date = strtotime(date("Y-01-01"));
                    $where .= "UNIX_TIMESTAMP(l.date_payment_labour) >= $filter_date and ";
                }
            }

            if($filterdate = $this->input->post('daterange')) {
                $date_array = explode(" - ", $filterdate);
                $start_date = trim(strtotime($date_array[0])) - 24*60*60;
                $end_date = trim(strtotime($date_array[1]));
                if($start_date == $end_date){
                    $where = "(UNIX_TIMESTAMP(l.date_payment_labour) >= $start_date) AND ";
                }else{
                    $where .= "((UNIX_TIMESTAMP(l.date_payment_labour) >= $start_date) AND (UNIX_TIMESTAMP(l.date_payment_labour) <= $end_date)) AND ";
                }
            }

            $sql = "select *, pj.name_project as project_name, t.team_name from payments_labour l join projects_list pj join teams t where l.fk_project = pj.id_project and ".$where." l.fk_team = t.team_id";
            $query = $this->db->query($sql)->result_array();
            $i = 0;
            foreach ($query as $key => $row) 
            {
                $var = '<a class="btn btn-info" href="'.$baseurl.'payments/editLabourItems/'.$row['id_labour'].'"><i class="fa fa-edit "></i></a>
                        <a class="btn btn-danger" href="'.$baseurl.'payments/deleteLabourItems/'.$row['id_labour'].'"><i class="fa fa-trash-o "></i></a>';

                $i++;
                $query[$key]['action'] = $var;  
                
            }
            $data['records'] = $query;
            return $data;
        }

        function GetLabourPaymentFilteredList($fk_project, $fk_team)
        {
            $baseurl = base_url();
            $where = "";

            if($fk_project != 0){
                $where .= "l.fk_project = '".$fk_project."' and ";
            }else{
                $where .= "";
            }

            if($fk_team != 0){
                $where .= "l.fk_team = '".$fk_team."' and ";
            }else{
                $where .= "";
            }

            $sql = "select *, pj.name_project as project_name, t.team_name from payments_labour l join projects_list pj join teams t where l.fk_project = pj.id_project and ".$where." l.fk_team = t.team_id";
            $query = $this->db->query($sql)->result_array();
            $i = 0;
            foreach ($query as $key => $row) 
            {
                $var = '<a class="btn btn-info" href="'.$baseurl.'payments/editLabourItems/'.$row['id_labour'].'"><i class="fa fa-edit "></i></a>
                        <a class="btn btn-danger" href="'.$baseurl.'payments/deleteLabourItems/'.$row['id_labour'].'"><i class="fa fa-trash-o "></i></a>';

                $i++;
                $query[$key]['action'] = $var;  
                
            }
            $data['records'] = $query;
            return $data;
        }

        function InsertLabourPayments()
        {
            $amount_sql = "select sum(agreed_amount) as amount_team FROM payments_asign WHERE fk_project = '".$this->input->post('fk_project')."' and fk_team = '".$this->input->post('fk_team')."'";
            $amount_team = $this->db->query($amount_sql)->row()->amount_team;

            $current_sql = "select sum(amount_payment_labour) as balance FROM payments_labour WHERE fk_project = '".$this->input->post('fk_project')."'";
            $amount_current = $this->db->query($current_sql)->row()->balance;

            $balance = ($amount_team - ($this->input->post('paid_amount_labour') + $amount_current));  
            $data = array(
                        'amount_payment_labour'=>$this->input->post('paid_amount_labour'),
                        'fk_team'=>$this->input->post('fk_team'),
                        'fk_project'=>$this->input->post('fk_project'),
                        'date_payment_labour'=>$this->input->post('paid_date_labour'),
                        'type_payment_labour'=>$this->input->post('type_payment_labour'),
                        'info_payment_labour'=>$this->input->post('paid_info_labour'),
                        'balance'=>$balance
                );
            $message = "Data inserted successfully";
            $this->db->insert('payments_labour',$data);
            return $message;
        }

        function EditLabourPayments($id)
        {
            $amount_sql = "select sum(agreed_amount) as amount_team FROM payments_asign WHERE fk_project = '".$this->input->post('fk_project')."' and fk_team = '".$this->input->post('fk_team')."'";
            $amount_team = $this->db->query($amount_sql)->row()->amount_team;

            $current_sql = "select sum(amount_payment_labour) as balance FROM payments_labour WHERE fk_project = '".$this->input->post('fk_project')."' and id_labour <> $id";
            $amount_current = $this->db->query($current_sql)->row()->balance;
            $balance = ($amount_team - ($this->input->post('paid_amount_labourEdit') + $amount_current)); 
            $data = array(
                        'amount_payment_labour'=>$this->input->post('paid_amount_labourEdit'),
                        'fk_team'=>$this->input->post('fk_team'),
                        'fk_project'=>$this->input->post('fk_project'),
                        'date_payment_labour'=>$this->input->post('paid_date_labourEdit'),
                        'type_payment_labour'=>$this->input->post('type_payment_labourEdit'),
                        'info_payment_labour'=>$this->input->post('paid_info_labourEdit'),
                        'balance'=>$balance
                );
            $message = "Data Updated successfully";
            $this->db->where('id_labour', $id);
            $this->db->update('payments_labour',$data);
            return $message;
        }
        
        function DeleteLabourItems($id)
        {
         $this->db->where('id_labour', $id);
         $this->db->delete('payments_labour');
            
            $message = " Data deleted successfully";
            return $message;   
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