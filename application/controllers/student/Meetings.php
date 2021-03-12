<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');
class Meetings extends CI_Controller{
	public function __construct()
	    {
	        parent::__construct();
	        if($this->session->userdata['login_type']!='student'){redirect('student/login');}
			$this->admin_email = $this->login_model->get_option("admin_email_id")->email;
	    }

	public function index()
	{
		$ref = $this->input->get("ref");
		
		$status = "";
		$ctime = strtotime(date("Y-m-d H:i:s"));
		$id = $this->session->userdata['student_id'];	
		if($ref == "upcoming"){
			
//			$status = "and tbl_professor_meeting.session_time > $ctime";
			$this->db->where("tpm.session_time >",$ctime);
			
		}
		
		$data['meetings'] = $this->db->select(' tpm.*,tp.pro_name')
										->from('tbl_professor_meeting as tpm')
										->where('tpm.session_student_id', $id)
										->join('tbl_professors as tp', 'tp.pro_id = tpm.session_pro_id', 'LEFT')
										->get()->result();
		$data['subview'] = "meetings/meetings";
		$this->load->view('student/theme',$data);
	}
	public function councellors()
	{
		
		$data['councellormeetings'] = $this->db->query("SELECT tbl_counsellor_student_schedule.*,tbl_councellors.expert_name FROM tbl_counsellor_student_schedule LEFT JOIN tbl_councellors ON tbl_counsellor_student_schedule.expert_id = tbl_councellors.id WHERE tbl_counsellor_student_schedule.student_id='".$this->session->userdata['student_id']."' AND tbl_councellors.is_deleted='0' AND tbl_counsellor_student_schedule.is_deleted='0' AND tbl_councellors.expert_status='Active' ORDER BY exp_std_date DESC ")->result();
		
		$data['subview'] = "meetings/councellor_meetings";
		$this->load->view('student/theme',$data);
	}

	public function expertmeetings()
	{
		$ref = $this->input->get("ref");
		
		$status = "";
		$ctime = strtotime(date("Y-m-d H:i:s"));
			
		if($ref == "upcoming"){
			
			$status = "and tbl_expert_student_schedule.exp_std_time > $ctime";
			
			$this->db->where("tep.exp_std_time >",$ctime);
			
		}
		
		$id = $this->session->userdata['student_id'];
		$expert_designation = $this->input->get("expert_designation");
		$created = $this->input->get("created");
		if($created){
			$this->db->where("texp.created",$created);
		}
		if($expert_designation){
			$this->db->where("texp.expert_designation",$expert_designation);
		}
		$data['expertmeetings'] = $this->db->select(' tep.*,texp.*')
											->from('tbl_expert_student_schedule as tep')
											->where('tep.student_id', $id)
											->join('tbl_experts as texp', 'texp.expert_id = tep.expert_id', 'LEFT')
											->get();
		
		$data['subview'] = "meetings/expert_meetings";
		$this->load->view('student/theme',$data);
	}

