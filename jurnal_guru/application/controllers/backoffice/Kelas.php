<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!$this->session->has_userdata('kode_pengguna') || $this->session->userdata('level')  != '1') {
			redirect(base_url());
		}
		if ($this->uri->segment(3) == "add" && $_SERVER['REQUEST_METHOD'] == "POST") {
			$this->store();
		} else if ($this->uri->segment(3) == "edit" && $_SERVER['REQUEST_METHOD'] == "POST") {
			$this->update($this->uri->segment(4));
		}
	}
	public function index()
	{
		$data['title'] = "Data Kelas";
		$data['content'] = "kelas/indexkelas";
		$data['data'] = $this->Maksi->getData("getkelas");

		$this->load->view('backend/index', $data);
	}
	public function add()
	{
		$data['title'] = "Tambah Kelas";
		$data['action'] = "Tambah Data";
		$data['content'] = "kelas/addkelas";
		$data['datajurusan'] = $this->Maksi->getData("getjurusan");
		$data['data'] = null;
		$this->load->view('backend/index', $data);
	}

	public function store()
	{
		try {

			$username = $this->input->post('username', TRUE);
			$cekData = $this->db->get_where("pengguna", ['email' => $username,'status' => 1])->row_array();
			if($cekData > 1 ){

				$this->session->set_flashdata("message", ['danger', 'Username Telah Di Gunakan', ' Gagal']);
				$this->add();
			}else {
				$kode = $this->Maksi->random_oke(16);

				$arr = [
					'kode_kelas' => $kode,
					'kode_jurusan' => $this->input->post('jurusan', TRUE),
					'no_kelas' => $this->input->post('no_kelas', TRUE),
					'rombel' => $this->input->post('rombel', TRUE),
					'create_at' => date("Y-m-d H:i:s"),
					'create_by' => $this->session->userdata('kode_pengguna')
				];

				$getjurusan = $this->db->get_where("jurusan", ['kode_jurusan' => $arr['kode_jurusan']])->row_array();
				$kodeuser = $this->Maksi->random_oke(32);
				$arruser =
					[
						'kode_pengguna' => $kodeuser,
						'akses_data' => $arr['kode_kelas'],
						'nama_pengguna' => "Siswa Kelas ". $arr['no_kelas'].' '. $getjurusan['nama_singkat'].' '. $arr['rombel'],
						'email' => $username,
						'password' => password_hash($username, PASSWORD_BCRYPT),
						'level' => 3,
						'create_at' => date('Y-m-d H:i:s')
					];
				$this->Maksi->insertData("pengguna", $arruser);
				$this->Maksi->insertData("kelas", $arr);
				$this->session->set_flashdata("message", ['success', 'Berhasil Menambah Data kelas', ' Berhasil']);
				redirect(base_url("backoffice/kelas"));

			}
		} catch (Exception $e) {
			$this->session->set_flashdata("message", ['danger', 'Gagal Menambah Data kelas', ' Gagal']);
			$this->add();
		}
	}

	public function edit($id)
	{
		$data['title'] = "Edit Kelas";
		$data['action'] = "Edit Kelas";
		$data['content'] = "kelas/addkelas";
		$data['datajurusan'] = $this->Maksi->getData("getjurusan");
		$data['data'] = $this->db->get_where("kelas", ['kode_kelas' => $id])->row_array();
		$this->load->view('backend/index', $data);
	}


	public function update($id)
	{
		try {
			$arr = [
				'kode_jurusan' => $this->input->post('jurusan', TRUE),
				'no_kelas' => $this->input->post('no_kelas', TRUE),
				'rombel' => $this->input->post('rombel', TRUE),
			];
			$this->Maksi->updateData("kelas", $arr, $id, "kode_kelas");

			$this->session->set_flashdata("message", ['success', 'Berhasil Mengedit Data Kelas', ' Berhasil']);
			redirect(base_url("backoffice/kelas"));
		} catch (Exception $e) {
			$this->session->set_flashdata("message", ['danger', 'Gagal Mengedit Data Kelas', ' Gagal']);
			$this->edit($id);
		}
	}

	public function delete($id)
	{
		try {
			$arr = [
				'status' => 0
			];
			$this->Maksi->updateData("kelas", $arr, $id, "kode_kelas");

			$this->session->set_flashdata("message", ['success', 'Berhasil Menghapus Data Kelas', ' Berhasil']);
			redirect(base_url("backoffice/kelas"));
		} catch (Exception $e) {
			$this->session->set_flashdata("message", ['danger', 'Gagal Menghapus Data Kelas', ' Gagal']);
			redirect(base_url("backoffice/kelas"));
		}
	}

}
