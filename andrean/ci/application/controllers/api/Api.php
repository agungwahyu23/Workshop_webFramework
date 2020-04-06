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
                'code' => 200,
                'pesan' => 'Login Berhasil',
                'data' => $cek
            ];
        } else {
            $res = [
                'code' => 403,
                'pesan' => 'Login Gagal',
                'data' => null
            ];
        }
        $this->response($res, $res['code']);
    }
    public function register_post()
    {
        $nama = $this->input->post('nama', true);
        $email = $this->input->post('email', true);
        $password = md5($this->input->post('password', true));

        $cek = $this->db->get_where('pengguna', ['email' => $email])->row_array();
        if ($cek > 0) {
            $res = [
                'code' => 403,
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
                'code' => 200,
                'pesan' => 'Pendaftaran Akun Berhasil',
            ];
        }
        $this->response($res, $res['code']);
    }

}