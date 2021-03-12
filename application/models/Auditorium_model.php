<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auditorium_model extends CI_model {

	public function get_video(){
		return $this->db->where("is_deleted",'0')->order_by('video_id', 'DESC')->get("tbl_auditorium")->result();
	}

	public function get_video_byid($id = null){
		return $this->db->where("video_id",$id)->where("status",'Active')->where("is_deleted",'0')->get("tbl_auditorium")->row();
	}


}
