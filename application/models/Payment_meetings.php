<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_meetings extends CI_Model {  
	
	public function __construct(){
		parent::__construct();
		$this->admin_email = $this->login_model->get_option("admin_email_id")->email;
	}
  
    public function saveprofessorMeeting($oid){

		$odata = $this->db->get_where("tbl_orders",array("order_id"=>$oid))->row();
		$sesdata = json_decode($odata->session_data);
		$sdata = json_decode($odata->student_data);
		
		$insert_id = $odata->student_id;
		
		if($insert_id){				
			$zoom_meeting = $this->db->where("professor_id", $odata->creator_id)->where("session_id", $odata->session_id)->get("tbl_zoom_meetings")->result();
			$zoom_link = '';
			$zoom_password = '';
			if(isset($zoom_meeting[0]->meeting_link)){ $zoom_link = $zoom_meeting[0]->meeting_link;}
			if(isset($zoom_meeting[0]->meeting_password)){ $zoom_password = $zoom_meeting[0]->meeting_password;}
			$data2 = array(
				"session_pro_id" => $odata->creator_id,
				"session_student_id" => $insert_id,
				"session_type" => $sesdata->duration,
				"session_cost" => $sesdata->amount,
				"session_date" => $sesdata->pro_se_date,
				"session_time" => $sesdata->pro_se_time,
				"zoom_link" => $zoom_link,
				"zoom_password" => $zoom_password,
			//"request_session_time" => $post["request_session"],
			);
			$password = $this->session->userdata('sessionUserPassword');
			if(isset($password)){
				$data2['link'] = "https://us04web.zoom.us/j/5948139849";
			}
			//echo '<pre>';print_r($data2);exit;
			$this->db->insert("tbl_professor_meeting",$data2);
			if(isset($password)){
				$msg = '<html><body><small>User ID : '.$sdata->student_email.'</small><br> <small>Password : '.$this->student_login_model->api_key_crypt( $password,"d").'</small></body></html>';
				$from = "$this->admin_email";
				$subject = "Login Details : KAB Education Fair";
				$to = $post['student_email'];
				$re = $this->login_model->sendMail($from,$to,$subject,$msg);
			}
            
			$this->session->unset_userdata('ProStudentData');
			$this->session->unset_userdata('sessionUserPassword');
			$this->session->unset_userdata('sessionStudentId');
			
			$exp = $this->db->query("SELECT * FROM tbl_professors WHERE pro_id=".$odata->creator_id."")->row();
			
			$student = json_decode($odata->student_data);
			
            $student_name = $student->student_name;					
            $student_email = $student->email;					
            $student_phone = $student->phone;
			
			
			    //Email for success session starts
				
				$msg = '<html><body>Hi '.$student_name.',<br>We have scheduled your meeting successfully with '.$exp->pro_name.' on '.date('d-m-Y',strtotime($sesdata->pro_se_date)).'.<br>Thank you.</body></html>';
				$from = "$this->admin_email";
				$subject = "Meeting Schedule: KAB Education Fair";
				$to = $student_email;
				$re = $this->login_model->sendMail($from,$to,$subject,$msg);
				
				//Sms sending starts
				
				$sms_msg = 'Hi '.$student_name.' your meeting is scheduled with '.$exp->pro_name.' on '.date('d-m-Y',strtotime($sesdata->pro_se_date)).' from KAB Education Fair';
				$sms = $this->login_model->sendSMS($student_phone,$sms_msg);
				
				//Email for success session starts Counsellor
				
				$msg1 = '<html><body>Hi '.$exp->pro_name.',<br>We have scheduled your meeting with '.$student_name.' on '.date('d-m-Y',strtotime($sesdata->pro_se_date)).'.<br>Thank you.</body></html>';
				$from = "$this->admin_email";
				$subject = "Meeting Schedule: KAB Education Fair";
				$to1 = $exp->pro_email;
				$re1 = $this->login_model->sendMail($from,$to1,$subject,$msg1);
				
				//Sms sending starts Counsellor
				
				$sms_msg1 = 'Hi '.$exp->pro_name.' your meeting is scheduled with '.$student_name.' on '.date('d-m-Y',strtotime($sesdata->pro_se_date)).'';
				$sms1 = $this->login_model->sendSMS($exp->mobile1,$sms_msg1);
			
			return true;
			
		}else{
			return false;
		}
	}

    public function savespeakerMeeting($oid){

		$odata = $this->db->get_where("tbl_orders",array("order_id"=>$oid))->row();
		$sesdata = json_decode($odata->session_data);
		$sdata = json_decode($odata->student_data);
		
		$insert_id = $odata->student_id;
		
		$speaker_id = $odata->creator_id;
		$zoom_meeting = $this->db->where("speaker_id", $speaker_id)->where("session_id", $sesdata->spe_se_id)->get("tbl_zoom_meetings")->result();
		$zoom_link = '';
		$zoom_password = '';
		if(isset($zoom_meeting[0]->meeting_link)){ $zoom_link = $zoom_meeting[0]->meeting_link;}
		if(isset($zoom_meeting[0]->meeting_password)){ $zoom_password = $zoom_meeting[0]->meeting_password;}
		
		
		if($insert_id){
			$data2 = array(
				    "speaker_id" => $odata->creator_id,
					"spe_std_date" => $sesdata->spe_se_date,
					"spe_std_time" => $sesdata->spe_se_time,
					"spe_std_duration" => $sesdata->duration,
					"spe_std_cost" => $odata->total_amount,
					"student_id" => $insert_id,
//					"spe_std_comment" => $stdcmt,
//					"spe_std_request_session" => $checkBoxValue,
					"zoom_link" => $zoom_link,
					"zoom_password" => $zoom_password,
					"link" => "https://us04web.zoom.us/j/5948139849"
				);	

				$query2 = $this->db->insert("tbl_speaker_student_schedule",$data2);
				
				
				$exp = $this->speaker_model->get_speaker_byid($speaker_id);
						
				$student = $sdata;
				$student_name = $student->student_name;					
				$student_email = $student->email;					
				$student_phone = $student->phone;					
				//Email for success session starts
				
				$msg = '<html><body>Hi '.$student_name.',<br>We have scheduled your meeting successfully with '.$exp->speaker_name.' on '.date('d-m-Y',strtotime($sesdata->spe_se_date)).'.<br>Thank you.</body></html>';
				$from = "$this->admin_email";
				$subject = "Meeting Schedule: KAB Education Fair";
				$to = $student_email;
				$re = $this->login_model->sendMail($from,$to,$subject,$msg);
				
				//Sms sending starts
				
				$sms_msg = 'Hi '.$student_name.' your meeting is scheduled with '.$exp->speaker_name.' on '.date('d-m-Y',strtotime($sesdata->spe_se_date)).' from KAB Education Fair';
				$sms = $this->login_model->sendSMS($student_phone,$sms_msg);
				
				//Email for success session starts Counsellor
				
				$msg1 = '<html><body>Hi '.$exp->speaker_name.',<br>We have scheduled your meeting with '.$student_name.' on '.date('d-m-Y',strtotime($sesdata->spe_se_date)).'.<br>Thank you.</body></html>';
				$from = "$this->admin_email";
				$subject = "Meeting Schedule: KAB Education Fair";
				$to1 = $exp->speaker_email;
				$re1 = $this->login_model->sendMail($from,$to1,$subject,$msg1);
				
				//Sms sending starts Counsellor
				
				$sms_msg1 = 'Hi '.$exp->speaker_name.' your meeting is scheduled with '.$student_name.' on '.date('d-m-Y',strtotime($sesdata->spe_se_date)).'';
				$sms1 = $this->login_model->sendSMS($exp->speaker_mobile,$sms_msg1);			
			return true;
			
		}else{
			return false;
		}
	}

}