<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');

class Login_model extends CI_model {

	public function __construct(){
		parent::__construct();
		$this->admin_email = $this->get_option("admin_email_id")->email;
	}
	
	public function login($email = null,$password=null){

		$check_email = $this->db->where("email",$email)->get("tbl_admin")->num_rows();
		$return=[];
		if($check_email > 0){
			$query = $this->db->where("email",$email)->where("password",$this->api_key_crypt($password,'e'))->get("tbl_admin");
			if($query->num_rows() >0){

				$admin_data = $query->row_array();
				$this->session->set_userdata(array('logged_in' =>TRUE ,'admin_id'=>$admin_data['id'],'admin_name'=>$admin_data['name'],'admin_email'=>$admin_data['email'],'login_type'=>'admin'));
				$this->db->insert("tbl_login_history",$this->agent());
				$status['status'] = TRUE;
				$status['type'] = 'admin';
				return $status;
			}else{
				$status['status'] = FALSE;
				return $status;
			}
		}else{
			$check_user_email = $this->db->where("email",$email)->where("status","Active")->get("tbl_users")->num_rows();
			if($check_user_email > 0){
				$query2 = $this->db->where("email",$email)->where("password",$this->api_key_crypt($password,'e'))->get("tbl_users");
				if($query2->num_rows() >0){
					$user_data = $query2->row_array();
					$this->session->set_userdata(array('logged_in' =>TRUE ,'admin_id'=>$user_data['id'],'admin_name'=>$user_data['username'],'admin_email'=>$user_data['email'],'login_type'=>'admin','user_login' => 1,'permissions' => explode(',', $user_data['menu_permissions'])));
					$this->db->insert("tbl_login_history",$this->agent());
					$status['status'] = TRUE;
					$status['type'] = 'admin';
					return $status;
				}else{
					$status['status'] = FALSE;
					return $status;
				}
			}

		}/*else{
			$check_institute_email = $this->db->where("email",$email)->where("status","Active")->get("tbl_institutes")->num_rows();
			if($check_institute_email > 0){
				$query2 = $this->db->where("email",$email)->where("password",$this->api_key_crypt($password,'e'))->get("tbl_institutes");
				if($query2->num_rows() >0){
					$institute_data = $query2->row_array();
					$this->session->set_userdata(array('logged_in' =>TRUE ,'institute_id'=>$institute_data['institute_id'],'institute_name'=>$institute_data['institute_name'],'institute_email'=>$institute_data['email'],'login_type'=>'institute'));
					$status['status'] = TRUE;
					$status['type'] = 'institute';
					return $status;
				}else{
					$status['status'] = FALSE;
					return $status;
				}
			}

		}*/
		
	}

	public function api_key_crypt( $string, $action ) {
	    $secret_key = '07a565b377ff6ecf93167a3eb1647086';
	    $secret_iv = '4cd41f88ed43d2c035e67bfd9c383962';
/*
	    $secret_key = '8311607428b8f69b6d18502535221341';
	    $secret_iv = 'd501190ee16e631af40e08f59b28a4a3';*/

	    $output = false;
	    $encrypt_method = "AES-256-CBC";
	    $key = hash( 'sha256', $secret_key );
	    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

	    if( $action == 'e') {
	        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
	    }
	    else if( $action == 'd' ){
	        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
	    }

	    return $output;
	}

	public function agent(){
		if ($this->agent->is_browser())
			{
			        $data['agent'] = $this->agent->browser().' '.$this->agent->version();
			}
			elseif ($this->agent->is_robot())
			{
			       $data['agent'] = $this->agent->robot();
			}
			elseif ($this->agent->is_mobile())
			{
			       $data['agent'] = $this->agent->mobile();
			}
			else
			{
			       $data['agent'] = 'Unidentified User Agent';
			}

			$data['platform']= $this->agent->platform(); 
			$data['ip_address'] = $_SERVER['SERVER_ADDR'];
			return $data;
	}

/*
	public function sendMail($from,$to,$sub,$msg)
	{
		//SMTP & mail configuration
		$config = array(
		    'protocol'  => 'smtp',
		    'smtp_host' => 'smtp-relay.sendinblue.com',
		    'smtp_port' => 587,
		    'smtp_user' => '$this->admin_email',
		    'smtp_pass' => 'gD1KRk5p6w8VZaxs',
		    'mailtype'  => 'html',
		    'charset'   => 'utf-8'
		);
		$this->email->initialize($config);
		$this->email->set_mailtype("html");
		$this->email->set_newline("\r\n");

		//Email content
		$htmlContent = $msg;

		$this->email->to($to);
		$this->email->from($from);
		$this->email->subject($sub);
		$this->email->message($htmlContent);

		//Send email
		$res = $this->email->send();
		return $res;

	}
*/
	
	public function get_option($option){
		
		$row = $this->db->get_where('tbl_options',["option_short_name"=>"$option"])->row();
		$zdata = json_decode($row->option_value);
		return $zdata;
		
	}
	
	public function sendMail($from,$to,$sub,$msg){
		
		  $zdata = $this->login_model->get_option("sendinblue");

		  $mailin = new Mailin("$zdata->url","$zdata->key");
			$data = array( "to" => array($to=>$to),
				"from" => array($from, $from),
				"subject" => $sub,
				"html" => $msg
		 );

			$response = $mailin->send_email($data);
			return $response;
	}

	
	public function sendSMS($mobile,$msg){
		
		$zdata = $this->login_model->get_option("smscountry");
		
		//Please Enter Your Details
		$user="$zdata->username"; //your username
		$password="$zdata->password"; //your password
		$mobilenumbers=$mobile; //enter Mobile numbers comma seperated
		$message = $msg; //enter Your Message
		$senderid="$zdata->senderid"; //Your senderid
		$messagetype="N"; //Type Of Your Message
		$DReports="Y"; //Delivery Reports
		$url="$zdata->url";
		$message = urlencode($message);
		$ch = curl_init();
		if (!$ch){die("Couldn't initialize a cURL handle");}
		$ret = curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt ($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt ($ch, CURLOPT_POSTFIELDS,
		"User=$user&passwd=$password&mobilenumber=$mobilenumbers&message=$message&sid=$senderid&mtype=$messagetype&DR=$DReports");
		$ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		//If you are behind proxy then please uncomment below line and provide your proxy ip with port.
		// $ret = curl_setopt($ch, CURLOPT_PROXY, "PROXY IP ADDRESS:PORT");
		$curlresponse = curl_exec($ch); // execute
		if(curl_errno($ch))
		//echo 'curl error : '. curl_error($ch);
		if (empty($ret)) {
		// some kind of an error happened
		die(curl_error($ch));
		curl_close($ch); // close cURL handler
		} else {
		$info = curl_getinfo($ch);
		curl_close($ch); // close cURL handler
		echo $curlresponse; //echo "Message Sent Succesfully" ;
		}
	}

}
