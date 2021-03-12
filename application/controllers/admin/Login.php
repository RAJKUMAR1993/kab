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
	
		$this->load->view('admin/login/new_login');
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
			
			$data = $this->login_model->login($email,$password);
			//print_r($this->session->userdata()); exit;
			if($data['status']){
				if($data['type']==='admin'){
					//redirect("admin/dashboard");
					$data1=["Status"=>'Active',"Message"=>"Successfully loggedin."];
					echo json_encode($data1);
				}

			}else{
				$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">Please check login details!</div>');
				//redirect("admin");
				$data1=["Status"=>'InActive',"Message"=>"Please check login credentials."];
				 echo json_encode($data1);
			}
		}
	}

	public function logout(){
		/*$this->session->unset_userdata(array('admin_name','admin_id','admin_email','logged_in','client_id','client_name','client_email'));*/
		$this->session->sess_destroy();
		redirect("admin");
	}

	public function forgot(){
		$this->load->view('admin/login/new_forgot_password');
	}

	public function reset_password(){
		$email = $this->input->post("email");
		$check = $this->db->where("email",$email)->get("tbl_admin")->num_rows();
		if ($check > 0) {
			$data['password']=$this->login_model->api_key_crypt(random_string('alnum', 8),"e");
			$this->db->where("email",$email)->update("tbl_admin",array('password'=>$data['password']));
			$msg = '<html><body><small>User ID : '.$email.'</small><br> <small>Password : '.$this->login_model->api_key_crypt( $data["password"],"d").'</small></body></html>';
				//$msg = $this->load->view("admin/email_templates/password_update",$data,true);
				$from = "$this->admin_email";
				$subject = "Login Details : KAB Education Fair";
				$to = $email;

				

			$this->session->set_flashdata('msg',' <div class="alert alert-success" role="alert">Please check your email for login details.</div>');
			$re = $this->login_model->sendMail($from,$to,$subject,$msg);
			//redirect("admin");
			$data1=["Status"=>'Active',"Message"=>"Please check your email for login details."];
				echo json_encode($data1);
				exit();		
		}else{
			$this->session->set_flashdata('msg',' <div class="alert alert-danger" role="alert">Data not found.</div>');
			//redirect("admin/login/forgot");
			$data1=["Status"=>'InActive',"Message"=>"Email not found"];
			 echo json_encode($data1);	
			 exit();	
		}	
	}

	

}
