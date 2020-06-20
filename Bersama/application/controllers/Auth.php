<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        $this->goToDefaultPage();
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['title'] = "SiLaper Media Jaya - Login";
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            // validasi success
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('tbadmin', ['email' => $email])->row_array();

        // jika usernya ada
        if ($user) {
            // jika usernya aktif
            if ($user['is_active'] == 1) {
                // cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } else {
                        redirect('karyawan');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert
                alert-danger" role="alert">Wrong password! </div>');
                    redirect('auth');
                }
            } else {
                $this->db->update('reset_akun', ['status' => 0], ['email' => $this->input->post('email', true), 'tipe_reset' => 1]);
                $kodereset = $this->GeneralModel->random_semua(128);
                $link = base_url('auth/verifikasiemail/' . $kodereset);
                $pesan = "Selamat Datang " . $this->input->post('name', true) . ", \nTerima kasih telah mendaftar di SiLaper Media Jaya. Silahkan verifikasi email anda melalui link berikut \n" . $link;
                $kirimemail = $this->GeneralModel->kirimemail($this->input->post('email', true), "Verifikasi Akun - SiLaper Media Jaya", $pesan);
                $datare = [
                    'kode_reset' => $kodereset,
                    'email' => htmlspecialchars($email),
                    'keterangan' => 'Verifikasi Ulang Akun',
                    'tipe_reset' => 1,
                    'create_at' => date('Y-m-d H:i:s')
                ];
                $this->db->insert('reset_akun', $datare);
                $this->session->set_flashdata('message', '<div class="alert
                alert-danger" role="alert">Email anda belum aktif, Kami telah mengirim ulang email verifikasi ke akun email anda! </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert
            alert-danger" role="alert">Email is not registered! </div>');
            redirect('auth');
        }
    }

    public function registration()
    {
        $this->goToDefaultPage();
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tbadmin.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[5]|matches[password2]', [
            'matches' => 'password dont match!',
            'matches' => 'password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'SiLaper Media Jaya - Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 0,
                'date_created' => time()
            ];

            $this->db->insert('tbadmin', $data);
            $kodereset = $this->GeneralModel->random_semua(128);
            $link = base_url('auth/verifikasiemail/' . $kodereset);
            $pesan = "Selamat Datang " . $this->input->post('name', true) . ", \nTerima kasih telah mendaftar di SiLaper Media Jaya. Silahkan verifikasi email anda melalui link berikut \n" . $link;
            $kirimemail = $this->GeneralModel->kirimemail($this->input->post('email', true), "Verifikasi Akun - SiLaper Media Jaya", $pesan);
            $datare = [
                'kode_reset' => $kodereset,
                'email' => htmlspecialchars($this->input->post('email', true)),
                'keterangan' => 'Verifikasi Akun',
                'tipe_reset' => 1,
                'create_at' => date('Y-m-d H:i:s')
            ];
            $this->db->insert('reset_akun', $datare);
            $this->session->set_flashdata('message', '<div class="alert
            alert-success" role="alert">Registrasi akun berhasil. Silahkan verifikasi email anda. </div>');
            redirect('auth');
        }
    }
    public function lupapassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'SiLaper Media Jaya - Lupa Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/lupapassword');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email');

            $user = $this->db->get_where('tbadmin', ['email' => $email])->row_array();

            // jika usernya ada
            if ($user) {
                // jika usernya aktif
                if ($user['is_active'] == 1) {
                    $kodereset = $this->GeneralModel->random_semua(128);
                    $this->db->update('reset_akun', ['status' => 0], ['email' => $this->input->post('email', true), 'tipe_reset' => 2]);
                    $link = base_url('auth/prosesgantipassword/' . $kodereset);
                    $pesan = "Hallo " . $user['name'] . ", \nBerikut adalah link untuk mengganti password akun anda " . $link;
                    $kirimemail = $this->GeneralModel->kirimemail($this->input->post('email', true), "Link Ganti Password - SiLaper Media Jaya", $pesan);
                    $data = [
                        'kode_reset' => $kodereset,
                        'email' => htmlspecialchars($this->input->post('email', true)),
                        'keterangan' => 'Ganti Password',
                        'tipe_reset' => 2,
                        'create_at' => date('Y-m-d H:i:s')
                    ];

                    $this->db->insert('reset_akun', $data);
                    $this->session->set_flashdata('message', '<div class="alert
            alert-success" role="alert">Link untuk mengganti password telah di kirim ke email anda. Silahkan di kotak masuk / folder spam.</div>');

                    redirect('auth/lupapassword');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert
                alert-danger" role="alert">This Email has not been activated! </div>');
                    redirect('auth/lupapassword');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert
            alert-danger" role="alert">Email is not registered! </div>');
                redirect('auth/lupapassword');
            }
        }
    }

    public function verifikasiemail($token)
    {
        $cektoken = $this->db->get_where('reset_akun', ['kode_reset' => $token, 'status' => 1, 'tipe_reset' => 1])->row_array();

        // jika usernya ada
        if ($cektoken) {
                $this->db->update('reset_akun', ['status' => 0], ['kode_reset' => $token]);
                  $data = [
                    'is_active' => 1,
                    ];

                    $this->db->update('tbadmin', $data,['email' => $cektoken['email']]);
                    $this->session->set_flashdata('message', '<div class="alert
            alert-success" role="alert">Berhasil memverifikasi akun anda. Silahkan Login ke akun anda.</div>');

                    redirect('auth');
            
        } else {
            $this->session->set_flashdata('message', '<div class="alert
            alert-danger" role="alert">Kode sudah tidak valid atau sudah digunakan. </div>');
            redirect('auth');
        }
    }

    public function prosesgantipassword($token)
    {
        $cektoken = $this->db->get_where('reset_akun', ['kode_reset' => $token, 'status' => 1, 'tipe_reset' => 2])->row_array();

        // jika usernya ada
        if ($cektoken) {
            $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[5]|matches[password2]', [
                'matches' => 'password dont match!',
                'matches' => 'password too short!'
            ]);
            $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
            if ($this->form_validation->run() == false) {
                $data['title'] = 'SiLaper Media Jaya - Ganti Password';
                $data['datatoken'] = $cektoken;
                $this->load->view('templates/auth_header', $data);
                $this->load->view('auth/gantipassword', $data);
                $this->load->view('templates/auth_footer');
            } else {
                $password1 = $this->input->post('password1');
                $password2 = $this->input->post('password2');

                $this->db->update('reset_akun', ['status' => 0], ['kode_reset' => $token]);
                $data = [
                    'password' => password_hash($password1, PASSWORD_DEFAULT),
                ];

                $this->db->update('tbadmin', $data, ['email' => $cektoken['email']]);
                $this->session->set_flashdata('message', '<div class="alert
            alert-success" role="alert">Berhasil mengganti akun anda. Silahkan Login ke akun anda.</div>');

                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert
            alert-danger" role="alert">Kode sudah tidak valid. Silahkan membuat permintaan baru! </div>');
            redirect('auth/lupapassword');
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert
        alert-success" role="alert">You have been logged out! </div>');
        redirect('auth');
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }

    public function goToDefaultPage()
    {
        if ($this->session->userdata('role_id') == 1) {
            redirect('admin');
        } else if ($this->session->userdata('role_id') == 2) {
            redirect('karyawan');
        }
    }
}
