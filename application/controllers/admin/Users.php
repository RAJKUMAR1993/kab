<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');

class Users extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        if($this->session->userdata['login_type']!='admin'){redirect('admin');}
        $this->load->library('form_validation');
		
		$this->admin_email = $this->login_model->get_option("admin_email_id")->email;
    }

	public function index()
	{
		$data['users'] = $this->db->order_by("user_name ","asc")->get("tbl_users")->result();
		$data['subview'] = "users/users";
		$this->load->view('admin/theme',$data);
	}
	
	public function add(){
		$user_id = $this->uri->segment(4);
		if($user_id){
			$user = $this->db->where("id",$user_id)->get("tbl_users")->row();
			$data['user'] = $user;
		}else{
			$data['user'] = "";
		}
		$data['subview'] = "users/add_user";
		$data['adminmenu'] = $this->db->get("tbl_admin_menu")->result();
		$this->load->view('admin/theme',$data);
	}
	

	public function save_user(){
        $this->form_validation->set_rules('user_name', 'User Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('mobile_no', 'Mobile Number', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        if ($this->form_validation->run() == FALSE) {
		    $data1=["Status"=>'InActive',"Message"=>validation_errors()];
		 	echo json_encode($data1);
		 	exit();
		} 
		else {
			$user_id = $this->input->post("user_id");
			$email = $this->input->post("email");
			$checkemail = $this->db->select("*")->where("email", $email);
			if($user_id){
				$checkemail = $checkemail->where("id!=", $user_id);
			}
			$checkemail = $checkemail->get("tbl_users")->num_rows();
			if($checkemail==0){
				$adminmenu = $this->input->post("menustatus");
				$selectedmenu = array();
				if(count($adminmenu)>0){
					foreach ($adminmenu as $slug => $v) {
						$selectedmenu[] = $slug;
					}
				}
				$data = array(
					"user_name" => $this->input->post("user_name"),
					"email" => $email,
					"mobile_no" => $this->input->post("mobile_no"),
					"status" => $this->input->post("status"),
					"password" => $this->login_model->api_key_crypt( $this->input->post("password"),'e'),
					"menu_permissions" => implode(',', $selectedmenu)
				);
				if($user_id){
					$this->db->where("id",$user_id)->update("tbl_users",$data); 
					$data1 = ["Status"=>'Active',"Message"=>"User Updated Successfully."];
				}else{
					$query = $this->db->insert("tbl_users", $data);
					$data1=["Status"=>'Active',"Message"=>"User Added Successfully."];
				}
				$old_password = $this->input->post("old_password");

				if($data['password']!=$old_password){
					$msg = '<html><body>Your password has been updated, please login with below details. <br><small>User ID : '.$data["email"].'</small><br> <small>Password : '.$this->login_model->api_key_crypt($data["password"],"d").'</small><br><a href="'.base_url().'user/login">Click Here to Login</a></body></html>';
					$from = "$this->admin_email";
					$subject = "Login Details : KAB Education Fair";
					$to = $data['email'];
					$re = $this->login_model->sendMail($from,$to,$subject,$msg);
				}
			}
			else{
				$data1 = ["Status"=>'Inactive',"Message"=>"Email already exists."];
			}
			echo json_encode($data1);
			exit();
		}	
	}

	public function delete_user(){
		if($this->uri->segment(4)){
			$id =$this->uri->segment(4);
			$query = $this->db->where("id",$id)->delete("tbl_users");
			if($query){ redirect("admin/users");}
		}
	}

}
