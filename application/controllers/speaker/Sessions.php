<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sessions extends CI_Controller{
	public function __construct()
	    {
	        parent::__construct();
	        if($this->session->userdata['login_type']!='speaker'){redirect('speaker/login');}
	    }

	public function index()
	{
		$data['sessions'] = $this->db->where("speaker_id",$this->session->userdata['speaker_id'])->where("is_deleted",'0')->order_by("spe_se_date ","desc")->get("tbl_speaker_sessions")->result();
		$data['subview'] = "sessions/sessions";
		$this->load->view('speaker/theme',$data);
	}
	public function add_session(){
		$session_id = $this->uri->segment(4);
		if($session_id){
			$session = $this->db->where("is_deleted",'0')->where("spe_se_id ",$session_id)->get("tbl_speaker_sessions")->result();
			$speaker_id = (isset($session[0]->speaker_id)) ? $session[0]->speaker_id : '';
			$zoom_meeting = '';
			if($speaker_id!=''){
				$zoom_meeting = $this->db->where("speaker_id", $speaker_id)->where("session_id", $session_id)->get("tbl_zoom_meetings")->result();
			}
			$data['sessions'] = $session;
			$data['zoom_meeting'] = $zoom_meeting;
		}else{
			$data['sessions'] = "";
			$data['zoom_meeting'] = "";
		}
        //echo '<pre>';print_r($data);exit;
		$data['subview'] = "sessions/add_session";
		$this->load->view('speaker/theme',$data);
	}
	public function save_session(){		
		$spe_se_id = $this->input->post("spe_se_id");	 
		$speaker_id = $this->session->userdata['speaker_id'];
		$title = $this->input->post("title");
		$duration = $this->input->post("duration");   
		$date = $this->input->post("date");
		$time_input = $this->input->post("time");
		if($date!='' && $date!='0000:00:00' && $time_input!='' && $time_input!='00:00'){
			$time = $date.' '.$time_input;
			$time = strtotime($time);
			$check = $this->db->select("*")->where("speaker_id", $speaker_id);
			if($spe_se_id!=''){
				$check = $check->where("spe_se_id !=", $spe_se_id);
			}
			$prog = $check->where("is_deleted", "0")->get("tbl_speaker_sessions")->result();
			foreach($prog as $pro){
				$given_time_min = date('i', strtotime($time_input));
				$start_time = date('H:i', $pro->spe_se_time);
				$end_time = date("H:i", strtotime('+'.$pro->duration.' minutes', $pro->spe_se_time));
				if($pro->spe_se_date == $date){
					$st = strtotime($start_time);
					$en = strtotime($end_time);
					$ti = strtotime($time_input);
					
					$given_end_time = date("H:i", strtotime('+'.$duration.' minutes', $ti));
					$gi_en_tim = strtotime($given_end_time);
					
					if($given_time_min != "00"){
						if ( in_array($ti, range($st,$en)) || in_array($gi_en_tim, range($st,$en))) {
							$k = 1;
						}
					}else{
						if($ti >= $st && $ti <= $en){
						 $k = 1;
					    }
					}
				}			
			}
			if($k != 1){        		
				$data = array(
				    "speaker_id" => $speaker_id,
					"spe_se_date" => $date,
					"spe_se_time" => $time,
					"title" => $title,
					"description" => $this->input->post("description"),
					"duration" => $duration,
					"amount" => $this->input->post("amount"),
					"institute_id" => $this->session->userdata['speaker_inst_id'],
					"students_allowed" => $this->input->post("students_allowed")
				);		
				if($spe_se_id != ""){
					$this->db->where("spe_se_id",$spe_se_id)->update("tbl_speaker_sessions",$data);
					$data1=["Status"=>'Active',"Message"=>"Successfully Updated."];
					//echo json_encode($data1);
					//exit();
				}else{
					$query = $this->db->insert("tbl_speaker_sessions",$data);
					$spe_se_id = $this->db->insert_id();
					$data1=["Status"=>'Active',"Message"=>"Successfully Inserted."];
				} 	
				$start_time = $date.'T'.date('H:i:s', $time);
				//Create Zoom meeting
				$meeting = $this->accesstoken->create_meeting($user_type=2, $title, $start_time, $duration, $spe_se_id, $speaker_id);
				//Create Zoom meeting
				echo json_encode($data1);
				exit();
			}
			else{
				$data1=["Status"=>'Inactive',"Message"=>"You already have a session on this date and time."];
			    echo json_encode($data1);
			    exit();
			}
		}
		else{
			$data1=["Status"=>'Inactive',"Message"=>"Date and Time both required."];
		    echo json_encode($data1);
		    exit();
		}
	}

	public function delete_session(){
		if($this->uri->segment(4)){
			$id =$this->uri->segment(4);
			$query = $this->db->where("spe_se_id",$id)->update("tbl_speaker_sessions",array('is_deleted' =>'1'));
			if($query){ redirect("speaker/sessions");}
		}
	}
	
}
