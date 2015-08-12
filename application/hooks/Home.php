<?php
if (!defined( 'BASEPATH')) exit('No direct script access allowed'); 
class Home
{
	private $ci;
	public function __construct()
	{
		$this->ci =& get_instance();
		!$this->ci->load->library('session') ? $this->ci->load->library('session') : false;
		!$this->ci->load->helper('url') ? $this->ci->load->helper('url') : false;
	}	

	public function check_login()
	{
		if($this->ci->uri->segment(2) != "login")
			if (!$this->ci->session->userdata('login'))
	            redirect('Welcome/login','refresh');
	}
}
?>