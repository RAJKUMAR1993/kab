<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');

class Institutes extends CI_Controller{

	public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
	
	public function checkInstituteviewtime(){
		
		$sid = $this->input->post("student_id");
		$inst_id = $this->input->post("institute_id");
		$ip_addr = $this->input->ip_address();
		$type = $this->input->post("type");
		$date = date("Y-m-d");
		
		$geolocation = $this->institute_model->getGeo($ip_addr);
		$schk = $this->db->get_where("tbl_student_institute_view_time",["student_id"=>$sid,"institute_id"=>$inst_id,"date"=>$date]);
		
		if($schk->num_rows() == 0){
			
			/* $ip_response = file_get_contents('http://ip-api.com/json/'.$ip_addr);
	        $ip_array=json_decode($ip_response);
			$ip_city = $ip_array->city; */
			
			$time_spent = [["start_time"=>date("Y-m-d H:i:s"),"end_time"=>"","duration"=>""]];
			
			$data = ["student_id"=>$sid,"institute_id"=>$inst_id,"ip_address"=>$ip_addr,"geolocation"=>$geolocation,"date"=>$date,"start_time"=>date("Y-m-d H:i:s"),"status"=>"online","type"=>$type,"time_spent"=>json_encode($time_spent)];

			$this->db->insert("tbl_student_institute_view_time",$data);
			
		}else{
			
			$ctime = date("Y-m-d H:i:s");
			$vdata = $schk->row();
			
			$tspent = json_decode($vdata->time_spent,true);
			$urecord = ["start_time"=>$ctime,"end_time"=>"","duration"=>""];
			
			$tspent[] = $urecord;
			
			$this->db->where(["student_id"=>$sid,"institute_id"=>$inst_id,"date"=>$date])->update("tbl_student_institute_view_time",["status"=>"online","time_spent"=>json_encode($tspent)]);
			
		}
		
	}
	
	public function updateInstituteviewtime(){
		
		$sid = $this->input->post("student_id");
		$inst_id = $this->input->post("institute_id");
		$type = $this->input->post("type");
		$date = date("Y-m-d");
		
		$schk = $this->db->get_where("tbl_student_institute_view_time",["student_id"=>$sid,"institute_id"=>$inst_id,"date"=>$date]);
		
		if($schk->num_rows() == 0){
			
			$time_spent = [["start_time"=>date("Y-m-d H:i:s"),"end_time"=>"","duration"=>""]];
			$data = ["student_id"=>$sid,"institute_id"=>$inst_id,"date"=>$date,"end_time"=>date("Y-m-d H:i:s"),"status"=>"offline","type"=>$type,"time_spent"=>json_encode($time_spent)];
//			$this->db->insert("tbl_student_institute_view_time",$data);
			
		}else{
			
			$ctime = date("Y-m-d H:i:s");
			$vdata = $schk->row();
			
			$tspent = json_decode($vdata->time_spent,true);
			$lastrecord = array_reverse($tspent);
			
			$duration = $this->getMinutes($lastrecord[0]["start_time"],$ctime);
			$urecord = ["start_time"=>$lastrecord[0]["start_time"],"end_time"=>$ctime,"duration"=>$duration];
			
			unset($lastrecord[0]);
			$lastrecord[] = $urecord;
			
			$this->db->where(["student_id"=>$sid,"institute_id"=>$inst_id,"date"=>$date])->update("tbl_student_institute_view_time",["status"=>"offline","end_time"=>date("Y-m-d H:i:s"),"time_spent"=>json_encode($lastrecord)]);
			
		}
		
	}
	
	public function getMinutes($from_time,$to_time){
		
		$start_date = new DateTime($from_time);
		$since_start = $start_date->diff(new DateTime($to_time));
		$minutes = $since_start->days * 24 * 60;
		$minutes += $since_start->h * 60;
		$minutes += $since_start->i;
		return $minutes;
		
	}
	
	public function saveChat(){
		
		$data = $this->input->post();
		$data["student_id"] = ($this->session->userdata("student_id") != "") ? $this->session->userdata("student_id") : $this->session->userdata("guest_id");
		
		if($this->session->userdata("student_id")){
			
			$s = $this->db->get_where("tbl_students",["student_id"=>$this->session->userdata("student_id")])->row();
			$sdata = ["student_name"=>$s->student_name,"phone"=>$s->phone,"email"=>$s->email];
			
		}else{
			
			$sdata = ["student_name"=>$this->session->userdata("guest_name"),"phone"=>$this->session->userdata("guest_mobile"),"email"=>$this->session->userdata("guest_email")];
			
		}
		
		$data["student_data"] = json_encode($sdata);
		$data["date"] = date("Y-m-d");
		
		$this->db->insert("tbl_institute_student_chat_history",$data);
		
	}

