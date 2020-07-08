<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Book extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('m_book');
		if ($this->session->userdata('level')>=5) {
			redirect(base_url());
		}
  }

  function get()
  {
    $postData = array(
      'search' 	=> $this->input->post('search'),
      'sort' 		=> $this->input->post('sort'),
      'page' 		=> $this->input->post('page'),
      'start' 	=> $this->input->post('start')
    );

    $data = $this->m_book->get($postData);
    echo json_encode($data);
  }

  function update()
  {
    $postData = array(
      'judul' => $this->input->post('judul'),
      'pengarang' => $this->input->post('pengarang'),
      'tahun' => $this->input->post('tahun'),
      'jumlah' => $this->input->post('jumlah'),
      'lokasi' => $this->input->post('lokasi'),
      'klasifikasi' => $this->input->post('klasifikasi'),
      'no_register' => $this->input->post('no_register'),
      'no_barcode' => $this->input->post('no_barcode')
    );

    $where = array(
      'no_barcode' => $this->input->post('originalBarcode')
    );

    $this->m_book->update($postData, $where);
  }

  function insert()
  {
    $postData = array(
      'judul' => $this->input->post('judul'),
      'pengarang' => $this->input->post('pengarang'),
      'tahun' => $this->input->post('tahun'),
      'jumlah' => $this->input->post('jumlah'),
      'lokasi' => $this->input->post('lokasi'),
      'klasifikasi' => $this->input->post('klasifikasi'),
      'no_barcode' => $this->input->post('no_barcode')
    );

    $this->m_book->insert($postData);
  }

  function delete()
  {
    $where = array(
      'no_barcode' => $this->input->post('no_barcode')
    );
    $this->m_book->delete($where);
  }

  function importReplace()
  {
    $data = json_decode($this->input->post('data'));
    $this->m_book->importReplace($data);
  }

  function importCancel()
  {
    $data = json_decode($this->input->post('data'));
    $this->m_book->importCancel($data);
  }

  function importKeep()
  {
    $data = json_decode($this->input->post('data'));
    $this->m_book->importKeep($data);
  }

  public function export()
  {
    $response = $this->m_book->export();
    echo json_encode($response);
  }
}
