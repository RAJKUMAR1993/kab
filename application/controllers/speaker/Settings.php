<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');

class Settings extends CI_Controller {
	public function __construct()
	    {
	        parent::__construct();
	        if($this->session->userdata['login_type']!='speaker'){redirect('speaker/login');}
			$this->admin_email = $this->login_model->get_option("admin_email_id")->email;
	    }


	public function basic()
	{

		$data["speaker"] = $this->db->where("speaker_id",$this->session->userdata('speaker_id'))->get("tbl_speakers")->row();
		$data['subview'] ="settings/basic_details";
		$this->load->view('speaker/theme',$data);
	}

	public function update(){
		$id = $this->session->userdata('speaker_id');
		//$photo = $this->input->post('photo');

			if($_FILES['photo']){
						$config['upload_path'] = 'assets/speakers/'; # check path is correct
						$config['max_size'] = '0';
						$config['allowed_types'] = 'jpeg|jpg|png'; # add video extenstion on here
						$config['overwrite'] = FALSE;
						$config['remove_spaces'] = TRUE;
						$logo_name = random_string('numeric', 5);
						$config['file_name'] = $logo_name;

						$this->load->library('upload', $config);
						$this->upload->initialize($config);

					if ($this->upload->do_upload('photo')) # form input field attribute
					{
					    $upload_data = $this->upload->data();
					    $image = $config['upload_path'].$upload_data['file_name'];
					    $file_ext = $upload_data['file_type'];
					}else{
						$image = $this->input->post('photo_logo');
					}
			}
			

		$data = array(

			"speaker_name" => $this->input->post("full_name"),
			//"speaker_fname" => $this->input->post("fname"),
			//"speaker_lname" => $this->input->post("lname"),
			"speaker_mailingaddress" => $this->input->post("mailingaddress"),
			"speaker_designation" => $this->input->post("designation"),
			"speaker_qualification" => $this->input->post("qualification"),
			"speaker_curorg" => $this->input->post("curorg"),
			"speaker_tworkexp" => $this->input->post("tworkexp"),
			"speaker_expertise" => $this->input->post("expertise"),
			"speaker_spokenlang" => $this->input->post("spokenlang"),
			"speaker_awards" => $this->input->post("awards"),
			"speaker_targetgroup" => $this->input->post("targetgroup"),
			"speaker_shortdesc" => $this->input->post("shortdesc"),
			"speaker_longdesc" => $this->input->post("longdesc"),
			"speaker_gender" => $this->input->post("gender"),
			"speaker_tcost" => $this->input->post("tcost"),
			"speaker_scost" => $this->input->post("scost"),
			"speaker_type" => $this->input->post("type"),
			"speaker_email" => $this->input->post("email"),
			"password" => $this->speaker_login_model->api_key_crypt($this->input->post("password"),'e'),
			"speaker_mobile" => $this->input->post("phone"),
			"speaker_mobile2" => $this->input->post("phone2"),
			"speaker_status" => $this->input->post("status"),
			"speaker_expparti" => $this->input->post("expparti"),
			"speaker_linkedinprofie" => $this->input->post("linkedinprofie"),
			"speaker_youtube" => $this->input->post("youtube"),
			"speaker_facebook" => $this->input->post("speaker_facebook"),
			"speaker_twitter" => $this->input->post("speaker_twitter"),
			"speaker_instagram" => $this->input->post("speaker_instagram"),
			"speaker_photo" => $image,
			"institute_id"	=>$this->input->post('institute_id')
			
		);
		$old_password = $this->input->post("old_password");
		
		if($data['password']!=$old_password){

				$msg = $msg = '<html><body><small>User ID : '.$data['speaker_email'].'</small><br> <small>Password : '.$this->speaker_login_model->api_key_crypt( $data["password"],"d").'</small></body></html>';
				
				$from = "$this->admin_email";
				$subject = "Login Details : KAB Education Fair";
				$to = $data['speaker_email'];
				$re = $this->login_model->sendMail($from,$to,$subject,$msg);
		}
		$this->db->where("speaker_id",$id)->update("tbl_speakers",$data); 
			$this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">Details has updated successfully.</div>');
			//redirect("speaker/settings/basic");
			$data1=["Status"=>'Active',"Message"=>"Details has updated successfully."];
				echo json_encode($data1);
	}
    function changepassword(){
		$data["admin"] = $this->db->where("speaker_id",$this->session->userdata('speaker_id'))->get("tbl_speakers")->row();
		$data['subview'] ="settings/changepassword";
		$this->load->view('speaker/theme',$data);
	}
	function update_password(){
		$id = $this->session->userdata('speaker_id');
		$email = $this->session->userdata('speaker_email');
		$data = array(
			"password" => $this->speaker_login_model->api_key_crypt($this->input->post("password"),'e')
		);
		$old_password = $this->input->post("old_password");
		
		if($data['password']!=$old_password){

				$msg = '<html><body><small>User ID : '.$email.'</small><br> <small>Password : '.$this->speaker_login_model->api_key_crypt( $data["password"],"d").'</small></body></html>';
				
				$from = "$this->admin_email";
				$subject = "Login Details : KAB Education Fair";
				$to = $data['email'];
				$re = $this->login_model->sendMail($from,$to,$subject,$msg);
		}
		$this->db->where("speaker_id",$id)->update("tbl_speakers",$data);
		$this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">Details has updated successfully.</div>');
			//redirect("institute/settings/basic");
			$data=["Status"=>'Active',"Message"=>"Details has updated successfully."];
			echo json_encode($data);
	}
	
}
