<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Controller
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

		$this->load->model("mpengguna");
	}
	public function index()
	{
		$data['title'] = "Data Pengguna";
		$data['content'] = "pengguna/indexpengguna";
		$data['data'] = $this->Maksi->getData("getpengguna");
		$data['level'] = '1';
		$this->load->view('backend/index', $data);
	}

	public function admin()
	{
		$data['title'] = "Data Pengguna Admin";
		$data['content'] = "pengguna/indexpengguna";
		$data['data'] = $this->mpengguna->admin();
        $data['level'] = '1';
        $this->load->view("backend/index", $data);
	}

	public function guru()
	{
		$data['title'] = "Data Pengguna Guru";
		$data['content'] = "pengguna/indexpengguna";
		$data['data'] = $this->mpengguna->guru();
        $data['level'] = '2';
        $this->load->view("backend/index", $data);
	}

	public function siswa()
	{
		$data['title'] = "Data Pengguna Siswa";
		$data['content'] = "pengguna/indexpengguna";
		$data['data'] = $this->mpengguna->siswa();
        $data['level'] = '3';
        $this->load->view("backend/index", $data);
	}
	
	public function add()
	{
		$data['title'] = "Tambah Pengguna Admin";
		$data['action'] = "Tambah Data";
		$data['content'] = "pengguna/formpengguna";
		$data['data'] = null;
		$data['level'] = '';
		$this->load->view('backend/index', $data);
	}

	public function store()
	{
		try {

			$kode = $this->Maksi->random_oke(16);

			$arr = [
				'kode_kelas' => $kode,
				'kode_jurusan' => $this->input->post('jurusan', TRUE),
                'no_kelas' => $this->input->post('no_kelas', TRUE),
                'rombel' => $this->input->post('rombel', TRUE),
				'create_at' => date("Y-m-d H:i:s"),
				'create_by' => $this->session->userdata('kode_pengguna')
			];
			$this->Maksi->insertData("kelas", $arr);
			$this->session->set_flashdata("message", ['success', 'Berhasil Menambah Data Kelas', ' Berhasil']);
			redirect(base_url("backoffice/kelas"));
		} catch (Exception $e) {
			$this->session->set_flashdata("message", ['danger', 'Gagal Menambah Data Kelas', ' Gagal']);
			$this->add();
		}
	}

	public function edit($id)
	{
		$data['title'] = "Edit Kelas";
		$data['action'] = "Edit Kelas";
        $data['content'] = "kelas/addkelas";
        $data['datajurusan'] = $this->Maksi->getData('getjurusan');
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
