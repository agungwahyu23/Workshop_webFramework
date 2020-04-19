<?php
/**
 *
 */
class Maksi extends CI_Model
{
  public function getData($tabel, $key=""){
    $query = "";
    if($tabel == "getjurusan"){
      $query = "SELECT a.*, b.nama_pengguna from jurusan a 
      left join pengguna b on a.create_by=b.kode_pengguna
      where a.status = 1
      order by a.nama_jurusan asc";
    } else if ($tabel == "getkelas") {
      $query = "SELECT a.*, b.nama_jurusan, b.nama_singkat, c.nama_pengguna from kelas a 
      left join jurusan b on a.kode_jurusan=b.kode_jurusan
      left join pengguna c on a.create_by=c.kode_pengguna
      where a.status = 1
      order by a.no_kelas asc";
    } else if ($tabel == "getmapel") {
      $query = "SELECT a.*, b.nama_pengguna from mapel a 
      left join pengguna b on a.create_by=b.kode_pengguna
      where a.status = 1
      order by a.nama_mapel asc";
    } else if ($tabel == "getguru") {
      $query = "SELECT a.*, b.nama_jurusan, b.nama_singkat, c.nama_pengguna, AVG(d.rating) as avgrating from guru a 
      left join jurusan b on a.kode_jurusan=b.kode_jurusan
      left join pengguna c on a.create_by=c.kode_pengguna
      left join mengajar d on a.kode_guru=d.kode_guru
      where a.status = 1
      group by a.kode_guru
      order by a.nama_guru asc";
    } else if ($tabel == "gettahun") {
      $query = "SELECT a.*, b.nama_pengguna from tahun_ajaran a 
      left join pengguna b on a.create_by=b.kode_pengguna
      where a.status = 1
      order by a.tahun asc";
    } else if ($tabel == "getpenarikan") {
      $query = "SELECT a.*, b.nama_pengguna, c.nama_guru from rw_reward a 
      left join pengguna b on a.create_by=b.kode_pengguna
      left join guru c on a.kode_guru=c.kode_guru
      where a.tipe = 1
      order by a.create_at desc";
    } else if ($tabel == "getjadwal") {
      $query = "SELECT a.*, b.no_kelas, b.rombel, c.nama_jurusan, c.nama_singkat, d.nama_mapel, e.nama_guru from jadwal a 
      left join kelas b on a.kode_kelas=b.kode_kelas
      left join jurusan c on b.kode_jurusan=c.kode_jurusan
      left join mapel d on a.kode_mapel=d.kode_mapel
      left join guru e on a.kode_guru=e.kode_guru
      left join hari g on a.hari=g.kode_hari
      $key
      ";
    } else if ($tabel == "getjadwalforcron") {
      $query = "SELECT a.*, b.no_kelas, b.rombel, c.nama_jurusan, c.nama_singkat, d.nama_mapel, e.nama_guru, f.last_token from jadwal a 
      left join kelas b on a.kode_kelas=b.kode_kelas
      left join jurusan c on b.kode_jurusan=c.kode_jurusan
      left join mapel d on a.kode_mapel=d.kode_mapel
      left join guru e on a.kode_guru=e.kode_guru
      left join hari g on a.hari=g.kode_hari
      left join pengguna f on e.kode_guru=f.akses_data
      $key
      ";
    } else if ($tabel == "getreqguru") {
      $query = "SELECT z.*, b.no_kelas, b.rombel, c.nama_jurusan, c.nama_singkat, d.nama_mapel, e.nama_guru from req_guru z 
      left join jadwal a on a.kode_jadwal=z.kode_jadwal
      left join kelas b on a.kode_kelas=b.kode_kelas
      left join jurusan c on b.kode_jurusan=c.kode_jurusan
      left join mapel d on a.kode_mapel=d.kode_mapel
      left join guru e on z.pick_by=e.kode_guru
      $key
      ";
    } else if ($tabel == "getmengajar") {
      $query = "SELECT h.*, a.hari, a.jam_awal, jam_akhir, a.this_week, a.status as stjadwal, b.no_kelas, b.rombel, c.nama_jurusan, c.nama_singkat, d.nama_mapel, e.nama_guru from mengajar h
      left join jadwal a on h.kode_jadwal=a.kode_jadwal 
      left join kelas b on a.kode_kelas=b.kode_kelas
      left join jurusan c on b.kode_jurusan=c.kode_jurusan
      left join mapel d on a.kode_mapel=d.kode_mapel
      left join guru e on a.kode_guru=e.kode_guru
      left join hari g on a.hari=g.kode_hari
      $key
      ";
    } else if ($tabel == "getpermintaan") {
      $query = "SELECT h.*, a.hari, a.jam_awal, jam_akhir, a.this_week, a.status as stjadwal, b.no_kelas, b.rombel, c.nama_jurusan, c.nama_singkat, d.nama_mapel, e.nama_guru from req_guru h
      left join jadwal a on h.kode_jadwal=a.kode_jadwal 
      left join kelas b on a.kode_kelas=b.kode_kelas
      left join jurusan c on b.kode_jurusan=c.kode_jurusan
      left join mapel d on a.kode_mapel=d.kode_mapel
      left join guru e on h.pick_by=e.kode_guru
      left join hari g on a.hari=g.kode_hari
      $key
      ";
    }  else if ($tabel == "getijin") {
      $query = "SELECT a.*, e.nama_guru from ijin_guru a 
      left join guru e on a.kode_guru=e.kode_guru
      $key
      ";
    } else if ($tabel == "pengguna") {
      $query = "SELECT a.*, b.no_kelas, b.rombel, c.nama_jurusan, c.nama_singkat, e.nama_guru from pengguna a 
      left join kelas b on a.akses_data=b.kode_kelas
      left join jurusan c on b.kode_jurusan=c.kode_jurusan
      left join guru e on a.akses_data=e.kode_guru
      $key
      order by a.nama_pengguna asc";
    } else if ($tabel == "gettoken") {
      $query = "SELECT a.last_token from pengguna a
      left join guru b on a.akses_data = b.kode_guru
      left join kelas c on a.akses_data = c.kode_kelas
      $key";
    } else if ($tabel == "gethari") {
      $query = "SELECT * from hari $key order by urutan asc";
    } else if ($tabel == "getriwayatupah") {
      $query = "SELECT a.*, b.nama_guru from rw_reward a 
      left join guru b on a.kode_guru=b.kode_guru 
      $key 
      order by a.create_at asc";
    }  else{
      $query = "SELECT * FROM ".$tabel." WHERE status = '1'";
    }
      $db_result = $this->db->query($query);
      $result_object = $db_result->result_array();
      return $result_object;
  }

