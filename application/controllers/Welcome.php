<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();

		$url =  "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
		$url = str_replace(base_url(), "", $url);
		$page = substr($url, 0, strpos($url, "/"));

		if ($this->session->userdata('login') == 1 && (strcmp('hadir', $page) == 0 || strcmp('regis', $page) == 0)) {
			$url =  "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
			$url = str_replace(base_url($page), "", $url);

			if (strcmp('hadir', $page) == 0) {
				redirect(base_url("regis" . $url));
			}
		} else if ($this->session->userdata('login') == 1) {
			redirect(base_url());
		} else {
		}

		$this->load->model('m_user');
		$this->load->model('m_perpustakaan');
	}

	public function login($value = '')
	{
		if (isset($value) && $value != "") $data['bicorner'] = $this->m_perpustakaan->getById(decrypt_url($value));
		$msg = "";
		$data['Id_anggota'] 	= $this->input->post('ID');
		$data['password'] 		= md5($this->input->post('password'));

		if (isset($data['Id_anggota'])) {
			$check = $this->m_user->login($data);
			if ($this->session->userdata('id') == null) {
				$msg = "Id Anggota atau Password Salah";
			} else {
				if (isset($value) && $value != null) {
					$cekin['Id_anggota']				= $this->session->userdata('id');
					$cekin['Id_perpustakaan'] 	= decrypt_url($value);
				}
				redirect(base_url());
			}
		}

		$data['msg']		= $msg;
		$data['page']		= 'login';
		$data['title'] 	= 'Selamat Datang';

		$this->m_pages->v_page($data);
	}

	public function resetPassword()
	{
		$data['page']		= 'resetpassword';
		$data['title'] 	= 'Atur Ulang Kata Sandi';
		$data['token'] = $this->uri->segment(3);

		$this->m_pages->v_page($data);
	}

	public function register($value = '')
	{
		$data['page']		= 'register';
		$data['title'] 	= 'Daftar';
		$data['bico']		= $value;

		$this->m_pages->v_page($data);
	}

	function hadir($value)
	{
		if (decrypt_url($value) != null) {
			$data['page']			= 'kunjungan';
			$data['title'] 			= 'Regis Pengunjung';
			$data['bicoid']			= $value;
			$data['bicorner'] 	= $this->m_perpustakaan->getById(decrypt_url($value));
			if (sizeof($data['bicorner']) < 1) {
				$data['bicorner'] 	= $this->m_perpustakaan->getById(0);
			}
			$this->m_pages->v_page($data);
		} else {
			redirect(base_url());
		}
	}

	public function simpanUser($value = '')
	{
		$data['bico']		= $value;
		$data['data']		= $this->input->post();
		$data['where'] 	=	$this->m_user->add($data);

		$cek = $this->m_user->get($data);
		if (sizeof($cek) == 1) {
			redirect(base_url('pendaftaran-sukses?id=' . $cek[0]->Id_anggota));
		}
	}

	function sukses()
	{
		$data['page']		= 'user/daftarSukses';
		$data['title'] 	= 'Pendaftaran Sukses';

		$this->m_pages->v_page($data);
	}

	function saveRegis($value = '')
	{
		if ($this->session->userdata('login') == 1) {
			$data = array(
				'Id_anggota' 				=> decrypt_url($this->session->userdata('id_anggota')),
				'Id_perpustakaan' 	=> decrypt_url($value)
			);
		} else {
			foreach ($this->input->post() as $key => $value) {
				if (strcmp($key, 'Id_perpustakaan') == 0) {
					$value = decrypt_url($value);
				}
				$data[$key]		= $value;
			}
		}

		echo json_encode($this->db->insert('tb_pengunjung', $data));
		
	}

	function email_check()
	{
		if ($this->m_user->is_email_avaible($this->input->post('email'))) {
			echo 0;
		} else {
			echo 1;
		}
	}
}
