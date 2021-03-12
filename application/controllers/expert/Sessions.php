<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sessions extends CI_Controller{
	public function __construct()
	    {
	        parent::__construct();
	        if($this->session->userdata['login_type']!='expert'){redirect('expert/login');}
	    }

	public function index()
	{
		$data['sessions'] = $this->db->where("expert_id",$this->session->userdata['expert_id'])->where("is_deleted",'0')->order_by("exp_se_date ","desc")->get("tbl_expert_sessions")->result();
		$data['subview'] = "sessions/sessions";
		$this->load->view('expert/theme',$data);
	}
	public function add_session(){
		$session_id = $this->uri->segment(4);
		if($session_id){
			$session = $this->db->where("is_deleted",'0')->where("exp_se_id ",$session_id)->get("tbl_expert_sessions")->result();
			$expert_id = (isset($session[0]->expert_id)) ? $session[0]->expert_id : '';
			$zoom_meeting = '';
			if($expert_id!=''){
				$zoom_meeting = $this->db->where("expert_id", $expert_id)->where("session_id", $session_id)->get("tbl_zoom_meetings")->result();
			}
			$data['sessions'] = $session;
			$data['zoom_meeting'] = $zoom_meeting;
		}else{
			$data['sessions'] = "";
			$data['zoom_meeting'] = "";
		}
        //echo '<pre>';print_r($data);exit;
		$data['subview'] = "sessions/add_session";
		$this->load->view('expert/theme',$data);
	}
	public function save_session(){	
		$exp_se_id = $this->input->post("exp_se_id");	 
		$expert_id = $this->session->userdata['expert_id'];
		$title = $this->input->post("title");
		$duration = $this->input->post("duration");   
		$date = $this->input->post("date");
		$time_input = $this->input->post("time");
		if($date!='' && $date!='0000:00:00' && $time_input!='' && $time_input!='00:00'){
			$time = $date.' '.$time_input;
			$time = strtotime($time);
			$check = $this->db->select("*")->where("exp_se_time", $time)->where("expert_id", $expert_id);
			if($exp_se_id!=''){
				$check = $check->where("exp_se_id !=", $exp_se_id);
			}
			$prog = $check->where("is_deleted", "0")->get("tbl_expert_sessions")->result();
			
			foreach($prog as $pro){
				$given_time_min = date('i', strtotime($time_input));
				$start_time = date('H:i', $pro->exp_se_time);
				$end_time = date("H:i", strtotime('+'.$pro->duration.' minutes', $pro->exp_se_time));
				if($pro->exp_se_date == $date){
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
				    "expert_id" => $expert_id,
					"exp_se_date" => $date,
					"exp_se_time" => $time,
					"title" => $title,
					"description" => $this->input->post("description"),
					"duration" => $duration,
					"amount" => $this->input->post("amount"),
					"institute_id" => $this->session->userdata['expert_inst_id']
				);		
				if($exp_se_id != ""){
					$this->db->where("exp_se_id",$exp_se_id)->update("tbl_expert_sessions",$data);
					$data1=["Status"=>'Active',"Message"=>"Successfully Updated."];
					//echo json_encode($data1);
					//exit();
				}else{
					$query = $this->db->insert("tbl_expert_sessions",$data);
					$exp_se_id = $this->db->insert_id();
					$data1=["Status"=>'Active',"Message"=>"Successfully Inserted."];
				    //echo json_encode($data1);
				    //exit();
				} 	
				$start_time = $date.'T'.date('H:i:s', $time);
				//Create Zoom meeting
				$meeting = $this->accesstoken->create_meeting($user_type=3, $title, $start_time, $duration, $exp_se_id, $expert_id);
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
			$query = $this->db->where("exp_se_id",$id)->update("tbl_expert_sessions",array('is_deleted' =>'1'));
			if($query){ redirect("expert/sessions");}
		}
	}
	
}
