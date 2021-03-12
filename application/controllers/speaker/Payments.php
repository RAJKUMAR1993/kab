<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payments extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
         if($this->session->userdata['login_type']!='speaker'){redirect('speaker/login');}
    }

	public function index()
	{
		$data["title"] = "Payment History";
		$startdate = $this->input->get('startDate');
		$enddate = $this->input->get('endDate');
		$startDate=date("Y-m-d",strtotime($startdate)); 
		$endDate=date("Y-m-d",strtotime($enddate)); 
		$date = explode(" - ",$this->input->get("date"));
		$sdate = date("Y-m-d",strtotime($date[0]));
		$edate = date("Y-m-d",strtotime($date[1]));
		if($this->input->get("date")){
			$this->db->where('date_of_order BETWEEN "'. $sdate. '" and "'.$edate.'"');
		}	
		if($startdate){
			$this->db->where("DATE(date_of_order)  BETWEEN '$startDate' AND '$endDate'");
		}
		$data['data'] = $this->db->order_by('id', 'DESC')->get_where("tbl_orders",["session_organized_by"=>"speaker","creator_id"=>$this->session->userdata['speaker_id']])->result();
		//echo $this->db->last_query();die;
		//echo "<pre/>";print_R($data['data']);die;
		$data['subview'] = "payments/payments";
		$this->load->view('speaker/theme',$data);
	}
	
}