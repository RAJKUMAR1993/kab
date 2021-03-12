<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Institute_model extends CI_model {

	public function get_institute(){
		return $this->db->where("is_deleted",'0')->where("is_active",'0')->order_by('institute_id', 'DESC')->get("tbl_institutes")->result();
	}

	public function get_institute_id($id = null){
		return $this->db->where("institute_id",$id)->where("is_deleted",'0')->get("tbl_institutes")->row();
	}

	public function check_otp($phone = null){
		return $this->db->order_by("institute_id","desc")->where("phone",$phone)->where("is_deleted",'0')->get("tbl_institutes")->row();
	}

	public function check_phone($phone=NULL){
		$check = $this->db->where("phone",$phone)->where("status",'Active')->where("is_deleted",'0')->where("is_active",'0')->get("tbl_institutes")->num_rows();
		if($check >0){
			return false;
		}else{
			return TRUE;
		}
	}

	public function check_email($email=NULL){
		$check = $this->db->where("email",$email)->where("status",'Active')->where("is_deleted",'0')->where("is_active",'0')->get("tbl_institutes")->num_rows();
		if($check >0){
			return false;
		}else{
			return TRUE;
		}
	}

	public function get_institute_gallery($id = null){
		return $this->db->where("title_id",$id)->where("status",'Active')->where("deleted",'0')->get("tbl_gallery")->result();
	}

	public function get_course_details($id = null){
		return $this->db->where("course_id",$id)->get("tbl_courses")->row();
	}

	public function getGeo($ip){
		
		$zdata = $this->login_model->get_option("ccavenue");
		
		$country = '';
		$city = '';
		$geoloc = '';
		if($ip!=''){
			$geolocation = unserialize(file_get_contents("$zdata->url".$ip));//http://api.ipstack.com/".$ip."?access_key=63f243020216c5c0187bb70c88d085c3
			$country = $geolocation['geoplugin_city'];
			$city = $geolocation['geoplugin_region'];
			if($country!=''){$geoloc = $country;}
			if($city!=''){$geoloc = $geoloc.', '.$city;}
		}
		return $geoloc;
	}

	public function professor_meeting()
    {
        $this->db->select('*');
        $query = $this->db->get('tbl_councellors');
        if ($query->num_rows()>0) {
            return $query->result();
        } else {
            return false;
        }
	}
	public function professor_title_by_id($id)
    {
		$this->db->where("id", $id);
		$query= $this->db->get("tbl_institute_presentations");
		//echo $this->db->last_query();die;
	       return $query->row();
	}
	public function institute_auditorium_by_id($id)
    {
		$this->db->where("id", $id);
		$query= $this->db->get("tbl_institute_auditorium");
	       return $query->row();
	}
	public function professor_list()
    {
        $this->db->select('*');
        $query = $this->db->get('tbl_councellors');
        if ($query->num_rows()>0) {
            return $query->result();
        } else {
            return false;
        }
	}
	public function students_list()
    {
        $this->db->select('*');
        $query = $this->db->get('tbl_students');
        if ($query->num_rows()>0) {
            return $query->result();
        } else {
            return false;
        }
	}
	public function total_video_count()
    {
		$this->db->select('id')->from('tbl_student_auditorium_presentations');
		$query = $this->db->get();
		//echo  $this->db->last_query();die;
        return $query->num_rows();
	}
		public function professor()
    {
        $this->db->select('*');
        $query = $this->db->get('tbl_professors');
        if ($query->num_rows()>0) {
            return $query->result();
        } else {
            return false;
        }
	}
	
}
