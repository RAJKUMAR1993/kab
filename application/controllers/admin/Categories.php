<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');

class Categories extends MY_Controller {


	public function index()
	{
		$data['categories'] = $this->db->where("is_deleted",'0')->order_by('sort', 'ASC')->get("tbl_categories")->result();
		$data['subview'] = "categories/categories";
		$this->load->view('admin/theme',$data);
	}
	
	public function sort_order(){
		
//		print_r($_POST);
//		exit();

		$module_id = $this->input->post("module_id");
		$sort = $this->input->post("sort");
		
		foreach($module_id as $k => $mid){
			
			$this->db->where("category_id",$mid)->update("tbl_categories",["sort"=>$sort[$k]]);
			
		}
		
	}
	
	public function add(){
		if($this->uri->segment(4)){
			$data['category'] = $this->category_model->get_category_id($this->uri->segment(4));
		}else{
			$data['category'] = "";
		}

		$data['subview'] = "categories/add_category";
		$this->load->view('admin/theme',$data);
	}	

	function random_username($user_name)
	{
	 	$new_name = $user_name.mt_rand(0,10000);
	 	return $new_name;//$this->check_user_name($new_name,$user_name);
	}




	public function save_category(){
		
		$scount = $this->db->where("is_deleted",'0')->get("tbl_categories")->num_rows();
		
		$data = array(
			"category_name" => $this->input->post("name"),
			"status" => $this->input->post("status"),
			"live_status" => $this->input->post("live_status"),
			"sort" => ($scount+1)
		);/*print_r($data);
		 exit;*/
		$this->load->library('upload');
		
		if($_FILES['image']){
				$config['upload_path'] = 'assets/categories/'; # check path is correct
				$config['max_size'] = 1024;
				$config['allowed_types'] = 'jpeg|jpg|png'; # add video extenstion on here
//						$config['overwrite'] = FALSE;
				$config['remove_spaces'] = TRUE;
				$image_name = random_string('numeric', 5);
				$config['file_name'] = $image_name;

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
		
		if($_FILES['logo_image']){
				$config['upload_path'] = 'assets/categories/'; # check path is correct
				$config['max_size'] = 1024;
				$config['allowed_types'] = 'jpeg|jpg|png'; # add video extenstion on here
//						$config['overwrite'] = FALSE;
				$config['remove_spaces'] = TRUE;
				$logoimage_name = random_string('numeric', 5);
				$config['file_name'] = $logoimage_name;

				$this->upload->initialize($config);

			if ($this->upload->do_upload('logo_image')) # form input field attribute
			{
				$upload_data1 = $this->upload->data();
				$logoimage_name = $config['upload_path'].$upload_data1['file_name'];
				$file_ext = $upload_data1['file_type'];
			}else{
				$logoimage_name = $this->input->post('old_logo_image');
			}
		} else {
			$logoimage_name = "";
		}

		$data["image"] = $image;
		$data["logo_image"] = $logoimage_name;
		
		if($this->uri->segment(4)){
			
			$this->db->where("category_id",$this->input->post("category_id"))->update("tbl_categories",$data); 
			$data1=["Status"=>'Active',"Message"=>"Successfully Updated."];
				echo json_encode($data1);
				exit();
			//redirect("admin/categories");
		}else{
			$check_category = $this->category_model->check_category($data['category_name']);
			
			if($check_category){
				
				$query = $this->db->insert("tbl_categories",$data);
			}else{
				$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">Category Name already exist.!</div>');
				$data1=["Status"=>'InActive',"Message"=>"Category Name already exist."];
			 	echo json_encode($data1);
			 	exit();
				//redirect("admin/categories/add");
			}
			}
			if($query){
				$data1=["Status"=>'Active',"Message"=>"Successfully Inserted."];
				echo json_encode($data1);
				exit();
				//redirect("admin/categories");
			}
			
		}


	public function delete_category(){
		if($this->uri->segment(4)){
			$id =$this->uri->segment(4);
			$query = $this->db->where("category_id",$id)->update("tbl_categories",array('is_deleted' =>'1'));
			if($query){ redirect("admin/students");}
		}
	}
	public function deleteCat(){
		$cat_id = $this->input->post("cat_id");
		$file_name = $this->input->post("file_name");
		if($cat_id){
			if($file_name!=''){
				unlink($file_name);
				$query = $this->db->where("category_id",$cat_id)->update("tbl_categories",array('image' =>''));
				echo 'success';
			}
			else{
				echo 'fail';
			}
		}
		else{
			echo 'fail';
		}
	}
	
	public function deleteCatlogo(){
		$cat_id = $this->input->post("cat_id");
		$file_name = $this->input->post("file_name");
		if($cat_id){
			if($file_name!=''){
				unlink($file_name);
				$query = $this->db->where("category_id",$cat_id)->update("tbl_categories",array('logo_image' =>''));
				echo 'success';
			}
			else{
				echo 'fail';
			}
		}
		else{
			echo 'fail';
		}
	}

}
