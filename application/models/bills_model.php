<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Samir Poudel <samir@samirpdl.com.np>
 * @name Bills_model
 * @access private
 * @copyright (c) 2013, Samir Poudel
 */
class Bills_model extends CI_Model {
	
	
	function getBills($where_cond, $is_object=false, $is_limit=false, $limit=null)
	{
		$sql="select * from ".TBL_BILLS."";
		return;
		
	}
	
	
	
}
?>