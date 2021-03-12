<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Analytics extends CI_Controller {
	
	public function __construct()
	    {
	        parent::__construct();
	        //$this->load->library('excel');
	        if($this->session->userdata['login_type']!='institute'){redirect('institute/login');}
	    }
	
	
	public function getMinutes($from_time,$to_time){
		
		$start_date = new DateTime($from_time);
		$since_start = $start_date->diff(new DateTime($to_time));
		$minutes = $since_start->days * 24 * 60;
		$minutes += $since_start->h * 60;
		$minutes += $since_start->i;
		return $minutes;
		
	}

	public function index()
	{
		;
		$institute_id =$this->session->userdata['institute_id'];
		$data['experts'] = $this->db->get_where("tbl_councellors",["institute_id"=>$institute_id,"is_deleted"=>0])->result();
		$data['subview'] = "analytics/analytics";
		
		$begin = new DateTime( date("Y-m-d",strtotime("-4 days")) );
		$end   = new DateTime( date("Y-m-d") );

		$dates = [];
		for($i = $begin; $i <= $end; $i->modify('+1 day')){
			$dates[] = $i->format("Y-m-d");
		}
		
		$fdates = array_reverse($dates);
		
		$vebsc = [];
		$saq = [];
		$sschm = [];
		$avgtime = [];
		
		$ratings = ["Rating 1","Rating 2","Rating 3","Rating 4","Rating 5"];
		
		foreach($fdates as $date){
			
			$avgst = $this->db->where("date",$date)->get_where("tbl_student_institute_view_time",["institute_id"=>$institute_id]);
			$vebsc[] = $avgst->num_rows();
			$saq[] = $this->db->like("created_date",$date)->get_where("tbl_institute_ask_a_question",["institute_id"=>$institute_id])->num_rows();
			$sschm[] = $this->db->where("exp_std_date",$date)->get_where("tbl_counsellor_student_schedule",["institute_id"=>$institute_id])->num_rows();
			
			if($avgst){
				
				$ttime = 0;
				foreach($avgst->result() as $av){
					
					if($av->end_time != "0000-00-00 00:00:00"){
						
						$time_spent = json_decode($av->time_spent);
						foreach($time_spent as $ts){
							$ttime += $ts->duration;
						}
					}
				}
				$avgtime[] = $ttime;
				
			}else{
				
				$avgtime[] = 0;
				
			}
			
		}
		
		$totalratings = [];
		$k = 1;
		foreach($ratings as $rating){
			$a = $this->db->get_where("tbl_institute_feedbackrating",["institute_id"=>$institute_id,"srating"=>$k])->num_rows();
			$fbs[$rating] = $a;

			$totalratings[] = $a;
			$k++;
			
		}
		
		$data["studentinprogressapps"] = $this->db->get_where("tbl_institute_admission",["institute_id"=>$institute_id,"status"=>"In Progress"])->num_rows();
		$data["studentapprovedapps"] = $this->db->get_where("tbl_institute_admission",["institute_id"=>$institute_id,"status"=>"Approved"])->num_rows();
		$data["studentrejectedapps"] = $this->db->get_where("tbl_institute_admission",["institute_id"=>$institute_id,"status"=>"Rejected"])->num_rows();
		$data["studentmerit"] = $this->db->get_where("tbl_institute_admission",["institute_id"=>$institute_id,"scholaryn"=>"yes"])->num_rows();
		
		
//		echo '<pre>';
//		print_r($avgtime);
//		exit();
		
		$data["students_visited_ebooths"] = $vebsc;
		$data["students_scheduled_meetings"] = $sschm;
		$data["feedback"] = $fbs;
		$data["total_feedback"] = array_sum($totalratings);
		$data["qas"] = $saq;
		$data["average_time"] = $avgtime;
		
		$this->load->view('institute/theme',$data);
	}
	
// svebooth start
	
	public function svebooth(){
		$data['subview'] = "analytics/svebooth";
		$this->load->view('institute/theme',$data);
	}
	
	public function filtersvebooth(){
		
		$institute_id =$this->session->userdata['institute_id'];
		$sdate = $this->input->post("sdate");
		$edate = $this->input->post("edate");
		$location = $this->input->post("location");
		if($location){
			$this->db->where("geolocation",$location);
		}
		if(($sdate != "") && ($edate != "")){
			
			$startdate = date("Y-m-d",strtotime($sdate));
			$enddate = date("Y-m-d",strtotime($edate));
			
			$this->db->order_by("id","desc");
			$this->db->where('date >=', $startdate);
			$this->db->where('date <=', $enddate);
			$this->db->where("institute_id",$institute_id);
			$data = $this->db->get("tbl_student_institute_view_time")->result();

		}else{
			
		 
			$this->db->order_by("id","desc");
			$this->db->where("institute_id",$institute_id);
			$data = $this->db->get("tbl_student_institute_view_time")->result();
			
		}
		$id = 1;
		$jsonData = [];
		foreach($data as $u){
			
			if($u->type == "loggedin"){
				
				$sdata = $this->db->get_where("tbl_students",["student_id"=>$u->student_id])->row();
				$ip = $u->ip_address;
				$geolocation = $u->geolocation;
				$sname = $sdata->student_name;
				$semail = $sdata->email;
				$smobile = $sdata->mobile_number;
				
			}else{
				
				$ip = $u->student_id;
				$geolocation = $u->geolocation;
				$sname = "-";
				$semail = "-";
				$smobile = "-";
				
			}
			
//			if($geolocation==''){$geolocation = $this->institute_model->getGeo($ip);}
			$nData1 = array();
			$nData1["sno"] = $id;
			$nData1["aip"] = $ip;
			$nData1["ageo"] = $geolocation;
			$nData1["st_name"] = $sname;
			$nData1["st_email"] = $semail;
//			$nData1["st_mobile"] = $smobile;
			$nData1["type"] =  ($u->type == "loggedin") ? "Registered" : "Anonymous";
			$nData1["date"] = date("d-m-Y",strtotime($u->date));
			$jsonData[] = $nData1;

		  $id++;
			
		}
		
		$results = ["sEcho" => 1,"iTotalRecords" => count($jsonData),"iTotalDisplayRecords" => count($jsonData),"aaData" => $jsonData ];
		echo json_encode($results);
		
	}
	
// svebooth ends	
	
	
	
// ssmeetings start
	
	public function ssmeetings(){
		$data['subview'] = "analytics/ssmeetings";
		$this->load->view('institute/theme',$data);
	}
	
	public function filterssmeetings(){
		
		$institute_id =$this->session->userdata['institute_id'];
		$sdate = $this->input->post("sdate");
		$edate = $this->input->post("edate");
		
		if(($sdate != "") && ($edate != "")){
			
			$startdate = date("Y-m-d",strtotime($sdate));
			$enddate = date("Y-m-d",strtotime($edate));
			
			$this->db->order_by("exp_std_id","desc");
			$this->db->where('exp_std_date >=', $startdate);
			$this->db->where('exp_std_date <=', $enddate);
			$this->db->where("institute_id",$institute_id);
			$data = $this->db->get("tbl_counsellor_student_schedule")->result();

		}else{
			
			$this->db->order_by("exp_std_id","desc");
			$this->db->where("institute_id",$institute_id);
			$data = $this->db->get("tbl_counsellor_student_schedule")->result();
			
		}
		
		$id = 1;
		$jsonData = [];
		foreach($data as $u){
			
			$sdata = $this->db->get_where("tbl_students",["student_id"=>$u->student_id])->row();
			$cdata = $this->db->get_where("tbl_councellors",["id"=>$u->expert_id,"institute_id"=>$institute_id])->row();
			
			$sname = $sdata->student_name;
			$semail = $sdata->email;
			$smobile = $sdata->mobile_number;

			///Get Participant join time leave time and spend time
			$participant_join_time = '';
			$participant_leave_time = '';
			$session_id = $this->db->get_where("tbl_counsellor_sessions", ["expert_id" => $u->expert_id, "exp_se_date" => $u->exp_std_date, "exp_se_time" => $u->exp_std_time, "duration" => $u->exp_std_duration])->row()->exp_se_id;
			if($session_id!=''){
				$meeting_id = $this->db->get_where("tbl_zoom_meetings", ["councellor_id"=>$u->expert_id, "session_id" => $session_id])->row()->meeting_id;
				if($meeting_id!='' && $meeting_id!='2147483647'){
					$data = $this->zoomParticipants($meeting_id);
					if(isset($data->participants)){
		                foreach ($data->participants as $participant) {
		                    if($participant->user_email==$semail){
		                    	$participant_join_time = date('Y-m-d H:i:s', strtotime($participant->join_time));
		                    	$participant_leave_time = date('Y-m-d H:i:s', strtotime($participant->leave_time));
		                    }
		                }
		            }
				}
			}
			///Get Participant join time leave time and spend time
			
			$nData1 = array();
			$nData1["sno"] = $id;
			$nData1["st_name"] = $sname;
			$nData1["st_email"] = $semail;
			$nData1["st_join_time"] = $participant_join_time;
			$nData1["st_leave_time"] = $participant_leave_time;
//			$nData1["st_mobile"] = $smobile;
			$nData1["cou_name"] = $cdata->expert_name;
			$nData1["cou_dept"] = $cdata->expert_department;
			$nData1["date"] = date("d-m-Y",strtotime($u->exp_std_date));
			$nData1["st_time"] = date("H:i",$u->exp_std_time);
			$nData1["end_time"] = date("H:i",($u->exp_std_time+($u->exp_std_duration*60)));
			$jsonData[] = $nData1;

		  $id++;
			
		}
		
		$results = ["sEcho" => 1,"iTotalRecords" => count($jsonData),"iTotalDisplayRecords" => count($jsonData),"aaData" => $jsonData ];
		echo json_encode($results);
		
	}
	public function zoomParticipants($meeting_id){
		$client = new GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);
        $arr_token = $this->accesstoken->get_access_token();
        $accessToken = $arr_token->access_token;
        $dataArray = [
            "headers" => [
                "Authorization" => "Bearer $accessToken"
            ]
        ];
		try{
			$response = $client->request('GET', '/v2/report/meetings/'.$meeting_id.'/participants', $dataArray);
            $data = json_decode($response->getBody());
            return $data;
		} catch(Exception $e) {
            if( 401 == $e->getCode() ) {
                $refresh_token = $this->accesstoken->get_refersh_token();
     
                $client = new GuzzleHttp\Client(['base_uri' => 'https://zoom.us']);
                $response = $client->request('POST', '/oauth/token', [
                    "headers" => [
                        "Authorization" => "Basic ". base64_encode(CLIENT_ID.':'.CLIENT_SECRET)
                    ],
                    'form_params' => [
                        "grant_type" => "refresh_token",
                        "refresh_token" => $refresh_token
                    ],
                ]);
                $this->accesstoken->update_access_token($response->getBody());
     
                $this->zoomParticipants($meeting_id);
            } else {
                return false;
            }
        }
	}
	
