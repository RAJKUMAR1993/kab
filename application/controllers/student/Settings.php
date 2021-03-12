<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');

class Settings extends CI_Controller {
	public function __construct()
	    {
	        parent::__construct();
	        if($this->session->userdata['login_type']!='student'){redirect('student/login');}
			$this->admin_email = $this->login_model->get_option("admin_email_id")->email;
	    }


	public function basic()
	{
        $student_id = $this->session->userdata("student_id");
		$data["admin"] = $this->db->where("student_id",$this->session->userdata('student_id'))->get("tbl_students")->row();
		$data['entrance_list'] = $this->db->where(array("student_id"=>$student_id,"deleted"=>0))->get("tbl_entrance_exams")->result();
		$data['eexams'] = $this->db->get("tbl_input_eexam")->result();
		$data["years"] = $this->db->order_by('year',"DESC")->get("tbl_input_ypassing")->result();
		$data['student'] = $this->db->where("student_id",$student_id)->get("tbl_academics")->row();
		$data["sscboard"] = $this->db->get("tbl_input_sscboard")->result();
		$data["states"] = $this->db->group_by("State")->get("states")->result();
		$data["districts"] = $this->db->order_by("District","ASC")->get("states")->result();
		$data["interboard"] = $this->db->get("com_input_plusboard")->result();
		$data["intercourse"] = $this->db->get("com_input_pluscourse")->result();
		$data["intergroup"] = $this->db->get("com_input_plusgroup")->result();


		$data["degreecourse"] = $this->db->get("com_input_degreecourse")->result();
		$data["degreegroup"] = $this->db->get("com_input_degreespec")->result();
		$data["auniversity"] = $this->db->order_by("university","ASC")->get("com_affliated_universities")->result();
		$data["studentdocs"] = $this->db->where("student_id", $student_id)->get("tbl_student_certificates")->result();
		//echo '<pre>';print_r($data['student']);exit;
		$data['subview'] ="settings/basic_details";
		$this->load->view('student/theme',$data);
	}

	public function update(){
		$id = $this->session->userdata('student_id');
		//$logo = $this->input->post('logo');

			/*if($_FILES['logo']){
						$config['upload_path'] = 'assets/students/'; # check path is correct
						$config['max_size'] = '0';
						$config['allowed_types'] = 'jpeg|jpg|png'; # add video extenstion on here
						$config['overwrite'] = FALSE;
						$config['remove_spaces'] = TRUE;
						$logo_name = random_string('numeric', 5);
						$config['file_name'] = $logo_name;

						$this->load->library('upload', $config);
						$this->upload->initialize($config);

					if ($this->upload->do_upload('logo')) # form input field attribute
					{
					    $upload_data = $this->upload->data();
					    $image = $config['upload_path'].$upload_data['file_name'];
					    $file_ext = $upload_data['file_type'];
					}else{
						$image = $this->input->post('old_logo');
					}
			}*/
			

		$data = array(
			"student_name" =>$this->input->post("name"),
			"email"=>$this->input->post("email"),
			"phone" =>$this->input->post("mobile"),
			"password" => $this->student_login_model->api_key_crypt($this->input->post("password"),'e'),
			"address" =>$this->input->post("address")/*,
			"logo" => $image*/
		);
		$old_password = $this->input->post("old_password");
		
		if($data['password']!=$old_password){

				$msg = $msg = '<html><body><small>User ID : '.$email.'</small><br> <small>Password : '.$this->student_login_model->api_key_crypt( $data["password"],"d").'</small></body></html>';
				
				$from = "$this->admin_email";
				$subject = "Login Details : KAB Education Fair";
				$to = $data['email'];
				$re = $this->login_model->sendMail($from,$to,$subject,$msg);
		}
		$this->db->where("student_id",$id)->update("tbl_students",$data); 
			$this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">Details has updated successfully.</div>');
			redirect("student/settings/basic");
	}

	public function check_name(){
		$name = $this->input->post('name');
		$name =  str_replace(array("\n","\t",' '),'', $name);
		$check = $this->db->where("is_deleted","0")->where('profile_name',$name)->get("tbl_students")->num_rows();
		if($check > 0){
			echo "Not available";
		}else{
			echo "Available";
		}
	}

