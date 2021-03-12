<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Callback extends CI_Controller {

	public function index() {
        try {
		    $client = new GuzzleHttp\Client(['base_uri' => 'https://zoom.us']);
		 
		    $response = $client->request('POST', '/oauth/token', [
		        "headers" => [
		            "Authorization" => "Basic ". base64_encode(CLIENT_ID.':'.CLIENT_SECRET)
		        ],
		        'form_params' => [
		            "grant_type" => "authorization_code",
		            "code" => $_GET['code'],
		            "redirect_uri" => REDIRECT_URI
		        ],
		    ]);
		 
		    $token = json_decode($response->getBody()->getContents(), true);
		 		 
		    //if($this->accesstoken->is_table_empty()) {
		        $this->accesstoken->update_access_token(json_encode($token));
		        $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">Access token updated successfully.</div>');
		    //}
		} catch(Exception $e) {
		    $this->session->set_flashdata('msg','<div class="alert alert-success" role="alert">'.$e->getMessage().'</div>');
		}
		redirect('admin/dashboard');
	}
}