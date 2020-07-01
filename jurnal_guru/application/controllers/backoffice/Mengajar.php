<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mengajar extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!$this->session->has_userdata('kode_pengguna') || $this->session->userdata('level')  != '1') {
			redirect(base_url());
		}
	}
	public function index()
	{
		$data['title'] = "Data Hasil Mengajar";
		$data['content'] = "mengajar/indexmengajar";

		$data['tahun'] = $this->Maksi->getData("gettahun");
		$this->load->view('backend/index', $data);
		// echo json_encode($data);
	}


	public function getapitipe()
	{
		$tipe = $this->input->post('tipenya');
		$jdl = "";
		if($tipe == "1"){
			$data = $this->Maksi->getData("getguru");
			$jdl = "Pilih Guru";
		} else if ($tipe == "2") {
			$data = $this->Maksi->getData("getmapel");
			$jdl = "Pilih Mata Pelajaran";
		} else if ($tipe == "3") {
			$data = $this->Maksi->getData("getkelas");
			$jdl = "Pilih Kelas";
		}

		$kirim = "<div class='form-group'><h5>".$jdl. " <span class='text-danger'>*</span></h5> <select class='form-control select2' required name='kode_tipe' id='kode_tipe'><option value=''>" . $jdl . "</option><option value='Semua'>Semua</option>";
		foreach ($data as $ky) {
			if ($tipe == "1") {
				$kirim .=  "<option value='".$ky['kode_guru']. "'>".$ky['nama_guru']."</option>";
			} else if ($tipe == "2") {
				$kirim .=  "<option value='" . $ky['kode_mapel'] . "'>" . $ky['nama_mapel'] . "</option>";
				
			} else if ($tipe == "3") {
				$kirim .=  "<option value='" . $ky['kode_kelas'] . "'>" . $ky['no_kelas'].' '. $ky['nama_singkat'].' '. $ky['rombel'] . "</option>";
				
			}
		}
		$kirim .= "</select></div>";
		echo $kirim;
	}

	function getalldata()
	{
		$tahunnya = $this->input->post('tahunnya');
		$tahunnya = explode("-", $tahunnya);
		$tglmulai = $this->input->post('tglmulai')." 00:00:01";
		$tglakhir = $this->input->post('tglakhir')." 23:59:59";
		$tipe = $this->input->post('tipenya');
		$kode_tipe = $this->input->post('kode_tipe');
		$wer = "";
		$wer .= " WHERE h.mulai >= '$tglmulai' and h.mulai <= '$tglakhir' and a.kode_tahun='$tahunnya[0]' and a.semester='$tahunnya[1]' ";
		$gettahun = $this->db->get_where('tahun_ajaran',['kode_tahun' => $tahunnya[0]])->row_array();
		$judul ="Data Mengajar Tahun Ajaran ". $gettahun['tahun'].' Semester '. ($tahunnya[1] == '1' ? 'Ganjil' : 'Genap').' Dara Tanggal ';
		$judul .= Response_helper::tanggal($this->input->post('tglmulai')).' s/d '. Response_helper::tanggal($this->input->post('tglakhir'));
		if ($tipe == "1" && $kode_tipe != 'Semua') {
			$wer .= "and h.kode_guru='$kode_tipe'";
		} else if ($tipe == "2" && $kode_tipe != 'Semua') {
			$wer .= "and a.kode_mapel='$kode_tipe'";
			
		} else if ($tipe == "3" && $kode_tipe != 'Semua') {
			$wer .= "and a.kode_kelas='$kode_tipe'";
		}
		$data['data'] = $this->Maksi->getData("getmengajar", $wer);
		$data['title'] = $judul;
		echo json_encode($data);
	}


	public function detailmengajar()
	{
		$id = $this->input->post('kode');
			$data= $this->Maksi->getDataSingle("getmengajar", " WHERE h.kode_mengajar='$id'");
		
		echo json_encode($data);
	}
	public function delete($id)
	{
		try {
			$this->Maksi->deleteData("req_guru","kode_req", $id);

			$this->session->set_flashdata("message", ['success', 'Berhasil Menghapus Permintaan Mengajar', ' Berhasil']);
			redirect(base_url("backoffice/permintaan"));
		} catch (Exception $e) {
			$this->session->set_flashdata("message", ['danger', 'Gagal Menghapus Permintaan Mengajar', ' Gagal']);
			redirect(base_url("backoffice/permintaan"));
		}
	}

}
