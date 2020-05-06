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

    public function logingoogle_post()
    {
        $email = $this->input->post('email', true);
        $nama = $this->input->post('nama', true);
        $idgoogle = $this->input->post('idgoogle', true);
        $cek = $this->db->get_where('tbcustomer', ['email' => $email, 'daftar_via' => 1])->row_array();
        if ($cek > 0) {

            $data['respon'] = [
                'status' => false,
                'pesan' => "Email Ini Telah Terdaftar Via Non Akun Google. Silahkan Mengisi Form Login.",
            ];
        } else {
            $cek = $this->db->get_where('tbcustomer', ['email' => $email, 'daftar_via' => 2])->row_array();
            if ($cek > 0) {

                $data['respon'] = [
                    'status' => true,
                    'pesan' => "Login Berhasil",
                    'data' => $cek
                ];
            } else {
                $arr = [
                    'nama' => $nama,
                    'email' => $email,
                    'password' => $idgoogle,
                    'daftar_via' => 2
                ];
                $this->GeneralModel->insertData("tbcustomer", $arr);
                $cek = $this->db->get_where('tbcustomer', ['email' => $email, 'daftar_via' => 2])->row_array();
                $data['respon'] = [
                    'status' => true,
                    'pesan' => "Login Berhasil",
                    'data' => $cek
                ];
            }
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
                    'daftar_via' => $cek['daftar_via'],
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


    public function gantipassword_post($id)
    {
        $passlama = $this->input->post('passlama', true);
        $passbaru = $this->input->post('passbaru', true);
        $passkonfir = $this->input->post('passkonfir', true);
        $cek = $this->db->get_where('tbcustomer', ['id' => $id, 'password' => $passlama])->row_array();
        if ($cek > 0) {
                if ($passbaru == $passkonfir) {

                    $this->GeneralModel->updateData("tbcustomer", ['password' =>  $passbaru], $id, 'id');
                    $data['respon'] = [
                        'status' => true,
                        'pesan' => "Password Akun Anda Berhasil Di Ganti"
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
                'pesan' => "Password Lama Salah"
            ];
        }

        $this->response($data, 200);
    }


}