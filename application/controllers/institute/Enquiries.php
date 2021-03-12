<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');
class Enquiries extends CI_Controller{
	public function __construct()
	    {
	        parent::__construct();
	        if($this->session->userdata['login_type']!='institute'){redirect('institute/login');}
	    }
	
	public function index()
	{
		$date = explode(" - ",$this->input->get("date"));
		$sdate = date("Y-m-d",strtotime($date[0]));
		$edate = date("Y-m-d",strtotime($date[1]));
		
		if($this->input->get("date")){

			//$this->db->where("query_date between $sdate and $edate");	
			$this->db->where('query_date BETWEEN "'. $sdate. '" and "'.$edate.'"');
		}	
		$status = $this->input->get("status");
		//print_r( $month );die;
		if($status){
		  $this->db->where("status",$status);
		}
	
		$data['details'] = $this->db->select('*')->get_where("tbl_institute_ask_a_question",["institute_id"=> $this->session->userdata['institute_id'],"type"=>"institute"])->result();
	
		$data['subview'] = "enquiries/enquiries";
		$this->load->view('institute/theme',$data);
	}
	
	public function updateenquiry(){
		$csid = $this->input->post('csid');	
		$message = $this->input->post('message');
		$data = array(
			"message" =>$this->input->post("message"),
			"message_date" =>date('Y-m-d'),
			"status" => 'Replied'
		);

			$d = $this->db->where("id",$csid)->update("tbl_institute_ask_a_question",$data);
			
			if($d){
				
				echo "success";
				
			}else{
				
				echo "error";
				
			}
	}

	
	
}
