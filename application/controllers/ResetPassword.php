<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ResetPassword extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_resetpassword');
    $this->load->library('email');
    $this->load->config('email');
  }

  function checkEmailAvailability()
  {
    $postData = array(
      'email'   => $this->input->post('email'),
    );

    $data = $this->M_resetpassword->checkEmailAvailability($postData);
    echo json_encode($data);
  }

  function resetPassword()
  {

    $memberID = $this->input->post('memberID');
    $password = $this->input->post('password');

    $postData = array(
      'password' => md5($password)
    );

    $where = array(
      'Id_anggota' => $memberID,
    );

    $response = $this->M_resetpassword->resetPassword($postData, $where);
    echo json_encode($response);
  }

  function insertToken()
  {
    $memberID = $this->input->post('memberID');
    $token = substr(sha1(rand()), 0, 30);
    $date = date('Y-m-d');

    $postData = array(
      'token' => $token,
      'memberID' => $memberID,
      'createdAt' => $date
    );

    $response = $this->M_resetpassword->insertToken($postData);
    if ($response) {
      echo json_encode($postData);
    }
  }

  function isTokenValid()
  {
    $get = $this->base64url_decode($this->input->post('token'));
    $token = substr($get, 0, 30);
    $response = $this->M_resetpassword->isTokenValid(array('token' => $token));
    echo json_encode($response);
  }

  function sendReset()
  {
    $from = $this->config->item('smtp_user');
    $email = $this->input->post('email');
    $token = $this->base64url_encode($this->input->post('token'));

    $url = site_url() . '/resetpassword/token//' . $token;
    $link = '<a href="' . $url . '">ini</a>';
    $message = '<strong>Hai, anda menerima surel ini karena ada permintaan untuk memperbaharui  
                 kata sandi anda.</strong><br><strong>Silakan klik tautan, </strong> ' . $link;

    $this->email->from($from);
    $this->email->to($email);
    $this->email->subject('Atur Ulang Kata Sandi');
    $this->email->message($message);
    $this->email->send(false);
    return json_encode($this->email->print_debugger(array('headers')));
  }

  public function base64url_encode($data)
  {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
  }

  public function base64url_decode($data)
  {
    return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
  }
}
