<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SaveZoomRecordings extends CI_Controller {

    public function index(){
		
        //Professor Sessions
        $pSessions = $this->db->select("pro_se_id, professor_id")->where("is_deleted", 0)->get("tbl_professor_sessions")->result();
        foreach ($pSessions as $psession) {
            $zoom = $this->db->select("meeting_id")->where("professor_id", $psession->professor_id)->where("session_id", $psession->pro_se_id)->where("play_url",NULL)->get("tbl_zoom_meetings")->row();
			
            if($zoom->meeting_id!='' && $zoom->meeting_id!='2147483647'){
               $this->videorecord($zoom->meeting_id);
            }
        }
		
        //Professor Sessions
        //Speaker Sessions
        $sSessions = $this->db->select("spe_se_id, speaker_id")->where("is_deleted", 0)->get("tbl_speaker_sessions")->result();
        foreach ($sSessions as $ssession) {
            $zoom = $this->db->select("meeting_id")->where("speaker_id", $ssession->speaker_id)->where("session_id", $ssession->spe_se_id)->where("play_url",NULL)->get("tbl_zoom_meetings")->row();
            if($zoom->meeting_id!='' && $zoom->meeting_id!='2147483647'){
                $this->videorecord($zoom->meeting_id);
            }
        }
        //Speaker Sessions
        //Exper Sessions
        $eSessions = $this->db->select("exp_se_id, expert_id")->where("is_deleted", 0)->get("tbl_expert_sessions")->result();
        foreach ($eSessions as $esession) {
            $zoom = $this->db->select("meeting_id")->where("expert_id", $esession->expert_id)->where("session_id", $esession->exp_se_id)->where("play_url",NULL)->get("tbl_zoom_meetings")->row();
            if($zoom->meeting_id!='' && $zoom->meeting_id!='2147483647'){
                $this->videorecord($zoom->meeting_id);
            }
        }
        //Expert Sessions
        //Councellor Sessions
        $cSessions = $this->db->select("exp_se_id, expert_id")->where("is_deleted", 0)->get("tbl_counsellor_sessions")->result();
        foreach ($cSessions as $csession) {
            $zoom = $this->db->select("meeting_id")->where("councellor_id", $csession->expert_id)->where("session_id", $csession->exp_se_id)->where("play_url",NULL)->get("tbl_zoom_meetings")->row();
            if($zoom->meeting_id!='' && $zoom->meeting_id!='2147483647'){
                $this->videorecord($zoom->meeting_id);
            }
        }
        //Councellor Sessions
        //Webinars
        $webinars = $this->db->select("id")->get("tbl_webinors")->result();
        foreach ($webinars as $webinar) {
            $zoom = $this->db->select("meeting_id")->where("webinar_id", $webinar->id)->where("play_url",NULL)->get("tbl_zoom_meetings")->row();
            if($zoom->meeting_id!='' && $zoom->meeting_id!='2147483647'){
                $this->videorecord($zoom->meeting_id);
            }
        }
        //Webinars
		
		//auditoriums
        $webinars = $this->db->select("id,institute_id")->get("tbl_institute_presentations")->result();
        foreach ($webinars as $webinar) {
            $zoom = $this->db->select("meeting_id")->where("user_id", $webinar->institute_id)->where("session_id", $webinar->id)->where("play_url",NULL)->get("tbl_zoom_meetings")->row();
            if($zoom->meeting_id!='' && $zoom->meeting_id!='2147483647'){
                $this->videorecord($zoom->meeting_id);
            }
        }
        //auditoriums
		
		
		//AO Video connect
        $vconnects = $this->db->select("id,meeting_id")->get_where("tbl_college_connect",["play_url"=>""])->result();
        foreach ($vconnects as $vc) {
            if($vc->meeting_id!='' && $vc->meeting_id!='2147483647'){
                $this->videorecord($vc->meeting_id,"vconnect");
            }
        }
        //auditoriums
    }

	public function videorecord($meetingId,$vc="") {
		
        if($meetingId!=''){
            if(!file_exists("assets/zoomvideos/".$meetingId.'.mp4')){
				
                $client = new GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);
                $arr_token = $this->accesstoken->get_access_token();
                $accessToken = $arr_token->access_token;
                $dataArray = [
                    "headers" => [
                        "Authorization" => "Bearer $accessToken"
                    ]
                ];
                try{
                    $response = $client->request('GET', '/v2/meetings/'.$meetingId.'/recordings', $dataArray);
                    $data = json_decode($response->getBody());
					
                    if(isset($data->recording_files)){
                        if(count($data->recording_files)>0){
							
							$zdata = $this->login_model->get_option("videoconversiontool");
							
                            foreach ($data->recording_files as $recording) {
                                 if($recording->file_type=='MP4' && $recording->play_url){
									 if($vc == "vconnect"){
                                     	$query = $this->db->where("meeting_id", $meetingId)->update("tbl_college_connect", ["play_url" => "assets/zoomvideos/".$meetingId.'.mp4']);
//                                     echo $meetingId.' - '.$recording->play_url.' - '.$query;
									 }else{
										 $query = $this->db->where("meeting_id", $meetingId)->update("tbl_zoom_meetings", ["play_url" => "assets/zoomvideos/".$meetingId.'.mp4']);
									 }
                                 }
                                if($recording->file_type=='MP4' && $recording->download_url){
                                    $src = $recording->download_url;
                                    $meeting_id = $data->id;
                                    $fileName = $meeting_id.'.mp4';
                                    $dest = getcwd().DIRECTORY_SEPARATOR."assets\zoomvideos".DIRECTORY_SEPARATOR.$fileName;
                                    $ch = curl_init($src);
                                    curl_exec($ch);
                                    if (!curl_errno($ch)) {
                                        $info = curl_getinfo($ch);
                                        $downloadLink = $info['redirect_url'];
                                    }
                                    curl_close($ch);

                                    if($downloadLink) {
                                        copy($downloadLink, $dest);
                                    }
//                                    if(file_exists(getcwd().DIRECTORY_SEPARATOR."assets\zoomvideos".DIRECTORY_SEPARATOR.$fileName)){
                                    
									$file = $_SERVER['DOCUMENT_ROOT']."/assets/zoomvideos/$fileName";
									$mime = mime_content_type($file);
									$info = pathinfo($file);
									$name = $info['basename'];
									$output = new CURLFile($file, $mime, $name);

						// APIASR details			
									
									$data = array(
										'file' => $output,
										'user_id' => 12345,
										'secret_key' => 'secret_key',
										'language' => 'english'
									);
									$ch = curl_init();
									curl_setopt($ch, CURLOPT_URL, "$zdata->url");
									curl_setopt($ch, CURLOPT_POST,1);
									curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
									curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
									$result = curl_exec($ch);
							//		curl_close($ch);

									/*if (curl_errno($ch)) {
									   $result = curl_error($ch);
									}*/

									$f = json_decode($result);

									if($f->status == "success"){

										if($vc == "vconnect"){
											$query = $this->db->where("meeting_id", $meetingId)->update("tbl_college_connect", ["textapi_url" => $f->url]);
										 }else{
											$query = $this->db->where("meeting_id", $meetingId)->update("tbl_zoom_meetings", ["textapi_url" => $f->url]);
										}

									}
                                }
                            }
                        }
                    }
					
                } catch(Exception $e) {
					if( 401 == $e->getCode() ) {
                        $refresh_token = $this->accesstoken->get_refersh_token();
             
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
                        $this->accesstoken->update_access_token($response->getBody());
             
//                        $this->videorecord($meeting_id);
                    } else {
                        echo "No recordings found.<br>";
                    }
                }
            }
        }
	}
	
	public function updateText(){
				
		$meetings = $this->db->where(["play_url !="=>"","textapi_url !="=>"","converted_text"=>""])->get("tbl_zoom_meetings")->result();

		foreach($meetings as $m){
			
			$data = $this->convertText($m->textapi_url);
//			echo ($data);
			
			if($data != strip_tags($data)){
				
			}else{
			
				$this->db->where("id",$m->id)->update("tbl_zoom_meetings",["converted_text"=>$data]);
				
			}
		}
		
	}
	
	public function updateVideoconnecttext(){
				
		$meetings = $this->db->where(["play_url !="=>"","textapi_url !="=>"","converted_text"=>""])->get("tbl_college_connect")->result();

		foreach($meetings as $m){
			
			$data = $this->convertText($m->textapi_url);
//			echo ($data);
			
			if($data != strip_tags($data)){
				
			}else{
			
				$this->db->where("id",$m->id)->update("tbl_college_connect",["converted_text"=>$data]);
				
			}
		}
		
	}
	
	public function convertText($link){
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"$link");
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, []);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$result=curl_exec($ch);
		curl_close ($ch);
		
		return $result;
		
	}
	
	public function test(){
		
		$file = $_SERVER['DOCUMENT_ROOT']."/assets/videos/91048.mp4";
		$mime = mime_content_type($file);
		$info = pathinfo($file);
		$name = $info['basename'];
		$output = new CURLFile($file, $mime, $name);

		$data = array(
			'file' => $output,
			'user_id' => 12345,
			'secret_key' => 'secret_key',
			'language' => 'english'
		);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://74.208.185.113:1999/api_asr');
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($ch);
//		curl_close($ch);

		/*if (curl_errno($ch)) {
		   $result = curl_error($ch);
		}*/

		$f = json_decode($result);

		print_r($f);
		
	}
	
}