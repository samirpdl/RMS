<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/***
 *  @name Template.php
 *  @author Samir Poudel <samir@samirpdl.com.np>
 * 
 *  
 *  Use : 
 *      $data=DATA YOU WANT TO PASS TO THAT PAGE
 *      $this->template->load('YOUR-TEMPLATE-FILE', 'YOUR-MAIN-VIEW-FILE', $data, '');
 * 
 * 
 */


class Template {

	var $template_data = array();

	function set($name, $value) {
		$this->template_data [$name] = $value;
	}

	function load($template = '', $view = '', $view_data = array(), $menus = '', $return = FALSE) {
		$this->set('viewname', $view);
		$this->CI = & get_instance();
		$this->set('contents', $this->CI->load->view($view, $view_data, TRUE));
		$this->set('menus', $menus);
		return $this->CI->load->view($template, $this->template_data, $return);
	}

	/* function load_main($view = '', $view_data = array(), $return = FALSE) {
	  $this->set ( 'nav_list', array ('Home', 'Photos', 'About', 'Contact' ) );
	  $this->load ( 'template', $view, $view_data, $return );
	  } */
}

/* End of file Template.php */
/* Location: ./system/application/libraries/Template.php */