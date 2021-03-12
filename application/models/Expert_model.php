<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expert_model extends CI_model {

	public function get_expert($id,$type){
		return $this->db->where("is_deleted",'0')->where("institute_id",$id)->where("login_type",$type)->order_by('expert_id', 'DESC')->get("tbl_experts")->result();
	}

	public function get_expert_byid($id = null){
		return $this->db->where("expert_id",$id)->where("is_deleted",0)->get("tbl_experts")->row();
	}

	public function get_institute_name($id = null){
		return $this->db->where("institute_id",$id)->where("status",'Active')->where("is_deleted",'0')->get("tbl_institutes")->row()->institute_name;
	}
	
	public function check_otp($phone = null){
		return $this->db->where("expert_mobile",$phone)->where("is_deleted",'0')->get("tbl_experts")->row();
	}

	public function check_phone($phone=NULL){
		$check = $this->db->where("is_deleted",'0')->where("expert_mobile",$phone)->where("expert_status",'Active')->get("tbl_experts")->num_rows();
		if($check >0){
			return false;
		}else{
			return TRUE;
		}
	}
	public function check_email($email=NULL){
		$check = $this->db->where("expert_email",$email)->where("is_deleted",0)->get("tbl_experts")->num_rows();
		if($check >0){
			return false;
		}else{
			return TRUE;
		}
	}
}
