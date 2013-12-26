<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
    
        function __construct() {
            parent::__construct();
            
            $this->load->model('login_model', 'loginModel');
            
        }
    
        public function index()
	{
            $this->showLoginForm();
            return;
	}
        
        function logout()
        {
            $this->session->sess_destroy();
            redirect(base_url().'login');

        }
        
        
        function post()
        {
            $post=array();
            $post['username_login']=$this->db->escape_str($this->input->post('username'));
            $post['password_login']=$this->db->escape_str($this->input->post('password'));
            
            $this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric');
            $this->form_validation->set_rules('password', 'Password', 'required');
            
            if($this->form_validation->run()==FALSE)
            {
               
                $this->showLoginForm($post);
                return;
            }
            $data=array();
            $data['username']=$post['username_login'];
            $data['password']=$post['password_login'];
            if($this->loginModel->checkLogin($data)==TRUE)
            {
                redirect('members/home');
                return;
            }else{
                redirect('login?err='.urlencode("Invalid Username or Password !"));
                return;
            }
            
        }
        
        
        function showLoginForm($post="")
        {
            $data=array();
            $data['post']=$post;
            
            $this->template->load('templates/template-out', 'login', $data);
        }
    
}

