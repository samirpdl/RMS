<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Sameer Poudel <samir@samirpdl.com.np>
 * @name home
 * @access public
 * @copyright (c) 2013, Sameer Poudel
 * Description of home
 */
class menus extends CI_Controller {
    
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
		$this->load->model('Menus_model');
        
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
		$data['menus']=$this->Menus_model->getMenus("1");
		$this->template->load('templates/in', 'members/menus/listmenus', $data);
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
		
		$menu=$this->Menus_model->getMenus("id=$id", TRUE);
		if(count($menu)<1)
		{
			show_404();
			return;
		}
		
		$post=array();
		$post['item_name']=$menu->name;
		$post['item_price']=$menu->price;
		$post['item_category']=$menu->category;
		$post['edit']=1;
		$post['menu_id']=$menu->id;
		$this->showAddForm($post);
		return;
		
		
	}
	
	function post()
	{
		$post=array();
		$post['item_name']=$this->input->post('item_name');
		$post['item_price']=$this->input->post('item_price');
		$post['item_category']=$this->input->post('item_category');
		
		//------------- For Edit 
		$post['edit']=$this->input->post('edit');
		if(!empty($post['edit']))
		{
			$post['menu_id']=$this->input->post('menu_id');
			$this->form_validation->set_rules('menu_id', 'Menu ID', 'required|numeric');
		}
		
		$this->form_validation->set_rules('item_name', 'Item Name', 'required');
		$this->form_validation->set_rules('item_price', 'Item Price', 'required|numeric');
		$this->form_validation->set_rules('item_category', 'Item Category', 'required');
		
		
		if($this->form_validation->run()==FALSE)
		{
			$this->showAddForm($post);
			return;
		}
		
		
		$insert=array();
		$insert['name']=$post['item_name'];
		$insert['category']=$post['item_category'];
		$insert['price']=$post['item_price'];
		$insert['status']=1;
		
		if(!empty($post['edit']))
		{
			$checkMenu=$this->Menus_model->getMenus("id=".$post['menu_id']."", TRUE);
			if($checkMenu<1)
			{
				show_error("Invalid Access");
				return;
			}
			
			
			if($this->db->update(TBL_MENUS, $insert, array('id'=>$post['menu_id']))==TRUE)
			{
				redirect(base_url().'members/menus?msg='.urlencode("Menu Updated Successfully !"));
				return;
			}else{
				show_error("We Failed");
				return;
			}
		}else{
			if($this->db->insert(TBL_MENUS, $insert)==TRUE)
			{
				redirect(base_url().'members/menus?msg='.urlencode("Menu Added Successfully !"));
				return;
			}else{
				show_error("We Failed");
				return;
			}
		}
		
		
		
	}
	
	
	private function showAddForm($post=null)
	{
		$data=array();
		$data['post']=$post;
		$this->template->load('templates/in', 'members/menus/add', $data);
		return;
		
	}
	
	
}