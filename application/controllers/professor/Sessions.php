<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');
class Sessions extends CI_Controller{
	public function __construct()
	    {
	        parent::__construct();
	        if($this->session->userdata['login_type']!='professor'){redirect('professor/login');}
			$this->admin_email = $this->login_model->get_option("admin_email_id")->email;
	    }

	public function index()
	{
		$data['sessions'] = $this->db->where("professor_id",$this->session->userdata['pro_id'])->where("is_deleted",'0')->order_by("pro_se_date ","desc")->get("tbl_professor_sessions")->result();
		$data['subview'] = "sessions/sessions";
		$this->load->view('professor/theme',$data);
	}
	public function add_session(){
		$session_id = $this->uri->segment(4);
		if($session_id){
			$session = $this->db->where("is_deleted",'0')->where("pro_se_id ",$session_id)->get("tbl_professor_sessions")->result();
			$professor_id = (isset($session[0]->professor_id)) ? $session[0]->professor_id : '';
			$zoom_meeting = '';
			if($professor_id!=''){
				$zoom_meeting = $this->db->where("professor_id", $professor_id)->where("session_id", $session_id)->get("tbl_zoom_meetings")->result();
			}
			$data['sessions'] = $session;
			$data['zoom_meeting'] = $zoom_meeting;
		}else{
			$data['sessions'] = "";
			$data['zoom_meeting'] = "";
		}
        //echo '<pre>';print_r($data);exit;
		$data['subview'] = "sessions/add_session";
		$this->load->view('professor/theme',$data);
	}
	public function save_session(){
		$pro_se_id = $this->input->post("pro_se_id");
		$date = $this->input->post("date");
		$time_input = $this->input->post("time");
		$title = $this->input->post("title");
		$duration = $this->input->post("duration");
		if($date!='' && $date!='0000:00:00' && $time_input!='' && $time_input!='00:00'){
			$time = $date.' '.$time_input;
			$time = strtotime($time);
			$professor_id = $this->session->userdata['pro_id'];
			$check = $this->db->select("*")->where("professor_id", $professor_id);
			if($pro_se_id!=''){
				$check = $check->where("pro_se_id !=", $pro_se_id);
			}
			$prog = $check->where("is_deleted", "0")->get("tbl_professor_sessions")->result();
			
			foreach($prog as $pro){
				$given_time_min = date('i', strtotime($time_input));
				$start_time = date('H:i', $pro->pro_se_time);
				$end_time = date("H:i", strtotime('+'.$pro->duration.' minutes', $pro->pro_se_time));
				if($pro->pro_se_date == $date){
					$st = strtotime($start_time);
					$en = strtotime($end_time);
					$ti = strtotime($time_input);
					
					$given_end_time = date("H:i", strtotime('+'.$duration.' minutes', $ti));
					$gi_en_tim = strtotime($given_end_time);
					
					if($given_time_min != "00"){
						if ( in_array($ti, range($st,$en)) || in_array($gi_en_tim, range($st,$en))) {
							$k = 1;
						}
					}else{
						if($ti >= $st && $ti <= $en){
						 $k = 1;
					    }
					}
				}			
			}
			if($k != 1){
				$data = array(
				    "professor_id" => $professor_id,
					"pro_se_date" => $date,
					"pro_se_time" => $time,
					"title" => $title,
					"description" => $this->input->post("description"),
					"duration" => $duration,
					"amount" => $this->input->post("amount"),
					"institute_id" => $this->session->userdata['pro_inst_id']
				);		
				if($pro_se_id != ""){
					$this->db->where("pro_se_id",$pro_se_id)->update("tbl_professor_sessions",$data);
					$data1=["Status"=>'Active',"Message"=>"Successfully Updated."];
					//echo json_encode($data1);
					//exit();
				}else{
					$query = $this->db->insert("tbl_professor_sessions",$data);
					$pro_se_id = $this->db->insert_id();
					$data1=["Status"=>'Active',"Message"=>"Successfully Inserted.Meeting Created Successfully."];
				} 	
				$start_time = $date.'T'.date('H:i:s', $time);
				//Create Zoom meeting
				$meeting = $this->accesstoken->create_meeting($user_type=1, $title, $start_time, $duration, $pro_se_id, $professor_id);
				//Create Zoom meeting
				echo json_encode($data1);
				exit();
			}
			else{
				$data1=["Status"=>'Inactive',"Message"=>"You already have a session on this date and time."];
			    echo json_encode($data1);
			    exit();
			}
		}
		else{
			$data1=["Status"=>'Inactive',"Message"=>"Date and Time both required."];
		    echo json_encode($data1);
		    exit();
		}
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
	
}
