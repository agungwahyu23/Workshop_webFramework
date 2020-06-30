<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Izin extends CI_Controller
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
		$data['title'] = "Data Izin Guru";
		$data['content'] = "guru/addguru";
		$data['data'] = $this->Maksi->getData("getijin");

		$this->load->view('backend/index', $data);
    }
    public function store()
	{
		try {

			$kode = $this->Maksi->random_oke(16);

			$arr = [
				'kode_ijin' => $kodeajar,
				'kode_guru' => $cek['akses_data'],
				'create_by' => $cek['kode_pengguna'],
				'create_at' => date("Y-m-d H:i:s"),
				'awal' => $this->input->post('awal', TRUE),
				'akhir' => $this->input->post('akhir', TRUE),
				'keterangan' => $this->input->post('keterangan', TRUE),
				'lampiran' => $gambar
			];
			$this->Maksi->insertData("ijin_guru", $arr);
			$data['respon'] = [
				"pesan" => "Berhasil Membuat Izin. Harap Menunggu Konfirmasi Admin",
				'status' => true,
				'code' => 200
            ];
        } else {
			$data['respon'] = [
				"pesan" => "Invalid Token",
				'status' => false,
				'code' => 403
			];
		}
	}
}