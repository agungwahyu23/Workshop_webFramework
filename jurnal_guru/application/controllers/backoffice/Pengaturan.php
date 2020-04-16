<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends CI_Controller {

	function __construct()
  	{
      parent::__construct();
	  $this->load->helper("Response_helper");
	  $this->load->helper("Input_helper");
	  $this->load->model("Maksi");
	  date_default_timezone_set('Asia/Jakarta');
		$this->load->library('session');
	  if(!isset($_SESSION['kode_pengguna']) || $_SESSION['level'] != '1'){
		  redirect(base_url());
	  }
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			$this->savepengaturan();
		}
	}	
	public function index(){

		$data['data'] = $this->db->get_where("pengaturan_app", ['kode' => 1])->row_array();
		$data['datahari'] = $this->Maksi->getData("gethari");	
		$data['title'] = "Pengaturan Aplikasi";
		$data['content'] = "dashboard/pengaturan";
		$this->load->view('backend/index', $data);
	}

	public function savepengaturan(){
		try{
			$arr = [
				'min_notif_jurusan' => $this->input->post('min_notif_jurusan', true),
				'min_notif_semua' => $this->input->post('min_notif_semua', true),
				'semester' => $this->input->post('semester', true),
				'email_cs' => $this->input->post('email_cs', true),
				'interval_kirim_auto' => $this->input->post('interval_kirim_auto', true),
				'aktif_kirim_auto' => $this->input->post('aktif_kirim_auto', true),
				'nohp' => $this->input->post('nohp', true),
				'gaji_lembur' => Input_helper::bersihkanangka($this->input->post('gaji_lembur', true)),
				'nowa' => $this->input->post('nowa', true),
				'smtp_user' => $this->input->post('smtp_user', true),
				'smtp_pass' => $this->input->post('smtp_pass', true),
				'smtp_host' => $this->input->post('smtp_host', true),
				'smtp_port' => $this->input->post('smtp_port', true),
				'key_fcm' => $this->input->post('key_fcm', true),
				'id_fcm' => $this->input->post('id_fcm', true),
			];
			$this->Maksi->updateData("pengaturan_app",$arr,1,"kode");

			$hari = $this->Maksi->getData("gethari");	
			$harinya = $this->input->post('hari', true);
			foreach ($hari as $hr) {
				$cek = 0;
				$arrku = [];
				foreach ($harinya as $hariku) {
					// echo $hariku;
					if($hariku == $hr['kode_hari']){
						$cek++;
					}
				}
				if($cek > 0){
					$arrku = [ 'aktif' => 1];
				}else {
					$arrku = ['aktif' => 0];

				}
				$this->Maksi->updateData("hari", $arrku, $hr['kode_hari'], "kode_hari");
			}
			$this->session->set_flashdata("message", ['success', 'Berhasil Menyimpan Pengaturan ', ' Berhasil']);
			redirect(base_url("backoffice/pengaturan"));
			// 
		}catch(Exception $e){
			$this->session->set_flashdata("message", ['danger', 'Gagal Menyimpan Pengaturan', ' Gagal']);
			redirect(base_url("backoffice/pengaturan"));
		}
	}
}
