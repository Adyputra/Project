<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Katalog extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('data');
    }
    public function index()
    {
        $data['title'] = 'Katalog';
        $data['admin'] = $this->db->get_where('tbadmin', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['nama'] = $this->db->get('tbkatalog')->result_array();

        $this->form_validation->set_rules('nama', 'Name Katalog', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('katalog/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('tbkatalog', ['nama' => $this->input->post('nama')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" 
            role="alert"> New Katalog Added! </div>');
            redirect('katalog');
        }
    }
    public function kalender()
    {
        $data = array(
            "tbproduk" => $this->data->getproduk()
        );
        $data['title'] = 'katalog';
        $this->load->view('templates/header', $data);
        //$this->load->view('templates/sidebar', $data);
        //$this->load->view('templates/topbar', $data);
        $this->load->view('katalog/kalender', $data);
    }
    public function undangan()
    {
        $data = array(
            "tbproduk" => $this->data->getproduk()
        );
        $data['title'] = 'katalog';
        $this->load->view('templates/header', $data);
        //$this->load->view('templates/sidebar', $data);
        //$this->load->view('templates/topbar', $data);
        $this->load->view('katalog/undangan', $data);
    }
}
