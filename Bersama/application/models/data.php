<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data extends CI_Model
{
    public function getjumlahusr()
    {
        $this->db->select('COUNT(id) as total');
        $this->db->from('tbadmin');
        $this->db->where('role_id',"2");
        $query= $this->db->get()->result_array();
        return $query;
    }
    public function getjumlahorder()
    {
        $this->db->select('COUNT(kode_penjualan) as total');
        $this->db->from('penjualan');
        $this->db->where('status',"1");
        $query= $this->db->get()->result_array();
        return $query;
    }
    public function getjumlahpenjualan()
    {
        $this->db->select('COUNT(kode_penjualan) as total');
        $this->db->from('penjualan');
        $this->db->where('status',"3");
        $query= $this->db->get()->result_array();
        return $query;
    }
    public function getjumlahorderwait()
    {
        $this->db->select('COUNT(kode_penjualan) as total');
        $this->db->from('penjualan');
        $this->db->where('status',"2");
        $query= $this->db->get()->result_array();
        return $query;
    }
    public function getjumlahkalender()
    {
        $this->db->select('COUNT(id_kalender) as total');
        $this->db->from('tbkalender');
        $query= $this->db->get()->result_array();
        return $query;
    }
    public function getjumlahundangan()
    {
        $this->db->select('COUNT(id_undangan) as total');
        $this->db->from('tbundangan');
        $query= $this->db->get()->result_array();
        return $query;
    }
    public function getdatapenjualan()
    {
        $this->load->database();
        return $this->db->get("penjualan")->result();
    }
    public function getkalender()
    {
        $this->load->database();
        return $this->db->get("tbkalender")->result();
    }
    public function getundangan()
    {
        $this->load->database();
        return $this->db->get("tbundangan")->result();
    }
}