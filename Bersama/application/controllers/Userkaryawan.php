<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Userkaryawan extends CI_Controller
{

    public function index()
    {
        $data['title'] = 'User Karyawan';
        $data['data'] = $this->db->get_where('tbadmin', ['role_id' => 2])->result_array();

        $data['admin'] = $this->db->get_where('tbadmin', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('userkaryawan/index', $data);
        $this->load->view('templates/footer');
    }
    public function delete($id)
    {
        $data['title'] = 'Hapus User Karyawan';
        
        $this->db->delete('tbadmin', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" 
        role="alert">User Karyawan Berhasil Di Hapus! </div>');
        redirect('userkaryawan/index');
        
    }

}
