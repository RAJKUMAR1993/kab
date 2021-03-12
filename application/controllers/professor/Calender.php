<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calender extends CI_Controller{
	public function __construct()
    {
        parent::__construct();
        if($this->session->userdata['login_type']!='professor'){redirect('professor/login');}
    }
    public function index()
	{
		$data['subview'] = "myeventschedule/calendar";
		$this->load->view('professor/theme',$data);
	}
}