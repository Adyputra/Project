<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Management extends CI_Controller
{

    public function index()
    {
        $data['title'] = 'Management';
        $data['admin'] = $this->db->get_where('tbadmin', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('management/index', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'menu' => $this->input->post('menu')
            ];
            $this->db->insert('user_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" 
            role="alert"> New Menu Added! </div>');
            redirect('management/index');
        }
    }
    public function edit($id)
    {
        $data['title'] = 'Edit Management';
        $data['admin'] = $this->db->get_where('tbadmin', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->db->get_where('user_menu', ['id' => $id])->row_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('management/editmanagement', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'menu' => $this->input->post('menu')
            ];
            $this->db->update('user_menu', $data, ['id' => $id]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" 
            role="alert">Menu Berhasil Di Edit! </div>');
            redirect('management/index');
        }
    }

    public function submenu()
    {
        $data['title'] = 'Submenu Management';
        $data['admin'] = $this->db->get_where('tbadmin', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('Menu_model', 'menu');


        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('management/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" 
            role="alert"> New Sub Menu Added! </div>');
            redirect('management/submenu');
        }
    }
    public function editsubmenu($id)
    {
        $data['title'] = 'Edit Submenu Management';
        $data['admin'] = $this->db->get_where('tbadmin', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->db->get_where('user_sub_menu', ['id' => $id])->row_array();

        $this->form_validation->set_rules('title', 'Title', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('management/editsubmanagement', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title')
            ];
            $this->db->update('user_sub_menu', $data, ['id' => $id]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" 
            role="alert">Submenu Management Berhasil Di Edit! </div>');
            redirect('management/submenu');
        }
    }
}
