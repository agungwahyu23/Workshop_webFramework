<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
	}
	public function index()
	{
		$data['title'] = "Dashboard Admin";
		$data['content'] = "dashboard/index";

		$hariini = Response_helper::hari_ini();
		$cekset = Data_helper::getdatarow('tahun_ajaran', 'aktif', '1');
		$tdy = date('Y-m-d');
		$set = Data_helper::get_setting();
		$data['jadwal'] = count($this->Maksi->getData("getjadwal", "where a.status = 1 and  a.hari='$hariini' and a.kode_tahun='$cekset[kode_tahun]' and a.semester='$set[semester]'"));
		$data['mengajar'] = count($this->Maksi->getData("getmengajar", "where h.mulai like '%$tdy%' and (h.status='2' or h.status='3')  order by h.mulai desc"));
		$wer = "where a.status=1 order by a.create_at desc";
		$data['izin'] = count($this->Maksi->getData("getijin", $wer));
		$wer = " WHERE a.kode_tahun='$cekset[kode_tahun]' and h.status=1 order by h.create_at desc";
		$data['permintaan'] = count($this->Maksi->getData("getpermintaan", $wer));
		$keyone =date('Y-m-d'). ' 00:00:01';
		$keytwo =date('Y-m-d'). ' 23:59:59';
		$wer = " WHERE h.mulai >= '$keyone' and h.mulai <= '$keytwo' and (h.status = 1 or h.status = 2)";
		$data['datamengajar'] = $this->Maksi->getData("getmengajar", $wer);
		$this->load->view('backend/index',$data);
	}

}
