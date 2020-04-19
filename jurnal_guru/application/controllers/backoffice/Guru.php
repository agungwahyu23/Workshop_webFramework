<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
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
		$data['title'] = "Data Guru";
		$data['content'] = "guru/indexguru";
		$data['data'] = $this->Maksi->getData("getguru");

		$this->load->view('backend/index', $data);
	}
	public function add()
	{
		$data['title'] = "Tambah Guru";
		$data['action'] = "Tambah Data";
		$data['content'] = "guru/addguru";
		$data['data'] = null;
		$data['datajurusan'] = $this->Maksi->getData('getjurusan');
		$this->load->view('backend/index', $data);
	}

	public function store()
	{
		try {

			$kode = $this->Maksi->random_oke(16);

			$arr = [
                'kode_guru' => $kode,
				'kode_jurusan' => $this->input->post('jurusan', TRUE),
				'nama_guru' => $this->input->post('nama_guru', TRUE),
				'upah' => $this->input->post('upah', TRUE),
                'no_hp' => $this->input->post('no_hp', TRUE),
                'no_wa' => $this->input->post('no_wa', TRUE),
                'alamat' => $this->input->post('alamat', TRUE),
				'create_at' => date("Y-m-d H:i:s"),
				'create_by' => $this->session->userdata('kode_pengguna')
			];
			$this->Maksi->insertData("guru", $arr);
			$this->session->set_flashdata("message", ['success', 'Berhasil Menambah Data Guru', ' Berhasil']);
			redirect(base_url("backoffice/guru"));
		} catch (Exception $e) {
			$this->session->set_flashdata("message", ['danger', 'Gagal Menambah Data Guru', ' Gagal']);
			$this->add();
		}
	}

	public function edit($id)
	{
		$data['title'] = "Edit Guru";
		$data['action'] = "Edit Guru";
		$data['content'] = "guru/addguru";
		$data['data'] = $this->db->get_where("guru", ['kode_guru' => $id])->row_array();
		$data['datajurusan'] = $this->Maksi->getData('getjurusan');
		$this->load->view('backend/index', $data);
	}


	public function update($id)
	{
		try {
			$arr = [
				'nama_guru' => $this->input->post('nama_guru', TRUE),
				'upah' => $this->input->post('upah', TRUE),
                'no_hp' => $this->input->post('no_hp', TRUE),
                'no_wa' => $this->input->post('no_wa', TRUE),
                'alamat' => $this->input->post('alamat', TRUE),
			];
			$this->Maksi->updateData("guru", $arr, $id, "kode_guru");

			$this->session->set_flashdata("message", ['success', 'Berhasil Mengedit Data Guru', ' Berhasil']);
			redirect(base_url("backoffice/guru"));
		} catch (Exception $e) {
			$this->session->set_flashdata("message", ['danger', 'Gagal Mengedit Data Guru', ' Gagal']);
			$this->edit($id);
		}
	}

	public function delete($id)
	{
		try {
			$arr = [
				'status' => 0
			];
			$this->Maksi->updateData("guru", $arr, $id, "kode_guru");

			$this->session->set_flashdata("message", ['success', 'Berhasil Menghapus Data Guru', ' Berhasil']);
			redirect(base_url("backoffice/guru"));
		} catch (Exception $e) {
			$this->session->set_flashdata("message", ['danger', 'Gagal Menghapus Data Guru', ' Gagal']);
			redirect(base_url("backoffice/guru"));
		}
	}

}