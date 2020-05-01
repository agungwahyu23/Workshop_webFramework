<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mengajar extends CI_Controller
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

		$this->load->model("Maksi");
    }
    public function index()
    {
        $data['title'] = "Data Mengajar";
		$data['content'] = "mengajar/indexmengajar";
		$data['data'] = $this->Maksi->getData("getmengajar");
		$data['level'] = '1';
		$this->load->view('backend/index', $data);
    }
    public function 