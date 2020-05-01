<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
class Ijin extends REST_Controller  {
	function __construct()
  	{
		parent::__construct();
	}

	public function data_get()
	{

		$kode = $this->input->get_request_header('token', TRUE);
		$cek = $this->Maksi->getDataSingle("detailtoken", $kode);
		if ($cek > 1) {

			$wer = " WHERE a.kode_guru = '$cek[akses_data]' order by a.create_at desc";
			$data['title'] = "Data Izin Guru";
			$data['data'] = $this->Maksi->getData("getijin", $wer);
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
	public function buat_post()
	{

		$kode = $this->input->get_request_header('token', TRUE);
		$cek = $this->Maksi->getDataSingle("detailtoken", $kode);
		if ($cek > 1) {

			$gambar = DEFAULT_PATH;
			
			$this->load->library("upload");
			$config['upload_path'] = './assets/upload/ijin/';
			$config['allowed_types'] = 'jpg|png|jpeg|bmp';
			$config['encrypt_name'] = TRUE;
			$this->upload->initialize($config);
			if (!empty($_FILES['lampiran']['name'])) {

				if ($this->upload->do_upload('lampiran')) {
					$gbr = $this->upload->data();

					$gambar = "assets/upload/ijin/" . $gbr['file_name'];
				}
			}
			$kodeajar = $this->Maksi->random_oke(16);

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

		$this->response($data, $data['respon']['code']);
	}
	public function detail_get($id)
	{

		$kode = $this->input->get_request_header('token', TRUE);
		$cek = $this->Maksi->getDataSingle("detailtoken", $kode);
		if ($cek > 1) {

			$wer = " WHERE a.kode_ijin = '$id'";
			$dat = $this->Maksi->getDataSingle("getijin", $wer);
			if($cek['level'] == '1' || $dat['create_by'] == $cek['kode_pengguna']){
				$data['data'] = $dat;
				$data['respon'] = [
					"pesan" => "Berhasil ",
					'status' => true,
					'code' => 200
				];
			}else{
				$data['data'] = null;
				$data['respon'] = [
					"pesan" => "Anda Tidak Memilik Akses ",
					'status' => false,
					'code' => 403
				];
			}
		} else {
			$data['respon'] = [
				"pesan" => "Invalid Token",
				'status' => false,
				'code' => 403
			];
		}

		$this->response($data, $data['respon']['code']);
	}

	
	public function batalkan_delete($id)
	{

		$kode = $this->input->get_request_header('token', TRUE);
		$cek = $this->Maksi->getDataSingle("detailtoken", $kode);
		if ($cek > 1) {

			$wer = " WHERE a.kode_ijin = '$id'";
			$dat = $this->Maksi->getDataSingle("getijin", $wer);
			if($cek['level'] == '1' || $dat['create_by'] == $cek['kode_pengguna']){
				$this->Maksi->updateData('ijin_guru',['status' => 0], $id, 'kode_ijin');
				$data['respon'] = [
					"pesan" => "Berhasil Membatalkan Izin",
					'status' => true,
					'code' => 200
				];
			}else{
				$data['respon'] = [
					"pesan" => "Anda Tidak Memilik Akses ",
					'status' => false,
					'code' => 403
				];
			}
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
