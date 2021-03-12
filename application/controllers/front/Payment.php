<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Payment extends CI_Controller {

	
	public function paymentRequest(){
		
		$this->load->view('front/payment/ccavenue/ccavRequestHandler');
		
	}
	
	public function paymentResponse(){
		
		$this->load->view('front/payment/ccavenue/ccavResponseHandler');
		
	}
	
	public function pay(){
		
		$this->load->view('front/payment/ccavenue/index');
		
	}

}
