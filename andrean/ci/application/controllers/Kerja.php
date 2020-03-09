<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kerja extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('DataModel');
		// if($this->input->post()){
		// 	$this->storeadd();
		// }
	}

	public function index()
	{
		$data['title'] = "Data kerja";
		$data['data'] = $this->DataModel->getResultData('kerja');
		$data['content'] = 'kerja/data';
		$this->load->view('layout/index', $data);
	}

	public function add()
	{
		$data['title'] = "Form Pekerja";
		$data['aksi'] = "1";
		$data['content'] = 'kerja/add';
		$this->load->view('layout/index', $data);
	}

	public function storeadd()
	{
		$data['title'] = "Proses Add";
		$arr = [
			'nama' => $this->input->post('nama', true),
			'no_hp' => $this->input->post('no_hp', true),
			'lowker' => $this->input->post('lowker', true),
			'create_at' => date('Y-m-d H:i:s')	
		];
		$cek = $this->DataModel->insert('kerja', $arr);
		if($cek){
			$this->session->set_flashdata("pesan",['Berhasil','Berhasil Menyimpan Data']);
			redirect(base_url('kerja'));
		}else {
			$this->session->set_flashdata("pesan", ['Gagal', 'Gagal Menyimpan Data']);
			redirect(base_url('kerja'));

		}

	}


	public function detail($id)
	{
		$data['title'] = "Detail Pekerja ";
		$data['data'] = $this->DataModel->getSingleData('kerja', $id);
		$data['title'] = "Detail Pekerja ". $data['data']['nama'];
		$data['content'] = 'kerja/detail';
		$this->load->view('layout/index', $data);
	}
	public function edit($id)
	{
		$data['title'] = "Edit Pekerja";
		$data['data'] = $this->DataModel->getSingleData('kerja', $id);
		$data['aksi'] = "2";
		$data['content'] = 'kerja/add';
		$this->load->view('layout/index', $data);
	}
	public function update($id)
	{
		$data['title'] = "Proses Edit";
		$arr = [
			'nama' => $this->input->post('nama', true),
			'no_hp' => $this->input->post('no_hp', true),
			'lowker' => $this->input->post('lowker', true),
		];
		$cek = $this->DataModel->update('kerja', $arr, 'kode_kerja', $id);
		if ($cek) {
			$this->session->set_flashdata("pesan", ['Berhasil', 'Berhasil Edit Data']);
			redirect(base_url('kerja'));
		} else {
			$this->session->set_flashdata("pesan", ['Gagal', 'Gagal Edit Data']);
			redirect(base_url('kerja'));
		}
	}

	public function delete($id)
	{
		$data['title'] = "Delete kerja";
		
		$cek = $this->DataModel->delete('kerja','kode_kerja', $id);
		if ($cek) {
			$this->session->set_flashdata("pesan", ['Berhasil', 'Berhasil Hapus Data']);
			redirect(base_url('kerja'));
		} else {
			$this->session->set_flashdata("pesan", ['Gagal', 'Gagal Hapus Data']);
			redirect(base_url('kerja'));
		}
	}
}
