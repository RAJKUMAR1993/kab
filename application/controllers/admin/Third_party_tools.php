<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Third_party_tools extends MY_Controller {

	public function index(){
		
		$data["tools"] = $this->db->get_where("tbl_options",["option_type"=>"tool"])->result();
		$data['subview'] = "third_party_tools/third_party_tools";
		$this->load->view('admin/theme',$data);
		
	}
	
	public function editTool($val){
		
		$data["t"] = $this->db->get_where("tbl_options",["option_type"=>"tool","option_short_name"=>$val])->row();
		$data['subview'] = "third_party_tools/edittool";
		$this->load->view('admin/theme',$data);
		
	}

	public function updatetool(){
		
		$inputs = $this->input->post("inputs");
		$id = $this->input->post("option_short_name");
		
		$data = [
			"input_names" => $inputs,
			"input_labels" => $this->input->post("labels")
		];
		
		foreach($inputs as $input){
			
			$data[$input] = $this->input->post($input);
			
		}
		
		$d = $this->db->where(["option_short_name"=>$id])->update("tbl_options",["option_value"=>json_encode($data)]);
		if($d){
			echo json_encode(["Status"=>"Active","Message"=>'Successfully Updated']);
		}else{
			echo json_encode(["Status"=>"Inactive","Message"=>'Error Occured']);
		}
		
	}
	
}
