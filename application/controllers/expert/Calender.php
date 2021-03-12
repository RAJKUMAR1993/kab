<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calender extends CI_Controller{
	public function __construct()
    {
        parent::__construct();
        if($this->session->userdata['login_type']!='expert'){redirect('expert/login');}
    }
    public function index()
	{
		$data['subview'] = "myeventschedule/calendar";
		$this->load->view('expert/theme',$data);
	}
}