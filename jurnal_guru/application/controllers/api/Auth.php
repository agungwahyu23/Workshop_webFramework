<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
class Auth extends REST_Controller  
 {

 	function __construct()
 	{
 		parent::__construct();
 		$this->load->helper("Input_helper");
        $this->load->model("Maksi");
        date_default_timezone_set('Asia/Jakarta');
 	}
 	public function index()
 	{
		header("Access-Control-Allow-Origin: *");
		header("Content-Type: application/json; charset=UTF-8");
	
	 }
	 
	 public function authlogin_post(){
		$email = $this->post('emailnya', TRUE);
		$password = $this->post('passwordnya', TRUE);

		$cekData = $this->db->get_where("pengguna", ['email' => $email])->row_array();
		if($cekData > 1 && password_verify($password, $cekData['password'])){
			if($cekData['level'] == '1'){
				$data['datauser'] = null;
				$data['respon'] = [
					'pesan' => 'Invalid Akses',
					'status' => false,
					'code' => 403
				];	
			} else if ($cekData['status'] != '1') {
				$data['datauser'] = null;
				$data['respon'] = [
					'pesan' => 'Akun Anda Telah Di Non Aktifkan',
					'status' => false,
					'code' => 403
				];
			}else {

				$kodeku = $this->Maksi->random_semua(128);
				$arr = ['last_login' =>  date('Y-m-d H:i:s'),
						'last_api' =>  $kodeku];
				$this->Maksi->updateData("pengguna", $arr, $cekData['kode_pengguna'], "kode_pengguna");

				$data['datauser'] = [
					'login_as' => $cekData['level'],
					'kode_pengguna' => $cekData['kode_pengguna'],
					'nama_pengguna' => $cekData['nama_pengguna'],
					'akses_data' => $cekData['akses_data'],
					'token' => $arr['last_api'],
				];
				$data['respon'] = [
					'pesan' => 'Login Berhasil',
					'status' => true,
					'code' => 200
				];
			}
		}else{
			$data['datauser'] = null;
			$data['respon'] = [
			'pesan' => 'Login Gagal, Username / Password Salah',
			'status' => false,
			'code' => 403
			];			
		}

		$this->response($data, 200);
	 }
     public function authlogout_put()
	{
		$kode = $this->input->get_request_header('token', TRUE);
		$cek = $this->Maksi->getDataSingle("detailtoken", $kode);
		
        $arrdatauser = ['last_token' => "",'last_api' => ""];
        $this->Maksi->updateData("pengguna",$arrdatauser, $cek['kode_pengguna'],"kode_pengguna");
          $data['respon'] = [
            'pesan' => 'Berhasil Keluar Dari Akun',
			'status' => true,
			'code' => 200
          ];

		$this->response($data, 200);
	}

	public function detailakun_get()
	{

		$kode = $this->input->get_request_header('token', TRUE);
		$cek = $this->Maksi->getDataSingle("detailtoken", $kode);
		if ($cek > 1) {
			$data['respon'] = [
				"pesan" => "Berhasil",
				'status' => true,
				'code' => 200
			];
			if($cek['level'] == '2'){
				$dat = $this->db->get_where("guru", ['kode_guru' => $cek['akses_data']])->row_array();
				$data['data']['namanya'] = $dat['nama_guru'];
				$data['data']['emailnya'] = $cek['email'];
			} else if ($cek['level'] == '3') {
				$dat = $this->Maksi->getDataSingle('getkelas', $cek['akses_data']);
				$data['data']['namanya'] = $dat['no_kelas'] . ' '. $dat['nama_singkat'].' '. $dat['rombel'];
				$data['data']['emailnya'] = $cek['email'];
			}else{
				$data['respon'] = [
					"pesan" => "Invalid Akses",
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


	public function gantiemailpass_post()
	{

		$kode = $this->input->get_request_header('token', TRUE);
		$cek = $this->Maksi->getDataSingle("detailtoken", $kode);
		if ($cek > 1) {
			$email = $this->input->post('email', TRUE);
			$passlama = $this->input->post('passlama', TRUE);
			$passbaru = $this->input->post('passbaru', TRUE);
			$cekDataEmail = $this->db->get_where("pengguna", ['email' => $email, 'kode_pengguna !=' => $cek['kode_pengguna']])->row_array();
			if ($cekDataEmail > 1) {
				$data['respon'] = [
					'pesan' => 'Username Telah Terpakai',
					'status' => false,
					'code' => 403
				];
			} else {
				$ceklama = $this->db->get_where("pengguna", ['kode_pengguna' => $cek['kode_pengguna']])->row_array();
				if (password_verify($passlama, $ceklama['password'])) {
					$arr = ['email' => $email];
					if($passbaru != "") {
						$arr['password'] = password_hash($passbaru, PASSWORD_BCRYPT);

					}
					$this->Maksi->updateData("pengguna", $arr, $cek['kode_pengguna'], "kode_pengguna");	
					$data['respon'] = [
						'pesan' => 'Berhasil Edit Data',
						'status' => true,
						'code' => 200
					];

				}else {
					$data['respon'] = [
						'pesan' => 'Password Lama Salah',
						'status' => false,
						'code' => 403
					];

				}
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


	public function settokennotifikasi_post()
	{

		$kode = $this->input->get_request_header('token', TRUE);
		$cek = $this->Maksi->getDataSingle("detailtoken", $kode);
		if ($cek > 1) {

			$arr = [
				'last_token' => $this->input->post('tokennotif', TRUE)
			];
			$this->Maksi->updateData("pengguna", $arr, $cek['kode_pengguna'], "kode_pengguna");
				$data['respon'] = [
					"pesan" => "Berhasil Update Token",
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