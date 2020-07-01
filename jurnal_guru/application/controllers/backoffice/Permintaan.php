<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Permintaan extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!$this->session->has_userdata('kode_pengguna') || $this->session->userdata('level')  != '1') {
			redirect(base_url());
		}
	}
	public function index()
	{
		$data['title'] = "Data Permintaan Mengajar";
		$data['content'] = "permintaan/indexpermintaan";
		$cekset = Data_helper::getdatarow('tahun_ajaran', 'aktif', '1');
		$wer = " WHERE a.kode_tahun='$cekset[kode_tahun]' order by h.create_at desc";
		$data['data'] = $this->Maksi->getData("getpermintaan", $wer);

		$this->load->view('backend/index', $data);
	}

	public function delete($id)
	{
		try {
			$this->Maksi->deleteData("req_guru","kode_req", $id);

			$this->session->set_flashdata("message", ['success', 'Berhasil Menghapus Permintaan Mengajar', ' Berhasil']);
			redirect(base_url("backoffice/permintaan"));
		} catch (Exception $e) {
			$this->session->set_flashdata("message", ['danger', 'Gagal Menghapus Permintaan Mengajar', ' Gagal']);
			redirect(base_url("backoffice/permintaan"));
		}
	}

}