// ssmeetings ends	

	
	
// askedquestions start
	
	public function askedquestions(){
		$data['subview'] = "analytics/askedquestions";
		$this->load->view('institute/theme',$data);
	}
	
	public function filteraskedquestions(){
		
		$institute_id =$this->session->userdata['institute_id'];
		$sdate = $this->input->post("sdate");
		$edate = $this->input->post("edate");
		
		if(($sdate != "") && ($edate != "")){
			
			$startdate = date("Y-m-d",strtotime($sdate));
			$enddate = date("Y-m-d",strtotime($edate));
			
			$data = $this->db->query("select * from tbl_institute_ask_a_question where Date(created_date) >= '$startdate' and Date(created_date) <= '$enddate' and institute_id=$institute_id order by id desc")->result();


		}else{
			
			$this->db->order_by("id","desc");
			$this->db->where("institute_id",$institute_id);
			$data = $this->db->get("tbl_institute_ask_a_question")->result();
			
		}
		
		$id = 1;
		$jsonData = [];
		foreach($data as $u){
			
			$sdata = $this->db->get_where("tbl_students",["student_id"=>$u->student_id])->row();
			
			$sname = $sdata->student_name;
			$semail = $sdata->email;
			$smobile = $sdata->mobile_number;
			
			$nData1 = array();
			$nData1["sno"] = $id;
			$nData1["st_name"] = $sname;
			$nData1["st_email"] = $semail;
//			$nData1["st_mobile"] = $smobile;
			$nData1["query"] = $u->query;
			$nData1["message"] = $u->message;
			if($u->message_date != '0000-00-00'){
				$msg_dt = date('d-m-Y',strtotime($u->message_date));
			}else{
				$msg_dt = '';
			}
			$nData1["message_date"] = $msg_dt;
			$nData1["status"] = $u->status;
			$nData1["date"] = date("d-m-Y",strtotime($u->created_date));
			$jsonData[] = $nData1;

		  $id++;
			
		}
		
		$results = ["sEcho" => 1,"iTotalRecords" => count($jsonData),"iTotalDisplayRecords" => count($jsonData),"aaData" => $jsonData ];
		echo json_encode($results);
		
	}
	
