<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');

class Virtualcontacts extends CI_Controller {
	public function __construct()
	    {
	        parent::__construct();
	        //$this->load->library('excel');
	        if($this->session->userdata['login_type']!='institute'){redirect('institute/login');}
	    }

	public function index()
	{
		$institute_id =$this->session->userdata['institute_id'];
		$data['experts'] = $this->db->order_by('id', 'DESC')->get_where("tbl_councellors",["institute_id"=>$institute_id,"is_deleted"=>0])->result();
		$data['subview'] = "virtualcontacts/virtualcontacts";
		$this->load->view('institute/theme',$data);
	}
	public function view_virtualcontacts()
	{
		$institute_id =$this->session->userdata['institute_id'];
		$mobile = $this->input->get('mobile');
		$sdate = $this->input->get("startDate");
		$edate = $this->input->get("endDate");
		$recorded_file = $this->input->get('recorded_file');	

		if($sdate){
			$this->db->where("date >=", date("Y-m-d",strtotime($sdate)));
			$this->db->where('date <=', date("Y-m-d",strtotime($edate)));
		}
		if($mobile){
			$this->db->where("institute_mobile",$mobile);
		}
		if($recorded_file){	
			$this->db->where("recorded_file !=","");	
		}
		
		$data['call_history'] = $this->db->order_by('id', 'DESC')->get_where("tbl_convoxcall_logs",["institute_id"=>$institute_id])->result();
	     //echo $this->db->last_query();die;
		$data['subview'] = "virtualcontacts/view_virtualcontacts";
		$this->load->view('institute/theme',$data);
	}
	public function vrtlcntcts_download(){

		$institute_id =$this->session->userdata['institute_id'];
		$data = $this->db->get_where("tbl_convoxcall_logs",["institute_id"=>$institute_id])->row();
		$dwn  = $data->convoxref_id;
		//echo $this->db->last_query();die;
		header('Content-Type: application/json');
		header('Content-Disposition: attachment; filename='.trim($dwn).'.txt');
		header('Pragma: no-cache');
		echo $data->converted_text;
		
	
		
	} 
	public function add_virtual_contact(){
		
		$contact = $this->input->post("helpline_number");
		$cid = $this->input->post("cid");
		
		$idata = $this->db->get_where("tbl_institutes",["institute_id"=>$this->session->userdata("institute_id")])->row(); 
		
		if($idata->add_package_status == "Active"){
					
			$adpackage = json_decode($idata->additional_package_count)->phone;

		}else{

			$adpackage = 0;

		}
		
		$icount = json_decode($idata->allowed_creation_count)->phone;
		
		if($cid == ""){
		
			if(count(json_decode($idata->virtual_conference_numbers)) >= ($icount+$adpackage)){

				echo json_encode(["status"=>"error","msg"=>"You can add only $icount Virtual Contact Numbers."]);
				exit();

			}else{

				$exnumbers = json_decode($idata->virtual_conference_numbers,true);
				
				foreach ($exnumbers as $hnum) {
					if($contact==$hnum['contact']){
						echo json_encode(["status"=>"error","msg"=>"Contact Number Already Exists."]);
						exit();
					}
				}
				$arr = array(
					"name" => $this->input->post("name"),
					"designation" => $this->input->post("designation"),
					"from_time" => $this->input->post("from_time"),
					"to_time" => $this->input->post("to_time"),
					"contact" => $contact
				);
				
				array_push($exnumbers,$arr);

				if($exnumbers){
					$data = json_encode($exnumbers);
				}else{
					$data = json_encode([$arr]);
				}

				$d = $this->db->where("institute_id",$this->session->userdata("institute_id"))->update("tbl_institutes",["virtual_conference_numbers"=>$data]);

				if($d){

					echo json_encode(["status"=>"success","msg"=>"Succesfully Added."]);
					exit();

				}else{

					echo json_encode(["status"=>"error","msg"=>"Error Occured."]);
					exit();

				}

			}
			
		}else{
			
			$exnumbers = json_decode($idata->virtual_conference_numbers,true);
			unset($exnumbers[$cid]);
			
			$arr = array(
				"name" => $this->input->post("name"),
				"designation" => $this->input->post("designation"),
				"from_time" => $this->input->post("from_time"),
				"to_time" => $this->input->post("to_time"),
				"contact" => $contact
			);
			array_push($exnumbers,$arr);

			if($exnumbers){
				$data = json_encode(array_values($exnumbers));
			}else{
				$data = json_encode([$arr]);
			}

			$d = $this->db->where("institute_id",$this->session->userdata("institute_id"))->update("tbl_institutes",["virtual_conference_numbers"=>$data]);

			if($d){

				echo json_encode(["status"=>"success","msg"=>"Succesfully Updated."]);
				exit();

			}else{

				echo json_encode(["status"=>"error","msg"=>"Error Occured."]);
				exit();

			}
			
		}
		
	}
	