	public function checkadmission(){
		
		$data = $this->input->post();

		$chk = $this->db->get_where("tbl_institute_admission",["institute_id"=>$this->input->post('institute_id'), "student_id"=>$this->input->post('student_id'), "course_id"=>$this->input->post('course_id')])->num_rows();

		if( $chk > 0) {

			echo "dublicate";

		} else {
		
			echo "success";
			
		}
	}
	
		public function sendOnloadmail(){
		
		$sdata = $this->db->get_where("tbl_students",["student_id"=>$this->input->post("student_id")])->row();
		$inst_name = $this->input->post("institute_name");
		
		$idata = $this->db->get_where("tbl_institutes",["institute_id"=>$this->input->post("institute_id")])->row();
	
		
// student mail
		
		$msg = '<html><body>Dear '.$sdata->student_name.',Thanks for visiting '.$inst_name.'</body></html>';
		$from = "noreply@kabconsultants.com";
		$subject = "KAB Education Fair";
		$to = $sdata->email;
		$this->login_model->sendMail($from,$to,$subject,$msg);
		
// Institute mail
		
		$msg = '<html><body>
				<p>Visitor Details</p>
				<table class="table-bordered">
					<thead>
						<tr>
							<th align="right">Student Name : </th>
							<td>'.$sdata->student_name.'</td>
						</tr>
						<tr>
							<th align="right">Student Email : </th>
							<td>'.$sdata->email.'</td>
						</tr>
						<tr>
							<th align="right">Mobile Number : </th>
							<td>'.$sdata->phone.'</td>
						</tr>		
							
					</thead>
				</table>
		</body></html>';
		$from = "noreply@kabconsultants.com";
		$subject = "KAB Education Fair";
		$to = $idata->email;
		$this->login_model->sendMail($from,$to,$subject,$msg);
		
// student message		
		
		$mmsg = "Dear $sdata->student_name,Thanks for visiting $inst_name";
		$this->login_model->sendSMS($sdata->phone,$mmsg);
		
// Institute message
		
		
		$mmsg = "Visitor Details Student Name : $sdata->student_name Student Email : $sdata->email Mobile Number : $sdata->phone";
		$this->login_model->sendSMS($idata->phone,$mmsg);
		
		
		$this->session->set_userdata(["sendOnloadmail_status"=>$this->input->post("institute_id")]);
		
	}

	
	public function getScholarshipinfo(){
		
		$cid = $this->input->post("cid");
		
		$data = $this->db->get_where("tbl_courses",["course_id"=>$cid])->row()->merit_scholarship_desc;
		echo $data;
		
	}
	
	public function addtolist(){
		
		$student_id = $this->input->post("student_id");
		$institute_id = $this->input->post("institute_id");
		$video_url = $this->input->post("video_url");
		
		$schk = $this->db->get_where("tbl_exhibitors_students_videos_list",["student_id"=>$student_id]);
		
		if($schk->num_rows() == 1){
			
			$row = $schk->row();
			$videos = json_decode($row->video_links,true);
			
			
			foreach($videos as $video){
				
				if($video['institute_id'] == $institute_id){
					
					echo "exists";
					exit();
					
				}	
				
			}
			
			$cvideo = ["institute_id"=>$institute_id];
			array_push($videos,$cvideo);
			
			$data = ["video_links"=>json_encode($videos)];
			$d = $this->db->where("student_id",$student_id)->update("tbl_exhibitors_students_videos_list",$data);			
			
		}else{
			
			$data = ["student_id"=>$student_id,"video_links"=>json_encode([["institute_id"=>$institute_id,"video_url"=>$video_url]])];
			$d = $this->db->insert("tbl_exhibitors_students_videos_list",$data);
			
		}
		
		if($d){
			
			echo "success";
			
		}else{
			
			echo "fail";
			
		}
		
	}

	public function registration()
	{

		$this->load->view('front/institutes/new_registration');
	}
	
	public function verifyOTP()
	{
		$this->load->view('front/institutes/verifyOTP');
	}

	public function institute_view($id){
		
		$iname = str_replace("-"," ",$id);
		
		$data["idata"] = $this->db->order_by("institute_id","desc")->get_where("tbl_institutes",["institute_name"=>$iname, "live_status"=>1,"is_deleted"=>0])->row();

		$color = $this->db->get_where("tbl_institutes",["institute_id"=>$id, "live_status"=>1])->row()->header_color_code;
		if($color != ""){
			$data['color'] = $color;
		}else{
			$data['color'] = "#372675";
		}
		$data['testimonials'] = $this->db->where(["deleted"=>'0',"status"=>"Active"])->get("tbl_institute_testimonials")->result();
		$data["headers"] = $this->db->where("institute_id",$id)->where("status",0)->get("tbl_menu_header")->result();
		$this->load->view("front/institutes/institution-details",$data);
		
	}

	public function video($id){
		if($this->session->userdata("student_id")){
		$data["vdata"] = $this->db->get_where("tbl_video",["institute_id"=>$id])->result();
		$this->load->view("front/institutes/institution-video",$data);
		} else {
			redirect('student/login');	
		}
	}

