<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');

class Feedback extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        if($this->session->userdata['login_type']!='admin'){redirect('admin/login');}
    }

	public function index()
	{
		$admin_id =$this->session->userdata['admin_id'];
		$data['feedback'] = $this->db->order_by('created_date', 'DESC')->get_where("feedback")->result();
		$data['subview'] = "feedback/feedback";
		
		$ratings = ["Rating 1","Rating 2","Rating 3","Rating 4","Rating 5"];
		$k = 1;
		$fbs = [];
		foreach($ratings as $rating){
			
			$fbs[$rating] = $this->db->get_where("feedback",["srating"=>$k])->num_rows();
			$k++;
			
		}
		$data["ratings"] = $fbs;
		$this->load->view('admin/theme',$data);
	}
	public function savefeedback(){
		$srating = $this->input->post('srating');
		$comment = $this->input->post('comment');
		if($srating!='' || $comment!=''){
			$data = $this->input->post();
			
			$d = $this->db->insert("feedback",$data);
			
			if($d){
				
				echo "success";
				
			}else{
				
				echo "error";
				
			}
		}
		else{
			echo "empty";
		}
	}
}