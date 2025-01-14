<?php
defined('BASEPATH') or exit('No direct script access allowed');

class VisitorArchieve extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_visitorArchieve');
        if ($this->session->userdata('level') >= 5) {
            redirect(base_url());
        }
    }

    function get()
    {
        $response = $this->M_visitorArchieve->get();
        echo json_encode($response);
    }

    function getVisitors()
    {
        $value = array('Id_perpustakaan' => $this->input->post('libraryID'));
        $response = $this->M_visitorArchieve->getVisitors($value);
        echo json_encode($response);
    }

    public function export()
    {
        $value = array('Id_perpustakaan' => $this->input->post('libraryID'));
        $response = $this->M_visitorArchieve->exportXLSX($value);
        echo json_encode($response);
    }
}
