<?php
defined('BASEPATH') or exit('No direct script access allowed');

class VisitorArchieve extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_visitorArchieve');
        if ($this->session->userdata('level') >= 5) {
            redirect(base_url());
        }
    }

    function get()
    {
        $response = $this->m_visitorArchieve->get();
        echo json_encode($response);
    }

    function getVisitors()
    {
        $value = array('Id_perpustakaan' => $this->input->post('libraryID'));
        $response = $this->m_visitorArchieve->getVisitors($value);
        echo json_encode($response);
    }

    public function export()
    {
        $value = array('Id_perpustakaan' => $this->input->post('libraryID'));
        $response = $this->m_visitorArchieve->exportXLSX($value);
        echo json_encode($response);
    }
}
