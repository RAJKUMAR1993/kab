<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Speaker_login_model extends CI_model {

	public function login($email = null,$password=null, $client=null){

		$check_email = $this->db->where("speaker_email",$email)->where("is_deleted",'0')->where("speaker_status",'Active')->get("tbl_speakers")->num_rows();
		$return=[];
		if($check_email > 0){
		

			$query = $this->db->where("speaker_email",$email)->where("password",$this->api_key_crypt($password,'e'))->where("is_deleted",'0')->where("speaker_status","Active")->get("tbl_speakers");
			if($query->num_rows() >0){

				$user_data = $query->row_array();
				$this->session->set_userdata(array('logged_in' =>TRUE ,'speaker_id'=>$user_data['speaker_id'],'speaker_name'=>$user_data['speaker_name'],'email'=>$user_data['speaker_email'],'login_type'=>'speaker','speaker_inst_id'=>$user_data['institute_id']));
				
				$status['status'] = TRUE;
				$status['type'] = 'speaker';
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
		return $this->db->where("is_deleted","0")->where("speaker_status","Active")->where("speaker_id",$this->session->userdata('speaker_id'))->get("tbl_speakers")->row();
	}
}
