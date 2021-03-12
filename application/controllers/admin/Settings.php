<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');

class Settings extends MY_Controller {

	public function __construct(){
		parent::__construct();
		if($this->session->userdata['login_type']!='admin'){redirect('admin');}

		$this->admin_email = $this->login_model->get_option("admin_email_id")->email;
	}
	
	public function basic()
	{
		$data["admin"] = $this->db->where("id",$this->session->userdata('admin_id'))->get("tbl_admin")->row();
		$data['subview'] ="settings/basic_details";
		$this->load->view('admin/theme',$data);
	}

	public function update(){
		$id = $this->session->userdata('admin_id');
		$adminemail = $this->session->userdata('admin_email');
		
		$this->load->library('upload');

		if($_FILES['logo']){
			$config['upload_path'] = 'assets/images/'; # check path is correct
			$config['allowed_types'] = 'jpeg|jpg|png'; # add video extenstion on here
			$config['remove_spaces'] = TRUE;

			$this->upload->initialize($config);

			if ($this->upload->do_upload('logo')) # form input field attribute
			{
				$upload_data = $this->upload->data();
				$image = $config['upload_path'].$upload_data['file_name'];
				
			}else{
				$image = $this->input->post('old_logo');
			}
		}
		
		$data = array(
			"name" =>$this->input->post("name"),
			"email"=>$this->input->post("email"),
			"mobile" =>$this->input->post("mobile"),
			"password" => $this->login_model->api_key_crypt($this->input->post("password"),'e'),
			"website_termsandconditions" =>$this->input->post("termsandconditions"),
			"website_privacypolicy" =>$this->input->post("privacypolicy"),
			"website_cancellation" =>$this->input->post("cancellation"),
			"website_main_chat_box" => ($this->input->post("mainchatbox")=='on') ? 1 : 0,
			"logo" =>  $image,
			"admisssion_year" =>$this->input->post("admission"),
			"disclaimer" =>$this->input->post("disclaimer"),
			"copy_right" =>$this->input->post("copyright"),
		);
		$old_password = $this->input->post("old_password");
		
		if($data['password']!=$old_password){

				$msg = '<html><body><small>User ID : '.$adminemail.'</small><br> <small>Password : '.$this->login_model->api_key_crypt( $data["password"],"d").'</small></body></html>';
				$from = $adminemail;
				$subject = "Login Details : KAB Education Fair";
				$to = $data['email'];

				$this->login_model->sendMail($from,$to,$subject,$msg);
		}
		$this->db->where("id",$id)->update("tbl_admin",$data); 
			$this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">Details has updated successfully.</div>');
			//redirect("admin/settings/basic");
			$data=["Status"=>'Active',"Message"=>"Details has updated successfully."];
			echo json_encode($data);
	}