	public function gallery($id){
		if($this->session->userdata("student_id")){
			$data["gdata"] = $this->db->get_where("tbl_gallery_title",["institute_id"=>$id])->result();
		$this->load->view("front/institutes/institution-gallery",$data);
		} else {
			redirect('student/login');	
		}
	}

	public function programmefee($id){
		if($this->session->userdata("student_id")){
			$data["pfdata"] = $this->db->get_where("tbl_programmefee",["institute_id"=>$id])->result();
		$this->load->view("front/institutes/institution-fee",$data);
		} else {
			redirect('student/login');	
		}
	}

	public function achievements($id){
		if($this->session->userdata("student_id")){
			$data["adata"] = $this->db->get_where("tbl_achievement",["institute_id"=>$id])->result();
		$this->load->view("front/institutes/institution-achievements",$data);
		} else {
			redirect('student/login');	
		}
	}

	public function placements($id){
		if($this->session->userdata("student_id")){
			$data["pdata"] = $this->db->get_where("tbl_placement",["institute_id"=>$id])->result();
		$this->load->view("front/institutes/institution-placements",$data);
		} else {
			redirect('student/login');	
		}
	}

		public function insertstdip(){
		$lsip = $this->input->ip_address();
		$data = array(
			"student_id" => $this->input->post("stid"),
			"institute_id" => $this->input->post("insid"),
			"ip" => $lsip
		);

		$chk = $this->db->get_where("tbl_studentips",["institute_id"=>$this->input->post('insid'), "student_id"=>$this->input->post('stid'), "ip"=>$lsip])->num_rows();

		if( $chk > 0) {

			echo "dublicate";

		} else {
		
			$d = $this->db->insert("tbl_studentips",$data);
			
			if($d){
				
				echo "success";
				
			}else{
				
				echo "error";
				
			}
		}
		
	}

		public function stdeventbag(){
		
		$data = array(
			"student_id" => $this->input->post("stid"),
			"institute_id" => $this->input->post("insid")
		);

		$chk = $this->db->get_where("tbl_std_eventbag",["institute_id"=>$this->input->post('insid'), "student_id"=>$this->input->post('stid')])->num_rows();

		if( $chk > 0) {

			echo "dublicate";

		} else {
		
			$d = $this->db->insert("tbl_std_eventbag",$data);
			
			if($d){
				
				echo "success";
				
			}else{
				
				echo "error";
				
			}
		}
		
	}


	public function admission($id){
		if($this->session->userdata("student_id")){
			$data["insname"] = $this->db->get_where("tbl_institutes",["institute_id"=>$id])->row()->institute_name;
			$data["about"] = $this->db->get_where("tbl_institutes",["institute_id"=>$id])->row()->aboutinst;
			$data["impnote"] = $this->db->get_where("tbl_institutes",["institute_id"=>$id])->row()->impnote;
			$data["adata"] = $this->db->get_where("tbl_courses",["institute_id"=>$id])->result();
		$this->load->view("front/institutes/institution-admission",$data);
		} else {
			redirect('student/login');	
		}
	}

	public function apply($id){
		if($this->session->userdata("student_id")){
			$data["insname"] = $this->db->get_where("tbl_institutes",["institute_id"=>$id])->row()->institute_name;
			$data["about"] = $this->db->get_where("tbl_institutes",["institute_id"=>$id])->row()->aboutinst;
			$data["impnote"] = $this->db->get_where("tbl_institutes",["institute_id"=>$id])->row()->impnote;
			$data["adata"] = $this->db->get_where("tbl_courses",["institute_id"=>$id])->result();
		$this->load->view("front/institutes/institution-apply",$data);
		} else {
			redirect('student/login');	
		}
	}

	public function insertadmission(){
		
		$data = $this->input->post();

		$chk = $this->db->get_where("tbl_institute_admission",["institute_id"=>$this->input->post('institute_id'), "student_id"=>$this->input->post('student_id'), "course_id"=>$this->input->post('course_id')])->num_rows();

		if( $chk > 0) {

			echo "dublicate";

		} else {
		
			$d = $this->db->insert("tbl_institute_admission",$data);
			
			if($d){
				
				echo "success";
				
			}else{
				
				echo "error";
				
			}
		}
		
	}

	public function updateadmission(){
		$csid = $this->input->post('csid');	
		$status = $this->input->post('status');
		$data = array(
			"status" =>$this->input->post("status")
		);

			$d = $this->db->where("id",$csid)->update("tbl_institute_admission",$data);
			
			if($d){
				
				echo "success";
				
			}else{
				
				echo "error";
				
			}
		
		
	}

	public function feedback($id){
		if($this->session->userdata("student_id")){
			$data["institute_id"] = $id;
		$this->load->view("front/institutes/institution-feedback",$data);
		} else {
			redirect('student/login');	
		}
	}



