<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author Sameer Poudel <samir@samirpdl.com.np>
* @name reports
* @access public
* @copyright (c) 2013, Sameer Poudel
*    This page is for the reports of sales and other
*
*/
class reports extends CI_Controller
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
		$search=$this->input->post('search');
		
		
		if(isset($search))
		{
			$date_start= $this->input->post('date_start');
			$date_end=$this->input->post('date_end');
			$data['bills'] = $this->bills_model->getBills("b.datetime BETWEEN '$date_start%' AND '$date_end%' AND b.status =".STATUS_PAID);		
			
		}else{
		
		
		$data['bills'] = $this->bills_model->getBills("b.status =".STATUS_PAID);	
		}
		$data['reports']=1;
		$this->template->load('templates/in','members/bills/listbills', $data);
	}


}