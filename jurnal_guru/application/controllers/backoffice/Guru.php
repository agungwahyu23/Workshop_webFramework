<?php
defined('BASEPATH') or exit('No direct script access allowed');

class guru extends CI_Controller
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
		$data['title'] = "Data guru";
		$data['content'] = "guru/indexguru";
		$data['data'] = $this->Maksi->getData("getguru");

		$this->load->view('backend/index', $data);
	}
	public function add()
	{
		$data['title'] = "Tambah guru";
		$data['action'] = "Tambah Data";
		$data['content'] = "guru/addguru";
		$data['datajurusan'] = $this->Maksi->getData("getjurusan");
		$data['data'] = null;
		$this->load->view('backend/index', $data);
	}

	public function store()
	{
		try {

			$username = $this->input->post('username', TRUE);
			$cekData = $this->db->get_where("pengguna", ['email' => $username, 'status' => 1])->row_array();
			if ($cekData > 1) {

				$this->session->set_flashdata("message", ['danger', 'Username Telah Di Gunakan', ' Gagal']);
				$this->add();
			} else {
				$kode = $this->Maksi->random_oke(16);

				$arr = [
					'kode_guru' => $kode,
					'kode_jurusan' => $this->input->post('jurusan', TRUE),
					'nama_guru' => $this->input->post('nama_guru', TRUE),
					'no_hp' => $this->input->post('no_hp', TRUE),
					'no_wa' => $this->input->post('no_wa', TRUE),
					'alamat' => $this->input->post('alamat', TRUE),
					'create_at' => date("Y-m-d H:i:s"),
					'create_by' => $this->session->userdata('kode_pengguna')
				];

				$kodeuser = $this->Maksi->random_oke(32);
				$arruser =
					[
						'kode_pengguna' => $kodeuser,
						'akses_data' => $arr['kode_guru'],
						'nama_pengguna' => $arr['nama_guru'],
						'email' => $username,
						'password' => password_hash($username, PASSWORD_BCRYPT),
						'level' => 2,
						'create_at' => date('Y-m-d H:i:s')
					];
				$this->Maksi->insertData("pengguna", $arruser);
				$this->Maksi->insertData("guru", $arr);
				$this->session->set_flashdata("message", ['success', 'Berhasil Menambah Data guru', ' Berhasil']);
				redirect(base_url("backoffice/guru"));
			}
		} catch (Exception $e) {
			$this->session->set_flashdata("message", ['danger', 'Gagal Menambah Data guru', ' Gagal']);
			$this->add();
		}
	}

	public function edit($id)
	{
		$data['title'] = "Edit guru";
		$data['action'] = "Edit guru";
		$data['content'] = "guru/addguru";
		$data['datajurusan'] = $this->Maksi->getData("getjurusan");
		$data['data'] = $this->db->get_where("guru", ['kode_guru' => $id])->row_array();
		$this->load->view('backend/index', $data);
	}


	public function update($id)
	{
		try {
			$arr = [
				'kode_jurusan' => $this->input->post('jurusan', TRUE),
				'nama_guru' => $this->input->post('nama_guru', TRUE),
				'no_hp' => $this->input->post('no_hp', TRUE),
				'no_wa' => $this->input->post('no_wa', TRUE),
				'alamat' => $this->input->post('alamat', TRUE),
			];
			$this->Maksi->updateData("guru", $arr, $id, "kode_guru");

			$this->session->set_flashdata("message", ['success', 'Berhasil Mengedit Data guru', ' Berhasil']);
			redirect(base_url("backoffice/guru"));
		} catch (Exception $e) {
			$this->session->set_flashdata("message", ['danger', 'Gagal Mengedit Data guru', ' Gagal']);
			$this->edit($id);
		}
	}

	public function delete($id)
	{
		try {
			$arr = [
				'status' => 0
			];
			$this->Maksi->updateData("guru", $arr, $id, "kode_guru");

			$this->session->set_flashdata("message", ['success', 'Berhasil Menghapus Data guru', ' Berhasil']);
			redirect(base_url("backoffice/guru"));
		} catch (Exception $e) {
			$this->session->set_flashdata("message", ['danger', 'Gagal Menghapus Data guru', ' Gagal']);
			redirect(base_url("backoffice/guru"));
		}
	}



	public function izin()
	{
		$wer = " order by a.create_at desc";
		$data['title'] = "Data Izin Guru";
		$data['data'] = $this->Maksi->getData("getijin", $wer);
		$data['content'] = "guru/indexizin";
		$this->load->view('backend/index', $data);
	}
	public function setstatusizin($tipe, $id)
	{
		$pesan = "Permintaan Izin";
		$status = 1;
		if($tipe == 'Terima'){

			$pesan = "Menerima Permintaan Izin";
			$status = 2;
		}else if ($tipe == 'Tolak') {

			$pesan = "Menolak Permintaan Izin";
			$status = 3;
		}
		try {
			$arr = [
				'status' => $status
			];
			$this->Maksi->updateData("ijin_guru", $arr, $id, "kode_ijin");

			$this->session->set_flashdata("message", ['success', 'Berhasil '. $pesan, ' Berhasil']);
			redirect(base_url("backoffice/guru/izin"));
		} catch (Exception $e) {
			$this->session->set_flashdata("message", ['danger', 'Gagal '. $pesan, ' Gagal']);
			redirect(base_url("backoffice/guru/izin"));
		}
	}

	public function statistik()
	{
		$data['title'] = "Statistik Guru";
		$data['content'] = "mengajar/statistikguru";

		$data['tahun'] = $this->Maksi->getData("gettahun");
		$this->load->view('backend/index', $data);
	}

	function getstatistik()
	{
		$tahunnya = $this->input->post('tahunnya');
		$tahunnya = explode("-", $tahunnya);
		$tipe = $this->input->post('tipenya');
		$query = "";
		if ($tipe == "1") {
			$query .= "SELECT a.kode_guru, a.nama_guru, b.nama_jurusan, b.nama_singkat, AVG(d.rating) as kolombanding from guru a 
						left join jurusan b on a.kode_jurusan=b.kode_jurusan
						left join mengajar d on a.kode_guru=d.kode_guru
						left join jadwal c on c.kode_jadwal=d.kode_jadwal
						where a.status = 1 and c.kode_tahun='$tahunnya[0]' and c.semester='$tahunnya[1]'
						group by a.kode_guru
						order by kolombanding desc";
		} else if ($tipe == "2") {
			$query .= "SELECT a.kode_guru, a.nama_guru, b.nama_jurusan, b.nama_singkat, COUNT(*) as kolombanding from guru a 
						left join jurusan b on a.kode_jurusan=b.kode_jurusan
						left join mengajar d on a.kode_guru=d.kode_guru
						left join jadwal c on c.kode_jadwal=d.kode_jadwal
						where a.status = 1 and c.kode_tahun='$tahunnya[0]' and c.semester='$tahunnya[1]' and (d.status=2 or d.status=3)
						group by a.kode_guru
						order by kolombanding desc";
		} else if ($tipe == "3") {
			$query .= "SELECT a.kode_guru, a.nama_guru, b.nama_jurusan, b.nama_singkat, COUNT(*) as kolombanding from guru a 
						left join jurusan b on a.kode_jurusan=b.kode_jurusan
						left join mengajar d on a.kode_guru=d.kode_guru
						left join jadwal c on c.kode_jadwal=d.kode_jadwal
						where a.status = 1 and c.kode_tahun='$tahunnya[0]' and c.semester='$tahunnya[1]' and d.status=4
						group by a.kode_guru
						order by kolombanding desc";
		} else if ($tipe == "4") {
			$query .= "SELECT a.kode_guru, a.nama_guru, b.nama_jurusan, b.nama_singkat, COUNT(*) as kolombanding from guru a 
						left join jurusan b on a.kode_jurusan=b.kode_jurusan
						left join mengajar d on a.kode_guru=d.kode_guru
						left join jadwal c on c.kode_jadwal=d.kode_jadwal
						where a.status = 1 and c.kode_tahun='$tahunnya[0]' and c.semester='$tahunnya[1]' and d.status=5
						group by a.kode_guru
						order by kolombanding desc";
		}
		$db_result = $this->db->query($query);
		$data['data'] = $db_result->result_array();
		// $data['title'] = $judul;
		echo json_encode($data);
	}


}
