<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_visitorArchieve extends CI_Model
{

    private $tb_perpustakaan = 'tb_perpustakaan';
    private $tb_pengunjung = 'tb_pengunjung';
    private $tb_anggota = 'tb_anggota';

    public function __construct()
    {
        parent::__construct();
        $this->data = array('table' => $this->tb_perpustakaan);
    }

    public function get()
    {
        $this->db->select('count(*) as allcount');
        $records = $this->db->get($this->tb_pengunjung)->result();
        $totalVisitor = $records[0]->allcount;

        $this->db->select('count(*) as allcount');
        $this->db->where('MONTH(`tgl_input`) = MONTH(CURRENT_DATE)');
        $records = $this->db->get($this->tb_pengunjung)->result();
        $totalVisitorCurrentMonth = $records[0]->allcount;

        $this->db->select('DATE_FORMAT(tgl_input,"%c") as numMonth, DATE_FORMAT(tgl_input,"%M") as month, count(*) as count');
        $this->db->where('year(tgl_input) = year(CURRENT_DATE)');
        $this->db->group_by('month');
        $this->db->order_by('numMonth');
        $records = $this->db->get($this->tb_pengunjung)->result();
        $chartData[] = array('month', 'count');
        foreach ($records as $record) {
            $chartData[] = array(
                $record->month,
                (int) $record->count,
            );
        }

        $this->db->select('Id_perpustakaan, nama');
        $records = $this->db->get($this->tb_perpustakaan)->result();
        foreach ($records as $record) {
            $library[] = array(
                "Id_perpustakaan" => $record->Id_perpustakaan,
                "nama" => $record->nama,
            );
        }

        $this->db->select('tb_perpustakaan.nama as name, tb_perpustakaan.Id_perpustakaan as id, count(*) as count');
        $this->db->where('tb_pengunjung.Id_perpustakaan = tb_perpustakaan.Id_perpustakaan');
        $this->db->where('tb_pengunjung.Id_anggota = tb_anggota.Id_anggota');
        $this->db->from($this->tb_pengunjung);
        $this->db->from($this->tb_perpustakaan);
        $this->db->from($this->tb_anggota);
        $this->db->group_by('name');
        $summary = $this->db->get()->result();

        $response = array(
            "totalVisitor" => (int) $totalVisitor,
            "totalVisitorCurrentMonth" => (int) $totalVisitorCurrentMonth,
            "chartData" => $chartData,
            "library" => $library,
            "summary" => $summary
        );

        return $response;
    }

    function getVisitors($libraryID)
    {

        $this->db->select('tb_anggota.nama as nama, tb_pengunjung.email as email, tb_pengunjung.kota as kota, tb_pengunjung.tgl_input as tgl_input');
        $this->db->where('tb_pengunjung.Id_anggota = tb_anggota.Id_anggota');
        $this->db->where($libraryID);
        $this->db->from($this->tb_pengunjung);
        $this->db->from($this->tb_anggota);
        $this->db->group_by('nama');
        $records = $this->db->get()->result();

        foreach ($records as $record) {
            $visitors[] = array(
                "Nama" => $record->nama,
                "Email" => $record->email,
                "Kota" => $record->kota,
                "Tanggal Input" => $record->tgl_input
            );
        }
        return $visitors;
    }

    function exportXLSX($postData)
    {
        $this->db->select('*');
        $this->db->where($postData);
        $this->db->from($this->tb_pengunjung);
        $records = $this->db->get()->result();
        $visitors[] = array();
        foreach ($records as $record) {
            $visitors[] = array(
                "Nama" => $record->nama,
                "Email" => $record->email,
                "Kota" => $record->kota,
                "Tanggal Input" => $record->tgl_input,
            );
        }
        return $visitors;
    }
}
