<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Sameer Poudel <samir@samirpdl.com.np>
 * @name home
 * @access public
 * @copyright (c) 2013, Sameer Poudel
 * Description of home
 */
class tables extends CI_Controller {
    
    private $username;
    private $userid;
    private $usertype;
    
    
    function __construct() {
        parent::__construct();
        
        $this->username=$this->session->userdata('username');
        $this->userid=$this->session->userdata('userid');
        $this->usertype=$this->session->userdata('usertype');
        
        if( (empty($this->username)) || (empty($this->userid)) || (empty($this->usertype)) )
        {
            redirect(base_url().'?err='.  urlencode("Your Session Is Invalid !"));
            return;
        }
        
        
        $this->checkSession(); // This Will Check if the session is valid or not	
		$this->load->model('Tables_model');
        
    }

	
	private function checkSession()
	{
		
		$this->load->model('Login_model');
		
		$checkSession=$this->Login_model->checkLogin(array('username'=>$this->username, 'userid'=>$this->userid, 'type'=>$this->usertype));
		if($checkSession!=TRUE)
		{
			redirect(base_url().'?err='.  urlencode("Your Session Is Invalid !"));
            return;			
		}else{
			
			return true;
		}
	}
	
	function index()
	{
		$data=array();
		$data['tables']=$this->Tables_model->getTabels();
		$this->template->load('templates/in', 'members/tables/listtables', $data);
		return;
	}

	function add()
	{
		$this->showAddForm();
		return;
	}
	
	function edit()
	{
		$id=trim($this->uri->segment(4));
		if((!$id) || (!is_numeric($id)))
		{
			show_404();
			return;
		}
		
		$checkTable=$this->Tables_model->getTabels("id=$id", TRUE);
		if(count($checkTable)<1)
		{
			show_404();
			return;
		}
		
		$post=array();
		$post['edit']=1;
		$post['table_id']=$checkTable->id;
		$post['table_name']=$checkTable->table_name;
		$post['table_capacity']=$checkTable->capacity;
		$post['table_status']=$checkTable->status;
		
		$this->showAddForm($post);
		return;
	}
	
	function post()
	{
		$post=array();
		$post['table_name']=$this->input->post('table_name');
		$post['table_capacity']=$this->input->post('table_capacity');
		$post['table_status']=$this->input->post('table_status');
		$post['edit']=$this->input->post('edit');
		if(!empty($post['edit']))
		{
			$post['table_id']=$this->input->post('id');
			$checkTable=$this->Tables_model->getTabels("id=".$post['table_id']."", TRUE);
			if(count($checkTable)<1)
			{
				show_404();
				return;
			}
			
			$this->form_validation->set_rules('id', 'Table ID', 'required|numeric');
		}
		
		$this->form_validation->set_rules('table_name', 'Table Name', 'required');
		$this->form_validation->set_rules('table_capacity', 'Table Capacity', 'required|numeric');
		$this->form_validation->set_rules('table_status', 'Table Status', 'required|numeric');
		
		if($this->form_validation->run()==FALSE)
		{
			$this->showAddForm();
			return;
		}
		
		$insertIntoTables=array();
		$insertIntoTables['table_name']=$post['table_name'];
		$insertIntoTables['capacity']=$post['table_capacity'];
		$insertIntoTables['status']=$post['table_status'];
		
		if(!empty($post['edit']))
		{
			$runQuery=$this->db->update(TBL_TABLES, $insertIntoTables, array('id'=>$post['table_id']));
			
		}else{
			
			$runQuery=$this->db->insert(TBL_TABLES, $insertIntoTables);
		}
		
		if($runQuery==TRUE)
		{
			redirect(base_url().'members/tables?msg='.urlencode("Task Completed Successfully !"));
			return;
		}else{
			redirect(base_url().'members/tables?err='.urlencode("Sorry ! We Failed :("));
			return;
		}
		
		
	}
	
	
	private function showAddForm($post=null)
	{
		$data=array();
		$data['post']=$post;
		$this->template->load('templates/in', 'members/tables/add', $data);
	}

}