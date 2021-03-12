<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VideoConnect extends CI_Controller{
	public function __construct()
    {
        parent::__construct();
        if($this->session->userdata['login_type']!='institute'){redirect('institute/login');}
    }
    public function index()
	{
		
		$id = $this->session->userdata('institute_id');
		$name = $this->input->get("name");
		$play_url = $this->input->get("play_url");
		$instname = $this->input->get("instname");
		$sdate = $this->input->get("startDate");
		$edate = $this->input->get("endDate");
		
		if($name){
			$this->db->where("name",$name);
		}
		if($sdate){
			$this->db->where("date >=", date("Y-m-d",strtotime($sdate)));
			$this->db->where('date <=', date("Y-m-d",strtotime($edate)));
		}
		
		if($instname){
			$this->db->where("name",$instname);
		}
		if($play_url){
			$this->db->where("play_url !=","");
		}
		$data['collegeconnect'] = $this->db->where("institute_id",$this->session->userdata('institute_id'))->order_by("id", "desc")->get("tbl_college_connect")->result();
//		echo $this->db->last_query();die;
		$data['subview'] = "collegeconnect/collegeconnect";
		$this->load->view('institute/theme',$data);
	}
	public function add_meeting(){
		$meeting_id = $this->uri->segment(4);
		if($meeting_id){
			$collegeconnect = $this->db->where("id ",$meeting_id)->get("tbl_college_connect")->result();
			$data['collegeconnect'] = $collegeconnect;
		}else{
			$data['collegeconnect'] = "";
		}
		$data['subview'] = "collegeconnect/add_collegeconnect";
		$this->load->view('institute/theme',$data);
	}
	public function save_meeting(){
		$id = $this->input->post("id");
		$date = $this->input->post("date");
		$from_time = $ftime = $this->input->post("from_time");
		$to_time = $ttime = $this->input->post("to_time");
		if($date!='' && $date!='0000:00:00' && $from_time!='' && $from_time!='00:00' && $to_time!='' && $to_time!='00:00'){
			$from_time = $date.' '.$from_time;
			$to_time = $date.' '.$to_time;

			$check = $this->db->select("*")->where("institute_id", $this->session->userdata('institute_id'))->where("date", $date);
			if($id!=''){
				$check = $check->where("id !=", $id);
			}
			$check = $check->get("tbl_college_connect");
			if($check->num_rows() == 0){
				$data = array(
					"institute_id" => $this->session->userdata('institute_id'),
					"name" => $this->input->post("name"),
					"designation" => $this->input->post("designation"),
					"date" => $date,
					"from_time" => strtotime($from_time),
					"to_time" => strtotime($to_time)
				);

				if($id){
					$this->db->where("id",$id)->update("tbl_college_connect",$data); 
					
					$data1 = ["Status"=>'Active',"Message"=>"Meeting Updated Successfully."];
				}else{
					$query = $this->db->insert("tbl_college_connect", $data);
					$id = $this->db->insert_id();
					$start_time = $date.'T'.$ftime.':00';

					$date1 = new DateTime($date.'T'.$ftime.':00');
					$date2 = new DateTime($date.'T'.$ttime.':00');
				   
				    $diff = $date2->diff($date1);
				   
				    $duration = $diff->format('%h');
					//Create Zoom meeting
					$meeting = $this->accesstoken->create_meeting($user_type=5, "Instant Meeting", $start_time, $duration, $id, 'no', $flag=2);
					//Create Zoom meeting
					$data1=["Status"=>'Active',"Message"=>"Meeting Added Successfully."];
				}
				echo json_encode($data1);
				exit();
			}
			else{
				$data1=["Status"=>'Inactive',"Message"=>"A Meeting is already created on this date."];
			    echo json_encode($data1);
			    exit();
			}
		}
		else{
			$data1=["Status"=>'Inactive',"Message"=>"Date, From Time, To Time are required."];
		    echo json_encode($data1);
		    exit();
		}

	}

	public function delete_meeting(){
		if($this->uri->segment(4)){
			$id =$this->uri->segment(4);
			$query = $this->db->where("id",$id)->delete("tbl_college_connect");
			if($query){ redirect("institute/videoconnect");}
		}
	}
	
	public function downloadText($id){
		
		$zdata = $this->db->get_where(" tbl_college_connect",["id"=>$id])->row();
		//print_r($zdata);die;
		if($zdata){
			
			header('Content-Type: application/json');
			header('Content-Disposition: attachment; filename='.$zdata->meeting_id.'.txt');
			header('Pragma: no-cache');
			echo $zdata->converted_text;
			exit();	
			
		}else{
			
			redirect("institute/videoconnect");
			
		}
		
	}
}