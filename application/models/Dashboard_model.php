<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_model {

	public function total_institutes(){
		return $this->db->where("is_deleted","0")->where("status","Active")->get("tbl_institutes")->num_rows();
	}

	public function total_students(){
		return $this->db->where("is_deleted","0")->get("tbl_students")->num_rows();
	}

}
