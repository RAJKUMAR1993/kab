<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$datetime = date("Y-m-d H:i:s");
		$timetoseconds = strtotime($datetime);
		$data['sliders'] = $this->homepage_model->get_slider();
		$data['news'] = $this->homepage_model->get_news();
		$data['cards'] = $this->db->where("is_deleted",'0')->get("tbl_cards")->result();
		$data['testimonials'] = $this->db->where("is_deleted",'0')->get("tbl_testimonials")->result();
		$data['partners'] = $this->db->where("is_deleted",'0')->get("tbl_partners")->result();
		$data['webinor_dates'] = $this->db->select("id, date")->order_by("tbl_webinors.date", "asc")->where("tbl_webinors.from_time >= ".$timetoseconds." OR tbl_webinors.to_time >= ".$timetoseconds)->group_by("date")->limit(3)->get("tbl_webinors")->result();
		$data['foot_dec'] = $this->db->get_where("tbl_footer_description")->row();

		$this->load->view('new_home',$data);
	}
	
	public function disclaimer(){
		$data["disclaimer"] = $this->db->get_where("tbl_admin")->row()->disclaimer;
		$this->load->view('disclaimer', $data);
	}
	
	
	public function add_timer(){
		$data = array(
			"name" =>$this->input->post("time")
		);
		$this->db->insert("names",$data);
	}
	public function termsandconditions(){
		$data["termsandconditions"] = $this->db->get_where("tbl_admin")->row()->website_termsandconditions;
		$this->load->view('termsandconditions', $data);
	}
	public function privacypolicy(){
		$data["privacypolicy"] = $this->db->get_where("tbl_admin")->row()->website_privacypolicy;
		$this->load->view('privacypolicy', $data);
	}
	public function cancellation(){
		$data["cancellation"] = $this->db->get_where("tbl_admin")->row()->website_cancellation;
		$this->load->view('cancellation', $data);
	}
	
	public function sendmessage(){
		
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://164.52.203.175:8000/parse",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS =>"{\n\t\"text\" : \"Hi\"\n}",
		  CURLOPT_HTTPHEADER => array(
			"contentType: application/json",
			"Content-Type: application/json"
		  ),
		));

		$response = curl_exec($curl);
		curl_close($curl);
		
		$data = json_decode($response);
		$returnMsg = $data->directives[0]->payload->text;
		
		if($returnMsg){
			
			echo json_encode(["status"=>"success","received_msg"=>$returnMsg,"time"=>date("h:i A | M d")]);
			
		}else{
			
			echo json_encode(["status"=>"fail"]);
			
		}
	}
	
	public function convoxcall($smobile,$conmobile){
		
		$zdata = $this->login_model->get_option("audioconversiontool"); 

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "$zdata->user_conference=$smobile,$conmobile",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1
		));

		$response = curl_exec($curl);
		curl_close($curl);
		
		$res = explode(" ",$response); 
		if($res[7] != ""){
		
			$sid = $this->input->post("student_id");
			$iid = $this->input->post("institute_id");
			$data = ["student_id"=>$sid,"institute_id"=>$iid,"student_mobile"=>$smobile,"institute_mobile"=>$conmobile,"convoxref_id"=>$res[7]];
			$this->db->insert("tbl_convoxcall_logs",$data);
			
			echo "success";
			
		}else{
			
			echo "error";
			
		}
		
	}
	
	
	public function testgd(){
		
		$powerpnt = new COM("PowerPoint.Application") or die("Unable to instantiate Powerpoint");
		$presentation = $powerpnt->Presentations->Open(realpath("assets/images/brochure/2-Graduate-Outcomes-Prof-N-Siva-Prasad.pptx"), false, false, false) or die("Unable to open presentation");
		foreach($presentation->Slides as $slide)
		{
			$slideName = "Slide_" . $slide->SlideNumber;
			$exportFolder = realpath("uploads/");
			$slide->Export($exportFolder."\\\\".$slideName.".jpg", "jpg", "600", "400");
		}
		$powerpnt->quit();
		
	}
	
}
