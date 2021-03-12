<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Institute_login_model extends CI_model {

	public function login($email = null,$password=null, $client=null){

		$check_email = $this->db->where("email",$email)->where("is_active",'0')->where("is_deleted",'0')->where("status",'Active')->get("tbl_institutes")->num_rows();
		$return=[];
		if($check_email > 0){
		

			$query = $this->db->where("email",$email)->where("is_active",'0')->where("password",$this->api_key_crypt($password,'e'))->where("is_deleted",'0')->where("status","Active")->get("tbl_institutes");
			if($query->num_rows() >0){

				$user_data = $query->row_array();
				$this->session->set_userdata(array('logged_in' =>TRUE ,'institute_id'=>$user_data['institute_id'],'institute_name'=>$user_data['institute_name'],'email'=>$user_data['email'],'login_type'=>'institute'));
				
				$this->db->where("institute_id",$user_data['institute_id'])->update("tbl_institutes",["login_status"=>1]);
				
				$status['status'] = TRUE;
				$status['type'] = 'institute';
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
		return $this->db->where("is_deleted","0")->where("status","Active")->where("institute_id",$this->session->userdata('institute_id'))->get("tbl_institutes")->row();
	}
}
