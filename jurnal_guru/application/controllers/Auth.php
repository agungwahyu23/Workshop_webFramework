<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	 function __construct()
  	{
		parent::__Construct();
		$this->load->helper("Response_helper");
		$this->load->model("Maksi");
		date_default_timezone_set('Asia/Jakarta');
  	}

	public function index()
	{
		if ($this->session->has_userdata('kode_pengguna')) {
			if ($this->session->userdata('level') == "1") {
				redirect(base_url('backoffice/dashboard'));
			}else {
				redirect(base_url('auth/logout'));
			}
		} else {
			$this->load->view('frontend/index');
		}
	}
	public function verifemail($id)
	{
		$cekData = $this->db->get_where("pengguna", ['kode_pengguna' => $id])->row_array();
		if ($cekData < 1) {
			
			$this->session->set_flashdata("message", ['danger', 'Akun Tidak Di Temukan', ' Informasi']);
			redirect(base_url());
		} else if ($cekData['st_email'] != 0) {

			$this->session->set_flashdata("message", ['warning', 'Email Anda Telah Terverifikasi', ' Informasi']);
			redirect(base_url());
		} else {

			$arr = [
				'st_email' => 1
			];
			$this->Maksi->updateData("pengguna", $arr, $id, "kode_pengguna");
			$this->session->set_flashdata("message", ['success', 'Email Anda Telah Terverifikasi', ' Berhasil']);
			redirect(base_url());
		}
	}
	public function proseslogin(){
		$cekData = $this->db->get_where("pengguna", ['email' => $this->input->post('email', TRUE),'status' => 1])->row_array();
		if($cekData > 1 && password_verify($this->input->post('password', TRUE), $cekData['password'])){
			$arr = ['last_login' =>  date('Y-m-d H:i:s')];
			$this->Maksi->updateData("pengguna", $arr, $cekData['kode_pengguna'], "kode_pengguna");
			$newdata = array(
				'kode_pengguna'  => $cekData['kode_pengguna'],
				'nama_pengguna'     => $cekData['nama_pengguna'],
				'email'     => $cekData['email'],
				'level'     => $cekData['level'],
				'akses_data'     => $cekData['akses_data'],
			);

			$this->session->set_userdata($newdata);	
			if ($cekData['level'] == '1') {
				redirect(base_url('backoffice/dashboard'));
			} else {
				$this->session->set_flashdata("message", ['warning', 'Tidak Ada Akses', ' Peringatan']);
				redirect(base_url());
			}
			  
		}else{
			$this->session->set_flashdata("message", ['danger', 'Login Gagal',' Gagal']);
			redirect(base_url());			
		}
	}
	public function logout(){
		$this->session->sess_destroy();	
		redirect(base_url());
	}
	public function errorpermission()
	{

		$this->load->view('errors/403');
	}
	public function notfoundpage()
	{

		$this->load->view('errors/404');
	}

	
}
