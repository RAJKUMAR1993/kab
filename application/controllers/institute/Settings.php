<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');

class Settings extends CI_Controller {
	public function __construct()
	    {
	        parent::__construct();
	        if($this->session->userdata['login_type']!='institute'){redirect('institute/login');}
			$this->admin_email = $this->login_model->get_option("admin_email_id")->email;
	    }


	public function basic()
	{

		$data["admin"] = $this->db->where("institute_id",$this->session->userdata('institute_id'))->get("tbl_institutes")->row();
		$data['categories'] = $this->category_model->get_category();
		// $data["countries"] = $this->db->get("tbl_countries")->result();
		// $data["states"] = $this->db->get("tbl_states")->result();
		// $data["districts"] = $this->db->get("tbl_cities")->result();
		$data['subview'] ="settings/basic_details";
		$this->load->view('institute/theme',$data);
	}

	public function update_basic(){
		$id = $this->session->userdata('institute_id');
		$email = $this->input->post('email');

			

		$data = array(
			"institute_name" =>$this->input->post("name"),
			"full_name" =>$this->input->post("fullname"),
			"designation" => $this->input->post("designation"),
			"email"=>$this->input->post("email"),
			"phone" =>$this->input->post("mobile"),
			"password" => $this->institute_login_model->api_key_crypt($this->input->post("password"),'e'),
			"address" =>$this->input->post("address"),
			"city" => $this->input->post("city"),
			"state" => $this->input->post("state"),
			"country" => $this->input->post("country"),
			"category_id"=>$this->input->post("category"),
			//"institute_website"=>$this->input->post("institute_website"),
			"website"=>$this->input->post("institute_website"),
			"event_person_email"=>$this->input->post("event_person_email"),
			"event_person_mobile"=>$this->input->post("event_person_mobile"),
			"cctype"=>$this->input->post("cctype"),
			"overseascountry"=>$this->input->post("overseascountry"),
			"aboutinst" => $this->input->post("aboutinst"),
			"impnote" => $this->input->post("impnote"),
			"instoffr" => $this->input->post("instoffr"),
			"meritscolar" => $this->input->post("meritscolar")
		);
		$old_password = $this->input->post("old_password");
		
		if($data['password']!=$old_password){

				$msg = '<html><body><small>User ID : '.$email.'</small><br> <small>Password : '.$this->institute_login_model->api_key_crypt( $data["password"],"d").'</small></body></html>';
				
				$from = "$this->admin_email";
				$subject = "Login Details : KAB Education Fair";
				$to = $data['email'];
				$re = $this->login_model->sendMail($from,$to,$subject,$msg);
		}
		$this->db->where("institute_id",$id)->update("tbl_institutes",$data); 
			$this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">Details has updated successfully.</div>');
			//redirect("institute/settings/basic");
			$data=["Status"=>'Active',"Message"=>"Details has updated successfully."];
			echo json_encode($data);
	}
	public function update_display(){
		
		/*echo '<pre>';
		print_r($_POST);
		print_r($_FILES);
		exit();*/
		
		$id = $this->session->userdata('institute_id');
		$email = $this->input->post('email');
		
		$this->load->library('upload');

			if($_FILES['logo']){
						$config['upload_path'] = 'assets/institutes/'; # check path is correct
						$config['max_size'] = '0';
						$config['allowed_types'] = 'jpeg|jpg|png'; # add video extenstion on here
						$config['overwrite'] = FALSE;
						$config['remove_spaces'] = TRUE;
						$logo_name = random_string('numeric', 5);
						$config['file_name'] = $logo_name;

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
		
			if($_FILES['theme_logo']){
				$config1['upload_path'] = 'assets/institutes/'; # check path is correct
				$config1['max_size'] = '0';
				$config1['allowed_types'] = 'jpeg|jpg|png'; # add video extenstion on here
				$config1['overwrite'] = FALSE;
				$config1['remove_spaces'] = TRUE;
				$logo_name = random_string('numeric', 25);
				$config1['file_name'] = $logo_name;

				$this->upload->initialize($config1);

				if ($this->upload->do_upload('theme_logo')) # form input field attribute
				{
					$upload_data1 = $this->upload->data();
					$theme_logo = $config1['upload_path'].$upload_data1['file_name'];
					$file_ext = $upload_data['file_type'];
				}else{
					$theme_logo = $this->input->post('old_theme_logo');
				}
			}
			if($_FILES['theme']){
						$config2['upload_path'] = 'assets/institutes/'; # check path is correct
						$config2['max_size'] = '0';
						$config2['allowed_types'] = 'jpeg|jpg|png'; # add video extenstion on here
						$config2['overwrite'] = FALSE;
						$config2['remove_spaces'] = TRUE;
						$logo_name2 = random_string('numeric', 5);
						$config['file_name'] = $logo_name2;

						$this->upload->initialize($config2);

					if ($this->upload->do_upload('theme')) # form input field attribute
					{
					    $upload_data2 = $this->upload->data();
					    $image2 = $config2['upload_path'].$upload_data2['file_name'];
					    $file_ext = $upload_data2['file_type'];
					}else{
						$image2 = $this->input->post('old_theme');
					}
			}
			if($_FILES['deatiled_theme']){
				$config3['upload_path'] = 'assets/institutes/'; # check path is correct
				$config3['max_size'] = '0';
				$config3['allowed_types'] = 'jpeg|jpg|png'; # add video extenstion on here
				$config3['overwrite'] = FALSE;
				$config3['remove_spaces'] = TRUE;
				$logo_name2 = random_string('numeric', 5);
				$config3['file_name'] = $logo_name2;

				$this->upload->initialize($config3);

				if ($this->upload->do_upload('deatiled_theme')) # form input field attribute
				{
					$upload_data3 = $this->upload->data();
					$image3 = $config3['upload_path'].$upload_data3['file_name'];
					$file_ext = $upload_data3['file_type'];
				}else{
					$image3 = $this->input->post('old_detailed_theme');
				}
			}

			if($_FILES['video']){
				$config4['upload_path'] = 'assets/institutes/'; # check path is correct
				$config4['max_size'] = '0';
				// $config['allowed_types'] = 'mp4|mp3'; # add video extenstion on here
				$config4['allowed_types'] = '*'; # add video extenstion on here
				$config4['overwrite'] = FALSE;
				$config4['remove_spaces'] = TRUE;
				$video_name = random_string('numeric', 5);
				$config4['file_name'] = $video_name;

				$this->upload->initialize($config4);

				if ($this->upload->do_upload('video')) # form input field attribute
				{

					$upload_data4 = $this->upload->data();
					$video_name = $config4['upload_path'].$upload_data4['file_name'];

				}else{
					$video_name = $this->input->post('old_video');
				}
			}

		$data = array(
		    "ins_font_family" => $this->input->post("ins_font_family"),
		    "ins_font_size" => $this->input->post("ins_font_size"),
			"ins_font_color" => $this->input->post("ins_font_color"),
			"logo" => $image,
			"theme_picture" => $image2,
			"detailed_theme_picture" => $image3,
			"institute_video" => $video_name,
			"institute_video_url" => $this->input->post("videourl"),
			"header_color_code" => $this->input->post("favcolor"),
			"theme_logo" => $theme_logo,
//			"feedback_description" => $this->input->post("feedback_description"),
//			"feedback_question" => $this->input->post("feedback_question")
		);
		$old_password = $this->input->post("old_password");
		
		if($data['password']!=$old_password){

				$msg = '<html><body><small>User ID : '.$email.'</small><br> <small>Password : '.$this->institute_login_model->api_key_crypt( $data["password"],"d").'</small></body></html>';
				
				$from = "$this->admin_email";
				$subject = "Login Details : KAB Education Fair";
				$to = $data['email'];
				$re = $this->login_model->sendMail($from,$to,$subject,$msg);
		}
		$this->db->where("institute_id",$id)->update("tbl_institutes",$data); 
//		$this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">Details has updated successfully.</div>');
//		redirect("institute/settings/menu_header");
			$data=["Status"=>'Active',"Message"=>"Details has updated successfully."];
			echo json_encode($data);
	}
	function menu_header(){
		$data["admin"] = $this->db->where("institute_id",$this->session->userdata('institute_id'))->get("tbl_institutes")->row();
		$data['subview'] ="settings/menu_header";
		$this->load->view('institute/theme',$data);
	}
	function update_menu_header(){
		
		$two = $this->input->post("menus");
		$res = $this->db->where("institute_id",$this->session->userdata('institute_id'))->get("tbl_menu_header")->result();
		
		foreach($res as $r){
			$this->db->where("institute_id",$this->session->userdata('institute_id'))->where("menu_title",$r->menu_title)->update("tbl_menu_header",array("status"=>0));
			$one[] = $r->menu_title;
		}
		/* print_r($one);
		print_r($two);exit; */
        $final = array_diff($one,$two);	
        		
		foreach($final as $m){
			$this->db->where("institute_id",$this->session->userdata('institute_id'))->where("menu_title",$m)->update("tbl_menu_header",array("status"=>1));
		}      
		$this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">Details has updated successfully.</div>');
			$data=["Status"=>'Active',"Message"=>"Details has updated successfully."];
			echo json_encode($data);
	}

	function backgroundimage(){
		$data["backgroundimage"] = $this->db->where("institute_id",$this->session->userdata('institute_id'))->get("tbl_ins_bgimage")->result();
		$data["bgurl"] = $this->db->where("institute_id",$this->session->userdata('institute_id'))->get("tbl_ins_bgimage")->row()->url;
		$data['subview'] ="settings/backgroundimage";
		$this->load->view('institute/theme',$data);
	}

	public function add_backgroundimage(){
		if($_FILES['picture']['name'] != ""){
			    $config['upload_path'] = 'assets/exhibitors/custom/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = time().$_FILES['picture']['name'];				 
				
				$this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('picture')){
                    $uploadData = $this->upload->data();
                    $picture = 'assets/exhibitors/custom/'.$uploadData['file_name'];
                }else{
                    $picture = '';
                }
		}else{
			$picture = $this->input->post("bg_image");
		}
		        
		
		$data = array(
			"institute_id" => $this->session->userdata('institute_id'),
			"url" => $picture
		);
		$check = $this->db->where("institute_id",$this->session->userdata('institute_id'))->get("tbl_ins_bgimage")->num_rows();
		if($check >0){
		
			$this->db->where("institute_id",$this->session->userdata('institute_id'))->update("tbl_ins_bgimage",$data);
			$data1=["Status"=>'Active',"Message"=>"Successfully Updated."];
			echo json_encode($data1);
			exit();
		}else{
			$query = $this->db->insert("tbl_ins_bgimage",$data);
			$data1=["Status"=>'Active',"Message"=>"Successfully Selected."];
		    echo json_encode($data1);
		    exit();
		} 
			
	}

