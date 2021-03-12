<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {


	public function index()
	{
		
		$data['total_institutes']=$this->dashboard_model->total_institutes();
		$data['total_students']=$this->dashboard_model->total_students();
		$data['total_inst_professors']=$this->db->get_where("tbl_councellors",["is_deleted"=>0])->num_rows();
		$data['total_professors']=$this->db->get_where("tbl_professors",["is_deleted"=>0])->num_rows();
		$data['total_experts']=$this->db->get_where("tbl_experts",["is_deleted"=>0])->num_rows();
		$data['total_speakers']=$this->db->get_where("tbl_speakers",["is_deleted"=>0])->num_rows();
		$data['total_webinar_guests']=$this->db->get_where("tbl_webinar_guests")->num_rows();
		$data['total_webinars']=$this->db->get_where("tbl_webinors")->num_rows();
		$data['total_presentations']=$this->db->where("status","Active")->get_where("tbl_institute_presentations")->num_rows();
		$data['total_enquiries']=$this->db->get_where("tbl_institute_ask_a_question")->num_rows();
		$data['total_admissions']=$this->db->get_where("tbl_institute_admission")->num_rows();
		$data['total_svebooth']=$this->db->get("tbl_student_institute_view_time")->num_rows();
		$data['total_feedbacks']=$this->db->get("feedback")->num_rows();
		$data['total_inst_feedbacks']=$this->db->get("tbl_institute_feedbackrating")->num_rows();
		$data['total_pro_meetings']=$this->db->query("SELECT * FROM tbl_professor_meeting LEFT JOIN tbl_students ON tbl_professor_meeting.session_student_id = tbl_students.student_id ORDER BY session_date DESC ")->num_rows();
		$data['subview'] = "dashboard/dashboard";
		$data['zoom_access_token'] = $this->accesstoken->is_table_empty();
		$this->load->view('admin/theme',$data);
	}
	
	public function onlinestudents($id){
		
		$data["details"] = $this->db->get_where("tbl_student_institute_view_time",["institute_id"=>$id,"status"=>"online","date"=>date("Y-m-d"),"type"=>"loggedin"])->result();
		$data['subview'] = "dashboard/onlinestudents";
		$this->load->view('admin/theme',$data);
		
	}
	
	public function inst_professors(){
		
		$data["details"] = $this->db->order_by("id","desc")->get_where("tbl_councellors",["is_deleted"=>0])->result();
		$data['subview'] = "dashboard/councellors";
		$this->load->view('admin/theme',$data);
		
	}
	
	public function admissions(){
		
		$data["details"] = $this->db->order_by("id","desc")->get_where("tbl_institute_admission")->result();
		$data['subview'] = "dashboard/admissions";
		$this->load->view('admin/theme',$data);
		
	}
	
	public function inst_feedbacks(){
		
		if($this->input->get("institute")){
			$this->db->where("institute_id",$this->input->get("institute"));
		}
		$data['feedback'] = $this->db->order_by('created_date', 'DESC')->get_where("tbl_institute_feedbackrating")->result();
		$data['subview'] = "dashboard/feedback";
		$this->load->view('admin/theme',$data);
		
	}
	
	public function svebooth(){
		
		$data['subview'] = "dashboard/svebooth";
		$this->load->view('admin/theme',$data);
		
	}
	
	public function filtersvebooth(){

		$location = $this->input->get("location");
		$institute = $this->input->get("institute");
		
		if($location){
			$this->db->where("geolocation",$location);
		}
		if($institute){
			$this->db->where("institute_id",$institute);
		}
		$this->db->order_by("id","desc");
		$data = $this->db->get("tbl_student_institute_view_time")->result();
		
		$id = 1;
		$jsonData = [];
		foreach($data as $u){
			
			if($u->type == "loggedin"){
				
				$sdata = $this->db->get_where("tbl_students",["student_id"=>$u->student_id])->row();
				$ip = $u->ip_address;
				$geolocation = $u->geolocation;
				$sname = $sdata->student_name;
				$semail = $sdata->email;
				$smobile = $sdata->mobile_number;
				
			}else{
				
				$ip = $u->ip_address;
				$geolocation = $u->geolocation;
				$sname = "-";
				$semail = "-";
				$smobile = "-";
				
			}
			
//			if($geolocation==''){$geolocation = $this->institute_model->getGeo($ip);}
			$nData1 = array();
			$nData1["sno"] = $id;
			$nData1["inst"] = $this->db->get_where("tbl_institutes",["institute_id"=>$u->institute_id])->row()->institute_name;
			$nData1["aip"] = $ip;
			$nData1["ageo"] = $geolocation;
			$nData1["st_name"] = $sname;
			$nData1["st_email"] = $semail;
//			$nData1["st_mobile"] = $smobile;
			$nData1["type"] =  ($u->type == "loggedin") ? "Registered" : "Anonymous";
			$nData1["date"] = date("d-m-Y",strtotime($u->date));
			$jsonData[] = $nData1;

		  $id++;
			
		}
		
		$results = ["sEcho" => 1,"iTotalRecords" => count($jsonData),"iTotalDisplayRecords" => count($jsonData),"aaData" => $jsonData ];
		echo json_encode($results);
		
	}
	
	public function enquiries(){
		
		$data["details"] = $this->db->query("SELECT tbl_institute_ask_a_question.*,tbl_students.student_name,tbl_students.email,tbl_students.phone FROM tbl_institute_ask_a_question LEFT JOIN tbl_students ON tbl_institute_ask_a_question.student_id = tbl_students.student_id ORDER BY id DESC")->result();
		$data['subview'] = "dashboard/enquiries";
		$this->load->view('admin/theme',$data);
		
	}
}
