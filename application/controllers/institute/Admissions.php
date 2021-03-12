<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');
class Admissions extends CI_Controller{
	public function __construct()
	    {
	        parent::__construct();
	        if($this->session->userdata['login_type']!='institute'){redirect('institute/login');}
	    }

	
	public function index()
	{
        $date = explode(" - ",$this->input->get("date"));
		$sdate = date("Y-m-d",strtotime($date[0]));
		$edate = date("Y-m-d",strtotime($date[1]));
		
		if($this->input->get("date")){
			$this->db->where('created_date BETWEEN "'. $sdate. '" and "'.$edate.'"');
		}	
        $status = $this->input->get("status");
        if($status){
            $this->db->where("status",$status);
        }
		
		$course = $this->input->get("course_name");
		$specialization = $this->input->get("specialization");
		$scholarship = $this->input->get("scholarship");
		if($course){
			
			$cdata = [];
			$courses = $this->db->get_where("tbl_courses",["course_name"=>$course,"institute_id"=> $this->session->userdata('institute_id')])->result();
			foreach($courses as $c){
				$cdata[] = $c->course_id;
			}
			$this->db->where_in("course_id",$cdata);
		}
		if($specialization){
			$this->db->where("course_id",$specialization);
		}
		if($scholarship){
			$this->db->where("scholaryn",$scholarship);
			if($scholarship == "no"){
				$this->db->or_where("scholaryn",null);
			}
		}
		
        $data['details'] = $this->db->select('*')->get_where("tbl_institute_admission",["institute_id"=> $this->session->userdata('institute_id')])->result();
		
		
//        echo $this->db->last_query();die;
        $data['subview'] = "admissions/admissions";
		$this->load->view('institute/theme',$data);
	}
    function view_student($id){
		$data['student'] = $this->db->query("SELECT tbl_students.student_id as std_id, tbl_students.student_name, tbl_students.email, tbl_students.phone, tbl_students.address, tbl_students.person_disability_check as person_disability_check_std, tbl_students.disability_name as disability_name_std, tbl_students.image as image_std, tbl_students.signature as signature_std, tbl_academics.*, tbl_entrance_exams.exam_name, tbl_entrance_exams.year_appeared, tbl_entrance_exams.hallticket, tbl_entrance_exams.max_marks, tbl_entrance_exams.secured_marks, tbl_entrance_exams.rank FROM tbl_students LEFT JOIN tbl_academics ON tbl_students.student_id = tbl_academics.student_id LEFT JOIN tbl_entrance_exams ON tbl_students.student_id = tbl_entrance_exams.student_id WHERE tbl_students.student_id='".$id."'")->row();
        $data["studentdocs"] = $this->db->where("student_id", $id)->get("tbl_student_certificates")->result();	
        $data['student_id'] = $id;
		$data['subview'] = "admissions/view_student";
		$this->load->view('institute/theme',$data);
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
        $data['student_id'] = $id;
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

    public function downloadStudCertZip($student_id){
        if($student_id){
            $this->load->library('zip');
            $archive_file_name = 'uploads/students/certificates/'.$student_id.'/';
            $student_info = $this->db->select("student_name")->get_where("tbl_students", ["student_id" => $student_id])->row();
            $zipname = $student_info->student_name.'.zip';
            if ($handle = opendir($archive_file_name)) {
              while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    $filepath = FCPATH.'/uploads/students/certificates/'.$student_id.'/'.$entry;
                    $this->zip->read_file($filepath);
                }
              }
            }
            $this->zip->download($zipname);
        }
        else{
            echo "<script>alert('Not able to download.');</script>";
        }
    }
	
}