  public function getDataSingle($tabel, $key){
    $query = "";
    if($tabel == "detailtoken"){
      $query = "SELECT * from pengguna where last_api='$key' and status='1'";
    } else if ($tabel == "getjadwal") {
      $query = "SELECT a.*, b.no_kelas, b.rombel, c.nama_jurusan, c.kode_jurusan, c.nama_singkat, d.nama_mapel, e.nama_guru from jadwal a 
      left join kelas b on a.kode_kelas=b.kode_kelas
      left join jurusan c on b.kode_jurusan=c.kode_jurusan
      left join mapel d on a.kode_mapel=d.kode_mapel
      left join guru e on a.kode_guru=e.kode_guru
      left join hari g on a.hari=g.kode_hari
      $key
      ";
    }  else if ($tabel == "getmengajar") {
      $query = "SELECT h. *, a.hari, a.jam_awal, jam_akhir, a.this_week, a.status as stjadwal, b.no_kelas, b.rombel, c.nama_jurusan, c.nama_singkat, d.nama_mapel, e.nama_guru from mengajar h
      left join jadwal a on h.kode_jadwal=a.kode_jadwal 
      left join kelas b on a.kode_kelas=b.kode_kelas
      left join jurusan c on b.kode_jurusan=c.kode_jurusan
      left join mapel d on a.kode_mapel=d.kode_mapel
      left join guru e on a.kode_guru=e.kode_guru
      left join hari g on a.hari=g.kode_hari
      $key
      ";
    }  else if ($tabel == "getijin") {
      $query = "SELECT a.*, e.nama_guru from ijin_guru a 
      left join guru e on a.kode_guru=e.kode_guru
      $key
      ";
    }  else if ($tabel == "getkelas") {
      $query = "SELECT a.*, b.nama_jurusan, b.nama_singkat, c.nama_pengguna from kelas a 
      left join jurusan b on a.kode_jurusan=b.kode_jurusan
      left join pengguna c on a.create_by=c.kode_pengguna
      where a.status = 1 and a.kode_kelas='$key'";
    } else if ($tabel == "getpermintaan") {
      $query = "SELECT h.*, a.hari, a.jam_awal, a.jam_akhir, a.kode_guru as kodeguruasli, a.this_week, a.status as stjadwal, b.no_kelas, b.rombel, c.nama_jurusan, c.nama_singkat, d.nama_mapel, e.nama_guru from req_guru h
      left join jadwal a on h.kode_jadwal=a.kode_jadwal 
      left join kelas b on a.kode_kelas=b.kode_kelas
      left join jurusan c on b.kode_jurusan=c.kode_jurusan
      left join mapel d on a.kode_mapel=d.kode_mapel
      left join guru e on h.pick_by=e.kode_guru
      left join hari g on a.hari=g.kode_hari
      $key
      ";
    }   else{
      $query = "SELECT * FROM ".$tabel." WHERE status != '0'";
    }
      $db_result = $this->db->query($query);
      $result_object = $db_result->row_array();
      return $result_object;
  }

