<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{

  public function __construct()
  {
    parent::__construct();

		if($this->session->userdata('level')!=null){
				$login = $this->session->userdata('level');
		    if ($login>=5){
			      redirect(base_url());
				}

				$this->load->model('m_user');
				$this->load->model('m_relasi');
				$this->load->model('m_admin');
				$this->load->model('m_perpustakaan');
				$this->load->model('m_peminjaman');
				$this->load->model('m_pengunjung');
				$this->load->model('m_buku');
		}else {
				redirect(base_url('login'));
		}
  }

	function dashboard($value='')
	{
		$data['page'] 				= 'admin/home';
		$data['title'] 				= 'Dashboard';

		$data									= $data + $this->m_admin->getDashboardData();
		if ($this->session->userdata('level')==1) {
			$data['perpus']				= $this->m_perpustakaan->get();
		}

		$this->m_pages->v_page($data);
	}

  function anggota(){
    $data['page'] 	= 'admin/anggota';
		$data['title']	= 'Data Anggota Baru';
    $data['data']			= $this->m_admin->getAnggota();

    $this->m_pages->v_page($data);
  }

  function kelola_user($value = '')
  {
		$data['page'] 		= 'admin/kelola_user';
		$data['title']		= 'kelola user';
		$data['data']			= $this->m_admin->manageUser();

		$this->m_pages->v_page($data);
  }

	function kelola_buku()
	{
		$data['page'] 	= 'buku/kelolaBukuSuperadmin';
		// $data['page'] 	= 'admin/kelola_buku';
		$data['title']	= 'Kelola Buku';

		// $data						= $data + $this->m_admin->getBookRentOrder();

		// if ($this->session->userdata('level')==1) {
		// 	if (strcmp($this->input->get('tab'),'pinjam')==0) {
		// 		if ($this->input->get('cancelid')!=null) {
		// 			$this->m_peminjaman->batalPinjam($this->input->get('cancelid'));
		// 		}else if ($this->input->get('saved')) {
		// 			$data						= $data + $this->m_admin->getBookRentOrder(decrypt_url($this->input->get('saved')));
		// 		}else{
		// 			$data						= $data + $this->m_admin->getBookRentOrder(decrypt_url($this->input->get('id')));
		// 		}
		// 	}
		// }

		$this->m_pages->v_page($data);
	}

	function kelola_corner()
	{
		$data['page'] 	= 'admin/kelola_corner';
		$data['title']	= 'Kelola BI Corner';

		$this->load->library('ciqrcode');

		if ($this->session->userdata('level')>1) {
			$perpus['where']			= array('Id_perpustakaan' 		=> $this->session->userdata('perpustakaan')->Id_perpustakaan);
			$data['bicorner']			= $this->m_perpustakaan->get($perpus)[0];

			$url = base_url('hadir/'.encrypt_url($this->session->userdata('perpustakaan')->Id_perpustakaan));
		}else {
			$data['perpus']				= $this->m_perpustakaan->get();
			if (decrypt_url($this->input->get('bicornerid'))!='') {
				$perpus['where']			= array('Id_perpustakaan' 		=> decrypt_url($this->input->get('bicornerid')));
				$data['bicorner']			= $this->m_perpustakaan->get($perpus)[0];
				$url = base_url('hadir/'.$this->input->get('bicornerid'));
			}else{
				$perpus['where']			= array('Id_perpustakaan' 		=> $this->session->userdata('perpustakaan')->Id_perpustakaan);
				$data['bicorner']			= $this->m_perpustakaan->get($perpus)[0];
				$url = base_url('hadir/'.encrypt_url($this->session->userdata('perpustakaan')->Id_perpustakaan));
			}
		}

		$params['data'] = $url;
		$params['level'] = 'H';
		$params['size'] = 10;
		$params['savename'] = FCPATH.'assets/img/qrcode.png';
		$this->ciqrcode->generate($params);


		$this->m_pages->v_page($data);
	}

	function activityArchieve()
	{
		$data['page'] 	= 'admin/activityArchieve';
		$data['title']	= 'Arsip Aktifitas';

		$this->m_pages->v_page($data);
	}

	function visitorArchieve()
	{
		$data['page'] 	= 'admin/visitorArchieve';
		$data['title']	= 'Arsip Pengunjung';

		$this->m_pages->v_page($data);
	}

	function generate_url($value='')
	{
		echo encrypt_url($value);
	}

	function simpanPinjam($value='')
	{

		print_r($this->m_peminjaman->updateById($this->input->post()));
		if ($this->m_b) {
			// cek buku jika Sudah Dipinjam
		}
		redirect(base_url('admin/peminjaman?tab=pinjam&saved='.$this->input->get('id')));
	}

	function tambah_perpus($value='')
	{
		$this->m_perpustakaan->insert($this->input->post());

		redirect(base_url('kelola-corner'));
	}

	function simpan_perpus($value='')
	{
		$data['field']						= $this->input->post();
		$data['Id_perpustakaan']	= $this->input->get('id');
		$this->m_perpustakaan->updateById($data);

		redirect(base_url('kelola-corner?bicornerid='.$this->input->get('id')));
	}

	function hapus_perpus()
	{
		$this->m_perpustakaan->disable($this->input->get('id'));

		redirect(base_url('kelola-corner'));
	}

	function hapus_perpus_permanen()
	{
		$this->m_perpustakaan->delete($this->input->get('id'));

		redirect(base_url('kelola-corner'));
	}

	function batal_hapus_perpus()
	{
		$this->m_perpustakaan->cancel_delete($this->input->get('id'));

		redirect(base_url('kelola-corner'));
	}


	function editUser()
	{
		$data['page'] 	= 'admin/editUser';
		$data['user']		= $this->m_user->getById(decrypt_url($this->input->get('uid')));

		$this->m_pages->v_page($data);
	}

	function updateUser($value='')
	{
		if (decrypt_url($this->input->get('id'))>0) {
			$data['data'] = $this->input->post();
			$data['Id']		= decrypt_url($this->input->get('id'))>0;
			$this->m_user->update($data);
			redirect(base_url('edit/user?uid='.$this->input->get('id')));
		}else {
			redirect(base_url('kelola-user'));
		}
	}

	function test($data='')
	{
	}
}
