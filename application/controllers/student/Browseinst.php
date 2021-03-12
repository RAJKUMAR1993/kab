<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');
class Browseinst extends CI_Controller{
	public function __construct()
	    {
	        parent::__construct();
	        if($this->session->userdata['login_type']!='student'){redirect('student/login');}
	    }

	public function index($num="")
	{		
		$data['inst'] = $this->db->query("SELECT * FROM tbl_institutes WHERE live_status='1' and is_deleted=0")->result();
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
		
		
		//echo $this->db->last_query();
		// echo '<pre>';
		// print_r($empRecord);
		//exit();
		
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
		$data['type'] = "browse";
        $data['subview'] ="browseinst/browseinst";		
		$this->load->view('student/theme',$data);
	}
	public function addtolist(){
	    //print_r($_REQUEST);die;
		$student_id = $this->input->post("student_id");
		$institute_id = $this->input->post("institute_id");
	
		$schk = $this->db->get_where("tbl_exhibitors_students_videos_list",["student_id"=>$student_id]);
		
		if($schk->num_rows() == 1){
			
			$row = $schk->row();
			$institute_ids = json_decode($row->institute_ids,true);
			
			if(in_array($institute_id,$institute_ids)){

				echo "exists";
				exit();

			}	
			array_push($institute_ids,$institute_id);
			
			$data = ["institute_ids"=>json_encode($institute_ids)];
			$d = $this->db->where("student_id",$student_id)->update("tbl_exhibitors_students_videos_list",$data);			
			
		}else{
			
			$data = ["student_id"=>$student_id,"institute_ids"=>json_encode([$institute_id])];
			$d = $this->db->insert("tbl_exhibitors_students_videos_list",$data);
			
		}
		
		if($d){
			
			echo "success";
			
		}else{
			
			echo "fail";
			
		}
		
	}
	public function dislike(){
		
		$student_id = $this->input->post("student_id");
		$institute_id = $this->input->post("institute_id");
	
		$schk = $this->db->get_where("tbl_exhibitors_students_videos_list",["student_id"=>$student_id]);
		
		if($schk->num_rows() == 1){
			
			$row = $schk->row();
			$institute_ids = json_decode($row->institute_ids,true);
			
			$d = array_search($institute_id,$institute_ids);
			unset($institute_ids[$d]);
			
			$institute_ids = array_values($institute_ids);
			$data = ["institute_ids"=>json_encode($institute_ids)];
			
			$d = $this->db->where("student_id",$student_id)->update("tbl_exhibitors_students_videos_list",$data);			
			
		}
		
		if($d){
			
			echo "success";
			
		}else{
			
			echo "fail";
			
		}
	}
	public function shorlisted_list($num=""){  
		
	    $student_id = $this->session->userdata("student_id");
		$query = $this->db->query("SELECT * FROM tbl_exhibitors_students_videos_list WHERE student_id='".$student_id."'")->row();
		
		$in_ids = json_decode($query->institute_ids,true);
		
		$institutes = '';
		if(count($in_ids)){
			$institutes = $this->db->query("SELECT * FROM `tbl_institutes` WHERE live_status=1 and is_deleted=0 AND `institute_id` IN (".implode(',',$in_ids).")")->result();
		}
		$data['inst'] = $institutes;
		$data['type'] = "";
		//echo '<pre>';print_r($data);exit;
		$data['subview'] ="browseinst/selected_list";		
		$this->load->view('student/theme',$data);
         
	}

	
	
}
