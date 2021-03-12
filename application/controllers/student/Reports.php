<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		//$this->load->library('excel');
		if($this->session->userdata['login_type']!='student'){redirect('student/login');}

	}

	
	public function index()
	{
		$id = $this->session->userdata['student_id'];
		$data['details'] = $this->db->query("SELECT tbl_institute_admission.*,tbl_courses.* FROM tbl_institute_admission LEFT JOIN tbl_courses ON tbl_institute_admission.course_id = tbl_courses.course_id WHERE tbl_institute_admission.student_id='".$this->session->userdata['student_id']."' GROUP BY tbl_institute_admission.institute_id ORDER BY id DESC")->num_rows();
		$data['councellormeetings'] = $this->db->query("SELECT tbl_counsellor_student_schedule.*,tbl_councellors.expert_name FROM tbl_counsellor_student_schedule LEFT JOIN tbl_councellors ON tbl_counsellor_student_schedule.expert_id = tbl_councellors.id WHERE tbl_counsellor_student_schedule.student_id='".$this->session->userdata['student_id']."' AND tbl_councellors.is_deleted='0' AND tbl_counsellor_student_schedule.is_deleted='0' AND tbl_councellors.expert_status='Active' ORDER BY exp_std_date DESC ")->num_rows();
		$data['webinars'] = $this->db->query("SELECT tbl_webinar_participants.*, tbl_webinors.*,tbl_professors.pro_name FROM tbl_webinar_participants LEFT JOIN tbl_webinors ON tbl_webinors.id=tbl_webinar_participants.webinar_id LEFT JOIN tbl_professors ON tbl_professors.pro_id=tbl_webinors.professor_id WHERE tbl_webinar_participants.webinar_student_id='".$this->session->userdata['student_id']."' ORDER BY tbl_webinors.date DESC ")->num_rows();
		$data['enquries'] = $this->db->query("SELECT * FROM tbl_institute_ask_a_question  WHERE student_id='".$this->session->userdata['student_id']."' ORDER BY id DESC")->num_rows();

		$data['meetings'] =        $this->db->select(' tpm.*,tp.pro_name')
											->from('tbl_professor_meeting as tpm')
											->where('tpm.session_student_id', $id)
											->join('tbl_professors as tp', 'tpm.session_pro_id = tp.pro_id', 'LEFT')
											->get()->num_rows();
		$data['expertmeetings'] =  $this->db->select(' tep.*,texp.*')
											->from('tbl_expert_student_schedule as tep')
											->where('tep.student_id', $id)
											->join('tbl_experts as texp', 'texp.expert_id = tep.expert_id', 'LEFT')
											->get()->num_rows();	

		//echo $this->db->last_query();die();
		//echo "<pre/>";print_r($data['enquries'] );die;

		$data['subview'] = "reports/reports";
		$this->load->view('student/theme',$data);
	}
// chat start
	
	public function chathistory(){
		$institute_id =$this->session->userdata['institute_id'];
		$data['subview'] = "reports/chathistory";
		$data['chat'] = $this->db->group_by("student_id")->order_by("id","desc")->get_where("tbl_institute_student_chat_history",["institute_id"=>$institute_id])->result();
		$this->load->view('student/theme',$data);
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
		$this->load->view('student/theme',$data);
		
	}
	
		
}
