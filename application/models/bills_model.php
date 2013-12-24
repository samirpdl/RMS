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
		$sql="select * from ".TBL_BILLS." b
				left join ".TBL_ORDERS." o
					ON b.id=o.tbl_bills_id
				left join ".TBL_TABLES." t
					on o.tbl_tables_id=t.id
				where $where_cond";

		if($is_limit==TRUE)
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
?>