	public function login_history(){

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
      $prefs = array(
		  		'format' => 'zip',
                'filename' => 'backup_'.date('d_m_Y_H_i_s').'.sql', 
                'add_drop' => TRUE,
                'add_insert'=> TRUE,
                'newline' => "\n"
              ); 
         // Backup your entire database and assign it to a variable 
         $backup =& $this->dbutil->backup($prefs); 
         // Load the file helper and write the file to your server 
         $this->load->helper('file'); 
         write_file('uploads/backups/database/'.'dbbackup_'.date('d_m_Y_H_i_s').'.zip', $backup); 
		
		$this->db->insert("tbl_backups",["type"=>"database","source_file"=>'uploads/backups/database/'.'dbbackup_'.date('d_m_Y_H_i_s').'.zip',"created_date"=>date("Y-m-d H:i:s")]);
         // Load the download helper and send the file to your desktop 
         $this->load->helper('download'); 
         force_download('dbbackup_'.date('d_m_Y_H_i_s').'.zip', $backup);

	}
	 public function project_download(){
		
	    	$this->load->library('zip');
			$this->zip->read_dir(FCPATH); 
			$this->zip->download('Project-kabefo.zip');
	}
    function changepassword(){
		$data["admin"] = $this->db->where("id",$this->session->userdata('admin_id'))->get("tbl_admin")->row();
		$data['subview'] ="settings/changepassword";
		$this->load->view('admin/theme',$data);
	}
	function update_password(){
		$id = $this->session->userdata('admin_id');
		$email = $this->session->userdata('email');
		$data = array(
			"password" => $this->login_model->api_key_crypt($this->input->post("password"),'e')
		);
		$old_password = $this->input->post("old_password");
		
		if($data['password']!=$old_password){

				$msg = '<html><body><small>User ID : '.$email.'</small><br> <small>Password : '.$this->login_model->api_key_crypt( $data["password"],"d").'</small></body></html>';
				
				$from = "$this->admin_email";
				$subject = "Login Details : KAB Education Fair";
				$to = $data['email'];
				$re = $this->login_model->sendMail($from,$to,$subject,$msg);
		}
		$this->db->where("id",$id)->update("tbl_admin",$data);
		$this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">Details has updated successfully.</div>');
			//redirect("institute/settings/basic");
			$data=["Status"=>'Active',"Message"=>"Details has updated successfully."];
			echo json_encode($data);
	}
	public function update_feedback(){
		$id = $this->session->userdata('admin_id');
		$data = array(
			"feedback_description" => $this->input->post("feedback_description"),
			"feedback_question" => $this->input->post("feedback_question")
		);
		$a = $this->db->where("id",$id)->update("tbl_admin",$data); 

		if($a){

			$this->db->insert("tbl_feedback_history",$data);

			$this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">Details has updated successfully.</div>');
			//redirect("admin/settings/basic");
			$data=["Status"=>'Active',"Message"=>"Details has updated successfully."];
			echo json_encode($data);

		}
	}
	
	public function test(){
		
		echo '<pre>';
		$this->load->library('zip');
		$unwanted = array('..', '.','project_files','uploads',"ngrok","backups","assets");
		$unassets = ['..', '.',"advertise","auditorium","categories","clients","exhibitors","experts","institutes","news","placements","questions","speakers","sql_backups","videos","zoomvideos"];
		$unimages = ['..', '.',"blog","brochure","cards","ecommerce","gallery","guests","homepage","image-gallery","lg","picsadd","professors","testimonials","webinars"];

		$data = array_diff(scandir(FCPATH), $unwanted);
		$dataassets = array_diff(scandir(FCPATH."assets"), $unassets);
		$dataimages = array_diff(scandir(FCPATH."assets/images"), $unimages);
		
		
//		print_r(array_merge($data,$dataassets,$dataimages));
//		exit();
		
		// 'backups' folder will be excluded here with '.' and '..'

// root folder
		
		$this->zip->compression_level = 9;
		foreach($data as $d) {

			$path = FCPATH.$d;

			if(is_dir($path))
				$this->zip->read_dir($path, false);

			if(is_file($path))
				$this->zip->read_file($path, false);
		}
		
//		echo FCPATH.'uploads/backups/source/'.date('Y-m-d-His').'.zip';
//		exit();	
// assets folder
		foreach($dataassets as $da) {

			$apath = FCPATH."assets/".$d;

			if(is_dir($apath))
				$this->zip->read_dir($apath, false);

			if(is_file($apath))
				$this->zip->read_file($apath, false);
		}

// images folder
		foreach($dataimages as $di) {

			$ipath = FCPATH."assets/images/".$d;

			if(is_dir($ipath))
				$this->zip->read_dir($ipath, false);

			if(is_file($ipath))
				$this->zip->read_file($ipath, false);
		}

		
		
		echo memory_get_usage();
		
		$this->zip->archive(FCPATH.'uploads/backups/source/'.date('Y-m-d-His').'.zip');
		
	}
}
