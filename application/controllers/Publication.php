<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Publication extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('m_publication');
		if ($this->session->userdata('level')>=5) {
			redirect(base_url());
		}
  }


  function get()
  {
    $postData = array(
      'search' => $this->input->post('search'),
      'sort' => $this->input->post('sort'),
      'page' => $this->input->post('page'),
      'start' => $this->input->post('start')
    );

    $data = $this->m_publication->get($postData);
    echo json_encode($data);
  }

  function update()
  {
    $postData = array(
      'id_publikasi' => $this->input->post('id_publikasi'),
      'judul' => $this->input->post('judul'),
      'edisi' => $this->input->post('edisi'),
      'tgl_terbit' => $this->input->post('tgl_terbit'),
      'tgl_periksa' => $this->input->post('tgl_periksa'),
      'status' => $this->input->post('status')
    );

    $where = array(
      'id_publikasi' => $this->input->post('id_publikasi')
    );

    $this->m_publication->update($postData, $where);
  }

  function insert()
  {
    $postData = array(
      'judul' => $this->input->post('judul'),
      'edisi' => $this->input->post('edisi'),
      'tgl_terbit' => $this->input->post('tgl_terbit'),
      'tgl_periksa' => $this->input->post('tgl_periksa'),
      'status' => $this->input->post('status')
    );

    $this->m_publication->insert($postData);
  }

  function delete()
  {
    $where = array(
      'id_publikasi' => $this->input->post('id_publikasi')
    );

    $this->m_publication->delete($where);
  }

  function importReplace()
  {
    $data = json_decode($this->input->post('data'));
    $this->m_publication->importReplace($data);
  }

  function importCancel()
  {
    $data = json_decode($this->input->post('data'));
    $this->m_publication->importCancel($data);
  }

  function importKeep()
  {
    $data = json_decode($this->input->post('data'));
    $this->m_publication->importKeep($data);
  }

  public function export()
  {
    $response = $this->m_publication->export();
    echo json_encode($response);
  }
}
