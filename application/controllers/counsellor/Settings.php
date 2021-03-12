<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');

class Settings extends CI_Controller {
	public function __construct()
	    {
	        parent::__construct();
	        if($this->session->userdata['login_type']!='counsellor'){redirect('counsellor/login');}
			$this->admin_email = $this->login_model->get_option("admin_email_id")->email;
	    }


	public function basic()
	{

		$data["expert"] = $this->db->where("id",$this->session->userdata('expert_id'))->get("tbl_councellors")->row();
		$data['subview'] ="settings/basic_details";
		$this->load->view('counsellor/theme',$data);
	}

	public function update(){
		$id = $this->session->userdata('expert_id');
		
		//$photo = $this->input->post('photo');

			if($_FILES['photo']){
						$config['upload_path'] = 'assets/experts/'; # check path is correct
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
						$image = $this->input->post('old_photo');
					}
			}
			

		$data = array(
			"expert_name" => $this->input->post("expert_name"),
			"expert_mailingaddress" => $this->input->post("mailingaddress"),
			"expert_designation" => $this->input->post("designation"),
			"expert_qualification" => $this->input->post("qualification"),
			"expert_curorg" => $this->input->post("curorg"),
			"expert_tworkexp" => $this->input->post("tworkexp"),
			"expert_expertise" => $this->input->post("expertise"),
			"expert_spokenlang" => $this->input->post("spokenlang"),
			"expert_awards" => $this->input->post("awards"),
			"expert_targetgroup" => $this->input->post("targetgroup"),
			"expert_shortdesc" => $this->input->post("shortdesc"),
			"expert_longdesc" => $this->input->post("longdesc"),
			"expert_gender" => $this->input->post("gender"),
			"expert_tcost" => $this->input->post("tcost"),
			"expert_scost" => $this->input->post("scost"),
			"expert_type" => $this->input->post("type"),
			"expert_email" => $this->input->post("email"),
			"password" => $this->counsellor_login_model->api_key_crypt($this->input->post("password"),'e'),
			"expert_mobile" => $this->input->post("phone"),
			"expert_mobile2" => $this->input->post("phone2"),
			"expert_status" => $this->input->post("status"),
			"expert_expparti" => $this->input->post("expparti"),
			"expert_linkedinprofie" => $this->input->post("linkedinprofie"),
			"expert_youtube" => $this->input->post("youtube"),
			"expert_photo" => $image,
			"institute_id"	=>$this->input->post('institute_id'),
			"expert_department"	=>$this->input->post('department')
			
		);
		$old_password = $this->input->post("old_password");
		
		if($data['password']!=$old_password){

				$msg = $msg = '<html><body><small>User ID : '.$data['expert_email'].'</small><br> <small>Password : '.$this->counsellor_login_model->api_key_crypt( $data["password"],"d").'</small></body></html>';
				
				$from = "$this->admin_email";
				$subject = "Login Details : KAB Education Fair";
				$to = $data['expert_email'];
				$re = $this->login_model->sendMail($from,$to,$subject,$msg);
		}
		$this->db->where("id",$id)->update("tbl_councellors",$data); 
			$this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">Details has updated successfully.</div>');
			//redirect("counsellor/settings/basic");
			$data1=["Status"=>'Active',"Message"=>"Details has updated successfully."];
				echo json_encode($data1);
	}

	
}
