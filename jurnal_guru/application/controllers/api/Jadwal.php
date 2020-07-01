<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
class Jadwal extends REST_Controller  {
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
			$set = Data_helper::get_setting();

			$wer = "where a.status = 1 and " . ($cek['level'] == '2' ? 'a.kode_guru' : 'a.kode_kelas') . " = '$cek[akses_data]' and a.kode_tahun='$cekset[kode_tahun]' and a.semester='$set[semester]' and g.aktif='1' order by g.urutan,a.jam_awal asc";
			$data['title'] = "Data Jadwal ";
			$data['data'] = $this->Maksi->getData("getjadwal", $wer);
			$data['datahari'] = $this->Maksi->getData("gethari","where aktif=1");
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

			$wer = "where a.status = 1 and a.kode_jadwal='$id' and a.kode_tahun='$cekset[kode_tahun]' and g.aktif='1'";
			$data['title'] = "Data Jadwal ";
			$data['data'] = $this->Maksi->getDataSingle("getjadwal", $wer);

			$tdy = date('Y-m-d H:i:s');
			$kdguru = $data['data']['kode_guru'];
			$cekguru = $this->db->query("SELECT count(*) as jml from ijin_guru where kode_guru='$kdguru' and awal <= '$tdy' and akhir >= '$tdy' and `status` ='2'")->row_array();
			$data['guruada'] = ((int) $cekguru['jml'] > 0 ? false : true);
			$nwtdy = date('Y-m-d');
			$d = strtotime("today");
			$start_week = strtotime("last sunday midnight",$d);
			$end_week = strtotime("next saturday",$d);
			$start = date("Y-m-d",$start_week).' 00:00:01'; 
			$end = date("Y-m-d",$end_week).' 23:59:59';  
			$data['timenow'] = date('H:i:s');
			$data['tdynow'] = Response_helper::hari_ini();
			// $data['bisacheckin'] = Response_helper::bandingkanWaktu($data['data']['jam_awal'], $data['data']['jam_akhir'], $data['timenow']);
			$data['bisacheckin'] = ($data['data']['hari'] == $data['tdynow'] && Response_helper::bandingkanWaktu($data['data']['jam_awal'], $data['data']['jam_akhir'], $data['timenow']));
			$data['mengajar'] = $this->Maksi->getDataSingle("getmengajar", " WHERE h.kode_jadwal='$id' and h.mulai >= '$start' and h.akhir <= '$end' and (h.status != 4 and h.status != 5)");
			$data['cekaksesguru'] = ($cek['akses_data'] == $data['mengajar']['kode_guru'] ? '1' : '0');
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

		
}
