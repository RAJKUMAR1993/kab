<?php

if (!defined('BASEPATH')) {    exit('No direct script access allowed');}

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if(!$this->session->userdata['logged_in'] || $this->session->userdata['login_type']!='admin')
            {
                redirect('');
            } 
    }
}
