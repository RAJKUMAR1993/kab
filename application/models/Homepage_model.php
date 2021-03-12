<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage_model extends CI_model {

	public function get_slider(){
		return $this->db->where("is_deleted",'0')->order_by('slider_id', 'DESC')->get("tbl_sliders")->result();
	}
    public function get_news(){
		return $this->db->where("is_deleted",'0')->where("status",'Active')->order_by('news_id', 'DESC')->limit(4)->get("tbl_news")->result();
	}
	public function get_slider_id($id = null){
		return $this->db->where("slider_id",$id)->where("is_deleted",'0')->get("tbl_sliders")->row();
	}
	public function get_news_id($id = null){
		return $this->db->where("news_id",$id)->where("is_deleted",'0')->get("tbl_news")->row();
	}

	public function get_insdetails($id = null){
		return $this->db->get_where("tbl_institutes",["institute_id"=>$id])->row();
	}

}
