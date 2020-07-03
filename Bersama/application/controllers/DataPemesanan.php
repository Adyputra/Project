<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Datapemesanan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('data');
    }
    public function index()
    {
        $data = array(
            "penjualan" => $this->data->getdatapenjualan()
        );

        $data['title'] = 'Data Pemesanan';
        $data['admin'] = $this->db->get_where('tbadmin', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('datapemesanan/index', $data);
        $this->load->view('templates/footer');
    }
    public function print()
    {
        $data = array(
            "penjualan" => $this->data->getdatapenjualan()
        );
        $this->load->view('templates/header', $data);
        //$this->load->view('templates/sidebar', $data);
        //$this->load->view('templates/topbar', $data);
        $this->load->view('datapemesanan/printdata', $data);
    }
}
