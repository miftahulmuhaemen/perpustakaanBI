 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pages extends CI_Model{

  public function __construct()
  {
    parent::__construct();
  }

  public function v_page($data ='')
  {
    if ( ! file_exists(APPPATH.'views/pages/'.$data['page'].'.php'))
		{
			show_404();
		}

    if (!isset($data['title']))
      $data['title']  = 'Perpustakaan BI Banjarmasin';

    if ($this->session->has_userdata('login')&&$this->session->userdata('level')<5){
			$data['menu']	= array('Dashboard', 'Kelola User','Kelola Buku', 'Kelola BI Corner', 'Arsip Kegiatan', 'Arsip Pengunjung');
      $data['Icon'] = array('fa-tachometer-alt', 'fa-users-cog', 'fa-university', 'fa-swatchbook', 'fa-archive', 'fa-archive');
      $data['link'] = array('dashboard', 'kelola-user', 'kelola-buku','kelola-corner', 'activityArchieve', 'visitorArchieve');
    }else if ($this->session->has_userdata('login')) {
      $data['menu'] = array('Cari Buku', 'Riwayat' );
      $data['Icon'] = array('fa-school', 'fa-history');
      $data['link'] = array('','riwayat');
    }

    $this->load->view('templates/header', $data);
    $this->load->view('pages/'.$data['page'], $data);
    $this->load->view('templates/footer', $data);
  }

}
