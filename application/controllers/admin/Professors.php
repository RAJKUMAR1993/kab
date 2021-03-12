<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');

class Professors extends CI_Controller {
	public function __construct()
	    {
	        parent::__construct();
	        if($this->session->userdata['login_type']!='admin'){redirect('admin');}
			
			$this->admin_email = $this->login_model->get_option("admin_email_id")->email;
	    }

	public function index()
	{
		$institute_id =$this->session->userdata['admin_id'];
		$type =$this->session->userdata['login_type'];
		$data['professors'] = $this->db->order_by("pro_id ","desc")->where("is_deleted",0)->get("tbl_professors")->result();
// 		$query = $this->db
// 		->select('pro_quali')
// 		->group_by('pro_quali')
// 		->order_by('pro_id', 'desc')
// 		->get('tbl_professors')->result();
//   echo "<pre>"; print_r($query);die;
		$data['subview'] = "professors/professors";
		$this->load->view('admin/theme',$data);
	}
	public function active_status(){
		$pro_status = $this->input->get("pro_status");
		if($pro_status){
			$this->db->where("pro_status",$pro_status);
		}
		$data['professors'] = $this->db->order_by("pro_id ","desc")->get_where("tbl_professors",["pro_status"=>"Active","is_deleted"=>0])->result();
		$data['subview'] = "professors/professors";
		$this->load->view('admin/theme',$data);
	}
	public function inactive_status(){
		$pro_status = $this->input->get("pro_status");
		if($pro_status){
			$this->db->where("pro_status",$pro_status);
		}
		$data['professors'] = $this->db->order_by("pro_id ","desc")->get_where("tbl_professors",["pro_status"=>"inactive","is_deleted"=>0])->result();
		$data['subview'] = "professors/professors";
		$this->load->view('admin/theme',$data);
	}
	public function qualification(){
		$pro_quali = $this->input->get("pro_quali");
		if($pro_quali){
			$this->db->where("pro_quali",$pro_quali);
		}
		$data['professors'] = $this->db->order_by("pro_id ","desc")->get_where("tbl_professors",["pro_quali"=>$pro_quali,"pro_status"=>"Active","is_deleted"=>0])->result();
	   // echo  $this->db->last_query();die;
		$data['subview'] = "professors/professors";
	    $this->load->view('admin/theme',$data);
	}
	public function add(){
		if($this->uri->segment(4)){
			$data['professors'] = $this->db->where("pro_id",$this->uri->segment(4))->get("tbl_professors")->row();
		}else{
			$data['professors'] = "";
		}
		$data['subview'] = "professors/add_pro";
		$this->load->view('admin/theme',$data);
	}
	

	public function save_pro(){

		$email = $this->input->post("email");
		$data = array(
			"pro_name" => $this->input->post("name"),
			"pro_designation" => $this->input->post("designation"),
			"pro_quali" => ucfirst($this->input->post("qualification")),
			"pro_shortdesc" => $this->input->post("shortdesc"),
			"pro_longdesc" => $this->input->post("longdesc"),
			"pro_expertise" => $this->input->post("expertise"),
            "pro_gender" => $this->input->post("gender"),
			"mobile1" => $this->input->post("phone"),
			"pro_status" => $this->input->post("status"),
			"pro_email" => $email,
			"created"=>date("Y-m-d H:i:s"),
			"institute_id"	=>$this->session->userdata['admin_id'],
			"login_type" => $this->session->userdata['login_type']
		);

		if($this->uri->segment(4)){
			$data['password'] = $this->institute_login_model->api_key_crypt( $this->input->post("password"),'e');
			$old_password = $this->input->post("old_password");

			if($data['password']!=$old_password){

				$msg = '<html><body>Your password has been updated, please login with below details. <br><small>User ID : '.$data["pro_email"].'</small><br> <small>Password : '.$this->institute_login_model->api_key_crypt($data["password"],"d").'</small></body></html>';
				$from = "$this->admin_email";
				$subject = "Login Details : KAB Education Fair";
				$to = $data['pro_email'];
				$re = $this->login_model->sendMail($from,$to,$subject,$msg);
			}
			$this->db->where("pro_id",$this->input->post("pro_id"))->update("tbl_professors",$data); 
			
			$data1=["Status"=>'Active',"Message"=>"Successfully Updated."];
				echo json_encode($data1);
				exit();
		}else{
			$data['password'] = $this->institute_login_model->api_key_crypt(random_string('alnum', 8),"e");
			$check = $this->db->where("pro_email",$email)->get("tbl_professors")->num_rows();
			if($check >0){
				$check_email = false;
			}else{
				$check_email = TRUE;
			}
			
			if($check_email){
				$query = $this->db->insert("tbl_professors",$data);
			}else{
				$this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert">Professor email already exist.!</div>');
				
				$data1=["Status"=>'InActive',"Message"=>"Professor email already exist."];
			 	echo json_encode($data1);
			 	exit();
			}
			}
			if($query){ 
				$msg = '<html><body><small>User ID : '.$data["pro_email"].'</small><br> <small>Password : '.$this->institute_login_model->api_key_crypt( $data["password"],"d").'</small></body></html>';
				$from = "$this->admin_email";
				$subject = "Login Details : KAB Education Fair";
				$to = $data['pro_email'];
				$re = $this->login_model->sendMail($from,$to,$subject,$msg);

				
				$data1=["Status"=>'Active',"Message"=>"Successfully Inserted."];
				echo json_encode($data1);
				exit();
			}
			
		}	

	public function delete_pro(){
		if($this->uri->segment(4)){
			$id =$this->uri->segment(4);
			$query = $this->db->where("pro_id",$id)->delete("tbl_professors");
			if($query){ redirect("admin/professors");}
		}
	}
	public function meetings()
	{
		if($this->uri->segment(4)){
			
			$filter = "WHERE tbl_professor_meeting.session_pro_id='".$this->uri->segment(4)."'";
			
		}else{
			
			$filter = "";
			
		}
		
		$data['meetings'] = $this->db->query("SELECT * FROM tbl_professor_meeting LEFT JOIN tbl_students ON tbl_professor_meeting.session_student_id = tbl_students.student_id $filter  ORDER BY session_date DESC ")->result();
		$data['subview'] = "professors/pro_meetings";
		$this->load->view('admin/theme',$data);
	}


}
