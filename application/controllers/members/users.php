<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author Sameer Poudel <samir@samirpdl.com.np>
* @name users
* @access public
* @copyright (c) 2013, Sameer Poudel
* Description of users
*/
class users extends CI_Controller
{

	private $username;
	private $userid;
	private $usertype;


	function __construct()
	{
		parent::__construct();

		$this->username = $this->session->userdata('username');
		$this->userid = $this->session->userdata('userid');
		$this->usertype = $this->session->userdata('usertype');

		if( (empty($this->username)) || (empty($this->userid)) || (empty($this->usertype)) )
		{
			redirect(base_url().'?err='.  urlencode("Your Session Is Invalid !"));
			return;
		}

		$this->load->model('bills_model');
		$this->load->model('menus_model');
		$this->load->model('tables_model');
		$this->load->model('Login_model');

		$checkSession = $this->Login_model->checkLogin(array('username'=>$this->username,'userid'  =>$this->userid,'type'    =>$this->usertype));
		if($checkSession != TRUE)
		{
			redirect(base_url().'?err='.  urlencode("Your Session Is Invalid !"));
			return;
		}



	}
	
	
	function index()
	{
		$this->template->load('templates/in', 'members/users/listusers');
		return;
	}	
	
	
	
	
}
