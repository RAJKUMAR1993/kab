<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payments extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        if($this->session->userdata['login_type']!='student'){redirect('student/login');}
    }

	public function professorPayments()
	{
		$data["title"] = "Professor Payments";
		$data["table"] = "tbl_professors";
		$data["id"] = "pro_id";
		$data["name"] = "pro_name";
		$data["session_date"] = "pro_se_date";
		$student_id = $this->session->userdata("student_id");
		$data['data'] = $this->db->order_by('id', 'DESC')->get_where("tbl_orders",["session_organized_by"=>"professor","student_id"=>$student_id])->result();
		$data['subview'] = "payments/payments";
		$this->load->view('student/theme',$data);
	}
	public function speakerPayments()
	{
		$data["title"] = "Eminent Speaker Payments";
		$data["table"] = "tbl_speakers";
		$data["id"] = "speaker_id";
		$data["name"] = "speaker_name";
		$data["session_date"] = "spe_se_date";
		$student_id = $this->session->userdata("student_id");
		$data['data'] = $this->db->order_by('id', 'DESC')->get_where("tbl_orders",["session_organized_by"=>"speaker","student_id"=>$student_id])->result();
		$data['subview'] = "payments/payments";
		$this->load->view('student/theme',$data);
	}
	public function councellorPayments()
	{
		$data["title"] = "Expert Councellor Payments";
		$data["table"] = "tbl_experts";
		$data["id"] = "expert_id";
		$data["name"] = "expert_name";
		$data["session_date"] = "exp_se_date";
		$student_id = $this->session->userdata("student_id");
		$data['data'] = $this->db->order_by('id', 'DESC')->get_where("tbl_orders",["session_organized_by"=>"expert","student_id"=>$student_id])->result();
		$data['subview'] = "payments/payments";
		$this->load->view('student/theme',$data);
	}
	
}