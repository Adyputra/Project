<?php

class List_model extends CI_Model
{
    public function getListKalender()
    {
        return $this->db->get('tbkalender')->result_array();
    }

    public function getListUndangan()
    {
        return $this->db->get('tbundangan')->result_array();
    }
}