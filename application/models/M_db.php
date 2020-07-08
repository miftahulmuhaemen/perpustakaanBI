<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_db extends CI_Model{
	private $_field		= "*";
	private $_join		= "";
	public function __construct()
  {
    parent::__construct();
		$this->load->database();
  }

	public function get($data)
	{
		$this->db->reset_query();

		if (isset($data['where']))
      foreach ($data['where'] as $var => $key)
        $this->db->where($var,$key);
    if (isset($data['keyword'])){
			foreach ($data['search_field'] as $key => $value) {
				if ($key==0) {
	        $this->db->like($value,$data['keyword']);
				}else {
	        $this->db->or_like($value,$data['keyword']);
				}
			}
    }
		if (isset($data['jtype'])) {
				$this->_join		= $data['jtype'];
		}
		if (isset($data['join'])) {
      foreach ($data['join'] as $key => $val)
				$this->db->join($key,$val);
		}
		if (isset($data['order'])) {
      foreach ($data['order'] as $key => $val)
				$this->db->order_by($key, $val);
		}
		if (isset($data['group_by'])) {
			$this->db->group_by($data['group_by']);
		}
		if (isset($data['field'])) {
			$this->_field = $data['field'];
		}
		if (isset($data['select_max'])){
			$this->db->select_max($data['select_max']);
		}
		if (isset($data['rule'])&&$data['rule']!=FALSE){
			$this->db->limit($data['rule']['limit'], ($data['rule']['page']-1)*$data['rule']['limit']);
		}

		$this->db->select($this->_field);
		$this->db->from($data['table']);

		$data = $this->db->get()->result();
		$this->db->reset_query();

		return $data;
	}

	public function count($data='')
	{
		$this->db->reset_query();

		if (isset($data['where']))
      foreach ($data['where'] as $var => $key)
        $this->db->where($var,$key);
		if (isset($data['keyword'])){
			foreach ($data['search_field'] as $key => $value) {
				if ($key==0) {
					$this->db->like($value,$data['keyword']);
				}else {
					$this->db->or_like($value,$data['keyword']);
				}
			}
		}
		if (isset($data['jtype'])) {
				$this->_join		= $data['jtype'];
		}
		if (isset($data['join'])) {
      foreach ($data['join'] as $key => $val)
				$this->db->join($key,$val,$this->_join);
		}
		if (isset($data['order'])) {
      foreach ($data['order'] as $key => $val)
				$this->db->order_by($key, $val);
		}
		if (isset($data['group_by'])) {
			$this->db->group_by($data['group_by']);
		}
		if (isset($data['field'])) {
			$this->_field = $data['field'];
		}
		if (isset($data['select_max'])){
			$this->db->select_max($data['select_max']);
		}

		$this->db->select($this->_field);
		$this->db->from($data['table']);

		$data = $this->db->count_all_results();
		$this->db->reset_query();

		return $data;
	}

	public function count_row($data)
	{
		if (isset($data['where']))
      foreach ($data['where'] as $var)
        $this->db->where(array_search ($var, $data['where']),$var);                              ///array search mengambil setiap key dan value
    if (isset($data['keyword'])){
        $this->db->like('judul',$data['keyword']);
        $this->db->or_like('pengarang',$data['keyword']);
        $this->db->or_like('klasifikasi',$data['keyword']);
        $this->db->or_like('tahun',$data['keyword']);
        $this->db->or_like('no_barcode',$data['keyword']);
        $this->db->or_like('no_register',$data['keyword']);
    }

		$this->db->from($data['table']);
		return $this->db->count_all_results(); // Produces an integer, like 17
	}
}
