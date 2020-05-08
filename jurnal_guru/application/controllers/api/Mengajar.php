<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
class Mengajar extends REST_Controller  {
	function __construct()
  	{
		parent::__construct();
	}

	public function data_get()
	{

		$kode = $this->input->get_request_header('token', TRUE);
		$cek = $this->Maksi->getDataSingle("detailtoken", $kode);
		if ($cek > 1) {

			$cekset = Data_helper::getdatarow('tahun_ajaran', 'aktif', '1');
			$tipe = $this->get('tipe');
			$keyone = $this->get('keyone');
			$keytwo = $this->get('keytwo');
			$subtipe = $this->get('subtipe');
			$title = "Data Mengajar ";
			$tdy = date('Y-m-d');
			$wer = "";
			if($tipe == 1){
				$keyone .= ' 00:00:01';
				$keytwo .= ' 23:59:59';
				$wer .= " WHERE h.mulai >= '$keyone' and h.mulai <= '$keytwo' ";
				if($this->get('keyone') != $tdy  && $this->get('keytwo') != $tdy){
					$title .= "Dari Tanggal " . Response_helper::tanggal($this->get('keyone')) . ' s/d ' . Response_helper::tanggal($this->get('keytwo'));

				}else{
					$title .= "Hari Ini";
				}
				$keysub = $cek['akses_data'];	
				if($subtipe == 1){
					$wer .= "and h.kode_guru='$keysub' order by h.mulai desc";
				}else if($subtipe == 2){
					$wer .= "and a.kode_kelas='$keysub' order by h.mulai desc";
					
				}
			}else if($tipe == 2){
				$wer .= " WHERE h.kode_jadwal = '$keyone' order by h.mulai desc";
				
			}
			$data['title'] = $title;
			$data['data'] = $this->Maksi->getData("getmengajar", $wer);
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

		$this->response($data, 200);
	}
	public function detail_get($id)
	{

		$kode = $this->input->get_request_header('token', TRUE);
		$cek = $this->Maksi->getDataSingle("detailtoken", $kode);
		if ($cek > 1) {

			$cekset = Data_helper::getdatarow('tahun_ajaran', 'aktif', '1');

			$data['data'] = $this->Maksi->getDataSingle("getmengajar", " WHERE h.kode_mengajar='$id'");
			$data['respon'] = [
				"pesan" => "Berhasil ",
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

		$this->response($data, 200);
	}


	public function cekin_post($id)
	{

		$kode = $this->input->get_request_header('token', TRUE);
		$cek = $this->Maksi->getDataSingle("detailtoken", $kode);
		if ($cek > 1) {

			if($cek['level'] == '2' || $cek['level'] == '1'){

			$hariini = Response_helper::hari_ini();
			$cekset = Data_helper::getdatarow('tahun_ajaran', 'aktif', '1');

			$tmy = date('H:i:').'00';
			$wer = "where a.status = 1 and a.kode_jadwal='$id' and a.kode_tahun='$cekset[kode_tahun]' and g.aktif='1' and a.this_week = '0' and a.hari = '$hariini' and  a.jam_awal <= '$tmy'  and  a.jam_akhir >= '$tmy'";
			$datjadwal = $this->Maksi->getDataSingle("getjadwal", $wer);
				if($datjadwal > 0){
					$kodeajar = $this->Maksi->random_oke(16);

					$arr = [
						'kode_mengajar' => $kodeajar,
						'kode_jadwal' => $id,
						'kode_guru' => $cek['akses_data'],
						'mulai' => date("Y-m-d H:i:s"),
						'tipe' => 1,
						'status' => 1,
						'materi' => $this->input->post('materi', TRUE),
					];
					$this->Maksi->insertData("mengajar", $arr);

					$upthis = [
						'this_week' => 2
					];
					$this->Maksi->updateData("jadwal", $upthis,$id, 'kode_jadwal');
					$upthisku = [
						'status' => 0
					];
					$cek = $this->db->update("req_guru", $upthisku, ['kode_jadwal' => $id, 'status' => 1]);
					$data['respon'] = [
						"pesan" => "Berhasil Check-in Kelas",
						'status' => true,
						'code' => 200
					];
				}else{
					$data['respon'] = [
						"pesan" => "Saat Ini Bukan Waktunya Anda Mengajar / Anda Telah Check-in",
						'status' => false,
						'code' => 403
					];
				}

			}else{
			$data['respon'] = [
				"pesan" => "Tidak Ada Akses ",
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

		$this->response($data, 200);
	}
		
	public function selesaikan_put($id)
	{

		$kode = $this->input->get_request_header('token', TRUE);
		$cek = $this->Maksi->getDataSingle("detailtoken", $kode);
		if ($cek > 1) {

			if($cek['level'] == '2' || $cek['level'] == '1'){

			$getajar = $this->db->get_where('mengajar',['kode_mengajar' => $id])->row_array();
			$hariini = Response_helper::hari_ini();
			$cekset = Data_helper::getdatarow('tahun_ajaran', 'aktif', '1');

			$tmy = date('H:i:').'00';
			$kodejadwal = $getajar['kode_jadwal'];
			$wer = "where a.status = 1 and a.kode_jadwal='$kodejadwal' and a.kode_tahun='$cekset[kode_tahun]' and g.aktif='1' and a.hari = '$hariini'";
			$datjadwal = $this->Maksi->getDataSingle("getjadwal", $wer);
				if($getajar['status'] == '1'){
					$arr = [
						'status' => 2,
						'akhir' => date("Y-m-d H:i:s"),
					];
					$this->Maksi->updateData("mengajar", $arr,$id, 'kode_mengajar');

					$upthis = [
						'this_week' => 1
					];
					$this->Maksi->updateData("jadwal", $upthis,$kodejadwal, 'kode_jadwal');

					$data['respon'] = [
						"pesan" => "Berhasil Menyelesaikan Jadwal",
						'status' => true,
						'code' => 200
					];
				}else if($getajar['status'] == '2' || $getajar['status'] == '3'){
					$data['respon'] = [
						"pesan" => "Jadwal Ini Telah Anda Selesaikan",
						'status' => false,
						'code' => 403
					];
				}else if($datjadwal['this_week'] == '0'){
					$data['respon'] = [
						"pesan" => "Anda Belum Check-in",
						'status' => false,
						'code' => 403
					];
				}else{
					$data['respon'] = [
						"pesan" => "Terjadi Kesalahan",
						'status' => false,
						'code' => 500
					];
				}

			}else{
			$data['respon'] = [
				"pesan" => "Tidak Ada Akses ",
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

		$this->response($data, 200);
	}
		
	public function berirate_post($id)
	{

		$kode = $this->input->get_request_header('token', TRUE);
		$cek = $this->Maksi->getDataSingle("detailtoken", $kode);
		if ($cek > 1) {

			if($cek['level'] == '3' || $cek['level'] == '1'){

			$getajar = $this->db->get_where('mengajar',['kode_mengajar' => $id])->row_array();
				if($getajar['status'] == '2'){
					$arr = [
						'status' => 3,
						'rating' => $this->input->post('rating', true),
						'catatan_siswa' => $this->input->post('catatan', true),
					];
					$this->Maksi->updateData("mengajar", $arr,$id, 'kode_mengajar');
					$data['respon'] = [
						"pesan" => "Berhasil Memberi Rating ",
						'status' => true,
						'code' => 200
					];
				}else{
					$data['respon'] = [
						"pesan" => "Anda Telah Memberikan Rating",
						'status' => false,
						'code' => 403
					];
				}
			}else{
			$data['respon'] = [
				"pesan" => "Tidak Ada Akses ",
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

		$this->response($data, 200);
	}
		
}
