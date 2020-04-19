<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jurusan extends CI_Controller
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
		$data['title'] = "Data Jurusan";
		$data['content'] = "jurusan/indexjurusan";
		$data['data'] = $this->Maksi->getData("getjurusan");

		$this->load->view('backend/index', $data);
	}
	public function add()
	{
		$data['title'] = "Tambah Jurusan";
		$data['action'] = "Tambah Data";
		$data['content'] = "jurusan/addjurusan";
		$data['data'] = null;
		$this->load->view('backend/index', $data);
	}

	public function store()
	{
		try {

			$kode = $this->Maksi->random_oke(16);

			$arr = [
				'kode_jurusan' => $kode,
				'nama_jurusan' => $this->input->post('nama_jurusan', TRUE),
				'nama_singkat' => $this->input->post('nama_singkat', TRUE),
				'create_at' => date("Y-m-d H:i:s"),
				'create_by' => $this->session->userdata('kode_pengguna')
			];
			$this->Maksi->insertData("jurusan", $arr);
			$this->session->set_flashdata("message", ['success', 'Berhasil Menambah Data Jurusan', ' Berhasil']);
			redirect(base_url("backoffice/jurusan"));
		} catch (Exception $e) {
			$this->session->set_flashdata("message", ['danger', 'Gagal Menambah Data Jurusan', ' Gagal']);
			$this->add();
		}
	}

	public function edit($id)
	{
		$data['title'] = "Edit Jurusan";
		$data['action'] = "Edit Jurusan";
		$data['content'] = "jurusan/addjurusan";
		$data['data'] = $this->db->get_where("jurusan", ['kode_jurusan' => $id])->row_array();
		$this->load->view('backend/index', $data);
	}


	public function update($id)
	{
		try {
			$arr = [
				'nama_jurusan' => $this->input->post('nama_jurusan', TRUE),
				'nama_singkat' => $this->input->post('nama_singkat', TRUE),
			];
			$this->Maksi->updateData("jurusan", $arr, $id, "kode_jurusan");

			$this->session->set_flashdata("message", ['success', 'Berhasil Mengedit Data Jurusan', ' Berhasil']);
			redirect(base_url("backoffice/jurusan"));
		} catch (Exception $e) {
			$this->session->set_flashdata("message", ['danger', 'Gagal Mengedit Data Jurusan', ' Gagal']);
			$this->edit($id);
		}
	}

	public function delete($id)
	{
		try {
			$arr = [
				'status' => 0
			];
			$this->Maksi->updateData("jurusan", $arr, $id, "kode_jurusan");

			$this->session->set_flashdata("message", ['success', 'Berhasil Menghapus Data Jurusan', ' Berhasil']);
			redirect(base_url("backoffice/jurusan"));
		} catch (Exception $e) {
			$this->session->set_flashdata("message", ['danger', 'Gagal Menghapus Data Jurusan', ' Gagal']);
			redirect(base_url("backoffice/jurusan"));
		}
	}

}
