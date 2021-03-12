<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calender extends CI_Controller{
	public function __construct()
    {
        parent::__construct();
        if($this->session->userdata['login_type']!='speaker'){redirect('speaker/login');}
    }
    public function index()
	{
		$data['subview'] = "myeventschedule/calendar";
		$this->load->view('speaker/theme',$data);
	}
}