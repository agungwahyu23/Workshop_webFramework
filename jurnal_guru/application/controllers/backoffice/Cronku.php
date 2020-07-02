<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cronku extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}
	public function satumenit()
	{
		$timenow = date('Y-m-d H:i');
		$uppermintaan = $this->db->query("UPDATE req_guru set status=0 where  status=1 and akhir like '%$timenow%'");
		// echo $uppermintaan;

		$hariini = Response_helper::hari_ini();
		$cekset = Data_helper::getdatarow('tahun_ajaran', 'aktif', '1');
		// $tdy = date('Y-m-d');
		$limemenit = date('H:i', strtotime('+5 minutes', strtotime($timenow . ':00')));
		$set = Data_helper::get_setting();
		$getjadwal = $this->Maksi->getData("getjadwalforcron", "where a.jam_awal like '%$limemenit%' and a.this_week=0 and a.status = 1 and  a.hari='$hariini' and a.kode_tahun='$cekset[kode_tahun]' and a.semester='$set[semester]'");
		// echo json_encode($getjadwal);
		foreach ($getjadwal as $gt) {
			$tokens = [];
			$tokens[] = $gt['last_token'];
			$sendnotif = $this->Maksi->send_notification($tokens, "Pengingat Mengajar", '5 Menit lagi anda akan mengajar di kelas ' . $gt['no_kelas'] . ' ' . $gt['nama_singkat'] . ' ' . $gt['rombel'] . ' dengan mata pelajaran ' . $gt['nama_mapel'], '/guru/jadwal/detail', $gt['kode_jadwal']);
			// $sendnotif = $this->Maksi->send_wa($gt['no_wa'], "Hallo ". $gt['nama_guru'] ." - Pengingat Mengajar \n5 Menit lagi anda akan mengajar di kelas " . $gt['no_kelas'] . " " . $gt['nama_singkat'] . " " . $gt['rombel'] . " dengan mata pelajaran " . $gt['nama_mapel']);
			echo $sendnotif . '<br>';
		}
		$set = Data_helper::get_setting();
		if ($set['aktif_kirim_auto'] == '1') {

			$limabelas = date('H:i', strtotime('-'. $set['interval_kirim_auto'] .' minutes', strtotime($timenow . ':00')));
			$getjadwaldua = $this->Maksi->getData("getjadwalforcron", "where a.jam_awal like '%$limabelas%' and a.this_week=0 and a.status = 1 and  a.hari='$hariini' and a.kode_tahun='$cekset[kode_tahun]' and a.semester='$set[semester]'");
			$tmy = date('H:i:') . '00';
			foreach ($getjadwaldua as $gt) {
				$tdy = date('Y-m-d H:i:s');
				$getset = Data_helper::get_setting();
				$que = "SELECT count(*) as jml from req_guru where kode_jadwal = '$gt[kode_jadwal]' and awal <= '$tdy' and akhir >= '$tdy' and `status`='1' and tipe='1'";
				$ceknotif = $this->db->query($que)->row_array();
				if ((int) $ceknotif['jml'] == 0) {

					$endTime = strtotime("+" . $getset['min_notif_jurusan'] . " minutes", strtotime($tdy));
					$endTime = date('Y-m-d H:i:s', $endTime);
					$kodeajar = $this->Maksi->random_oke(16);

					$arr = [
						'kode_req' => $kodeajar,
						'kode_jadwal' => $gt['kode_jadwal'],
						'awal' => date("Y-m-d ") . $tmy,
						'akhir' => $endTime,
						'create_at' => date("Y-m-d H:i:s"),
						'tipe' => 1,
						'deskripsi' => 'Siswa Kelas ' . $gt['no_kelas'] . ' ' . $gt['nama_singkat'] . ' ' . $gt['rombel'] . ' Membutuhkan Guru Pengganti Dengan Mata Pelajaran ' . $gt['nama_mapel'],
					];
					$this->Maksi->insertData("req_guru", $arr);
					$set = Data_helper::get_setting();
					$queryku = "SELECT DISTINCT(c.last_token) from jadwal a 
							left join pengguna c on c.akses_data=a.kode_guru 
							where c.level='2' and a.kode_tahun='$cekset[kode_tahun]' and a.semester ='$set[semester]' and a.`status`=1 and c.akses_data != '$gt[kode_guru]' and a.kode_mapel='$gt[kode_mapel]'
							
							";
					$gettoken = $this->db->query($queryku)->result_array();
					$tokens = [];
					foreach ($gettoken as $cc) {
						$tokens[] = $cc['last_token'];
					}
					$sendnotif = $this->Maksi->send_notification($tokens, "Permintaan Guru Pengganti Mata Pelajaran Keahlian Anda", $arr['deskripsi'], '/guru/permintaan/detail', $arr['kode_req']);
				}
			}
		}
	}
	public function harian()
	{
		$hariini = Response_helper::hari_ini();
		$cekset = Data_helper::getdatarow('tahun_ajaran', 'aktif', '1');
		// $tdy = date('Y-m-d');
		$set = Data_helper::get_setting();
		$getjadwal = $this->Maksi->getData("getjadwalforcron", "where  a.this_week=0 and a.status = 1 and  a.hari='$hariini' and a.kode_tahun='$cekset[kode_tahun]' and a.semester='$set[semester]'");
		// echo json_encode($getjadwal);
		foreach ($getjadwal as $gt) {

			$tdy = date('Y-m-d H:i:s');
			$kdguru = $gt['kode_guru'];
			$stguruasli = 4;
			$cekguru = $this->db->query("SELECT count(*) as jml from ijin_guru where kode_guru='$kdguru' and awal <= '$tdy' and akhir >= '$tdy' and `status` ='2'")->row_array();
			if ($cekguru > 0) {
				$stguruasli = 5;
			}
			$kodeajar = $this->Maksi->random_oke(16);
			$arrku = [
				'kode_mengajar' => $kodeajar,
				'kode_jadwal' => $gt['kode_jadwal'],
				'kode_guru' => $kdguru,
				'mulai' => date("Y-m-d H:i:s"),
				'akhir' => date("Y-m-d H:i:s"),
				'tipe' => 1,
				'status' => $stguruasli,
				'rating' => 0
			];
			$this->Maksi->insertData("mengajar", $arrku);
		}
	}
	public function mingguan()
	{
		// $timenow = date('Y-m-d H:i');
		$hariini = Response_helper::hari_ini();
		if ($hariini == 'Minggu') {

			$uppermintaan = $this->db->query("UPDATE jadwal set this_week=0 ");
			echo $uppermintaan;
		}
	}
}
