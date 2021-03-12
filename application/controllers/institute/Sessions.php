<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sessions extends CI_Controller{
	public function __construct()
	    {
			parent::__construct();
			
	         if($this->session->userdata['login_type']!='institute'){redirect('institute/login');}
	    }

		public function index()
		{
			$currentdate = strtotime(date("Y-m-d H:i:s"));
			
			$institute_id = $this->session->userdata['institute_id'];
			$auditorium = $this->input->get("auditorium");
			$ref = $this->input->get("ref");
			
			if($auditorium){
				$this->db->where("auditorium",$auditorium);
			}
			
			if($ref == "upcoming"){
				$this->db->where("from_time >=",$currentdate);
			}elseif($ref == "completed"){
				$this->db->where("to_time <=",$currentdate);
			}
		
			$data['sessions'] = $this->db->where("institute_id",$this->session->userdata('institute_id'))->where("status","Active")->order_by("date ","desc")->get("tbl_institute_presentations")->result();
			
			
			$data['auditorium'] =  $this->db->select("tbl_institute_presentations.*,tbl_institute_auditorium.*")->from('tbl_institute_presentations')
									->join('tbl_institute_auditorium', 'tbl_institute_auditorium.id = tbl_institute_presentations.auditorium')
									->group_by('tbl_institute_auditorium.title')
									->where('tbl_institute_presentations.institute_id',$institute_id)
									->order_by('tbl_institute_auditorium.id', 'desc')
									->get()->result();
			
			$data["completed"] = $this->db->get_where("tbl_institute_presentations",["institute_id"=>$this->session->userdata['institute_id'],"to_time <="=>$currentdate,"status"=>"Active"])->num_rows();
			$data["upcoming"] = $this->db->get_where("tbl_institute_presentations",["institute_id"=>$this->session->userdata['institute_id'],"from_time >="=>$currentdate,"status"=>"Active"])->num_rows();
			$data["booked"] = $this->db->get_where("tbl_student_auditorium_presentations",["institute_id"=>$this->session->userdata['institute_id']])->num_rows();
								
			$data['subview'] = "sessions/sessions";
			$this->load->view('institute/theme',$data);
		}
	public function add_session(){
		$session_id = $this->uri->segment(4);
		if($session_id){
			$session = $this->db->where("id ",$session_id)->get("tbl_institute_presentations")->result();
			$expert_id = (isset($session[0]->institute_id)) ? $session[0]->institute_id : '';
			$zoom_meeting = '';
			if($expert_id!=''){
				$zoom_meeting = $this->db->where("user_id", $expert_id)->where("session_id", $session_id)->get("tbl_zoom_meetings")->result();
			}
			$data['sessions'] = $session;
			$data['zoom_meeting'] = $zoom_meeting;
		}else{
			$data['sessions'] = "";
			$data['zoom_meeting'] = "";
		}
        //echo '<pre>';print_r($data);exit;
		$data['subview'] = "sessions/add_session";
		$this->load->view('institute/theme',$data);
	}
	
	public function getMinutes($from_time,$to_time){
		
		$cdate = date("Y-m-d");
		$start_date = new DateTime(''.$cdate.' '.$from_time.':00');
		$since_start = $start_date->diff(new DateTime(''.$cdate.' '.$to_time.':00'));
		$minutes = $since_start->days * 24 * 60;
		$minutes += $since_start->h * 60;
		$minutes += $since_start->i;
		return $minutes;
		
	}

	public function auditorium_presentations()
	{
		$currentdate = strtotime(date("Y-m-d H:i:s"));
		$date = $this->input->get("date");		
		$ref = $this->input->get("ref");	
		$auditorium = $this->input->get("auditorium");
		
		if($auditorium){
			
			$this->db->where("auditorium_id",$auditorium);
			
		}	
		if($ref == "upcoming"){
			$this->db->where("from_time >=",$currentdate);
		}elseif($ref == "completed"){
			$this->db->where("to_time <=",$currentdate);
		}
		if($date){
			$this->db->where("date",$date);
		}
		$data['webinars'] = $this->db->order_by("id","desc")->get_where("tbl_student_auditorium_presentations",["institute_id"=>$this->session->userdata['institute_id']])->result();
		$data["completed"] = $this->db->get_where("tbl_student_auditorium_presentations",["institute_id"=>$this->session->userdata['institute_id'],"to_time <="=>$currentdate])->num_rows();
		$data["upcoming"] = $this->db->get_where("tbl_student_auditorium_presentations",["institute_id"=>$this->session->userdata['institute_id'],"from_time >="=>$currentdate])->num_rows();
		$data["booked"] = $this->db->get_where("tbl_student_auditorium_presentations",["institute_id"=>$this->session->userdata['institute_id']])->num_rows();
		
		$data['subview'] = "auditorium_presentations/auditorium_presentations";
		$this->load->view('institute/theme',$data);
	}
	
	public function auditorium_video_presentations()
	{
		$iid = $this->session->userdata['institute_id'];
	
		$data['webinars']  =  $this->db->query("SELECT * FROM tbl_student_auditorium_presentations JOIN tbl_zoom_meetings on tbl_student_auditorium_presentations.zoom_link=tbl_zoom_meetings.meeting_link WHERE tbl_student_auditorium_presentations.institute_id = '$iid' and tbl_zoom_meetings.play_url != ''")->result();
		$data['professor'] =  $this->db->query("SELECT a.exp_std_date,a.exp_std_time,a.expert_id, d.meeting_link,d.play_url,d.converted_text,d.session_id
												FROM tbl_counsellor_student_schedule a 
												INNER JOIN tbl_zoom_meetings  d ON a.zoom_link = d.meeting_link
												WHERE d.play_url != '' and a.institute_id= '$iid' GROUP BY a.exp_std_id")->result();
		//	echo "<pre>";print_r($data['professor'] );die;
		$data['subview'] = "auditorium_presentations/auditorium_presentations";
		$this->load->view('institute/theme',$data);
	}
	public function auditorium_video_text_presentations()
	{
		$iid = $this->session->userdata['institute_id'];
		$data['webinars']  =  $this->db->query("SELECT * FROM tbl_student_auditorium_presentations JOIN tbl_zoom_meetings on tbl_student_auditorium_presentations.zoom_link=tbl_zoom_meetings.meeting_link WHERE tbl_student_auditorium_presentations.institute_id = '$iid' and tbl_zoom_meetings.converted_text != ''")->result();
		$data['professor'] =  $this->db->query("SELECT a.exp_std_date,a.exp_std_time,a.expert_id, d.meeting_link,d.play_url,d.converted_text,d.session_id
												FROM tbl_counsellor_student_schedule a 
												INNER JOIN tbl_zoom_meetings  d ON a.zoom_link = d.meeting_link
												WHERE d.converted_text != '' and a.institute_id= '$iid' GROUP BY a.exp_std_id")->result();		$data['subview'] = "auditorium_presentations/auditorium_presentations";
		$this->load->view('institute/theme',$data);
	}



	
	public function save_session(){	
		
		$selected_dates = [];
		$today = date("Y-m-d");
		$wdates = $this->db->where("date >= ", $today)->get("tbl_webinar_dates")->result();
		foreach ($wdates as $w) {
			$selected_dates[] = $w->date;
		}
		
		$institution_id = $this->session->userdata('institute_id');
		
		$se_id = $this->input->post("exp_se_id");
		$date = $this->input->post("date");
		$from_time = $this->input->post("from_time");
		$to_time = $this->input->post("to_time");
		$title = $this->input->post("title");
		
		if(!in_array($date, $selected_dates)){
			
			$data1=["Status"=>'Inactive',"Message"=>"The selected date is not allowed to create presentation."];
		    echo json_encode($data1);
		    exit();
			
		}
		
		$sessdata = $this->db->get_where("tbl_institute_presentations",["id"=>$se_id])->row();
		$idata = $this->db->get_where("tbl_institutes",["institute_id"=>$institution_id])->row();
		
		if($idata->add_package_status == "Active"){
					
			$adpackage = json_decode($idata->additional_package_count)->presentation_time;

		}else{

			$adpackage = 0;

		}
		
		$availableTime = (json_decode($idata->allowed_creation_count)->presentation_time + $adpackage);
		
		$exDuration = $this->db->query("select sum(duration) as exDuration from tbl_institute_presentations where institute_id=$institution_id and status='Active'")->row();
			
		$chkminutes = $this->getMinutes($from_time,$to_time);
		
		if($chkminutes < 30){
			
			$data1=["Status"=>'Inactive',"Message"=>"Presentation Time Should Be Minimum 30 minutes."];
		    echo json_encode($data1);
		    exit();
			
		}
		
		if($se_id){
			
			$minutes = ($sessdata->duration - $this->getMinutes($from_time,$to_time));
			
		}else{
		
			$minutes = $this->getMinutes($from_time,$to_time);
		
		}
		
		if(($exDuration->exDuration+$minutes) > $availableTime){
			
			$data1=["Status"=>'Inactive',"Message"=>"You Have Exceeded Your Available Time Limit"];
		    echo json_encode($data1);
		    exit();
			
		}
		
		
		$checkAuditorium = $this->checkAuditorium($date,strtotime($from_time),strtotime($to_time),$se_id);
		
//		print_r($checkAuditorium);
//			exit();
		
		if($checkAuditorium){
			
			$auditorium = $checkAuditorium;
			
		}else{
			
//			$checkAvailablesessions = $this->checkAvailablesessions($date,strtotime($from_time),strtotime($to_time),$institution_id,$se_id);
			
//			print_r($checkAvailablesessions);
//			exit();
			
			/*if($checkAvailablesessions){

				$data1=["Status"=>'Inactive',"Message"=>"We have already received request on this date and time."];
				echo json_encode($data1);
				exit();

			}else{*/
			
//				$adata = ["date"=>$date,"from_time"=>strtotime($from_time),"to_time"=>strtotime($to_time),"institute_id"=>$institution_id,"title" => $title,"description" => $this->input->post("description"),"duration" => $chkminutes];
//				$this->db->insert("tbl_institute_presentations",$adata);
				
				$data1=["Status"=>'Inactive',"Message"=>"Auditoriums are not available on this date and time."];
				echo json_encode($data1);
				exit();
				
//			}
			
		}
		
		$checkAvailablesessions = $this->checkAvailablesessions($date,strtotime($from_time),strtotime($to_time),$institution_id,$se_id);
		
		if($checkAvailablesessions){
			
			$data1=["Status"=>'Inactive',"Message"=>"Already have a session on this date and time."];
			echo json_encode($data1);
			exit();
			
		}
		
		if($date!='' && $date!='0000:00:00' && $from_time!='' && $from_time!='00:00' && $to_time!='' && $to_time!='00:00'){
				        		
				$data = array(
					"title" => $title,
					"description" => $this->input->post("description"),
					"institute_id" => $institution_id,
					"from_time" => strtotime($from_time),
					"to_time" => strtotime($to_time),
					"duration" => $chkminutes,
					"date" =>date("Y-m-d",strtotime($date)),
					"auditorium" => $auditorium,
					"status"=>"Active"
				);		
				if($se_id != ""){
					
					$this->db->where("id",$se_id)->update("tbl_institute_presentations",$data);
					$data1=["Status"=>'Active',"Message"=>"Successfully Updated."];
					$exp_se_id = $se_id;
				}else{
					$query = $this->db->insert("tbl_institute_presentations",$data);
					$exp_se_id = $this->db->insert_id();
					$data1=["Status"=>'Active',"Message"=>"Successfully Inserted."];
				} 	
				$start_time = $date.'T'.date('H:i:s', strtotime($from_time));
				//Create Zoom meeting
				$meeting = $this->accesstoken->create_meeting($user_type=5, $title, $start_time, $chkminutes, $exp_se_id, $institution_id);
			
				$zoomdata = $this->db->get_where("tbl_zoom_meetings",["user_id"=>$institution_id,"session_id"=>$exp_se_id])->row();
				$this->db->where("id",$exp_se_id)->update("tbl_institute_presentations",["zoom_meeting_link"=>$zoomdata->meeting_link,"zoom_password"=>$zoomdata->meeting_password]);
			
				//Create Zoom meeting
				echo json_encode($data1);
				exit();
		}
		else{
			$data1=["Status"=>'Inactive',"Message"=>"Date and Time both required."];
		    echo json_encode($data1);
		    exit();
		}
	}
	
	public function checkAvailablesessions($date,$from_time,$to_time,$institution_id,$se_id){
		
//		$this->db->where("from_time between $from_time AND $to_time");
//		$this->db->or_where("to_time between $from_time AND $to_time");
		
		if($se_id != ""){
		
//			$this->db->where("id !=",$se_id);
			$sedata = "and id != $se_id";
			
		}else{
			
			$sedata = "";
			
		}
//		$this->db->where(["date"=>$date,"status"=>"Active"]);
//		$this->db->where("from_time between $from_time AND $to_time or to_time between $from_time AND $to_time");
//		$this->db->or_where("");
		
		$data = $this->db->query("SELECT * FROM tbl_institute_presentations WHERE date = '$date' AND status = 'Active' $sedata  AND (from_time between $from_time AND $to_time or to_time between $from_time AND $to_time)")->result();
		
		return $data;
		
	}

	public function checkAuditorium($date,$from_time,$to_time,$sid){
		
//		return $from_time." ".$to_time;
		
		$data = "";
		$auditoriums = $this->db->get_where("tbl_institute_auditorium")->result();
		
		foreach($auditoriums as $aud){

			/*if($sid != ""){

				$this->db->where("id !=",$sid);

			}*/
			
			if($sid != ""){
		
	//			$this->db->where("id !=",$se_id);
				$sedata = "and id != $sid";

			}else{

				$sedata = "";

			}
			
//			$this->db->where(["date"=>$date,"auditorium"=>$aud->id,"status"=>"Active"]);			
//			$this->db->where("from_time between $from_time AND $to_time");
//			$this->db->or_where("to_time between $from_time AND $to_time");
//			$data = $this->db->get("tbl_institute_presentations")->result();
			
			$data = $this->db->query("SELECT * FROM tbl_institute_presentations WHERE date = '$date' and auditorium='$aud->id' AND status = 'Active' $sedata  AND (from_time between $from_time AND $to_time or to_time between $from_time AND $to_time)")->result();
			
			if(empty($data)){
				
//				$this->db->where("from_time between $from_time AND $to_time");
//				$this->db->where("to_time between $from_time AND $to_time");
				$this->db->where("from_time <= $from_time AND to_time >= $to_time");
				$this->db->where("from_time <= $from_time AND to_time >= $to_time");
				$this->db->where(["date"=>$date]);
				$audi = $this->db->get_where("tbl_institute_auditorium")->row();
				
				if($audi){
					
					return $audi->id;
					
				}
				
			}
			
		}
		
		return "";
		
	}
	
	public function delete_session(){
		if($this->uri->segment(4)){
			$id =$this->uri->segment(4);
			$query = $this->db->where("id",$id)->delete("tbl_institute_presentations");
			if($query){ redirect("counsellor/sessions");}
		}
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
			
			redirect("institute/sessions/auditorium_presentations");
			
		}
		
	}
	
}
