<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');

class Experts extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
		$this->admin_email = $this->login_model->get_option("admin_email_id")->email;
    }

	public function index()
	{
		
		$type = "admin";
		$data['sessions'] = $this->db->query("SELECT tbl_experts.*, tbl_expert_sessions.exp_se_id,tbl_expert_sessions.exp_se_date,tbl_expert_sessions.exp_se_time FROM tbl_experts LEFT JOIN tbl_expert_sessions ON tbl_experts.expert_id = tbl_expert_sessions.expert_id WHERE tbl_experts.login_type='".$type."' and  tbl_experts.expert_status='Active' and tbl_experts.is_deleted=0 GROUP BY tbl_experts.expert_id")->result();
		$this->load->view('front/experts/expert-counsellors',$data);
		
	}
	
	public function details($id)
	{
		
		$data['sessions'] = $this->db->query("SELECT * FROM tbl_experts WHERE expert_id=".$id."")->result();
		$data['psessions'] = $this->db->query("SELECT * FROM tbl_experts LEFT JOIN tbl_expert_sessions ON tbl_experts.expert_id = tbl_expert_sessions.expert_id WHERE tbl_experts.expert_id=".$id." and tbl_expert_sessions.amount='paid'")->result();
		$data['fsessions'] = $this->db->query("SELECT * FROM tbl_experts LEFT JOIN tbl_expert_sessions ON tbl_experts.expert_id = tbl_expert_sessions.expert_id WHERE tbl_experts.expert_id=".$id." and tbl_expert_sessions.amount='free'")->result();
		
		$this->load->view('front/experts/expert-details',$data);
	}

	public function save_expertsession(){
		
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
				$expert_id = $this->input->post("expid");
				$zoom_meeting = $this->db->where("expert_id", $expert_id)->where("session_id", $this->input->post('expert_session_id'))->get("tbl_zoom_meetings")->result();
				$zoom_link = '';
				$zoom_password = '';
				if(isset($zoom_meeting[0]->meeting_link)){ $zoom_link = $zoom_meeting[0]->meeting_link;}
				if(isset($zoom_meeting[0]->meeting_password)){ $zoom_password = $zoom_meeting[0]->meeting_password;}
		
		
		
		$sesdata = $this->db->get_where("tbl_expert_sessions",["exp_se_id"=>$this->input->post('expert_session_id')])->row();		
		if($sesdata->amount == "free"){
		
				$data2 = array(
				    "expert_id" => $expert_id,
					"exp_std_date" => $this->input->post("sesdate"),
					"exp_std_time" => $this->input->post("sestime"),
					"exp_std_duration" => $this->input->post("sesduration"),
					"exp_std_cost" => $this->input->post("sescost"),
					"student_id" => $insert_stdid,
					"exp_std_comment" => $stdcmt,
					"exp_std_request_session" => $checkBoxValue,
					"zoom_link" => $zoom_link,
					"zoom_password" => $zoom_password,
					"link" => "https://us04web.zoom.us/j/5948139849"
				);	

				$query2 = $this->db->insert("tbl_expert_student_schedule",$data2);
				
				$exp = $this->expert_model->get_expert_byid($expert_id);
				
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
				
				$msg = '<html><body>Hi '.$student_name.',<br>We have scheduled your meeting successfully with '.$this->input->post("exp_name").' on '.date('d-m-Y',strtotime($this->input->post("sesdate"))).'.<br>Thank you.</body></html>';
				$from = "$this->admin_email";
				$subject = "Meeting Schedule: KAB Education Fair";
				$to = $student_email;
				$re = $this->login_model->sendMail($from,$to,$subject,$msg);
				
				//Sms sending starts
				
				$sms_msg = 'Hi '.$student_name.' your meeting is scheduled with '.$this->input->post("exp_name").' on '.date('d-m-Y',strtotime($this->input->post("sesdate"))).' from KAB Education Fair';
				$sms = $this->login_model->sendSMS($student_phone,$sms_msg);
				
				//Email for success session starts Counsellor
				
				$msg1 = '<html><body>Hi '.$exp->expert_name.',<br>We have scheduled your meeting with '.$student_name.' on '.date('d-m-Y',strtotime($this->input->post("sesdate"))).'.<br>Thank you.</body></html>';
				$from = "$this->admin_email";
				$subject = "Meeting Schedule: KAB Education Fair";
				$to1 = $exp->expert_email;
				$re1 = $this->login_model->sendMail($from,$to1,$subject,$msg1);
				
				//Sms sending starts Counsellor
				
				$sms_msg1 = 'Hi '.$exp->expert_name.' your meeting is scheduled with '.$student_name.' on '.date('d-m-Y',strtotime($this->input->post("sesdate"))).'';
				$sms1 = $this->login_model->sendSMS($exp->expert_mobile,$sms_msg1);
				
				$data1=["Status"=>'Active',"Message"=>"Successfully applied for the session."];
			    echo json_encode($data1);
			    exit();
			
			}else{
			
				$student_data = $this->db->get_where("tbl_students",["student_id"=>$insert_stdid])->row();
				$oid = $this->student_model->generateOrderId();

				$this->session->set_userdata('order_id', $oid);

				$odata = [

					"order_id" => $oid,
					"session_id" => $this->input->post('expert_session_id'),
					"creator_id" => $expert_id,
					"session_organized_by" => "expert",
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
	public function scheduledmeeting($id)
	{   
		$datetime = date("Y-m-d H:i:s");
        $data['expert_details'] = $this->db->query("SELECT * FROM tbl_experts WHERE expert_id=".$id."")->result();
        
        $data['meetings'] = $this->db->query("SELECT * FROM tbl_expert_student_schedule LEFT JOIN tbl_students ON tbl_expert_student_schedule.student_id = tbl_students.student_id WHERE tbl_expert_student_schedule.expert_id='".$id."' ORDER BY exp_std_date DESC ")->result();
		$this->load->view('front/experts/meetinglist',$data);
	}

	public function registration()
	{
		$this->load->view('front/experts/registration');
	}
	public function verifyOTP()
	{
		$this->load->view('front/experts/verifyOTP');
	}	
	public function save_expert()
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
				"expert_name" => $this->input->post("name"),
				"expert_email" => $this->input->post("email"),
				"expert_mobile" => $this->input->post("phone"),
				"OTP" => $otp,
				"password" => $this->expert_login_model->api_key_crypt( $this->input->post("password"),'e')
			);
			 $check_phone = $this->expert_model->check_phone($data['phone']);

			 $check_email = $this->expert_model->check_email($data['email']);
				
			if($check_email){
				if($check_phone){
					$this->db->insert("tbl_experts",$data);
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
				$msg = "KAB Education expert registration verification OTP is : ".$otp;
				$this->session->set_userdata('e_phone',$mobile);
				$this->session->set_userdata('e_name',$this->input->post("name"));
				$this->login_model->sendSMS($mobile,$msg);
				$data1=["Status"=>'Active',"Message"=>"OTP sent to your mobile ."];
				echo json_encode($data1);
				exit();
			}
		}
	}
	public function otp_verify_expert()
	{
		$phone = $this->input->post("mobile");
		$otp = $this->input->post("otp");
		$expert_name = $this->input->post("e_name");
		$mdate = date("Y-m-d H:i:s");
		$chkphone = $this->expert_model->check_otp($phone);

		if($chkphone->OTP == $otp){
			$query = $this->db->where("expert_mobile",$phone)->update("tbl_experts",array('expert_status' =>'Inactive','modified' =>$mdate ));
			if($query){
			$this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">Expert Registered Successfully.!</div>');
			$data1=["Status"=>'Active',"Message"=>"Expert Registered Successfully."];
			echo json_encode($data1);	


			 	$msg = '<html><body>Dear '.$expert_name.',Thanks for registering with us,please find below are the loign link and details.<br>Link : <a href="'.base_url().'expert/login">Click Here</a><br>User ID : '.$chkphone->email.'<br>Password : '.$this->expert_login_model->api_key_crypt( $chkphone->password,"d").'<br>Admin,kabconsultants</body></html>';
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
		$chkphone = $this->expert_model->check_otp($mobile);
		$otp = $chkphone->OTP;
		$msg = "KAB Education expert registration verification OTP is : ".$otp;
		$this->login_model->sendSMS($mobile,$msg);
		$data=["Status"=>'Active',"Message"=>"OTP resend to your entered mobile number."];
		echo json_encode($data);
	}
	
}