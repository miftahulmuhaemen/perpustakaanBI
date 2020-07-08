<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_resetpassword extends CI_Model
{

    private $tb_anggota = 'tb_anggota';
    private $tb_resetpassword = 'tb_resetpassword';

    public function checkEmailAvailability($email)
    {
        $this->db->select('CASE WHEN COUNT(email) > 0 then true else false end as `Value`, Id_anggota as ID');
        $this->db->where($email);
        $response = $this->db->get($this->tb_anggota)->result();
        return $response;
    }

    public function resetPassword($postData, $where)
    {
        $this->db->where($where);
        $response = $this->db->update($this->tb_anggota, $postData);
        return $response;
    }

    public function insertToken($value)
    {
        $response = $this->db->insert($this->tb_resetpassword, $value);
        return $response;
    }

    public function isTokenValid($token)
    {
        $this->db->select('*');
        $this->db->where($token);
        $response = $this->db->get($this->tb_resetpassword)->result();
        return $response;
    }
}
