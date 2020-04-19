<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artikel extends CI_Controller {

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
		$data['title'] = "Data Artikel";
		$data['data'] = $this->DataModel->getResultData('artikel');
		$data['content'] = 'artikel/data';
		$this->load->view('layout/index', $data);
	}

	public function add()
	{
		$data['title'] = "Form Artikel";
		$data['aksi'] = "1";
		$data['content'] = 'artikel/add';
		$this->load->view('layout/index', $data);
	}

	public function storeadd()
	{
		$data['title'] = "Proses Add";
		$arr = [
			'judul' => $this->input->post('judul', true),
			'penulis' => $this->input->post('penulis', true),
			'deskripsi' => $this->input->post('deskripsi', true),
			'create_at' => date('Y-m-d H:i:s')	
		];
		$cek = $this->DataModel->insert('artikel', $arr);
		if($cek){
			$this->session->set_flashdata("pesan",['Berhasil','Berhasil Menyimpan Data']);
			redirect(base_url('artikel'));
		}else {
			$this->session->set_flashdata("pesan", ['Gagal', 'Gagal Menyimpan Data']);
			redirect(base_url('artikel'));

		}

	}


	public function detail($id)
	{
		$data['title'] = "Detail Artikel ";
		$data['data'] = $this->DataModel->getSingleData('artikel', $id);
		$data['title'] = "Detail Artikel ". $data['data']['judul'];
		$data['content'] = 'artikel/detail';
		$this->load->view('layout/index', $data);
	}
	public function edit($id)
	{
		$data['title'] = "Edit Artikel";
		$data['data'] = $this->DataModel->getSingleData('artikel', $id);
		$data['aksi'] = "2";
		$data['content'] = 'artikel/add';
		$this->load->view('layout/index', $data);
	}
	public function update($id)
	{
		$data['title'] = "Proses Edit";
		$arr = [
			'judul' => $this->input->post('judul', true),
			'penulis' => $this->input->post('penulis', true),
			'deskripsi' => $this->input->post('deskripsi', true),
		];
		$cek = $this->DataModel->update('artikel', $arr, 'kode_artikel', $id);
		if ($cek) {
			$this->session->set_flashdata("pesan", ['Berhasil', 'Berhasil Edit Data']);
			redirect(base_url('artikel'));
		} else {
			$this->session->set_flashdata("pesan", ['Gagal', 'Gagal Edit Data']);
			redirect(base_url('artikel'));
		}
	}

	public function delete($id)
	{
		$data['title'] = "Delete Artikel";
		
		$cek = $this->DataModel->delete('artikel','kode_artikel', $id);
		if ($cek) {
			$this->session->set_flashdata("pesan", ['Berhasil', 'Berhasil Hapus Data']);
			redirect(base_url('artikel'));
		} else {
			$this->session->set_flashdata("pesan", ['Gagal', 'Gagal Hapus Data']);
			redirect(base_url('artikel'));
		}
	}
}
