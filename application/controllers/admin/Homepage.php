<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');

class Homepage extends MY_Controller {
    

	public function index()
	{
		$data['sliders'] = $this->homepage_model->get_slider();
		$data['subview'] = "homepage/homepage";
		$this->load->view('admin/theme',$data);
	}
	
	public function bgvideo(){
		$data['bgvideo'] = $this->db->order_by('id', 'DESC')->get("tbl_bgvideo")->row()->video;
		$data['subview'] = "homepage/bgvideo";
		$this->load->view('admin/theme',$data);
	}

// banner slider	
	
	public function set_sliderstab(){
		
		$active_tab = $this->input->post("active_tab");
		$this->session->set_userdata("active_tab",$active_tab);
		
	}
	
	public function add_imageslider(){
		
		$image_id = $this->input->post("image_id");
		
		if($_FILES['image']['name'] != ""){
			$config['upload_path'] = 'assets/udema/video/';
			$config['allowed_types'] = '*';
			$config['file_name'] = $_FILES['image']['name'];				 

			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if($this->upload->do_upload('image')){
				$uploadData = $this->upload->data();
				$picture = 'assets/udema/video/'.$uploadData['file_name'];
				
				if($image_id){
					
					unlink($this->input->post("old_image"));
						
				}
			}else{
				
				if($image_id){
			
					$picture = $this->input->post("old_image");

				}else{

					$picture = '';
						
				}
				
			}
		}
		$data = array(
			"file" => $picture,
			"type" => "image"
		);
		
		if($image_id){
			$d = $this->db->where("id",$image_id)->update("tbl_bgvideo",$data);	
		}else{
			$d = $this->db->insert("tbl_bgvideo",$data);
		}
		if($d){
			if($image_id){
				$this->session->set_flashdata("vmsg",'<div class="alert alert-success">Updated Successfully</div>');
			}else{
				$this->session->set_flashdata("vmsg",'<div class="alert alert-success">Added Successfully</div>');	
			}
			redirect("admin/homepage/bgvideo");
			
		}else{
			
			$this->session->set_flashdata("vmsg",'<div class="alert alert-danger">Error Occured</div>');	
			redirect("admin/homepage/bgvideo");
			
		}
	}
	
	public function imagestatus(){
		
		$id=$this->input->post_get("id",true);
		$status = $this->input->post("status",true);
		$data=array('status'=>$status);
		$this->db->set($data);
		$this->db->where("id",$id);
		$d=$this->db->update("tbl_bgvideo");
		if($d){
			if($status=="Active"){
				$this->session->set_flashdata("vmsg",'<div class="alert alert-success">Successfully  Enabled</div>');
				//echo $this->alert->pnotify("Success","Successfully Navbar Sub Menu Enabled","success");
			}else{
				$this->session->set_flashdata("vmsg",'<div class="alert alert-success">Successfully  Disabled</div>');
				//echo $this->alert->pnotify("Success","Successfully Navbar Sub Menu Disabled","success");	
			}

		}else{
			if($status=="Active"){

				$this->session->set_flashdata("vmsg",'<div class="alert alert-danger">Error Occured While Enabling </div>');
				//echo $this->alert->pnotify("Error","Error Occured While Enabling Navbar Sub Menu","error");
			}else{
				$this->session->set_flashdata("vmsg",'<div class="alert alert-danger">Error Occured While Disabling</div>');
				//echo $this->alert->pnotify("Error","Error Occured While Disabling Navbar Sub Menu","error");
			}	
		}
	}
	
	public function del_imageslider($id){
		
		$d = $this->db->delete("tbl_bgvideo",["id"=>$id]);
		
		if($d){
			
			unlink($this->input->post("image"));
			$this->session->set_flashdata("vmsg",'<div class="alert alert-success">Deleted Successfully</div>');	
			redirect("admin/homepage/bgvideo");
			
		}else{
			
			$this->session->set_flashdata("vmsg",'<div class="alert alert-danger">Error Occured</div>');	
			redirect("admin/homepage/bgvideo");
			
		}
		
	}
	
	
	public function add_videoslider(){
		
		$video_id = $this->input->post("video_id");
		
		if($_FILES['image']['name'] != ""){
			$config['upload_path'] = 'assets/udema/video/';
			$config['allowed_types'] = '*';
			$config['file_name'] = $_FILES['image']['name'];				 

			$this->load->library('upload',$config);
			$this->upload->initialize($config);

			if($this->upload->do_upload('image')){
				$uploadData = $this->upload->data();
				$picture = 'assets/udema/video/'.$uploadData['file_name'];
				
				if($video_id){
					
					unlink($this->input->post("old_video"));
						
				}
			}else{
				
				if($video_id){
			
					$picture = $this->input->post("old_video");

				}else{

					$picture = '';
						
				}
				
			}
		}
		$data = array(
			"file" => $picture,
			"type" => "video"
		);
		
		if($video_id){
			$d = $this->db->where("id",$video_id)->update("tbl_bgvideo",$data);	
		}else{
			$d = $this->db->insert("tbl_bgvideo",$data);
		}
		if($d){
			if($video_id){
				$this->session->set_flashdata("vidmsg",'<div class="alert alert-success">Updated Successfully</div>');
			}else{
				$this->session->set_flashdata("vidmsg",'<div class="alert alert-success">Added Successfully</div>');	
			}
			redirect("admin/homepage/bgvideo");
			
		}else{
			
			$this->session->set_flashdata("vidmsg",'<div class="alert alert-danger">Error Occured</div>');	
			redirect("admin/homepage/bgvideo");
			
		}
	}
	
