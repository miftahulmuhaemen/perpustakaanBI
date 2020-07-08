<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buku extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_user');
		$this->load->model('m_buku');
		$this->load->model('m_peminjaman');

		if (!$this->session->has_userdata('level')) {
			redirect('login');
		}
	}

	function index()
	{
		$buku['field']			= 'tb_buku.no_barcode,klasifikasi,judul,pengarang,tahun,no_register,tb_buku.tgl_input,tb_perpustakaan.nama';
		$buku['where'] 			= array('tb_buku.no_barcode' => decrypt_url($this->input->get('id')));
		$buku['join']				= array('tb_perpustakaan' => 'tb_perpustakaan.Id_perpustakaan = tb_buku.lokasi' );

		$data['page'] 			= 'buku/dataBuku';
		$data['buku']				= $this->m_buku->get($buku);
		$data['pinjam']			= $this->m_buku->getPinjamByIdBuku();
		$data['data']				= $this->input->get('id');

		$this->m_pages->v_page($data);
	}

	function pinjam()
	{
		$buku['where'] 			= array('tb_buku.no_barcode' => decrypt_url($this->input->get('id')));

		$data['page'] 		= 'buku/pinjamBuku';
		$data['buku']			= $this->m_buku->get($buku);

		$this->m_pages->v_page($data);
	}

	function Batal($value='')
	{
		$id = decrypt_url($value);

		$where = array(
			'Id_pinjam' => $id
		);

		$data = array('status' => 0, );

		$this->db->where($where);
		$this->db->update('tb_pinjam',$data);

		redirect(base_url('riwayat'));
	}

	function tambah()
	{
		$pinjam['where']	= array('tb_buku.no_barcode' => decrypt_url($this->input->get('id')),
															'status   >' => 0);
		$pinjam						= $this->m_peminjaman->get($pinjam);

		$buku = array(
						'no_barcode'			=>decrypt_url($this->input->get('id')),
						'Id_anggota'			=>decrypt_url($this->session->id_anggota)
				);
		$this->db->insert('tb_pinjam',$buku);

		$data['page'] 		= 'buku/pinjamSukses';
		$this->m_pages->v_page($data);
	}

	function getBooks()
	{
			$data = array();
			$records = $this->m_buku->get(null)->result();
			print('lol');
			foreach($records as $record){
					$data[] = array(
							"judul"=>$record->judul,
							"pengarang"=>$record->pengarang,
							"tahun"=>$record->tahun,
							"klasifikasi"=>$record->klasifikasi,
							"lokasi"=>$record->lokasi
					);
			}
			$response = array(
				 "aaData" => $data
			);
			echo json_encode($data);
	}

}
