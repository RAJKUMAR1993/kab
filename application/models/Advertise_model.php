<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Advertise_model extends CI_model {

	public function get_advertise(){
		return $this->db->where("is_deleted",'0')->order_by('id', 'DESC')->get("tbl_advertise")->result();
	}

	public function get_advertise_byid($id = null){
		return $this->db->where("id",$id)->where("is_deleted",'0')->get("tbl_advertise")->row();
	}


}
