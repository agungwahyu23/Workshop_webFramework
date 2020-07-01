<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penarikan extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!$this->session->has_userdata('kode_pengguna') || $this->session->userdata('level')  != '1') {
			redirect(base_url());
		}
		if ($this->uri->segment(3) == "add" && $_SERVER['REQUEST_METHOD'] == "POST") {
			$this->store();
		}
	}
	public function index()
	{
		$data['title'] = "Data Penarikan";
		$data['content'] = "penarikan/indexpenarikan";
		$data['data'] = $this->Maksi->getData("getpenarikan");

		$this->load->view('backend/index', $data);
	}
	public function add()
	{
		$data['title'] = "Tambah Penarikan";
		$data['action'] = "Tambah Data";
		$data['content'] = "penarikan/addpenarikan";
		$data['dataguru'] = $this->Maksi->getData("getguru");
		$data['data'] = null;
		$this->load->view('backend/index', $data);
	}

	public function store()
	{
		try {

			$kode_guru = $this->input->post('kode_guru', TRUE);
			$jml = Input_helper::bersihkanangka($this->input->post('jml_penarikan', TRUE));
			$cekData = $this->db->get_where("guru", ['kode_guru' => $kode_guru])->row_array();
			if((int)$cekData['upah'] < $jml ){

				$this->session->set_flashdata("message", ['danger', 'Saldo Tidak Mencukupi', ' Gagal']);
				$this->add();
			}else {
				$kode = $this->Maksi->random_oke(16);
				$nonya = $this->Maksi->random_number(6);

				$arr = [
					'kode_reward' => $kode,
					'kode_guru' => $kode_guru,
					'keterangan' => "Penarikan Saldo #".$nonya,
					'jumlah' => $jml,
					'tipe' => 1,
					'create_at' => $this->input->post('tgl', TRUE).' '. $this->input->post('waktu', TRUE).':00',
					'create_by' => $this->session->userdata('kode_pengguna')
				];
				$this->Maksi->insertData("rw_reward", $arr);
				$this->session->set_flashdata("message", ['success', 'Berhasil Membuat Penarikan', ' Berhasil']);
				redirect(base_url("backoffice/penarikan"));

			}
		} catch (Exception $e) {
			$this->session->set_flashdata("message", ['danger', 'Gagal Menambah Data Penarikan', ' Gagal']);
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
