<?php
defined('BASEPATH') or exit('No direct script access allowed');


class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('m_user');
		$this->load->model('m_buku');
		$url =  "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
		$url = str_replace(base_url(), "", $url);

		if (!$this->session->has_userdata('login') || !$this->session->has_userdata('id')) {
			redirect('login');
		} else if ($this->session->userdata('login') == 0 && (strcmp(substr($url, 0, 9), "cari-buku") == 0 || strcmp(substr($url, 0, 11), "user/logout") == 0)) {

		} else if ($this->session->userdata('login') == 0 && (strcmp(substr($url, 0, 9), "cari-buku") != 0 || strcmp(substr($url, 0, 11), "user/logout") != 0)) {
			redirect(base_url('cari-buku'));
		}
	}

	function index()
	{
		if ($this->session->userdata('level') < 5) {
			redirect(base_url('admin/dashboard'));
		} else if ($this->session->userdata('level') == 5) {
			$data['page']		= 'user/home';
			$data['title'] 	= 'Cari Buku';
		} else {
			$data['page']		= 'user/home';
			$data['title'] 	= 'Cari Buku';
		}

		$keyword = $this->input->get('keyword');

		if (isset($keyword)) {
			$limit 		= 10;
			$halaman	= 1;
			if ($this->input->get('limit') > 0)
				$limit 	= $this->input->get('limit');
			if ($this->input->get('p') > 0)
				$halaman = $this->input->get('p');

			$data['keyword'] 		= $keyword;
			$data['rule']   		= array('limit' => $limit, 'page' => $halaman);
			$data['buku']   		= $this->m_buku->get($data);
			$data['limit']			= $limit;
			$data['pinjam']			= array();
			foreach ($data['buku'] as $key) {
				if ($this->m_buku->getPinjamByIdBuku($key->no_barcode) != null) {
					$data['pinjam']		= $data['pinjam'] + array($key->no_barcode => $this->m_buku->getPinjamByIdBuku($key->no_barcode)[0]);
				}
			}
			$data['total_data']	= $this->m_buku->jumlah_data($data);
		}

		$this->m_pages->v_page($data);
	}

	function profile()
	{
		$data['page']   = 'profile';
		$data['title']	= 'profile';

		$user['where'] = array('Id' => decrypt_url($this->session->userdata['id']));
		$data['user']		= $this->m_user->get($user);

		$this->m_pages->v_page($data);
	}

	function cetak()
	{
		$user['where'] = array('Id' => $this->session->userdata('id'));
		$data['user']		= $this->m_user->get($user);

		$this->load->view('pages/user/cetakKartu');
	}

	function edit()
	{
		$data['page']   = 'user/editUser';
		$data['title']	= 'Atur Akun';
		$data['user']		= $this->m_user->getById(decrypt_url($this->session->userdata('id')));

		$this->m_pages->v_page($data);
	}

	function riwayat()
	{
		if ($this->session->has_userdata('level')) {
			$data['page']				= 'user/riwayat';                  ///lokasi view
			$data['title'] 			= 'riwayat';                       ///judul
			$data['peminjaman'] = $this->m_buku->riwayat_pinjam();

			$this->m_pages->v_page($data);
		} else {
			redirect('login');
		}
	}

	function updateUser($value = '')
	{
		if (isset($value)) {

			$data['data'] = $this->input->post();
			$data['Id']		= $value;
			$this->m_user->update($data);

			redirect(base_url('user/edit'));
		} else {
			redirect(base_url('editUser'));
		}
	}

	function updateAgt()
	{
		$ID = array('Id' => $this->input->post('ID'));
		$status = array('status' => $this->input->post('status'));
		$response = $this->m_user->updateAgtB($ID, $status);
		echo json_encode($response);
	}

	function gantiPW()
	{
	}

	function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
}
