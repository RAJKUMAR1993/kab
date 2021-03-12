<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');

class Webinars extends CI_Controller{
	
	public function __construct()
    {
        parent::__construct();
		$this->admin_email = $this->login_model->get_option("admin_email_id")->email;
    }
		
	public function eventSchedule(){
		
		$this->load->view("front/eventschedule/eventschedule");	
		
	}
	
	public function proffesors(){
		
		$this->load->view("front/eventschedule/proffesors");	
		
	}
	public function getProfessor(){
		$cid = $this->input->post("cid");
		$cdata = $this->db->select("tbl_councellors.*, tbl_institutes.institute_name")->join("tbl_institutes", "tbl_institutes.institute_id=tbl_councellors.institute_id", "left")->where("tbl_councellors.id", $cid)->get("tbl_councellors")->row();
		echo json_encode($cdata);
	}
	public function getProfessorSessions(){
		$cid = $this->input->post("cid");
		$datetime = date("Y-m-d H:i:s");
        $data['expert_details'] = $this->db->query("SELECT * FROM tbl_councellors WHERE id=".$cid."")->result();
        $data['sessions'] = $this->db->query("SELECT DISTINCT exp_se_date FROM tbl_counsellor_sessions WHERE expert_id=".$cid." AND exp_se_time >= ".strtotime($datetime))->result();
        $data['cid'] = $cid;
        $cdata = $this->load->view("front/eventschedule/sessions", $data);
		return $cdata;
	}
	
	public function list($num=""){
		$datetime = date("Y-m-d H:i:s");
		$timetoseconds = strtotime($datetime);
		// $recordPerPage = 5;
		// if ($num != "") {
  //           $pageno = $num;
  //       } else {
  //           $pageno = 1;
  //       }
  //       $offset = ($pageno-1) * $recordPerPage;
  //       $sql = "SELECT * FROM tbl_webinors WHERE from_time>=".$timetoseconds." OR to_time>=".$timetoseconds." order by date asc";
       
		// $recordCount = $this->db->query($sql)->num_rows();
		// $sql .= " LIMIT $offset, $recordPerPage";
  //     	$empRecord = $this->db->query($sql)->result();
		// $config['base_url'] = base_url().'front/webinars/list/';
  //     	$config['use_page_numbers'] = TRUE;
		// $config['full_tag_open'] = '<ul class="pagination pagination-sm">';
		// $config['full_tag_close'] = '</ul>';
		// $config['prev_link'] = 'Previous';
		// $config['prev_tag_open'] = '<li class="page-item page-link">';
		// $config['prev_tag_close'] = '</li>';
		// $config['next_tag_open'] = '<li class="page-item page-link">';
		// $config['next_tag_close'] = '</li>';
		// $config['cur_tag_open'] = '<li class="page-link currentpage active"><a href="#">';
		// $config['cur_tag_close'] = '</a></li>';
		// $config['num_tag_open'] = '<li class="page-item page-link">';
		// $config['num_tag_close'] = '</li>';

		// $config['next_link'] = 'Next';
		// $config['total_rows'] = $recordCount;
		// $config['per_page'] = $recordPerPage;
		// $this->pagination->initialize($config);
		// $data['pagination'] = $this->pagination->create_links();       
  //       $data['webinars'] = $empRecord;
		
		$data['webinor_dates'] = $this->db->select("id, date")->order_by("tbl_webinors.date", "asc")->where("tbl_webinors.from_time >= ".$timetoseconds." OR tbl_webinors.to_time >= ".$timetoseconds)->group_by("date")->get("tbl_webinors")->result();
		$this->load->view('front/webinars/webinars',$data);
	}

