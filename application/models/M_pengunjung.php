<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pengunjung extends CI_Model{
	private $_rule	=	array('limit' => 10,
												'page' 	=> 1,
												'field' => '*');
	private $_data	= array('table' => 'tb_pengunjung',
												'field'	=> '*');

  public function __construct()
  {
    parent::__construct();
  }

	function count($value='')
	{
		$data							= $this->_data;
		if ($value!="") {
			$data['where']		= array('Id_perpustakaan	 ='		=> $value,
																'MONTH(tgl_input)  =' 	=> date("m"),
		  													'YEAR(tgl_input)	 =' 	=> date("Y"));
		}else {
			$data['where']		= array('Id_perpustakaan	 ='		=> $this->session->userdata('perpustakaan')->Id_perpustakaan,
																'MONTH(tgl_input)  =' 	=> date("m"),
		  													'YEAR(tgl_input)	 =' 	=> date("Y"));
		}

		return $this->m_db->count($data);
	}

	function dailyVisitByMonth()
	{
		$data								= $this->_data;
		$data['table']			= $data['table'];
		$data['field']			= 'DAY(tgl_input) as tanggal, COUNT(tgl_input) as total';

		$data['where']			= array('DAY(tgl_input) >=' 	=> 1,
	 															'MONTH(tgl_input) =' 	=> date("m"),
																'YEAR(tgl_input) ='		=> date("Y"));
		$data['group_by']	= 'DAY(tgl_input)';

		$visit	= array();

		foreach ($this->m_db->get($data) as $key => $value) {
			$visit = $visit + array($value->tanggal => $value->total);
		}

		return $visit;
	}
}
