<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mapel extends CI_Controller
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
		$data['title'] = "Data Mata Pelajaran";
		$data['content'] = "mapel/indexmapel";
		$data['data'] = $this->Maksi->getData("getmapel");
		$this->load->view('backend/index', $data);
	}
	public function add()
	{
		$data['title'] = "Tambah Mapel";
		$data['action'] = "Tambah Data";
		$data['content'] = "mapel/addmapel";
		$data['data'] = null;
		$data['datamapel'] = $this->Maksi->getData('getmapel');
		$this->load->view('backend/index', $data);
	}

	public function store()
	{
		try {

			$kode = $this->Maksi->random_oke(16);

			$arr = [
                'kode_mapel' => $kode,
				'nama_mapel' => $this->input->post('nama_mapel', TRUE),
				'status' => $this->input->post('status', TRUE),
				'create_at' => date("Y-m-d H:i:s"),
				'create_by' => $this->session->userdata('kode_pengguna')
			];
			$this->Maksi->insertData("mapel", $arr);
			$this->session->set_flashdata("message", ['success', 'Berhasil Menambah Data Mata Pelajaran', ' Berhasil']);
			redirect(base_url("backoffice/mapel"));
		} catch (Exception $e) {
			$this->session->set_flashdata("message", ['danger', 'Gagal Menambah Data Mata Pelajaran', ' Gagal']);
			$this->add();
		}
	}

	public function edit($id)
	{
		$data['title'] = "Edit Mata Pelajaran";
		$data['action'] = "Edit Mata Pelajaran";
		$data['content'] = "mapel/addmapel";
		$data['data'] = $this->db->get_where("mapel", ['kode_mapel' => $id])->row_array();
		$data['datamapel'] = $this->Maksi->getData('getmapel');
		$this->load->view('backend/index', $data);
	}


	public function update($id)
	{
		try {
			$arr = [
				'nama_mapel' => $this->input->post('nama_mapel', TRUE),
			];
			$this->Maksi->updateData("mapel", $arr, $id, "kode_mapel");
			$this->session->set_flashdata("message", ['success', 'Berhasil Mengedit Data Mata Pelajaran', ' Berhasil']);
			redirect(base_url("backoffice/mapel"));
		} catch (Exception $e) {
			$this->session->set_flashdata("message", ['danger', 'Gagal Mengedit Data Mata Pelajaran', ' Gagal']);
			$this->edit($id);
		}
	}

	public function delete($id)
	{
		try {
			$arr = [
				'status' => 0
			];
			$this->Maksi->updateData("mapel", $arr, $id, "kode_mapel");

			$this->session->set_flashdata("message", ['success', 'Berhasil Menghapus Data Mata Pelajaran', ' Berhasil']);
			redirect(base_url("backoffice/mapel"));
		} catch (Exception $e) {
			$this->session->set_flashdata("message", ['danger', 'Gagal Menghapus Data Mata Pelajaran', ' Gagal']);
			redirect(base_url("backoffice/mapel"));
		}
	}

}