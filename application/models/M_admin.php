<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model{
  private $_data = array('table' 				=> 'tb_admin'
												,'field'				=> 'Id_perpustakaan, level'
												,'rule'					=> FALSE);

  public function __construct()
  {
    parent::__construct();
  }

	function getAdmin($value='')
	{
		$this->_data = $this->_data + $value;

		return $this->m_db->get($this->_data);
	}


	/*
	|--------------------------------------------------------------------------
	| Page Data Loader
	|--------------------------------------------------------------------------
	*/
	function getBookRentOrder($IdAgt='')
	{
		$uid	= $this->m_relasi->getAgtPinjam();
		$data = array();
		$data['rpinjam'] 			= array();
		$data['upinjam']			= $IdAgt;
		$data['data_buku']		= $this->m_peminjaman->countByStatus();

		foreach ($uid as $value) {
			$data['rpinjam'] = $data['rpinjam'] + array($value->Id_anggota => array('user' => $this->m_user->getByIdAgt($value->Id_anggota)));
		}

		if ($IdAgt!='') {
			if (isset($data['rpinjam'][$IdAgt])) {
				$data['rpinjam'][$IdAgt] = $data['rpinjam'][$IdAgt] + array('buku' => $this->m_relasi->getBoookByUid($IdAgt));
			}
		}

		return $data;
	}

	function getDashboardData($value='')
	{
		$data = array();
		$user['where'] 				= array('status' 	=> 0);
		if ($this->session->userdata('level')>1) {
			$perpus['where']			= array('tipe' 		=> 2,
																		'Id_perpustakaan' => $this->session->userdata('perpustakaan')->Id_perpustakaan);

			$bico['where']				= array('Id_perpustakaan' => $this->session->userdata('perpustakaan')->Id_perpustakaan);
		}else {
			$perpus['where']			= array('tipe' 		=> 2);
		}

		$data['jumlah_buku']	= $this->m_relasi->jumlah_koleksi();
		$data['bicorner']			= $this->m_perpustakaan->count();
		$data['anggota_baru']	= $this->m_user->count($user);
		if ($this->input->get('bicornerid')!="")
			$data['visit_month']	= $this->m_pengunjung->count(decrypt_url($this->input->get('bicornerid')));
		else
			$data['visit_month']	= $this->m_pengunjung->count();

		$data['data_buku']		= $this->m_peminjaman->countByStatus();
		$data['dailyVisit']		= $this->m_pengunjung->dailyVisitByMonth();

		return $data;
	}


	function manageUser()
	{
		$limit 		= 10;
		$halaman	= 1;
		$keyword	= '';
		$field 		= $params = array();
		if ($this->input->get('limit') > 0)
			$limit 	= $this->input->get('limit');
		if ($this->input->get('p') > 0)
			$halaman= $this->input->get('p');

		if ($this->input->get('search_field')!="") {
			foreach ($this->input->get('search_field') as $key => $value) {
				$field[] = $value;
				$keyword = $keyword."&search_field[]=".$value;
			}
			$params['search_field'] = $field;
		}

		$params['keyword'] 		= $this->input->get('keyword');
		$params['rule']				= array('limit' => $limit,'page' => $halaman);
		$data = array('keyword'		=> $this->input->get('keyword').$keyword,
									'field'			=> $field,
									'User' 			=> $this->m_user->get($params),
	 								'totalUser'	=> $this->m_user->count($params));

		return $data;
	}

  function getAnggota()
	{
		$limit 		= 10;
		$halaman	= 1;
		$keyword	= '';
		$field 		= $params = array();
		if ($this->input->get('limit') > 0)
			$limit 	= $this->input->get('limit');
		if ($this->input->get('p') > 0)
			$halaman= $this->input->get('p');

		if ($this->input->get('search_field')!="") {
			foreach ($this->input->get('search_field') as $key => $value) {
				$field[] = $value;
				$keyword = $keyword."&search_field[]=".$value;
			}
			$params['search_field'] = $field;
		}

		$params['keyword'] 		= $this->input->get('keyword');
		$params['rule']				= array('limit' => $limit,'page' => $halaman);
		$data = array('keyword'		=> $this->input->get('keyword').$keyword,
									'field'			=> $field,
									'User' 			=> $this->m_user->getAgtBaru($params),
	 								'totalUser'	=> $this->m_user->count($params));

		return $data;
	}
}
