<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
class Auth extends REST_Controller
{

    public function login_post()
    {
        $email = $this->input->post('email', true);
        $pass = $this->input->post('password', true);
        $cek = $this->db->get_where('tbcustomer', ['email' => $email, 'password' => $pass])->row_array();
        if ($cek > 0) {
            
            $data['respon'] = [
                'status' => true,
                'pesan' => "Login Berhasil",
                'data' => $cek
            ];
        } else {
            $data['respon'] = [
                'status' => false,
                'pesan' => "Login Gagal"
            ];
        }

        $this->response($data, 200);
    }

    public function reqotp_post()
    {
        $email = $this->input->post('email',true);
        $cek = $this->db->get_where('tbcustomer',['email' => $email])->row_array();
        if ($cek > 0) {
            $kodenum = $this->GeneralModel->random_number(6);
            $arr = [
                'kode_otp' => $this->GeneralModel->random_semua(8),
                'id_customer' => $cek['id'],
                'email' => $cek['email'],
                'key_otp' => $kodenum,
                'create_at' => date('Y-m-d H:i:s')
            ];
            $this->GeneralModel->deleteData("otp",'email', $cek['email']);
            $pesan = "Hallo ". $cek ['nama']." Berikut adalah kode OTP reset akun anda <b>".$kodenum."</b>";
            $kirimemail = $this->GeneralModel->kirimemail($cek['email'],"Kode OTP Reset Password - SILaper", $pesan);
            if($kirimemail){
                $this->GeneralModel->insertData("otp", $arr);
                $data['respon'] = [
                    'status' => true,
                    'pesan' => "Berhasil Mengirim Kode OTP Ke Email Anda"
                ];
            }else{

                $data['respon'] = [
                    'status' => false,
                    'pesan' => "Gagal Mengirim Kode OTP. Silahkan COba Lagi"
                ];
            }
        } else {
            $data['respon'] = [
                'status' => false,
                'pesan' => "Email Belum Terdaftar"
            ];
           
        }

        $this->response($data, 200);
        
    }


    public function cekkode_post()
    {
        $email = $this->input->post('email', true);
        $kode = $this->input->post('kode', true);
        $cek = $this->db->get_where('otp', ['email' => $email, 'key_otp' => $kode])->row_array();
        if ($cek > 0) {
            if($cek['status'] == '1'){
            $data['respon'] = [
                'status' => true,
                'pesan' => "Kode Benar"
            ];
            }else{

                $data['respon'] = [
                    'status' => false,
                    'pesan' => "Kode OTP Sudah Tidak Berlaku Lagi"
                ];
            }
        } else {
            $data['respon'] = [
                'status' => false,
                'pesan' => "Kode OTP Salah"
            ];
        }

        $this->response($data, 200);
    }


    public function prosesgantipassword_post()
    {
        $email = $this->input->post('email', true);
        $kode = $this->input->post('kode', true);
        $pass = $this->input->post('pass', true);
        $repass = $this->input->post('repass', true);
        $cek = $this->db->get_where('otp', ['email' => $email, 'key_otp' => $kode])->row_array();
        if ($cek > 0) {
            if ($cek['status'] == '1') {
                if ($pass == $repass) {

                    $this->GeneralModel->updateData("tbcustomer", ['password' =>  $pass], $cek['email'], 'email');
                    $this->GeneralModel->deleteData("otp", 'email', $cek['email']);
                    $data['respon'] = [
                        'status' => true,
                        'pesan' => "Password Akun Anda Berhasil Di Ganti. Silahkan Login Ke Akun Anda"
                    ];
                } else {

                    $data['respon'] = [
                        'status' => false,
                        'pesan' => "Konfimasi Password Salah"
                    ];
                }
                
            } else {

                $data['respon'] = [
                    'status' => false,
                    'pesan' => "Kode OTP Sudah Tidak Berlaku Lagi"
                ];
            }
        } else {
            $data['respon'] = [
                'status' => false,
                'pesan' => "Kode OTP Salah"
            ];
        }

        $this->response($data, 200);
    }


    public function profil_get()
    {
        $id = $this->get('id');
        $cek = $this->db->get_where('tbcustomer', ['id' => $id])->row_array();
        if ($cek > 0) {
            $data['respon'] = [
                'data' => [
                    'nama' => $cek['nama'],
                    'email' => $cek['email'],
                ],
                'status' => true,
                'pesan' => "Berhasil"
            ];
                
        } else {
            $data['respon'] = [
                'data' => null,
                'status' => false,
                'pesan' => "Gagal, Data Tidak Di Temukan"
            ];
        }

        $this->response($data, 200);
    }


    public function editprofil_post($id)
    {
        $email = $this->input->post('email', true);
        $nama = $this->input->post('nama', true);
        $cek = $this->db->get_where('tbcustomer', ['email' => $email, 'id !=' => $id])->row_array();
        if ($cek > 0) {
                $data['respon'] = [
                    'status' => false,
                    'pesan' => "Email Telah Di Gunakan"
                ];
            
        } else {
            $arr = [
                'nama' => $nama,
                'email' => $email,
            ];
            $this->GeneralModel->updateData("tbcustomer", $arr, $id, 'id');
            $data['respon'] = [
                'status' => true,
                'pesan' => "Berhasil Edit Profile"
            ];
        }

        $this->response($data, 200);
    }
}