	public function speakers()
	{
		
		$data['speakersmeetings'] = $this->db->query("SELECT tbl_speaker_student_schedule.*,tbl_speakers.* FROM tbl_speaker_student_schedule LEFT JOIN tbl_speakers ON tbl_speaker_student_schedule.speaker_id = tbl_speakers.speaker_id WHERE tbl_speaker_student_schedule.student_id='".$this->session->userdata['student_id']."' ORDER BY spe_std_date DESC ")->result();
		
		$data['subview'] = "meetings/speaker_meetings";
		$this->load->view('student/theme',$data);
	}
	public function add_session(){
		//echo $this->uri->segment(4);exit;
		if($this->uri->segment(4)){
			$data['sessions'] = $this->db->where("is_deleted",'0')->where("pro_se_id ",$this->uri->segment(4))->get("tbl_professor_sessions")->result();
		}else{
			$data['sessions'] = "";
		}
        //echo '<pre>';print_r($data);exit;
		$data['subview'] = "sessions/add_session";
		$this->load->view('professor/theme',$data);
	}
	public function save_session(){		        		
		$data = array(
		    "professor_id" => $this->session->userdata['pro_id'],
			"pro_se_date" => $this->input->post("date"),
			"pro_se_time" => $this->input->post("time"),
			"pro_se_session" => $this->input->post("session_type"),
			"pro_se_cost" => $this->input->post("cost"),
			"institute_id" => $this->session->userdata['pro_inst_id']
		);		
		if($this->input->post("pro_se_id") != ""){
			$this->db->where("pro_se_id",$this->input->post("pro_se_id"))->update("tbl_professor_sessions",$data);
			$data1=["Status"=>'Active',"Message"=>"Successfully Updated."];
			echo json_encode($data1);
			exit();
		}else{
			$query = $this->db->insert("tbl_professor_sessions",$data);
			$data1=["Status"=>'Active',"Message"=>"Successfully Inserted."];
		    echo json_encode($data1);
		    exit();
		} 	
	}
	function save_in_session(){
		   $this->session->set_userdata(array('ProStudentData' =>$_POST));
		   $data1=["Status"=>'Active',"Message"=>"Successfully Inserted."];
			echo json_encode($data1);
			exit();
	}
	function payment_page(){
		$data['sessions'] = $this->db->where("professor_id",$this->session->userdata['pro_id'])->where("is_deleted",'0')->get("tbl_professor_sessions")->result();
		$data['subview'] = "sessions/payment_result";
		$this->load->view('professor/theme',$data);
	}
	function save_student_booking(){
		//echo '<pre>';print_r($_POST);exit;
		$check_email = $this->student_model->check_email($this->input->post("student_email"));
		if($check_email){
			$data = array(
		    "student_name" => $this->input->post("student_name"),
			"email" => $this->input->post("student_email"),
			"phone" => $this->input->post("student_phone"),
			"address" => $this->input->post("student_address"),
			"status" => "Active"
			);
			$data['password'] = $this->student_login_model->api_key_crypt(random_string('alnum', 8),"e");
			$check_email = $this->student_model->check_email($data['email']);
			
			
			
			$this->db->insert("tbl_students",$data);
            $insert_id = $this->db->insert_id();
			
			
			
			$data2 = array(
			"session_pro_id" => $this->input->post("pro_id"),
			"session_student_id" => $insert_id,
			"session_type" => $this->input->post("session_type"),
			"session_cost" => $this->input->post("session_cost"),
			"session_date" => $this->input->post("session_date"),
			"session_time" => $this->input->post("session_time"),
			"request_session_time" => $this->input->post("request_session"),
			);
			//echo '<pre>';print_r($data2);exit;
			$this->db->insert("tbl_professor_meeting",$data2);
			
			$msg = '<html><body><small>User ID : '.$data["email"].'</small><br> <small>Password : '.$this->student_login_model->api_key_crypt( $data["password"],"d").'</small></body></html>';
			$from = "$this->admin_email";
			$subject = "Login Details : KAB Education Fair";
			$to = $data['email'];
			$re = $this->login_model->sendMail($from,$to,$subject,$msg);

			$data1=["Status"=>'Active',"Message"=>"Successfully Inserted."];
			echo json_encode($data1);
			exit();
			
		}else{
			
			$student_id = $this->db->where("is_deleted",'0')->where("email",$this->input->post("student_email"))->get("tbl_students")->row()->student_id ;
			
			
			
			$data3 = array(
			"session_pro_id" => $this->input->post("pro_id"),
			"session_student_id" => $student_id,
			"session_type" => $this->input->post("session_type"),
			"session_cost" => $this->input->post("session_cost"),
			"session_date" => $this->input->post("session_date"),
			"session_time" => $this->input->post("session_time"),
			"request_session_time" => $this->input->post("request_session"),
			);
			//echo '<pre>';print_r($data3);exit;
			$this->db->insert("tbl_professor_meeting",$data3);
			
			$data1=["Status"=>'Active',"Message"=>"Successfully Inserted."];
			echo json_encode($data1);
			exit();
			
		}
		
	}
	public function webinars()
	{
		
		$data['webinars'] = $this->db->query("SELECT tbl_webinar_participants.*, tbl_webinors.*,tbl_professors.pro_name FROM tbl_webinar_participants LEFT JOIN tbl_webinors ON tbl_webinors.id=tbl_webinar_participants.webinar_id LEFT JOIN tbl_professors ON tbl_professors.pro_id=tbl_webinors.professor_id WHERE tbl_webinar_participants.webinar_student_id='".$this->session->userdata['student_id']."' ORDER BY tbl_webinors.date DESC ")->result();
		//echo '<pre>';print_r($data);exit;
		$data['subview'] = "webinars/webinars";
		$this->load->view('student/theme',$data);
	}
	
	public function auditorium_presentations()
	{
		
		$ref = $this->input->get("ref");
		
		$status = "";
		$ctime = strtotime(date("Y-m-d H:i:s"));
			
		if($ref == "upcoming"){
			
			$this->db->where("from_time >",$ctime);
			
		}
		$data['webinars'] = $this->db->order_by("id","desc")->get_where("tbl_student_auditorium_presentations",["student_id"=>$this->session->userdata['student_id']])->result();
		
		$data['subview'] = "auditorium_presentations/auditorium_presentations";
		$this->load->view('student/theme',$data);
	}
	
}