	/*public function login_history(){

		$data["logins"] = $this->db->order_by('date_time','DESC')->get("tbl_login_history")->result();
		$data['subview'] ="settings/login_history";
		$this->load->view('admin/theme',$data);
	}
	

	public function backup(){
		$data['subview'] ="settings/sql_backup";
		$this->load->view('admin/theme',$data);
	}
	public function db_backup(){
       date_default_timezone_set('Asia/Calcutta');
      // Load the DB utility class 
      $this->load->dbutil(); 
      $prefs = array( 'format' => 'zip', // gzip, zip, txt 
                               'filename' => 'backup_'.date('d_m_Y_H_i_s').'.sql', 
                                                      // File name - NEEDED ONLY WITH ZIP FILES 
                               'add_drop' => TRUE,
                                                     // Whether to add DROP TABLE statements to backup file
                               'add_insert'=> TRUE,
                                                    // Whether to add INSERT data to backup file 
                               'newline' => "\n"
                                                   // Newline character used in backup file 
                              ); 
         // Backup your entire database and assign it to a variable 
         $backup =& $this->dbutil->backup($prefs); 
         // Load the file helper and write the file to your server 
         $this->load->helper('file'); 
         write_file('/path/to/'.'dbbackup_'.date('d_m_Y_H_i_s').'.zip', $backup); 
         // Load the download helper and send the file to your desktop 
         $this->load->helper('download'); 
         force_download('dbbackup_'.date('d_m_Y_H_i_s').'.zip', $backup);
	}
*/  
        public function entrance_insert(){
			$exam_id = $this->input->post("exam_id");
			$data = array(
				"student_id" => $this->session->userdata("student_id"),
				"exam_name" => $this->input->post("exam_name"),
				"year_appeared" => $this->input->post("year_appeared"),
				"hallticket" => $this->input->post("hallticket"),
				"max_marks" => $this->input->post("max_marks"),
				"secured_marks" => $this->input->post("secured_marks"),
				"rank" => $this->input->post("rank")
			);

			if($exam_id){
				$query = $this->db->where("id",$exam_id)->update("tbl_entrance_exams",$data); 
			}
			else{
				$query = $this->db->insert("tbl_entrance_exams",$data);	
			}	
			if($query){			
				$this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">Details has updated successfully.</div>');
				redirect("student/settings/basic");
				
			}else{			
				$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">Error Occured Please Try Again.</div>');
				redirect("student/settings/basic");
				
			}
		
	}
    public function udateotherdetails(){
		$student_id = $this->session->userdata("student_id");
		$this->load->library('upload');
		//print_r($this->input->post()); exit();
		$cdata = $this->db->get_where("tbl_students",array("student_id"=>$student_id))->row();
		
		if($_FILES['image']['size']!='0'){
			
			   $config["upload_path"] = 'uploads/students/';
			   $config["allowed_types"] = 'png|jpg|jpeg';
			   $config['file_name'] = $cdata->student_name.$cdata->phone;
			   $config['overwrite'] = TRUE;
			   $this->upload->initialize($config);
					
			   $this->upload->do_upload("image");
			   $d = $this->upload->data();
			   $image = "uploads/students/".$d["file_name"];
			
		}else{

			 $image = $cdata->image;  
		}
		

		if($_FILES['sign']['size']!='0'){
			
			   $config1["upload_path"] = 'uploads/students/';
			   $config1["allowed_types"] = 'png|jpg|jpeg';
			   $config1['file_name'] = $cdata->student_name."sign";
			   $config1['overwrite'] = true;
			   $this->upload->initialize($config1);
					
			   $this->upload->do_upload("sign");
			   $s = $this->upload->data();
			   $sign = "uploads/students/".$s["file_name"];
			//print_r($s); exit();
		}else{

			 $sign = $cdata->signature;  
		}

		//$data = $this->input->post();
		$data['image'] = $image;
		$data['signature'] = $sign;
		$data['person_disability_check'] = $this->input->post('disability');
		$data['disability_name'] = $this->input->post('disability_name');
		$this->db->set($data);
		$this->db->where("student_id",$student_id);
		$query = $this->db->update("tbl_students"); 
		
		if($query){
			
			$this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">Details has updated successfully.</div>');
			redirect("student/settings/basic");
			
		}else{			
			$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">Error Occured Please Try Again.</div>');
			redirect("student/settings/basic");
			
		}

	}
	public function updatessc(){
		
		$student_id = $this->session->userdata("student_id");
		//print_r($this->input->post()); exit();
		$cdata = $this->db->get_where("tbl_students",array("student_id"=>$student_id))->row();
		
		if($_FILES['image']['size']!='0'){
			
			   $config["upload_path"] = 'uploads/students/';
			   $config["allowed_types"] = 'png|jpg|jpeg';
			   $config['file_name'] = $cdata->student_name.$cdata->phone;
			   $config['overwrite'] = TRUE;
			   $this->load->library('upload', $config);
					
			   $this->upload->do_upload("image");
			   $d = $this->upload->data();
			   $image = "uploads/students/".$d["file_name"];
			
		}else{

			 $image = $cdata->image;  
		}
		
		$data = $this->input->post();
		$data['image'] = $image;
		
		$academics = $this->db->where("student_id",$student_id)->get("tbl_academics")->num_rows();
		if($academics==0){
            $query2 = $this->db->insert("tbl_academics",array("student_id"=>$student_id));
		}
		$this->db->set($data);
		$this->db->where("student_id",$student_id);
		$query = $this->db->update("tbl_academics"); 
		
		if($query){
			
			$this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">Details has updated successfully.</div>');
			redirect("student/settings/basic");
			
		}else{			
			$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">Error Occured Please Try Again.</div>');
			redirect("student/settings/basic");
			
		}
		
	}
	public function updateinter(){
		
		$student_id = $this->session->userdata("student_id");
		//print_r($this->input->post()); exit();
		$cdata = $this->db->get_where("tbl_students",array("student_id"=>$student_id))->row();
		
		if($_FILES['image']['size']!='0'){
			
			   $config["upload_path"] = 'uploads/students/';
			   $config["allowed_types"] = 'png|jpg|jpeg';
			   $config['file_name'] = $cdata->student_name.$cdata->phone;
			   $config['overwrite'] = TRUE;
			   $this->load->library('upload', $config);
					
			   $this->upload->do_upload("image");
			   $d = $this->upload->data();
			   $image = "uploads/students/".$d["file_name"];
			
		}else{

			 $image = $cdata->image;  
		}
		
		$data = $this->input->post();
		$data['image'] = $image;
		
		$this->db->set($data);
		$this->db->where("student_id",$student_id);
		$query = $this->db->update("tbl_academics"); 
		
		if($query){
			
			$this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">Details has updated successfully.</div>');
			redirect("student/settings/basic");
			
		}else{			
			$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">Error Occured Please Try Again.</div>');
			redirect("student/settings/basic");
			
		}
		
	}
	public function updatedegree(){
		
		$student_id = $this->session->userdata("student_id");
		//print_r($this->input->post()); exit();
		$cdata = $this->db->get_where("tbl_students",array("student_id"=>$student_id))->row();
		
		if($_FILES['image']['size']!='0'){
			
			   $config["upload_path"] = 'uploads/students/';
			   $config["allowed_types"] = 'png|jpg|jpeg';
			   $config['file_name'] = $cdata->student_name.$cdata->phone;
			   $config['overwrite'] = TRUE;
			   $this->load->library('upload', $config);
					
			   $this->upload->do_upload("image");
			   $d = $this->upload->data();
			   $image = "uploads/students/".$d["file_name"];
			
		}else{

			 $image = $cdata->image;  
		}
		
		$data = $this->input->post();
		$data['image'] = $image;
		
		$this->db->set($data);
		$this->db->where("student_id",$student_id);
		$query = $this->db->update("tbl_academics"); 
		
		if($query){
			
			$this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">Details has updated successfully.</div>');
			redirect("student/settings/basic");
			
		}else{			
			$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">Error Occured Please Try Again.</div>');
			redirect("student/settings/basic");
			
		}
		
	}