	public function insertfeedback(){
		$srating = $this->input->post('srating');
		$comment = $this->input->post('comment');
		if($srating!='' || $comment!=''){
			$data = $this->input->post();
			
			$d = $this->db->insert("tbl_institute_feedbackrating",$data);
			
			if($d){
				
				echo "success";
				
			}else{
				
				echo "error";
				
			}
		}
		else{
			echo "empty";
		}
	}

	public function counsellors($id){
		if($this->session->userdata("student_id")){
			$data["sessions"] = $this->db->query("SELECT * FROM tbl_experts LEFT JOIN tbl_expert_sessions ON tbl_experts.expert_id = tbl_expert_sessions.expert_id WHERE tbl_experts.institute_id=".$id." GROUP BY tbl_experts.expert_id ")->result();;
		$this->load->view("front/institutes/institution-counsellors",$data);
		} else {
			redirect('student/login');	
		}
	}

	public function profile($id){
		if($this->session->userdata("student_id")){
			$data['sessions'] = $this->db->query("SELECT * FROM tbl_experts LEFT JOIN tbl_expert_sessions ON tbl_experts.expert_id = tbl_expert_sessions.expert_id WHERE tbl_experts.expert_id=".$id."")->result();
		$this->load->view("front/institutes/institution-expertdetails",$data);
		} else {
			redirect('student/login');	
		}
	}

	public function applynow(){
		
		$data = $this->input->post();
		
		$d = $this->db->insert("tbl_institute_applynow",$data);
		
		if($d){
			
			echo "success";
			
		}else{
			
			echo "error";
			
		}
		
	}

	public function insertQuestion(){
		
		$data = $this->input->post();
		
		$d = $this->db->insert("tbl_institute_ask_a_question",$data);
		
		if($d){
			
			echo "success";
			
		}else{
			
			echo "error";
			
		}
		
	}

	function random_username($user_name)
	{
	 	$new_name = $user_name.mt_rand(0,10000);
	 	return $new_name;//$this->check_user_name($new_name,$user_name);
	}

/*	function check_user_name($new_name,$user_name)
	{
		 $select = $this->db->where("profile_name")->get("tbl_institutes")->num_rows();

		 if($select)
		 {
		  $this->random_username($user_name);
		 }
		 else
		 {
		  echo $new_name;
		 }
	}*/


