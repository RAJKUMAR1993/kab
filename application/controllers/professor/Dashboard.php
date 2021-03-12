<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller{
	public function __construct()
	    {
	        parent::__construct();
	        if($this->session->userdata['login_type']!='professor'){redirect('professor/login');}
	    }

	public function index()
	{
		$data['payment'] = $this->db->order_by('id', 'DESC')->get_where("tbl_orders",["session_organized_by"=>"professor","creator_id"=>$this->session->userdata['pro_id']])->num_rows();
       //print_r($data['payment']);die;
		$data['total_users'] = 0;
		$data['subview'] = "dashboard/dashboard";
		$this->load->view('professor/theme',$data);
	}
	
}
