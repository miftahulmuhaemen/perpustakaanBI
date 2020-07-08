<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_peminjaman extends CI_Model{
	private $_peminjaman = array('table' 	=> 'tb_pinjam'
															,'field'	=> '*'
															,'rule'		=> FALSE);
  public function __construct()
  {
    parent::__construct();
  }

	function get($value='')
	{
		$buku							= $value;
		$buku['table']    = $this->_peminjaman['table'];
		$buku['field']   	= $this->_peminjaman['field'];
		$buku['join']			= array('tb_buku' => 'tb_buku.no_barcode=tb_pinjam.no_barcode');

		if (is_array($value)) {
			foreach ($value as $key => $val) {
				$buku[$key]	= $val;
			}
		}

		return $this->m_db->get($buku);
	}

	function countByStatus($value='')
	{
		$data['table']			= $this->_peminjaman['table'];
		$data['field']			= 'status, COUNT(status) as total';
		$data['join']				= array('tb_buku' => 'tb_buku.no_barcode=tb_pinjam.no_barcode');
		$data['group_by']		=	'status';

		foreach ($this->m_db->get($data) as $key ) {
			$data[$key->status]				= $key->total;
		}

		return $data;
	}

	function updateById($data='')
	{
		if (is_array($data)){
			foreach ($data as $key => $value) {
				$data			= array('status' 									=> decrypt_url($value));
				if (decrypt_url($value) == 2) {
					
					/** THIS */
					$data		= $data + array('admin_pinjam'		=> decrypt_url($this->session->userdata('id')),
																	'tgl_pinjam'			=> date("Y-m-d h:i:s"))	;
					$buku['field']		= 'tb_buku.no_barcode';
					$buku['where']		= array('tb_pinjam.Id_pinjam' => decrypt_url($key) );
					$buku 						= array('where' => array('no_barcode' => $this->m_peminjaman->get($buku)[0]->no_barcode),'data' => array('jumlah' => 0));
					$this->m_buku->updateById($buku);
				}

				$this->db->where('Id_pinjam', decrypt_url($key));
				$this->db->update($this->_peminjaman['table'], $data);
			}
		}
		return $data + array(decrypt_url($key) => $buku);
	}

	function batalPinjam($value='')
  {
		$where = array(
			'Id_pinjam' => decrypt_url($value)
		);

		$data = array('status' => 0 );

		$this->db->where($where);
		$this->db->update('tb_pinjam',$data);

  }
}
