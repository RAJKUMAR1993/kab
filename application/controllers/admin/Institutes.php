<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');

class Institutes extends MY_Controller {

	public function __construct(){
		
		parent::__construct();
		if($this->session->userdata['login_type']!='admin'){redirect('admin');}

		$this->admin_email = $this->login_model->get_option("admin_email_id")->email;
	}
	
	public function index()
	{									
		$data['categories'] = $this->db->where("is_deleted",'0')->order_by('category_name', 'ASC')->get("tbl_categories")->result();
	    $data['institutes'] = $this->db->get_where("tbl_institutes",["is_active"=>0,"status"=>"Active","is_deleted"=>0])->result();
		$data['subview'] = "institutes/institutes";
		$this->load->view('admin/theme',$data);
	}
	public function all_institutes(){

		$category = $this->input->get("category");
		if($category){
			$this->db->where("category",$category);
		}
		$category_id = $this->input->get("category_id");
		if($category_id){
			$this->db->where("category_id",$category_id);
		}
		$live_status = $this->input->get("live_status");
		if($live_status){
			$this->db->where("live_status",$live_status);
		}
		$live_status = $this->input->get("live_status");
		if($live_status){
			$this->db->where("live_status",$live_status);
		}
		$data['institute'] = $this->db->get_where("tbl_institutes",["is_active"=>0,"status"=>"Active","is_deleted"=>0])->result();
		$data['subview'] = "institutes/all_institutes";
		$this->load->view('admin/theme',$data);
	}
	public function live_status(){
		$live_status = $this->input->get("live_status");
		if($live_status){
			$this->db->where("live_status",$live_status);
		}
		$data['livestatus'] = $this->db->get_where("tbl_institutes",["live_status"=>1,"is_active"=>0,"status"=>"Active","is_deleted"=>0])->result();
		$data['subview'] = "institutes/live_status";
	    $this->load->view('admin/theme',$data);
	}
	public function off_line_status(){
		$live_status = $this->input->get("live_status");
		if($live_status){
			$this->db->where("live_status",$live_status);
		}
		$data['off_line_status'] = $this->db->get_where("tbl_institutes",["live_status"=>0,"is_active"=>0,"status"=>"Inactive","is_deleted"=>0])->result();
		$data['subview'] = "institutes/live_status";
	    $this->load->view('admin/theme',$data);
	}
	// public function categories_list(){
	// 	$category_id = $this->input->get("category");
	// 	if($category_id){
	// 		$this->db->where("category_id",$category_id);
	// 	}
	// 	$data['list'] = $this->db->get_where("tbl_categories",["category_id"=>$category_id,"is_deleted"=>0])->result();
		
	// } 

	public function add(){
		if($this->uri->segment(4)){
			$data['institute'] = $this->institute_model->get_institute_id($this->uri->segment(4));
		}else{
			$data['institute'] = "";
		}

		$data['subview'] = "institutes/add_institute";
		$this->load->view('admin/theme',$data);
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
		
		$cat = $this->input->post("category");
		$permissions = $this->db->get_where("tbl_types",["code"=>$cat])->row()->permissions;
		
		$add_package_status = $this->input->post("add_package_status");
			
		$additional_package_count = json_encode(["coucellors"=>$this->input->post("councellor_count"),"phone"=>$this->input->post("virtual_contact_count"),"video"=>$this->input->post("virtual_link_count"),"presentation_time"=>$this->input->post("presentation_time")]);
		
		$data = array(
			"institute_name" => $this->input->post("name"),
			"full_name" => $this->input->post("fullname"),
			"designation" => $this->input->post("designation"),
			"email" => $this->input->post("email"),
			"phone" => $this->input->post("phone"),
			"address" => $this->input->post("address"),
			"status" => $this->input->post("status"),
			"website" => $this->input->post("website"),
			"category" => $this->input->post("category"),
			"add_package_status" => ($this->input->post("add_package_status") != "") ? $this->input->post("add_package_status") : '',
			"allowed_creation_count" => $permissions,
			"additional_package_count" => $additional_package_count,
			"chat_url" => $this->input->post("chat_url")
		);/*print_r($data);
		 exit;*/

		if($this->uri->segment(4)){
			$data['password'] = $this->institute_login_model->api_key_crypt( $this->input->post("password"),'e');
			$old_password = $this->input->post("old_password");

			$data['live_status'] = $this->input->post("live_status");

			if($data['password']!=$old_password){

				$msg = '<html><body>Your password has been updated, please login with below details. <br><small>User ID : '.$data["email"].'</small><br> <small>Password : '.$this->institute_login_model->api_key_crypt($data["password"],"d").'</small></body></html>';
				$from = "$this->admin_email";
				$subject = "Login Details : KAB Education Fair";
				$to = $data['email'];
				$re = $this->login_model->sendMail($from,$to,$subject,$msg);
			}
			$this->db->where("institute_id",$this->input->post("institute_id"))->update("tbl_institutes",$data); 
			//redirect("admin/institutes");
			$data1=["Status"=>'Active',"Message"=>"Successfully Updated."];
				echo json_encode($data1);
				exit();

		}else{
			$data['password'] = $this->institute_login_model->api_key_crypt(random_string('alnum', 8),"e");
			$check_email = $this->institute_model->check_email($data['email']);
			
			if($check_email){
				$d = $this->db->insert("tbl_institutes",$data);
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
			}else{
				$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">Institute email already exist.!</div>');
				//redirect("admin/institutes/add");
				$data1=["Status"=>'InActive',"Message"=>"Institute email already exist."];
			 	echo json_encode($data1);
			 	exit();
			}
			}
			if($d){
				$msg = '<html><body><small>User ID : '.$data["email"].'</small><br> <small>Password : '.$this->institute_login_model->api_key_crypt( $data["password"],"d").'</small></body></html>';
				$from = "$this->admin_email";
				$subject = "Login Details : KAB Education Fair";
				$to = $data['email'];
				$re = $this->login_model->sendMail($from,$to,$subject,$msg);

				//redirect("admin/institutes");
				$data1=["Status"=>'Active',"Message"=>"Successfully Inserted."];
				echo json_encode($data1);
				exit();
			}
			
		}

	

