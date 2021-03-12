<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auditorium extends CI_Controller {
	public function __construct()
	    {
	        parent::__construct();
	        if($this->session->userdata['login_type']!='admin'){redirect('admin/login');}
	    }

	public function add_auditorium()
	{
		if($this->uri->segment(4)){
			$data['webinor'] = $this->db->get_where("tbl_institute_auditorium",["id"=>$this->uri->segment(4)])->row();
		}else{
			$data['webinor'] = "";
		}
		$data['subview'] ="auditorium/add_auditorium";
		$this->load->view('admin/theme',$data);
	}

	public function video()
	{
		$data['webinors'] = $this->db->get_where("tbl_institute_auditorium")->result();
		$data['subview'] ="auditorium/auditorium";
		$this->load->view('admin/theme',$data);
	}
	
	public function presentations(){
		$date = $this->input->get("date");
		$auditorium = $this->input->get("auditorium");
		
		if($auditorium){
			
			$this->db->where("auditorium",$auditorium);
			
		}
		if($date){
			
			$this->db->where("date",$date);
			
		}
		$data['sessions'] = $this->db->order_by("id","desc")->where("status","Active")->get("tbl_institute_presentations")->result();
		$data['subview'] = "auditorium/sessions";
		$this->load->view('admin/theme',$data);
		
	}
	
	public function save_auditorium(){
		$id = $this->input->post("webinor_id");
		$date = $this->input->post("date");
		$from_time = $this->input->post("from_time");
		$to_time = $this->input->post("to_time");
		$title = $this->input->post("title");
			
		if($date!='' && $date!='0000:00:00' && $from_time!='' && $from_time!='00:00' && $to_time!='' && $to_time!='00:00'){
				
			$from_time = $from_time;
			$to_time = $to_time;

				$check = $this->db->where("date", $date)->where("title",$title);
				if($id!=''){
					$this->db->where("id !=", $id);
				}
				$check = $this->db->get("tbl_institute_auditorium");
				if($check->num_rows() == 0){
					$data = array(
						"title" => $title,
						"date" => $date,
						"from_time" => strtotime($from_time),
						"to_time" => strtotime($to_time)
					);

					if($this->uri->segment(4)){

						$this->db->where("id",$id)->update("tbl_institute_auditorium",$data); 
						
						$data1 = ["Status"=>'Active',"Message"=>"Auditorium Updated Successfully."];
					}else{
						$query = $this->db->insert("tbl_institute_auditorium", $data);
						$id = $this->db->insert_id();
						$data1=["Status"=>'Active',"Message"=>"Auditorium Added Successfully."];
						// echo json_encode($data1);
						// exit();
					}
					echo json_encode($data1);
					exit();
				}
				else{
					$data1=["Status"=>'Inactive',"Message"=>"Auditorium is already created with this title at this date."];
				    echo json_encode($data1);
				    exit();
				}
			}else{
				$data1=["Status"=>'Inactive',"Message"=>"Date, From Time, To Time are required."];
			    echo json_encode($data1);
			    exit();
			}
		
	}
  
	public function delete_auditorium(){
		if($this->uri->segment(4)){
			$id =$this->uri->segment(4);
			$query = $this->db->where("id",$id)->delete("tbl_institute_auditorium");
			if($query){ redirect("admin/auditorium/video");}
		}
	}
	
	public function updateSession(){
		
		$se_id = $this->input->post("session_id");
		$auditorium = $this->input->post("auditorium");
		
		$selected_dates = [];
		$today = date("Y-m-d");
		$wdates = $this->db->where("date >= ", $today)->get("tbl_webinar_dates")->result();
		foreach ($wdates as $w) {
			$selected_dates[] = $w->date;
		}
		
		
		$sessdata = $this->db->get_where("tbl_institute_presentations",["id"=>$se_id])->row();
		
		$institution_id = $sessdata->institute_id;
		$date = $sessdata->date;
		$from_time = $sessdata->from_time;
		$to_time = $sessdata->to_time;
		
		if(!in_array($date, $selected_dates)){
			
			$data1=["Status"=>'Inactive',"Message"=>"The selected date is not allowed to create presentation."];
		    echo json_encode($data1);
		    exit();
			
		}
		
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
		
		
		$checkAuditorium = $this->checkAuditorium($date,$from_time,$to_time,$se_id,$auditorium);
//		print_r($checkAuditorium);
//		exit();
		
		if($checkAuditorium){
			
			$auditorium = $checkAuditorium;
			
		}else{
			
			$data1=["Status"=>'Inactive',"Message"=>"Auditoriums are not available on this date and time."];
			echo json_encode($data1);
			exit();
			
		}
		
		
		if($date!='' && $date!='0000:00:00' && $from_time!='' && $from_time!='00:00' && $to_time!='' && $to_time!='00:00'){
				        		
				$data = array(
					"auditorium" => $auditorium,
					"status"=>"Active"
				);		
				$this->db->where("id",$se_id)->update("tbl_institute_presentations",$data);
				$data1=["Status"=>'Active',"Message"=>"Successfully Updated."];
				
				$start_time = $date.'T'.date('H:i:s', $from_time);
				//Create Zoom meeting
				$meeting = $this->accesstoken->create_meeting($user_type=5, $sessdata->title, $start_time, $chkminutes, $se_id, $institution_id);
			
				$zoomdata = $this->db->get_where("tbl_zoom_meetings",["user_id"=>$institution_id,"session_id"=>$se_id])->row();
				$this->db->where("id",$se_id)->update("tbl_institute_presentations",["zoom_meeting_link"=>$zoomdata->meeting_link,"zoom_password"=>$zoomdata->meeting_password]);
			
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

	public function checkAuditorium($date,$from_time,$to_time,$sid,$auditorium){
		
//		return $from_time." ".$to_time;
		
		$data = "";
		
		if($sid != ""){

			$this->db->where("id !=",$sid);

		}		
		$this->db->where(["date"=>date("Y-m-d",strtotime($date)),"auditorium"=>$auditorium,"status"=>"Active"]);
		$this->db->where("from_time between $from_time AND $to_time");
		$this->db->where("to_time between $from_time AND $to_time");

		$data = $this->db->get("tbl_institute_presentations")->result();
		

		if(empty($data)){

//				$this->db->where("from_time between $from_time AND $to_time");
//				$this->db->or_where("to_time between $from_time AND $to_time");
			$this->db->where("from_time <= $from_time AND to_time >= $from_time");
			$this->db->where("from_time <= $to_time AND to_time >= $to_time");
			$this->db->where(["date"=>date("Y-m-d",strtotime($date)),"id"=>$auditorium]);
			$audi = $this->db->get_where("tbl_institute_auditorium")->row();

			if($audi){

				return $audi->id;

			}

		}
		
		return "";
		
	}
	
	public function getMinutes($from_time,$to_time){
		
		$cdate = date("Y-m-d");
		$start_date = new DateTime(''.$cdate.' '.date("H:i",$from_time).':00');
		$since_start = $start_date->diff(new DateTime(''.$cdate.' '.date("H:i",$to_time).':00'));
		$minutes = $since_start->days * 24 * 60;
		$minutes += $since_start->h * 60;
		$minutes += $since_start->i;
		return $minutes;
		
	}	
	
	public function auditorium_presentations()
	{
		
		$date = $this->input->get("date");
		$auditorium = $this->input->get("auditorium");
		
		if($auditorium){
			
			$this->db->where("auditorium_id",$auditorium);
			
		}
		if($date){
			
			$this->db->where("date",$date);
			
		}
		$data['webinars'] = $this->db->order_by("id","desc")->get_where("tbl_student_auditorium_presentations")->result();
		
		$data['subview'] = "auditorium/auditorium_presentations";
		$this->load->view('admin/theme',$data);
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
			
			redirect("counsellor/meetings");
			
		}
		
	}
	
}