	public function save_in_participants(){
	   	$this->session->set_userdata(array('ProStudentData' =>$_POST));
	   	$status = 'Active';
	   	$msg = "Successfully Added.";

	   	$post = $this->session->userdata('ProStudentData');
		$email = $this->session->userdata('email');
		$type = $this->session->userdata('login_type');
		if($email!='' && $type=='student'){
			$insert_id = $this->session->userdata('student_id');
		}
		else{
			$check_email = $this->student_model->check_email($post["student_email"]);
			if($check_email){
				$data = array(
				"student_name" => $post["student_name"],
				"email" => $post["student_email"],
				"phone" => $post["student_phone"],
				"address" => $post["student_address"],
				"status" => "Active"
				);
				$data['password'] = $this->student_login_model->api_key_crypt(random_string('alnum', 8),"e");
				$this->db->insert("tbl_students",$data);
				$insert_id = $this->db->insert_id();
				$this->session->set_userdata('sessionUserPassword', $data['password']);
			}			
			else{
				$insert_id = $this->db->where("is_deleted",'0')->where("email",$post["student_email"])->get("tbl_students")->row()->student_id ;
			}
		}
		if($insert_id){
			$this->session->set_userdata('sessionStudentId', $insert_id);
			$checkexists = $this->db->select("*")->where("webinar_student_id", $insert_id)->where("webinar_id", $post['webinar_id'])->get("tbl_webinar_participants");
			if($checkexists->num_rows()==0){
				$status = "Active";
			   	//$status = $this->saveWebinarParticipant();
			   	//$msg = "Not able to save the participation. User is not found.";
				//if($status=="Active"){$msg = "Webinar Participation saved successfully.";}
//				$msg = "You can proceed to participate.";
				
				$status = $this->saveWebinarParticipant();
				$msg = "Not able to save the participation. User is not found.";
				if($status=="Active"){$msg = "Webinar Participation saved successfully.";}
				$data1=["Status"=>$status,"Message"=>$msg];
				echo json_encode($data1);
				exit();
				
			}
			else{
				$status = 'InActive';
				$msg = "You already applied to participate this webinar.";
			}
		}
		else{
			$status = 'InActive';
			$msg = "Not able to save the user.";
		}
	   	$data1=["Status"=>$status,"Message"=>$msg];
		echo json_encode($data1);
		exit();
	}
	public function payment_page(){
		$this->load->view('front/webinars/payment_result');
	}
	public function save_student_participation(){
		if($this->input->post("mode") == "success"){
			$status = $this->saveWebinarParticipant();
			$msg = "Not able to save the participation. User is not found.";
			if($status=="Active"){$msg = "Webinar Participation saved successfully.";}
			$data1=["Status"=>$status,"Message"=>$msg];
			echo json_encode($data1);
			exit();
	    }else{
		    $data1=["Status"=>'InActive',"Message"=>"Unable to Add."];
			echo json_encode($data1);
			exit();
	    }
	}
	public function saveWebinarParticipant(){

		$insert_id = $this->session->userdata('sessionStudentId');
		$post = $this->session->userdata('ProStudentData');
		
		if($insert_id){				
			$zoom_meeting = $this->db->where("webinar_id", $post['webinar_id'])->get("tbl_zoom_meetings")->result();
			$zoom_link = '';
			$zoom_password = '';
			if(isset($zoom_meeting[0]->meeting_link)){ $zoom_link = $zoom_meeting[0]->meeting_link;}
			if(isset($zoom_meeting[0]->meeting_password)){ $zoom_password = $zoom_meeting[0]->meeting_password;}
			$data2 = array(
				"webinar_id" => $post["webinar_id"],
				"webinar_student_id" => $insert_id,
				"zoom_link" => $zoom_link,
				"zoom_password" => $zoom_password
			);
			$password = $this->session->userdata('sessionUserPassword');
			$this->db->insert("tbl_webinar_participants",$data2);
			if(isset($password)){
				$msg = '<html><body><small>User ID : '.$post["student_email"].'</small><br> <small>Password : '.$this->student_login_model->api_key_crypt( $password,"d").'</small></body></html>';
				$from = "$this->admin_email";
				$subject = "Login Details : KAB Education Fair";
				$to = $post['student_email'];
				$re = $this->login_model->sendMail($from,$to,$subject,$msg);
			}
            
			$this->session->unset_userdata('ProStudentData');
			$this->session->unset_userdata('sessionUserPassword');
			$this->session->unset_userdata('sessionStudentId');
			
			return 'Active';
			
		}else{
			return 'Inactive';
		}
	}
	public function webinar_view($webinar_id){
		$webinar = $this->db->select("*")->where("id", $webinar_id)->get("tbl_webinors")->row();
        $users = array();
        $professors = explode(',', $webinar->professor_ids);
        if(count($professors)>0 && $webinar->professor_ids!=''){
            foreach ($professors as $professor_id) {
                $pro_details = $this->db->get_where("tbl_professors", ["pro_id" => $professor_id, "pro_status" => 'Active', "is_deleted" => 0])->row();
                $users[] = array(
                    'image' => ($pro_details->image) ? base_url().'assets/images/professors/'.$pro_details->image : base_url().'assets/images/professors/user.png',
                    'name' => $pro_details->pro_name,
                    'designation' => $pro_details->pro_designation,
                    'specialization' => $pro_details->specialization,
                    'experience' => $pro_details->work_exp,
                    'about_yourself' => $pro_details->pro_shortdesc,
                    'qualification' => $pro_details->pro_quali,
                    'email' => $pro_details->pro_email,
                    'mobile_no' => $pro_details->mobile1,
                    'current_organization' => $pro_details->current_organization
                );
            }
        }
        $guests = explode(',', $webinar->guest_ids);
        if(count($guests)>0 && $webinar->guest_ids!=''){
            foreach ($guests as $guest_id) {
                $gdetails = $this->db->get_where("tbl_webinar_guests", ["id" => $guest_id])->row();
                $users[] = array(
                    'image' => ($gdetails->image) ? base_url().'assets/images/guests/'.$gdetails->image : base_url().'assets/images/guests/user.png',
                    'name' => $gdetails->name,
                    'designation' => $gdetails->designation,
                    'specialization' => $gdetails->specialization,
                    'experience' => $gdetails->work_exp,
                    'about_yourself' => $gdetails->about_yourself,
                    'qualification' => $gdetails->qualification,
                    'email' => $gdetails->email,
                    'mobile_no' => $gdetails->mobile_no,
                    'current_organization' => $gdetails->current_organization
                );
            }
        }
		$speakers = explode(',', $webinar->speaker_ids);
		if(count($speakers)>0 && $webinar->speaker_ids!=''){
			foreach ($speakers as $speaker_id) {
				$sdetails = $this->db->get_where("tbl_speakers", ["speaker_id" => $speaker_id])->row();
				$users[] = array(
					'image' => ($sdetails->speaker_photo) ? base_url().$sdetails->speaker_photo : base_url().'assets/images/guests/user.png',
					'name' => $sdetails->speaker_name,
					'designation' => $sdetails->speaker_designation,
					'specialization' => $sdetails->speaker_qualification,
					'experience' => $sdetails->speaker_tworkexp,
					'about_yourself' => $sdetails->speaker_shortdesc,
					'qualification' => $sdetails->speaker_qualification,
					'email' => $sdetails->speaker_mailingaddress,
					'mobile_no' => $sdetails->speaker_mobile,
					'current_organization' => $sdetails->speaker_curorg
				);
			}
		}
		$datetime = date("Y-m-d H:i:s");
		$timetoseconds = strtotime($datetime);
        $data['webinar'] = $webinar;
        $data['users'] = $users;
        $data['webinars'] = $this->db->select("id, title")->order_by("tbl_webinors.date", "asc")->where("tbl_webinors.from_time >= ".$timetoseconds." OR tbl_webinors.to_time >= ".$timetoseconds)->get("tbl_webinors")->result();
		$this->load->view('front/webinars/webinar_view',$data);
	}
}
