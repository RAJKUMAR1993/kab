<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');

class Data extends CI_Controller {
	public function __construct()
	    {
	        parent::__construct();
	        if($this->session->userdata['login_type']!='institute'){redirect('institute/login');}
	    }

	public function addcontent()
	{
		if($this->uri->segment(4)){
			$data['content'] = $this->data_model->get_content_byid($this->uri->segment(4));
		}else{
			$data['content'] = "";
		}
		$data['subview'] ="data/add_content";
		$this->load->view('institute/theme',$data);
	}
	
	public function sociallinks(){
		$data['news'] = json_decode($this->db->get_where("tbl_institutes",["institute_id"=>$this->session->userdata('institute_id')])->row()->social_links);
		$data['subview'] = "data/sociallinks";
		$this->load->view('institute/theme',$data);
	}
	
	public function updatesociallinks(){
		
		$data = ["facebook"=>$this->input->post("fb"),"twitter"=>$this->input->post("twitter"),"instagram"=>$this->input->post("instagram"),"youtube"=>$this->input->post("youtube")];
		
		$this->db->where(["institute_id"=>$this->session->userdata('institute_id')])->update("tbl_institutes",["social_links"=>json_encode($data)]);
		$data1=["Status"=>'Active',"Message"=>"Successfully Updated."];
		echo json_encode($data1);
		exit();
		
	}
	
	
	public function feedback()
	{
		$data["admin"] = $this->db->where("institute_id",$this->session->userdata('institute_id'))->get("tbl_institutes")->row();		
		$data['subview'] ="data/feedback";
		$this->load->view('institute/theme',$data);
	}
	
	public function updatefeedback(){
		$data = array(
			"feedback_description" => $this->input->post("feedback_description"),
			"feedback_question" => $this->input->post("feedback_question")
		);
		
		$this->db->where("institute_id",$this->session->userdata('institute_id'))->update("tbl_institutes",$data); 
		//redirect("institute/data/content");
		$data1=["Status"=>'Active',"Message"=>"Feedback details updated successfully."];
		echo json_encode($data1);
			
	}
	

	public function content()
	{
		$institute_id =$this->session->userdata['institute_id'];
		$data['content'] = $this->data_model->get_content($institute_id);
		$data['subview'] ="data/content";
		$this->load->view('institute/theme',$data);
	}


	public function savecontent(){
		$data = array(
			'institute_id' => $this->session->userdata['institute_id'],
			'title' => $this->input->post("title"),
			'description' => $this->input->post("description"),
			'status' => $this->input->post("status")
		);
		
		if($this->input->post("content_id")){
			$this->db->where("content_id",$this->input->post("content_id"))->update("tbl_content",$data); 
			//redirect("institute/data/content");
			$data1=["Status"=>'Active',"Message"=>"Details has updated successfully."];
				echo json_encode($data1);
		}else{
			$this->db->insert("tbl_content",$data);
			//redirect("institute/data/content");
			$data1=["Status"=>'Active',"Message"=>"Successfully Inserted."];
				echo json_encode($data1);
		}	
	}

	public function delete_content(){
		if($this->uri->segment(4)){
			$id =$this->uri->segment(4);
			$query = $this->db->where("content_id",$id)->update("tbl_content",array('is_deleted' =>'1'));
			if($query){ redirect("institute/data/content");}
		}
	}
	
	
// testimonial
	
	public function addtestimonial()
	{
		if($this->uri->segment(4)){
			$data['content'] = $this->db->get_where("tbl_institute_testimonials",["id"=>$this->uri->segment(4)])->row();
		}else{
			$data['content'] = "";
		}
		$data['subview'] ="data/add_testimonial";
		$this->load->view('institute/theme',$data);
	}

	public function testimonial()
	{
		$institute_id =$this->session->userdata['institute_id'];
		$data['content'] = $this->db->get_where("tbl_institute_testimonials",["institute_id"=>$institute_id,"deleted"=>0])->result();
		$data['subview'] ="data/testimonials";
		$this->load->view('institute/theme',$data);
	}


