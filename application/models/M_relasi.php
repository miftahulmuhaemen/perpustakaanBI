<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_relasi extends CI_Model{

  public function __construct()
  {
    parent::__construct();
  }

	function getAgtPinjam()
	{
		$data['table']		= "tb_buku";
		$data['field']		= "tb_pinjam.Id_anggota,tb_buku.no_barcode";
		$data['rule']			= FALSE;
		$data['group_by']	= 'no_barcode';
		$data['where']		= array('tb_pinjam.status' => 1,'tb_pinjam.tgl_input >='=> date("Y-m-d h:i:s",strtotime(date("Y-m-d h:i:s") . "-1 day")));
		$data['join']			= array('tb_pinjam' =>'tb_pinjam.no_barcode=tb_buku.no_barcode');

		return $this->m_db->get($data);
	}

	function getBoookByUid($value)
	{
		$data['table']		= "tb_buku";
		$data['field']		= "tb_pinjam.Id_pinjam, tb_buku.no_barcode, judul, tb_pinjam.tgl_input";
		$data['rule']			= FALSE;
		$data['where']		= array('tb_pinjam.Id_anggota' => $value,
															'status' => 1,
															'tb_pinjam.tgl_input >='=> date("Y-m-d h:i:s",strtotime(date("Y-m-d h:i:s") . "-1 day ")));
		$data['join']			= array('tb_pinjam' =>'tb_pinjam.no_barcode=tb_buku.no_barcode');
		$data['order']		= array('tb_pinjam.tgl_input' => 'desc' );

		return $this->m_db->get($data);
	}

	function jumlah_koleksi($value='')
	{
		$buku['table']		= "tb_buku";
		$buku['field']		= "*";
		$buku['where']		= array('lokasi' => $this->session->userdata('perpustakaan')->Id_perpustakaan);
		$total	= $this->m_db->count_row($buku);

		if ($this->session->userdata('perpustakaan')->Id_perpustakaan==0) {
			$publikasi['table']		= "tb_publikasi";
			$publikasi['field']		= "*";

			$total	= $total + $this->m_db->count_row($publikasi);
		}


		return $total;
	}
}
