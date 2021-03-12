<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');

class Eventsbag extends CI_Controller{


	public function index()
	{
		$sd = $this->session->userdata("student_id");
		$data["edata"] = $this->db->get_where("tbl_std_eventbag",["student_id"=>$sd])->result();
		$this->load->view('front/students/eventbag',$data);
	}
	

	public function eventbag_view($id){
		
		$data["idata"] = $this->db->get_where("tbl_institutes",["institute_id"=>$id])->row();
		$this->load->view("front/students/eventbag-details",$data);
		
	}


}