	public function update_backgroundimage(){
		
		$picture =  $this->input->post("url");  
		
		$data = array(
			"institute_id" => $this->session->userdata('institute_id'),
			"url" => $picture
		);
		$check = $this->db->where("institute_id",$this->session->userdata('institute_id'))->get("tbl_ins_bgimage")->num_rows();
		if($check >0){
		
			$this->db->where("institute_id",$this->session->userdata('institute_id'))->update("tbl_ins_bgimage",$data);
			$data1=["Status"=>'Active',"Message"=>"Successfully Updated."];
			echo json_encode($data1);
			exit();
		}else{
			$query = $this->db->insert("tbl_ins_bgimage",$data);
			$data1=["Status"=>'Active',"Message"=>"Successfully Selected."];
		    echo json_encode($data1);
		    exit();
		} 
			
	}
    function select_state(){
		$country_name= $_POST['country_id'];
		$selected_state= $_POST['selected_state'];
		$states = array();
		if($country_name!="null"){
			$country_id = $this->db->where("country_name",$country_name)->get("tbl_countries")->row()->country_id;
			$states = $this->db->where("country_id",$country_id)->order_by("state_name", "ASC")->get("tbl_states")->result();
		}
		else{
			$states = $this->db->order_by("state_name", "ASC")->get("tbl_states")->result();
		}
		if(!empty($states)){
			$msg='<option value="">Select</option>';
			foreach($states as $st){
			    $state_name=$st->state_name;
			    $selected = '';
			    if($selected_state!='' && $selected_state==$state_name){
			    	$selected = 'selected';
			    }
			    $msg.="<option ".$selected." value='$state_name'>$state_name</option>";
		    }
			echo $msg;
		}else{
			echo '<option value="">State not available</option>';
		}
	}
	function select_city(){
		$state_name= $_POST['state_id'];
		$selected_city= $_POST['selected_city'];
		$cities = array();
		if($state_name!="null"){
			$state_id = $this->db->where("state_name",$state_name)->get("tbl_states")->row()->state_id;
			$cities = $this->db->where("state_id",$state_id)->order_by("city_name", "ASC")->get("tbl_cities")->result();
		}
		else{
			$cities = $this->db->order_by("city_name", "ASC")->get("tbl_cities")->result();
		}
		
		if(!empty($cities)){
			$msg='<option value="">Select</option>';
			foreach($cities as $st){
			    $city_name=$st->city_name;
			    $selected = '';
			    if($selected_city!='' && $selected_city==$city_name){
			    	$selected = 'selected';
			    }
			    $msg.="<option ".$selected." value='$city_name'>$city_name</option>";
		    }
			echo $msg;
		}else{
			echo '<option value="">State not available</option>';
		}
	}
    function changepassword(){
		$data["admin"] = $this->db->where("institute_id",$this->session->userdata('institute_id'))->get("tbl_institutes")->row();
		$data['subview'] ="settings/changepassword";
		$this->load->view('institute/theme',$data);
	}
	function update_password(){
		$id = $this->session->userdata('institute_id');
		$email = $this->session->userdata('email');
		$data = array(
			"password" => $this->institute_login_model->api_key_crypt($this->input->post("password"),'e')
		);
		$old_password = $this->input->post("old_password");
		
		if($data['password']!=$old_password){

				$msg = '<html><body><small>User ID : '.$email.'</small><br> <small>Password : '.$this->institute_login_model->api_key_crypt( $data["password"],"d").'</small></body></html>';
				
				$from = "$this->admin_email";
				$subject = "Login Details : KAB Education Fair";
				$to = $data['email'];
				$re = $this->login_model->sendMail($from,$to,$subject,$msg);
		}
		$this->db->where("institute_id",$id)->update("tbl_institutes",$data);
		$this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">Details has updated successfully.</div>');
			//redirect("institute/settings/basic");
			$data=["Status"=>'Active',"Message"=>"Details has updated successfully."];
			echo json_encode($data);
	}
	// New
	public function select_country(){
		$selected_country= $_POST['selected_country'];
		$countries = $this->db->order_by("country_name", "ASC")->get("tbl_countries")->result();
		if(!empty($countries)){
			$msg='<option value="">Select</option>';
			foreach($countries as $st){
			    $country_name=$st->country_name;
			    $selected = '';
			    if($selected_country!='' && $selected_country==$country_name){
			    	$selected = 'selected';
			    }
			    $msg.="<option ".$selected." value='$country_name'>$country_name</option>";
		    }
			echo $msg;
		}else{
			echo '<option value="">Country not available</option>';
		}
	}
	function delete_video(){
		$this->db->where("institute_id",$this->session->userdata('institute_id'))->update("tbl_institutes",array("institute_video"=>""));
	}
}