// askedquestions ends	
	
	
// appstatus start
	
	public function appstatus(){
		$data['subview'] = "analytics/appstatus";
		$this->load->view('institute/theme',$data);
	}
	
	public function filterappstatus(){
		
		$institute_id =$this->session->userdata['institute_id'];
		$sdate = $this->input->post("sdate");
		$edate = $this->input->post("edate");
		
		if(($sdate != "") && ($edate != "")){
			
			$startdate = date("Y-m-d",strtotime($sdate));
			$enddate = date("Y-m-d",strtotime($edate));
			
			$data = $this->db->query("select * from tbl_institute_admission where Date(created_date) >= '$startdate' and Date(created_date) <= '$enddate' and institute_id=$institute_id order by id desc")->result();


		}else{
			
			$this->db->order_by("id","desc");
			$this->db->where("institute_id",$institute_id);
			$data = $this->db->get("tbl_institute_admission")->result();
			
		}
		
		$id = 1;
		$jsonData = [];
		foreach($data as $u){
			
			$sdata = $this->db->get_where("tbl_students",["student_id"=>$u->student_id])->row();
			
			$sname = $sdata->student_name;
			$semail = $sdata->email;
			$smobile = $sdata->mobile_number;
			
			$nData1 = array();
			$nData1["sno"] = $id;
			$nData1["st_name"] = $sname;
//			$nData1["st_email"] = $semail;
//			$nData1["st_mobile"] = $smobile;
			$nData1["course"] = $this->db->get_where("tbl_courses",["institute_id"=>$u->institute_id,"course_id"=>$u->course_id])->row()->course_name;
			$nData1["spec"] = $this->db->get_where("tbl_courses",["institute_id"=>$u->institute_id,"course_id"=>$u->course_id])->row()->specialization;
			$nData1["status"] = $u->status;
			$nData1["merit"] = $u->scholaryn;
			$nData1["date"] = date("d-m-Y",strtotime($u->created_date));
			$jsonData[] = $nData1;

		  $id++;
			
		}
		
		$results = ["sEcho" => 1,"iTotalRecords" => count($jsonData),"iTotalDisplayRecords" => count($jsonData),"aaData" => $jsonData ];
		echo json_encode($results);
		
	}
	
