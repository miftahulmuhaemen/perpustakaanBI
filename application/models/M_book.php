<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_book extends CI_Model
{

  private $tb_buku = 'tb_buku';
  private $tb_publikasi = 'tb_publikasi';
  private $tb_pinjam = 'tb_pinjam';

  public function __construct()
  {
    parent::__construct();
    $this->data = array('table' => $this->tb_buku);
  }

  public function get($postData)
  {
    $rowperpage = $postData['page'];
    $start = ($postData['start'] * $rowperpage);
    $sort = $postData['sort'];
    $exist = "jumlah != 0";

    $searchValue = $postData['search'];
    $searchQuery = "";
    if ($searchValue != '') {
      $searchQuery = " (judul like '%" . $searchValue . "%' or pengarang like '%" . $searchValue . "%' or tahun like'%" . $searchValue . "%' or no_barcode like'%" . $searchValue . "%' or klasifikasi like'%" . $searchValue . "%' or tgl_input like'%" . $searchValue . "%' or tahun like'%" . $searchValue . "%' ) ";
    }

    $this->db->select('count(*) as allcount');
		$this->db->where('tb_pinjam.no_barcode = tb_buku.no_barcode');
		$this->db->where('status', 1);
    $this->db->from($this->tb_buku);
    $this->db->from($this->tb_pinjam);
    $records = $this->db->get()->result();
    $totalBorrowing = $records[0]->allcount;

    $this->db->select('count(*) as allcount');
		$this->db->where('status', 2);
    $records = $this->db->get($this->tb_pinjam)->result();
    $totalBorrowed = $records[0]->allcount;

    $this->db->select('count(*) as allcount');
		$this->db->where('status', 3);
    $records = $this->db->get($this->tb_pinjam)->result();
    $totalReturnedBorrow = $records[0]->allcount;

    $this->db->select('count(*) as allcount');
    $this->db->where($exist);
		$this->db->where('lokasi', $this->session->userdata('perpustakaan')->Id_perpustakaan);
    $records = $this->db->get($this->tb_buku)->result();
    $totalBookRecords = $records[0]->allcount;

    $this->db->select('count(*) as allcount');
    $records = $this->db->get($this->tb_publikasi)->result();
		$this->db->where('lokasi', $this->session->userdata('perpustakaan')->Id_perpustakaan);
    $totalPublicationRecords = $records[0]->allcount;

    $this->db->select('count(*) as allcount');
    if ($searchQuery != '')
      $this->db->where($searchQuery);
    $this->db->where($exist);
		$this->db->where('lokasi', $this->session->userdata('perpustakaan')->Id_perpustakaan);
    $records = $this->db->get($this->tb_buku)->result();
    $totalBookRecordwithFilter = $records[0]->allcount;

    $this->db->select('*');
    if ($searchQuery != '')
      $this->db->where($searchQuery);
    $this->db->where($exist);
		$this->db->where('lokasi', $this->session->userdata('perpustakaan')->Id_perpustakaan);
    $this->db->order_by($sort);
    $this->db->limit($rowperpage, $start);
    $records = $this->db->get($this->tb_buku)->result();

    $data = array();

    foreach ($records as $record) {
      $data[] = array(
        "no_barcode" => $record->no_barcode,
        "judul" => $record->judul,
        "pengarang" => $record->pengarang,
        "tahun" => $record->tahun,
        "klasifikasi" => $record->klasifikasi,
        "jumlah" => $record->jumlah,
        "lokasi" => $record->lokasi,
        "no_register" => $record->no_register,
        "tgl_input" => $record->tgl_input,
      );
    }

    $response = array(
      "totalBookRecords" => $totalBookRecords,
      "totalPublicationRecords" => $totalPublicationRecords,
      "totalBookRecordwithFilter" => $totalBookRecordwithFilter,
      "totalBorrowing" => $totalBorrowing,
      "totalBorrowed" => $totalBorrowed,
      "totalReturnedBorrow" => $totalReturnedBorrow,
      "data" => $data
    );

    return $response;
  }

  function export()
  {
    $this->db->select('*');
    $this->db->from($this->tb_buku);
    $records = $this->db->get()->result();
    foreach ($records as $record) {
      $books[] = array(
        "No. Barcode" => $record->no_barcode,
        "No. Register" => $record->no_register,
        "Tanggal Input" => $record->tgl_input,
        "Klasifikasi" => $record->klasifikasi,
        "Judul" => $record->judul,
        "Pengarang" => $record->pengarang,
        "Tahun" => $record->tahun,
        "Jumlah" => $record->jumlah,
        "Lokasi" => $record->lokasi,
      );
    }
    return $books;
  }

  function update($postData, $where)
  {
    $this->db->where($where);
    $this->db->update($this->tb_buku, $postData);
  }

  function insert($postData)
  {
    $this->db->insert($this->tb_buku, $postData);
  }

  function importCancel($postData)
  {
    $this->db->trans_start();
    foreach ($postData as $value)
      $result = $this->db->insert($this->tb_buku, $value);
    $this->db->trans_complete();
  }

  function importReplace($postData)
  {
    $this->db->trans_start();
    foreach ($postData as $value)
      $result = $this->db->replace($this->tb_buku, $value);
    $this->db->trans_complete();
  }

  function importKeep($postData)
  {
    $this->db->trans_start();
    foreach ($postData as $value){
      $sql = $this->db->insert_string($this->tb_buku, $value);
      $sql = str_replace("INSERT INTO","INSERT IGNORE INTO", $sql);
      $this->db->query($sql);
    }
    $this->db->trans_complete();
  }

  function delete($where)
  {
    $this->db->where($where);
    $result = $this->db->delete($this->tb_buku);
    return $result;
  }
}
