<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_login_model extends CI_model {

	public function login($email = null,$password=null, $client=null){

		$check_email = $this->db->where("email",$email)->where("is_deleted",'0')->where("status",'Active')->get("tbl_students")->num_rows();
		$return=[];
		if($check_email > 0){
		

			$query = $this->db->where("email",$email)->where("password",$this->api_key_crypt($password,'e'))->where("is_deleted",'0')->where("status","Active")->get("tbl_students");
			if($query->num_rows() >0){

				$user_data = $query->row_array();
				$this->session->set_userdata(array('logged_in' =>TRUE ,'student_id'=>$user_data['student_id'],'student_name'=>$user_data['student_name'],'email'=>$user_data['email'],'login_type'=>'student'));
				$status['student_id'] = $user_data['student_id'];
				$status['status'] = TRUE;
				$status['type'] = 'student';
				return $status;
			}else{
				$status['status'] = FALSE;
				return $status;
			}
		}		
	}

	public function api_key_crypt( $string, $action ) {
	    $secret_key = '78042eb7023459f45296fb2eb07edf9c';
	    $secret_iv = '2d970453cf23216fa0d96e4a56308b82';

	    $output = false;
	    $encrypt_method = "AES-256-CBC";
	    $key = hash( 'sha256', $secret_key );
	    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

	    if( $action == 'e' ) {
	        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
	    }
	    else if( $action == 'd' ){
	        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
	    }

	    return $output;
	}

	

	public function user_data(){
		return $this->db->where("is_deleted","0")->where("status","Active")->where("student_id",$this->session->userdata('student_id'))->get("tbl_students")->row();
	}
}
