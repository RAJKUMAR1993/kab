<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');

class Students extends CI_Controller{

	public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

	public function registration()
	{

		$this->load->view('front/students/new_registration');
	}

	public function verifyOTP()
	{
		$this->load->view('front/students/verifyOTP');
	}
	
	

	function random_username($user_name)
	{
	 	$new_name = $user_name.mt_rand(0,10000);
	 	return $new_name;//$this->check_user_name($new_name,$user_name);
	}

/*	function check_user_name($new_name,$user_name)
	{
		 $select = $this->db->where("profile_name")->get("tbl_students")->num_rows();

		 if($select)
		 {
		  $this->random_username($user_name);
		 }
		 else
		 {
		  echo $new_name;
		 }
	}*/


	public function save_student(){
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
			$data = array(
				"student_name" => $this->input->post("name"),
				"email" => $this->input->post("email"),
				"phone" => $this->input->post("phone"),
				"OTP" => $otp,
	//			"address" => $this->input->post("address"),
				"password" => $this->student_login_model->api_key_crypt( $this->input->post("password"),'e')
			);/*print_r($data);
			 exit;*/
			 $check_phone = $this->student_model->check_phone($data['phone']);

			 $check_email = $this->student_model->check_email($data['email']);
				
			if($check_email){
				if($check_phone){
					$this->db->insert("tbl_students",$data);
					$query = $this->db->insert_id();
					$query2 = $this->db->insert("tbl_academics",array("student_id"=>$query));
				}else{
					$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">Mobile number : '.$data['phone'].' already exist.!</div>');
					//redirect("student/registration");
					$data1=["Status"=>'InActive',"Message"=>'Mobile number : '.$data['phone'].' already exist.'];
				 	echo json_encode($data1);
				 	exit();
				}
			}else{
				$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">Email : '.$data['email'].' already exist.!</div>');
				$data1=["Status"=>'InActive',"Message"=>'Email : '.$data['email'].' already exist.'];
				echo json_encode($data1);
				exit();
				//redirect("student/registration");
			}

			if($query){
				$msg = "KAB Education student registration verification OTP is : ".$otp;
				$this->session->set_userdata('phone',$mobile);
				$this->session->set_userdata('s_name',$this->input->post("name"));
				$this->login_model->sendSMS($mobile,$msg);
				$data1=["Status"=>'Active',"Message"=>"OTP sent to your mobile ."];
				echo json_encode($data1);
				exit();
				//redirect("student/verifyOTP");
			}
		}
	}

	
	public function otp_verify_student(){
		$phone = $this->input->post("mobile");
		$otp = $this->input->post("otp");
		$student_name = $this->input->post("s_name");
		$mdate = date("Y-m-d H:i:s");
		$chkphone = $this->student_model->check_otp($phone);

		if($chkphone->OTP == $otp){
			$query = $this->db->where("phone",$phone)->update("tbl_students",array('status' =>'Active','modified' =>$mdate ));
			if($query){
			$this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">Student Registered Successfully.!</div>');
			$data1=["Status"=>'Active',"Message"=>"Student Registered Successfully."];
			echo json_encode($data1);	
			 //redirect("student/login");


			 	$msg = '<html><body>Dear '.$student_name.',Thanks for registering with us,please find below are the loign link and details.<br>Link : <a href="'.base_url().'student/login">Click Here</a><br>User ID : '.$chkphone->email.'<br>Password : '.$this->student_login_model->api_key_crypt( $chkphone->password,"d").'<br>Admin,kabconsultants</body></html>';
				$from = "noreply@kabconsultants.com";
				$subject = "Login Details : KAB Education Fair";
				$to = $chkphone->email;

				$this->login_model->sendMail($from,$to,$subject,$msg);


			 	$this->session->unset_userdata('phone');

			}
		} else {
				$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">Please Enter correct OTP.!</div>');
				//$msg = "KAB Education student registration verification OTP is : ".$chkphone->OTP;
				/*$this->login_model->sendSMS($phone,$msg);*/
				//redirect("student/verifyOTP");
				$data1=["Status"=>'Inactive',"Message"=>"Please Enter correct OTP."];
				echo json_encode($data1);
			}
		
	}

	public function resend_OTP(){
		$mobile = $this->input->post("mobile");
		$chkphone = $this->student_model->check_otp($mobile);
		$otp = $chkphone->OTP;
		$msg = "KAB Education student registration verification OTP is : ".$otp;
		$this->login_model->sendSMS($mobile,$msg);
		$data=["Status"=>'Active',"Message"=>"OTP resend to your entered mobile number."];
		echo json_encode($data);
		
		
	}

}
