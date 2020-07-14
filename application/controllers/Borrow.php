<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Borrow extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_borrow');
        if ($this->session->userdata('level') >= 5) {
            redirect(base_url());
        }
    }

    function get()
    {
        $status = $this->input->post('status');
        $data = $this->m_borrow->get($status);
        echo json_encode($data);
    }


    function update()
    {
        $status = $this->input->post('status');
        $admin = $this->input->post('admin');
        $now = date('Y-m-d H:i:s');

        if($status == "2"){
            $postData = array(
                'status' => $status,
                'admin_pinjam' => $admin,
                'tgl_pinjam' => $now
            );
        } else {
            $postData = array(
                'status' => $status,
                'admin_kembali' => $admin,
                'tgl_kembali' => $now
            );
        }

        $where = array(
            'Id_pinjam' => $this->input->post('ID')
        );

        $this->m_borrow->update($postData, $where);
    }
}
