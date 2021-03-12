<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expert_login_model extends CI_model {

	public function login($email = null,$password=null, $client=null){

		$check_email = $this->db->where("expert_email",$email)->where("is_deleted",'0')->where("expert_status",'Active')->get("tbl_experts")->num_rows();
		$return=[];
		if($check_email > 0){
		

			$query = $this->db->where("expert_email",$email)->where("password",$this->api_key_crypt($password,'e'))->where("is_deleted",'0')->where("expert_status","Active")->get("tbl_experts");
			if($query->num_rows() >0){

				$user_data = $query->row_array();
				$this->session->set_userdata(array('logged_in' =>TRUE ,'expert_id'=>$user_data['expert_id'],'expert_name'=>$user_data['expert_name'],'email'=>$user_data['expert_email'],'login_type'=>'expert','expert_inst_id'=>$user_data['institute_id']));
				
				$status['status'] = TRUE;
				$status['type'] = 'expert';
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
		return $this->db->where("is_deleted","0")->where("expert_status","Active")->where("expert_id",$this->session->userdata('expert_id'))->get("tbl_experts")->row();
	}
}
