<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My404 extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
  }

  function index()
  {
		$data['page']		= 'error/404';
		$data['title'] 	= 'Page Not Found';
		$this->m_pages->v_page($data);
  }

}
