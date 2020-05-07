<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Katalog_model extends CI_Model
{
    public function getSubKatalog()
    {
        $query = "SELECT `tbkatalog`.`nama`
                    FROM `tbkatalog`
                    ON `tbkatalog`.`nama` = `tbkatalog`.`id_Katalog`
                    ";
        return $this->db->query($query)->result_array();
    }
}
