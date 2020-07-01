<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Jadwal extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!$this->session->has_userdata('kode_pengguna') || $this->session->userdata('level')  != '1') {
			redirect(base_url());
		}
		if ($this->uri->segment(3) == "add" && $_SERVER['REQUEST_METHOD'] == "POST") {
			$this->store();
		} else if ($this->uri->segment(3) == "edit" && $_SERVER['REQUEST_METHOD'] == "POST") {
			$this->update($this->uri->segment(4));
		}
	}
	public function index()
	{
		$set = Data_helper::get_setting();
		$cekset = Data_helper::getdatarow('tahun_ajaran', 'aktif', '1');
		$data['title'] = "Data Jadwal Tahun Ajaran " . $cekset['tahun'].' Semester '. ($set['semester'] == '1' ? 'Ganjil' : 'Genap');
		$data['content'] = "jadwal/indexjadwal";
		$data['data'] = $this->Maksi->getData("getjadwal", "where a.status = 1 and a.kode_tahun='$cekset[kode_tahun]' and semester='$set[semester]' order by a.hari, b.no_kelas asc");

		$this->load->view('backend/index', $data);
	}
	public function add()
	{
		$data['title'] = "Tambah jadwal";
		$data['action'] = "Tambah Data";
		$data['content'] = "jadwal/addjadwal";
		$data['datakelas'] = $this->Maksi->getData("getkelas");
		$data['datahari'] = $this->Maksi->getData("gethari");
		$data['dataguru'] = $this->Maksi->getData("getguru");
		$data['datamapel'] = $this->Maksi->getData("getmapel");
		$data['data'] = null;
		$this->load->view('backend/index', $data);
	}

	public function store()
	{
		$set = Data_helper::get_setting();
		$cekset = Data_helper::getdatarow('tahun_ajaran','aktif','1');
		try {

			$kode = $this->Maksi->random_oke(16);

			$arr = [
				'kode_jadwal' => $kode,
				'kode_kelas' => $this->input->post('kode_kelas', TRUE),
				'kode_mapel' => $this->input->post('kode_mapel', TRUE),
				'kode_guru' => $this->input->post('guru', TRUE),
				'kode_kelas' => $this->input->post('kelas', TRUE),
				'kode_tahun' => $cekset['kode_tahun'],
				'semester' => $set['semester'],
				'hari' => $this->input->post('hari', TRUE),
				'jam_awal' => $this->input->post('jam_awal', TRUE),
				'jam_akhir' => $this->input->post('jam_akhir', TRUE),
				'create_at' => date("Y-m-d H:i:s")
			];
			if(Input_helper::comparejam($arr['jam_awal'], $arr['jam_akhir'])) {
				$mulai = $arr['jam_awal'] . ':00';
				$selesai = $arr['jam_akhir'] . ':00';
				$sqlku = "SELECT * from jadwal where kode_tahun='$cekset[kode_tahun]' and semester = '$set[semester]' and `status`=1 and kode_guru='$arr[kode_guru]' and hari='$arr[hari]' and ((jam_awal >= '$mulai' and jam_awal <= '$selesai') or (jam_awal < '$mulai' and jam_akhir > '$mulai' ))";
				$cekjadwalguru = $this->db->query($sqlku)->row_array();
				if ($cekjadwalguru < 1) {

					$sqlku = "SELECT * from jadwal where kode_tahun='$cekset[kode_tahun]' and semester = '$set[semester]' and `status`=1 and kode_kelas='$arr[kode_kelas]' and hari='$arr[hari]'  and ((jam_awal >= '$mulai' and jam_awal <= '$selesai') or (jam_awal < '$mulai' and jam_akhir > '$mulai' ))";
					$cekjadwalkelas = $this->db->query($sqlku)->row_array();
					if ($cekjadwalkelas < 1) {
						$this->Maksi->insertData("jadwal", $arr);
						$this->session->set_flashdata("message", ['success', 'Berhasil Menambah Data jadwal', ' Berhasil']);
						redirect(base_url("backoffice/jadwal"));
						
					}else{

						$this->session->set_flashdata("message", ['danger', 'Jadwal Kelas Crash', ' Gagal']);
						redirect(base_url("backoffice/jadwal/add"));
					}
				}else{

					$this->session->set_flashdata("message", ['danger', 'Jadwal Guru Crash', ' Gagal']);
					redirect(base_url("backoffice/jadwal/add"));
				}

			}else {
				$this->session->set_flashdata("message", ['danger', 'Jam Mulai Dan Jam Akhir Tidak Valid', ' Gagal']);
				redirect(base_url("backoffice/jadwal/add"));

			}
		} catch (Exception $e) {
			$this->session->set_flashdata("message", ['danger', 'Gagal Menambah Data jadwal', ' Gagal']);
			redirect(base_url("backoffice/jadwal/add"));
		}
	}

	public function edit($id)
	{
		$data['title'] = "Edit jadwal";
		$data['action'] = "Edit jadwal";
		$data['content'] = "jadwal/editjadwal";
		$data['datakelas'] = $this->Maksi->getData("getkelas");
		$data['dataguru'] = $this->Maksi->getData("getguru");
		$data['datamapel'] = $this->Maksi->getData("getmapel");
		$data['datahari'] = $this->Maksi->getData("gethari");	
		$data['data'] = $this->db->get_where("jadwal", ['kode_jadwal' => $id])->row_array();
		$this->load->view('backend/index', $data);
	}


	public function update($id)
	{
		try {
			$arr = [
				'kode_kelas' => $this->input->post('kode_kelas', TRUE),
				'kode_mapel' => $this->input->post('kode_mapel', TRUE),
				'kode_guru' => $this->input->post('guru', TRUE),
				'kode_kelas' => $this->input->post('kelas', TRUE),
				'hari' => $this->input->post('hari', TRUE),
				'jam_awal' => $this->input->post('jam_awal', TRUE),
				'jam_akhir' => $this->input->post('jam_akhir', TRUE),
			];
			// echo Input_helper::comparejam(substr($arr['jam_awal'], 0, 5), substr($arr['jam_akhir'], 0, 5));
			if (Input_helper::comparejam(substr($arr['jam_awal'], 0, 5), substr($arr['jam_akhir'], 0, 5))) {
				$set = Data_helper::get_setting();
				$cekset = Data_helper::getdatarow('tahun_ajaran', 'aktif', '1');
				$mulai = $arr['jam_awal'] . ':00';
				$selesai = $arr['jam_akhir'] . ':00';
				$sqlku = "SELECT * from jadwal where kode_jadwal != '$id' and kode_tahun='$cekset[kode_tahun]' and semester = '$set[semester]' and `status`=1 and kode_guru='$arr[kode_guru]' and hari='$arr[hari]' and ((jam_awal >= '$mulai' and jam_awal <= '$selesai') or (jam_awal < '$mulai' and jam_akhir > '$mulai' ))";
				$cekjadwalguru = $this->db->query($sqlku)->row_array();
				if ($cekjadwalguru < 1) {

					$sqlku = "SELECT * from jadwal where kode_jadwal != '$id' and kode_tahun='$cekset[kode_tahun]' and semester = '$set[semester]' and `status`=1 and kode_kelas='$arr[kode_kelas]' and hari='$arr[hari]'  and ((jam_awal >= '$mulai' and jam_awal <= '$selesai') or (jam_awal < '$mulai' and jam_akhir > '$mulai' ))";
					$cekjadwalkelas = $this->db->query($sqlku)->row_array();
					if ($cekjadwalkelas < 1) {

						$this->Maksi->updateData("jadwal", $arr, $id, "kode_jadwal");

						$this->session->set_flashdata("message", ['success', 'Berhasil Mengedit Data jadwal', ' Berhasil']);
						redirect(base_url("backoffice/jadwal"));
					} else {

						$this->session->set_flashdata("message", ['danger', 'Jadwal Kelas Crash', ' Gagal']);
						redirect(base_url("backoffice/jadwal/edit/" . $id));
					}
				} else {

					$this->session->set_flashdata("message", ['danger', 'Jadwal Guru Crash', ' Gagal']);
					redirect(base_url("backoffice/jadwal/edit/" . $id));
				}
			} else {
				$this->session->set_flashdata("message", ['danger', 'Jam Mulai Dan Jam Akhir Tidak Valid', ' Gagal']);
				redirect(base_url("backoffice/jadwal/edit/".$id));
			}
		} catch (Exception $e) {
			$this->session->set_flashdata("message", ['danger', 'Gagal Mengedit Data jadwal', ' Gagal']);
			redirect(base_url("backoffice/jadwal/edit/" . $id));
		}
	}

	public function delete($id)
	{
		try {
			$arr = [
				'status' => 0
			];
			$this->Maksi->updateData("jadwal", $arr, $id, "kode_jadwal");

			$this->session->set_flashdata("message", ['success', 'Berhasil Menghapus Data jadwal', ' Berhasil']);
			redirect(base_url("backoffice/jadwal"));
		} catch (Exception $e) {
			$this->session->set_flashdata("message", ['danger', 'Gagal Menghapus Data jadwal', ' Gagal']);
			redirect(base_url("backoffice/jadwal"));
		}
	}



	public function import()
	{
		$data['title'] = "Import Data Excel";
		$data['action'] = "Import Data";
		$data['content'] = "jadwal/import";
		$this->load->view('backend/index', $data);
	}


	public function getdataexcel(){
		// $spreadsheat = new Spreadsheet();
		$fileex = $_FILES['file_excel']['tmp_name'];
		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv;
		$spreadsheat = $reader->load($fileex);
		$sheetdata = $spreadsheat->getActiveSheet()->toArray();
		// echo "<pre>";
		$settahun = Data_helper::getdatarow('tahun_ajaran', 'aktif', '1');
		$setting = Data_helper::get_setting();
		$kirim = [];
		for ($i=1; $i < count($sheetdata); $i++) { 
			$datfor = $sheetdata[$i];
			$hasilcek = false;
			$pesancek ="";
			$arkode = [];
			if (Input_helper::comparejam($datfor[4], $datfor[5])) {

				$cekguru = $this->db->get_where('guru', ['nama_guru' => $datfor[0], 'status' => 1])->row_array();
				if ($cekguru > 0) {
					$cekmapel = $this->db->get_where('mapel', ['nama_mapel' => $datfor[1], 'status' => 1])->row_array();
					if ($cekmapel > 0) {
						$exkelas = explode("-", $datfor[2]);
						$cekkelas = $this->db->query("SELECT a.kode_kelas from kelas a left join jurusan b on a.kode_jurusan=b.kode_jurusan where a.no_kelas='$exkelas[0]' and  b.nama_singkat='$exkelas[1]' and a.rombel='$exkelas[2]'")->row_array();
						if ($cekkelas > 0) {
							$mulai = $datfor[4] . ':00';
							$selesai = $datfor[5] . ':00';
							$sqlku = "SELECT * from jadwal where kode_tahun='$settahun[kode_tahun]' and semester = '$setting[semester]' and `status`=1 and kode_guru='$cekguru[kode_guru]' and hari='$datfor[3]' and ((jam_awal >= '$mulai' and jam_awal <= '$selesai') or (jam_awal < '$mulai' and jam_akhir > '$mulai' ))";
							$cekjadwalguru = $this->db->query($sqlku)->row_array();
							if ($cekjadwalguru > 0) {

								$hasilcek = false;
								$pesancek = "Jadwal Guru Crash";
							} else {
								$sqlku = "SELECT * from jadwal where kode_tahun='$settahun[kode_tahun]' and semester = '$setting[semester]' and `status`=1 and kode_kelas='$cekkelas[kode_kelas]' and hari='$datfor[3]'  and ((jam_awal >= '$mulai' and jam_awal <= '$selesai') or (jam_awal < '$mulai' and jam_akhir > '$mulai' ))";
								$cekjadwalkelas = $this->db->query($sqlku)->row_array();
								if ($cekjadwalkelas > 0) {

									$hasilcek = false;
									$pesancek = "Jadwal Kelas Crash";
								} else {

									$hasilcek = true;
									$pesancek = "Semua Data OK ";
									$arkode = [
										'kode_guru' => $cekguru['kode_guru'],
										'kode_mapel' => $cekmapel['kode_mapel'],
										'kode_kelas' => $cekkelas['kode_kelas'],
									];
								}
							}
						} else {
							$hasilcek = false;
							$pesancek = "Kelas Tidak Di Temukan";
						}
					} else {
						$hasilcek = false;
						$pesancek = "Mapel Tidak Di Temukan";
					}
				} else {
					$hasilcek = false;
					$pesancek = "Guru Tidak Di Temukan";
				}

			}else{
				$hasilcek = false;
				$pesancek = "Jam Tidak Valid";
			}
			$kirim[] = [
				'hasil' => [
					'hasil' => $hasilcek,
					'pesan' => $pesancek,
				],
				'kode' => $arkode,
				'data' => $datfor
			];
		}
		$tabel = "<form method='post' action='".base_url('backoffice/jadwal/prosesimport')."' style='width:100%;'><div class='table-responsive'><table class='table table-bordered'><tr><td>Nama Guru</td><td>Nama Mapel</td><td>Nama Kelas</td><td>Hari</td><td>Jam Mulai</td><td>Jam Selesai</td><td>Status</td></tr>";
		$no=0;
		foreach ($kirim as $kr) {
			$tabel .= "<tr><td>".$kr['data'][0] . "</td><td>" . $kr['data'][1] . "</td><td>" . $kr['data'][2] . "</td><td>" . $kr['data'][3] . "</td><td>" . $kr['data'][4];
			if($kr['hasil']['hasil'] == 1){
				$tabel .= "<input type='hidden' name='guru[]' value='" . $kr['kode']['kode_guru'] . "' />
			<input type='hidden' name='kelas[]' value='" . $kr['kode']['kode_kelas'] . "' />
			<input type='hidden' name='hari[]' value='" . $kr['data'][3] . "' />
			<input type='hidden' name='jam_awal[]' value='" . $kr['data'][4] . "' />
			<input type='hidden' name='jam_akhir[]' value='" . $kr['data'][5] . "' />
			<input type='hidden' name='mapel[]' value='" . $kr['kode']['kode_mapel'] . "' />";
			$no++;
			}
			$tabel .= "</td><td>" . $kr['data'][5] . "</td><td>" . ($kr['hasil']['hasil'] ? '<b style="color:#2ecc71;">OK</b>' : '<b style="color:#e74c3c;">GAGAL - <br/>'. $kr['hasil']['pesan']). "</b></td></tr>";
		}

		if($no > 0){
			$tabel .= "</table></div><div><button class='btn btn-primary' type='submit' style='margin-top: 20px; float: right; margin-right: 20px;'>Proses Import</button</div></form>";

		}else{
			$tabel .= "</table></div></form>";

		}
		echo $tabel;
		// echo json_encode($kirim);
	}


	public function prosesimport() 
	{
		$set = Data_helper::get_setting();
		$cekset = Data_helper::getdatarow('tahun_ajaran', 'aktif', '1');
		try {
			$kode_kelas = $this->input->post('kelas', TRUE);
			$guru = $this->input->post('guru', TRUE);
			$mapel = $this->input->post('mapel', TRUE);
			$hari = $this->input->post('hari', TRUE);
			$jam_awal = $this->input->post('jam_awal', TRUE);
			$jam_akhir = $this->input->post('jam_akhir', TRUE);

			$settahun = Data_helper::getdatarow('tahun_ajaran', 'aktif', '1');
			$setting = Data_helper::get_setting();
			for ($i=0; $i < count($mapel); $i++) {
				$mulai = $jam_awal[$i] . ':00';
				$selesai = $jam_akhir[$i]. ':00';
				$sqlku = "SELECT * from jadwal where kode_tahun='$settahun[kode_tahun]' and semester = '$setting[semester]' and `status`=1 and kode_guru='$guru[$i]' and hari='$hari[$i]' and ((jam_awal >= '$mulai' and jam_awal <= '$selesai') or (jam_awal < '$mulai' and jam_akhir > '$mulai' ))";
				$cekjadwalguru = $this->db->query($sqlku)->row_array();
				if ($cekjadwalguru < 1) {

					$sqlku = "SELECT * from jadwal where kode_tahun='$settahun[kode_tahun]' and semester = '$setting[semester]' and `status`=1 and kode_kelas='$kode_kelas[$i]' and hari='$hari[$i]'  and ((jam_awal >= '$mulai' and jam_awal <= '$selesai') or (jam_awal < '$mulai' and jam_akhir > '$mulai' ))";
					$cekjadwalkelas = $this->db->query($sqlku)->row_array();
					if ($cekjadwalkelas < 1) {
						$kode = $this->Maksi->random_oke(16);

						$arr = [
							'kode_jadwal' => $kode,
							'kode_mapel' => $mapel[$i],
							'kode_guru' => $guru[$i],
							'kode_kelas' => $kode_kelas[$i],
							'kode_tahun' => $cekset['kode_tahun'],
							'semester' => $set['semester'],
							'hari' => $hari[$i],
							'jam_awal' => $jam_awal[$i],
							'jam_akhir' => $jam_akhir[$i],
							'create_at' => date("Y-m-d H:i:s")
						];
						$this->Maksi->insertData("jadwal", $arr);
					}
				}
			}
			// $this->db->insert_batch('jadwal', $arr);
			// echo "<pre>";
			// print_r($arr);
			// if (Input_helper::comparejam($arr['jam_awal'], $arr['jam_akhir'])) {
				// $this->Maksi->insertData("jadwal", $arr);
				$this->session->set_flashdata("message", ['success', 'Berhasil Mengimport Jadwal', ' Berhasil']);
				redirect(base_url("backoffice/jadwal/import"));
			// } else {
			// 	$this->session->set_flashdata("message", ['danger', 'Jam Mulai Dan Jam Akhir Tidak Valid', ' Gagal']);
			// 	$this->add();
			// }
		} catch (Exception $e) {
			$this->session->set_flashdata("message", ['danger', 'Gagal Mengimport Jadwal', ' Gagal']);
			redirect(base_url("backoffice/jadwal/import"));
		}
	}
}
