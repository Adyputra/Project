<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function index()
    {
        $data['user'] = $this->db->get_where('tbadmin', ['email' =>
        $this->session->userdata('email')])->row_array();
        echo 'Selamat datang ' . $data['user']['name'];
    }
}