<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
class Produk extends REST_Controller
{

    public function detailkatalog_get($id)
    {
        $data['produk'] = $this->GeneralModel->getData("getproduk"," WHERE a.id_katalog='$id'");
        $data['katalog'] = $this->db->get_where('tbkatalog', ['id_katalog' => $id])->row_array();

        $data['respon'] = [
            'status' => true,
            'pesan' => "Berhasil"
        ];
        $this->response($data, 200);
    }
    public function detailproduk_get($id)
    {
        $data['data'] = $this->GeneralModel->getDataSingle("getproduk", $id);

        $data['respon'] = [
            'status' => true,
            'pesan' => "Berhasil"
        ];
        $this->response($data, 200);
    }

    public function datakatalog_get()
    {
        $data['data'] = $this->db->get('tbkatalog')->result_array();

        $data['respon'] = [
            'status' => true,
            'pesan' => "Berhasil"
        ];
        $this->response($data, 200);
    }
}