	public function getCities(){
		
		$state = $this->input->post("state");
		
		$query = $this->db->get_where("states",["State"=>$state])->result();
		
		foreach($query as $s){
			
			echo '<option value="'.$s->District.'">'.$s->District.'</option>';
			
		}
		
		
	}
	public function uploaddocs(){
		$student_id = $this->session->userdata("student_id");
		$cert_category = $this->input->post("certificate_name");
		$files_count = count($_FILES['files']['name']);
		$this->load->library('upload');
		
		if($files_count>0){
			$added = 0;
			$notadded = 0;
			foreach ($_FILES['files']['name'] as $name => $value) {
				$type = $_FILES['files']['type'][$name];
				if($type=='image/jpeg'){
					$_FILES['file']['name'] = $_FILES['files']['name'][$name];
					$_FILES['file']['type'] = $type;
					$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$name];
					$_FILES['file']['error'] = $_FILES['files']['error'][$name];
					$_FILES['file']['size'] = $_FILES['files']['size'][$name];

					if (!file_exists('path/to/directory')) {
					    mkdir('uploads/students/certificates/'.$student_id, 0777, true);
					}
					$fname = $_FILES['files']['name'][$name];
				   	$config["upload_path"] = 'uploads/students/certificates/'.$student_id.'/';
				   	$config['max_size'] = '0';
				   	$config["allowed_types"] = 'jpeg|jpg';
				   	$config["file_name"] = $fname;
				   	$this->upload->initialize($config);

				   	if($this->upload->do_upload('file')){
	                    $uploadData = $this->upload->data();
	                    $file_name = $uploadData['file_name'];
	                    $fullname = explode('.', $fname);
	                	$data = array(
							"student_id" => $student_id,
							"doc_category" => $cert_category,
							"doc_name" => (isset($fullname[0])) ? $fullname[0] : '',
							"doc_filename" => $file_name
						);
						$query = $this->db->insert("tbl_student_certificates",$data);
						if($query){
							$added++;
						}
	                }
					else{
						$notadded++;
					}
				}
				else{
					$notadded++;
				}
			}
			$msg = '';
			if($added>0){
				$msg .= '<div class="alert alert-success" role="alert">'.$added.' Files has been uploaded.</div>';
			}
			if($notadded>0){
				$msg .= '<div class="alert alert-danger" role="alert">'.$notadded.' Files has been not uploaded.</div>';
			}
			$this->session->set_flashdata('msg',$msg);
			redirect("student/settings/basic");
			
		}else{
			$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">Not found any files to upload.</div>');
			redirect("student/settings/basic");
		}
	}
	public function deleteStudCert(){
		$cert_id = $this->input->post("cert_id");
		$file_name = $this->input->post("file_name");
		$student_id = $this->input->post("student_id");
		if($cert_id){
			if($file_name!=''){
				unlink('uploads/students/certificates/'.$student_id.'/'.$file_name);
			}
			$deleted = $this->db->where("id", $cert_id)->delete("tbl_student_certificates");
			if($deleted){
				echo 'success';
			}
			else{
				echo 'fail';
			}
		}
		else{
			echo 'fail';
		}
	}
	function changepassword(){
		$data["admin"] = $this->db->where("student_id",$this->session->userdata('student_id'))->get("tbl_students")->row();
		$data['subview'] ="settings/changepassword";
		$this->load->view('student/theme',$data);
	}
	function update_password(){
		$id = $this->session->userdata('student_id');
		$email = $this->session->userdata('email');
		$data = array(
			"password" => $this->student_login_model->api_key_crypt($this->input->post("password"),'e')
		);
		$old_password = $this->input->post("old_password");
		
		if($data['password']!=$old_password){

				$msg = '<html><body><small>User ID : '.$email.'</small><br> <small>Password : '.$this->student_login_model->api_key_crypt( $data["password"],"d").'</small></body></html>';
				
				$from = "$this->admin_email";
				$subject = "Login Details : KAB Education Fair";
				$to = $data['email'];
				$re = $this->login_model->sendMail($from,$to,$subject,$msg);
		}
		$this->db->where("student_id",$id)->update("tbl_students",$data);
		$this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">Details has updated successfully.</div>');
			//redirect("institute/settings/basic");
			$data=["Status"=>'Active',"Message"=>"Details has updated successfully."];
			echo json_encode($data);
	}
}
