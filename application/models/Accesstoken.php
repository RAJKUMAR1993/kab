<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accesstoken extends CI_model {
	
	public function __construct(){
		parent::__construct();
		$this->admin_email = $this->login_model->get_option("admin_email_id")->email;
	}
	
	public function is_table_empty() {
        $result = $this->db->query("SELECT id FROM tbl_token");
        if($result->num_rows()) {
            return false;
        }
  
        return true;
    }
  
    public function get_access_token() {
        $sql = $this->db->query("SELECT access_token FROM tbl_token");
        $result = $sql->result();
        return json_decode($result[0]->access_token);
    }
  
    public function get_refersh_token() {
        $result = $this->get_access_token();
        return $result->refresh_token;
    }
  
    public function update_access_token($token) {
        if($this->is_table_empty()) {
            $this->db->query("INSERT INTO tbl_token(access_token) VALUES('$token')");
        } else {
            $this->db->query("UPDATE tbl_token SET access_token = '$token' WHERE id = 2");
        }
    }
    public function create_meeting($user_type, $title, $start_time, $duration, $session_id, $user_id, $flag = 0) {
        $client = new GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);
     
        $arr_token = $this->get_access_token();
        $accessToken = $arr_token->access_token;

        $dataArray = [
            "headers" => [
                "Authorization" => "Bearer $accessToken"
            ],
            'json' => [
                "topic" => $title,
                "type" => 2,
                "start_time" => $start_time,
                "duration" => $duration, // 30 mins
                "password" => $session_id.'_'.$this->generateRandomString(6)
            ],
        ];

        try {
            $response = $client->request('POST', '/v2/users/me/meetings', $dataArray);
            
            $data = json_decode($response->getBody());
            if($flag == 2){
                //echo $data->join_url;
                $meetingArray = array(
					"meeting_id" => $data->id,
                    "zoom_link" => $data->join_url,
                    "zoom_password" => $data->password
                );
                $save_meeting = $this->db->where("id", $session_id)->update("tbl_college_connect", $meetingArray);
            }
            else{
                $meetingArray = array(
                    "meeting_id" => $data->id,
                    "meeting_link" => $data->join_url,
                    "meeting_password" => $data->password
                );
                if($flag==1){
                    $meetingArray["professor_ids"] = $user_id;
                    $meetingArray["webinar_id"] = $session_id;
                    $check = $this->db->where("webinar_id", $session_id)->get("tbl_zoom_meetings");
                }
                else{
                    $check = $this->db->select("*")->where("session_id", $session_id);
                    switch ($user_type) {
                        case 1:
                            $meetingArray["professor_id"] = $user_id;
                            $check = $check->where("professor_id", $user_id);
                            break;
                        case 2:
                            $meetingArray["speaker_id"] = $user_id;
                            $check = $check->where("speaker_id", $user_id);
                            break;
                        case 3:
                            $meetingArray["expert_id"] = $user_id;
                            $check = $check->where("expert_id", $user_id);
                            break;
                        case 4:
                            $meetingArray["councellor_id"] = $user_id;
                            $check = $check->where("councellor_id", $user_id);
                            break;
                        case 5:
                            $meetingArray["user_id"] = $user_id;
                            $check = $check->where("user_id", $user_id);
                            break;
                        
                        default:
                            # code...
                            break;
                    }
                    $meetingArray["session_id"] = $session_id;
                    $check = $check->get("tbl_zoom_meetings");
                }
                
                if($check->num_rows() == 0){
                    $save_meeting = $this->db->insert("tbl_zoom_meetings", $meetingArray);
                }
                else{
                    if($flag==1){
                        $save_meeting = $this->db->where("webinar_id", $session_id)->update("tbl_zoom_meetings", $meetingArray);
                    }
                    else{
                        $save_meeting = $this->db->where("session_id", $session_id);
                        switch ($user_type) {
                            case 1:
                                $save_meeting = $save_meeting->where("professor_id", $user_id);
                                break;
                            case 2:
                                $save_meeting = $save_meeting->where("speaker_id", $user_id);
                                break;
                            case 3:
                                $save_meeting = $save_meeting->where("expert_id", $user_id);
                                break;
                            case 4:
                                $save_meeting = $save_meeting->where("councellor_id", $user_id);
                                break;
                            case 5:
                                $save_meeting = $save_meeting->where("user_id", $user_id);
                                break;
                            
                            default:
                                # code...
                                break;
                        }
                        $save_meeting = $save_meeting->update("tbl_zoom_meetings", $meetingArray);
                    }
                }
                if($flag==1){
                    $this->sendMailToGuest($meetingArray);
                }
            }
     
        } catch(Exception $e) {
            if( 401 == $e->getCode() ) {
                $refresh_token = $this->get_refersh_token();
     
                $client = new GuzzleHttp\Client(['base_uri' => 'https://zoom.us']);
                $response = $client->request('POST', '/oauth/token', [
                    "headers" => [
                        "Authorization" => "Basic ". base64_encode(CLIENT_ID.':'.CLIENT_SECRET)
                    ],
                    'form_params' => [
                        "grant_type" => "refresh_token",
                        "refresh_token" => $refresh_token
                    ],
                ]);
                $this->update_access_token($response->getBody());
     
                $this->create_meeting($user_type, $title, $start_time, $duration, $session_id, $user_id, $f = $flag);
            } else {
                // $data1=["Status"=>'InActive',"Message"=>$e->getMessage()];
                // echo json_encode($data1);
                // exit();
                return false;
            }
        }
    }
    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function sendMailToGuest($array){
        $webinar_id = $array['webinar_id'];
        $webinar = $this->db->get_where("tbl_webinors", ["id" => $webinar_id])->row();
        $guests = $webinar->guest_ids;
        if($guests!=''){
            $guests_array = explode(',', $guests);
            if(count($guests_array)>0){
                foreach ($guests_array as $guest_id) {
                    $guest = $this->db->get_where("tbl_webinar_guests", ["id" => $guest_id])->row();
                    $email = $guest->email;
                    if($email!=''){
                        $msg = $msg = '<html><body><small>Zoom Link : '.date('Y-m-d H:i:s', $webinar->from_time).'</small><br> <small>Zoom Link : '.date('Y-m-d H:i:s', $webinar->to_time).'</small><br> <small>Zoom Link : '.$array['meeting_link'].'</small><br> <small>Zoom Password : '.$array['meeting_password'].'</small></body></html>';
                
                        $from = "$this->admin_email";
                        $subject = "Zoom Meeting Details";
                        $to = $email;
                        $this->login_model->sendMail($from,$to,$subject,$msg);
                    }
                }
            }
        }
    }

}