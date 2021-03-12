<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');

class Speakers extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
		$this->admin_email = $this->login_model->get_option("admin_email_id")->email;
    }

	public function index()
	{
		
		$type = "admin";
		$date = strtotime(date("Y-m-d H:i:s"));
		$data['days'] = $this->db->query("select * from tbl_speaker_sessions where is_deleted=0 and spe_se_time>$date group by spe_se_date")->result();
		
		$this->load->view('front/speakers/speakers',$data);
	}
	
	public function eminentspeakers()
	{
		$type = "admin";
		$data['sessions'] = $this->db->query("SELECT tbl_speakers.*,tbl_speaker_sessions.spe_se_id,tbl_speaker_sessions.spe_se_date,tbl_speaker_sessions.spe_se_time FROM tbl_speakers LEFT JOIN tbl_speaker_sessions ON tbl_speakers.speaker_id = tbl_speaker_sessions.speaker_id WHERE tbl_speakers.login_type='".$type."' and tbl_speaker_sessions.is_deleted=0 and tbl_speakers.is_deleted=0  GROUP BY tbl_speakers.speaker_id ORDER BY RAND() ")->result();
		$this->load->view('front/speakers/emnentspeakers',$data);
	}
	
	public function details($id)
	{
		
		$data['sessions'] = $this->db->query("SELECT * FROM tbl_speakers WHERE speaker_id=".$id."")->result();
		$data['psessions'] = $this->db->query("SELECT * FROM tbl_speakers LEFT JOIN tbl_speaker_sessions ON tbl_speakers.speaker_id = tbl_speaker_sessions.speaker_id WHERE tbl_speakers.speaker_id=".$id." and tbl_speaker_sessions.amount='paid'")->result();
		
		$data['fsessions'] = $this->db->query("SELECT * FROM tbl_speakers LEFT JOIN tbl_speaker_sessions ON tbl_speakers.speaker_id = tbl_speaker_sessions.speaker_id WHERE tbl_speakers.speaker_id=".$id." and tbl_speaker_sessions.amount='free'")->result();
		
		$this->load->view('front/speakers/speaker-details',$data);
	}

	public function save_speakersession(){
		
		$loginmail = $this->session->userdata('email'); //$this->input->post("login_std_mail");

		if($loginmail && ($this->session->userdata('login_type')=="student")){
			$insert_stdid = $this->student_model->get_student_email($loginmail);
		
		} else {
			
			$data = array(
				"student_name" => $this->input->post("sname"),
				"email" => $this->input->post("email"),
				"phone" => $this->input->post("phone"),
				"address" => $this->input->post("address"),
				"status" => "Active"
			);

			$data['password'] = $this->student_login_model->api_key_crypt(random_string('alnum', 8),"e");
			$check_email = $this->student_model->check_email($data['email']);
			
			if($check_email){
				$query = $this->db->insert("tbl_students",$data);
				$insert_stdid = $this->db->insert_id();
			
			}else{
				$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">Student email already registered with us. can you please login and book the session.</div>');
				
				$data1=["Status"=>'InActive',"Message"=>"Student email already registered with us. can you please login and book the session."];
			 	echo json_encode($data1);
			 	exit();
			}
			
			if($query){
				$msg = '<html><body><small>User ID : '.$data["email"].'</small><br> <small>Password : '.$this->student_login_model->api_key_crypt( $data["password"],"d").'</small></body></html>';
				$from = "$this->admin_email";
				$subject = "Login Details : KAB Education Fair";
				$to = $data['email'];
				$re = $this->login_model->sendMail($from,$to,$subject,$msg);

			} }

				$reqses = $this->input->post("request-session-ckeckbox");
					if (isset($reqses)) {
					  $checkBoxValue = "1";
					} else {
					  $checkBoxValue = "0";
					}
				$cmt = $this->input->post("comment");
				if (isset($reqses)) {
					  $stdcmt = $cmt;
					} else {
					  $stdcmt = "";
					}

				$speaker_id = $this->input->post("speid");
				$zoom_meeting = $this->db->where("speaker_id", $speaker_id)->where("session_id", $this->input->post('speaker_session_id'))->get("tbl_zoom_meetings")->result();
				$zoom_link = '';
				$zoom_password = '';
				if(isset($zoom_meeting[0]->meeting_link)){ 
					$zoom_link = $zoom_meeting[0]->meeting_link;
				}
				if(isset($zoom_meeting[0]->meeting_password)){
					 $zoom_password = $zoom_meeting[0]->meeting_password;
					}
		
		
		$sesdata = $this->db->get_where("tbl_speaker_sessions",["spe_se_id"=>$this->input->post('speaker_session_id')])->row();
		
		if($sesdata->amount == "free"){

				$data2 = array(
				    "speaker_id" => $speaker_id,
					"spe_std_date" => $this->input->post("sesdate"),
					"spe_std_time" => $this->input->post("sestime"),
					"spe_std_duration" => $this->input->post("sesduration"),
					"spe_std_cost" => $this->input->post("sescost"),
					"student_id" => $insert_stdid,
					"spe_std_comment" => $stdcmt,
					"spe_std_request_session" => $checkBoxValue,
					"zoom_link" => $zoom_link,
					"zoom_password" => $zoom_password,
					"link" => "https://us04web.zoom.us/j/5948139849",
					"session_id" =>$this->input->post('speaker_session_id'),
				);	

				$query2 = $this->db->insert("tbl_speaker_student_schedule",$data2);
				
				
				$exp = $this->speaker_model->get_speaker_byid($speaker_id);
				
				if($loginmail && ($this->session->userdata('login_type')=="student")){
					$insert_stdid = $this->student_model->get_student_email($loginmail);			
					$student = $this->student_model->get_student_id($insert_stdid);
                    $student_name = $student->student_name;					
                    $student_email = $student->email;					
                    $student_phone = $student->phone;					
				}else{
				   $student_name = $data["student_name"];
				   $student_email = $data['email'];
				   $student_phone = $data['phone'];
				}
				//Email for success session starts
				
				$msg = '<html><body>Hi '.$student_name.',<br>We have scheduled your meeting successfully with '.$exp->speaker_name.' on '.date('d-m-Y',strtotime($this->input->post("sesdate"))).'.<br>Thank you.</body></html>';
				$from = "$this->admin_email";
				$subject = "Meeting Schedule: KAB Education Fair";
				$to = $student_email;
				$re = $this->login_model->sendMail($from,$to,$subject,$msg);
				
				//Sms sending starts
				
				$sms_msg = 'Hi '.$student_name.' your meeting is scheduled with '.$exp->speaker_name.' on '.date('d-m-Y',strtotime($this->input->post("sesdate"))).' from KAB Education Fair';
				$sms = $this->login_model->sendSMS($student_phone,$sms_msg);
				
				//Email for success session starts Counsellor
				
				$msg1 = '<html><body>Hi '.$exp->speaker_name.',<br>We have scheduled your meeting with '.$student_name.' on '.date('d-m-Y',strtotime($this->input->post("sesdate"))).'.<br>Thank you.</body></html>';
				$from = "$this->admin_email";
				$subject = "Meeting Schedule: KAB Education Fair";
				$to1 = $exp->speaker_email;
				$re1 = $this->login_model->sendMail($from,$to1,$subject,$msg1);
				
				//Sms sending starts Counsellor
				
				$sms_msg1 = 'Hi '.$exp->speaker_name.' your meeting is scheduled with '.$student_name.' on '.date('d-m-Y',strtotime($this->input->post("sesdate"))).'';
				$sms1 = $this->login_model->sendSMS($exp->speaker_mobile,$sms_msg1);
				
				$data1=["Status"=>'Active',"Message"=>"Successfully applied for the session."];
			    echo json_encode($data1);
			    exit();
			
		}else{
			
			$student_data = $this->db->get_where("tbl_students",["student_id"=>$insert_stdid])->row();
			$oid = $this->student_model->generateOrderId();

			$this->session->set_userdata('order_id', $oid);

			$odata = [

				"order_id" => $oid,
				"session_id" => $this->input->post('speaker_session_id'),
				"creator_id" => $speaker_id,
				"session_organized_by" => "speaker",
				"total_amount" => $this->input->post("sescost"),
				"student_id" => $insert_stdid,
				"session_data" => json_encode($sesdata),
				"student_data" => json_encode($student_data),
				"date_of_order" => date("Y-m-d H:i:s"),

			];

			$this->db->insert("tbl_orders",$odata);
			
			$data1=["Status"=>'Active',"Message"=>"Payment"];
			echo json_encode($data1);
			
		}

	}
	
	
	public function save_eventspeakersession(){
		
		$session_id = $this->input->post("session_id");
		$sedata = $this->db->query("select * from tbl_speaker_sessions where is_deleted=0 and spe_se_id='$session_id'")->row();
		
		
		$loginmail = $this->session->userdata('email'); //$this->input->post("login_std_mail");

		if($loginmail && ($this->session->userdata('login_type')=="student")){
			$insert_stdid = $this->session->userdata("student_id");
		
		} else {
			
			$data = array(
				"student_name" => $this->input->post("sname"),
				"email" => $this->input->post("email"),
				"phone" => $this->input->post("phone"),
				"address" => $this->input->post("address"),
				"status" => "Active"
			);

			$data['password'] = $this->student_login_model->api_key_crypt(random_string('alnum', 8),"e");
			$check_email = $this->student_model->check_email($data['email']);
			
			if($check_email){
				$query = $this->db->insert("tbl_students",$data);
				$insert_stdid = $this->db->insert_id();
			
			}else{
				$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">Student email already registered with us. can you please login and book the session.</div>');
				
				$data1=["Status"=>'InActive',"Message"=>"Student email already registered with us. can you please login and book the session."];
			 	echo json_encode($data1);
			 	exit();
			}
			
			if($query){
				$msg = '<html><body><small>User ID : '.$data["email"].'</small><br> <small>Password : '.$this->student_login_model->api_key_crypt( $data["password"],"d").'</small></body></html>';
				$from = "$this->admin_email";
				$subject = "Login Details : KAB Education Fair";
				$to = $data['email'];
				$re = $this->login_model->sendMail($from,$to,$subject,$msg);

			} 
		}

				$reqses = $this->input->post("request-session-ckeckbox");
					if (isset($reqses)) {
					  $checkBoxValue = "1";
					} else {
					  $checkBoxValue = "0";
					}
				$cmt = $this->input->post("comment");
				if (isset($reqses)) {
					  $stdcmt = $cmt;
					} else {
					  $stdcmt = "";
					}

				$speaker_id = $sedata->speaker_id;
				$zoom_meeting = $this->db->where("speaker_id", $speaker_id)->where("session_id", $session_id)->get("tbl_zoom_meetings")->result();
				$zoom_link = '';
				$zoom_password = '';
				if(isset($zoom_meeting[0]->meeting_link)){ $zoom_link = $zoom_meeting[0]->meeting_link;}
				if(isset($zoom_meeting[0]->meeting_password)){ $zoom_password = $zoom_meeting[0]->meeting_password;}

				$data2 = array(
				    "speaker_id" => $speaker_id,
					"spe_std_date" => $sedata->spe_se_date,
					"spe_std_time" => $sedata->spe_se_time,
					"spe_std_duration" => $sedata->duration,
					"spe_std_cost" => $sedata->amount,
					"student_id" => $insert_stdid,
					"spe_std_comment" => $stdcmt,
					"spe_std_request_session" => $checkBoxValue,
					"zoom_link" => $zoom_link,
					"zoom_password" => $zoom_password,
					"link" => "https://us04web.zoom.us/j/5948139849"
				);	

				$query2 = $this->db->insert("tbl_speaker_student_schedule",$data2);
				
				
				$exp = $this->db->get_where("tbl_speakers",["speaker_id"=>$speaker_id])->row();
				
				if($loginmail && ($this->session->userdata('login_type')=="student")){
					$insert_stdid = $this->student_model->get_student_email($loginmail);			
					$student = $this->student_model->get_student_id($insert_stdid);
                    $student_name = $student->student_name;					
                    $student_email = $student->email;					
                    $student_phone = $student->phone;					
				}else{
				   $student_name = $data["student_name"];
				   $student_email = $data['email'];
				   $student_phone = $data['phone'];
				}
				//Email for success session starts
				
				$msg = '<html><body>Hi '.$student_name.',<br>We have scheduled your meeting successfully with '.$exp->speaker_name.' on '.date('d-m-Y',strtotime($this->input->post("sesdate"))).'.<br>Thank you.</body></html>';
				$from = "$this->admin_email";
				$subject = "Meeting Schedule: KAB Education Fair";
				$to = $student_email;
				$re = $this->login_model->sendMail($from,$to,$subject,$msg);
				
				//Sms sending starts
				
				$sms_msg = 'Hi '.$student_name.' your meeting is scheduled with '.$exp->speaker_name.' on '.date('d-m-Y',strtotime($this->input->post("sesdate"))).' from KAB Education Fair';
				$sms = $this->login_model->sendSMS($student_phone,$sms_msg);
				
				//Email for success session starts Counsellor
				
				$msg1 = '<html><body>Hi '.$exp->speaker_name.',<br>We have scheduled your meeting with '.$student_name.' on '.date('d-m-Y',strtotime($this->input->post("sesdate"))).'.<br>Thank you.</body></html>';
				$from = "$this->admin_email";
				$subject = "Meeting Schedule: KAB Education Fair";
				$to1 = $exp->speaker_email;
				$re1 = $this->login_model->sendMail($from,$to1,$subject,$msg1);
				
				//Sms sending starts Counsellor
				
				$sms_msg1 = 'Hi '.$exp->speaker_name.' your meeting is scheduled with '.$student_name.' on '.date('d-m-Y',strtotime($this->input->post("sesdate"))).'';
				$sms1 = $this->login_model->sendSMS($exp->speaker_mobile,$sms_msg1);
				$data1=["Status"=>'Active',"Message"=>'<div class="alert alert-success">Successfully applied for the session.</div>'];
			    echo json_encode($data1);
			    exit();

	}

	public function registration()
	{
		$this->load->view('front/speakers/registration');
	}
	public function verifyOTP()
	{
		$this->load->view('front/speakers/verifyOTP');
	}	
	public function save_speaker()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('name', 'Full Name', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('phone', 'Mobile Number', 'required');
        if ($this->form_validation->run() == FALSE) {
		    $data1=["Status"=>'InActive',"Message"=>validation_errors()];
		 	echo json_encode($data1);
		 	exit();
		} 
		else {
			$mobile = $this->input->post("phone");
			$otp = random_string('alnum', 4);
			$admin = $this->db->get_where("tbl_admin")->row();
			$data = array(
				"institute_id" => $admin->id,
				"login_type" => 'admin',
				"speaker_name" => $this->input->post("name"),
				"speaker_email" => $this->input->post("email"),
				"speaker_mobile" => $this->input->post("phone"),
				"OTP" => $otp,
				"password" => $this->speaker_login_model->api_key_crypt( $this->input->post("password"),'e')
			);
			 $check_phone = $this->speaker_model->check_phone($data['phone']);

			 $check_email = $this->speaker_model->check_email($data['email']);
				
			if($check_email){
				if($check_phone){
					$this->db->insert("tbl_speakers",$data);
					$query = $this->db->insert_id();
				}else{
					$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">Mobile number : '.$data['phone'].' already exist.!</div>');
					$data1=["Status"=>'InActive',"Message"=>'Mobile number : '.$data['phone'].' already exist.'];
				 	echo json_encode($data1);
				 	exit();
				}
			}else{
				$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">Email : '.$data['email'].' already exist.!</div>');
				$data1=["Status"=>'InActive',"Message"=>'Email : '.$data['email'].' already exist.'];
				echo json_encode($data1);
				exit();
			}

			if($query){
				$msg = "KAB Education speaker registration verification OTP is : ".$otp;
				$this->session->set_userdata('s_phone',$mobile);
				$this->session->set_userdata('s_name',$this->input->post("name"));
				$this->login_model->sendSMS($mobile,$msg);
				$data1=["Status"=>'Active',"Message"=>"OTP sent to your mobile ."];
				echo json_encode($data1);
				exit();
			}
		}
	}
	public function otp_verify_speaker()
	{
		$phone = $this->input->post("mobile");
		$otp = $this->input->post("otp");
		$speaker_name = $this->input->post("s_name");
		$mdate = date("Y-m-d H:i:s");
		$chkphone = $this->speaker_model->check_otp($phone);

		if($chkphone->OTP == $otp){
			$query = $this->db->where("speaker_mobile",$phone)->update("tbl_speakers",array('speaker_status' =>'Inactive','modified' =>$mdate ));
			if($query){
			$this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">Speaker Registered Successfully.!</div>');
			$data1=["Status"=>'Active',"Message"=>"Speaker Registered Successfully."];
			echo json_encode($data1);	


			 	$msg = '<html><body>Dear '.$speaker_name.',Thanks for registering with us,please find below are the loign link and details.<br>Link : <a href="'.base_url().'speaker/login">Click Here</a><br>User ID : '.$chkphone->email.'<br>Password : '.$this->speaker_login_model->api_key_crypt( $chkphone->password,"d").'<br>Admin,kabconsultants</body></html>';
				$from = "noreply@kabconsultants.com";
				$subject = "Login Details : KAB Education Fair";
				$to = $chkphone->email;

				$this->login_model->sendMail($from,$to,$subject,$msg);


			 	$this->session->unset_userdata('phone');

			}
		} else {
				$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">Please Enter correct OTP.!</div>');
				$data1=["Status"=>'Inactive',"Message"=>"Please Enter correct OTP."];
				echo json_encode($data1);
			}
		
	}
	public function resend_OTP()
	{
		$mobile = $this->input->post("mobile");
		$chkphone = $this->speaker_model->check_otp($mobile);
		$otp = $chkphone->OTP;
		$msg = "KAB Education speaker registration verification OTP is : ".$otp;
		$this->login_model->sendSMS($mobile,$msg);
		$data=["Status"=>'Active',"Message"=>"OTP resend to your entered mobile number."];
		echo json_encode($data);
	}




	public function checkProfileviewtime(){
		
		$sid = ($this->session->userdata("student_id")) ? $this->session->userdata("student_id") : $this->input->ip_address();
		$profile_id = $this->input->post("profile_id");
		$ip_addr = $this->input->ip_address();
		$type = $this->input->post("type");
		$ref_type = $this->input->post("ref_type");
		$date = date("Y-m-d");
		
		$geolocation = $this->institute_model->getGeo($ip_addr);
		$schk = $this->db->get_where("tbl_viewprofiles_data",["student_id"=>$sid,"profile_id"=>$profile_id,"date"=>$date]);
		
		if($schk->num_rows() == 0){
			
			$data = ["student_id"=>$sid,"profile_id"=>$profile_id,"ip_address"=>$ip_addr,"geolocation"=>$geolocation,"date"=>$date,"status"=>"online","type"=>$type,"ref_type"=>$ref_type];
			$this->db->insert("tbl_viewprofiles_data",$data);
			
		}else{
			
			$this->db->where(["student_id"=>$sid,"profile_id"=>$profile_id,"date"=>$date])->update("tbl_viewprofiles_data",["status"=>"online"]);
			
		}
		echo "in";
		
	}
	
	public function updateProfileviewtime(){
		
		$sid = ($this->session->userdata("student_id")) ? $this->session->userdata("student_id") : $this->input->ip_address();
		$profile_id = $this->input->post("profile_id");
		$ip_addr = $this->input->ip_address();
		$type = $this->input->post("type");
		$ref_type = $this->input->post("ref_type");
		$date = date("Y-m-d");
		
		$schk = $this->db->get_where("tbl_viewprofiles_data",["student_id"=>$sid,"profile_id"=>$profile_id,"date"=>$date]);
		
		if($schk->num_rows() == 0){
			
		}else{
			
			$this->db->where(["student_id"=>$sid,"profile_id"=>$profile_id,"date"=>$date])->update("tbl_viewprofiles_data",["status"=>"offline"]);
			
		}
		echo "out";
		
	}
	
}