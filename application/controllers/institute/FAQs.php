<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');

class FAQs extends CI_Controller {
	public function __construct()
	    {
	        parent::__construct();
	        if($this->session->userdata['login_type']!='institute'){redirect('institute/login');}
	    }

	public function index()
	{
		$data['faqs'] = $this->db->where("institute_id", $this->session->userdata['institute_id'])->order_by("created_datetime","desc")->get("tbl_institute_faqs")->result();
		$data['subview'] = "faqs/faqs";
		$this->load->view('institute/theme',$data);
	}
	
	public function add(){
		$faq_id = $this->uri->segment(4);
		if($faq_id){
			$faq = $this->db->where("id",$faq_id)->get("tbl_institute_faqs")->row();
			$data['faq'] = $faq;
		}else{
			$data['faq'] = "";
		}
		$data['subview'] = "faqs/add_faq";
		$this->load->view('institute/theme',$data);
	}
	

	public function save_faq(){
		$faq_id = $this->input->post("faq_id");
		$question = $this->input->post("question");
		$answer = $this->input->post("answer");
		if($question!=''){
			if($answer!=''){
				$data = array(
					'institute_id' => $this->session->userdata['institute_id'],
					"question" => $question,
					"answer" => $answer
				);
				if($faq_id){
					$this->db->where("id",$faq_id)->update("tbl_institute_faqs",$data); 
					$data1 = ["Status"=>'Active',"Message"=>"FAQ Updated Successfully."];
				}else{
					$query = $this->db->insert("tbl_institute_faqs", $data);
					$data1=["Status"=>'Active',"Message"=>"FAQ Added Successfully."];
				}
				echo json_encode($data1);
				exit();
			}
			else{
				$data1=["Status"=>'Inactive',"Message"=>"Answer is important."];
			    echo json_encode($data1);
			    exit();
			}
		}
		else{
			$data1=["Status"=>'Inactive',"Message"=>"Question is important."];
		    echo json_encode($data1);
		    exit();
		}
	}

	public function delete_faq(){
		if($this->uri->segment(4)){
			$id =$this->uri->segment(4);
			$query = $this->db->where("id",$id)->delete("tbl_institute_faqs");
			if($query){ redirect("institute/faqs");}
		}
	}
}
