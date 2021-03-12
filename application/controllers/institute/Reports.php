<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		//$this->load->library('excel');
		if($this->session->userdata['login_type']!='institute'){redirect('institute/login');}
	}

	
	public function index()
	{
		$institute_id =$this->session->userdata['institute_id'];
		$data['experts'] = $this->db->get_where("tbl_councellors",["institute_id"=>$institute_id,"is_deleted"=>0])->num_rows();
		$data['chat'] = $this->db->group_by("student_id")->get_where("tbl_institute_student_chat_history",["institute_id"=>$institute_id])->num_rows();
		$data["video"] = $this->db->query("SELECT  * FROM tbl_college_connect  WHERE institute_id = '$institute_id' AND  play_url != '' ")->num_rows();
		$data["text"] = $this->db->query("SELECT  converted_text FROM tbl_college_connect  WHERE institute_id = '$institute_id' ")->num_rows();
		$data['videos'] = $this->db->query("SELECT a.*, d.play_url FROM tbl_counsellor_student_schedule a INNER JOIN tbl_zoom_meetings d ON a.zoom_link = d.meeting_link WHERE d.play_url != '' and a.institute_id= '$institute_id'")->num_rows();
		$data['convertedtext'] = $this->db->query("SELECT a.*, d.converted_text FROM tbl_counsellor_student_schedule a INNER JOIN tbl_zoom_meetings d ON a.zoom_link = d.meeting_link WHERE d.converted_text != '' and a.institute_id= '$institute_id'")->num_rows();
		$data["convertedtext1"] = $this->db->query("SELECT * FROM tbl_student_auditorium_presentations JOIN tbl_zoom_meetings on tbl_student_auditorium_presentations.zoom_link=tbl_zoom_meetings.meeting_link WHERE tbl_student_auditorium_presentations.institute_id = '$institute_id' and tbl_zoom_meetings.converted_text != ''")->num_rows();
		//echo $this->db->last_query();die();
		//print_r();die;

		$data['subview'] = "reports/reports";
		$this->load->view('institute/theme',$data);
	}
// chat start
	
	public function chathistory(){
		$institute_id =$this->session->userdata['institute_id'];
		$data['subview'] = "reports/chathistory";
		$data['chat'] = $this->db->group_by("student_id")->order_by("id","desc")->get_where("tbl_institute_student_chat_history",["institute_id"=>$institute_id])->result();
		$this->load->view('institute/theme',$data);
	}
	
	public function getChat($ssid=""){
		
		$institute_id =$this->session->userdata['institute_id'];
			
		if($ssid){
			
			$sid = $ssid;
			
		}else{
			
			$sid = $this->input->post("sid");
			
		}
		$ref = $this->input->post("ref");
		$data = $this->db->get_where("tbl_institute_student_chat_history",["institute_id"=>$institute_id,"student_id"=>$sid])->result();
		$sname = $this->db->get_where("tbl_students",["student_id"=>$sid])->row()->student_name;

		if($ref == "view"){
		
			$chat = "";
			if(count($data) > 0){

				$chat =	'<div class="container-fluid h-100">
							<div class="row justify-content-center h-100">

								<div class="col-md-12 chat">
									<div class="card">
										<div class="card-header msg_head" style="background-color: rgb(77 86 130);">
											<div class="d-flex bd-highlight">

												<div class="user_info row">
													<div class="col-md-9"><span>Chat History of '.$sname.'</span></div>
													<div class="col-md-2"><a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Close Chat"><span style="margin-left:60px;" class="closeChat"><i class="fa fa-close"></i></span></a></div>	
												</div>
											</div>

										</div>
										<div class="card-body msg_card_body" style="height: 400px;border: 1px solid darkgrey;">';

											foreach($data as $row){ 

										$chat .=   '<div class="d-flex justify-content-start mb-4">

														<div class="msg_cotainer">
															'.$row->student_message.'
															<span class="msg_time">'.date("M-d h:i a",strtotime($row->created_date)).'</span>
														</div>
													</div>
													<div class="d-flex justify-content-end mb-4">
														<div class="msg_cotainer_send">
															'.$row->institute_reply.'
															<span class="msg_time_send">'.date("M-d h:i a",strtotime($row->created_date)).'</span>
														</div>

													</div>';

											 } 	

									$chat .= '</div>

									</div>
								</div>
							</div>
						</div>';

			}else{

				$chat = '<p style="font-size:18px;font-weight:500;text-align:center">No Chat Found</p>';

			}

			echo $chat;
			
		}elseif($ssid != ""){
			
			$fdata = [];
			foreach($data as $row){
				
				$ndata = [];
				$ndata["student_message"] = $row->student_message;
				$ndata["institute_reply"] = $row->institute_reply;
				$ndata["date"] = $row->created_date;
				$fdata[] = $ndata;
				
			}

			header('Content-Type: application/json');
			header('Content-Disposition: attachment; filename='.trim($sname).'.json');
			header('Pragma: no-cache');
			echo json_encode($fdata);
			exit();
		}
		
	}
	
// chat ends
	
	public function geolocstudents(){
		
		$institute_id =$this->session->userdata['institute_id'];
		$data['subview'] = "reports/geolocstudents";
		$data['chat'] = $this->db->query("SELECT geolocation,COUNT(institute_id) as count from tbl_student_institute_view_time where institute_id='$institute_id' and geolocation != '' GROUP BY geolocation order by geolocation asc")->result();
		$this->load->view('institute/theme',$data);
		
	}
	
		
}
