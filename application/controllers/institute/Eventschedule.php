<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'libraries/sendinblue/Mailin.php');

class Eventschedule extends CI_Controller {
	public function __construct()
	    {
            parent::__construct();
            $this->load->model("institute_model");
	        //$this->load->library('excel');
	        if($this->session->userdata['login_type']!='institute'){redirect('institute/login');}
	    }

	public function index()
	{
        $institute_id =$this->session->userdata['institute_id'];
        $data['webinars'] = $this->db->order_by("id","desc")->get_where("tbl_student_auditorium_presentations",["institute_id"=>$institute_id])->result();
        $data['subview'] = "eventschedule/presentations";
		$this->load->view('institute/theme',$data);
    }


    public function professor_meeting()
	{
        $institute_id =$this->session->userdata['institute_id'];
		$data['experts'] = $this->db->order_by('id', 'DESC')->get_where("tbl_councellors",["institute_id"=>$institute_id,"is_deleted"=>0])->row();
        $data['professor'] = $this->institute_model->professor_list(); 
        $data['students'] = $this->institute_model->students_list();
        $data['title'] = $this->institute_model->professor_title_by_id($data['experts']->id);
        $data['auditorium'] = $this->institute_model->institute_auditorium_by_id($data['experts']->id); 
        $data['meetings'] = $this->institute_model->professor_meeting();
        $data['meeting'] = $this->db->query("SELECT a.exp_std_date,a.exp_std_time,a.expert_id, d.meeting_link,d.play_url,d.converted_text,d.session_id
												FROM tbl_counsellor_student_schedule a 
												INNER JOIN tbl_zoom_meetings  d ON a.zoom_link = d.meeting_link
												  GROUP BY a.exp_std_id")->result();
       //echo $this->db->last_query();die;
        $data['subview'] = "eventschedule/professormeetings";
		$this->load->view('institute/theme',$data);
    }
}

?>