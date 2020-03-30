<?php
class Login extends CI_Controller{
  function __construct(){
    parent::__construct();
    $this->load->model('mlogin');
  }
 
  function index(){
    $this->load->view('/backend/pages/login');
  }
 
  function auth(){
    $email    = $this->input->post('email',TRUE);
    $password = md5($this->input->post('password',TRUE));
    $validate = $this->mlogin->validate($email,$password);
    if($validate->num_rows() > 0){
        $data  = $validate->row_array();
        $name  = $data['user_name'];
        $email = $data['user_email'];
        $role = $data['user_role'];
        $sesdata = array(
            'username'  => $name,
            'email'     => $email,
            'role'     => $role,
            'logged_in' => TRUE
        );
        $sql = "UPDATE tbl_users SET last_login_date = now() WHERE user_email='". $email ."' AND user_password = '". $password ."'";
        $this->db->query($sql);
        $this->session->set_userdata($sesdata);

        redirect('office');
        // access login for admin
/*        if($role === 'superadmin'){
            redirect('office');
 
        // access login for staff
        }elseif($level === 'user'){
            redirect('page/staff');
 
        // access login for author
        }else{
            redirect('page/author');
        }
*/    }else{
        echo $this->session->set_flashdata('msg','Username or Password is Wrong');
        redirect('login');
    }
  }
 
  function logout(){
      $this->session->sess_destroy();
      redirect('login');
  }
 
}