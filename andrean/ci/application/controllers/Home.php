<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('DataModel');
	}

	public function index()
	{
		$data['data'] = $this->DataModel->getData();
		// echo print_r($data);
		// echo "Selamat Datang";
		$this->load->view('home/home', $data);
	}
}