	public function save_institute(){
		//print_r($_POST);exit;
		$this->form_validation->set_rules('name', 'Institute Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('phone', 'Mobile Number', 'required');

        if ($this->form_validation->run() == FALSE) {
		    $data1=["Status"=>'InActive',"Message"=>validation_errors()];
		 	echo json_encode($data1);
		 	exit();
		} 
		else {
			$mobile = $this->input->post("phone");
			$otp = random_string('alnum', 4);
			
			$cat = "a";
			$permissions = $this->db->get_where("tbl_types",["code"=>$cat])->row()->permissions;
			
			$data = array(
				"institute_name" => $this->input->post("name"),
				"full_name" => $this->input->post("fullname"),
				"designation" => $this->input->post("designation"),
				"email" => $this->input->post("email"),
				"phone" => $this->input->post("phone"),
				"OTP" => $otp,
	//			"address" => $this->input->post("address"),
				"password" => $this->institute_login_model->api_key_crypt( $this->input->post("password"),'e'),
				"category" => $cat,
				"allowed_creation_count" => $permissions,
				"is_active" => 1
			);/*print_r($data);
			 exit;*/
			 $check_phone = $this->institute_model->check_phone($data['phone']);

			 $check_email = $this->institute_model->check_email($data['email']);
				
			if($check_email){
				if($check_phone){
					$this->db->insert("tbl_institutes",$data);
					$insert_id = $this->db->insert_id();				
					$arr = array("Video Gallery","Photo Gallery","Programee Fees","Placements","Achivements","Admission");
					$set = array("Video","photo","pogram","placements","achivements","admissions");
					foreach($arr as $k=>$ar){
						$res_header = array(
						"institute_id" => $insert_id,
						"menu_title" =>	$ar,
						"link" => "#",
	                    "short_name" => $set[$k]					
						);
						$q1 = $this->db->insert("tbl_menu_header",$res_header);
					}
					
					$this->session->set_userdata($_POST);
					
				}else{
	//				$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">Mobile number : '.$data['phone'].' already exist.!</div>');
					//redirect("institute/registration");
					$data1=["Status"=>'InActive',"Message"=>'Mobile number : '.$data['phone'].' already exist.'];
				 	echo json_encode($data1);
				 	exit();
				}
			}else{
	//			$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">Email : '.$data['email'].' already exist.!</div>');
				//redirect("institute/registration");
				$data1=["Status"=>'InActive',"Message"=>'Email : '.$data['email'].' already exist.'];
				echo json_encode($data1);
				exit();
			}

			if($insert_id){
				$msg = "KAB Education institute registration verification OTP is : ".$otp;
				
				$this->session->set_userdata('phone',$mobile);
				$this->session->set_userdata('i_name',$this->input->post("name"));
				
				
				$this->login_model->sendSMS($mobile,$msg);
				//redirect("institute/verifyOTP");
				$data1=["Status"=>'Active',"Message"=>"OTP sent to your mobile ."];
				echo json_encode($data1);
				exit();
			}
		}		
	}


	public function otp_verify_institute(){
		$phone = $this->input->post("mobile");
		$otp = $this->input->post("otp");
		$inst_name = $this->input->post("i_name");
		$mdate = date("Y-m-d H:i:s");
		$chkphone = $this->institute_model->check_otp($phone);
		/*print_r($chkphone);
		exit();*/
		if($chkphone->OTP == $otp){
			$query = $this->db->where("phone",$phone)->where("institute_id",$chkphone->institute_id)->update("tbl_institutes",array('status' =>'Active','modified' =>$mdate,"is_active" => 0 ));
			if($query){
//			$this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">Institute Registered Successfully.!</div>');	
			 //redirect("institute/login");
			$data1=["Status"=>'Active',"Message"=>"Institute Registered Successfully."];
			echo json_encode($data1);

			 	$msg = '<html><body>Dear '.$inst_name.',Thanks for registering with us,please find below are the loign link and details.<br>Link : <a href="'.base_url().'institute/login">Click Here</a><br>User ID : '.$chkphone->email.'<br>Password : '.$this->institute_login_model->api_key_crypt( $chkphone->password,"d").'<br>Admin,kabconsultants</body></html>';
				$from = "noreply@kabconsultants.com";
				$subject = "Login Details : KAB Education Fair";
				$to = $chkphone->email;

				$this->login_model->sendMail($from,$to,$subject,$msg);

			 	$this->session->unset_userdata('phone');
				$this->session->sess_destroy();

			}
		} else {
//				$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">OTP resend your register mobile number. Please Enter correct OTP.!</div>');
				$msg = "KAB Education institute registration verification OTP is : ".$chkphone->OTP;
				//$this->login_model->sendSMS($phone,$msg);
				//redirect("institute/verifyOTP");
				$data1=["Status"=>'Inactive',"Message"=>"Please Enter correct OTP."];
				echo json_encode($data1);
			}
		
	}

	public function resend_OTP(){
		$mobile = $this->input->post("mobile");
		$chkphone = $this->institute_model->check_otp($mobile);
		$otp = $chkphone->OTP;
		$msg = "KAB Education institute registration verification OTP is : ".$otp;
		$this->login_model->sendSMS($mobile,$msg);
		$data=["Status"=>'Active',"Message"=>"OTP resend to your entered mobile number."];
		echo json_encode($data);
		
		
	}

	public function listold($num="")
	{//old exhibitors

		if ($num != "") {
            $pageno = $num;
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 9;
        $offset = ($pageno-1) * $no_of_records_per_page;

        $total_pages_sql = "SELECT COUNT(*) FROM table";
		
		$total_rows = $this->db->query("SELECT * FROM tbl_institutes")->num_rows();
		
       
        $data['total_pages'] = ceil($total_rows / $no_of_records_per_page);
		$data['pageno'] = $pageno;
        $data['inst'] = $this->db->query("SELECT * FROM tbl_institutes LIMIT $offset, $no_of_records_per_page")->result();
		
		$this->load->view('front/institutes/institutions',$data);
	}
	
	public function details()
	{

		$this->load->view('front/institutes/institution-details');
	}
	function search(){//old exhibitors
		if (isset($_POST['query'])) {
			$search_query = $_POST['query'];
			if($search_query != ""){
				$query = $this->db->query("SELECT * FROM tbl_institutes WHERE live_status=1 and is_deleted=0 and institute_name LIKE '$search_query%'")->result();
			
				if(!empty($query)){
					$msg='';
				$msg.='<div class="row heading text-center">';
					foreach($query as $in){				
					$msg.='<div class="col-md-4">
					  <a href="'.base_url().'exhibitors/'.$in->institute_id.'">
						<div class="in-top image"><img src="'.base_url().''.$in->theme_picture.'"   alt="" class="img-fluid" /></div>
						<div class="in-btm">
						  <div class="in-img"><img src="'.base_url().''.$in->logo.'"   alt="" class="img-fluid img-thumbnail"></div>
						  <h3>'.$in->institute_name.'</h3>
						  <p>'.$in->address.'</p>
						</div></a>
					</div>';
					}
                $msg.='</div>';	
				echo $msg;					
				}else{
					 echo "<p style='color:red'>Institute not found...</p>";
				}
			}
            else{
				$query = $this->db->query("SELECT * FROM tbl_institutes WHERE live_status=1 and is_deleted=0")->result();
				$msg='';
				$msg.='<div class="row heading text-center">';
				foreach($query as $in){				
					$msg.='<div class="col-md-4">
					  <a href="'.base_url().'exhibitors/'.$in->institute_id.'">
						<div class="in-top image"><img src="'.base_url().''.$in->theme_picture.'"   alt="" class="img-fluid" /></div>
						<div class="in-btm">
						  <div class="in-img"><img src="'.base_url().''.$in->logo.'"   alt="" class="img-fluid img-thumbnail"></div>
						  <h3>'.$in->institute_name.'</h3>
						  <p>'.$in->address.'</p>
						</div></a>
					</div>';
					}
				$msg.='</div>';	
				echo $msg;	
			}			
		}
	}
	//New Exhibitors
	public function list($num=""){
		$category_id = ($this->input->post("category_id")) ? $this->input->post("category_id") : '';
		$this->session->set_userdata("selected_category_id", $category_id);
		$recordPerPage = 9;
		if ($num != "") {
            $pageno = $num;
        } else {
            $pageno = 1;
        }
        $offset = ($pageno-1) * $recordPerPage;
        $sql = "SELECT * FROM tbl_institutes WHERE live_status=1 and is_deleted=0";
        if($category_id){
        	$sql .= " AND category_id=$category_id";
        }
		$sql .= " ORDER BY RAND()";
		$recordCount = $this->db->query($sql)->num_rows();
		
//		$sql .= " LIMIT $offset, $recordPerPage ORDER BY RAND()";
      	$empRecord = $this->db->query($sql)->result();
		
		
//		echo $this->db->last_query();
//		echo '<pre>';
////		print_r($empRecord);
//		exit();
		
		$config['base_url'] = base_url().'front/institutes/list';
      	$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] = '<ul class="pagination pull-right">';
		$config['full_tag_close'] = '</ul>';
		$config['prev_link'] = 'Previous';
		$config['prev_tag_open'] = '<li class="page-item page-link">';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li class="page-item page-link">';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-link currentpage active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="page-item page-link">';
		$config['num_tag_close'] = '</li>';

		$config['next_link'] = 'Next';
		$config['total_rows'] = $recordCount;
		$config['per_page'] = $recordPerPage;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();       
        $data['inst'] = $empRecord;
        $data['categories'] = $this->db->query("SELECT tbl_institutes.institute_id, tbl_categories.category_id, tbl_categories.category_name, tbl_categories.logo_image FROM tbl_institutes LEFT JOIN tbl_categories ON tbl_categories.category_id=tbl_institutes.category_id where tbl_categories.is_deleted=0 and tbl_categories.status='Active' GROUP BY tbl_institutes.category_id")->result();
        $data['category_id'] = $category_id;
		$data['foot_dec'] = $this->db->get_where("tbl_footer_description")->row();
		$data['year'] = $this->db->get('tbl_admin')->row();  
		//echo $this->db->last_query();die();
		$this->load->view('front/institutes/institutionsnew',$data);
	}
	public function shorlisted_list($num=""){   
	    $student_id = $this->session->userdata("student_id");
		$query = $this->db->query("SELECT * FROM tbl_exhibitors_students_videos_list WHERE student_id='".$student_id."'")->result();
		foreach($query as $qr){
			$insts = json_decode($qr->video_links);
		}
		foreach($insts as $in){
			$in_ids[] = $in->institute_id;
		}
		 $category_id = ($this->input->post("category_id")) ? $this->input->post("category_id") : '';
		$recordPerPage = 9;
		if ($num != "") {
            $pageno = $num;
        } else {
            $pageno = 1;
        }
        $offset = ($pageno-1) * $recordPerPage;
        $sql = "SELECT * FROM `tbl_institutes` WHERE live_status='1'";
        if($category_id){
        	$sql .= "AND category_id='".$category_id."' AND 'institute_id' IN (".implode(',',$in_ids).")";
        }else{
			$sql .= "AND`institute_id` IN (".implode(',',$in_ids).")";
		}
		$recordCount = $this->db->query($sql)->num_rows();
		$sql .= " LIMIT $offset, $recordPerPage";
      	$empRecord = $this->db->query($sql)->result();
		$config['base_url'] = base_url().'front/institutes/list';
      	$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] = '<ul class="pagination pull-right">';
		$config['full_tag_close'] = '</ul>';
		$config['prev_link'] = 'Previous';
		$config['prev_tag_open'] = '<li class="page-item page-link">';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li class="page-item page-link">';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-link currentpage active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="page-item page-link">';
		$config['num_tag_close'] = '</li>';

		$config['next_link'] = 'Next';
		$config['total_rows'] = $recordCount;
		$config['per_page'] = $recordPerPage;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();       
        $data['inst'] = $empRecord;
        $data['categories'] = $this->db->query("SELECT tbl_institutes.institute_id, tbl_categories.category_id, tbl_categories.category_name, tbl_categories.logo_image FROM tbl_institutes LEFT JOIN tbl_categories ON tbl_categories.category_id=tbl_institutes.category_id GROUP BY tbl_institutes.category_id")->result();
        $data['category_id'] = $category_id;
		
		$this->load->view('front/institutes/institutionsnew',$data); 
	}
	public function searchnew(){
		$search_query = (isset($_POST['query'])) ? $_POST['query'] : '';
		$search_category = $this->session->userdata("selected_category_id");
		$sql = "SELECT * FROM tbl_institutes WHERE is_deleted=0 and live_status=1";
		$notmsg = "";
		if($search_query != ""){
			$notmsg = '<p style="color:red;margin-left:18px;font-size:18px;">No Institutions found ...</p>';
			$sql .= " AND institute_name LIKE '%$search_query%'";
		}
		if($search_category != ""){
			$sql .= " AND category_id='".$search_category."'";
		}	
//		$sql .= " LIMIT 0, 9";
		$query = $this->db->query($sql)->result();
		if(!empty($query)){
			$msg = '';
			foreach($query as $in){
				$msg .= '<div class="col-md-3">
							<div class="vid-box">';
				if($in->institute_video) {
					$msg .= '<video class="video-fluid"  loop controls muted><source src="'.base_url().$in->institute_video.'"></video>';
				}else{ 
					if(file_exists($in->theme_picture)){
						$msg .= '<img src="'.base_url().$in->theme_picture.'" class="img-fluid" alt="">';
					}else{
						$msg .= '<img src="'.base_url('assets/images/default.jpg').'" class="img-fluid" alt="">';
					}
				}
				$msg .= '<div class="overlay"><span style="padding: 5px;background-color: black;">
					  	<i class="icon icon-list ';
				if($this->session->userdata("student_id")) { 
					$msg .= 'addtolist"';
					$msg .= ' student_id="'.$this->session->userdata("student_id").'"';
				}
				else{
					$msg .= '" student_id=""';
				}
				$msg .= ' institute_id="'.$in->institute_id.'" video_url="'.$in->institute_video_url.'" style="font-size: 15px;color: white;cursor: pointer" data-toggle="';
				$msg .= 'modal';
				if($this->session->userdata("student_id")){
					$msg .= 'tooltip';
				}
				$msg .= '" title="Add To List" data-target="';
				$msg .= '#myModalLoginNow';
				if($this->session->userdata("student_id")){
					$msg .= '';
				}
				$msg .= '"></i></span></div>
							<div class="media p-3"> ';
				if(file_exists($in->theme_logo)){
					$msg .= '<img src="'.base_url().$in->theme_logo.'" class="mr-3 rounded-circle" style="width:60px;">';
				}else{
					$msg .= '<img src="'.base_url('assets/images/default-logo.jpg').'" class="mr-3 rounded-circle" style="width:60px;">';
				}
				$msg .= '<div class="media-body"><h4><a class="getloginuser" studentid="'.$this->session->userdata("student_id").'" instituteid="'.$in->institute_id.'" href="'.base_url().'exhibitors/'.str_replace(" ","-",$in->institute_name).'" style="color: black">'.$in->institute_name.'</a></h4>';
				
				$msg .= '<p style="margin-bottom: 0px;font-size: 13px;">'.($in->city).', '.$in->state.'</p>';
				
				$msg .= '</div></div></div></div></div>';
			}
			echo $msg;					
		}else{
			 echo $notmsg;
		}
	}
	public function videoconferencemeeting(){
		$admission_officer_id = $this->input->post("admission_officer_id");
		$institute_id = $this->input->post("institute_id");
		if($institute_id!=''){
			$meeting = $this->db->query("SELECT * FROM tbl_college_connect WHERE id=$admission_officer_id AND institute_id=".$institute_id)->row();
		
			
		
			$data = array(
				'institute_id' => $this->input->post('institute_id'), 
				'admission_officer_id' => $admission_officer_id,
				'date' =>  $meeting->date,
				'start_time' => $meeting->from_time ,
				'end_time' => $meeting->to_time,
				'student_id' => $this->session->userdata("student_id"),
				'zoom_link' => $meeting->zoom_link ,
				"zoom_password" => $meeting->zoom_password ,
			);
			//print_r($data);die;
			$zoom_link = $this->db->get_where("tbl_student_institute_admofficer_video_connect",["institute_id"=>$this->input->post('institute_id'),"admission_officer_id"=>$this->input->post('admission_officer_id'), "student_id"=> $this->session->userdata("student_id"), "date"=>$meeting->date])->num_rows();
			
		  if($zoom_link > 0) {

			//echo "dublicate";

	  	} else {
		
			$zoom_link_insert = $this->db->insert("tbl_student_institute_admofficer_video_connect",$data);
			if($zoom_link_insert){
				
				echo "success";
				
			}else{
				
				echo "error";
				
			}
		}
		
			echo $meeting->zoom_link;
		}
		
	}
	public function getcouncellorsessions(){
		$councellor_id = $this->input->post("councellor_id");
		$student_id = $this->input->post("student_id");
		$result = "<input type='hidden' name='councellor_id' value='".$councellor_id."'><ul>";
		$counseller_name = $this->db->where("id", $councellor_id)->get("tbl_councellors")->row()->expert_name;
		if($councellor_id){
			$datetime = date('Y-m-d H:i:s');
			$sessions = $this->db->where("is_deleted", "0")->where("expert_id", $councellor_id)->where("exp_se_time >= '".strtotime($datetime)."'")->get("tbl_counsellor_sessions")->result();
			if(count($sessions)>0){
				$ses_result = '';
				$ses_result = '<h6 style="font-weight:bold">'.$counseller_name.' Sessions : </h6><br>';
				foreach ($sessions as $session) {
					$checkexists = $this->db->select("*")->where("expert_id", $councellor_id)->where("exp_std_date", $session->exp_se_date)->where("exp_std_time", $session->exp_se_time)->where("exp_std_duration", $session->duration)->get("tbl_counsellor_student_schedule");//->where("student_id", $student_id)
					if($checkexists->num_rows()==0){
						$ses_result .= '<li><input name="inputRadio" type="radio" class="inputRadio timing_'.$session->exp_se_id.'" onclick="getDetails('.$session->exp_se_id.')" data-id="'.$session->exp_se_id.'" data-date="'.$session->exp_se_date.'" data-time="'.$session->exp_se_time.'" data-duration="'.$session->duration.'"> '.$session->title.' - '.$session->exp_se_date.' '.date("H:i:s", $session->exp_se_time).'</li><p>Description : '.$session->description.'</p>';
					}
				}
				if($ses_result!=''){
					$result .= $ses_result;
				}
				else{
					$result .= "<li><p style='color:red;'>No Sessions Found For ".$counseller_name." .</p></li>";
				}
			}
			else{
				$result .= "<li><p style='color:red;'>No Sessions Found For ".$counseller_name.".</p></li>";
			}
		}
		else{
			$result .= "<li><p style='color:red;'>No Sessions Found For ".$counseller_name.".</p></li>";
		}
		$result .= "</ul>";
		echo $result;
	}
	public function save_student_booking(){
		
//		print_r($_POST);
//		exit();
		
		$student_id = $this->input->post("student_id");
		$status = 'InActive';
		$msg = "Please login to book this session.";
		if($student_id){
			$session_id = $this->input->post("coun_session_id");
			$councellor_id = $this->input->post("councellor_id");
			$date = $this->input->post("session_date");
			$time = $this->input->post("session_time");
			$duration = $this->input->post("session_type");
			$checkexists = $this->db->select("*")->where("expert_id", $councellor_id)->where("student_id", $student_id)->where("exp_std_date", $date)->where("exp_std_time", $time)->where("exp_std_duration", $duration)->get("tbl_counsellor_student_schedule");
			if($checkexists->num_rows()==0){
				$zoom_meeting = $this->db->where("councellor_id", $councellor_id)->where("session_id", $session_id)->get("tbl_zoom_meetings")->result();
				$zoom_link = '';
				$zoom_password = '';
				if(isset($zoom_meeting[0]->meeting_link)){ $zoom_link = $zoom_meeting[0]->meeting_link;}
				if(isset($zoom_meeting[0]->meeting_password)){ $zoom_password = $zoom_meeting[0]->meeting_password;}
				$sdata = $this->db->get_where("tbl_counsellor_sessions",["exp_se_id"=>$session_id])->row();
				$data2 = array(
				    "expert_id" => $councellor_id,
					"exp_std_date" => $date,
					"exp_std_time" => $time,
					"exp_std_duration" => $duration,
					"student_id" => $student_id,
					"institute_id" => $sdata->institute_id,
					"zoom_link" => $zoom_link,
					"zoom_password" => $zoom_password
				);	

				$query2 = $this->db->insert("tbl_counsellor_student_schedule",$data2);
				
				$this->db->where(["exp_se_id"=>$session_id])->update("tbl_counsellor_sessions",["is_booked"=>"Active"]);
				$status = 'Active';
				$msg = "Successfully applied for the session.";
			}
			else{
				$status = 'InActive';
				$msg = "You already booked this session of this professor.";
			}
		}
		$data1=["Status"=>$status,"Message"=>$msg];
	    echo json_encode($data1);
	    exit();
	}
    public function savefeedback(){
		$srating = $this->input->post('srating');
		$comment = $this->input->post('comment');
		if($srating!='' || $comment!=''){
			$data = $this->input->post();
			
			$d = $this->db->insert("feedback",$data);
			
			if($d){
				
				echo "success";
				
			}else{
				
				echo "error";
				
			}
		}
		else{
			echo "empty";
		}
	}
}
