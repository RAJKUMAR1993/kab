<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');

class Settings extends CI_Controller {
	public function __construct()
	    {
	        parent::__construct();
	        if($this->session->userdata['login_type']!='professor'){redirect('professor/login');}
			$this->admin_email = $this->login_model->get_option("admin_email_id")->email;
	    }


	public function basic()
	{

		$data["professor"] = $this->db->where("pro_id",$this->session->userdata('pro_id'))->get("tbl_professors")->row();
		$data['subview'] ="settings/basic_details";
		$this->load->view('professor/theme',$data);
	}

	public function update(){
		
		$id = $this->session->userdata('pro_id');

        if($_FILES['picture']['name'] != ""){
			    $config['upload_path'] = 'assets/images/professors';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['picture']['name'];				 
				
				$this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('picture')){
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                }else{
                    $picture = '';
                }
		}else{
			$picture = $this->input->post("image");
		}
		
		
		$data = $this->input->post();
		$old_password = $this->input->post("old_password");
		
		if($data['cpassword']!=$old_password){

				$msg = $msg = '<html><body><small>User ID : '.$data['pro_email'].'</small><br> <small>Password : '.$this->professor_login_model->api_key_crypt( $data["cpassword"],"d").'</small></body></html>';
				
				$from = "$this->admin_email";
				$subject = "Login Details : KAB Education Fair";
				$to = $data['pro_email'];
				$re = $this->login_model->sendMail($from,$to,$subject,$msg);
		}
		
		/*$data = array(

			"pro_name" => $this->input->post("name"),
			"pro_designation" => $this->input->post("designation"),
			"pro_quali" => $this->input->post("qualification"),
			"pro_shortdesc" => $this->input->post("shortdesc"),
			"pro_languages" => $this->input->post("lang"),
			"pro_email" => $this->input->post("email"),
			"password" => $this->professor_login_model->api_key_crypt($this->input->post("password"),'e'),
			"pro_status" => $this->input->post("status"),
			"pro_image" => $picture,
			"pro_specalities" => $this->input->post("spec"),
			"institute_id"	=>$this->input->post('institute_id')
			
		);*/
		$data["pro_languages"] = $this->input->post("lang");
		//$data["pro_languages"] = implode(",",$this->input->post("lang"));
		$data["password"] = $this->professor_login_model->api_key_crypt($this->input->post("cpassword"),'e');
		$data["pro_image"] = $picture;
//		$data["pro_name"] = $this->input->post("fname")." ".$this->input->post("lname");
		
		unset($data["cpassword"]);
		unset($data["lang"]);
		unset($data["image"]);
		unset($data["old_password"]);
		
		$this->db->where("pro_id",$id)->update("tbl_professors",$data); 
			$this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">Details has updated successfully.</div>');
			//redirect("expert/settings/basic");
			$data1=["Status"=>'Active',"Message"=>"Details has updated successfully."];
				echo json_encode($data1);
	}
    function changepassword(){
		$data["admin"] = $this->db->where("pro_id",$this->session->userdata('pro_id'))->get("tbl_professors")->row();
		//print_r($data);exit;
		$data['subview'] ="settings/changepassword";
		$this->load->view('professor/theme',$data);
	}
	function update_password(){
		$id = $this->session->userdata('pro_id');
		$email = $this->session->userdata('pro_email');
		$data = array(
			"password" => $this->professor_login_model->api_key_crypt($this->input->post("password"),'e')
		);
		$old_password = $this->input->post("old_password");
		
		if($data['password']!=$old_password){

				$msg = '<html><body><small>User ID : '.$email.'</small><br> <small>Password : '.$this->professor_login_model->api_key_crypt( $data["password"],"d").'</small></body></html>';
				
				$from = "$this->admin_email";
				$subject = "Login Details : KAB Education Fair";
				$to = $data['email'];
				$re = $this->login_model->sendMail($from,$to,$subject,$msg);
		}
		
		$this->db->where("pro_id",$id)->update("tbl_professors",$data);
		$this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">Details has updated successfully.</div>');
			//redirect("institute/settings/basic");
			$data=["Status"=>'Active',"Message"=>"Details has updated successfully."];
			echo json_encode($data);
	}
	
}
