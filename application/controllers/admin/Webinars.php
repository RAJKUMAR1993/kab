<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');

class Webinars extends CI_Controller {
	public $selected_dates = array();
	public function __construct()
	    {
	        parent::__construct();
	        if($this->session->userdata['login_type']!='admin'){redirect('admin');}
			$today = date("Y-m-d");
			$wdates = $this->db->where("date >= ", $today)->get("tbl_webinar_dates")->result();
			foreach ($wdates as $w) {
				$this->selected_dates[] = $w->date;
			}
	    }

	public function index()
	{
		$data['webinors'] = $this->db->order_by("date ","desc")->get("tbl_webinors")->result();
		$data['subview'] = "webinors/webinors";
		$this->load->view('admin/theme',$data);
	}
	
	public function add(){
		$webinar_id = $this->uri->segment(4);
		if($webinar_id){
			$webinar = $this->db->where("id",$webinar_id)->get("tbl_webinors")->row();
			$zoom_meeting = $this->db->where("webinar_id", $webinar_id)->get("tbl_zoom_meetings")->result();
			$data['webinor'] = $webinar;
			$data['zoom_meeting'] = $zoom_meeting;
		}else{
			$data['webinor'] = "";
			$data['zoom_meeting'] = "";
		}
		$data['selected_dates'] = $this->selected_dates;
		$institute_id =$this->session->userdata['admin_id'];
		$type =$this->session->userdata['login_type'];
		$data['professors'] = $this->db->where("is_deleted",0)->where("pro_status","Active")->get("tbl_professors")->result();
		$data['speakers'] = $this->db->where("is_deleted",0)->where("speaker_status","Active")->get("tbl_speakers")->result();
		$data['guests'] = $this->db->get("tbl_webinar_guests")->result();
		$data['subview'] = "webinors/add_webinor";
		$this->load->view('admin/theme',$data);
	}
	

