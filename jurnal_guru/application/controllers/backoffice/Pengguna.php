<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
		date_default_timezone_set('Asia/Jakarta');
		$this->load->library('session');
		if (!isset($_SESSION['kode_pengguna']) || $_SESSION['level'] != '1') {

			redirect(base_url());
		}
		if ($this->uri->segment(3) == "add" && $_SERVER['REQUEST_METHOD'] == "POST") {
			$this->storepengguna($this->uri->segment(4));
		} else if ($this->uri->segment(3) == "edit" && $_SERVER['REQUEST_METHOD'] == "POST") {
			$this->updatepengguna($this->uri->segment(4));
		}
	}

	public function admin()
	{
		$data['title'] = "Data Pengguna Admin";
		$data['level'] = 1;
		$data['content'] = "pengguna/indexpengguna";
		$data['data'] = $this->Maksi->getData("pengguna", "where a.level='1' and a.status != '0'");
		$this->load->view('backend/index', $data);
	}
	public function guru()
	{
		$data['title'] = "Data Pengguna Guru";
		$data['level'] = 2;
		$data['content'] = "pengguna/indexpengguna";
		$data['data'] = $this->Maksi->getData("pengguna", "where a.level='2' and a.status != '0'");
		$this->load->view('backend/index', $data);
	}
	public function siswa()
	{
		$data['title'] = "Data Pengguna Siswa";
		$data['level'] = 3;
		$data['content'] = "pengguna/indexpengguna";
		$data['data'] = $this->Maksi->getData("pengguna", "where a.level='3' and a.status != '0'");
		$this->load->view('backend/index', $data);
	}
	public function add($level)
	{
		$lv = ['', 'Admin', 'Guru', 'Siswa'];
		$data['title'] = "Tambah Pengguna " . $lv[$level];
		$data['content'] = "pengguna/formpengguna";
		$data['dataguru'] = $this->Maksi->getData("getguru");
		$data['datakelas'] = $this->Maksi->getData("getkelas");
		$data['data'] = null;
		$data['level'] = $level;

		$this->load->view('backend/index', $data);
	}


	public function storepengguna($level)
	{
		try {
			$email = $this->input->post('email', TRUE);
			$password = $this->input->post('password', TRUE);
			$nama = $this->input->post('nama_pengguna', TRUE);
			$cekData = $this->db->get_where("pengguna", ['email' => $email, 'status' => 1])->row_array();
			if ($cekData > 1) {
				$this->session->set_flashdata("message", ['danger', 'Gagal. Email Telah Terpakai', ' Gagal']);
				redirect(base_url('backoffice/pengguna/add/'.$level));
			} else {
				$kode = $this->Maksi->random_oke(32);
				$arr =
					[
						'kode_pengguna' => $kode,
						'nama_pengguna' => $nama,
						'email' => $email,
						'akses_data' => ($level == '1' ? 'ADMIN' : $this->input->post('akses', TRUE)),
						'password' => password_hash($password, PASSWORD_BCRYPT),
						'level' => $level,
						'create_at' => date('Y-m-d H:i:s')
					];
				$this->Maksi->insertData("pengguna", $arr);
				$this->session->set_flashdata("message", ['success', 'Data Berhasil Di Simpan', ' Berhasil']);
				$lv = ['', 'admin', 'guru', 'siswa'];
				redirect(base_url('backoffice/pengguna/' . $lv[$level]));
			}
		} catch (Exception $e) {
			$this->session->set_flashdata("message", ['danger', 'Gagal Menambah Data Pengguna', ' Gagal']);
			redirect(base_url('backoffice/pengguna/add/'.$level));
		}
	}

	public function edit($id)
	{
		$data['title'] = "Edit Pengguna";
		$data['content'] = "pengguna/formpengguna";
		$data['data'] = $this->db->get_where("pengguna", ['kode_pengguna' => $id])->row_array();
		$data['dataguru'] = $this->Maksi->getData("getguru");
		$data['datakelas'] = $this->Maksi->getData("getkelas");
		$data['level'] = $data['data']['level'];
		$this->load->view('backend/index', $data);
	}


	public function updatepengguna($id)
	{
		try {
			$email = $this->input->post('email', TRUE);
			$password = $this->input->post('password', TRUE);
			$nama = $this->input->post('nama_pengguna', TRUE);
			$ck = $this->db->get_where("pengguna", ['kode_pengguna' => $id])->row_array();
			$level = $ck['level'];
			$cekData = $this->db->get_where("pengguna", ['email' => $email, 'kode_pengguna !=' => $id, 'status' => 1])->row_array();
			if ($cekData > 1) {
				$this->session->set_flashdata("message", ['danger', 'Gagal. Email Telah Terpakai', ' Gagal']);
				redirect(base_url('backoffice/pengguna/edit/' . $id));
			} else {
				if ($password != "") {
					$pass = password_hash($password, PASSWORD_BCRYPT);
					$arr =
						[
							'nama_pengguna' => $nama,
							'email' => $email,
							'akses_data' => ($level == '1' ? 'ADMIN' : $this->input->post('akses', TRUE)),
							'password' => $pass
						];
					$this->Maksi->updateData("pengguna", $arr, $id, "kode_pengguna");
				} else {

					$arr =
						[
							'nama_pengguna' => $nama,
							'akses_data' => ($level == '1' ? 'ADMIN' : $this->input->post('akses', TRUE)),
							'email' => $email
						];
					$this->Maksi->updateData("pengguna", $arr, $id, "kode_pengguna");
				}
				$this->session->set_flashdata("message", ['success', 'Data Berhasil Di Edit', ' Berhasil']);

				$lv = ['', 'admin', 'guru', 'siswa'];
				redirect(base_url('backoffice/pengguna/' . $lv[$ck['level']]));
			}
		} catch (Exception $e) {
			$this->session->set_flashdata("message", ['danger', 'Gagal Mengedit Data Pengguna', ' Gagal']);
			redirect(base_url('backoffice/pengguna/edit/' . $id));
		}
	}

	public function delete($id)
	{
		$lv = ['', 'admin', 'guru', 'siswa'];
		try {
			$arr = ['status' => 0];
			$this->Maksi->updateData("pengguna", $arr, $id, "kode_pengguna");

			$this->session->set_flashdata("message", ['success', 'Berhasil Menghapus Data Pengguna', ' Berhasil']);
			$ck = $this->db->get_where("pengguna", ['kode_pengguna' => $id])->row_array();
			redirect(base_url('backoffice/pengguna/' . $lv[$ck['level']]));
		} catch (Exception $e) {
			$this->session->set_flashdata("message", ['danger', 'Gagal Menambah Data Pengguna', ' Gagal']);
			$ck = $this->db->get_where("pengguna", ['kode_pengguna' => $id])->row_array();
			redirect(base_url('backoffice/pengguna/' . $lv[$ck['level']]));
		}
	}
}
