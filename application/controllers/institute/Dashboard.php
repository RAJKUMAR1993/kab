<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller{
	public function __construct()
	    {
	        parent::__construct();
	        if($this->session->userdata['login_type']!='institute'){redirect('institute/login');}
	    }

	public function index()
	{
		$institute_id =$this->session->userdata['institute_id'];
		$idata = $this->db->get_where("tbl_institutes",["institute_id"=>$institute_id])->row(); 
		
		$data['Professors'] = $this->db->order_by('id', 'DESC')->get_where("tbl_councellors",["institute_id"=>$institute_id,"is_deleted"=>0])->num_rows();
		$data['aomeetings'] = $this->db->where("institute_id",$institute_id)->order_by("id", "desc")->get("tbl_college_connect")->num_rows();
		$data['presentations'] = $this->db->where("institute_id",$institute_id)->order_by("date ","desc")->get("tbl_institute_presentations")->num_rows();
		$data['promeetings'] = $this->db->query("SELECT * FROM tbl_counsellor_sessions WHERE is_deleted=0 and institute_id=$institute_id")->num_rows();
		$data['aocalls'] = $this->db->order_by('id', 'DESC')->get_where("tbl_convoxcall_logs",["institute_id"=>$institute_id])->num_rows();
		$data['enquiries'] = $this->db->query("SELECT tbl_institute_ask_a_question.*,tbl_students.student_name,tbl_students.email,tbl_students.phone FROM tbl_institute_ask_a_question LEFT JOIN tbl_students ON tbl_institute_ask_a_question.student_id = tbl_students.student_id WHERE tbl_institute_ask_a_question.institute_id='".$institute_id."' AND tbl_institute_ask_a_question.type='institute'  ORDER BY id DESC")->num_rows();
		$data['applications'] = $this->db->query("SELECT tbl_institute_admission.*,tbl_students.student_name,tbl_students.email,tbl_students.phone FROM tbl_institute_admission LEFT JOIN tbl_students ON tbl_institute_admission.student_id = tbl_students.student_id WHERE tbl_institute_admission.institute_id='".$institute_id."' ORDER BY id DESC")->num_rows();
		$data['feedback'] = $this->db->order_by('created_date', 'DESC')->get_where("tbl_institute_feedbackrating",["institute_id"=>$institute_id])->num_rows();
		$data['svebooth'] = $this->db->query("SELECT * from tbl_student_institute_view_time where institute_id='$institute_id'")->num_rows();
		//echo $this->db->last_query();die;
		$data['aoaudio'] = count(json_decode($idata->virtual_conference_numbers));
		$data['subview'] = "dashboard/dashboard";
		$this->load->view('institute/theme',$data);
	}
	
	public function onlinestudents_count(){
		
		echo $this->db->get_where("tbl_student_institute_view_time",["institute_id"=>$this->session->userdata("institute_id"),"status"=>"online","date"=>date("Y-m-d"),"type"=>"loggedin"])->num_rows();
		
	}
	
	public function onlinestudents(){
		
		$data["details"] = $this->db->get_where("tbl_student_institute_view_time",["institute_id"=>$this->session->userdata("institute_id"),"status"=>"online","date"=>date("Y-m-d"),"type"=>"loggedin"])->result();
		$data['subview'] = "dashboard/onlinestudents";
		$this->load->view('institute/theme',$data);
		
	}
	
}
