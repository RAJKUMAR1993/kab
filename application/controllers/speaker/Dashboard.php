<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller{
	public function __construct()
	    {
	        parent::__construct();
	        if($this->session->userdata['login_type']!='speaker'){redirect('speaker/login');}
	    }

	public function index()
	{
		$speaker_id    =$this->session->userdata("speaker_id");
		$data['users'] = $this->db->order_by('id', 'DESC')->get_where("tbl_student_speaker_view_time",["speaker_id"=>$speaker_id, "status"=> "online"])->num_rows();
		//echo $this->db->last_query();die;
		$data['total_users'] = 0;
		$data['subview'] = "dashboard/dashboard";
		$this->load->view('speaker/theme',$data);
	}
	
	public function studentlogintime(){
		$data['logintime'] =  $this->db->query("SELECT * from tbl_viewprofiles_data where ref_type='speaker'")->result();
		$data['subview'] = "dashboard/studentlogintime";
		$this->load->view('speaker/theme',$data);
	}
	public function livedata(){

		$data["details"] = $this->db->get_where("tbl_viewprofiles_data",["profile_id"=>$this->session->userdata("speaker_id"),"status"=>"online","ref_type"=>"speaker"])->result();
		//echo $this->db->last_query();die;
		$data['subview'] = "dashboard/live_status_data";
		$this->load->view('speaker/theme',$data);
	}
	

}
