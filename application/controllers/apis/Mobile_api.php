<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Mobile_api extends REST_Controller 
{
	public function __construct(){
			parent::__construct();

	}
	

// student apis	
	
	public function studentlogin_post(){
		
		$email = $this->input->post("email");
		$password = $this->input->post("password");
		
		$data = $this->student_login_model->login($email,$password);
		//print_r($this->session->userdata()); exit;
		if($data['status']){
			if(isset($data['type']) && $data['type']==='student'){
				
				$userdata = $this->db->get_where("tbl_students",["email"=>$email])->row();
				$data1=["Status"=>true,"Message"=>"Successfully loggedin.","user_data"=>$userdata];
				echo json_encode($data1);
			}
			else{
				$data1=["Status"=>false,"Message"=>"Please check login credentials."];
				 echo json_encode($data1);
				//redirect('student/login');
			}

		}else{
			$data1=["Status"=>false,"Message"=>"Please check login credentials."];
			 echo json_encode($data1);
			//redirect('student/login');
		}

	}
	
	public function studentregister_post(){
       
		$mobile = $this->input->post("phone");
		$otp = random_string('numeric', 4);
		$data = array(
			"student_name" => $this->input->post("student_name"),
			"email" => $this->input->post("email"),
			"phone" => $this->input->post("phone"),
			"OTP" => $otp,
			"address" => $this->input->post("address"),
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
				//redirect("student/registration");
				$data1=["Status"=>false,"Message"=>'Mobile number : '.$data['phone'].' already exist.'];
			 	echo json_encode($data1);
			 	exit();
			}
		}else{
			$data1=["Status"=>false,"Message"=>'Email : '.$data['email'].' already exist.'];
			echo json_encode($data1);
			exit();
			//redirect("student/registration");
		}

		if($query){
			$msg = "KAB Education student registration verification OTP is : ".$otp;
			$this->login_model->sendSMS($mobile,$msg);
			$data1=["Status"=>true,"Message"=>"OTP sent to your mobile ."];
			echo json_encode($data1);
			exit();
			//redirect("student/verifyOTP");
		}
	
    }
	
	public function student_check_otp_post(){
		
		$phone = $this->input->post("mobile");
		$otp = $this->input->post("otp");
		$mdate = date("Y-m-d H:i:s");
		$chkphone = $this->student_model->check_otp($phone);

		if($chkphone){
		
			if($chkphone->OTP == $otp){
				$query = $this->db->where("phone",$phone)->update("tbl_students",array('status' =>'Active','modified' =>$mdate ));
				if($query){
					$data1=["Status"=>true,"Message"=>"Student Registered Successfully."];
					echo json_encode($data1);	

					$msg = '<html><body>Dear '.$chkphone->student_name.',Thanks for registering with us,please find below are the loign link and details.<br>Link : <a href="'.base_url().'student/login">Click Here</a><br>User ID : '.$chkphone->email.'<br>Password : '.$this->student_login_model->api_key_crypt( $chkphone->password,"d").'<br>Admin,kabconsultants</body></html>';
					$from = "noreply@kabconsultants.com";
					$subject = "Login Details : KAB Education Fair";
					$to = $chkphone->email;

					$this->login_model->sendMail($from,$to,$subject,$msg);

				}
			} else {
				$data1=["Status"=>false,"Message"=>"Please Enter correct OTP."];
				echo json_encode($data1);
			}

		} else {
			$data1=["Status"=>false,"Message"=>"Mobile Number is not registered."];
			echo json_encode($data1);
		}
	}
	
