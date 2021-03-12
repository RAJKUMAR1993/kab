<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');

class Login extends CI_Controller {
	 public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
      	$this->admin_email = $this->login_model->get_option("admin_email_id")->email;
    }

    public function index()
	{
	
		$this->load->view('student/login/new_login');
	}
	
	public function guest_login(){
		
		$data = $this->input->post();
		$data["guest_id"] = rand();
		$this->session->set_userdata($data);
		$data1=["Status"=>'Active',"Message"=>"Successfully loggedin."];
		echo json_encode($data1);
		
	}

	public function do_login(){
		
		$this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == FALSE) {
		    $data1=["Status"=>'InActive',"Message"=>validation_errors()];
		 	echo json_encode($data1);
		 	exit();
		} 
        else{
		
			$email = $this->input->post("email");
			$password = $this->input->post("password");
			
			$data = $this->student_login_model->login($email,$password);
			//print_r($this->session->userdata()); exit;
			if($data['status']){
			if(isset($data['type']) && $data['type']==='student'){
				$student_id = $data['student_id'];
				
				$res = $this->db->where("student_id", $student_id)->get("check_student_logins")->row();
				
				if(!empty($res)){
					if($res->ip == $_SERVER['REMOTE_ADDR']){
						 $this->session->set_userdata('student_log_id', $res->log_id);
					     $data1=["Status"=>'Active',"Message"=>"Successfully loggedin."];
				         echo json_encode($data1);
				    }else{
						 $dt = new DateTime($res->log_date);
						 $from_time = $dt->format('Y-m-d H:i');
						 $to_time = date('Y-m-d H:i');
						 $minutes = $this->getMinutes($from_time,$to_time);
						 
                         /* $time = $dt->format('H:i');
						 $one_time = strtotime($time);
						 $end_time = date("H:i", strtotime('+30 minutes', $one_time));
						 $cur_time = date('H:i');
					     $en = strtotime($end_time);
						 $st = strtotime($cur_time); */
						 
						 if($minutes >= 30){
							 $this->db->where("student_id",$res->student_id)->delete("check_student_logins");
							 $this->db->insert("check_student_logins",array("student_id" => $data['student_id'],"ip" => $_SERVER['REMOTE_ADDR'],"login" => "yes","logout" => "","log_date" => date('Y-m-d H:i:s')));
				
							$insert_id = $this->db->insert_id();				
							$this->session->set_userdata('student_log_id', $insert_id);
							 
							 
							$this->session->unset_userdata("guest_name"); 
							$this->session->unset_userdata("guest_email"); 
							$this->session->unset_userdata("guest_mobile"); 
							$this->session->unset_userdata("guest_id"); 
							
							$data1=["Status"=>'Active',"Message"=>"Successfully loggedin."];
							echo json_encode($data1);
						 }else{
							 $this->session->sess_destroy();
							 $data1=["Status"=>'InActive',"Message"=>"Already Active In Another Device."];
				             echo json_encode($data1);
						 }
						 
					}
					}else{					
						$this->db->insert("check_student_logins",array("student_id" => $data['student_id'],"ip" => $_SERVER['REMOTE_ADDR'],"login" => "yes","logout" => "","log_date" => date('Y-m-d H:i:s')));
					
						$insert_id = $this->db->insert_id();				
						$this->session->set_userdata('student_log_id', $insert_id);
						
						$data1=["Status"=>'Active',"Message"=>"Successfully loggedin."];
						echo json_encode($data1);
					}
					//redirect("student/dashboard");
				}
				else{
	//				$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">Please check login details!</div>');
					$data1=["Status"=>'InActive',"Message"=>"Please check login credentials."];
					 echo json_encode($data1);
					//redirect('student/login');
				}

			}else{
	//			$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">Please check login details!</div>');
				$data1=["Status"=>'InActive',"Message"=>"Please check login credentials."];
				 echo json_encode($data1);
				//redirect('student/login');
			}
		}
	}

	public function logout(){
		$this->db->where("student_id",$this->session->userdata['student_id'])->delete("check_student_logins");
		/*$this->session->unset_userdata(array('admin_name','admin_id','admin_email','logged_in','client_id','client_name','client_email'));*/
		$this->session->sess_destroy();
		//redirect("student/login");
		redirect();
	}

	public function forgot(){
		$this->load->view('student/login/new_forgot_password');
	}
	

	public function reset_password(){
		$email = $this->input->post("email");
		$check = $this->db->where("email",$email)->where('status','Active')->get("tbl_students")->num_rows();
		if($check > 0){
			$data['password']=$this->student_login_model->api_key_crypt(random_string('alnum', 8),"e");
			$this->db->where("email",$email)->update("tbl_students",array('password'=>$data['password']));
			$msg = '<html><body><small>User ID : '.$email.'</small><br> <small>Password : '.$this->student_login_model->api_key_crypt( $data["password"],"d").'</small></body></html>';
				$from = "$this->admin_email";
			$subject = "Login Details : KAB Education Fair";
			$to = $email;
			$res = $this->login_model->sendMail($from,$to,$subject,$msg);
//			$this->session->set_flashdata('msg',' <div class="alert alert-success" role="alert">Please check your email for login details.</div>');
			$data1=["Status"=>'Active',"Message"=>"Please check your email for login details."];
				echo json_encode($data1);
				exit();	
			//redirect("student/login");		
		}else{
//			$this->session->set_flashdata('msg',' <div class="alert alert-danger" role="alert">Data not found.</div>');
			//redirect("student/login/forgot");	
			$data1=["Status"=>'InActive',"Message"=>"Email not found"];
			 echo json_encode($data1);	
			 exit();
		}	
	}
    public function getMinutes($from_time,$to_time){
		
		$start_date = new DateTime($from_time);
		$since_start = $start_date->diff(new DateTime($to_time));
		$minutes = $since_start->days * 24 * 60;
		$minutes += $since_start->h * 60;
		$minutes += $since_start->i;
		return $minutes;
		
	}
	

}
