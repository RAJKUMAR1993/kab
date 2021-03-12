<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');

class Students extends MY_Controller {

	public function __construct(){
		parent::__construct();
		if($this->session->userdata['login_type']!='admin'){redirect('admin');}

		$this->admin_email = $this->login_model->get_option("admin_email_id")->email;
	}
	
	public function index()
	{
		$data['students'] = $this->student_model->get_student();
		$data['subview'] = "students/students";
		$this->load->view('admin/theme',$data);
	}
	
	function view_student($id){
		$data['student'] = $this->db->query("SELECT tbl_students.student_id as std_id, tbl_students.student_name, tbl_students.email, tbl_students.phone, tbl_students.address, tbl_students.person_disability_check as person_disability_check_std, tbl_students.disability_name as disability_name_std, tbl_students.image as image_std, tbl_students.signature as signature_std, tbl_academics.*, tbl_entrance_exams.exam_name, tbl_entrance_exams.year_appeared, tbl_entrance_exams.hallticket, tbl_entrance_exams.max_marks, tbl_entrance_exams.secured_marks, tbl_entrance_exams.rank FROM tbl_students LEFT JOIN tbl_academics ON tbl_students.student_id = tbl_academics.student_id LEFT JOIN tbl_entrance_exams ON tbl_students.student_id = tbl_entrance_exams.student_id WHERE tbl_students.student_id='".$id."'")->row();
        $data["studentdocs"] = $this->db->where("student_id", $id)->get("tbl_student_certificates")->result();	
        $data["student_id"] = $id;
		$data['subview'] = "students/view_student";
		$this->load->view('admin/theme',$data);
	}
	
