<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payments extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        if($this->session->userdata['login_type']!='admin'){redirect('admin/login');}
    }

	public function professorPayments()
	{
		$data["title"] = "Professor Payments";
		$data["table"] = "tbl_professors";
		$data["id"] = "pro_id";
		$data["name"] = "pro_name";
		$data["session_date"] = "pro_se_date";
		$startdate = $this->input->get('startDate');
		$enddate = $this->input->get('endDate');
		$startDate=date("Y-m-d",strtotime($startdate)); 
		$endDate=date("Y-m-d",strtotime($enddate)); 
		if($startdate){
			$this->db->where("DATE(date_of_order)  BETWEEN '$startDate' AND '$endDate'");
		}
		$creator_id = $this->input->get("creator_id");
		if($creator_id){
			$this->db->where("creator_id",$creator_id);
		}
		$data['data'] =    $this->db->order_by('id', 'DESC')->get_where("tbl_orders",["session_organized_by"=>"professor"])->result();
		$data['amount'] =  $this->db->query("SELECT SUM(total_amount) FROM tbl_orders")->result();
		$data['org_by'] =  $this->db->select("tbl_professors.*,tbl_orders.*")->from('tbl_professors')
								->join('tbl_orders', 'tbl_orders.creator_id = tbl_professors.pro_id')
								->group_by('tbl_orders.session_organized_by')
								->order_by('tbl_orders.creator_id', 'desc')
								->get()->result();
		$data['subview'] = "payments/payments";
		$this->load->view('admin/theme',$data);
	}
	public function speakerPayments()
	{
		$data["title"] = "Eminent Speaker Payments";
		$data["table"] = "tbl_speakers";
		$data["id"] = "speaker_id";
		$data["name"] = "speaker_name";
		$data["session_date"] = "spe_se_date";
		$startdate = $this->input->get('startDate');
		$enddate = $this->input->get('endDate');
		$startDate=date("Y-m-d",strtotime($startdate)); 
		$endDate=date("Y-m-d",strtotime($enddate)); 
		if($startdate){
			$this->db->where("DATE(date_of_order)  BETWEEN '$startDate' AND '$endDate'");
		}
		$creator_id = $this->input->get("creator_id");
		if($creator_id){
			$this->db->where("creator_id",$creator_id);
		}
		$data['data'] = $this->db->order_by('id', 'DESC')->get_where("tbl_orders",["session_organized_by"=>"speaker"])->result();
		$data['org_by'] =  $this->db->select("tbl_professors.*,tbl_orders.*")->from('tbl_professors')
								->join('tbl_orders', 'tbl_orders.creator_id = tbl_professors.pro_id')
								->group_by('tbl_orders.session_organized_by')
								->order_by('tbl_orders.creator_id', 'desc')
								->get()->result();
		$data['subview'] = "payments/payments";
		$this->load->view('admin/theme',$data);
	}
	public function councellorPayments()
	{
		$data["title"] = "Expert Councellor Payments";
		$data["table"] = "tbl_experts";
		$data["id"] = "expert_id";
		$data["name"] = "expert_name";
		$data["session_date"] = "exp_se_date";
		$startdate = $this->input->get('startDate');
		$enddate = $this->input->get('endDate');
		$startDate=date("Y-m-d",strtotime($startdate)); 
		$endDate=date("Y-m-d",strtotime($enddate)); 
		if($startdate){
			$this->db->where("DATE(date_of_order)  BETWEEN '$startDate' AND '$endDate'");
		}
		$creator_id = $this->input->get("creator_id");
		if($creator_id){
			$this->db->where("creator_id",$creator_id);
		}
		$data['data'] = $this->db->order_by('id', 'DESC')->get_where("tbl_orders",["session_organized_by"=>"expert"])->result();
		$data['org_by'] =  $this->db->select("tbl_professors.*,tbl_orders.*")->from('tbl_professors')
								->join('tbl_orders', 'tbl_orders.creator_id = tbl_professors.pro_id')
								->group_by('tbl_orders.session_organized_by')
								->order_by('tbl_orders.creator_id', 'desc')
								->get()->result();
		$data['subview'] = "payments/payments";
		$this->load->view('admin/theme',$data);
	}
	
}