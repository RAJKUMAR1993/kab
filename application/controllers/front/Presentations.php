<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');

class Presentations extends CI_Controller {


	public function index()
	{
		$data['webinors'] = $this->db->select("tbl_webinors.*, tbl_professors.pro_name as professor_name, tbl_professors.pro_image as professor_image")
		->order_by("tbl_webinors.date ","desc")
		->join("tbl_professors", "tbl_professors.pro_id = tbl_webinors.professor_id", "left")
		->get("tbl_webinors")
		->result();
		$this->load->view('front/presentations/college-presentations',$data);
	}
	
	
}