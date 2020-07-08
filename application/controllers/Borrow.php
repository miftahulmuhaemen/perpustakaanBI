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
        $postData = array(
            'status' => $this->input->post('status'),
        );

        $where = array(
            'Id_pinjam' => $this->input->post('ID')
        );

        $this->m_borrow->update($postData, $where);
    }
}
