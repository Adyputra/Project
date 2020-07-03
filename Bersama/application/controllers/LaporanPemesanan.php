<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporanpemesanan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('data');
        
    }
    public function index()
    {
        $data = array(
            "penjualan"=>$this->data->getdatapenjualan()
        );
        
        $data['title'] = 'Laporan Pemesanan';
        $data['admin'] = $this->db->get_where('tbadmin', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporanpemesanan/index', $data);
        $this->load->view('templates/footer');
    }
    public function print(){
        $data = array(
            "penjualan"=>$this->data->getdatapenjualan()
        );
        $data['title'] = 'Laporan Pemesanan';
        $this->load->view('templates/header', $data);
        //$this->load->view('templates/sidebar', $data);
        //$this->load->view('templates/topbar', $data);
        $this->load->view('laporanpemesanan/printdata', $data);
    }
}
