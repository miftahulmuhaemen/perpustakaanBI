<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_perpustakaan extends CI_Model{
	private $_data 					= array('table' 	=> 'tb_perpustakaan',
																	'field' 	=> 'Id_perpustakaan, nama, alamat, email,tipe');
  public function __construct()
  {
    parent::__construct();
  }

	function getById($value='')
	{
		$data						= $this->_data;
		$data['where'] 	= array('Id_perpustakaan'=>$value);

		return $this->m_db->get($data);
	}

	function get($value = array())
	{
		$data	= $this->_data;
		foreach ($value as $key => $val) {
			$data[$key] = $val;
		}

		return $this->m_db->get($data);
	}

	function count($value = array())
	{
		$data	= $this->_data;
		foreach ($value as $key => $value) {
			$data[$key] = $value;
		}

		return $this->m_db->count($data);
	}

	function insert($value)
	{
		$this->db->insert('tb_perpustakaan', $value);
	}
	function updateById($data='')
	{
		print_r($data);

		if (decrypt_url($data['Id_perpustakaan'])!='') {
			$this->db->where('Id_perpustakaan', decrypt_url($data['Id_perpustakaan']));
			$this->db->update($this->_data['table'], $data['field']);
		}
	}

	function disable($value='')
	{

		$field = array('tipe' => 0);

		$this->db->where('Id_perpustakaan', decrypt_url($value));
		$this->db->update($this->_data['table'], $field);
	}

	function delete($value='')
	{
    $this->db->where('Id_perpustakaan',decrypt_url($value));
    $this->db->delete($this->_data['table']);
		
	}

	function cancel_disable($value='')
	{
		$field = array('tipe' => 2);

		$this->db->where('Id_perpustakaan', decrypt_url($value));
		$this->db->update($this->_data['table'], $field);
	}

}
