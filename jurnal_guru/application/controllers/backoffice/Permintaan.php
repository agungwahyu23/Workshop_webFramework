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
		if ($this->uri->segment(3) == "add" && $_SERVER['REQUEST_METHOD'] == "POST") {
			$this->store();
		} else if ($this->uri->segment(3) == "edit" && $_SERVER['REQUEST_METHOD'] == "POST") {
			$this->update($this->uri->segment(4));
		}

	}
	public function index()
	{
		$data['title'] = "Data Permintaan Mengajar";
		$data['content'] = "permintaan/indexpermintaan";
        $data['data'] = $this->Maksi->getData("getpermintaan");

        $this->load->view('backend/index', $data);
    }
    public function delete($id)
	{
		try {
			$arr = [
				'status' => 0
			];
			$this->Maksi->updateData("permintaan", $arr, $id, "kode_req");

			$this->session->set_flashdata("message", ['success', 'Berhasil Menonaktifkan', ' Berhasil']);
			redirect(base_url("backoffice/permintaan"));
		} catch (Exception $e) {
			$this->session->set_flashdata("message", ['danger', 'Gagal Menonaktifkan', ' Gagal']);
			redirect(base_url("backoffice/permintaan"));
		}
	}
}