	public function createXLS($id) {
 // create file name
        $fileName = 'student-'.time().'.xlsx';  
 // load excel library
        $this->load->library('excel');
        //$mobiledata = $this->export->mobileList();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
		$res = $this->db->query("SELECT tbl_students.*,tbl_academics.* FROM tbl_students LEFT JOIN tbl_academics ON tbl_students.student_id = tbl_academics.student_id WHERE tbl_students.student_id='".$id."'")->row();
		
		$rowCount = 2;
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'student_name.');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', $res->student_name);
        $objPHPExcel->getActiveSheet()->SetCellValue('A2', 'email');
		$objPHPExcel->getActiveSheet()->SetCellValue('B2', $res->email);
        $objPHPExcel->getActiveSheet()->SetCellValue('A3', 'phone');
        $objPHPExcel->getActiveSheet()->SetCellValue('B3', $res->phone);		
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Address'); 
        $objPHPExcel->getActiveSheet()->SetCellValue('B4', $res->address);		
        $objPHPExcel->getActiveSheet()->SetCellValue('A5', 'Name of the Board');
        $objPHPExcel->getActiveSheet()->SetCellValue('B5', $res->ssc_board);		
        $objPHPExcel->getActiveSheet()->SetCellValue('A6', 'School Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B6', $res->ssc_school);		
        $objPHPExcel->getActiveSheet()->SetCellValue('A7', 'School Address');
        $objPHPExcel->getActiveSheet()->SetCellValue('B7', $res->ssc_address);		
        $objPHPExcel->getActiveSheet()->SetCellValue('A8', 'School District');
        $objPHPExcel->getActiveSheet()->SetCellValue('B8', $res->ssc_district);		
        $objPHPExcel->getActiveSheet()->SetCellValue('A9', 'School State');
        $objPHPExcel->getActiveSheet()->SetCellValue('B9', $res->ssc_state);		
        $objPHPExcel->getActiveSheet()->SetCellValue('A10', 'Hall Ticket Number');
        $objPHPExcel->getActiveSheet()->SetCellValue('B10', $res->ssc_hallticket);		
        $objPHPExcel->getActiveSheet()->SetCellValue('A11', 'Total Marks');
        $objPHPExcel->getActiveSheet()->SetCellValue('B11', $res->ssc_totalmarks);		
        $objPHPExcel->getActiveSheet()->SetCellValue('A12', 'Total Marks Secured');
        $objPHPExcel->getActiveSheet()->SetCellValue('B12', $res->ssc_markssecured);
        $objPHPExcel->getActiveSheet()->SetCellValue('A13', 'Percentage');
        $objPHPExcel->getActiveSheet()->SetCellValue('B13', $res->ssc_percentage);		
        $objPHPExcel->getActiveSheet()->SetCellValue('A14', 'Year of passing');
        $objPHPExcel->getActiveSheet()->SetCellValue('B14', $res->ssc_yearpassing);		
        $objPHPExcel->getActiveSheet()->SetCellValue('A14', 'Intemidiate');
        $objPHPExcel->getActiveSheet()->SetCellValue('B14', '');
        $objPHPExcel->getActiveSheet()->SetCellValue('A15', 'Name of the Board');
        $objPHPExcel->getActiveSheet()->SetCellValue('B15', $res->inter_board);		
        $objPHPExcel->getActiveSheet()->SetCellValue('A16', 'College Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B16', $res->inter_college);		
        $objPHPExcel->getActiveSheet()->SetCellValue('A17', 'Course Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B17', $res->inter_course);		
        $objPHPExcel->getActiveSheet()->SetCellValue('A18', 'Group Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B18', $res->inter_group);		
        $objPHPExcel->getActiveSheet()->SetCellValue('A19', 'College Address');
        $objPHPExcel->getActiveSheet()->SetCellValue('B19', $res->inter_address);		
        $objPHPExcel->getActiveSheet()->SetCellValue('A20', 'College District');
        $objPHPExcel->getActiveSheet()->SetCellValue('B20', $res->inter_district);		
        $objPHPExcel->getActiveSheet()->SetCellValue('A21', 'College State');
        $objPHPExcel->getActiveSheet()->SetCellValue('B21', $res->inter_state);		
        $objPHPExcel->getActiveSheet()->SetCellValue('A22', 'Hall Ticket Number');
        $objPHPExcel->getActiveSheet()->SetCellValue('B22', $res->inter_hallticket);
        $objPHPExcel->getActiveSheet()->SetCellValue('A23', 'Total Marks');
        $objPHPExcel->getActiveSheet()->SetCellValue('B23', $res->inter_totalmarks);		
        $objPHPExcel->getActiveSheet()->SetCellValue('A24', 'Total Marks Secured');
        $objPHPExcel->getActiveSheet()->SetCellValue('B24', $res->inter_markssecured);				
		$objPHPExcel->getActiveSheet()->SetCellValue('A25', 'Percentage');
        $objPHPExcel->getActiveSheet()->SetCellValue('B25', $res->inter_percentage);
        $objPHPExcel->getActiveSheet()->SetCellValue('A26', 'Group Marks');
        $objPHPExcel->getActiveSheet()->SetCellValue('B26', $res->inter_groupmarks);		
        $objPHPExcel->getActiveSheet()->SetCellValue('A27', 'Year of passing');
        $objPHPExcel->getActiveSheet()->SetCellValue('B27', $res->inter_yearpassing);
		$objPHPExcel->getActiveSheet()->SetCellValue('A28', 'Degree/Graduation');
        $objPHPExcel->getActiveSheet()->SetCellValue('B28', '');		
        $objPHPExcel->getActiveSheet()->SetCellValue('A29', 'College Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B29', $res->degree_college);		
        $objPHPExcel->getActiveSheet()->SetCellValue('A30', 'Course Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B30', $res->degree_group);		
        $objPHPExcel->getActiveSheet()->SetCellValue('A31', 'Specialisation');
        $objPHPExcel->getActiveSheet()->SetCellValue('B31', $res->degree_address);		
        $objPHPExcel->getActiveSheet()->SetCellValue('A32', 'College Address');
        $objPHPExcel->getActiveSheet()->SetCellValue('B32', $res->degree_address);		
        $objPHPExcel->getActiveSheet()->SetCellValue('A33', 'College District');
        $objPHPExcel->getActiveSheet()->SetCellValue('B33', $res->degree_district);		
        $objPHPExcel->getActiveSheet()->SetCellValue('A34', 'College State');
        $objPHPExcel->getActiveSheet()->SetCellValue('B34', $res->degree_state);		
        $objPHPExcel->getActiveSheet()->SetCellValue('A35', 'Hall Ticket Number');
        $objPHPExcel->getActiveSheet()->SetCellValue('B35', $res->degree_hallticket);
        $objPHPExcel->getActiveSheet()->SetCellValue('A36', 'Total Marks');
        $objPHPExcel->getActiveSheet()->SetCellValue('B36', $res->degree_totalmarks);		
        $objPHPExcel->getActiveSheet()->SetCellValue('A37', 'Total Marks Secured');
        $objPHPExcel->getActiveSheet()->SetCellValue('B37', $res->degree_markssecured);				
		$objPHPExcel->getActiveSheet()->SetCellValue('A38', 'Percentage');
        $objPHPExcel->getActiveSheet()->SetCellValue('B38', $res->degree_percentage);
        $objPHPExcel->getActiveSheet()->SetCellValue('A39', 'Group Marks');
        $objPHPExcel->getActiveSheet()->SetCellValue('B39', $res->degree_groupmarks);		
        $objPHPExcel->getActiveSheet()->SetCellValue('A40', 'Year of passing');
        $objPHPExcel->getActiveSheet()->SetCellValue('B40', $res->degree_yearpassing);
		$objPHPExcel->getActiveSheet()->SetCellValue('A41', 'Person with Disability');
        $objPHPExcel->getActiveSheet()->SetCellValue('B41', $res->person_disability_check);
        $objPHPExcel->getActiveSheet()->SetCellValue('A42', 'Type of disability');
        $objPHPExcel->getActiveSheet()->SetCellValue('B42', $res->disability_name); 
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
        header("Content-Type: application/vnd.ms-excel");
         redirect(site_url().$fileName);              
    }
	
    public function createPDF($id){
        $student = $this->db->query("SELECT tbl_students.student_id as std_id, tbl_students.student_name, tbl_students.email, tbl_students.phone, tbl_students.address, tbl_students.person_disability_check as person_disability_check_std, tbl_students.disability_name as disability_name_std, tbl_students.image as image_std, tbl_students.signature as signature_std, tbl_academics.*, tbl_entrance_exams.exam_name, tbl_entrance_exams.year_appeared, tbl_entrance_exams.hallticket, tbl_entrance_exams.max_marks, tbl_entrance_exams.secured_marks, tbl_entrance_exams.rank FROM tbl_students LEFT JOIN tbl_academics ON tbl_students.student_id = tbl_academics.student_id LEFT JOIN tbl_entrance_exams ON tbl_students.student_id = tbl_entrance_exams.student_id WHERE tbl_students.student_id='".$id."'")->row();
        $data['student'] = $student;
        $data["student_id"] = $id;
        $studentdocs = $this->db->select("doc_filename")->where("student_id", $id)->get("tbl_student_certificates")->result();
        $html = $this->load->view('institute/admissions/html',$data, true); // html file
        $mpdf = new \Mpdf\Mpdf();
        $stylesheet = file_get_contents(base_url().'assets/css/pdf.css'); // external css
        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($html,2);
        $mpdf->addpage();
        $i = 1;
        foreach ($studentdocs as $cert) {
            $ext = '';
            $imgext = explode(".", $cert->doc_filename);
            if(isset($imgext[1])){ $ext = $imgext[1]; }
            $mpdf->Image(base_url().'uploads/students/certificates/'.$id.'/'.$cert->doc_filename, 0, 0, 210, 297, $ext, '', true, false);
            if(count($studentdocs)!=$i){
                $mpdf->addpage();
            }
            $i++;
        }
        $mpdf->Output('Student_'.$student->student_name.'.pdf', 'D');
    }
	
	
	public function add(){
		if($this->uri->segment(4)){
			$data['student'] = $this->student_model->get_student_id($this->uri->segment(4));
		}else{
			$data['student'] = "";
		}

		$data['subview'] = "students/add_student";
		$this->load->view('admin/theme',$data);
	}	

	function random_username($user_name)
	{
	 	$new_name = $user_name.mt_rand(0,10000);
	 	return $new_name;//$this->check_user_name($new_name,$user_name);
	}

