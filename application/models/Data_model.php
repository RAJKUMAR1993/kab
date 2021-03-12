<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_model extends CI_model {

	public function get_content($id){
		return $this->db->where("is_deleted",'0')->where("institute_id",$id)->order_by('content_id', 'DESC')->get("tbl_content")->result();
	}

	public function get_content_byid($id = null){
		return $this->db->where("content_id",$id)->where("status",'Active')->where("is_deleted",'0')->get("tbl_content")->row();
	}
	public function get_video($id){
		return $this->db->where("is_deleted",'0')->where("institute_id",$id)->order_by('video_id', 'DESC')->get("tbl_video")->result();
	}

	public function get_video_byid($id = null){
		//return $this->db->where("video_id",$id)->where("status",'Active')->where("is_deleted",'0')->get("tbl_video")->row();
		return $this->db->where("video_id",$id)->where("is_deleted",'0')->get("tbl_video")->row();
	}
	
	public function get_placement($id){
		return $this->db->where("is_deleted",'0')->where("institute_id",$id)->order_by('placement_id', 'DESC')->get("tbl_placement")->result();
	}

	public function get_placement_byid($id = null){
		//return $this->db->where("placement_id",$id)->where("status",'Active')->where("is_deleted",'0')->get("tbl_placement")->row();
		return $this->db->where("placement_id",$id)->where("is_deleted",'0')->get("tbl_placement")->row();
	}

	public function get_programfee($id){
		return $this->db->where("is_deleted",'0')->where("institute_id",$id)->order_by('programfee_id', 'DESC')->get("tbl_programmefee")->result();
	}

	public function get_programfee_byid($id = null){
		return $this->db->where("programfee_id",$id)->where("status",'Active')->where("is_deleted",'0')->get("tbl_programmefee")->row();
	}

	public function get_achievement($id){
		return $this->db->where("is_deleted",'0')->where("institute_id",$id)->order_by('achievement_id', 'DESC')->get("tbl_achievement")->result();
	}

	public function get_achievement_byid($id = null){
		// return $this->db->where("achievement_id",$id)->where("status",'Active')->where("is_deleted",'0')->get("tbl_achievement")->row();
		return $this->db->where("achievement_id",$id)->where("is_deleted",'0')->get("tbl_achievement")->row();
	}
	
	public function get_placementstatistics($id){
		return $this->db->where("is_deleted",'0')->where("institute_id",$id)->order_by('ps_id', 'DESC')->get("tbl_placementstatistics")->result();
	}

	public function get_placementstatistics_byid($id = null){
		// return $this->db->where("ps_id",$id)->where("status",'Active')->where("is_deleted",'0')->get("tbl_placementstatistics")->row();
		return $this->db->where("ps_id",$id)->where("is_deleted",'0')->get("tbl_placementstatistics")->row();
	}

	public function get_studentsplacement($id){
		return $this->db->where("is_deleted",'0')->where("institute_id",$id)->order_by('ps_id', 'DESC')->get("tbl_studentsplacement")->result();
	}

	public function get_studentsplacement_byid($id = null){
		// return $this->db->where("ps_id",$id)->where("status",'Active')->where("is_deleted",'0')->get("tbl_studentsplacement")->row();
		return $this->db->where("ps_id",$id)->where("is_deleted",'0')->get("tbl_studentsplacement")->row();
	}

}