	public function save_webinor(){
		
		$id = $this->input->post("webinor_id");
		$date = $this->input->post("date");
		//$selected_dates = array("2020-08-05", "2020-08-06", "2020-08-07");
		if(in_array($date, $this->selected_dates)){
			$from_time = $ftime = $this->input->post("from_time");
			$to_time = $ttime = $this->input->post("to_time");
			$professor_ids = $this->input->post("professor_ids");
			$guest_ids = $this->input->post("guest_ids");
			$speaker_ids = $this->input->post("speaker_ids");
			$title = $this->input->post("title");
			if($date!='' && $date!='0000:00:00' && $from_time!='' && $from_time!='00:00' && $to_time!='' && $to_time!='00:00'){
				$from_time = $date.' '.$from_time;
				$to_time = $date.' '.$to_time;
				$checkCount = 0;
				if(count($professor_ids)>0 || count($guest_ids)>0){
					$msg = '';
					if(count($professor_ids)>0){
						foreach($professor_ids as $professor_id){
							$sql = "SELECT * FROM tbl_webinors WHERE date='".$date."' AND (('".strtotime($from_time)."'>=from_time AND '".strtotime($from_time)."'<=to_time) OR ('".strtotime($to_time)."'>=from_time AND '".strtotime($to_time)."'<=to_time)) AND FIND_IN_SET(".$professor_id.", professor_ids)";//"professor_id like %,".$professor_id.",% OR ".$professor_id.",% OR %,".$professor_id
							if($id!=''){
								$sql .= " AND id!=".$id;
							}
							$check = $this->db->query($sql);
							if($check->num_rows() > 0){
								$msg = 'A Webinar is already created for one of these professors at this date and time.';
								$checkCount++;
							}
						}
					}
					if(count($guest_ids)>0){
						foreach($guest_ids as $guest_id){
							$sql = "SELECT * FROM tbl_webinors WHERE date='".$date."' AND (('".strtotime($from_time)."'>=from_time AND '".strtotime($from_time)."'<=to_time) OR ('".strtotime($to_time)."'>=from_time AND '".strtotime($to_time)."'<=to_time)) AND FIND_IN_SET(".$guest_id.", guest_ids)";
							if($id!=''){
								$sql .= " AND id!=".$id;
							}
							$check = $this->db->query($sql);
							if($check->num_rows() > 0){
								$msg .= ' A Webinar is already created for one of these guests at this date and time.';
								$checkCount++;
							}
						}
					}
					if(count($speaker_ids)>0){
						foreach($speaker_ids as $speaker_id){
							$sql = "SELECT * FROM tbl_webinors WHERE date='".$date."' AND (('".strtotime($from_time)."'>=from_time AND '".strtotime($from_time)."'<=to_time) OR ('".strtotime($to_time)."'>=from_time AND '".strtotime($to_time)."'<=to_time)) AND FIND_IN_SET(".$speaker_id.", speaker_ids)";
							if($id!=''){
								$sql .= " AND id!=".$id;
							}
							$check = $this->db->query($sql);
							if($check->num_rows() > 0){
								$msg .= ' A Webinar is already created for one of these speaker at this date and time.';
								$checkCount++;
							}
						}
					}
					
					if($checkCount == 0){

						if($_FILES['picture']['name'] != ""){
						    $config['upload_path'] = 'assets/images/webinars';
			                $config['allowed_types'] = 'jpg|jpeg|png';
			                $config['file_name'] = $_FILES['picture']['name'];				 
							
							$this->load->library('upload',$config);
			                $this->upload->initialize($config);
			                
			                if($this->upload->do_upload('picture')){
			                    $uploadData = $this->upload->data();
			                    $picture = $uploadData['file_name'];
			                }else{
			                    $picture = '';
			                }
						}else{
							$picture = $this->input->post("image");
						}

						if($_FILES['view_image']['name'] != ""){
						    $config['upload_path'] = 'assets/images/webinars';
			                $config['allowed_types'] = 'jpg|jpeg|png';
			                $config['file_name'] = $_FILES['view_image']['name'];				 
							
							$this->load->library('upload',$config);
			                $this->upload->initialize($config);
			                
			                if($this->upload->do_upload('view_image')){
			                    $uploadData = $this->upload->data();
			                    $view_image = $uploadData['file_name'];
			                }else{
			                    $view_image = '';
			                }
						}else{
							$view_image = $this->input->post("image");
						}

						$data = array(
							"title" => $title,
							"description" => $this->input->post("description"),
							"date" => $date,
							"from_time" => strtotime($from_time),
							"to_time" => strtotime($to_time),
							"professor_ids" => implode(',', $professor_ids),
							"guest_ids" => implode(',', $guest_ids),
							"speaker_ids" => implode(',', $speaker_ids),
							"image" => $picture,
							"view_image" => $view_image
						);

						if($id){
							$this->db->where("id",$id)->update("tbl_webinors",$data); 
							$data1 = ["Status"=>'Active',"Message"=>"Webinor Updated Successfully."];
						}else{
							$query = $this->db->insert("tbl_webinors", $data);
							$id = $this->db->insert_id();
							$data1=["Status"=>'Active',"Message"=>"Webinor Added Successfully."];
							// echo json_encode($data1);
							// exit();
						}
						$start_time = $date.'T'.$ftime.':00';

						$date1 = new DateTime($date.'T'.$ftime.':00');
						$date2 = new DateTime($date.'T'.$ttime.':00');
					   
					    $diff = $date2->diff($date1);
					   
					    $duration = $diff->format('%h');
						//Create Zoom meeting
						$meeting = $this->accesstoken->create_meeting($user_type=0, $title, $start_time, $duration, $id, implode(',', $professor_ids), $flag=1);
						//Create Zoom meeting
						echo json_encode($data1);
						exit();
					}
					else{
						$data1=["Status"=>'Inactive',"Message"=>$msg];
					    echo json_encode($data1);
					    exit();
					}
				}
				else{
					$data1=["Status"=>'Inactive',"Message"=>"Please select at least one professor OR one guest."];
				    echo json_encode($data1);
				    exit();
				}
			}
			else{
				$data1=["Status"=>'Inactive',"Message"=>"Date, From Time, To Time are required."];
			    echo json_encode($data1);
			    exit();
			}
		}
		else{
			$data1=["Status"=>'Inactive',"Message"=>"The selected date is not allowed to create webinar."];
		    echo json_encode($data1);
		    exit();
		}
	}

	public function delete_webinor(){
		if($this->uri->segment(4)){
			$id =$this->uri->segment(4);
			$query = $this->db->where("id",$id)->delete("tbl_webinors");
			if($query){ redirect("admin/webinors");}
		}
	}
	
