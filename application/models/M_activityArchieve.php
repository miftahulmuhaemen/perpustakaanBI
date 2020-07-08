<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_activityArchieve extends CI_Model
{

  private $tb_perpustakaan = 'tb_perpustakaan';
  private $tb_penilaian = 'tb_penilaian';
  private $tb_gambar = 'tb_gambar';

  public function __construct()
  {
    parent::__construct();
    $this->data = array('table' => $this->tb_perpustakaan);
  }

  public function get()
  {
    $this->db->select('count(*) as allcount');
    $records = $this->db->get($this->tb_penilaian)->result();
    $totalActivity = $records[0]->allcount;

    $this->db->select('count(*) as allcount');
    $this->db->where('MONTH(`tgl_kegiatan`)=MONTH(CURRENT_DATE)');
    $records = $this->db->get($this->tb_penilaian)->result();
    $totalActivityCurrentMonth = $records[0]->allcount;

    $this->db->select('DATE_FORMAT(tgl_kegiatan,"%M") as month, count(*) as count');
    $this->db->where('year(tgl_kegiatan) = year(CURRENT_DATE)');
    $this->db->group_by('month');
    $records = $this->db->get($this->tb_penilaian)->result();
    $chartData[] = array('month', 'count');
    foreach ($records as $record) {
      $chartData[] = array(
        $record->month,
        (int) $record->count,
      );
    }

    $this->db->select('tb_perpustakaan.nama as name, tb_perpustakaan.Id_perpustakaan as id, count(*) as count');
    $this->db->where('tb_penilaian.id_bi_corner = tb_perpustakaan.Id_perpustakaan');
    $this->db->from($this->tb_penilaian);
    $this->db->from($this->tb_perpustakaan);
    $this->db->group_by('tb_perpustakaan.nama');
    $summary = $this->db->get()->result();

    $this->db->select('Id_perpustakaan, nama');
    $records = $this->db->get($this->tb_perpustakaan)->result();
    foreach ($records as $record) {
      $library[] = array(
        "Id_perpustakaan" => $record->Id_perpustakaan,
        "nama" => $record->nama,
      );
    }

    $response = array(
      "totalActivity" => (int) $totalActivity,
      "totalActivityCurrentMonth" => (int) $totalActivityCurrentMonth,
      "library" => $library,
      "chartData" => $chartData,
      "summary" => $summary
    );

    return $response;
  }

  function deleteActivity($reportID, $imagesID)
  {
    $this->transStart();

    $this->db->where($reportID);
    $this->db->delete($this->tb_penilaian);

    $this->db->where($imagesID);
    $this->db->delete($this->tb_gambar);

    $this->transComplete();
    return $this->transStatus();
  }

  function getActivities($cornerId)
  {
    $this->db->select('id_penilaian, nama, tempat, deskripsi, tgl_kegiatan, jumlah_peserta, tgl_input, GROUP_CONCAT(path SEPARATOR ", ") as paths');
    $this->db->where('id_penilaian = id_kegiatan');
    $this->db->where($cornerId);
    $this->db->from($this->tb_penilaian);
    $this->db->from($this->tb_gambar);
    $this->db->group_by('id_kegiatan');
    $records = $this->db->get()->result();
    foreach ($records as $record) {
      $activities[] = array(
        "ID Penilaian" => $record->id_penilaian,
        "Nama" => $record->nama,
        "Tempat" => $record->tempat,
        "Deskripsi" => $record->deskripsi,
        "Jumlah Peserta" => $record->jumlah_peserta,
        "Tanggal Kegiatan" => $record->tgl_kegiatan,
        "Tanggal Input" => $record->tgl_input,
        "Paths" => $record->paths
      );
    }
    return $activities;
  }

  function insert($postData)
  {
      $this->db->insert($this->tb_penilaian, $postData);
      return $this->db->insert_id();
  }

  function insertFiles($postData)
  {
    foreach ($postData as $value)
      $response = $this->db->insert($this->tb_gambar, $value);
    return $response;
  }

  function exportXLSX($postData)
  {
    $this->db->select('*');
    $this->db->where($postData);
    $this->db->from($this->tb_penilaian);
    $records = $this->db->get()->result();
    foreach ($records as $record) {
      $reports[] = array(
        "Nama" => $record->nama,
        "Tempat" => $record->tempat,
        "Deskripsi" => $record->deskripsi,
        "Jumlah Peserta" => $record->jumlah_peserta,
        "Tanggal Kegiatan" => $record->tgl_kegiatan,
        "Tanggal Input" => $record->tgl_input,
      );
    }
    return $reports;
  }

  function transStart()
  {
    $this->db->trans_start();
  }

  function transComplete()
  {
    $this->db->trans_complete();
  }

  function transStatus()
  {
    return $this->db->trans_status();
  }
}
