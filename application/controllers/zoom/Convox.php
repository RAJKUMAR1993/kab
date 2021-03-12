<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Convox extends CI_Controller {

   public function index(){
		
		$convoxdata = $this->db->get_where("tbl_convoxcall_logs",["recording_path"=>"","convoxref_id !="=>""])->result();
		$zdata = $this->login_model->get_option("audioconversiontool"); 
	   
		foreach($convoxdata as $cvd){
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_URL,"$zdata->get_call_patching=$cvd->student_mobile");
			$response=curl_exec($ch);
			curl_close($ch);
			
			$this->db->insert("tbl_convox_call_temp_data",["data"=>strip_tags($response)]);
			$cid = $this->db->insert_id();
			
			$cc = $this->updateConvoxdata($cid,$cvd->convoxref_id);
			
		}
	}

	public function updateConvoxdata($cid,$convoxref_id){
		
		if($cid){
			
			$response = $this->db->get_where("tbl_convox_call_temp_data",["id"=>$cid])->row()->data;
			$dd = json_decode($response);
			$zdata = $this->login_model->get_option("videoconversiontool");
			
			foreach($dd as $d){

				$cdata = json_decode($d);

				if(($cdata->call_referenceno_2 == $convoxref_id) && ($cdata->recording_path != "")){

					$recording_path = str_replace("var/www/html/","",$cdata->recording_path);
					$student_status = $cdata->status1;
					$institute_status = $cdata->status2;
					$student_call_duration = $cdata->duration1;
					$institute_call_duration = $cdata->duration2;
					$student_call_answered_time = $cdata->entry_date1;
					$institute_call_answered_time = $cdata->entry_date2;

					$filename = basename($recording_path);
					$content = file_get_contents($recording_path);
					file_put_contents("uploads/convox/$filename", $content);

					$recorded_file = "uploads/convox/$filename";

					$this->db->where("convoxref_id",$cdata->call_referenceno_2)->update("tbl_convoxcall_logs",["student_call_status"=>$student_status,"institute_call_status"=>$institute_status,"student_call_duration"=>$student_call_duration,"institute_call_duration"=>$institute_call_duration,"student_call_answered_time"=>$student_call_answered_time,"institute_call_answered_time"=>$institute_call_answered_time,"recording_path"=>$recording_path,"recorded_file"=>$recorded_file]);
					
					
					$file = "$recorded_file";
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
					curl_setopt($ch, CURLOPT_URL, "$zdata->url");
					curl_setopt($ch, CURLOPT_POST,1);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					$result = curl_exec($ch);
			//		curl_close($ch);

					if (curl_errno($ch)) {
					   $result = curl_error($ch);
					}

					$f = json_decode($result);

					if($f->status == "success"){

						$query = $this->db->where("convoxref_id",$cdata->call_referenceno_2)->update("tbl_convoxcall_logs", ["converted_text_url" => $f->url]);

					}

				}

			}
			
			$this->db->where(["id"=>$cid])->delete("tbl_convox_call_temp_data");
			
		}
		
	}
	
	
	public function updateText(){
				
		$meetings = $this->db->where(["recording_path !="=>"","converted_text_url !="=>"","converted_text"=>""])->get("tbl_convoxcall_logs")->result();

		foreach($meetings as $m){
			
			$data = trim($this->convertText($m->converted_text_url));
//			echo ($data);
			
			if($data != strip_tags($data)){
				
			}else{
			
				$this->db->where("id",$m->id)->update("tbl_convoxcall_logs",["converted_text"=>$data]);
				
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
	
}