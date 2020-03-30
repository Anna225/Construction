<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Muser extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    // List

   function GetUserList() {

        $baseurl = base_url();
        $sql = "select * from tbl_users";
        $query = $this->db->query($sql)->result_array();
        $i = 0;
        foreach ($query as $key => $row) 
        {

            if($row['user_role'] == 'superadmin') {
                $var = '<a class="btn btn-info" href="'.$baseurl.'user/edit/'.$row['user_id'].'"><i class="fa fa-edit "> Edit</i></a>';
            }else{
                $var = '<a class="btn btn-info" href="'.$baseurl.'user/edit/'.$row['user_id'].'"><i class="fa fa-edit "></i></a>
                    <a class="btn btn-danger" href="'.$baseurl.'user/delete/'.$row['user_id'].'"><i class="fa fa-trash-o "></i></a>';
            }

            $query[$key]['action'] = $var;
            $i++;
        }
        $data['records'] = $query;
        return $data;
    }
    //Insert

    function InsertUser() {
        $data = array(
                    'user_name'=>$this->input->post('add_name'),
                    'user_email'=>$this->input->post('add_email'),
                    'user_password'=>md5($this->input->post('add_password')),
                    'user_role'=>$this->input->post('add_role'),
                    'last_login_date'=>''
            );

        $message = "Data inserted successfully";
        $this->db->insert('tbl_users',$data);
        return $message;
    }

    function EditUser(){

        if(!empty($this->input->post('edit_password')) == false && $this->input->post('edit_password') != "") {
            $this->db->set('user_password', $this->input->post('edit_password'));
        }
        $this->db->set('user_name', $this->input->post('edit_name'));
        $this->db->set('user_email', $this->input->post('edit_email'));
        $this->db->set('user_role', $this->input->post('edit_role'));
        $this->db->where('user_id', $this->uri->segment(3));
        $this->db->update('tbl_users');
        $message="status updated successfully";
        return $message;
    }
 
    // Delete

    function deleteUser($id) {
        $this->db->where('user_id', $id);
        $this->db->delete('tbl_users');
        $message = " User Data deleted successfully";
        return $message;
    }
}