<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Institutes extends CI_Controller {
	public function __construct()
	    {
	        parent::__construct();
	        if($this->session->userdata['login_type']!='student'){redirect('student/login');}
			$this->admin_email = $this->login_model->get_option("admin_email_id")->email;
	    }

public function index()
	{

		$data["admin"] = $this->db->where("student_id",$this->session->userdata('student_id'))->get("tbl_students")->row();
		$data['subview'] ="institutes/institutes";
		$this->load->view('student/theme',$data);
	}

	public function basic()
	{

		$data["admin"] = $this->db->where("student_id",$this->session->userdata('student_id'))->get("tbl_students")->row();
		$data['subview'] ="settings/basic_details";
		$this->load->view('student/theme',$data);
	}

	public function update(){
		$id = $this->session->userdata('student_id');
		//$logo = $this->input->post('logo');

			if($_FILES['logo']){
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
			}
			

		$data = array(
			"student_name" =>$this->input->post("name"),
			"email"=>$this->input->post("email"),
			"phone" =>$this->input->post("mobile"),
			"password" => $this->student_login_model->api_key_crypt($this->input->post("password"),'e'),
			"address" =>$this->input->post("address"),
			"logo" => $image
		);
		$old_password = $this->input->post("old_password");
		
		if($data['password']!=$old_password){

				$msg = "Message";
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
}