	public function videostatus(){
		
		$id=$this->input->post_get("id",true);
		$status = $this->input->post("status",true);
		$data=array('status'=>$status);
		$this->db->set($data);
		$this->db->where("id",$id);
		$d=$this->db->update("tbl_bgvideo");
		if($d){
			if($status=="Active"){
				$this->session->set_flashdata("vidmsg",'<div class="alert alert-success">Successfully  Enabled</div>');
				//echo $this->alert->pnotify("Success","Successfully Navbar Sub Menu Enabled","success");
			}else{
				$this->session->set_flashdata("vidmsg",'<div class="alert alert-success">Successfully  Disabled</div>');
				//echo $this->alert->pnotify("Success","Successfully Navbar Sub Menu Disabled","success");	
			}

		}else{
			if($status=="Active"){

				$this->session->set_flashdata("vidmsg",'<div class="alert alert-danger">Error Occured While Enabling </div>');
				//echo $this->alert->pnotify("Error","Error Occured While Enabling Navbar Sub Menu","error");
			}else{
				$this->session->set_flashdata("vidmsg",'<div class="alert alert-danger">Error Occured While Disabling</div>');
				//echo $this->alert->pnotify("Error","Error Occured While Disabling Navbar Sub Menu","error");
			}	
		}
	}
	
	public function del_videoslider($id){
		
		$d = $this->db->delete("tbl_bgvideo",["id"=>$id]);
		
		if($d){
			
			unlink($this->input->post("video"));
			$this->session->set_flashdata("vidmsg",'<div class="alert alert-success">Deleted Successfully</div>');	
			redirect("admin/homepage/bgvideo");
			
		}else{
			
			$this->session->set_flashdata("vidmsg",'<div class="alert alert-danger">Error Occured</div>');	
			redirect("admin/homepage/bgvideo");
			
		}
		
	}	
	

// End banner slider	
	
	public function blocks(){
		$data['blocks'] = $this->db->order_by('id', 'DESC')->get("tbl_card_blocks")->result();
		$data['subview'] = "homepage/blocks";
		$this->load->view('admin/theme',$data);
	}
	
	public function update_block(){
		$data = $this->input->post();
		unset($data["id"]);
		unset($data["url"]);
		$this->db->where("id",$this->input->post("id"))->update("tbl_card_blocks",$data);
		$data1=["Status"=>'Active',"Message"=>"Successfully Updated."];
		echo json_encode($data1);
		exit();
			
	}
	public function block_status(){
		$status = $this->input->post("status",true);
	//	print_r($status);die;
		//$this->db->where("status",$status);
		$d=$this->db->update("tbl_card_blocks",array("status"=>$status));
		if($d){
			if($status=="1"){
				$this->session->set_flashdata("Success",'<div class="alert alert-success">Successfully  Enabled</div>');
			}else{
				$this->session->set_flashdata("Success",'<div class="alert alert-success">Successfully  Disabled</div>');
			}
		}else{
			if($status=="0"){
				$this->session->set_flashdata("Error",'<div class="alert alert-danger">Error Occured While Enabling </div>');
			}else{
				$this->session->set_flashdata("Error",'<div class="alert alert-danger">Error Occured While Disabling</div>');
			}	
		}
	}
	
	public function slider(){
		$data['sliders'] = $this->homepage_model->get_slider();
		$data['subview'] = "homepage/homepage";
		$this->load->view('admin/theme',$data);
	}
	
	public function sociallinks(){
		$data['news'] = json_decode($this->db->get_where("tbl_homepage_sociallinks")->row()->links);
		$data['subview'] = "homepage/sociallinks";
		$this->load->view('admin/theme',$data);
	}
	
	public function updatesociallinks(){
		
		$data = ["facebook"=>$this->input->post("fb"),"twitter"=>$this->input->post("twitter"),"google"=>$this->input->post("google"),"pinterest"=>$this->input->post("pinterest"),"instagram"=>$this->input->post("instagram"),"youtube"=>$this->input->post("youtube")];
		
		$this->db->where("id",1)->update("tbl_homepage_sociallinks",["links"=>json_encode($data)]);
		$data1=["Status"=>'Active',"Message"=>"Successfully Updated."];
		echo json_encode($data1);
		exit();
		
	}
	
    public function news(){
		$data['news'] = $this->db->select("tbl_news.*, tbl_news_events_categories.category_name")->where("tbl_news.is_deleted",'0')->order_by('tbl_news.news_id', 'DESC')->join("tbl_news_events_categories", "tbl_news_events_categories.id = tbl_news.category_id", "left")->get("tbl_news")->result();
		$data['subview'] = "homepage/news";
		$this->load->view('admin/theme',$data);
	}	

