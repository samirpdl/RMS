<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Samir Poudel <samir@samirpdl.com.np>
 * @name Login_model
 * @access private
 * @copyright (c) 2013, Samir Poudel
 */
class Login_Model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function checkLogin($data)
    {
        if(isset($data['type']))
        {
			
            $query=$this->db->get_where(TBL_LOGIN, array('username'=>$data['username'], 'id'=>$data['userid'], 'type'=>$data['type']));
        }else{
            $query=$this->db->get_where(TBL_LOGIN, array('username'=>$data['username'], 'password'=>md5($data['password'])));
        }
        
        if($query->num_rows()>0)
        {
			if(!isset($data['type']))
			{
				$row=$query->row();
            	$this->session->set_userdata('username', $row->username);
            	$this->session->set_userdata('userid', $row->id);
            	$this->session->set_userdata('usertype', $row->type);
			}
            
            return true;
        }else{
            return false;
        }
    }
    
    
}

?>
