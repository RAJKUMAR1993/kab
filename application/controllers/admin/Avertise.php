<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');

class Avertise extends CI_Controller {
	public function __construct()
	    {
	        parent::__construct();
	        if($this->session->userdata['login_type']!='admin'){redirect('admin/login');}
	    }

	public function addadvertise()
	{
		if($this->uri->segment(4)){
			$data['advertise'] = $this->advertise_model->get_advertise_byid($this->uri->segment(4));
		}else{
			$data['advertise'] = "";
		}
		$data['subview'] ="advertise/add_advertise";
		$this->load->view('admin/theme',$data);
	}

	public function index()
	{
		$data['advertise'] = $this->advertise_model->get_advertise();
		$data['subview'] ="advertise/advertise";
		$this->load->view('admin/theme',$data);
	}
	
	public function saveavertise(){

$title = $this->input->post("title");
			if($_FILES['image']){
						$config['upload_path'] = 'assets/images/picsadd/'; # check path is correct
						$config['max_size'] = '0';
						$config['allowed_types'] = 'jpeg|jpg|png'; # add video extenstion on here
						$config['max_width']  = '1870';
                        $config['max_height']  = '300';
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
			} else {
				$image = "";
			}

			if($this->input->post("navigation_link")){
				$nlink = $this->input->post("navigation_link");
			} else {
				$nlink = "";
			}

			if($this->input->post("iframe_url")){
				$iurl = $this->input->post("iframe_url");
			} else {
				$iurl = "";
			}


		$data = array(
			'title' => $this->input->post("title"),
			'type' => $this->input->post("type"),
			'image' => $image,
			'navigation_link' => $nlink,
			'iframe_url' => $iurl,
			'target' => $this->input->post("target"),
			'status' => $this->input->post("status")
		);
		
		if($this->input->post("id")){
			$this->db->where("id",$this->input->post("id"))->update("tbl_advertise",$data); 
		
			$data1=["Status"=>'Active',"Message"=>"Details has updated successfully."];
				echo json_encode($data1);
		}else{
			$this->db->insert("tbl_advertise",$data);
			
			$data1=["Status"=>'Active',"Message"=>"Successfully Inserted."];
				echo json_encode($data1);
		}	
	}
  
	public function delete_advertise(){
		if($this->uri->segment(4)){
			$id =$this->uri->segment(4);
			$query = $this->db->where("id",$id)->update("tbl_advertise",array('is_deleted' =>'1'));
			if($query){ redirect("admin/advertise/advertise");}
		}
	}
	
}
