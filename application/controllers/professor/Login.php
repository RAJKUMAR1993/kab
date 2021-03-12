<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');

class Login extends CI_Controller {
	 public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
		$this->admin_email = $this->login_model->get_option("admin_email_id")->email;
      
    }

    public function index()
	{
	
		$this->load->view('professor/login/login');
	}

	public function do_login(){
		//echo $this->professor_login_model->api_key_crypt($this->input->post("password"),'d');exit;
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
			
			$data = $this->professor_login_model->login($email,$password);
			//print_r($this->session->userdata()); exit;
			if($data['status']){
				if($data['type']==='professor'){
					$data1=["Status"=>'Active',"Message"=>"Successfully loggedin."];
					echo json_encode($data1);
					//redirect("expert/dashboard");
				}

			}else{
				$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">Please check login details!</div>');
				$data1=["Status"=>'InActive',"Message"=>"Please check login credentials."];
				 echo json_encode($data1);
				//redirect('expert/login');
			}
		}
	}

	public function logout(){

		$this->session->sess_destroy();
		redirect("professor/login");
	}

	public function forgot(){
		$this->load->view('professor/login/forgot_password');
	}
	

	public function reset_password(){
		$email = $this->input->post("email");
		$check = $this->db->where("pro_email",$email)->where("is_deleted",'0')->where("pro_status",'Active')->get("tbl_professors")->num_rows();
		if($check > 0){
			$data['password']=$this->professor_login_model->api_key_crypt(random_string('alnum', 8),"e");
			$this->db->where("pro_email",$email)->update("tbl_professors",array('password'=>$data['password']));
			$this->session->set_flashdata('msg',' <div class="alert alert-success" role="alert">Please check your email for login details.</div>');
			$msg = '<html><body><small>User ID : '.$email.'</small><br> <small>Password : '.$this->professor_login_model->api_key_crypt( $data["password"],"d").'</small></body></html>';
				$from = "$this->admin_email";
			$subject = "Login Details : KAB Education Fair";
			$to = $email;
			$this->login_model->sendMail($from,$to,$subject,$msg);
			$data1=["Status"=>'Active',"Message"=>"Please check your email for login details."];
				echo json_encode($data1);
			
			//redirect("expert/login");		
		}else{
			$this->session->set_flashdata('msg',' <div class="alert alert-danger" role="alert">Data not found.</div>');
			//redirect("expert/login/forgot");	
			$data1=["Status"=>'InActive',"Message"=>"Email not found"];
			 echo json_encode($data1);	
			 exit();
		}	
	}

	

}