	public function savetestimonial(){
		
		
		if($_FILES['logo']){
			$config['upload_path'] = 'uploads/'; # check path is correct
			$config['max_size'] = '0';
			$config['allowed_types'] = 'jpeg|jpg|png'; # add video extenstion on here
			$config['overwrite'] = FALSE;
			$config['remove_spaces'] = TRUE;
			$logo_name = random_string('numeric', 5);
			$config['file_name'] = $logo_name;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('logo')) # form input field attribute
			{
			    $upload_data = $this->upload->data();
			    $image = $config['upload_path'].$upload_data['file_name'];
			    $file_ext = $upload_data['file_type'];
			}else{
				$image = $this->input->post('old_logo');
			}
		}
		
		$data = array(
			'institute_id' => $this->session->userdata['institute_id'],
			'st_name' => $this->input->post("st_name"),
			'title' => $this->input->post("title"),
			'description' => $this->input->post("description"),
			'status' => $this->input->post("status"),
			"image" => $image
		);
		
		if($this->input->post("content_id")){
			$this->db->where("id",$this->input->post("content_id"))->update("tbl_institute_testimonials",$data); 
			//redirect("institute/data/content");
			$data1=["Status"=>'Active',"Message"=>"Details has updated successfully."];
				echo json_encode($data1);
		}else{
			$this->db->insert("tbl_institute_testimonials",$data);
			//redirect("institute/data/content");
			$data1=["Status"=>'Active',"Message"=>"Successfully Inserted."];
				echo json_encode($data1);
		}	
	}

	public function delete_testimonial(){
		if($this->uri->segment(4)){
			$id =$this->uri->segment(4);
			$query = $this->db->where("id",$id)->delete("tbl_institute_testimonials");
			if($query){ redirect("institute/data/testimonial");}
		}
	}
	
	
