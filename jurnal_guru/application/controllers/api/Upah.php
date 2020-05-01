<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
class upah extends REST_Controller  {
	function __construct()
  	{
		parent::__construct();
	}

	public function data_get()
	{

		$kode = $this->input->get_request_header('token', TRUE);
		$cek = $this->Maksi->getDataSingle("detailtoken", $kode);
		if ($cek > 1) {

			$wer = " WHERE a.kode_guru = '$cek[akses_data]'";
			$data['title'] = "Data Riwayat Ppah";
			$data['data'] = $this->Maksi->getData("getriwayatupah", $wer);
			$data['respon'] = [
				"pesan" => "Berhasil",
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

		$this->response($data, $data['respon']['code']);
	}
}
