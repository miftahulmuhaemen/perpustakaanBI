<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_publication extends CI_Model
{

  private $tb_buku = 'tb_buku';
  private $tb_publikasi = 'tb_publikasi';
  private $tb_pinjam = 'tb_pinjam';

  public function __construct()
  {
    parent::__construct();
    $this->data = array('table' => $this->tb_publikasi);
  }

  public function get($postData)
  {
    $rowperpage = $postData['page'];
    $start = ($postData['start'] * $rowperpage);
    $sort = $postData['sort'];

    $searchValue = $postData['search'];
    $searchQuery = "";
    if ($searchValue != '') {
      $searchQuery = " (edisi like '%" . $searchValue . "%' or judul like '%" . $searchValue . "%' or tgl_terbit like'%" . $searchValue . "%' or tgl_periksa like'%" . $searchValue . "%' or status like'%" . $searchValue . "%' ) ";
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
    $records = $this->db->get($this->tb_publikasi)->result();
    $totalPublicationRecords = $records[0]->allcount;

    $this->db->select('count(*) as allcount');
    $records = $this->db->get($this->tb_buku)->result();
    $totalBookRecords = $records[0]->allcount;

    $this->db->select('count(*) as allcount');
    if ($searchQuery != '')
      $this->db->where($searchQuery);
    $records = $this->db->get($this->tb_publikasi)->result();
    $totalPublicationRecordwithFilter = $records[0]->allcount;

    $this->db->select('*');
    if ($searchQuery != '')
      $this->db->where($searchQuery);
    $this->db->order_by($sort);
    $this->db->limit($rowperpage, $start);
    $records = $this->db->get($this->tb_publikasi)->result();

    $data = array();

    foreach ($records as $record) {
      $data[] = array(
        "id_publikasi" => $record->id_publikasi,
        "edisi" => $record->edisi,
        "judul" => $record->judul,
        "tgl_terbit" => $record->tgl_terbit,
        "tgl_periksa" => $record->tgl_periksa,
        "status" => $record->status
      );
    }

    $response = array(
      "totalBookRecords" => $totalBookRecords,
      "totalPublicationRecords" => $totalPublicationRecords,
      "totalPublicationRecordwithFilter" => $totalPublicationRecordwithFilter,
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
    $this->db->from($this->tb_publikasi);
    $records = $this->db->get()->result();
    foreach ($records as $record) {
      $publications[] = array(
        "ID" => $record->id_publikasi,
        "Edisi" => $record->edisi,
        "Judul" => $record->judul,
        "Tanggal Terbit" => $record->tgl_terbit,
        "Tanggal Periksa" => $record->tgl_periksa,
        "Status" => $record->status,
      );
    }
    return $publications;
  }

  function update($postData, $where)
  {
    $this->db->where($where);
    $this->db->update($this->tb_publikasi, $postData);
  }

  function insert($postData)
  {
    $this->db->insert($this->tb_publikasi, $postData);
  }

  function importCancel($postData)
  {
    $this->db->trans_start();
    foreach ($postData as $value)
      $result = $this->db->insert($this->tb_publikasi, $value);
    $this->db->trans_complete();
  }

  function importReplace($postData)
  {
    $this->db->trans_start();
    foreach ($postData as $value)
      $result = $this->db->replace($this->tb_publikasi, $value);
    $this->db->trans_complete();
  }

  function importKeep($postData)
  {
    $this->db->trans_start();
    foreach ($postData as $value) {
      $sql = $this->db->insert_string($this->tb_publikasi, $value);
      $sql = str_replace("INSERT INTO", "INSERT IGNORE INTO", $sql);
      $this->db->query($sql);
    }
    $this->db->trans_complete();
  }

  function delete($where)
  {
    $this->db->where($where);
    $result = $this->db->delete($this->tb_publikasi);
  }
}
