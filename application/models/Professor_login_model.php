<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Professor_login_model extends CI_model {

	public function login($email = null,$password=null, $client=null){

		$check_email = $this->db->where("pro_email",$email)->where("is_deleted",'0')->where("pro_status",'Active')->get("tbl_professors")->num_rows();
		$return=[];
		if($check_email > 0){
		

			$query = $this->db->where("pro_email",$email)->where("password",$this->api_key_crypt($password,'e'))->where("is_deleted",'0')->where("pro_status","Active")->get("tbl_professors");
			if($query->num_rows() >0){

				$user_data = $query->row_array();
				$this->session->set_userdata(array('logged_in' =>TRUE ,'pro_id'=>$user_data['pro_id'],'pro_name'=>$user_data['pro_name'],'email'=>$user_data['pro_email'],'login_type'=>'professor','pro_inst_id'=>$user_data['institute_id']));
				
				$status['status'] = TRUE;
				$status['type'] = 'professor';
				return $status;
			}else{
				$status['status'] = FALSE;
				return $status;
			}
		}		
	}

	public function api_key_crypt( $string, $action ) {
	    $secret_key = 'eaa09eef9bfd61e76b7b5e501db776d9';
	    $secret_iv = '2ac11a0bfefe75a3486a7486ac65100c';

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
		return $this->db->where("pro_status","Active")->where("pro_id",$this->session->userdata('pro_id'))->get("tbl_professors")->row();
	}

	public function check_otp($phone = null){
		return $this->db->where("mobile1",$phone)->where("is_deleted",'0')->get("tbl_professors")->row();
	}

	public function check_phone($phone=NULL){
		$check = $this->db->where("is_deleted",'0')->where("mobile1",$phone)->where("pro_status",'Active')->get("tbl_professors")->num_rows();
		if($check >0){
			return false;
		}else{
			return TRUE;
		}
	}

	public function check_email($email=NULL){
		$check = $this->db->where("is_deleted",'0')->where("pro_status",'Active')->where("pro_email",$email)->get("tbl_professors")->num_rows();
		if($check >0){
			return false;
		}else{
			return TRUE;
		}
	}
}
