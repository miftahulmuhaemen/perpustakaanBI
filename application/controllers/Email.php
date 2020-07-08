<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
		$this->load->library('email');

		$this->email->from('admin@e-jukung.com', 'E-Jukung');
		$this->email->to('ejukung@gmail.com');

		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');

		$this->email->send();
  }

}
