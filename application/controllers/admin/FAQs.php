<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');

class FAQs extends MY_Controller {
	public function __construct()
    {
        parent::__construct();
        if($this->session->userdata['login_type']!='admin'){redirect('admin/login');}
    }

	public function index()
	{
		$data['faqs'] = $this->db->select("tbl_institute_faqs.*, tbl_institutes.institute_name")->join("tbl_institutes", "tbl_institutes.institute_id=tbl_institute_faqs.institute_id", "left")->order_by("tbl_institute_faqs.institute_id","asc")->get("tbl_institute_faqs")->result();
		$data['subview'] = "faqs/faqs";
		$this->load->view('admin/theme',$data);
	}
	public function kab_faqs()
	{
		$data['faqs'] = $this->db->order_by("created_datetime","desc")->get("tbl_kab_faqs")->result();
		$data['subview'] = "faqs/kab_faqs";
		$this->load->view('admin/theme',$data);
	}
	
	public function add_kab_faq(){
		$faq_id = $this->uri->segment(4);
		if($faq_id){
			$faq = $this->db->where("id",$faq_id)->get("tbl_kab_faqs")->row();
			$data['faq'] = $faq;
		}else{
			$data['faq'] = "";
		}
		$data['subview'] = "faqs/add_kab_faq";
		$this->load->view('admin/theme',$data);
	}
	

	public function save_faq(){
		$faq_id = $this->input->post("faq_id");
		$question = $this->input->post("question");
		$answer = $this->input->post("answer");
		if($question!=''){
			if($answer!=''){
				$data = array(
					"question" => $question,
					"answer" => $answer
				);
				if($faq_id){
					$this->db->where("id",$faq_id)->update("tbl_kab_faqs",$data); 
					$data1 = ["Status"=>'Active',"Message"=>"FAQ Updated Successfully."];
				}else{
					$query = $this->db->insert("tbl_kab_faqs", $data);
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

	public function delete_kab_faq(){
		if($this->uri->segment(4)){
			$id =$this->uri->segment(4);
			$query = $this->db->where("id",$id)->delete("tbl_kab_faqs");
			if($query){ redirect("admin/faqs");}
		}
	}
}