<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');
class Meetings extends CI_Controller{
	public function __construct()
	    {
	        parent::__construct();
	        if($this->session->userdata['login_type']!='expert'){redirect('expert/login');}
	    }

	public function index()
	{
		$data['meetings'] = $this->db->query("SELECT * FROM tbl_expert_student_schedule LEFT JOIN tbl_students ON tbl_expert_student_schedule.student_id = tbl_students.student_id WHERE tbl_expert_student_schedule.expert_id='".$this->session->userdata['expert_id']."' ORDER BY exp_std_date DESC ")->result();
		$data['subview'] = "meetings/meetings";
		$this->load->view('expert/theme',$data);
	}
	
	public function downloadText($id){
		
		$zdata = $this->db->get_where("tbl_zoom_meetings",["id"=>$id])->row();
		
		if($zdata){
			
			header('Content-Type: application/json');
			header('Content-Disposition: attachment; filename='.$zdata->meeting_id.'.txt');
			header('Pragma: no-cache');
			echo $zdata->converted_text;
			exit();	
			
		}else{
			
			redirect("expert/meetings");
			
		}
		
	}
	
}
