<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tahun extends CI_Controller
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
		$data['title'] = "Data Tahun Ajaran";
		$data['content'] = "tahun/indextahun";
		$data['data'] = $this->Maksi->getData("gettahun");

		$this->load->view('backend/index', $data);
	}
	public function add()
	{
		$data['title'] = "Tambah Tahun Ajaran";
		$data['action'] = "Tambah Data";
		$data['content'] = "tahun/addtahun";
		$data['data'] = null;
		$this->load->view('backend/index', $data);
	}

	public function store()
	{
		try {

			$kode = $this->Maksi->random_oke(16);

			$arr = [
				'kode_tahun' => $kode,
				'tahun' => $this->input->post('tahun', TRUE),
				'create_at' => date("Y-m-d H:i:s"),
				'create_by' => $this->session->userdata('kode_pengguna')
			];
			$this->Maksi->insertData("tahun_ajaran", $arr);
			$this->session->set_flashdata("message", ['success', 'Berhasil Menambah Data Tahun Ajaran', ' Berhasil']);
			redirect(base_url("backoffice/tahun"));
		} catch (Exception $e) {
			$this->session->set_flashdata("message", ['danger', 'Gagal Menambah Data Tahun Ajaran', ' Gagal']);
			$this->add();
		}
	}

	public function edit($id)
	{
		$data['title'] = "Edit Tahun Ajaran";
		$data['action'] = "Edit tahun";
		$data['content'] = "tahun/addtahun";
		$data['data'] = $this->db->get_where("tahun_ajaran", ['kode_tahun' => $id])->row_array();
		$this->load->view('backend/index', $data);
	}


	public function update($id)
	{
		try {
			$arr = [
				'tahun' => $this->input->post('tahun', TRUE),
			];
			$this->Maksi->updateData("tahun_ajaran", $arr, $id, "kode_tahun");

			$this->session->set_flashdata("message", ['success', 'Berhasil Mengedit Data Tahun Ajaran', ' Berhasil']);
			redirect(base_url("backoffice/tahun"));
		} catch (Exception $e) {
			$this->session->set_flashdata("message", ['danger', 'Gagal Mengedit Data Tahun Ajaran', ' Gagal']);
			$this->edit($id);
		}
	}

	public function delete($id)
	{
		try {
			$arr = [
				'status' => 0
			];
			$this->Maksi->updateData("tahun_ajaran", $arr, $id, "kode_tahun");

			$this->session->set_flashdata("message", ['success', 'Berhasil Menghapus Data Tahun Ajaran', ' Berhasil']);
			redirect(base_url("backoffice/tahun"));
		} catch (Exception $e) {
			$this->session->set_flashdata("message", ['danger', 'Gagal Menghapus Data Tahun Ajaran', ' Gagal']);
			redirect(base_url("backoffice/tahun"));
		}
	}
	public function aktifkan($id)
	{
		try {
			$arrlama = [
				'aktif' => 0
			];
			$this->Maksi->updateData("tahun_ajaran", $arrlama, $id, "kode_tahun !=");
			$arr = [
				'aktif' => 1
			];
			$this->Maksi->updateData("tahun_ajaran", $arr, $id, "kode_tahun");

			$this->session->set_flashdata("message", ['success', 'Berhasil Menghapus Data Tahun Ajaran', ' Berhasil']);
			redirect(base_url("backoffice/tahun"));
		} catch (Exception $e) {
			$this->session->set_flashdata("message", ['danger', 'Gagal Menghapus Data Tahun Ajaran', ' Gagal']);
			redirect(base_url("backoffice/tahun"));
		}
	}

}