// appstatus ends
	

// studentfeedback start
	
	public function studentfeedback(){
		$data['subview'] = "analytics/studentfeedback";
		$this->load->view('institute/theme',$data);
	}
	
	public function filterstudentfeedback(){
		
		$institute_id =$this->session->userdata['institute_id'];
		$sdate = $this->input->post("sdate");
		$edate = $this->input->post("edate");
		
		if(($sdate != "") && ($edate != "")){
			
			$startdate = date("Y-m-d",strtotime($sdate));
			$enddate = date("Y-m-d",strtotime($edate));
			
			$data = $this->db->query("select * from tbl_institute_feedbackrating where Date(created_date) >= '$startdate' and Date(created_date) <= '$enddate' and institute_id=$institute_id order by id desc")->result();

		}else{
			
			$this->db->order_by("id","desc");
			$this->db->where("institute_id",$institute_id);
			$data = $this->db->get("tbl_institute_feedbackrating")->result();
			
		}
		
		$id = 1;
		$jsonData = [];
		foreach($data as $u){
			
				
			$sdata = $this->db->get_where("tbl_students",["student_id"=>$u->student_id])->row();
			$ip = "-";
			$sname = $sdata->student_name;
			$semail = $sdata->email;
			$smobile = $sdata->mobile_number;
		
			
			$nData1 = array();
			$nData1["sno"] = $id;
			$nData1["st_name"] = $sname;
			$nData1["st_email"] = $semail;
			$nData1["st_mobile"] = $u->comment;
			$nData1["rating"] =  '<label class="badge badge-success">'.$u->srating.'</label>';
			$nData1["date"] = date("d-m-Y",strtotime($u->created_date));
			$jsonData[] = $nData1;

		  $id++;
			
		}
		
		$results = ["sEcho" => 1,"iTotalRecords" => count($jsonData),"iTotalDisplayRecords" => count($jsonData),"aaData" => $jsonData ];
		echo json_encode($results);
		
	}
	
