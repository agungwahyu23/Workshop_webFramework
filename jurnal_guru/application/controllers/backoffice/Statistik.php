<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Statistik extends CI_Controller
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
		$data['title'] = "Statistik Guru";
		$data['content'] = "guru/addguru";
        $data['data'] = $this->Maksi->getData("getstatistik");
        
		$this->load->view('backend/index', $data);	
    }
    public function store()
	{
		try {

			$kode = $this->Maksi->random_oke(16);

			$arr = [
                'kode_guru' => $kode,
				'kode_tahun' => $this->input->post('tahun_ajaran', TRUE),
				
			];
			$this->Maksi->insertData("guru", $arr);
			$this->session->set_flashdata("message", ['success', 'Berhasil Menambah Data Guru', ' Berhasil']);
			redirect(base_url("backoffice/guru/statistik"));
		} catch (Exception $e) {
			$this->session->set_flashdata("message", ['danger', 'Gagal Menambah Data Guru', ' Gagal']);
			$this->add();
		}
	}
	
}