/*	function check_user_name($new_name,$user_name)
	{
		 $select = $this->db->where("profile_name")->get("tbl_students")->num_rows();

		 if($select)
		 {
		  $this->random_username($user_name);
		 }
		 else
		 {
		  echo $new_name;
		 }
	}*/


	public function save_student(){
		
		$data = array(
			"student_name" => $this->input->post("name"),
			"email" => $this->input->post("email"),
			"phone" => $this->input->post("phone"),
			"address" => $this->input->post("address"),
			"status" => $this->input->post("status")
		);/*print_r($data);
		 exit;*/

		if($this->uri->segment(4)){
			$data['password'] = $this->student_login_model->api_key_crypt( $this->input->post("password"),'e');
			$old_password = $this->input->post("old_password");

			if($data['password']!=$old_password){

				$msg = '<html><body>Your password has been updated, please login with below details. <br><small>User ID : '.$data["email"].'</small><br> <small>Password : '.$this->student_login_model->api_key_crypt($data["password"],"d").'</small></body></html>';
				$from = "$this->admin_email";
				$subject = "Login Details : KAB Education Fair";
				$to = $data['email'];
				$re = $this->login_model->sendMail($from,$to,$subject,$msg);
			}
			$this->db->where("student_id",$this->input->post("student_id"))->update("tbl_students",$data);
			$data1=["Status"=>'Active',"Message"=>"Successfully Updated."];
				echo json_encode($data1);
				exit(); 
			//redirect("admin/students");
		}else{
			$data['password'] = $this->student_login_model->api_key_crypt(random_string('alnum', 8),"e");
			$check_email = $this->student_model->check_email($data['email']);
			
			if($check_email){
				$query = $this->db->insert("tbl_students",$data);
                $student_id = $this->db->insert_id();
                $query2 = $this->db->insert("tbl_academics",array("student_id"=>$student_id));
			}else{
				$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">Student email already exist.!</div>');
				//redirect("admin/students/add");
				$data1=["Status"=>'InActive',"Message"=>"Student email already exist."];
			 	echo json_encode($data1);
			 	exit();
			}
			}
			if($query){
				$msg = '<html><body><small>User ID : '.$data["email"].'</small><br> <small>Password : '.$this->student_login_model->api_key_crypt( $data["password"],"d").'</small></body></html>';
				$from = "$this->admin_email";
				$subject = "Login Details : KAB Education Fair";
				$to = $data['email'];
				$re = $this->login_model->sendMail($from,$to,$subject,$msg);

				//redirect("admin/students");
				$data1=["Status"=>'Active',"Message"=>"Successfully Inserted."];
				echo json_encode($data1);
				exit();
			}
			
		}

	

	public function delete_student(){
		if($this->uri->segment(4)){
			$id =$this->uri->segment(4);
			$query = $this->db->where("student_id",$id)->update("tbl_students",array('is_deleted' =>'1'));
			if($query){ redirect("admin/students");}
		}
	}

}