	public function participants()
	{
		$data['webinars'] = $this->db->query("SELECT tbl_webinar_participants.*, tbl_webinors.*, tbl_students.student_name FROM tbl_webinar_participants LEFT JOIN tbl_webinors ON tbl_webinors.id=tbl_webinar_participants.webinar_id LEFT JOIN tbl_students ON tbl_students.student_id=tbl_webinar_participants.webinar_student_id WHERE tbl_webinar_participants.webinar_id='".$this->uri->segment(4)."' ORDER BY tbl_webinors.date DESC ")->result();
		$data['subview'] = "webinors/participants";
		$this->load->view('admin/theme',$data);
	}
	public function webinar_dates()
	{
		$data['webinar_dates'] = $this->db->select("*")->order_by("date", "ASC")
		->get("tbl_webinar_dates")
		->result();
		$data['subview'] = "webinors/webinar_dates";
		$this->load->view('admin/theme',$data);
	}
	public function add_date(){
		$wdate_id = $this->uri->segment(4);
		if($wdate_id){
			$wdate = $this->db->where("id",$wdate_id)->get("tbl_webinar_dates")->row();
			$data['wdate'] = $wdate;
		}else{
			$data['wdate'] = "";
		}
		$data['subview'] = "webinors/add_date";
		$this->load->view('admin/theme',$data);
	}
	public function save_webinar_date(){
		$id = $this->input->post("wdate_id");
		$date = $this->input->post("date");
		if($date!='' && $date!='0000:00:00'){
			$check = $this->db->select("*")->where("date", $date);
			if($id!=''){
				$check = $check->where("id !=", $id);
			}
			$check = $check->get("tbl_webinar_dates");
			if($check->num_rows() == 0){
				$data = array(
					"date" => $date
				);

				if($this->uri->segment(4)){

					$this->db->where("id",$id)->update("tbl_webinar_dates",$data); 
					
					$data1 = ["Status"=>'Active',"Message"=>"Date Updated Successfully."];
				}else{
					$query = $this->db->insert("tbl_webinar_dates", $data);
					$data1=["Status"=>'Active',"Message"=>"Date Added Successfully."];
				}
				echo json_encode($data1);
				exit();
			}
			else{
				$data1=["Status"=>'Inactive',"Message"=>"This date is already there."];
			    echo json_encode($data1);
			    exit();
			}
		}
		else{
			$data1=["Status"=>'Inactive',"Message"=>"Date is required."];
		    echo json_encode($data1);
		    exit();
		}
	}

	public function delete_webinar_date(){
		if($this->uri->segment(4)){
			$id =$this->uri->segment(4);
			$query = $this->db->where("id",$id)->delete("tbl_webinar_dates");
			if($query){ redirect("admin/webinors/webinar_dates");}
		}
	}
	public function guests(){
		$data['guests'] = $this->db->get("tbl_webinar_guests")->result();
		$data['subview'] = "webinors/webinar_guests";
		$this->load->view('admin/theme',$data);
	}
	public function add_guest(){
		$guest_id = $this->uri->segment(4);
		if($guest_id){
			$guest = $this->db->where("id", $guest_id)->get("tbl_webinar_guests")->row();
			$data['guest'] = $guest;
		}else{
			$data['guest'] = "";
		}
		$data['subview'] = "webinors/add_guest";
		$this->load->view('admin/theme',$data);
	}
	public function save_guest(){
		$id = $this->input->post("guest_id");
		$email = $this->input->post("email");
		if($_FILES['picture']['name'] != ""){
			    $config['upload_path'] = 'assets/images/guests';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['picture']['name'];				 
				$this->load->library('upload',$config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('picture')){
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                }else{
                    $picture = '';
                }
		}else{
			$picture = $this->input->post("image");
		}
		$check = $this->db->select("*")->where("email", $email);
		if($id!=''){
			$check = $check->where("id !=", $id);
		}
		$check = $check->get("tbl_webinar_guests");
		if($check->num_rows() == 0){
			$data = array(
				"name" => $this->input->post("name"),
				"designation" => $this->input->post("designation"),
				"qualification" => $this->input->post("qualification"),
				"mobile_no" => $this->input->post("mobile_no"),
				"current_organization" => $this->input->post("current_organization"),
				"work_exp" => $this->input->post("work_exp"),
				"specialization" => $this->input->post("specialization"),
				"languages" => $this->input->post("languages"),
				"about_yourself" => $this->input->post("about_yourself"),
				"linkedin_profile" => $this->input->post("linkedin_profile"),
				"twitter" => $this->input->post("twitter"),
				"instagram" => $this->input->post("instagram"),
				"youtube" => $this->input->post("youtube"),
				"facebook" => $this->input->post("facebook"),
				"image" => $picture,
				"email" => $email,
			);
			if($id){
				$this->db->where("id",$id)->update("tbl_webinar_guests",$data); 
				$data1 = ["Status"=>'Active',"Message"=>"Webinar Guest Updated Successfully."];
			}else{
				$query = $this->db->insert("tbl_webinar_guests", $data);
				$id = $this->db->insert_id();
				$data1=["Status"=>'Active',"Message"=>"Webinar Guest Added Successfully."];
			}
			echo json_encode($data1);
			exit();
		}
		else{
			$data1=["Status"=>'Inactive',"Message"=>"A Webinar Guest is already there with this email id."];
		    echo json_encode($data1);
		    exit();
		}
	}
	public function delete_guest(){
		if($this->uri->segment(4)){
			$id =$this->uri->segment(4);
			$query = $this->db->where("id",$id)->delete("tbl_webinar_guests");
			if($query){ redirect("admin/webinors/guests");}
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
			
			redirect("admin/webinars");
			
		}
		
	}

}
