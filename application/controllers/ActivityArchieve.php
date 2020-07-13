<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ActivityArchieve extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_activityArchieve');
        if ($this->session->userdata('level') >= 5) {
            redirect(base_url());
        }
    }

    function get()
    {
        $response = $this->M_activityArchieve->get();
        echo json_encode($response);
    }

    function getActivities()
    {
        $value = array('id_bi_corner' => $this->input->post('libraryID'));
        $response = $this->M_activityArchieve->getActivities($value);
        echo json_encode($response);
    }

    function deleteActivity()
    {
        $activityID = array('id_penilaian' => $this->input->post('id'));
        $imagesID = array('id_kegiatan' => $this->input->post('id'));
        $response = $this->M_activityArchieve->deleteActivity($activityID, $imagesID);
        echo json_encode($response);
    }

    public function insert()
    {
        $errorMsg = '';
        $config['upload_path'] = './uploads/';
        $config['allowed_types']  = 'gif|jpg|jpeg|png';
        $config['max_size']       = 1000;

        $this->load->library('image_lib');
        $this->load->library('upload', $config);
        $this->M_activityArchieve->transStart();

        $postactivity = array(
            'id_bi_corner' => $_POST['libraryName'],
            'nama' => $_POST['activityName'],
            'tempat' => $_POST['activityPlace'],
            'deskripsi' => $_POST['activityDescription'],
            'tgl_kegiatan' => $_POST['activityDate'],
            'jumlah_peserta' => $_POST['activityAttendant'],
        );

        $activityID = $this->M_activityArchieve->insert($postactivity);

        if ($this->M_activityArchieve->transStatus()) {

            if (!empty($_FILES['files']['name'])) {

                $count = count($_FILES['files']['name']);

                for ($index = 0; $index < $count; $index++) {

                    $_FILES['file']['name']     = $_FILES['files']['name'][$index];
                    $_FILES['file']['type']     = $_FILES['files']['type'][$index];
                    $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$index];
                    $_FILES['file']['error']     = $_FILES['files']['error'][$index];
                    $_FILES['file']['size']     = $_FILES['files']['size'][$index];

                    if ($this->upload->do_upload('file')) {

                        $fileData = $this->upload->data();
                        $postFiles[] = array(
                            'id_kegiatan' => $activityID,
                            'path' => $fileData['file_name']
                        );

                        /** Create Thumbnail */
                        $source_path = './uploads/' . $fileData['file_name'];
                        $target_path = './uploads/thumbnails/' . $fileData['file_name'];
                        $config_manip = array(
                            'image_library' => 'gd2',
                            'source_image' => $source_path,
                            'new_image' => $target_path,
                            'maintain_ratio' => TRUE,
                            'create_thumb' => TRUE,
                            'thumb_marker' => '_thumb',
                            'width' => 150,
                            'height' => 150
                        );

                        $this->image_lib->initialize($config_manip);

                        if (!$this->image_lib->resize())
                            $errorMsg .= $this->image_lib->display_errors() . ', ';

                        $this->image_lib->clear();
                    } else {
                        $errorMsg .= $_FILES['file']['name'] . ',';
                    }
                }

                if ($errorMsg != null) {
                    $errorMsg = 'Kemungkinan gambar melebihi berat maksimal (1MB) atau jenis gambar salah (GIF,JPG/JPEG,PNG), ' . $errorMsg;
                } else {
                    if (!$this->M_activityArchieve->insertFiles($postFiles))
                        $errorMsg .= 'Gambar gagal diunggah.';
                    else
                        $this->M_activityArchieve->transComplete();
                }
            } else {
                $errorMsg .= 'Tidak ada data yang diterima.';
            }
        } else {
            $errorMsg .= 'Server mengalami masalah.';
        }

        $response = array(
            'errorDatabaseStatus' =>  !$this->M_activityArchieve->transStatus(),
            'errorMessage' => $errorMsg,
            'errorFile' => $this->upload->display_errors(),
        );

        echo json_encode($response);
    }

    public function export()
    {
        $value = array('id_bi_corner' => $this->input->post('libraryID'));
        $response = $this->M_activityArchieve->exportXLSX($value);
        echo json_encode($response);
    }
}