// studentfeedback ends	
	
		
// studentlogintime start
	
	public function studentlogintime(){
		$data['subview'] = "analytics/studentlogintime";
		$this->load->view('institute/theme',$data);
	}
	
	public function filterstudentlogintime(){
		
		$institute_id =$this->session->userdata['institute_id'];
		$sdate = $this->input->post("sdate");
		$edate = $this->input->post("edate");
		$location = $this->input->post("location");
		if($location){
			$this->db->where("geolocation",$location);
		}
		if(($sdate != "") && ($edate != "")){
			
			$startdate = date("Y-m-d",strtotime($sdate));
			$enddate = date("Y-m-d",strtotime($edate));
			
			$this->db->order_by("id","desc");
			$this->db->where('date >=', $startdate);
			$this->db->where('date <=', $enddate);
			$this->db->where("institute_id",$institute_id);
			$data = $this->db->get("tbl_student_institute_view_time")->result();

		}else{
			
			$this->db->order_by("id","desc");
			$this->db->where("institute_id",$institute_id);
			$data = $this->db->get("tbl_student_institute_view_time")->result();
			
		}
		
		$id = 1;
		$jsonData = [];
		foreach($data as $u){
			
			$ttime = 0;
			$time_spent = json_decode($u->time_spent);
			foreach($time_spent as $ts){
				$ttime += $ts->duration;
			}
			
			$duration = $this->convertToHoursMins($ttime,'%02d : %02d hr');
				
			if($u->type == "loggedin"){
				
				$sdata = $this->db->get_where("tbl_students",["student_id"=>$u->student_id])->row();
				$ip = $u->ip_address;
				$geolocation = $u->geolocation;
				$sname = $sdata->student_name;
				$semail = $sdata->email;
				$smobile = $sdata->mobile_number;
				
			}else{
				
				$ip = $u->student_id;
				$geolocation = $u->geolocation;
				$sname = "-";
				$semail = "-";
				$smobile = "-";
				
			}
		
			
//			if($geolocation==''){$geolocation = $this->institute_model->getGeo($ip);}
			$nData1 = array();
			$nData1["sno"] = $id;
			$nData1["aip"] = $ip;
			$nData1["ageo"] = $geolocation;
			$nData1["st_name"] = $sname;
			$nData1["st_email"] = $semail;
//			$nData1["st_mobile"] = $smobile;
			$nData1["type"] =  ($u->type == "loggedin") ? "Registered" : "Anonymous";
			$nData1["date"] = date("d-m-Y",strtotime($u->date));
			$nData1["start_time"] = date("d-m-Y H:i:s",strtotime($u->start_time));
			$nData1["end_time"] = ($u->end_time != "0000-00-00 00:00:00") ? date("d-m-Y H:i:s",strtotime($u->end_time)) : '';
			$nData1["duration"] = ($u->end_time != "0000-00-00 00:00:00") ? $duration : '';
			$jsonData[] = $nData1;

		  $id++;
			
		}
		
		$results = ["sEcho" => 1,"iTotalRecords" => count($jsonData),"iTotalDisplayRecords" => count($jsonData),"aaData" => $jsonData ];
		echo json_encode($results);
		
	}
	
// studentlogintime ends	
	
	public function getHours($from_time,$to_time){
		
//		$cdate = date("Y-m-d");
		$start_date = new DateTime($from_time);
		$since_start = $start_date->diff(new DateTime($to_time));
		$minutes = $since_start->days * 24 * 60;
		$minutes += $since_start->h * 60;
		$minutes += $since_start->i;
		
		$hours = floor($minutes / 60);
		$min = $minutes - ($hours * 60);

		return $hours.":".$min." hr";
		
//		return $minutes;
		
	}
	
	function convertToHoursMins($time, $format = '%02d:%02d') {
		if ($time < 1) {
			return;
		}
		$hours = floor($time / 60);
		$minutes = ($time % 60);
		return sprintf($format, $hours, $minutes);
	}
		
		
}
