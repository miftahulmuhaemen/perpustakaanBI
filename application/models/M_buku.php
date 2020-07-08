<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_buku extends CI_Model
{
  private $_data 		= array('field' => 'tb_buku.no_barcode,klasifikasi,judul,pengarang,tahun,no_register,jumlah,lokasi,tb_buku.tgl_input',
														'search_field'	=> array('judul'
																										,'pengarang'
																										,'klasifikasi'
																										,'tahun'
																										,'no_barcode'
																										,'no_register'),
 														'table'	=> 'tb_buku');
  public function __construct()
  {
    parent::__construct();
    $this->data = array('table' => 'tb_buku');
  }

  function get($data = "")
  {
		$buku							= $this->_data;
		$buku['rule']			= array('limit' => 10,'page' => 1);
		foreach ($data as $key => $value) {
			$buku[$key]			= $value;
		}
		$buku['order']		= array('no_barcode' => 'asc');

    return $this->m_db->get($buku);
  }

	function jumlah_data($data = "")
	{
		if ($data!="") {
			$buku	= $this->_data + $data;
		}else {
			$buku = $this->_data;
		}

		return $this->m_db->count_row($buku);
	}

	function riwayat_pinjam($value='')
	{
		$data								= $this->_data;
		$data['field']			= 'Id_pinjam, tb_buku.no_barcode,klasifikasi,judul,pengarang,tahun,no_register,jumlah,lokasi,tgl_pinjam,tgl_kembali,status,tb_pinjam.tgl_input';
		$data['join']				= array('tb_pinjam'		=>	'tb_buku.no_barcode = tb_pinjam.no_barcode');
		$data['where']			= array('Id_anggota'	=>	decrypt_url($this->session->userdata('id_anggota')),
																'status >'		=> 0);
		$data['order']			= array('tb_pinjam.tgl_input'	=> 'DESC');

		return $this->m_db->get($data);
	}

	function getPinjamByIdBuku($value='')
	{
		$this->db->select('*');
		$this->db->from('tb_pinjam');
		$this->db->where('no_barcode',$value);
		$this->db->order_by("tgl_input",'desc');

		return $this->db->get()->result();
	}

	function pinjamId($value='')
	{
		$this->db->select('*');
		$this->db->from('tb_buku');
		$this->db->join('tb_pinjam','tb_buku.no_barcode = tb_pinjam.no_barcode');
		$this->db->where('no_barcode',$this->session->userdata['id_anggota']);

		return $this->db->get()->result();
	}

	function updateById($val='')
	{
		if (is_array($val)) {
			$this->db->where($val['where']);
			$this->db->update($this->_data['table'],$val['data']);
		}
	}
}
