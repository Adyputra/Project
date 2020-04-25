<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KartuNama extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Contoh Kartu Nama';
        $data['admin'] = $this->db->get_where('tbadmin', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kartunama/index', $data);
        $this->load->view('templates/footer');
    }
}