// Institute apis	
	
	public function instituteregister_post(){
		
		$mobile = $this->input->post("phone");
		$otp = random_string('alnum', 4);
		$data = array(
			"institute_name" => $this->input->post("institute_name"),
			"full_name" => $this->input->post("fullname"),
			"designation" => $this->input->post("designation"),
			"email" => $this->input->post("email"),
			"phone" => $this->input->post("phone"),
			"OTP" => $otp,
			"address" => $this->input->post("address"),
			"password" => $this->institute_login_model->api_key_crypt( $this->input->post("password"),'e')
		);/*print_r($data);
		 exit;*/
		$check_phone = $this->institute_model->check_phone($data['phone']);
		$check_email = $this->institute_model->check_email($data['email']);
			
		if($check_email){
			if($check_phone){
				$this->db->insert("tbl_institutes",$data);
				$insert_id = $this->db->insert_id();				
				$arr = array("Video Gallery","Photo Gallery","Programee Fees","Placements","Achivements","Admission");
				$set = array("Video","photo","pogram","placements","achivements","admissions");
				foreach($arr as $k=>$ar){
					$res_header = array(
					"institute_id" => $insert_id,
					"menu_title" =>	$ar,
					"link" => "#",
                    "short_name" => $set[$k]					
					);
					$q1 = $this->db->insert("tbl_menu_header",$res_header);
				}
			}else{
				$data1=["Status"=>false,"Message"=>'Mobile number : '.$data['phone'].' already exist.'];
			 	echo json_encode($data1);
			 	exit();
			}
		}else{
			$data1=["Status"=>false,"Message"=>'Email : '.$data['email'].' already exist.'];
			echo json_encode($data1);
			exit();
		}

		if($insert_id){
			$msg = "KAB Education institute registration verification OTP is : ".$otp;
			
			$this->login_model->sendSMS($mobile,$msg);
			//redirect("institute/verifyOTP");
			$data1=["Status"=>true,"Message"=>"OTP sent to your mobile ."];
			echo json_encode($data1);
			exit();
		}else{
			$data1=["Status"=>false,"Message"=>'Error Occured'];
			echo json_encode($data1);
			exit();
		}

		
	}
	
	public function otp_verify_institute_post(){
		$phone = $this->input->post("mobile");
		$otp = $this->input->post("otp");
		$mdate = date("Y-m-d H:i:s");
		$chkphone = $this->institute_model->check_otp($phone);
		
		if($chkphone){
			if($chkphone->OTP == $otp){
				$query = $this->db->where("phone",$phone)->update("tbl_institutes",array('status' =>'Active','modified' =>$mdate ));
				if($query){

					$data1=["Status"=>true,"Message"=>"Institute Registered Successfully."];
					echo json_encode($data1);

					$msg = '<html><body>Dear '.$inst_name.',Thanks for registering with us,please find below are the loign link and details.<br>Link : <a href="'.base_url().'institute/registration">Click Here</a><br>User ID : '.$chkphone->email.'<br>Password : '.$this->institute_login_model->api_key_crypt( $chkphone->password,"d").'<br>Admin,kabconsultants</body></html>';
					$from = "noreply@kabconsultants.com";
					$subject = "Login Details : KAB Education Fair";
					$to = $chkphone->email;

					$this->login_model->sendMail($from,$to,$subject,$msg);

				}
			}else{
				$data1=["Status"=>false,"Message"=>"Please Enter correct OTP."];
				echo json_encode($data1);
			}
		}else{
			$data1=["Status"=>false,"Message"=>"Mobile number is not registered."];
			echo json_encode($data1);
		}	
		
	}

	public function institute_login_post(){
		
		$email = $this->input->post("email");
		$password = $this->input->post("password");
		
		$data = $this->institute_login_model->login($email,$password);
		//print_r($this->session->userdata()); exit;
		if($data['status']){
			if($data['type']==='institute'){
				
				$userdata = $this->db->get_where("tbl_institutes",["email"=>$email])->row();
				$data1=["Status"=>true,"Message"=>"Successfully loggedin.","user_data"=>$userdata];
				echo json_encode($data1);
			}

		}else{
			$data1=["Status"=>false,"Message"=>"Please check login credentials."];
			 echo json_encode($data1);
		}
		
	}
	
}