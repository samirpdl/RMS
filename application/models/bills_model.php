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
		$sql="select t.table_name, b.*, ui.first_name, ui.last_name from ".TBL_BILLS." b
				left join ".TBL_ORDERS." o
					ON b.id=o.tbl_bills_id
				left join ".TBL_TABLES." t
					on b.tbl_tables_id=t.id
				left join ".TBL_USERINFO." ui
					on b.created_by=ui.tbl_users_id

				where $where_cond
				GROUP BY b.id";

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

	function getOrders($where_cond, $is_object=false)
	{
		$sql="select o.*, m.name, m.price from ".TBL_ORDERS." o
				left join ".TBL_MENUS." m
			ON o.tbl_menu_id=m.id
		 where $where_cond";
		$query=$this->db->query($sql);
		
		if($is_object==TRUE)
		{
			return $query->row();			
		}else{
			return $query->result();	
		}
	}

	function updateTotalAmount($bill_id, $amount)
	{
		$sql="update ".TBL_BILLS." set total_amt=total_amt+$amount where id=$bill_id";

		return $this->db->query($sql);
	}
	
	
	
}
?>