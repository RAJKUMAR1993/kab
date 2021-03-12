<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');

class Professors extends CI_Controller {
	public function __construct()
	    {
	        parent::__construct();
	        //$this->load->library('excel');
	        if($this->session->userdata['login_type']!='institute'){redirect('institute/login');}
			$this->admin_email = $this->login_model->get_option("admin_email_id")->email;
	    }

	public function index()
	{
		$institute_id =$this->session->userdata['institute_id'];
		$type =$this->session->userdata['login_type'];
		$data['professors'] = $this->db->order_by("pro_id ","desc")->where("institute_id",$institute_id)->where("login_type",$type)->get("tbl_professors")->result();
		$data['subview'] = "professors/professors";
		$this->load->view('institute/theme',$data);
	}
	
	public function add(){
		if($this->uri->segment(4)){
			$data['professors'] = $this->db->where("pro_id",$this->uri->segment(4))->get("tbl_professors")->row();
		}else{
			$data['professors'] = "";
		}

		$data['subview'] = "professors/add_pro";
		$this->load->view('institute/theme',$data);
	}
	


	public function save_pro(){

		$data = array(
			"pro_name" => $this->input->post("name"),
			"pro_designation" => $this->input->post("designation"),
			"pro_quali" => $this->input->post("qualification"),
			"pro_shortdesc" => $this->input->post("shortdesc"),
			"pro_email" => $this->input->post("email"),
			"institute_id"	=>$this->session->userdata['institute_id'],
			"login_type" => $this->session->userdata['login_type']
		);

		if($this->uri->segment(4)){
			$data['password'] = $this->institute_login_model->api_key_crypt( $this->input->post("password"),'e');
			$old_password = $this->input->post("old_password");

			if($data['password']!=$old_password){

				$msg = '<html><body>Your password has been updated, please login with below details. <br><small>User ID : '.$data["pro_email"].'</small><br> <small>Password : '.$this->institute_login_model->api_key_crypt($data["password"],"d").'</small></body></html>';
				$from = "$this->admin_email";
				$subject = "Login Details : KAB Education Fair";
				$to = $data['pro_email'];
				$re = $this->login_model->sendMail($from,$to,$subject,$msg);
			}
			$this->db->where("pro_id",$this->input->post("pro_id"))->update("tbl_professors",$data); 
			//redirect("institute/experts");
			$data1=["Status"=>'Active',"Message"=>"Successfully Updated."];
				echo json_encode($data1);
				exit();
		}else{
			$data['password'] = $this->institute_login_model->api_key_crypt(random_string('alnum', 8),"e");
			$check = $this->db->where("pro_email",$email)->get("tbl_professors")->num_rows();
			if($check >0){
				$check_email = false;
			}else{
				$check_email = TRUE;
			}
			
			if($check_email){
				$query = $this->db->insert("tbl_professors",$data);
			}else{
				$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">Professor email already exist.!</div>');
				
				$data1=["Status"=>'InActive',"Message"=>"Professor email already exist."];
			 	echo json_encode($data1);
			 	exit();
			}
			}
			if($query){ 
				$msg = '<html><body><small>User ID : '.$data["pro_email"].'</small><br> <small>Password : '.$this->institute_login_model->api_key_crypt( $data["password"],"d").'</small></body></html>';
				$from = "$this->admin_email";
				$subject = "Login Details : KAB Education Fair";
				$to = $data['pro_email'];
				$re = $this->login_model->sendMail($from,$to,$subject,$msg);

				$data1=["Status"=>'Active',"Message"=>"Successfully Inserted."];
				echo json_encode($data1);
				exit();
			}
			
		}	

	public function delete_pro(){
		if($this->uri->segment(4)){
			$id =$this->uri->segment(4);
			$query = $this->db->where("pro_id",$id)->delete("tbl_professors");
			if($query){ redirect("institute/professors");}
		}
	}


}
