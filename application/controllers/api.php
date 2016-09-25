<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('node');
    }

    public function index() {
        echo "Selamat datang di API pemetaan radiasi gas butane<br/>";
        echo "<br/>URL : <br/><br/>";
        echo "get : /ambil_data_node<br/>";
        echo "post : /simpan_data<br/>";
        echo "kirim data melalui get : simpan_data_node/nama_node/x/y/z<br/>";
    }

    public function ambil_semua_data() {
        $data_node = $this->node->ambil_semua_data()->result();
        $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data_node, JSON_PRETTY_PRINT))
                ->_display();
        exit;
    }

    public function ambil_data_node($nama) {
        $nama_node = array('nama_node' => $nama);
        $data_node = $this->node->ambil_data($nama_node)->result();
        $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data_node, JSON_PRETTY_PRINT))
                ->_display();
        exit;
    }

    public function simpan_data() {
        $data = (array) json_decode(file_get_contents('php://input'));
        $this->db->insert('data_node', $data);
        $response = array(
            'Success' => true,
            'Info' => 'Data Tersimpan');

        $this->output
                ->set_status_header(201)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($response, JSON_PRETTY_PRINT))
                ->_display();
        exit;
    }

    public function simpan_data_node($nama_node, $x, $y, $z) {
        $this->node->simpan_data($nama_node, $x, $y, $z);

        $response = array(
            'Success' => true,
            'Info' => 'Data Tersimpan');

        $this->output
                ->set_status_header(201)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($response, JSON_PRETTY_PRINT))
                ->_display();
        exit;
    }

    public function hapus_data() {
        $data_node = $this->node->hapus_all_data();
        $response = array(
            'Success' => true,
            'Info' => 'Semua Data Terhapus');

        $this->output
                ->set_status_header(201)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($response, JSON_PRETTY_PRINT))
                ->_display();
        exit;
    }

    public function tampil_grafik() {
        $this->load->view('chart.php');
    }

}
