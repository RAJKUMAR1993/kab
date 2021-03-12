<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');

class Feedback extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        if($this->session->userdata['login_type']!='institute'){redirect('institute/login');}
    }

	public function index()
	{
		$institute_id =$this->session->userdata['institute_id'];
		$data['feedback'] = $this->db->order_by('created_date', 'DESC')->get_where("tbl_institute_feedbackrating",["institute_id"=>$institute_id])->result();
		
		$ratings = ["5 <i class='fa fa-star'></i>","4 <i class='fa fa-star'></i>","3 <i class='fa fa-star'></i>","2 <i class='fa fa-star'></i>","1 <i class='fa fa-star'></i>"];
		$colors = ["#4CAF50","#2196F3","#00bcd4","#ff9800","#f44336"];
		
		$totalratings = [];
		$k = 5;
		
		$feedback = [];
		foreach($ratings as $kk => $rating){
			
			$ndata = [];
			$a = $this->db->get_where("tbl_institute_feedbackrating",["institute_id"=>$institute_id,"srating"=>$k])->num_rows();

			$ndata["rating"] = $rating;
			$ndata["count"] = $a;
			$ndata["color"] = $colors[$kk];
			
			$feedback[] = $ndata;
			$totalratings[] = $a;
			$k--;
			
		}
		
		$data["feedback_ratings"] = $feedback;
		$data["total_feedback"] = array_sum($totalratings);
		
		$data['subview'] = "feedback/feedback";
		$this->load->view('institute/theme',$data);
	}
}