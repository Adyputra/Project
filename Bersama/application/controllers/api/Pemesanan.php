<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
class Pemesanan extends REST_Controller
{

    public function detailpesanan_get($kode_penjualan)
    {
        $data['data'] = $this->GeneralModel->getDataSingle("detailpesanan",$kode_penjualan);
        $data['respon'] = [
            'status' => true,
            'pesan' => "Berhasil"
        ];
        $this->response($data, 200);
    }
    public function buatpesanan_post()
    {
        $getkalender = $this->db->get_where('tbkalender', ['id_kalender' => $this->input->post('id_kalender', true)])->row_array();
        $kodenum = $this->GeneralModel->random_number(3);
        $arr = [
            'kode_penjualan' => $this->GeneralModel->random_semua(16),
            'id_customer' => $this->input->post('id_customer', true),
            'id_kalender' => $this->input->post('id_kalender', true),
            'kode_akunbank' => $this->input->post('kode_akunbank', true),
            'qty' => $this->input->post('qty', true),
            'last_price' => $getkalender['harga'],
            'alamat_kirim' => $this->input->post('alamat_kirim', true),
            'catatan_member' => $this->input->post('catatan_member', true),
            'unik' => $kodenum,
            'create_at' => date('Y-m-d H:i:s')
        ];
        $this->GeneralModel->insertData("penjualan", $arr);
        $data['respon'] = [
            'status' => true,
            'pesan' => "Berhasil Menyimpan Data Pembelian Anda. Silahkan Melakukan Pembayaran",
            "kode" => $arr['kode_penjualan']
        ];
        $this->response($data, 200);
    }

    public function konfirbayar_post($kode_penjualan)
    {
        $gambar = "assets/default.png";

        $this->load->library("upload");
        $config['upload_path'] = './assets/upload/bukti/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
        $config['encrypt_name'] = TRUE;
        $this->upload->initialize($config);
        if (!empty($_FILES['foto_bukti']['name'])) {

            if ($this->upload->do_upload('foto_bukti')) {
                $gbr = $this->upload->data();

                $gambar = "assets/upload/bukti/" . $gbr['file_name'];
            }
        }
        $arr = [
            'bukti_tf' => $gambar,
            'status' => 2
        ];
        $this->GeneralModel->updateData("penjualan", $arr, $kode_penjualan, 'kode_penjualan');
        $data['respon'] = [
            'status' => true,
            'pesan' => "Berhasil Mengirim Bukti Pembayaran. Silahkan Menunggu Konfirmasi Dari Admin"
        ];
        $this->response($data, 200);
    }
    public function batalkan_delete($kode_penjualan)
    {
        $cekdata = $this->db->get_where('penjualan', ['kode_penjualan' => $kode_penjualan])->row_array();
        if ($cekdata['status'] == "0") {
            $data['respon'] = [
                'status' => false,
                'pesan' => "Pembelian Ini Telah DI Batalkan"
            ];
        } else if ($cekdata['status'] == "3") {
            $data['respon'] = [
                'status' => false,
                'pesan' => "Pembelian Ini Telah Di Proses Oleh Admin"
            ];
        } else if ($cekdata['status'] == "5") {
            $data['respon'] = [
                'status' => false,
                'pesan' => "Pembelian Ini Telah Selesai"
            ];
        } else {
            $arr = [
                'status' => 0
            ];
            $this->GeneralModel->updateData("penjualan", $arr, $kode_penjualan, 'kode_penjualan');
            $data['respon'] = [
                'status' => true,
                'pesan' => "Berhasil Membatalkan Pembelian"
            ];
        }
        
        $this->response($data, 200);
    }


    public function dataform_get()
    {
        $id = $this->get('id');
        $kodebarang = $this->get('kodebarang');
        $cek = $this->db->get_where('tbcustomer', ['id' => $id])->row_array();
        $cekdata = $this->db->get_where('tbkalender', ['id_kalender' => $kodebarang])->row_array();
        $getbank = $this->db->get('akunbank')->result_array();
        $data = [
            'databank' => $getbank,
            'data' => $cekdata,
        ];
        $data['data']['namaakun'] = $cek['nama'];
        $data['respon'] = [
            'status' => true,
            'pesan' => "Berhasil"
        ];
        $this->response($data, 200);
    }
}
