<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');

class Councellors extends CI_Controller {


	// public function view_sessions($id)
	// {   
	// 	$datetime = date("Y-m-d");
 //        $data['professor_details'] = $this->db->query("SELECT * FROM tbl_councellors WHERE id=".$id."")->result();
 //        $data['sessions'] = $this->db->query("SELECT * FROM tbl_counsellor_sessions WHERE expert_id=$id group by exp_se_date")->result();
	// 	$this->load->view('front/councellor/concellor-details',$data);
	// }//commented for view_session new page as professors
	public function view_sessions($id)
	{   
		$datetime = date("Y-m-d H:i:s");
        $data['expert_details'] = $this->db->query("SELECT * FROM tbl_councellors WHERE id=".$id."")->result();
        $data['sessions'] = $this->db->query("SELECT DISTINCT duration FROM tbl_counsellor_sessions WHERE expert_id=".$id." AND exp_se_time >= ".strtotime($datetime))->result();
		$this->load->view('front/councellor/concellor-details',$data);
	}
    function save_in_session(){
		
		$session_id = $this->input->post("session");
		$sdata = $this->db->get_where("tbl_counsellor_sessions",["exp_se_id"=>$session_id])->row();
		
		if($sdata->is_booked == "Inactive"){
			
			$data = [
				"expert_id"=>$sdata->expert_id,
				"exp_std_date"=>$sdata->exp_se_date,
				"exp_std_time" => $sdata->exp_se_time,
				"student_id" => $this->session->userdata("student_id"),
				"institute_id" => $sdata->institute_id
			];
			
			$d = $this->db->insert("tbl_counsellor_student_schedule",$data);
			
			if($d){
				
				echo 'success';
				$this->db->where(["exp_se_id"=>$session_id])->update("tbl_counsellor_sessions",["is_booked"=>"Active"]);
				
			}else{
				
				echo '<div class="alert alert-danger">Error Occured please try again.</div>';
				
			}
			
		}else{
			
			echo '<div class="alert alert-danger">Session Already Booked</div>';
			
		}
		
		
	}
	
}