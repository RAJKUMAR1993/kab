<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_model {

	public function get_category(){
		return $this->db->where("status","Active")->where("is_deleted",'0')->order_by('category_name', 'ASC')->get("tbl_categories")->result();
	}

	public function get_category_id($id = null){
		return $this->db->where("category_id",$id)->where("is_deleted",'0')->get("tbl_categories")->row();
	}

	

	public function check_category($category=NULL){
		$check = $this->db->where("category_name",$category)->where("is_deleted",'0')->get("tbl_categories")->num_rows();
		if($check >0){
			return false;
		}else{
			return TRUE;
		}
	}

}
