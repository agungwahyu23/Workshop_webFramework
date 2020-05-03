<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
class Permintaan extends REST_Controller  {
	function __construct()
  	{
		parent::__construct();
	}

	public function data_get()
	{

		$kode = $this->input->get_request_header('token', TRUE);
		$cek = $this->Maksi->getDataSingle("detailtoken", $kode);
		if ($cek > 1) {
			$as = 1;
			$cekset = Data_helper::getdatarow('tahun_ajaran', 'aktif', '1');
			$tipe = $this->get('tipe'); // guru kelas
			$subtipe = $this->get('subtipe'); // sama jurusan / semua guru
			$wer = "";
			$set = Data_helper::get_setting();
			if($tipe == 1) {
				$wer .= " WHERE h.tipe = '$subtipe' and a.kode_tahun='$cekset[kode_tahun]' ";
				$getguru = $this->db->get_where('guru',['kode_guru' => $cek['akses_data']])->row_array();
				$keysub = $getguru['kode_jurusan'];
				if($subtipe == 1){
					$as = 2;
					$wer .= " and h.status=1 and b.kode_jurusan='$keysub' order by h.create_at desc";
				}else{
					$wer .= " and h.status=1 order by h.create_at desc";
				}
			} else if ($tipe == 2) {
				$wer .= " where b.kode_kelas = '$cek[akses_data]' and a.kode_tahun='$cekset[kode_tahun]' and a.semester='$set[semester]' order by h.create_at desc";
			}else if($tipe == 3){
				$wer = " WHERE a.kode_tahun='$cekset[kode_tahun]'  and h.status=2 and h.pick_by='$cek[akses_data]' order by h.create_at desc";
				
			}
			if ($as == 1) {
				$data['data'] = $this->Maksi->getData("getpermintaan", $wer);
			} else {
				$newdata = array();
				$set = Data_helper::get_setting();
				$querysatu = "SELECT DISTINCT(a.kode_mapel) from jadwal a where a.kode_tahun='$cekset[kode_tahun]' and a.semester='$set[semester]' and a.status=1 and a.kode_guru='$cek[akses_data]' ";
				$exquerysatu = $this->db->query($querysatu)->result_array();
				foreach ($exquerysatu as $ku) {
					$key = " WHERE h.tipe = '$subtipe' and a.kode_tahun='$cekset[kode_tahun]' and a.semester='$set[semester]' and h.status=1 and a.kode_mapel='$ku[kode_mapel]' and a.kode_guru != '$cek[akses_data]'  order by h.create_at desc";
					$querydua = "SELECT h.*, a.hari, a.jam_awal, jam_akhir, a.this_week, a.status as stjadwal, b.no_kelas, b.rombel, c.nama_jurusan, c.nama_singkat, d.nama_mapel, e.nama_guru from req_guru h
						left join jadwal a on h.kode_jadwal=a.kode_jadwal 
						left join kelas b on a.kode_kelas=b.kode_kelas
						left join jurusan c on b.kode_jurusan=c.kode_jurusan
						left join mapel d on a.kode_mapel=d.kode_mapel
						left join guru e on h.pick_by=e.kode_guru
						left join hari g on a.hari=g.kode_hari
						$key
						";
					$ne = $this->db->query($querydua)->result_array();
					foreach ($ne as $kv) {
						$newdata[] = $kv;
					}

				}
				$data['data'] = $newdata;
			}
			
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
	public function detail_get($id)
	{

		$kode = $this->input->get_request_header('token', TRUE);
		$cek = $this->Maksi->getDataSingle("detailtoken", $kode);
		if ($cek > 1) {

			$data['data'] = $this->Maksi->getDataSingle("getpermintaan", "where h.kode_req='$id'");
			$data['timenow'] = date('H:i:s');
			$data['tdynow'] = Response_helper::hari_ini();
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


	public function ingatkanguru_post($id)
	{

		$kode = $this->input->get_request_header('token', TRUE);
		$cek = $this->Maksi->getDataSingle("detailtoken", $kode);
		if ($cek > 1) {

			if($cek['level'] == '3' || $cek['level'] == '1'){

			$hariini = Response_helper::hari_ini();
			$cekset = Data_helper::getdatarow('tahun_ajaran', 'aktif', '1');

			$tmy = date('H:i:').'00';
			$wer = "where a.status = 1 and a.kode_jadwal='$id' and a.kode_tahun='$cekset[kode_tahun]' and g.aktif='1' and a.hari = '$hariini' and  a.jam_awal <= '$tmy'  and  a.jam_akhir >= '$tmy'";
			$datjadwal = $this->Maksi->getDataSingle("getjadwal", $wer);
				if($datjadwal > 0){
					$tdy = date('Y-m-d');
					$ceknotif = $this->db->query(" SELECT count(*) as jml from notifikasi where kode_key = '$id' and create_at like '%$tdy%'")->row_array();
					if($ceknotif['jml'] > 0){
						$data['respon'] = [
							"pesan" => "Anda Telah Mengingatkan Guru Ini",
							'status' => false,
							'code' => 403
						];
					}else{

						$kodeajar = $this->Maksi->random_oke(16);

						$getus = $this->db->get_where('pengguna',['akses_data' => $datjadwal['kode_guru']])->row_array();
						$arr = [
							'kode_notifikasi' => $kodeajar,
							'kode_key' => $id,
							'kode_pengguna' => $getus['kode_pengguna'],
							'create_at' => date("Y-m-d H:i:s"),
							'tipe_key' => 1,
							'judul' => 'Mengingatkan Saatnya Mengajar',
							'keterangan' => 'Siswa Kelas '.$datjadwal['no_kelas'] . ' ' . $datjadwal['nama_singkat'] . ' ' . $datjadwal['rombel'] . ' Mengingatkan Anda Untuk Mengajar Di Kelas Tersebut',
						];
						$this->Maksi->insertData("notifikasi", $arr);
						$tokens = [];
						$tokens[] = $getus['last_token'];
						$sendnotif = $this->Maksi->send_notification($tokens, $arr['judul'], $arr['keterangan'], '/guru/jadwal/detail', $id);

						//scnotif

						$data['respon'] = [
							"pesan" => "Berhasil Mengingatkan Guru",
							'status' => true,
							'code' => 200,
							'hasil' => $sendnotif
						];
					}
				}else{
					$data['respon'] = [
						"pesan" => "Sekarang Belum Waktunya Jadwal Ini",
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
		
	

	public function buatpermintaan_post($id)
	{

		$kode = $this->input->get_request_header('token', TRUE);
		$cek = $this->Maksi->getDataSingle("detailtoken", $kode);
		if ($cek > 1) {

			if($cek['level'] == '3' || $cek['level'] == '1'){

			$hariini = Response_helper::hari_ini();
			$cekset = Data_helper::getdatarow('tahun_ajaran', 'aktif', '1');

			$tmy = date('H:i:').'00';
			$wer = "where a.status = 1 and a.kode_jadwal='$id' and a.kode_tahun='$cekset[kode_tahun]' and g.aktif='1' and a.hari = '$hariini' and  a.jam_awal <= '$tmy'  and  a.jam_akhir >= '$tmy' and a.this_week='0'";
			$datjadwal = $this->Maksi->getDataSingle("getjadwal", $wer);
				if($datjadwal > 0){
					$tdy = date('Y-m-d H:i:s');
					$getset = Data_helper::get_setting();
					$que = "SELECT count(*) as jml from req_guru where kode_jadwal = '$id' and awal <= '$tdy' and akhir >= '$tdy' and `status`='1' and tipe='1'";
					$ceknotif = $this->db->query($que)->row_array();
					if((int)$ceknotif['jml'] > 0){
						$data['respon'] = [
							"pesan" => "Anda Masih Memiliki Permintaan Guru Per Mata Pelajaran Yang Masih Berjalan",
							'status' => false,
							'code' => 403
						];
					}else{
						$ceknotifsatu = $this->db->query("SELECT * from req_guru where kode_jadwal = '$id' and akhir <= '$tdy' and `tipe`='1' and (`status`='1' or  `status`='0')")->row_array();
						if($ceknotifsatu > 0){
							$ceknotif = $this->db->query("SELECT count(*) as jml from req_guru where kode_jadwal = '$id' and awal <= '$tdy' and akhir >= '$tdy' and `status`='1' and `tipe`='2'")->row_array();
							if($ceknotif['jml'] > 0){
								$data['respon'] = [
									"pesan" => "Anda Masih Memiliki Permintaan Guru Ke Semua Guru Yang Masih Berjalan",
									'status' => false,
									'code' => 403
								];
							}else{
								$ceknotifdua = $this->db->query("SELECT * from req_guru where kode_jadwal = '$id' and akhir <= '$tdy' and `tipe`='2' and (`status`='1' or `status`='0')")->row_array();
								if($ceknotifdua > 0){

									$data['respon'] = [
										"pesan" => "Permintaan Guru Telah Mencapain Batas. Silahkan Hubungi Admin.",
										'status' => false,
										'code' => 403
									];
									$upreq = [
										'status' => 0
									];
									$this->Maksi->updateData('req_guru', $upreq, $ceknotifdua['kode_req'], 'kode_req');
								}else{

									$endTime = strtotime("+". $getset['min_notif_semua'] ." minutes", strtotime($tdy));
									$endTime = date('H:i:s', $endTime);
									$kodeajar = $this->Maksi->random_oke(16);

									$arr = [
										'kode_req' => $kodeajar,
										'kode_jadwal' => $id,
										'awal' => date("Y-m-d ").$tmy,
										'akhir' => date("Y-m-d ").$endTime,
										'create_at' => date("Y-m-d H:i:s"),
										'tipe' => 2,
										'deskripsi' => 'Siswa Kelas '.$datjadwal['no_kelas'] . ' ' . $datjadwal['nama_singkat'] . ' ' . $datjadwal['rombel'] . ' Membutuhkan Guru Pengganti Dengan Mata Pelajaran '. $datjadwal['nama_mapel'],
									];
									$this->Maksi->insertData("req_guru", $arr);

									$upreq = [
										'status' => 0
									];
									$this->Maksi->updateData('req_guru', $upreq, $ceknotifsatu['kode_req'], 'kode_req');
									$gettoken = $this->Maksi->getData("gettoken", " WHERE b.kode_guru != '$datjadwal[kode_guru]' and a.level = '2'");
									$tokens = [];
									foreach ($gettoken as $cc) {
										$tokens[] = $cc['last_token'];
									}
									$sendnotif = $this->Maksi->send_notification($tokens, "Permintaan Guru Pengganti Sejurusan", $arr['deskripsi'], '/guru/permintaan/detail', $arr['kode_req']);
									
									//scnotif
									$data['respon'] = [
										"pesan" => "Berhasil Membuat Permintaan Guru Ke Semua Guru. Jika ". $getset['min_notif_semua'] . ' menit tidak ada respon, Silahkan hubungi admin',
										'status' => true,
										'code' => 200,
										'hasil' => $sendnotif
									];
								}
							}
						}else{

							$endTime = strtotime("+". $getset['min_notif_jurusan'] ." minutes", strtotime($tdy));
							$endTime = date('Y-m-d H:i:s', $endTime);
							$kodeajar = $this->Maksi->random_oke(16);

							$arr = [
								'kode_req' => $kodeajar,
								'kode_jadwal' => $id,
								'awal' => date("Y-m-d ").$tmy,
								'akhir' => $endTime,
								'create_at' => date("Y-m-d H:i:s"),
								'tipe' => 1,
								'deskripsi' => 'Siswa Kelas '.$datjadwal['no_kelas'] . ' ' . $datjadwal['nama_singkat'] . ' ' . $datjadwal['rombel'] . ' Membutuhkan Guru Pengganti Dengan Mata Pelajaran '. $datjadwal['nama_mapel'],
							];
							$this->Maksi->insertData("req_guru", $arr);
							$set = Data_helper::get_setting();
							$queryku = "SELECT DISTINCT(c.last_token) from jadwal a 
							left join pengguna c on c.akses_data=a.kode_guru 
							where c.level='2' and a.kode_tahun='$cekset[kode_tahun]' and a.semester ='$set[semester]' and a.`status`=1 and c.akses_data != '$datjadwal[kode_guru]' and a.kode_mapel='$datjadwal[kode_mapel]'
							
							";
							$gettoken = $this->db->query($queryku)->result_array();
							$tokens = [];
							foreach ($gettoken as $cc) {
								$tokens[] = $cc['last_token'];
							}
							$sendnotif = $this->Maksi->send_notification($tokens, "Permintaan Guru Pengganti Mata Pelajaran Keahlian Anda", $arr['deskripsi'], '/guru/permintaan/detail', $arr['kode_req']);
									
							//scnotif
							$data['respon'] = [
								"pesan" => "Berhasil Membuat Permintaan Guru Per Mata Pelajaran. Jika ". $getset['min_notif_jurusan'] . ' menit tidak ada respon silahkan buat ulang dan akan di teruskan ke semua guru ',
								'status' => true,
								'code' => 200,
								'hasil' => $sendnotif
							];
						}


					}
				}else{
					$data['respon'] = [
						"pesan" => "Sekarang Belum Waktunya Jadwal Ini",
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
		


	public function pickpermintaan_post($kode)
	{

		$kodek = $this->input->get_request_header('token', TRUE);
		$cek = $this->Maksi->getDataSingle("detailtoken", $kodek);
		if ($cek > 1) {

			if($cek['level'] == '2' || $cek['level'] == '1'){

				$getdatareq =  $this->db->get_where('req_guru',['kode_req' => $kode])->row_array();

				$id = $getdatareq['kode_jadwal'];
				if($getdatareq['status'] == '0'){
					$data['respon'] = [
						"pesan" => "Permintaan Ini Sudah Tidak Berlaku",
						'status' => false,
						'code' => 403
					];
				}else if($getdatareq['status'] == '2'){
					$data['respon'] = [
						"pesan" => "Permintaan Ini Sudah Di Ambil Oleh Guru Lainnya",
						'status' => false,
						'code' => 403
					];
					
				}else{
					$hariini = Response_helper::hari_ini();
					$cekset = Data_helper::getdatarow('tahun_ajaran', 'aktif', '1');

					$tmy = date('H:i:').'00';
					$wer = "where a.status = 1 and a.kode_jadwal='$id' and a.kode_tahun='$cekset[kode_tahun]' and g.aktif='1' and a.this_week = '0' and a.hari = '$hariini' and  a.jam_awal <= '$tmy'  and  a.jam_akhir >= '$tmy'";
					$datjadwal = $this->Maksi->getDataSingle("getjadwal", $wer);
						if($datjadwal > 0){
							$kodeajar = $this->Maksi->random_oke(16);

							$arr = [
								'kode_mengajar' => $kode,
								'kode_jadwal' => $id,
								'kode_guru' => $cek['akses_data'],
								'mulai' => date("Y-m-d H:i:s"),
								'tipe' => 2,
								'status' => 1,
							];
							$this->Maksi->insertData("mengajar", $arr);

							$upthis = [
								'this_week' => 2
							];
							$this->Maksi->updateData("jadwal", $upthis,$id, 'kode_jadwal');
							$upthisku = [
								'status' => 2,
								'pick_by' => $cek['akses_data']
							];
							$this->Maksi->updateData("req_guru", $upthisku, $kode, 'kode_req');

							//cek guru asli
							
							$tdy = date('Y-m-d H:i:s');
							$kdguru = $datjadwal['kode_guru'];
							$stguruasli = 4;
							$cekguru = $this->db->query("SELECT count(*) as jml from ijin_guru where kode_guru='$kdguru' and awal <= '$tdy' and akhir >= '$tdy' and `status` ='2'")->row_array();
							if($cekguru > 0){
								$stguruasli = 5;
							}
							$arrku = [
								'kode_mengajar' => $kodeajar,
								'kode_jadwal' => $id,
								'kode_guru' => $kdguru,
								'mulai' => date("Y-m-d H:i:s"),
								'akhir' => date("Y-m-d H:i:s"),
								'tipe' => 1,
								'status' => $stguruasli,
								'rating' => 0
							];
							$this->Maksi->insertData("mengajar", $arrku);
							$data['respon'] = [
								"pesan" => "Berhasil Mengambil Permintaan Kelas. Silahkan Menuju Kelas.",
								'status' => true,
								'code' => 200
							];
						}else{
							$data['respon'] = [
								"pesan" => "Anda Telah Check-in Di Kelas Pengganti Ini",
								'status' => false,
								'code' => 403
							];
						}


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


	public function batalkanpermintaan_put($kode)
	{

		$kodek = $this->input->get_request_header('token', TRUE);
		$cek = $this->Maksi->getDataSingle("detailtoken", $kodek);
		if ($cek > 1) {

			if ($cek['level'] == '3' || $cek['level'] == '1') {

				$getdatareq =  $this->db->get_where('req_guru', ['kode_req' => $kode])->row_array();

				if ($getdatareq['status'] == '0') {
					$data['respon'] = [
						"pesan" => "Permintaan Ini Sudah Tidak Berlaku",
						'status' => false,
						'code' => 403
					];
				} else if ($getdatareq['status'] == '2') {
					$data['respon'] = [
						"pesan" => "Permintaan Ini Sudah Di Ambil Oleh Guru",
						'status' => false,
						'code' => 403
					];
				} else {
						$upthisku = [
							'status' => 0
						];
						$this->Maksi->updateData("req_guru", $upthisku, $kode, 'kode_req');

						$data['respon'] = [
							"pesan" => "Berhasil Membatalkan Permintaan",
							'status' => false,
							'code' => 200
						];
					
				}
			} else {
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
		
	public function selesaikan_post($id)
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
					$getset = Data_helper::get_setting();
					$selesai = date("Y-m-d H:i:s");
					$mulai = $getajar['mulai'];
					$newmulai = explode(" ", $mulai);
					if(!Input_helper::comparejam($newmulai[1], date('H:i:s'))){
						$selesai = $newmulai.' '.$datjadwal['jam_akhir'];
					}
					$getupah = (Response_helper::rentangwaktu($mulai, $selesai, 5) / 60) * $getset['gaji_lembur'];
					$arr = [
						'status' => 2,
						'akhir' => $selesai,
						'reward' => $getupah,
						'materi' => $this->post('materi', true),
					];
					$this->Maksi->updateData("mengajar", $arr,$id, 'kode_mengajar');

					$upthis = [
						'this_week' => 1
					];
					$this->Maksi->updateData("jadwal", $upthis,$kodejadwal, 'kode_jadwal');


					$arrupah = [
						'kode_reward' => $id,
						'kode_guru' => $cek['akses_data'],
						'jumlah' => $getupah,
						'tipe' => 2,
						'create_at' => date('Y-m-d H:i:s'),
					];
					$this->Maksi->insertData("rw_reward", $arrupah);
					$data['respon'] = [
						"pesan" => "Berhasil Menyelesaikan Jadwal",
						'reward' => $getupah,
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
		
}
