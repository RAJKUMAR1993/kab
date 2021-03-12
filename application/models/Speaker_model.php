<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Speaker_model extends CI_model {

	public function get_speaker($id,$type){
		return $this->db->where("is_deleted",'0')->where("login_type",$type)->order_by('speaker_id', 'DESC')->get("tbl_speakers")->result();
	}

	public function get_speaker_byid($id = null){
		return $this->db->where("speaker_id",$id)->where("is_deleted",0)->get("tbl_speakers")->row();
	}

	public function get_institute_name($id = null){
		return $this->db->where("institute_id",$id)->where("status",'Active')->where("is_deleted",'0')->get("tbl_institutes")->row()->institute_name;
	}

	public function check_otp($phone = null){
		return $this->db->where("speaker_mobile",$phone)->where("is_deleted",'0')->get("tbl_speakers")->row();
	}

	public function check_phone($phone=NULL){
		$check = $this->db->where("is_deleted",'0')->where("speaker_mobile",$phone)->where("speaker_status",'Active')->get("tbl_speakers")->num_rows();
		if($check >0){
			return false;
		}else{
			return TRUE;
		}
	}
	public function check_email($email=NULL){
		$check = $this->db->where("speaker_email",$email)->where("is_deleted",0)->get("tbl_speakers")->num_rows();
		if($check >0){
			return false;
		}else{
			return TRUE;
		}
	}
}