  public function insertData($tabel, $arr){
    $cek = $this->db->insert($tabel, $arr);
    return $cek;
  }
  public function updateData($tabel, $arr, $id, $key){
    $cek = $this->db->update($tabel, $arr, [$key => $id]);
    return $cek;
  }
  public function deleteData($tabel, $key, $id){
    $cek = $this->db->delete($tabel, [$key => $id]);
    return $cek;
  }
  
	public function kirimotp($kodepengguna, $value, $subjek, $pesan=""){

		$kodeotp = $this->Maksi->random_oke(64);
		$kodenum = $this->Maksi->random_number(6);
		$arrotp = ['kode_otp' => $kodeotp,
      'kode_pengguna' => $kodepengguna,
      'key_otp' => $value['key_otp'],
      'tipe_key' => $value['tipe_key'],
      'keperluan' => $subjek,
      'kode' =>  $kodenum];
    $kk = $this->Maksi->insertData("otp",$arrotp);
    if($value['tipe_key'] == 1){
      $this->kirimemail($subjek, $value['key_otp'], $pesan, $kodenum, "#");
    }
    return $kk;
  }

  function random_number($maxlength) {
    $chary = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
    $return_str = "";
    for ( $x=0; $x<$maxlength; $x++ ) {
        $return_str .= $chary[rand(0, count($chary)-1)];
    }
    return $return_str;
  }

  function random_oke($maxlength) {
    $chary = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9",
                    "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
    $return_str = "";
    for ( $x=0; $x < $maxlength; $x++ ) {
        $return_str .= $chary[rand(0, count($chary)-1)];
    }
    return $return_str;
  }

  
  function random_semua($maxlength) {
    $chary = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z",
                    "0", "1", "2", "3", "4", "5", "6", "7", "8", "9",
                    "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
    $return_str = "";
    for ( $x=0; $x<$maxlength; $x++ ) {
        $return_str .= $chary[rand(0, count($chary)-1)];
    }
    return $return_str;
  }

