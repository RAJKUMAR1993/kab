<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');

class Professor extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
		$this->admin_email = $this->login_model->get_option("admin_email_id")->email;
    }

	public function index()
	{
		
		$type = "admin";
        $data['sessions'] = $this->db->query("SELECT * FROM tbl_professors LEFT JOIN tbl_professor_sessions ON tbl_professors.pro_id = tbl_professor_sessions.professor_id WHERE tbl_professors.is_deleted=0 and tbl_professors.pro_status='Active' GROUP BY tbl_professors.pro_id")->result();
		$this->load->view('front/Professor/new_Professor-counsellors',$data);
	}
	
	// public function details($id)
	// {   
 //        $data['sessions'] = $this->db->query("SELECT * FROM tbl_professors LEFT JOIN tbl_professor_sessions ON tbl_professors.pro_id = tbl_professor_sessions.professor_id WHERE tbl_professors.pro_id=".$id."")->result();
	// 	//echo '<pre>';print_r($data);exit();
	// 	$this->load->view('front/Professor/professor-details',$data);
	// }
	public function details($id)
	{   
		
		$datetime = date("Y-m-d H:i:s");
        $data['professor_details'] = $this->db->query("SELECT * FROM tbl_professors WHERE pro_id=".$id."")->result();
        $data['sessions'] = $this->db->query("SELECT DISTINCT duration FROM tbl_professor_sessions WHERE professor_id=".$id." AND pro_se_time >= ".strtotime($datetime))->result();
		$this->load->view('front/Professor/professor-details',$data);
	}
    function save_in_session(){
	   	$this->session->set_userdata(array('ProStudentData' =>$_POST));
	   	$status = 'Active';
	   	$msg = "Successfully Added.";

	   	$post = $this->session->userdata('ProStudentData');
		$email = $this->session->userdata('email');
		$type = $this->session->userdata('login_type');
		if($email!='' && $type=='student'){
			$insert_id = $this->session->userdata('student_id');
		}
		else{
			$check_email = $this->student_model->check_email($post["student_email"]);
			if($check_email){
				$data = array(
				"student_name" => $post["student_name"],
				"email" => $post["student_email"],
				"phone" => $post["student_phone"],
				"address" => $post["student_address"],
				"status" => "Active"
				);
				$data['password'] = $this->student_login_model->api_key_crypt(random_string('alnum', 8),"e");
				$this->db->insert("tbl_students",$data);
				$insert_id = $this->db->insert_id();
				$this->session->set_userdata('sessionUserPassword', $data['password']);
			}			
			else{
				$insert_id = $this->db->where("is_deleted",'0')->where("email",$post["student_email"])->get("tbl_students")->row()->student_id ;
			}
		}
		if($insert_id){
			$this->session->set_userdata('sessionStudentId', $insert_id);
			$checkexists = $this->db->select("*")->where("session_student_id", $insert_id)->where("session_pro_id", $post['pro_id'])->where("session_type", $post['session_type'])->where("session_date", $post['session_date'])->where("session_time", $post['session_time'])->get("tbl_professor_meeting");
			if($checkexists->num_rows()==0){
				if($post['session_cost']==0 || $post['session_cost']==''){
				   	$status = $this->saveMeeting();
//				   	$msg = "Not able to save the meeting. User is not found.";
					if($status=="Active"){$msg = "Meeting saved successfully.";}
			   	}else{
					
					$session_data = $this->db->get_where("tbl_professor_sessions",["pro_se_id"=>$post['pro_session_id'],"is_deleted"=>0])->row();
					$student_data = $this->db->get_where("tbl_students",["student_id"=>$insert_id])->row();
					$oid = $this->student_model->generateOrderId();
					
					$this->session->set_userdata('order_id', $oid);
					
					$odata = [

						"order_id" => $oid,
						"session_id" => $post['pro_session_id'],
						"creator_id" => $post['pro_id'],
						"session_organized_by" => "professor",
						"total_amount" => $post['session_cost'],
						"student_id" => $insert_id,
						"session_data" => json_encode($session_data),
						"student_data" => json_encode($student_data),
						"date_of_order" => date("Y-m-d H:i:s"),
						
					];
					
					$this->db->insert("tbl_orders",$odata);
					
				}
				
			}
			else{
				$status = 'InActive';
				$msg = "You already booked this session of this professor.";
			}
		}
		else{
			$status = 'InActive';
			$msg = "Not able to save the user.";
		}
	   	$data1=["Status"=>$status,"Message"=>$msg];
		echo json_encode($data1);
		exit();
	}
	function payment_page(){
		$this->load->view('front/payment/ccavenue/index');
	}
	function save_student_booking(){
		if($this->input->post("mode") == "success"){
			$status = $this->saveMeeting();
			$msg = "Not able to save the meeting. User is not found.";
			if($status=="Active"){$msg = "Meeting saved successfully.";}
			$data1=["Status"=>$status,"Message"=>$msg];
			echo json_encode($data1);
			exit();
	    }else{
		    $data1=["Status"=>'InActive',"Message"=>"Unable to Add."];
			echo json_encode($data1);
			exit();
	    }
	}
	public function saveMeeting(){

		$insert_id = $this->session->userdata('sessionStudentId');
		$post = $this->session->userdata('ProStudentData');
		
		if($insert_id){				
			$zoom_meeting = $this->db->where("professor_id", $post['pro_id'])->where("session_id", $post['pro_session_id'])->get("tbl_zoom_meetings")->result();
			$zoom_link = '';
			$zoom_password = '';
			if(isset($zoom_meeting[0]->meeting_link)){ $zoom_link = $zoom_meeting[0]->meeting_link;}
			if(isset($zoom_meeting[0]->meeting_password)){ $zoom_password = $zoom_meeting[0]->meeting_password;}
			$data2 = array(
				"session_pro_id" => $post["pro_id"],
				"session_student_id" => $insert_id,
				"session_type" => $post["session_type"],
				"session_cost" => $post["session_cost"],
				"session_date" => $post["session_date"],
				"session_time" => $post["session_time"],
				"zoom_link" => $zoom_link,
				"zoom_password" => $zoom_password,
			//"request_session_time" => $post["request_session"],
			);
			$password = $this->session->userdata('sessionUserPassword');
			if(isset($password)){
				$data2['link'] = "https://us04web.zoom.us/j/5948139849";
			}
			//echo '<pre>';print_r($data2);exit;
			$this->db->insert("tbl_professor_meeting",$data2);
			if(isset($password)){
				$msg = '<html><body><small>User ID : '.$post["student_email"].'</small><br> <small>Password : '.$this->student_login_model->api_key_crypt( $password,"d").'</small></body></html>';
				$from = "$this->admin_email";
				$subject = "Login Details : KAB Education Fair";
				$to = $post['student_email'];
				$re = $this->login_model->sendMail($from,$to,$subject,$msg);
			}
            
			$this->session->unset_userdata('ProStudentData');
			$this->session->unset_userdata('sessionUserPassword');
			$this->session->unset_userdata('sessionStudentId');
			
			$exp = $this->db->query("SELECT * FROM tbl_professors WHERE pro_id=".$post["pro_id"]."")->row();
			
			$student = $this->student_model->get_student_id($insert_id);
			
            $student_name = $student->student_name;					
            $student_email = $student->email;					
            $student_phone = $student->phone;
			
			
			    //Email for success session starts
				
				$msg = '<html><body>Hi '.$student_name.',<br>We have scheduled your meeting successfully with '.$exp->pro_name.' on '.date('d-m-Y',strtotime($post["session_date"])).'.<br>Thank you.</body></html>';
				$from = "$this->admin_email";
				$subject = "Meeting Schedule: KAB Education Fair";
				$to = $student_email;
				$re = $this->login_model->sendMail($from,$to,$subject,$msg);
				
				//Sms sending starts
				
				$sms_msg = 'Hi '.$student_name.' your meeting is scheduled with '.$exp->pro_name.' on '.date('d-m-Y',strtotime($post["session_date"])).' from KAB Education Fair';
				$sms = $this->login_model->sendSMS($student_phone,$sms_msg);
				
				//Email for success session starts Counsellor
				
				$msg1 = '<html><body>Hi '.$exp->pro_name.',<br>We have scheduled your meeting with '.$student_name.' on '.date('d-m-Y',strtotime($post["session_date"])).'.<br>Thank you.</body></html>';
				$from = "$this->admin_email";
				$subject = "Meeting Schedule: KAB Education Fair";
				$to1 = $exp->pro_email;
				$re1 = $this->login_model->sendMail($from,$to1,$subject,$msg1);
				
				//Sms sending starts Counsellor
				
				$sms_msg1 = 'Hi '.$exp->pro_name.' your meeting is scheduled with '.$student_name.' on '.date('d-m-Y',strtotime($post["session_date"])).'';
				$sms1 = $this->login_model->sendSMS($exp->mobile1,$sms_msg1);
			
			return 'Active';
			
		}else{
			return 'Inactive';
		}
	}
	public function institute_professors($inst_id){
		$data["idata"] = $this->db->get_where("tbl_institutes",["institute_id"=>$inst_id])->row();
		$result = $this->db->query("SELECT * FROM tbl_professors WHERE institute_id=".$inst_id."")->result();
		if(!empty($result)){
			$data['sessions'] = $result;
            $data['result'] = "";			
		}else{
			$data['result'] = "nodata";
		}
		$this->load->view('front/Professor/institute_professors',$data);
	}
	public function institute_speakers($inst_id){
		$data["idata"] = $this->db->get_where("tbl_institutes",["institute_id"=>$inst_id])->row();
		$result = $this->db->query("SELECT * FROM tbl_speakers WHERE institute_id=".$inst_id."")->result();
		if(!empty($result)){
			$data['sessions'] = $result;
            $data['result'] = "";			
		}else{
			$data['result'] = "nodata";
		}
		$this->load->view('front/Professor/institute_speakers',$data);
	}
	public function institute_counsellers($inst_id){
		$data["idata"] = $this->db->get_where("tbl_institutes",["institute_id"=>$inst_id])->row();
		$result = $this->db->query("SELECT * FROM tbl_experts WHERE institute_id=".$inst_id."")->result();
		if(!empty($result)){
			$data['sessions'] = $result;
            $data['result'] = "";			
		}else{
			$data['result'] = "nodata";
		}
		$this->load->view('front/Professor/institute_counsellers',$data);
	}
	
	public function scheduledmeeting($id)
	{   
		$datetime = date("Y-m-d H:i:s");
        $data['professor_details'] = $this->db->query("SELECT * FROM tbl_professors WHERE pro_id=".$id."")->result();
        
        $data['meetings'] = $this->db->query("SELECT * FROM tbl_professor_meeting LEFT JOIN tbl_students ON tbl_professor_meeting.session_student_id = tbl_students.student_id WHERE tbl_professor_meeting.session_pro_id='".$id."' ORDER BY session_date DESC ")->result();
		$this->load->view('front/professor/meetinglistpro',$data);
	}
	
	public function registration()
	{
		$this->load->view('front/professor/registration');
	}
	public function verifyOTP()
	{
		$this->load->view('front/professor/verifyOTP');
	}	
	public function save_professor()
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
				"pro_name" => $this->input->post("name"),
				"pro_email" => $this->input->post("email"),
				"mobile1" => $this->input->post("phone"),
				"OTP" => $otp,
				"password" => $this->professor_login_model->api_key_crypt( $this->input->post("password"),'e')
			);
			 $check_phone = $this->professor_login_model->check_phone($data['phone']);

			 $check_email = $this->professor_login_model->check_email($data['email']);
				
			if($check_email){
				if($check_phone){
					$this->db->insert("tbl_professors",$data);
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
				$msg = "KAB Education professor registration verification OTP is : ".$otp;
				$this->session->set_userdata('p_phone',$mobile);
				$this->session->set_userdata('p_name',$this->input->post("name"));
				$this->login_model->sendSMS($mobile,$msg);
				$data1=["Status"=>'Active',"Message"=>"OTP sent to your mobile ."];
				echo json_encode($data1);
				exit();
			}
		}
	}
	public function otp_verify_professor()
	{
		$phone = $this->input->post("mobile");
		$otp = $this->input->post("otp");
		$professor_name = $this->input->post("p_name");
		$mdate = date("Y-m-d H:i:s");
		$chkphone = $this->professor_login_model->check_otp($phone);

		if($chkphone->OTP == $otp){
			$query = $this->db->where("mobile1",$phone)->update("tbl_professors",array('pro_status' =>'Inactive','modified' =>$mdate ));
			if($query){
			$this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">Professor Registered Successfully.!</div>');
			$data1=["Status"=>'Active',"Message"=>"Professor Registered Successfully."];
			echo json_encode($data1);	


			 	$msg = '<html><body>Dear '.$professor_name.',Thanks for registering with us,please find below are the loign link and details.<br>Link : <a href="'.base_url().'professor/login">Click Here</a><br>User ID : '.$chkphone->email.'<br>Password : '.$this->professor_login_model->api_key_crypt( $chkphone->password,"d").'<br>Admin,kabconsultants</body></html>';
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
		$chkphone = $this->professor_login_model->check_otp($mobile);
		$otp = $chkphone->OTP;
		$msg = "KAB Education professor registration verification OTP is : ".$otp;
		$this->login_model->sendSMS($mobile,$msg);
		$data=["Status"=>'Active',"Message"=>"OTP resend to your entered mobile number."];
		echo json_encode($data);
	}	
}