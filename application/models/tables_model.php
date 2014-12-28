<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Samir Poudel <samir@samirpdl.com.np>
 * @name Tables_model
 * @access private
 * @copyright (c) 2013, Samir Poudel
 */
class Tables_model extends CI_Model {
	
	
	function getTabels($where_cond="1", $is_object=null, $is_limit=false, $limit="")
	{
		$sql="select * from ".TBL_TABLES." where $where_cond";
		if($is_limit==true)
		{
			$sql.=" LIMIT $limit";
		}
		
		$query=$this->db->query($sql);
		
		if($is_object==TRUE)
		{
			return $query->row();
		}else{
			return $query->result();
		}
	}
	
	
}