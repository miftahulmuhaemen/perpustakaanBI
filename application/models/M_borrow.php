<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_borrow extends CI_Model
{
    private $tb_buku = 'tb_buku';
    private $tb_anggota = 'tb_anggota';
    private $tb_pinjam = 'tb_pinjam';

    public function __construct()
    {
        parent::__construct();
    }

    public function get($status)
    {
        $this->db->select('Id_pinjam as ID, judul as Judul, nama as Nama');
        $this->db->where('tb_pinjam.no_barcode = tb_buku.no_barcode');
        $this->db->where('tb_pinjam.Id_anggota = tb_anggota.Id_anggota');
        $this->db->where('tb_pinjam.status', $status);
        $this->db->from($this->tb_buku);
        $this->db->from($this->tb_pinjam);
        $this->db->from($this->tb_anggota);
        $this->db->order_by('ID');
        $response = $this->db->get()->result();
        return $response;
    }

    public function update($postData, $where)
    {
        $this->db->where($where);
        $this->db->update($this->tb_pinjam, $postData);
    }
}
