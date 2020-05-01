<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
class Dashboard extends REST_Controller  {

	function __construct()
  	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}


	public function guru_get()
	{
		$kode = $this->input->get_request_header('token', TRUE);
		$cek = $this->Maksi->getDataSingle("detailtoken", $kode);
		if ($cek > 1) {

			$data['biodata'] = $this->db->get_where('guru', ['kode_guru' => $cek['akses_data']])->row_array();
			$data['biodata']['upah'] = Response_helper::price($data['biodata']['upah']);
			$hariini = Response_helper::hari_ini();
			$cekset = Data_helper::getdatarow('tahun_ajaran', 'aktif', '1');
			$tdy = date('Y-m-d');
			$set = Data_helper::get_setting();
			$data['jadwal'] = $this->Maksi->getData("getjadwal", "where a.status = 1 and a.kode_guru = '$cek[akses_data]' and a.hari='$hariini' and a.kode_tahun='$cekset[kode_tahun]' and a.semester='$set[semester]' order by a.jam_awal asc");
			// $data['req_guru'] = $this->Maksi->getData("getreqguru", "where z.status = 1 and z.pick_by = '$cek[akses_data]' and a.kode_tahun='$cekset[kode_tahun]' order by a.jam_awal asc");
			$data['datamengajar'] = $this->Maksi->getData("getmengajar", "where h.kode_guru='$cek[akses_data]' and h.mulai like '%$tdy%' and h.status='1'  order by h.mulai desc");
			$data['tahun_ajaran'] = $cekset['tahun'];
			$data['respon'] = [
				"pesan" => "Berhasil",
				'status' => true,
				'code' => 200
			];
		}else {
			$data['respon'] = [
				"pesan" => "Invalid Token, Silahkan Login Kembali",
				'status' => false,
				'code' => 403
			];
			
		}

		$this->response($data, $data['respon']['code']);
	}

	
	public function siswa_get()
	{
		$kode = $this->input->get_request_header('token', TRUE);
		$cek = $this->Maksi->getDataSingle("detailtoken", $kode);
		if ($cek > 1) {

			$data['biodata'] = $this->Maksi->getDataSingle('getkelas', $cek['akses_data']);
			$hariini = Response_helper::hari_ini();
			$cekset = Data_helper::getdatarow('tahun_ajaran', 'aktif', '1');
			$set = Data_helper::get_setting();
			$data['jadwal'] = $this->Maksi->getData("getjadwal", "where a.status = 1 and a.kode_kelas = '$cek[akses_data]' and a.hari='$hariini' and a.kode_tahun='$cekset[kode_tahun]' and a.semester='$set[semester]' order by a.jam_awal asc");
			$wer = " WHERE a.kode_kelas = '$cek[akses_data]' and h.status='2' order by h.mulai desc";
				
			$data['mengajar'] = $this->Maksi->getData("getmengajar", $wer);
			$data['tahun_ajaran'] = $cekset['tahun'];
			$data['respon'] = [
				"pesan" => "Berhasil",
				'status' => true,
				'code' => 200
			];
		}else {
			$data['respon'] = [
				"pesan" => "Invalid Token, Silahkan Login Kembali",
				'status' => false,
				'code' => 403
			];
			
		}

		$this->response($data, $data['respon']['code']);
	}

	public function datahari_get()
	{
		$kode = $this->input->get_request_header('token', TRUE);
		$cek = $this->Maksi->getDataSingle("detailtoken", $kode);
		if ($cek > 1) {

				$data['data'] = $this->Maksi->getData("gethari","where aktif=1");	
			$data['respon'] = [
				"pesan" => "Berhasil",
				'status' => true,
				'code' => 200
			];
		}else {
			$data['respon'] = [
				"pesan" => "Invalid Token, Silahkan Login Kembali",
				'status' => false,
				'code' => 403
			];
			
		}

		$this->response($data, $data['respon']['code']);
	}
	
}