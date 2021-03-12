<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller{
	public function __construct()
	    {
	        parent::__construct();
	        if($this->session->userdata['login_type']!='expert'){redirect('expert/login');}
	    }

	public function index()
	{
		$data['total_users'] = 0;
		$data['subview'] = "dashboard/dashboard";
		$this->load->view('expert/theme',$data);
	}
	
}
