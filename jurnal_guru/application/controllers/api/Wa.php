<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
class Wa extends REST_Controller
{
	function __construct()
  	{
		parent::__construct();
	}

	public function index()
	{
		echo "sukses";
	}

	public function jadwalharian_get($kode)
	{

		// $kode = $this->input->get_request_header('token', TRUE);
		$cek = $this->db->get_where('guru',['no_wa' => $kode,'status' => 1])->row_array();
		if ($cek > 1) {

			$cekset = Data_helper::getdatarow('tahun_ajaran', 'aktif', '1');
			$set = Data_helper::get_setting();

			$hariini = Response_helper::hari_ini();
			$data['title'] = "Data Jadwal Hari Ini ";
			$data['jadwal'] = $this->Maksi->getData("getjadwal", "where a.status = 1 and a.kode_guru = '$cek[kode_guru]' and a.hari='$hariini' and a.kode_tahun='$cekset[kode_tahun]' and a.semester='$set[semester]' order by a.jam_awal asc");
			$data['respon'] = [
				"pesan" => "Berhasil",
				'status' => true,
				'code' => 200
			];
		} else {
			$data['respon'] = [
				"pesan" => "Maaf Anda Tidak Memiliki Akses Ke Menu Yang Anda Buka",
				'status' => false,
				'code' => 200
			];
		}

		$this->response($data, $data['respon']['code']);
	}

	public function jadwalall_get($kode)
	{

		// $kode = $this->input->get_request_header('token', TRUE);
		$cek = $this->db->get_where('guru', ['no_wa' => $kode, 'status' => 1])->row_array();
		if ($cek > 1) {

			$cekset = Data_helper::getdatarow('tahun_ajaran', 'aktif', '1');
			$set = Data_helper::get_setting();

			$data['title'] = "Jadwal Lengkap Anda ";

			$dat = [];
			$datahari = $this->Maksi->getData("gethari", "where aktif=1");
			foreach ($datahari as $vl) {
				$datjadwal = $this->Maksi->getData("getjadwal", "where a.status = 1 and a.kode_guru = '$cek[kode_guru]' and a.hari='$vl[kode_hari]' and a.kode_tahun='$cekset[kode_tahun]' and a.semester='$set[semester]' order by a.jam_awal asc");
				$dat[] = [
					'hari' => $vl['kode_hari'],
					'datanya' => $datjadwal
				];
			}
			$data['data'] = $dat;
			$data['respon'] = [
				"pesan" => "Berhasil",
				'status' => true,
				'code' => 200
			];
		} else {
			$data['respon'] = [
				"pesan" => "Maaf Anda Tidak Memiliki Akses Ke Menu Yang Anda Buka",
				'status' => false,
				'code' => 200
			];
		}

		$this->response($data, $data['respon']['code']);
	}

	public function profil_get($kode)
	{

		// $kode = $this->input->get_request_header('token', TRUE);
		$cek = $this->Maksi->getDataSingle("detailguru", $kode);
		if ($cek > 1) {

			$cekset = Data_helper::getdatarow('tahun_ajaran', 'aktif', '1');
			$set = Data_helper::get_setting();
			$data['title'] = "Profil Anda";
			$data['data'] = [
				'nama' => $cek['nama_guru'],
				'saldo' => Response_helper::price($cek['upah']),
				'rating' => $cek['avgrating'],
				'app_name' => $set['app_name'],
				'semester' => $set['semester'],
				'gaji_lembur' => Response_helper::price($set['gaji_lembur']),
				'interval_kirim_auto' => $set['interval_kirim_auto'],
				'tahun' => $cekset['tahun'],
			];
			$data['respon'] = [
				"pesan" => "Berhasil",
				'status' => true,
				'code' => 200
			];
		} else {
			$data['respon'] = [
				"pesan" => "Maaf Anda Tidak Memiliki Akses Ke Menu Yang Anda Buka",
				'status' => false,
				'code' => 200
			];
		}

		$this->response($data, $data['respon']['code']);
	}
		
}
