<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');
class Meetings extends CI_Controller{
	public function __construct()
	    {
	        parent::__construct();
	        if($this->session->userdata['login_type']!='professor'){redirect('professor/login');}
			$this->admin_email = $this->login_model->get_option("admin_email_id")->email;
	    }

	public function index()
	{
		$data['meetings'] = $this->db->query("SELECT * FROM tbl_professor_meeting LEFT JOIN tbl_students ON tbl_professor_meeting.session_student_id = tbl_students.student_id WHERE tbl_professor_meeting.session_pro_id='".$this->session->userdata['pro_id']."' ORDER BY session_date DESC ")->result();
		$data['subview'] = "meetings/meetings";
		$this->load->view('professor/theme',$data);
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
		
		$data['webinars'] = $this->db->query("SELECT * FROM tbl_webinors WHERE FIND_IN_SET(".$this->session->userdata['pro_id'].", professor_ids) ORDER BY date DESC ")->result();
		$data['subview'] = "webinars/webinars";
		$this->load->view('professor/theme',$data);
	}
	
	public function webinar_participants()
	{
		$data['webinars'] = $this->db->query("SELECT tbl_webinar_participants.*, tbl_webinors.*, tbl_students.student_name FROM tbl_webinar_participants LEFT JOIN tbl_webinors ON tbl_webinors.id=tbl_webinar_participants.webinar_id LEFT JOIN tbl_students ON tbl_students.student_id=tbl_webinar_participants.webinar_student_id WHERE tbl_webinar_participants.webinar_id='".$this->uri->segment(4)."' ORDER BY tbl_webinors.date DESC ")->result();
		$data['subview'] = "webinars/participants";
		$this->load->view('professor/theme',$data);
	}
	
	public function downloadText($id){
		
		$zdata = $this->db->get_where("tbl_zoom_meetings",["id"=>$id])->row();
		
		if($zdata){
			
			header('Content-Type: application/json');
			header('Content-Disposition: attachment; filename='.$zdata->meeting_id.'.txt');
			header('Pragma: no-cache');
			echo $zdata->converted_text;
			exit();	
			
		}else{
			
			redirect("professor/meetings");
			
		}
		
	}
	
}
