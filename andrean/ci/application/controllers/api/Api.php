<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
class Api extends REST_Controller  {

    public function login_post()
    {
        $email = $this->input->post('email', true);
        $password = md5($this->input->post('password', true));

        $cek = $this->db->get_where('pengguna', ['email' => $email, 'password' => $password])->row_array();
        if ($cek > 0) {
            $res = [
                'status' => true,
                'pesan' => 'Login Berhasil',
                'data' => $cek
            ];
        } else {
            $res = [
                'status' => false,
                'pesan' => 'Login Gagal, Email / Password Salah',
                'data' => null
            ];
        }
        $this->response($res, 200);
    }
    public function register_post()
    {
        $nama = $this->input->post('nama', true);
        $email = $this->input->post('email', true);
        $password = md5($this->input->post('password', true));
        $cek = $this->db->get_where('pengguna', ['email' => $email])->row_array();
        if ($cek > 0) {
            $res = [
                'status' => false,
                'pesan' => 'Email Telah Di Gunakan',
            ];
        } else {
            $arr = [
                'nama' => $nama,
                'email' => $email,
                'password' => $password,
                'create_at' => date('Y-m-d H:i:s')
            ];
            $cek = $this->DataModel->insert('pengguna', $arr);
            $res = [
                'status' => true,
                'pesan' => 'Pendaftaran Akun Berhasil',
            ];
        }
        $this->response($res, 200);
    }
    public function datapengguna_get()
    {
        $cek = $this->db->get("pengguna")->result_array();
        $res = [
            'status' => true,
            'pesan' => 'Berhasil',
            'data' => $cek
        ];
        $this->response($res, 200);
    }
}