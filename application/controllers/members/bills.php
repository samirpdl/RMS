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
		$post['menu_id']=$this->db->escape_str($this->input->post('menu'));
		$post['quantity']=$this->db->escape_str($this->input->post('quantity'));
		$post['bill_id']=$this->db->escape_str($this->input->post('bill_id'));
		
		
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

		//-- Starting Transaction 
		$this->db->trans_start();


		if($post['bill_type']==BILL_TYPE_NEW)
		{
			
			//--- Inserting to bills table
			$new_insert=array();
			$new_insert['total_amt']=0;
			$new_insert['datetime']=date('Y-m-d H:i:s');
			$new_insert['created_by']=$this->userid;
			$new_insert['tbl_tables_id']=$post['table_name'];


			$this->db->insert(TBL_BILLS, $new_insert);

			$bill_id=$this->db->insert_id();

			$this->db->update(TBL_TABLES, array('status'=>TABLE_STATUS_OCCUPIED), array('id'=>$post['table_name']));


		}else{
			$bill_id=$post['bill_id'];
		}

		$insert_into_orders=array();
		$insert_into_orders['timedate']=date('Y-m-d H:i:s');
		$insert_into_orders['status']=STATUS_ACTIVE;
		$insert_into_orders['quantity']=$post['quantity'];
		$insert_into_orders['tbl_menu_id']=$post['menu_id'];
		$insert_into_orders['tbl_bills_id']=$bill_id;

		$this->db->insert(TBL_ORDERS, $insert_into_orders);


		//---- Updating Total Amount
		$menusModel = new menus_model;

		$getMenuItem=$menusModel->getMenus("id=".$post['menu_id'], TRUE);

		$menu_price=$getMenuItem->price;
		$amount=($menu_price*$post['quantity']);
		

		$this->bills_model->updateTotalAmount($bill_id, $amount);
		//$this->db->update(TBL_BILLS, array('total_amt'=>$menu_price), array('id'=>$bill_id));
		
		//--------------------


		$this->db->trans_complete();

		//--- Ending Transaction

		//-- If transaction is false

		if($this->db->trans_status()==false)
		{
			redirect(base_url().'members/bills/?err=Sorry+We+failed !');
			return;
		}

		redirect(base_url().'members/bills/?msg='.urlencode("Your Order is added Successfully "));
		return;
		
		
	}


	function view()
	{
		$bill_id=trim($this->uri->segment(4));
		if((!$bill_id) || (!is_numeric($bill_id)))
		{
			show_error("Sorry You Tempted the URL");
			return;
		}


		$getBillDetails=$this->bills_model->getBills("b.id=$bill_id", TRUE);
		if(count($getBillDetails)<1)
		{
			show_404();
			return;
		}

		$getOrderDetails=$this->bills_model->getOrders("tbl_bills_id=$bill_id");

		$data=array();
		$data['orders']=$getOrderDetails;
		$data['billdetails']=$getBillDetails;

		$this->template->load('templates/in', 'members/bills/view', $data);
		return;

	}

	private function showAddForm($post=null)
	{
		$data=array();
		$data['post']=$post;
		$data['tables']=$this->tables_model->getTabels("status=".TABLE_STATUS_FREE);
		$data['menus']=$this->menus_model->getMenus("status=".STATUS_ACTIVE);
		$data['bills']=$this->bills_model->getBills("b.status!=".STATUS_PAID);
		$this->template->load('templates/in', 'members/bills/add', $data);
		return;
	}


	
	
	
}