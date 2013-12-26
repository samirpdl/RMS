<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Sameer Poudel <samir@samirpdl.com.np>
 * @name home
 * @access public
 * @copyright (c) 2013, Sameer Poudel
 * Description of home
 */
class bills extends CI_Controller {
    
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
        
        $this->load->model('bills_model');
        $this->load->model('menus_model');
        $this->load->model('tables_model');
        $this->load->model('Login_model');

		$checkSession=$this->Login_model->checkLogin(array('username'=>$this->username, 'userid'=>$this->userid, 'type'=>$this->usertype));
		if($checkSession!=TRUE)
		{
			redirect(base_url().'?err='.  urlencode("Your Session Is Invalid !"));
            return;			
		}
		
        
        
    }
	
	
	function index()
	{
		$data['bills']=$this->bills_model->getBills("1");
		$this->template->load('templates/in','members/bills/listbills', $data);
	}
	

	function add()
	{
		$this->showAddForm();
		return;
	}
	
	function post()
	{
		$post=array();
		$post['bill_type']=$this->db->escape_str($this->input->post('bill_type'));
		$post['table_name']=$this->db->escape_str($this->input->post('table_name'));
		$post['menu']=$this->db->escape_str($this->input->post('menu'));
		$post['quantity']=$this->db->escape_str($this->input->post('quantity'));
		
		
		//------------------------- Form Validation ------------------------------
		$this->form_validation->set_rules('bill_type', 'Bill Type', 'required|numeric');
		
		
		/**
		* 
		* Checking for the bill type and defining function for individual checkup
		* 
		*/
		if($post['bill_type']==BILL_TYPE_NEW)
		{
			$this->form_validation->set_rules('table_name', 'Table Name', 'required|numeric');
		}elseif($post['bill_type']==BILL_TYPE_EXISTING)
		{
			$this->form_validation->set_rules('bill_id', 'Bill ID', 'required|numeric');
		}
		
		//-- end Condition
		
		$this->form_validation->set_rules('menu', 'Menu', 'required|numeric');
		$this->form_validation->set_rules('quantity', 'Quantity', 'required|numeric');
		
		
		if($this->form_validation->run()==FALSE)
		{
			$this->showAddForm($post);
			return;
		}
		
		/**
		* 	If Bill Type is New	 
		*/
		
		
	}

	private function showAddForm($post=null)
	{
		$data=array();
		$data['post']=$post;
		$data['tables']=$this->tables_model->getTabels("status=".TABLE_STATUS_FREE);
		$data['menus']=$this->menus_model->getMenus("status=".STATUS_ACTIVE);
		$this->template->load('templates/in', 'members/bills/add', $data);
		return;
	}
	
	
	
}