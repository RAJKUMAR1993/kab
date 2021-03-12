<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');

class Auditorium extends CI_Controller{


	public function view($id)
	{
		$title = str_replace("-"," ",$id);
		$date = date("Y-m-d");
        $data['days'] = $this->db->query("SELECT * FROM tbl_institute_presentations WHERE status='Active' and date>='$date' group by date")->result();
		$data['audi'] = $this->db->query("SELECT * FROM tbl_institute_auditorium where title='$title'")->row();
		$this->load->view('front/auditorium/auditorium', $data);
	}
	
	public function book()
	{
		$inst_id = $this->input->get("inst_id");
		$aid = $this->input->get("aid");
		$date = $this->input->get("date");
		$ctime = strtotime("now");
		
        $data['sessions'] = $this->db->query("SELECT * FROM tbl_institute_presentations WHERE status='Active' and auditorium=$aid and institute_id=$inst_id and date='$date'")->result();
		
		
		$data['audi'] = $this->db->query("SELECT * FROM tbl_institute_auditorium where id=$aid")->row();
		$data['in'] = $this->db->query("SELECT * FROM tbl_institutes where institute_id=$inst_id")->row();
		$this->load->view('front/auditorium/auditorium_presentations', $data);
	}
	
	public function mainAuditorium($num=""){
		$datetime = date("Y-m-d H:i:s");
		$timetoseconds = strtotime($datetime);
		// $recordPerPage = 5;
		// if ($num != "") {
  //           $pageno = $num;
  //       } else {
  //           $pageno = 1;
  //       }
  //       $offset = ($pageno-1) * $recordPerPage;
  //       $sql = "SELECT * FROM tbl_webinors WHERE from_time>=".$timetoseconds." OR to_time>=".$timetoseconds." order by date asc";
       
		// $recordCount = $this->db->query($sql)->num_rows();
		// $sql .= " LIMIT $offset, $recordPerPage";
  //     	$empRecord = $this->db->query($sql)->result();
		// $config['base_url'] = base_url().'front/webinars/list/';
  //     	$config['use_page_numbers'] = TRUE;
		// $config['full_tag_open'] = '<ul class="pagination pagination-sm">';
		// $config['full_tag_close'] = '</ul>';
		// $config['prev_link'] = 'Previous';
		// $config['prev_tag_open'] = '<li class="page-item page-link">';
		// $config['prev_tag_close'] = '</li>';
		// $config['next_tag_open'] = '<li class="page-item page-link">';
		// $config['next_tag_close'] = '</li>';
		// $config['cur_tag_open'] = '<li class="page-link currentpage active"><a href="#">';
		// $config['cur_tag_close'] = '</a></li>';
		// $config['num_tag_open'] = '<li class="page-item page-link">';
		// $config['num_tag_close'] = '</li>';

		// $config['next_link'] = 'Next';
		// $config['total_rows'] = $recordCount;
		// $config['per_page'] = $recordPerPage;
		// $this->pagination->initialize($config);
		// $data['pagination'] = $this->pagination->create_links();       
  //       $data['webinars'] = $empRecord;
		
		$data['webinor_dates'] = $this->db->select("id, date")->order_by("tbl_webinors.date", "asc")->where("tbl_webinors.from_time >= ".$timetoseconds." OR tbl_webinors.to_time >= ".$timetoseconds)->group_by("date")->get("tbl_webinors")->result();
		$this->load->view('front/webinars/webinars',$data);
	}
	
    function save_in_session(){
		
		$session_id = $this->input->post("session");
		$sdata = $this->db->get_where("tbl_institute_presentations",["id"=>$session_id])->row();
		
		$chkPresentationsbooked = $this->db->get_where("tbl_student_auditorium_presentations",["presentation_id"=>$session_id])->num_rows();
		
		if($chkPresentationsbooked <= 100){
			
			$chkExists = $this->db->get_where("tbl_student_auditorium_presentations",["presentation_id"=>$session_id,"student_id" => $this->session->userdata("student_id")])->num_rows();
			
			if($chkExists > 0){
				
				echo '<div class="alert alert-danger">You have already registered for this session.</div>';
				exit();
				
			}
			
			$data = [
				"auditorium_id"=>$sdata->auditorium,
				"date"=>$sdata->date,
				"from_time" => $sdata->from_time,
				"to_time" => $sdata->to_time,
				"duration" => $sdata->duration,
				"student_id" => $this->session->userdata("student_id"),
				"institute_id" => $sdata->institute_id,
				"presentation_id" => $session_id,
				"zoom_link" => $sdata->zoom_meeting_link,
				"zoom_password" => $sdata->zoom_password,
				
			];
			
			$d = $this->db->insert("tbl_student_auditorium_presentations",$data);
			
			if($d){
				
				$stdata = $this->db->get_where("tbl_students",["student_id"=>$this->session->userdata("student_id")])->row();
				
				$msg = '<html><body>Dear '.$stdata->student_name.',Thanks for booking this presentation, please find below link of presentation.<br>Link : <a href="'.$sdata->zoom_meeting_link.'">Click Here</a><br>Admin,kabconsultants</body></html>';
				$from = "noreply@kabconsultants.com";
				$subject = "Presentation Link : KAB Education Fair";
				$to = $stdata->email;

				$this->login_model->sendMail($from,$to,$subject,$msg);
				
				if($this->input->post("ref") == "join"){
					
					echo "join";
					
				}else{
				
					echo 'success';
					
				}
			}else{
				
				echo '<div class="alert alert-danger">Error Occured please try again.</div>';
				
			}
			
		}else{
			
			echo '<div class="alert alert-danger">Only 100 students are allowed for One presentation.</div>';
			
		}
		
		
	}
	
	
}
