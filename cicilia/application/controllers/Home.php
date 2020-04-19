<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
		$data['title'] = 'Beranda';
		$data['content'] = 'home/home';
		$this->load->view('layout/index', $data);
	}

	public function kontak()
	{
		$data['title'] = 'Kontak';
		$data['content'] = 'home/kontak';
		$this->load->view('layout/index', $data);
	}

	public function tentang()
	{
		$data['title'] = 'Tentang';
		$data['content'] = 'home/tentang';
		$this->load->view('layout/index', $data);
	}

	public function add(){
		$data['title'] = "Form Upload";
		$this->load->view('home/add',$data);
	}

	public function storeadd()
	{
		$data['title'] = "Form Upload";
		$this->load->library('upload');
		$config['upload_path'] = './assets/image/';
		$config['allowed_types'] = 'gif|png|jpg';
		$config['max_size'] = 200;
		$this->upload->initialize($config);
		if($this->upload->do_upload('foto')){
			$data['path'] = 'assets/image/'.$this->upload->data()['file_name'];
		}else{
			$data['error'] =  $this->upload->display_errors();
		}
		$this->load->view('home/add', $data);

	}
}