	public function add_news(){
		if($this->uri->segment(4)){
			$data['news'] = $this->homepage_model->get_news_id($this->uri->segment(4));
		}else{
			$data['news'] = "";
		}
		$data['necategories'] = $this->db->where("status",'Active')->get("tbl_news_events_categories")->result();
		$data['subview'] = "homepage/add_news";
		$this->load->view('admin/theme',$data);
	}
	public function add_slider(){
		if($this->uri->segment(4)){
			$data['slider'] = $this->homepage_model->get_slider_id($this->uri->segment(4));
		}else{
			$data['slider'] = "";
		}

		$data['subview'] = "homepage/add_slider";
		$this->load->view('admin/theme',$data);
	}
	public function save_slider(){
		if($_FILES['picture']['name'] != ""){
			    $config['upload_path'] = 'assets/images/homepage';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['picture']['name'];				 
				
				$this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('picture')){
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                }else{
                    $picture = '';
                }
		}else{
			$picture = $this->input->post("image");
		}
		        
		
		$data = array(
			"image" => $picture,
			"text" => $this->input->post("text")
		);
		

		if($this->input->post("slider_id") != ""){
			$this->db->where("slider_id",$this->input->post("slider_id"))->update("tbl_sliders",$data);
			$data1=["Status"=>'Active',"Message"=>"Successfully Updated."];
			echo json_encode($data1);
			exit();
		}else{
			$query = $this->db->insert("tbl_sliders",$data);
			$data1=["Status"=>'Active',"Message"=>"Successfully Inserted."];
		    echo json_encode($data1);
		    exit();
		} 
		 
		
			
	}
		public function save_news(){
		if($_FILES['image']['name']){
			$type = $_FILES['image']['type'];
			if($type=='image/jpeg'){
				$config['upload_path'] = 'assets/news/'; # check path is correct
				$config['max_size'] = '0';
				//$config['allowed_types'] = 'jpeg|jpg|png'; # add video extenstion on here
				$config['allowed_types'] = 'jpeg|jpg|png'; # add video extenstion on here
				$config['overwrite'] = FALSE;
				$config['remove_spaces'] = TRUE;
				$image_name = random_string('numeric', 5);
				$config['file_name'] = $image_name;

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ($this->upload->do_upload('image')) # form input field attribute
				{
				    $upload_data = $this->upload->data();
				    $image = $config['upload_path'].$upload_data['file_name'];
				    $file_ext = $upload_data['file_type'];
				}else{
					$image = $this->input->post('old_image');
				}
			}
			else{
				$data1=["Status"=>'Inactive',"Message"=>"Image extension not allowed."];
				echo json_encode($data1);
				exit();
			}
		} else {
			$image = $this->input->post('old_image');
		}

		$data = array(
			"title" => $this->input->post("title"),
			"type" => $this->input->post("type"),
			"category_id" => $this->input->post("category_id"),
			"createdby" => $this->input->post("createdby"),
			"message" => $this->input->post("text"),
			'image' => $image,
			"status" => $this->input->post("status")
		);
		

		if($this->input->post("news_id") != ""){
			$this->db->where("news_id",$this->input->post("news_id"))->update("tbl_news",$data);
			$data1=["Status"=>'Active',"Message"=>"Successfully Updated."];
			echo json_encode($data1);
			exit();
		}else{
			$query = $this->db->insert("tbl_news",$data);
			$data1=["Status"=>'Active',"Message"=>"Successfully Inserted."];
		    echo json_encode($data1);
		    exit();
		} 
		 
		
			
	}

	

	public function delete_slider(){
		if($this->uri->segment(4)){
			$id =$this->uri->segment(4);
			$query = $this->db->where("slider_id",$id)->update("tbl_sliders",array('is_deleted' =>'1'));
			if($query){ redirect("admin/institutes");}
		}
	}
	public function delete_news(){
		if($this->uri->segment(4)){
			$id =$this->uri->segment(4);
			$query = $this->db->where("news_id",$id)->update("tbl_news",array('is_deleted' =>'1'));
			if($query){ redirect("admin/homepage/news");}
		}
	}
	public function cards(){
		$data['cards'] = $this->db->where("is_deleted",'0')->order_by('card_id', 'DESC')->get("tbl_cards")->result();
		$data['subview'] = "homepage/cards";
		$this->load->view('admin/theme',$data);
	}
	public function add_card(){
		if($_FILES['picture']['name'] != ""){
			    $config['upload_path'] = 'assets/images/cards';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['picture']['name'];				 
				
				$this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('picture')){
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                }else{
                    $picture = '';
                }
		}else{
			$picture = $this->input->post("card_image");
		}
		        
		
		$data = array(
			"card_image" => $picture,
			"card_title" => $this->input->post("card_title"),
			"card_desc" => $this->input->post("card_desc"),
			"card_link" => $this->input->post("card_link")
		);
		if($this->input->post("cid") != ""){
			$this->db->where("card_id",$this->input->post("cid"))->update("tbl_cards",$data);
			$data1=["Status"=>'Active',"Message"=>"Successfully Updated."];
			echo json_encode($data1);
			exit();
		}else{
			$query = $this->db->insert("tbl_cards",$data);
			$data1=["Status"=>'Active',"Message"=>"Successfully Inserted."];
		    echo json_encode($data1);
		    exit();
		} 
			
	}
	public function delete_cards(){
		if($this->uri->segment(4)){
			$id =$this->uri->segment(4);
			$query = $this->db->where("card_id",$id)->update("tbl_cards",array('is_deleted' =>'1'));
			if($query){ redirect("admin/cards");}
		}
	}
	public function testimonials(){
		$data['testimonials'] = $this->db->where("is_deleted",'0')->order_by('test_id', 'DESC')->get("tbl_testimonials")->result();
		$data['subview'] = "homepage/testimonials";
		$this->load->view('admin/theme',$data);
	}
	public function add_test(){
		if($_FILES['picture']['name'] != ""){
			$type = $_FILES['picture']['type'];
			if($type=='image/jpeg'){
			    $config['upload_path'] = 'assets/images/testimonials';
                //$config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['allowed_types'] = 'jpg|jpeg';
                $config['file_name'] = $_FILES['picture']['name'];				 
				
				$this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('picture')){
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                }else{
                    $picture = '';
                }
            }
            else{
            	$data1=["Status"=>'Inactive',"Message"=>"File extension not allowed."];
				echo json_encode($data1);
				exit();
            }
		}else{
			$picture = $this->input->post("test_image");
		}
		        
		
		$data = array(
			"student_name" => $this->input->post("student_name"),
			"student_msg" => $this->input->post("student_msg"),
			"student_quali" => $this->input->post("student_quali"),
			"status" => $this->input->post("student_status")
		);
		if($this->input->post("tid") != ""){
			$testimonial = $this->db->where("test_id",$this->input->post("tid"))->get("tbl_testimonials")->row();
			$data["student_image"] = ($picture!='') ? $picture : $testimonial->student_image;
			$this->db->where("test_id",$this->input->post("tid"))->update("tbl_testimonials",$data);
			$data1=["Status"=>'Active',"Message"=>"Successfully Updated."];
			echo json_encode($data1);
			exit();
		}else{
			$data["student_image"] = $picture;
			$query = $this->db->insert("tbl_testimonials",$data);
			$data1=["Status"=>'Active',"Message"=>"Successfully Inserted."];
		    echo json_encode($data1);
		    exit();
		} 
			
	}
	public function delete_test(){
		if($this->uri->segment(4)){
			$id =$this->uri->segment(4);
			$query = $this->db->where("test_id",$id)->update("tbl_testimonials",array('is_deleted' =>'1'));
			if($query){ redirect("admin/testimonials");}
		}
	}
	public function testimonials_status(){
		$id=$this->input->post_get("id",true);
		$status = $this->input->post("status",true);
		$data=array('status'=>$status);
		$this->db->set($data);
		$this->db->where("test_id",$id);
		$d=$this->db->update("tbl_testimonials");
		if($d){
			if($status=="Active"){
				$this->session->set_flashdata("Success",'<div class="alert alert-success">Successfully  Enabled</div>');
			}else{
				$this->session->set_flashdata("Success",'<div class="alert alert-success">Successfully  Disabled</div>');
			}
		}else{
			if($status=="Active"){
				$this->session->set_flashdata("Error",'<div class="alert alert-danger">Error Occured While Enabling </div>');
			}else{
				$this->session->set_flashdata("Error",'<div class="alert alert-danger">Error Occured While Disabling</div>');
			}	
		}
	}


    public function partners(){
		$data['partners'] = $this->db->where("is_deleted",'0')->order_by('partner_id', 'DESC')->get("tbl_partners")->result();
		$data['subview'] = "homepage/partners";
		$this->load->view('admin/theme',$data);
	}
	public function add_partner(){
		if($_FILES['picture']['name'] != ""){
			$type = $_FILES['picture']['type'];
			if($type=='image/jpeg'){
			    $config['upload_path'] = 'assets/images/partners';
                //$config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['allowed_types'] = 'jpg|jpeg';
                $config['file_name'] = $_FILES['picture']['name'];
				$config['max_width']            = 300;
                $config['max_height']           = 200;
				
				$this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('picture')){
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                }else{
                    $picture = '';
					$data1=["Status"=>'Inactive',"Message"=>$this->upload->display_errors()];
					echo json_encode($data1);
					exit();
                }
            }
            else{
            	$data1=["Status"=>'Inactive',"Message"=>"File extension not allowed."];
				echo json_encode($data1);
				exit();
            }
		}else{
			$picture = $this->input->post("partner_image");
		}
		$data = array(
			"name" => $this->input->post("name"),
			"categories_partners" => $this->input->post("categories_partners"),
			"year" => $this->input->post("year"),
			"partner_image" => $picture
		);
		if($this->input->post("pid") != ""){
			$this->db->where("partner_id",$this->input->post("pid"))->update("tbl_partners",$data);
			$data1=["Status"=>'Active',"Message"=>"Successfully Updated."];
			echo json_encode($data1);
			exit();
		}else{
			$query = $this->db->insert("tbl_partners",$data);
			$data1=["Status"=>'Active',"Message"=>"Successfully Inserted."];
		    echo json_encode($data1);
		    exit();
		} 
			
	}
	public function delete_partner(){
		if($this->uri->segment(4)){
			$id =$this->uri->segment(4);
			$query = $this->db->where("partner_id",$id)->update("tbl_partners",array('is_deleted' =>'1'));
			if($query){ redirect("admin/partners");}
		}
	}
	public function necategories(){
		$data['necategories'] = $this->db->order_by('id', 'DESC')->get("tbl_news_events_categories")->result();
		$data['subview'] = "homepage/necategories";
		$this->load->view('admin/theme',$data);
	}	

	public function add_necategory(){
		if($this->uri->segment(4)){
			$data['category'] = $this->db->where('id', $this->uri->segment(4))->get("tbl_news_events_categories")->row();
		}else{
			$data['category'] = "";
		}

		$data['subview'] = "homepage/add_necategory";
		$this->load->view('admin/theme',$data);
	}
	public function save_necategory(){
		$id = $this->input->post("id");
		$category_name = $this->input->post("category_name");
		$status = $this->input->post("status");
		if($category_name){
			$category = $this->db->select("*")->where("category_name", $category_name);
			if(isset($id)){
				$category = $category->where("id!=", $id);
			}
			$category = $category->get("tbl_news_events_categories")->row();
			if(!$category){
				$data = array(
					"category_name" => $this->input->post("category_name"),
					"status" => ($status!='') ? $status : 'Inactive'
				);
				if($id != ""){
					$this->db->where("id",$id)->update("tbl_news_events_categories",$data);
					$data1=["Status"=>'Active',"Message"=>"Successfully Updated."];
					echo json_encode($data1);
					exit();
				}else{
					$query = $this->db->insert("tbl_news_events_categories",$data);
					$data1=["Status"=>'Active',"Message"=>"Successfully Inserted."];
				    echo json_encode($data1);
				    exit();
				}
			}
			else{
				$data1=["Status"=>'Inactive',"Message"=>"Category already exists."];
			    echo json_encode($data1);
			    exit();
			}
		}	
		else{
			$data1=["Status"=>'Inactive',"Message"=>"Category name is required."];
		    echo json_encode($data1);
		    exit();
		}
	}

	

	public function delete_necategory(){
		if($this->uri->segment(4)){
			$id =$this->uri->segment(4);
			$query = $this->db->where("id",$id)->delete("tbl_news_events_categories");
			if($query){ redirect("admin/homepage/necategories");}
		}
	}
	public function feedback()
	{  
		$data['feedback'] = $this->db->order_by("id","desc")->get('tbl_feedback_history')->result();
		$data["admin"] = $this->db->where("id",$this->session->userdata('admin_id'))->get("tbl_admin")->row();
		 $query = $data["admin"];
			foreach ($query as $row) {
     		 $this->db->update('tbl_feedback_history',$row, array('id' => $row->id));
		}
		//echo  $this->db->last_query();die;
		$data['subview'] ="homepage/feedback";
		$this->load->view('admin/theme',$data);
	}
	
	public function menustatus(){
		$data["menustatus"] = $this->db->get_where("tbl_dynamic_menu")->result();
		$data['subview'] ="homepage/menustatus";
		$this->load->view('admin/theme',$data);
	}
	public function save_menustatus(){
		$menu = $this->input->post("menustatus");
		$totalmenu = $this->input->post("totalmenus");
		foreach ($menu as $k => $m) {
			$on[] = $k;
			$q = $this->db->where("id", $k)->update("tbl_dynamic_menu", array("status" => 1));
		}
		foreach ($totalmenu as $m) {
			if(!in_array($m, $on)){
				$q = $this->db->where("id", $m)->update("tbl_dynamic_menu", array("status" => 0));
			}
		}
		
		foreach($totalmenu as $tm){
		
			$mname = $this->input->post("menuname")[$tm];
			$this->db->where("id", $tm)->update("tbl_dynamic_menu", array("menu_name" => $mname));
			
		}
		$data1=["Status"=>'Active',"Message"=>"Successfully Updated."];
		echo json_encode($data1);
		exit();
	}

	public function foot_dec(){
		$data['foot_dec'] = $this->db->get_where("tbl_footer_description")->row();
		$data['subview'] ="homepage/footer_description";
		$this->load->view('admin/theme',$data);
	}
	public function updatedec(){
		$data = [
			"title"=>$this->input->post("title"),
		    "description"=>$this->input->post("description"),
		];
		$this->db->where("id",1)->update("tbl_footer_description",$data);
		$data1=["Status"=>'Active',"Message"=>"Successfully Updated."];
		echo json_encode($data1);
		exit();
		
	}

	public function contact(){
		$data['contact'] = json_decode($this->db->get_where("tbl_homepage_sociallinks",["type"=>"contact"])->row()->links);
		$data['subview'] ="homepage/contact";
		$this->load->view('admin/theme',$data);
	}
	public function updatecontact(){
		$data = [
			"mobile_number"=>$this->input->post("mobile_number"),
			"email"=>$this->input->post("email"),
			"website_link"=>$this->input->post("websitelink"),
		];
		$this->db->where("id",2)->update("tbl_homepage_sociallinks",["links"=>json_encode($data)]);
		$data1=["Status"=>'Active',"Message"=>"Successfully Updated."];
		echo json_encode($data1);
		exit();
		
	}
	public function footer_menu(){
		$data["nav"] = $this->db->query("select * from tbl_footer_menu where deleted=0 order by id desc")->result();
		$data['subview'] ="homepage/footer_settings";
		$this->load->view('admin/theme',$data);
	}
	public function updatefooter($id){
		$data["n"] = $this->db->get_where("tbl_footer_menu",array("id"=>$id))->row();
		$data["smenu"] = $this->db->query("select * from tbl_footer_submenu where deleted=0  and menu_name=$id order by id desc")->result();
		$data['subview'] ="homepage/edit_footer";
		$this->load->view("admin/theme",$data);
	}
	public function footer_submenu($id){
		$data["n"] = $this->db->get_where("tbl_footer_menu",array("id"=>$id))->row();
		$data["smenu"] = $this->db->query("select * from tbl_footer_submenu where deleted=0  and menu_name=$id order by id desc")->result();
		$data['subview'] ="homepage/footer_submenu";
		$this->load->view('admin/theme',$data);
	}
	public function updatefootersubmenu($id){
		$data["sm"] = $this->db->get_where("tbl_footer_submenu",array("id"=>$id))->row();
		//$data["smenu"] = $this->db->query("select * from tbl_footer_submenu where deleted=0  and menu_name=$id order by id desc")->result();
	   //echo "<pre>";print_r($data["sm"]);die;
		$data['subview'] ="homepage/edit_footersubmenu";
		$this->load->view('admin/theme',$data);
	}
	public function footer_insert(){
		$name = $this->input->post("name",true);
		$link = $this->input->post("link",true);
		$target = $this->input->post("target",true);
		$date = date("Y-m-d H:i:s");
		if($link==""){
			$this->session->set_flashdata('error', "Please Select Menu Link","error");
			//$this->alert->pnotify("error","Please Select Menu Link","error");
			redirect("admin/homepage/footer_menu");
		}
		if($target==""){
			$this->session->set_flashdata('error', "Please Select Link Target","error");
			//$this->alert->pnotify("error","Please Select Link Target","error");
			redirect("admin/homepage/footer_menu");
		}
		$chk = $this->db->get_where("tbl_footer_menu",array("name"=>$name,"deleted"=>0))->num_rows();
		if($chk>=1){
			$this->session->set_flashdata('error', " Menu Already Exists","error");
				//$this->alert->pnotify("error"," Menu Already Exists","error");
				redirect("admin/homepage/footer_menu");
		}
		$lchk = $this->db->get_where("tbl_footer_menu",array("link"=>$link,"deleted"=>0))->num_rows();
		if($lchk>=1){
			$this->session->set_flashdata('error',"Link Already Exists","error");
				//$this->alert->pnotify("error","Link Already Exists","error");
				redirect("admin/homepage/footer_menu");
		}
		$data = array(

			"name" => $name,
			"link" => $link,
			"target" => $target,
			"created_date" => $date
		);
			$n = $this->db->insert("tbl_footer_menu",$data);
			if($n){
				$this->session->set_flashdata("success"," Successfully Added","success");

					//$this->alert->pnotify("success"," Successfully Added","success");
					redirect("admin/homepage/footer_menu");
			}else{
				$this->session->set_flashdata("error","Error Occured ","error");
					//$this->alert->pnotify("error","Error Occured ","error");
					redirect("admin/homepage/footer_menu");
			}
	}
	public function insertsubmenufooter(){
		//$id = $this->input->post("id");
		$mname = $this->input->post("menu_id",true);
		$smname = $this->input->post("sub_menu_name",true);
		$link = $this->input->post("sub_menu_link",true);
		$target = $this->input->post("sub_menu_target",true);
		$date = date("Y-m-d H:i:s");
	//	$chk = $this->db->get_where("fdm_va_navbar_header_submenu",array("sub_menu_link"=>$link,"deleted"=>0))->num_rows();
	//	if($chk>=1){
	//
	//			$this->alert->pnotify("error","Link Already Exists","error");
	//			redirect("menus/sub-menu/".$mname);
	//	}
		
		$data = array(
			"menu_name" => $mname,
			"sub_menu_name" => $smname,
			"sub_menu_link" => $link,
			"sub_menu_target" => $target,
			"created_date" => $date,
		);
		
		$n = $this->db->insert("tbl_footer_submenu",$data);
		if($n){
			$this->session->set_flashdata("success"," Successfully Added","success");
				//$this->alert->pnotify("success"," Successfully Added","success");
				redirect("admin/homepage/footer_submenu/".$mname);
		}else{
			$this->session->set_flashdata("error","Error Occured While Adding ","error");
				//$this->alert->pnotify("error","Error Occured While Adding ","error");
				redirect("admin/homepage/footer_submenu/".$mname);
		}
	}
	public function footerstatus(){
		
		$id=$this->input->post_get("id",true);
		$status = $this->input->post("status",true);
		$data=array('status'=>$status);
		
		$this->db->set($data);
		$this->db->where("id",$id);
		$d=$this->db->update("tbl_footer_menu");
		if($d){
			if($status=="Active"){
				$this->session->set_flashdata("Success","Successfully Enabled","success");
				//echo $this->alert->pnotify("Success","Successfully Enabled","success");
			}else{
				$this->session->set_flashdata("Success","Successfully  Disabled","success");
				//echo $this->alert->pnotify("Success","Successfully  Disabled","success");	
			}
		}else{
			if($status=="Active"){
				$this->session->set_flashdata("Error","Error Occured While Enabling ","error");
				//echo $this->alert->pnotify("Error","Error Occured While Enabling ","error");
			}else{
				$this->session->set_flashdata("Error","Error Occured While Disabling ","error");
				//echo $this->alert->pnotify("Error","Error Occured While Disabling ","error");
			}	
		}
	}

	public function footerSubmenustatus(){
		$id=$this->input->post_get("id",true);
		$status = $this->input->post("status",true);
		$data=array('status'=>$status);
		$this->db->set($data);
		$this->db->where("id",$id);
		$d=$this->db->update("tbl_footer_submenu");
		if($d){
			if($status=="Active"){
				$this->session->set_flashdata("Success","Successfully  Enabled","success");
				//echo $this->alert->pnotify("Success","Successfully Navbar Sub Menu Enabled","success");
			}else{
				$this->session->set_flashdata("Success","Successfully  Disabled","success");
				//echo $this->alert->pnotify("Success","Successfully Navbar Sub Menu Disabled","success");	
			}

		}else{
			if($status=="Active"){

				$this->session->set_flashdata("Error","Error Occured While Enabling ","error");
				//echo $this->alert->pnotify("Error","Error Occured While Enabling Navbar Sub Menu","error");
			}else{
				$this->session->set_flashdata("Error","Error Occured While Disabling ","error");
				//echo $this->alert->pnotify("Error","Error Occured While Disabling Navbar Sub Menu","error");
			}	
		}
	}	
	public function editfooter(){
		$id = $this->input->post("id");
		$name = $this->input->post("name",true);
		$link = $this->input->post("link",true);
		$target = $this->input->post("target",true);
		$date = date("Y-m-d H:i:s");
		$nchk = $this->db->get_where("tbl_footer_menu",array("name"=>$name,"id"=>$id))->row()->name;
		if($nchk==$name){
			$data = array("name" => $name);
			 $this->db->set($data);
			 $this->db->where("id",$id);
			 $this->db->update("tbl_footer_menu");
		}else{
			$nchk1 = $this->db->get_where("tbl_footer_menu",array("name"=>$name,"deleted"=>0))->num_rows();	
			if($nchk1>=1){
				$this->alert->pnotify("error","Menu Name Already Exists","error");
				redirect("admin/homepage/footer_menu/".$id);
			}else{	
			$data = array("name" => $name);
	
			 $this->db->set($data);
			 $this->db->where("id",$id);
			 $this->db->update("tbl_footer_menu");
			}
		}
		
		$lchk = $this->db->get_where("tbl_footer_menu",array("link"=>$link,"id"=>$id))->row()->link;
		if($lchk==$link){
			$data = array("link" => $link);
			 $this->db->set($data);
			 $this->db->where("id",$id);
			 $this->db->update("tbl_footer_menu");
		}else{
			$lchk1 = $this->db->get_where("tbl_footer_menu",array("link"=>$link,"deleted"=>0))->num_rows();	
			if($lchk1>=1){
				$this->alert->pnotify("error","Link Already Exists","error");
				redirect("admin/homepage/footer_menu/".$id);					
			}else{	
			$data = array("link" => $link);
	
			 $this->db->set($data);
			 $this->db->where("id",$id);
			 $this->db->update("tbl_footer_menu");
			}
		}	
		$data = array(
			"target" => $target,
			"updated_date" => $date,
		);
		$this->db->set($data);
		$this->db->where("id",$id);
		$n = $this->db->update("tbl_footer_menu");		
		if($n){
			$this->session->set_flashdata("success"," Successfully Updated","success");
				//$this->alert->pnotify("success","Navbar Menu Successfully Updated","success");
				redirect("admin/homepage/footer_menu");
		}else{
			$this->session->set_flashdata("error","Error Occured While Updating ","error");
				//$this->alert->pnotify("error","Error Occured While Updating Navbar Menu","error");
				redirect("admin/homepage/footer_menu");
		}
	}
	public function editfootersubmenu(){
		$id = $this->input->post("id");
		$mname = $this->input->post("menu_name",true);
		$smname = $this->input->post("sub_menu_name",true);
		$link = $this->input->post("sub_menu_link",true);
		$target = $this->input->post("sub_menu_target",true);
		$date = date("Y-m-d H:i:s");
		$data = array(
			"menu_name" => $mname,
			"sub_menu_name" => $smname,
			"sub_menu_target" => $target,
			"sub_menu_link" => $link,
			"updated_date" => $date,
		);
		$this->db->set($data);
		$this->db->where("id",$id);
		$n = $this->db->update("tbl_footer_submenu");	
		if($n){
			$this->session->set_flashdata("success","Successfully Updated","success");
				//$this->alert->pnotify("success","Navbar Sub Menu Successfully Updated","success");
				redirect("admin/homepage/footer_submenu/".$mname);
		}else{
			$this->session->set_flashdata("error","Error Occured While Updating ","error");
				//$this->alert->pnotify("error","Error Occured While Updating Navbar Sub Menu","error");
				redirect("admin/homepage/footer_submenu/".$mname);
		}
	}
	public function footerdelete($id){
			$data = array("deleted"=>1,"status"=>"Inactive");
			$this->db->set($data);
			$this->db->where("id",$id);
			$d = $this->db->update("tbl_footer_menu");
			if($d){
					$data = array("deleted"=>1,"status"=>"Inactive");
					$this->db->set($data);
					$this->db->where("menu_name",$id);
					$d = $this->db->update("tbl_footer_submenu");
					$this->session->set_flashdata("success","Navbar Menu Successfully Deleted","success");
					//$this->alert->pnotify("success","Navbar Menu Successfully Deleted","success");
					redirect("admin/homepage/footer_menu");
			}else{
				$this->session->set_flashdata("error","Error Occured While Deleting Navbar Menu","error");
					//$this->alert->pnotify("error","Error Occured While Deleting Navbar Menu","error");
					redirect("admin/homepage/footer_menu");
			}
		}
	public function delsubfooter($id){
         //echo $id;die;
		$data = array("deleted"=>1,"status"=>"Inactive");
		$this->db->set($data);
		$this->db->where("id",$id);
		$d = $this->db->update("tbl_footer_submenu");
		if($d){
			$this->session->set_flashdata("success"," Successfully Deleted","success");
				//$this->alert->pnotify("success"," Successfully Deleted","success");
				redirect("menus/edit-sub-menu/".$id);
		}else{
			$this->session->set_flashdata("error","Error Occured While Deleting ","error");
				//$this->alert->pnotify("error","Error Occured While Deleting ","error");
				redirect("menus/edit-sub-menu/".$id);
		}
	}

	  public function why_to_attend(){
		$data['points'] = $this->db->where("type",'bullet')->get("tbl_bullet_points")->result();
		$data['subview'] = "homepage/whytoattend";
		$this->load->view('admin/theme',$data);
	}
	public function  add_to_attend(){
		$id = $this->input->post("video_id");

		$data = array(
			"point" => $this->input->post("bullet"),
			"type" => 'bullet',
			"created_date" =>date("Y-m-d H:i:s")
		);
		//$insert = $this->db->insert("tbl_bullet_points",$data);
		if($id){
			$insert = $this->db->where("id",$id)->update("tbl_bullet_points",$data);	
		}else{
			$insert = $this->db->insert("tbl_bullet_points",$data);
		}
		if($insert){
			if($id){
				$this->session->set_flashdata("vidmsg",'<div class="alert alert-success">Updated Successfully</div>');
			}else{
				$this->session->set_flashdata("vidmsg",'<div class="alert alert-success">Added Successfully</div>');	
			}
			redirect("admin/homepage/why_to_attend/");
			
		}else{
			
			$this->session->set_flashdata("vidmsg",'<div class="alert alert-danger">Error Occured</div>');	
			redirect("admin/homepage/why_to_attend/");
			
		}

	}

	public function delete_why_to_attend($id){
		$d = $this->db->delete("tbl_bullet_points",["id"=>$id]);
		
		if($d){
			
			//unlink($this->input->post("video"));
			$this->session->set_flashdata("vidmsg",'<div class="alert alert-success">Deleted Successfully</div>');	
			redirect("admin/homepage/why_to_attend/");
			
		}else{
			
			$this->session->set_flashdata("vidmsg",'<div class="alert alert-danger">Error Occured</div>');	
			redirect("admin/homepage/why_to_attend/");
			
		}
		
	}

	public function add_image(){
		$id = $this->input->post("image_id");
		if($_FILES['image']['name'] != ""){
			$config['upload_path'] = 'assets/udema/video/';
			$config['allowed_types'] = '*';
			$config['file_name'] = $_FILES['image']['name'];
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
		    if($this->upload->do_upload('image')){
				$uploadData = $this->upload->data();
				$picture = 'assets/udema/video/'.$uploadData['file_name'];
			}

		}
		$data = array(
			"point" => $picture,
			"type" => "image",
			"created_date" =>date("Y-m-d H:i:s")
		);
		if($id){
			$d = $this->db->where("id",$id)->update("tbl_bullet_points",$data);	
			
		}else{
			$d = $this->db->insert("tbl_bullet_points",$data);
		}
		if($d){
			if($id){
				$this->session->set_flashdata("vmsg",'<div class="alert alert-success">Updated Successfully</div>');
			}else{
				$this->session->set_flashdata("vmsg",'<div class="alert alert-success">Added Successfully</div>');	
			}
			redirect("admin/homepage/why_to_attend/");
			
		}else{
			
			$this->session->set_flashdata("vmsg",'<div class="alert alert-danger">Error Occured</div>');	
			redirect("admin/homepage/why_to_attend/");
			
		}

		redirect("admin/homepage/why_to_attend/");
	}

	public function del_image($id){
		
		$d = $this->db->delete("tbl_bullet_points",["id"=>$id]);
		
		if($d){
			
			unlink($this->input->post("image"));
			$this->session->set_flashdata("vmsg",'<div class="alert alert-success">Deleted Successfully</div>');	
			redirect("admin/homepage/why_to_attend/");
			
		}else{
			
			$this->session->set_flashdata("vmsg",'<div class="alert alert-danger">Error Occured</div>');	
			redirect("admin/homepage/why_to_attend/");
			
		}
		
	}
}
