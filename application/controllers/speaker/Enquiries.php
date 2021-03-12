<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');
class Enquiries extends CI_Controller{
	public function __construct()
	    {
	        parent::__construct();
	        if($this->session->userdata['login_type']!='speaker'){redirect('speaker/login');}
	    }

	
	public function index()
	{
		$ref = $this->input->get("ref");	
		if($ref == "received"){
			$this->db->where("tbl_institute_ask_a_question.status",$ref);
		}elseif($ref == "replied"){
			$this->db->where("tbl_institute_ask_a_question.status",$ref);
		}elseif($ref == "pending"){
			$this->db->where("tbl_institute_ask_a_question.status",$ref);
		}
		$data['details'] =  $this->db->select('tbl_institute_ask_a_question.*,tbl_students.*')
									->from('tbl_institute_ask_a_question')
									->join('tbl_students', 'tbl_institute_ask_a_question.student_id = tbl_students.student_id')
									->where('tbl_institute_ask_a_question.institute_id',$this->session->userdata['speaker_id'])
									->where('tbl_institute_ask_a_question.type','speaker')
									->order_by('id', 'desc')
									->get();
		$data['subview'] = "enquiries/enquiries";
		$this->load->view('speaker/theme',$data);
	}


	public function updateenquiry(){
		$csid = $this->input->post('csid');	
		$status = $this->input->post('status');
		$data = array(
			"message" =>$this->input->post("status"),
			"status" => "Replied"
		);

			$d = $this->db->where("id",$csid)->update("tbl_institute_ask_a_question",$data);
			
			if($d){
				
				echo "success";
				
			}else{
				
				echo "error";
				
			}
	}

	
	
}
