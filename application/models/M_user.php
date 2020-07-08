<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{
	private $_data = array(
		'table' 	=> 'tb_anggota', 'field'	=> 'Id,Id_anggota,nama,kota,tgl_lahir,alamat,no_telepon,email,tgl_daftar,tgl_expired,instansi,status', 'search_field'	=> array(
			'Id_anggota', 'nama', 'tgl_lahir', 'no_telepon', 'email', 'instansi'
		)
	);

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin');
	}

	function login($data)
	{
		$data['where']	=  array('Id_anggota' => $data['Id_anggota'], 'password' => $data['password']);
		$check = $this->m_user->get($data);

		foreach ($check as $row) {
			$data						= null;
			$data['where']	= array('Id_user' => $row->Id);
			$cek_admin			= $this->m_admin->getAdmin($data);

			$data_session = array(
				'id'          => encrypt_url($row->Id),
				'id_anggota'  => encrypt_url($row->Id_anggota),
				'nama'        => $row->nama,
				'level'       => 5,
				'instansi'    => $row->instansi,
				'expired'     => $row->tgl_expired,
				'login'       => 1,
				'status'			=> $row->status
			);
			if (sizeof($cek_admin) == 1) {
				$data_session 					= $data_session + array('perpustakaan' => $this->m_perpustakaan->getById($cek_admin[0]->Id_perpustakaan)[0]);
				$data_session['level']	= $cek_admin[0]->level;
			}

			$this->session->set_userdata($data_session);
		}
	}

	public function get($data = '')
	{
		$user = $this->_data;
		foreach ($data as $key => $value) {
			$user[$key]	= $value;
		}

		return $this->m_db->get($user);
	}

	public function getAgtBaru($data = '')
	{
		$coba		= array('where' => array('status' => "0")) + $this->_data;
		foreach ($data as $key => $value) {
			$coba[$key]	= $value;
		}
		return $this->m_db->get($coba);
	}

	public function count($data = '')
	{
		$user = $this->_data;
		foreach ($data as $key => $value) {
			$user[$key]	= $value;
		}

		return $this->m_db->count($user);
	}

	public function getById($data)
	{
		$data		= array('where' => array('Id' => $data)) + $this->_data;

		return $this->m_db->get($data);
	}

	public function getByIdAgt($data)
	{
		$data		= array('where' => array('Id_anggota' => $data)) + $this->_data;

		return $this->m_db->get($data);
	}

	public function add($value = '')
	{
		$this->db->select_max('Id');
		$query = $this->db->get('tb_anggota')->result();

		$user = array('Id' => $query[0]->Id + 1, 'Id_anggota' => str_pad(decrypt_url($value['bico']), 2, '0', STR_PAD_LEFT) . str_pad(date("my"), 4, '0', STR_PAD_LEFT) . str_pad($query[0]->Id + 1, 6, '0', STR_PAD_LEFT));
		$user = $user + $value['data'];

		$user['password'] = md5($user['password']);
		$user = $user + array('tgl_daftar' => date("Y-m-d"));

		$this->db->insert('tb_anggota', $user);

		return $user;
	}

	public function update($value = '')
	{
		$data = $value['data'];
		$this->db->where('id', $value['Id']);

		$this->db->update('tb_anggota', $data);
	}

	public function updateAgtB($ID, $status)
	{
		$this->db->where($ID);
		$response = $this->db->update('tb_anggota',$status);
		return $response;
	}

	public function jumlah_data($value = '')
	{
		array_push($this->_data, $value);

		return $this->m_db->count_row($this->_data);
	}

	public function delete($value)
	{
		$this->db->where($where);
		$result = $this->db->delete($this->_table);
		return $result;
	}

	function is_email_avaible($email)
	{
		$this->db->where('email', $email);
		$query = $this->db->get('tb_anggota');

		if (sizeof($query->result()) > 0) {
			return true;
		} else {
			return false;
		}
	}
}