	public function delete_institute(){
		if($this->uri->segment(4)){
			$id =$this->uri->segment(4);
			
			//Deleting Admission2020
			$this->db->where("institute_id",$id)->delete("tbl_achievement");
			
			//Deleting Brochers 			
			$brouchers = $this->db->where("institute_id",$id)->get("tbl_brouchers")->result();
			if(!empty($brouchers)){
				foreach ($brouchers as $brouch) {
					$file = "assets/images/brochure/".$brouch->broucher."";
					if (file_exists($file)) {
						unlink($file);
					} 
				}
			}
			$this->db->where("institute_id",$id)->delete("tbl_brouchers");
			
			//Deleting PPts
			$ppts = $this->db->where("institute_id",$id)->get("tbl_ppts")->result();
			if(!empty($ppts)){
				foreach ($ppts as $ppt) {
					$ppt_file = "assets/images/brochure/".$ppt->broucher."";
					if (file_exists($ppt_file)) {
						unlink($ppt_file);
					} 
				}
			}
			$this->db->where("institute_id",$id)->delete("tbl_ppts");
			
			//Deleting Videos			
			$videos = $this->db->where("institute_id",$id)->get("tbl_video")->result();
			if(!empty($videos)){
				foreach ($videos as $vid) {
					$vid_file = $vid->url;
					if (file_exists($vid_file)) {
						unlink($vid_file);
					} 
				}
			}
			$this->db->where("institute_id",$id)->delete("tbl_video");
			
			//Deleting Gallery
			$gallery_title = $this->db->where("institute_id",$id)->get("tbl_gallery_title")->result();
			if(!empty($gallery_title)){
				foreach ($gallery_title as $gts) {
					$gallerys = $this->db->where("title_id",$gts->title_id)->get("tbl_gallery")->result();
					if(!empty($gallerys)){
						foreach($gallerys as $gal){
							$gal_file = "assets/images/gallery/".$gal->images."";
							if (file_exists($gal_file)) {
								unlink($gal_file);
							}
						}
					}
					$this->db->where("title_id",$gts->title_id)->delete("tbl_gallery");
				}
			}
			$this->db->where("institute_id",$id)->delete("tbl_gallery_title");
			
			//Deleting Courses
			$this->db->where("institute_id",$id)->delete("tbl_courses");
			
			//Deleting Placements
			$this->db->where("institute_id",$id)->delete("tbl_placementstatistics");
			
			//Deleting Student Placement
			$student_placments = $this->db->where("institute_id",$id)->get("tbl_studentsplacement")->result();
			if(!empty($student_placments)){
				foreach ($student_placments as $s_p) {
					if (file_exists($s_p->url)) {
						unlink($s_p->url);
					} 
				}
			}
			$this->db->where("institute_id",$id)->delete("tbl_studentsplacement");
			
			//Deleting testimonial
			$this->db->where("institute_id",$id)->delete("tbl_institute_testimonials");
			
			//Deleting institute presntation
			$this->db->where("institute_id",$id)->delete("tbl_institute_presentations");
			
			//Deleting Audotirum Presentation
			$this->db->where("institute_id",$id)->delete("tbl_student_auditorium_presentations");
			
			//Deleting Counsellers
			$this->db->where("institute_id",$id)->delete("tbl_councellors");
			
			//Deleting Experts
			$this->db->where("institute_id",$id)->delete("tbl_experts");
			
			//Deleting Video connect
			$this->db->where("institute_id",$id)->delete("tbl_college_connect");
			
			//Deleting FAQS
			$this->db->where("institute_id",$id)->delete("tbl_institute_faqs");
			
			//Deleting Analytics Ebooth 
			$this->db->where("institute_id",$id)->delete("tbl_student_institute_view_time");
			
			//Deleting Enquires 
			$this->db->where("institute_id",$id)->delete("tbl_institute_ask_a_question");
			
			$query = $this->db->where("institute_id",$id)->update("tbl_institutes",array('is_deleted' =>'1'));
			if($query){ redirect("admin/institutes");}
		}
	}

}
