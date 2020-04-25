<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends CI_Controller
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
		$data['title'] = "Data Jadwal";
		$data['content'] = "jadwal/indexjadwal";
		$data['data'] = $this->Maksi->getData("getjadwal");

		$this->load->view('backend/index', $data);
	}
	public function add()
	{
		$data['title'] = "Tambah Jadwal";
		$data['action'] = "Tambah Data";
		$data['content'] = "jadwal/addjadwal";
        $data['data'] = null;
        $data['datakelas'] = $this->Maksi->getData('getkelas');
        $data['datamapel'] = $this->Maksi->getData('getmapel');
        $data['dataguru'] = $this->Maksi->getData('getguru');
        $data['datatahun'] = $this->Maksi->getData('gettahun');
        $data['datahari'] = $this->Maksi->getData('gethari');
		$this->load->view('backend/index', $data);
	}

	public function store()
	{
		try {

			$kode = $this->Maksi->random_oke(16);

			$arr = [
                'kode_jadwal' => $kode,
                'hari' => $this->input->post('hari', TRUE),
                'jam_awal' => $this->input->post('jam_awal', TRUE),
                'jam_akhir' => $this->input->post('jam_akhir', TRUE),
				'kode_tahun' => $this->input->post('tahun_ajaran', TRUE),
				'create_at' => date("Y-m-d H:i:s"),
			];
			$this->Maksi->insertData("jadwal", $arr);
			$this->session->set_flashdata("message", ['success', 'Berhasil Menambah Data jadwal', ' Berhasil']);
			redirect(base_url("backoffice/jadwal"));
		} catch (Exception $e) {
			$this->session->set_flashdata("message", ['danger', 'Gagal Menambah Data Jadwal', ' Gagal']);
			$this->add();
		}
	}

	public function edit($id)
	{
		$data['title'] = "Edit jadwal";
		$data['action'] = "Edit jadwal";
        $data['content'] = "jadwal/addjadwal";
        $data['datakelas'] = $this->Maksi->getData('getkelas');
        $data['datamapel'] = $this->Maksi->getData('getmapel');
        $data['dataguru'] = $this->Maksi->getData('getguru');
        $data['datatahun'] = $this->Maksi->getData('gettahun');
        $data['datahari'] = $this->Maksi->getData('gethari');
		$data['data'] = $this->db->get_where("jadwal", ['kode_jadwal' => $id])->row_array();
		$this->load->view('backend/index', $data);
	}


	public function update($id)
	{
		try {
			$arr = [
                'kode_kelas' => $this->input->post('kelas', TRUE),
                'kode_mapel' => $this->input->post('mapel', TRUE),
                'kode_guru' => $this->input->post('guru', TRUE),
				'kode_tahun' => $this->input->post('tahun_ajaran', TRUE),
                'semester' => $this->input->post('semester', TRUE),
                'hari' => $this->input->post('hari', TRUE),
                'jam_awal' => $this->input->post('jam_awal', TRUE),
                'jam_akhir' => $this->input->post('jam_akhir', TRUE),
			];
			$this->Maksi->updateData("jadwal", $arr, $id, "kode_jadwal");

			$this->session->set_flashdata("message", ['success', 'Berhasil Mengedit Data Jadwal', ' Berhasil']);
			redirect(base_url("backoffice/jadwal"));
		} catch (Exception $e) {
			$this->session->set_flashdata("message", ['danger', 'Gagal Mengedit Data Jadwal', ' Gagal']);
			$this->edit($id);
		}
	}

	public function delete($id)
	{
		try {
			$arr = [
				'status' => 0
			];
			$this->Maksi->updateData("jadwal", $arr, $id, "kode_jadwal");

			$this->session->set_flashdata("message", ['success', 'Berhasil Menghapus Data Jadwal', ' Berhasil']);
			redirect(base_url("backoffice/jadwal"));
		} catch (Exception $e) {
			$this->session->set_flashdata("message", ['danger', 'Gagal Menghapus Data Jadwal', ' Gagal']);
			redirect(base_url("backoffice/jadwal"));
		}
	}

}