// end testimonial	
	


	public function addvideo()
	{
		if($this->uri->segment(4)){
			$data['video'] = $this->data_model->get_video_byid($this->uri->segment(4));
		}else{
			$data['video'] = "";
		}
		$data['subview'] ="data/add_video";
		$this->load->view('institute/theme',$data);
	}

	public function video()
	{
		$institute_id =$this->session->userdata['institute_id'];
		$data['video'] = $this->data_model->get_video($institute_id);
		$data['subview'] ="data/video";
		$this->load->view('institute/theme',$data);
	}
	public function gallery()
	{
		$institute_id =$this->session->userdata['institute_id'];
		$data['gallery'] = $this->data_model->get_video($institute_id);
		$data['video'] = $this->db->order_by("title_id","desc")->where("deleted",0)->where("institute_id",$institute_id)->get("tbl_gallery_title")->result();
		$data['subview'] ="data/gallery";
		$this->load->view('institute/theme',$data);
	}
	public function add_gallery_images($id)
	{	
		$data['gallery'] = $this->db->where("title_id",$id)->where("deleted",0)->get("tbl_gallery")->result();
		$data['subview'] ="data/gallery_view";
		$this->load->view('institute/theme',$data);
	}
	public function save_gallery_image(){
		
		$ccount = count($_FILES['picture']['name']);
		$exc = $this->db->get_where("tbl_gallery",["title_id"=>$this->input->post("title_id")])->num_rows();
		
		if(($ccount + $exc) > 12){
			
			$data1=["Status"=>'Error',"Message"=>"Maximum 12 Images are allowed to add."];
			echo json_encode($data1);
			exit();
			
		}
		
		
			foreach ($_FILES['picture']['name'] as $name => $value)
            {
				$_FILES['file']['name'] = $_FILES['picture']['name'][$name];
				$_FILES['file']['type'] = $_FILES['picture']['type'][$name];
				$_FILES['file']['tmp_name'] = $_FILES['picture']['tmp_name'][$name];
				$_FILES['file']['error'] = $_FILES['picture']['error'][$name];
				$_FILES['file']['size'] = $_FILES['picture']['size'][$name];
				
			    $config['upload_path'] = 'assets/images/gallery';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
//                $config['max_size'] = 200;
                $config['file_name'] = $_FILES['picture']['name'][$name];				 
				
				$this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('file')){
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                }else{
                    $picture = '';
                }
				
				$data = array(
				"images" => $picture,
				"title_id" => $this->input->post("title_id")
				);
				

					$query = $this->db->insert("tbl_gallery",$data);
					
			}	
		
		        
		$data1=["Status"=>'Active',"Message"=>"Successfully Inserted."];
					echo json_encode($data1);
					exit();
		 
		 
		
			
	}
    public function add_title(){
    	$institute_id =$this->session->userdata['institute_id'];
		$data = array("gallery_title" => $this->input->post('title'),"institute_id" => $institute_id );
		
		$gtChk = $this->db->get_where("tbl_gallery_title",["institute_id" => $institute_id,"deleted"=>0])->num_rows();
		
		
		if($gtChk >= 6){
			
			$data1=["Status"=>'false',"Message"=>"Maximum 6 Albums are allowed to create."];
			echo json_encode($data1);
			exit();
		}
		
		$this->db->insert("tbl_gallery_title",$data);
	    $data1=["Status"=>'Active',"Message"=>"Successfully Inserted."];
		echo json_encode($data1);	
	}
	public function savevideo(){

		$config['upload_path'] = 'assets/videos/'; # check path is correct
			$config['max_size'] = '0';
			$config['allowed_types'] = 'mp4|mp3'; # add video extenstion on here
			$config['overwrite'] = FALSE;
			$config['remove_spaces'] = TRUE;
			$video_name = random_string('numeric', 5);
			$config['file_name'] = $video_name;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if ($this->upload->do_upload('video')) # form input field attribute
		{
		    
		    $upload_data = $this->upload->data();
		    $video_name = $config['upload_path'].$upload_data['file_name'];
		    
		}else{
			$video_name = $this->input->post('old_video');
		}
		$data = array(
			'institute_id' => $this->session->userdata['institute_id'],
			'title' => $this->input->post("title"),
			'description' => $this->input->post("description"),
			'url' => $video_name,
			'status' => $this->input->post("status")
		);
		
		if($this->input->post("video_id")){
			$this->db->where("video_id",$this->input->post("video_id"))->update("tbl_video",$data); 
			//redirect("institute/data/video");
			$data1=["Status"=>'Active',"Message"=>"Details has updated successfully."];
				echo json_encode($data1);
		}else{
			$this->db->insert("tbl_video",$data);
			//redirect("institute/data/video");
			$data1=["Status"=>'Active',"Message"=>"Successfully Inserted."];
				echo json_encode($data1);
		}	
	}
    public function update_title(){
    	$institute_id =$this->session->userdata['institute_id'];
		$data = array("gallery_title" => $this->input->post('title'), "institute_id" =>$institute_id);
		$this->db->where("title_id",$this->input->post('tid'))->update("tbl_gallery_title",array('gallery_title' =>$this->input->post('title'),'institute_id' =>$institute_id));
	    $data1=["Status"=>'Active',"Message"=>"Successfully Updated."];
		echo json_encode($data1);	
	}
	public function delete_video(){
		if($this->uri->segment(4)){
			$id =$this->uri->segment(4);
			$query = $this->db->where("video_id",$id)->update("tbl_video",array('is_deleted' =>'1'));
			if($query){ redirect("institute/data/video");}
		}
	}
	public function delete_title(){
		if($this->uri->segment(4)){
			$id =$this->uri->segment(4);
			$query = $this->db->where("title_id",$id)->update("tbl_gallery_title",array('deleted' =>'1'));
			if($query){ redirect("institute/data/gallery");}
		}
	}
	public function delete_image($id){
		$query = $this->db->where("id",$id)->delete("tbl_gallery");
			if($query){ redirect("institute/data/gallery");}
	}
	
	public function addplacement()
	{
		if($this->uri->segment(4)){
			$data['placement'] = $this->data_model->get_placement_byid($this->uri->segment(4));
		}else{
			$data['placement'] = "";
		}
		$data['subview'] ="data/add_placement";
		$this->load->view('institute/theme',$data);
	}

	public function placement()
	{
		$institute_id =$this->session->userdata['institute_id'];
		$data['placement'] = $this->data_model->get_placement($institute_id);
		$data['subview'] ="data/placements";
		$this->load->view('institute/theme',$data);
	}

	public function saveplacement(){

		if($_FILES['clogo']){
			$config['upload_path'] = 'assets/placements/'; # check path is correct
			$config['max_size'] = '0';
			$config['allowed_types'] = 'jpeg|jpg|png'; # add video extenstion on here
			$config['overwrite'] = FALSE;
			$config['remove_spaces'] = TRUE;
			$logo_name = random_string('numeric', 5);
			$config['file_name'] = $logo_name;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('clogo')) # form input field attribute
			{
			    $upload_data = $this->upload->data();
			    $image = $config['upload_path'].$upload_data['file_name'];
			    $file_ext = $upload_data['file_type'];
			}else{
				$image = $this->input->post('old_clogo');
			}
		}



		$data = array(
			'institute_id' => $this->session->userdata['institute_id'],
			'company' => $this->input->post("company"),
			'website' => $this->input->post("website"),
			'address' => $this->input->post("address"),
			'title' => $this->input->post("title"),
			'email' => $this->input->post("email"),
			'mobile' => $this->input->post("mobile"),
			'location' => $this->input->post("location"),
			'recruitmentdate' => $this->input->post("recruitmentdate"),
			'recruitmenttime' => $this->input->post("recruitmenttime"),
			'recruitmentname' => $this->input->post("recruitmentname"),
			'availposition' => $this->input->post("availposition"),
			'description' => $this->input->post("description"),
			'url' => $image,
			'status' => $this->input->post("status")
		);
		
		if($this->input->post("placement_id")){
			$this->db->where("placement_id",$this->input->post("placement_id"))->update("tbl_placement",$data); 
		
			$data1=["Status"=>'Active',"Message"=>"Details has updated successfully."];
				echo json_encode($data1);
		}else{
			$this->db->insert("tbl_placement",$data);
			
			$data1=["Status"=>'Active',"Message"=>"Successfully Inserted."];
				echo json_encode($data1);
		}	
	}

	public function delete_placement(){
		if($this->uri->segment(4)){
			$id =$this->uri->segment(4);
			$query = $this->db->where("placement_id",$id)->update("tbl_placement",array('is_deleted' =>'1'));
			if($query){ redirect("institute/data/placement");}
		}
	}


	public function addprogramfee()
	{
		if($this->uri->segment(4)){
			$data['programfee'] = $this->data_model->get_programfee_byid($this->uri->segment(4));
		}else{
			$data['programfee'] = "";
		}
		$data['subview'] ="data/add_programfee";
		$this->load->view('institute/theme',$data);
	}

	public function programmefees()
	{
		$institute_id =$this->session->userdata['institute_id'];
		$data['programfee'] = $this->data_model->get_programfee($institute_id);
		$data['subview'] ="data/programfees";
		$this->load->view('institute/theme',$data);
	}


	public function saveprogramfee(){
		$data = array(
			'institute_id' => $this->session->userdata['institute_id'],
			'title' => $this->input->post("title"),
			'program_name' => $this->input->post("program_name"),
			'fees' => $this->input->post("fees"),
			'description' => $this->input->post("description"),
			'status' => $this->input->post("status")
		);
		
		if($this->input->post("programfee_id")){
			$this->db->where("programfee_id",$this->input->post("programfee_id"))->update("tbl_programmefee",$data); 
			
			$data1=["Status"=>'Active',"Message"=>"Details has updated successfully."];
				echo json_encode($data1);
		}else{
			$this->db->insert("tbl_programmefee",$data);
			
			$data1=["Status"=>'Active',"Message"=>"Successfully Inserted."];
				echo json_encode($data1);
		}	
	}

	public function delete_programfee(){
		if($this->uri->segment(4)){
			$id =$this->uri->segment(4);
			$query = $this->db->where("programfee_id",$id)->update("tbl_programmefee",array('is_deleted' =>'1'));
			if($query){ redirect("institute/data/programfees");}
		}
	}

	public function addachievement()
	{
		if($this->uri->segment(4)){
			$data['achievement'] = $this->data_model->get_achievement_byid($this->uri->segment(4));
		}else{
			$data['achievement'] = "";
		}
		$data['subview'] ="data/add_achievement";
		$this->load->view('institute/theme',$data);
	}

	public function achievement()
	{
		$institute_id =$this->session->userdata['institute_id'];
		$data['achievement'] = $this->data_model->get_achievement($institute_id);
		$data['subview'] ="data/achievements";
		$this->load->view('institute/theme',$data);
	}


	public function saveachievement(){
		$data = array(
			'institute_id' => $this->session->userdata['institute_id'],
			'title' => $this->input->post("title"),
			'description' => $this->input->post("description"),
			'status' => $this->input->post("status")
		);
		
		if($this->input->post("achievement_id")){
			$this->db->where("achievement_id",$this->input->post("achievement_id"))->update("tbl_achievement",$data); 
			
			$data1=["Status"=>'Active',"Message"=>"Details has updated successfully."];
				echo json_encode($data1);
		}else{
			$this->db->insert("tbl_achievement",$data);
			
			$data1=["Status"=>'Active',"Message"=>"Successfully Inserted."];
				echo json_encode($data1);
		}	
	}

	public function delete_achievement(){
		if($this->uri->segment(4)){
			$id =$this->uri->segment(4);
			$query = $this->db->where("achievement_id",$id)->update("tbl_achievement",array('is_deleted' =>'1'));
			if($query){ redirect("institute/data/achievements");}
		}
	}
       public function add_course(){
		$data = array(
			'institute_id' => $this->session->userdata['institute_id'],
			'course_name' => $this->input->post("course_name"),
			'course_duration' => $this->input->post("course_duration"),
			'course_fees' => $this->input->post("course_fees"),
			'course_desc' => $this->input->post("course_desc"),
			'specialization' => $this->input->post("specialization"),
			'merit_scholarship' => $this->input->post("merit_scholarship"),
			'merit_scholarship_desc' => $this->input->post("merit_scholarship_desc")
		);
		if($this->input->post("cid")){
			$this->db->where("course_id ",$this->input->post("cid"))->update("tbl_courses",$data); 
			$data1=["Status"=>'Active',"Message"=>"Details has updated successfully."];
			echo json_encode($data1);
		}else{
			$this->db->insert("tbl_courses",$data);
			$data1=["Status"=>'Active',"Message"=>"Successfully Inserted."];
			echo json_encode($data1);
		}		
	}
	public function brouchers()
	{
		$institute_id =$this->session->userdata['institute_id'];
		$data['video'] = $this->db->order_by("broucher_id ","desc")->where("institute_id",$institute_id)->where("deleted",0)->get("tbl_brouchers")->result();
		$data['subview'] ="data/brochure";
		$this->load->view('institute/theme',$data);
	}
	public function ppts()
	{
		$institute_id =$this->session->userdata['institute_id'];
		$data['video'] = $this->db->order_by("broucher_id ","desc")->where("institute_id",$institute_id)->where("deleted",0)->get("tbl_ppts")->result();
		$data['subview'] ="data/ppts";
		$this->load->view('institute/theme',$data);
	}
	public function courses()
	{
		$institute_id =$this->session->userdata['institute_id'];
		$data['courses'] = $this->db->order_by("course_id ","desc")->where("institute_id",$institute_id)->where("deleted",0)->get("tbl_courses")->result();
		$data['subview'] ="data/courses";
		$this->load->view('institute/theme',$data);
	}
	public function add_edit_course()
	{
		if($this->uri->segment(4)){
			$data['courses'] = $this->db->where("course_id",$this->uri->segment(4))->get("tbl_courses")->row();
		}else{
			$data['courses'] = "";
		}
		$data['subview'] ="data/add_course";
		$this->load->view('institute/theme',$data);
	}

	public function add_brochure(){
		
	//print_r($_FILES);exit;
		$added = $notadded = 0;
		$this->load->library('upload');

//			foreach ($_FILES['picture']['name'] as $name => $value)
//            {
			/*$_FILES['file']['name'] = $_FILES['picture']['name'][$name];
			$_FILES['file']['type'] = $_FILES['picture']['type'][$name];
			$_FILES['file']['tmp_name'] = $_FILES['picture']['tmp_name'][$name];
			$_FILES['file']['error'] = $_FILES['picture']['error'][$name];
			$_FILES['file']['size'] = $_FILES['picture']['size'][$name];*/

		$config['upload_path'] = 'assets/images/brochure/';
		$config['allowed_types'] = 'pdf';
//			$config['max_size'] = 1024;
//			$config['file_name'] = $_FILES['picture']['name'];				 

		$this->upload->initialize($config);
		$this->upload->do_upload('picture');
		$uploadData = $this->upload->data();
		$picture = $uploadData['file_name'];
		
		$data = array(
			"thumbnail" => $this->input->post("thumbnail"),
			"broucher" => $picture,
			"broucher_name" => $this->input->post("brochure_name"),
			"institute_id" => $this->session->userdata['institute_id']
		);
		$query = $this->db->insert("tbl_brouchers",$data);
		$added++;

		$msg = '';
		$msg .= "Broucher Successfully Inserted.<br>";
		$data1=["Status"=>'Active',"Message"=>$msg];
		echo json_encode($data1);
		exit();
	}
	public function update_brochure(){

		$bdata = $this->db->where("broucher_id",$this->input->post('bid'))->get("tbl_brouchers")->row();
		
		$this->load->library('upload');		
		$added = $notadded = 0;
				
		if($_FILES['picture']['size'] > 0){

			$config['upload_path'] = 'assets/images/brochure/';
			$config['allowed_types'] = 'pdf';
//			$config['max_size'] = 1024;				 

			$this->upload->initialize($config);

			if($this->upload->do_upload('picture')){
				$uploadData = $this->upload->data();
				$picture = $uploadData['file_name'];

				$added++;
			}else{
				$notadded++;
			}

		}else{

			$picture = $bdata->broucher;

		}



		$data = array(
			"thumbnail" => $this->input->post("thumbnail"),
			"broucher" => $picture,
			"broucher_name" => $this->input->post("brochure_name"),
		);
		$d = $this->db->where("broucher_id",$this->input->post('bid'))->update("tbl_brouchers",$data);

		$msg = '';
		if($d){
			$msg .= "Broucher Successfully Updated.<br>";
		}      
		$data1=["Status"=>'Active',"Message"=>$msg];
		echo json_encode($data1);
		exit();
	}
	
	public function add_ppt(){
		//print_r($_FILES);exit;
		$added = $notadded = 0;
		$this->load->library('upload');

		$config['upload_path'] = 'assets/images/brochure/';
		$config['allowed_types'] = '*';
//		$config['max_size'] = 1024;				 

		$this->upload->initialize($config);

		$this->upload->do_upload('picture');
		$uploadData = $this->upload->data();
		$picture = $uploadData['file_name'];

		$data = array(
			"broucher" => $picture,
			"thumbnail" => "",
			"broucher_name" => $this->input->post("brochure_name"),
			"institute_id" => $this->session->userdata['institute_id']
		);
		$query = $this->db->insert("tbl_ppts",$data);
		$added++;

		$msg = '';
		$msg .= "PPT Successfully Inserted.<br>";
		$data1=["Status"=>'Active',"Message"=>$msg];
		echo json_encode($data1);
		exit();
	}
	public function update_ppt(){

		$bdata = $this->db->where("broucher_id",$this->input->post('bid'))->get("tbl_ppts")->row();
		
		$this->load->library("upload");
		//echo count();exit;
		$added = $notadded = 0;
		if($_FILES['picture']['size'] > 0){

			$config['upload_path'] = 'assets/images/brochure/';
			$config['allowed_types'] = '*';
//				$config['max_size'] = 1024;				 

			$this->upload->initialize($config);

			if($this->upload->do_upload('picture')){
				$uploadData = $this->upload->data();
				$picture = $uploadData['file_name'];

				$added++;
			}else{
				$notadded++;
			}

		}else{

			$picture = $bdata->broucher;

		}


		$data = array(
			"thumbnail" => "",
			"broucher" => $picture,
			"broucher_name" => $this->input->post("brochure_name"),
		);

		$d = $this->db->where("broucher_id",$this->input->post('bid'))->update("tbl_ppts",$data);

		$msg = '';
		if($d){
			$msg .= "PPT Successfully Updated.<br>";
		} 
		$data1=["Status"=>'Active',"Message"=>$msg];
		echo json_encode($data1);
		exit();
	}	
	
	
    public function delete_course($id){
		$query = $this->db->where("course_id",$id)->update(" tbl_courses",array('deleted' =>'1'));
			if($query){ redirect("institute/data/courses");}
	}
    public function delete_brochure(){
		if($this->uri->segment(4)){
			$id =$this->uri->segment(4);
			$query = $this->db->where("broucher_id ",$id)->delete("tbl_brouchers");
			if($query){ redirect("institute/data/brouchers");}
		}
	}
    public function delete_ppt(){
		if($this->uri->segment(4)){
			$id =$this->uri->segment(4);
			$query = $this->db->where("broucher_id ",$id)->delete("tbl_ppts");
			if($query){ redirect("institute/data/brouchers");}
		}
	}		
	
	
	
	public function addplacementstatistics()
	{
		if($this->uri->segment(4)){
			$data['placementstatistics'] = $this->data_model->get_placementstatistics_byid($this->uri->segment(4));
		}else{
			$data['placementstatistics'] = "";
		}
		$data['subview'] ="data/add_placementstatistics";
		$this->load->view('institute/theme',$data);
	}

	public function placementstatistics()
	{
		$institute_id =$this->session->userdata['institute_id'];
		$data['placementstatistics'] = $this->data_model->get_placementstatistics($institute_id);
		$data['subview'] ="data/placementstatistics";
		$this->load->view('institute/theme',$data);
	}


	public function saveplacementstatistics(){
		
//		print_r($_FILES);
//		exit();
		
		$data = array(
			'institute_id' => $this->session->userdata['institute_id'],
			'companyname' => $this->input->post("companyname"),
			'year' => $this->input->post("year"),
			'nostudentplaced' => $this->input->post("nostudentplaced"),
			'salaryannum' => $this->input->post("salaryannum"),
			'status' => $this->input->post("status")
		);
		
		
		if($_FILES['companylogo']['name'] != ""){
            
			$config['upload_path'] = 'uploads/companylogos';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size'] = 100;				 

			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if($this->upload->do_upload('companylogo')){
				$uploadData = $this->upload->data();
				$logo = 'uploads/companylogos/'.$uploadData['file_name'];
			}else{
				echo $this->upload->display_errors();
				$logo = '';
			}
		
		}else{
			
			$logo = $this->input->post("oldlogo");
			
		}
		
		$data["company_logo"] = $logo;
		
//		print_r($data);
//		exit();
			
		
		if($this->input->post("ps_id")){
			$this->db->where("ps_id",$this->input->post("ps_id"))->update("tbl_placementstatistics",$data); 
			
			$data1=["Status"=>'Active',"Message"=>"Details has updated successfully."];
				echo json_encode($data1);
		}else{
			$this->db->insert("tbl_placementstatistics",$data);
			
			$data1=["Status"=>'Active',"Message"=>"Successfully Inserted."];
				echo json_encode($data1);
		}	
	}

	public function delete_placementstatistics(){
		if($this->uri->segment(4)){
			$id =$this->uri->segment(4);
			$query = $this->db->where("ps_id",$id)->update("tbl_placementstatistics",array('is_deleted' =>'1'));
			if($query){ redirect("institute/data/placementstatistics");}
		}
	}


	public function addstudentsplacement()
	{
		if($this->uri->segment(4)){
			$data['studentsplacement'] = $this->data_model->get_studentsplacement_byid($this->uri->segment(4));
		}else{
			$data['studentsplacement'] = "";
		}
		$data['subview'] ="data/add_studentsplacement";
		$this->load->view('institute/theme',$data);
	}

	public function studentsplacement()
	{
		$institute_id =$this->session->userdata['institute_id'];
		$data['studentsplacement'] = $this->data_model->get_studentsplacement($institute_id);
		$data['subview'] ="data/studentsplacement";
		$this->load->view('institute/theme',$data);
	}


	public function savestudentsplacement(){
		if($_FILES['logo']){
						$config['upload_path'] = 'assets/institutes/studentplacement/'; # check path is correct
						$config['max_size'] = '0';
						$config['allowed_types'] = 'pdf'; # add video extenstion on here
						$config['overwrite'] = FALSE;
						$config['remove_spaces'] = TRUE;
						$logo_name = random_string('numeric', 5);
						$config['file_name'] = $logo_name;

						$this->load->library('upload', $config);
						$this->upload->initialize($config);

					if ($this->upload->do_upload('logo')) # form input field attribute
					{
					    $upload_data = $this->upload->data();
					    $image = $config['upload_path'].$upload_data['file_name'];
					    $file_ext = $upload_data['file_type'];
					}else{
						$image = $this->input->post('old_logo');
					}
			}
		$data = array(
			'institute_id' => $this->session->userdata['institute_id'],
			'title' => $this->input->post("title"),
			'url' => $image,
			'status' => $this->input->post("status")
		);
		
		if($this->input->post("ps_id")){
			$this->db->where("ps_id",$this->input->post("ps_id"))->update("tbl_studentsplacement",$data); 
			
			$data1=["Status"=>'Active',"Message"=>"Details has updated successfully."];
				echo json_encode($data1);
		}else{
			$this->db->insert("tbl_studentsplacement",$data);
			
			$data1=["Status"=>'Active',"Message"=>"Successfully Inserted."];
				echo json_encode($data1);
		}	
	}

	public function delete_studentsplacement(){
		if($this->uri->segment(4)){
			$id =$this->uri->segment(4);
			$query = $this->db->where("ps_id",$id)->update("tbl_studentsplacement",array('is_deleted' =>'1'));
			if($query){ redirect("institute/data/studentsplacement");}
		}
	}


	public function admission2020()
	{
		$institute_id =$this->session->userdata['institute_id'];
		$data['institute'] = $this->db->where("institute_id", $institute_id)->get("tbl_institutes")->row();
		$data['achievement'] = $this->data_model->get_achievement($institute_id);
		$data['brouchers'] = $this->db->order_by("broucher_id ","desc")->where("institute_id",$institute_id)->where("deleted",0)->get("tbl_brouchers")->result();

		$data['ppts'] = $this->db->order_by("broucher_id ","desc")->where("institute_id",$institute_id)->where("deleted",0)->get("tbl_ppts")->result();
		$data['subview'] ="data/admission2020";
		$this->load->view('institute/theme',$data);
	}
	public function save_admission2020(){
		$institute_id = $this->session->userdata['institute_id'];
		$institute = $this->db->where("institute_id", $institute_id)->get("tbl_institutes")->row();
		$data = array(
			"aboutinst" => ($this->input->post("aboutinst")) ? $this->input->post("aboutinst") : $institute->aboutinst,
			"impnote" => ($this->input->post("impnote")) ? $this->input->post("impnote") : $institute->impnote,
			"instoffr" => ($this->input->post("instoffr")) ? $this->input->post("instoffr") : $institute->instoffr,
			"meritscolar" => ($this->input->post("meritscolar")) ? $this->input->post("meritscolar") : $institute->meritscolar
		);
		$institute_update = $this->db->where("institute_id",$institute_id)->update("tbl_institutes",$data);
		if($institute_update){
			//Achievement Details
			$check_achievement = $this->db->where("institute_id", $institute_id)->get("tbl_achievement")->num_rows();
			$data = array(
				'title' => $this->input->post("title"),
				'description' => $this->input->post("description"),
				'status' => $this->input->post("status")
			);
			
			if($check_achievement>0){
				$this->db->where("institute_id", $institute_id)->update("tbl_achievement",$data);
			}else{
				$data["institute_id"] = $institute_id;
				$this->db->insert("tbl_achievement",$data);
			}
			//Achievement Details
			$data1=["Status"=>'Active',"Message"=>"Details updated successfully."];
			echo json_encode($data1);
		}
	}
	
	public function convertbase642img(){
		
		$base64_string = $this->input->post("img");
		$output_file = "uploads/banners/".random_string("alnum",15).".jpg";
		
		$ifp = fopen( $output_file, 'wb' ); 

		// split the string on commas
		// $data[ 0 ] == "data:image/png;base64"
		// $data[ 1 ] == <actual base64 string>
		$data = explode( ',', $base64_string );

		// we could add validation here with ensuring count( $data ) > 1
		fwrite( $ifp, base64_decode( $data[ 1 ] ) );

		// clean up the file resource
		fclose( $ifp ); 

		echo $output_file; 
		
	}

}