  public function kirimemail($subject, $email, $keperluan, $txtbutton, $linkbutton)
  {
    $set = $this->db->get_where("pengaturan_app", ['kode' => 1])->row_array();
    $usernya = $this->db->get_where("pengguna", ['email' => $email])->row_array();
    $config = array(
    'protocol' => 'smtp',
    'smtp_host' => $set['smtp_host'],
    'smtp_port' => $set['smtp_port'],
    'smtp_user' => $set['smtp_user'],
    'smtp_pass' => $set['smtp_pass'],
    'mailtype' => 'html',
    'smtp_crypto' => 'ssl',
    'charset' => 'iso-8859-1'
    );

    $template = $set['template_email'];
    
    $tag = array();
    $tag[0] = "[app_name]";
    $tag[1] = "[email_cs]";
    $tag[2] = "[nama_user]";
    $tag[3] = "[keperluan]";
    $tag[4] = "[link_button]";
    $tag[5] = "[text_button]";
    $tag[6] = "[tahun]";
    $tag[7] = "[tag_button]";
    $datbaru = array();
    $datbaru[0] = $set['app_name'];
    $datbaru[1] = $set['email_cs'];
    $datbaru[2] = $usernya['nama_pengguna'];
    $datbaru[3] = $keperluan;
    $datbaru[4] = $linkbutton;
    $datbaru[5] = $txtbutton;
    $datbaru[6] = date("Y");
    $datbaru[7] = ($linkbutton == "#" ? "div" : "a");
    $templatekirim = str_replace($tag, $datbaru, $template);

    $this->load->library('email', $config);
    $this->email->set_newline("\r\n");

    $this->email->from($set['smtp_user'], $subject);
    $this->email->to($email);
    $this->email->cc($set['smtp_user']);

    $this->email->subject($subject);
    $this->email->message($templatekirim);

      $kirim = $this->email->send();
      return $kirim;
    }

  // public function setnotifikasi($tipe, $klmtipe, $judul, $deskripsi, $key){
  //   $arrtoken = [];
  //   $getus = $this->db->get_where('pengguna', [$klmtipe => 1, 'status' => 1])->result_array();
  //   foreach ($getus as $pp) {
  //     $arrnot = [
  //       'judul' => $judul,
  //       'deskripsi' => $deskripsi,
  //       'kode_pengguna' => $pp['kode_pengguna'],
  //       'tipe' => $tipe,
  //       'key_data' => $key,
  //       'create_at' => date("Y-m-d H:i:s")
  //     ];
  //     $this->insertData("notifikasi", $arrnot);
  //     $arrtoken[] = $pp['last_token'];
  //   }
  //   $aa = $this->send_notification($arrtoken, $tipe, $judul, $deskripsi, $key);
  //   return $aa;
  // }
  public function send_notification($tokens, $title, $body, $link, $keylink = "")
  {
    $set = $this->db->get_where("pengaturan_app", ['kode' => 1])->row_array();
    $url = 'https://fcm.googleapis.com/fcm/send';

    $fields = array();

    $fields['notification'] = array(
      "title" => $title,
      "body" => $body
    );
    $fields['data'] = array(
      "link" => $link,
      "title" => $title,
      "body" => $body,
      "keylink" => $keylink
    );
    if (is_array($tokens)) {
      $fields['registration_ids'] = $tokens;
    } else {
      $fields['to'] = $tokens;
    }
    
    $headers = array(
      'Authorization: key='.$set['key_fcm'],
      'Content-Type: application/json'
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    if ($result === FALSE) {
      die('Curl failed: ' . curl_error($ch));
    }
    curl_close($ch);
    return $result;
  }
  public function _create_thumbs($path, $pathkecil, $foto, $width, $height)
  {
    try {
      // Image resizing config
      $config = array(

        // image Medium
        array(
          'image_library' => 'GD2',
          'source_image'  => './assets/upload/' . $path . $foto,
          'maintain_ratio' => FALSE,
          'width'         => (int) $width,
          'height'        => (int) $height,
          'new_image'     => './assets/upload/' . $pathkecil . $foto
        ),
        // Image Small
      );

      $this->load->library('image_lib', $config[0]);
      foreach ($config as $item) {
        $this->image_lib->initialize($item);
        if (!$this->image_lib->resize()) {
          return false;
        }
        $this->image_lib->clear();
      }
    } catch (Exception $e) { }
  }

}

 ?>