	public function delete_virtualcontact($cid){
		
		$idata = $this->db->get_where("tbl_institutes",["institute_id"=>$this->session->userdata("institute_id")])->row(); 
		$exnumbers = json_decode($idata->virtual_conference_numbers,true);
		unset($exnumbers[$cid]);

		$data = json_encode(array_values($exnumbers));
	
		$d = $this->db->where("institute_id",$this->session->userdata("institute_id"))->update("tbl_institutes",["virtual_conference_numbers"=>$data]);

		if($d){

			echo json_encode(["status"=>"success","msg"=>"Succesfully Deleted."]);
			exit();

		}else{

			echo json_encode(["status"=>"error","msg"=>"Error Occured."]);
			exit();

		}
		
	}

	public function add_virtual_link(){
		
		$virtual_link = $this->input->post("virtual_link");
		$cid = $this->input->post("vlid");
		
		$idata = $this->db->get_where("tbl_institutes",["institute_id"=>$this->session->userdata("institute_id")])->row(); 
		$icount = json_decode($idata->allowed_creation_count)->video;
		
		if($cid == ""){
		
			if(count(json_decode($idata->video_conference)) >= $icount){

				echo json_encode(["status"=>"error","msg"=>"You can add only $icount Virtual Conference Links."]);
				exit();

			}else{

				$exnumbers = json_decode($idata->video_conference,true);
				
				if(in_array($virtual_link,$exnumbers)){
					
					echo json_encode(["status"=>"error","msg"=>"Virtual Conference Link Already Exists."]);
					exit();
					
				}
				
				array_push($exnumbers,$virtual_link);

				if($exnumbers){
					$data = json_encode($exnumbers);
				}else{
					$data = json_encode([$virtual_link]);
				}

				$d = $this->db->where("institute_id",$this->session->userdata("institute_id"))->update("tbl_institutes",["video_conference"=>$data]);

				if($d){

					echo json_encode(["status"=>"success","msg"=>"Succesfully Added."]);
					exit();

				}else{

					echo json_encode(["status"=>"error","msg"=>"Error Occured."]);
					exit();

				}

			}
			
		}else{
			
			$exnumbers = json_decode($idata->video_conference,true);
			unset($exnumbers[$cid]);
			
			array_push($exnumbers,$virtual_link);

			if($exnumbers){
				$data = json_encode(array_values($exnumbers));
			}else{
				$data = json_encode([$virtual_link]);
			}

			$d = $this->db->where("institute_id",$this->session->userdata("institute_id"))->update("tbl_institutes",["video_conference"=>$data]);

			if($d){

				echo json_encode(["status"=>"success","msg"=>"Succesfully Updated."]);
				exit();

			}else{

				echo json_encode(["status"=>"error","msg"=>"Error Occured."]);
				exit();

			}
			
		}
		
	}
	
	public function delete_virtuallink($cid){
		
		$idata = $this->db->get_where("tbl_institutes",["institute_id"=>$this->session->userdata("institute_id")])->row(); 
		$exnumbers = json_decode($idata->video_conference,true);
		unset($exnumbers[$cid]);

		$data = json_encode(array_values($exnumbers));
	
		$d = $this->db->where("institute_id",$this->session->userdata("institute_id"))->update("tbl_institutes",["video_conference"=>$data]);

		if($d){

			echo json_encode(["status"=>"success","msg"=>"Succesfully Deleted."]);
			exit();

		}else{

			echo json_encode(["status"=>"error","msg"=>"Error Occured."]);
			exit();

		}
		
	}

	
}
