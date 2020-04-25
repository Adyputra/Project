<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kalender extends CI_Controller
{
    public function index()
    {
        $data['title'] = ' Contoh Kalender';
        $data['admin'] = $this->db->get_where('tbadmin', ['email' =>
        $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kalender/index', $data);
        $this->load->view('templates/footer');
    }
}
