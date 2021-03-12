<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_model extends CI_model {

	public function get_student(){
		return $this->db->where("is_deleted",'0')->order_by('student_id', 'DESC')->get("tbl_students")->result();
	}
	
	public function generateOrderId(){
		
		$result = $this->db->query('SELECT id from tbl_orders order by id desc')->row(); 
		$year = date("Y");
		
		if(isset($result->id)){
			
			$c = $result->id + 1;
			$invoice = "ORD$year"."0000".$c;
			
		}else{
			
			$invoice = "ORD$year"."00001";
			
		}
		
		return $invoice;
		
		
	}
	
	public function is_menu_enabled($key){
		
		$menu = $this->db->get_where("tbl_dynamic_menu", ["status" => 1,"menu_link"=>$key])->row();
		return $menu;
		
	}
	
	public function getMoney($num){
		
		$explrestunits = "" ;
		if(strlen($num)>3) {
			$lastthree = substr($num, strlen($num)-3, strlen($num));
			$restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
			$restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
			$expunit = str_split($restunits, 2);
			for($i=0; $i<sizeof($expunit); $i++) {
				// creates each of the 2's group and adds a comma to the end
				if($i==0) {
					$explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
				} else {
					$explrestunits .= $expunit[$i].",";
				}
			}
			$thecash = $explrestunits.$lastthree;
		} else {
			$thecash = $num;
		}
		return $thecash;
		
	}

	public function get_student_id($id = null){
		return $this->db->where("student_id",$id)->get("tbl_students")->row();
	}

	public function check_otp($phone = null){
		return $this->db->where("phone",$phone)->where("is_deleted",'0')->get("tbl_students")->row();
	}

	public function check_phone($phone=NULL){
		$check = $this->db->where("is_deleted",'0')->where("phone",$phone)->where("status",'Active')->get("tbl_students")->num_rows();
		if($check >0){
			return false;
		}else{
			return TRUE;
		}
	}

	public function check_email($email=NULL){
		$check = $this->db->where("is_deleted",'0')->where("status",'Active')->where("email",$email)->get("tbl_students")->num_rows();
		if($check >0){
			return false;
		}else{
			return TRUE;
		}
	}

	public function get_student_email($lmail = null){
		return $this->db->where("email",$lmail)->get("tbl_students")->row()->student_id;
	}

	public function institute_details($id = null){
		return $this->db->get_where("tbl_institutes",["institute_id"=>$id])->row();
	}



}
