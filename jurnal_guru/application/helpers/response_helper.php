<?php
/**
*
*/
class Response_helper
{

	public static function part($file)
	{
		include str_replace("system", "application/views/", BASEPATH) . "part/$file.php";
	}
	public static function price($price)
	{
		return "Rp " . number_format($price, 0, ',', '.');
	}
	public static function uang($price)
	{
		return number_format($price, 0, ',', '.');
	}
	public static function doublekoma($price)
	{
		$foo =($price == null || $price == '' ? 0 : $price);
		echo number_format((float) $foo, 2, '.', '');
	}
	public static function tanggal($tgl)
	{
		$qq='';
		$k = explode("-",$tgl);
		$bln = array('', 'Januari', 'Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember' );
		$qq = $k[2].' '.$bln[(int)$k[1]].' '.$k[0];
		return $qq;
	}
	public static function tanggalrange($tgl)
	{
		$qq='';
		$k = explode("/",$tgl);
		$bln = array('', 'Januari', 'Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember' );
		$qq = $k[1].' '.$bln[(int)$k[0]].' '.$k[2];
		return $qq;
	}
	public static function waktu($tgl)
	{
		$qq='';
		$k = explode(" ",$tgl);
		$kk = explode("-",$k[0]);
		$bln = array('', 'Januari', 'Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember' );
		
		$qq = $kk[2].' '.$bln[(int)$kk[1]].' '.$kk[0].' '.$k[1];
		return $qq;
	}
	public static function waktupersen($tgl)
	{
		$qq='';
		$k = explode("%",$tgl);
		$kk = explode("-",$k[0]);
		$bln = array('', 'Januari', 'Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember' );
		
		$qq = $kk[2].' '.$bln[(int)$kk[1]].' '.$kk[0].' '.$k[1];
		return $qq;
	}
	public static function render($file, $var = []){
		extract($var);
		include str_replace("system", "application/views", BASEPATH)."/".$file.".php";
	}

	public static function cetak($kata)
	{
		return htmlentities($kata, ENT_QUOTES, 'UTF-8');
	}

	public static function bulantahun($tgl)
	{
		$qq = '';
		$k = explode("-", $tgl);
		$bln = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
		$qq = $bln[$k[1]] . ' ' . $k[0];
		return $qq;
	}
	public static function tanggalbulan($tgl)
	{
		$qq = '';
		$k = explode("-", $tgl);
		$bln = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
		$qq = $bln[$k[0]] . ' ' . $k[1];
		return $qq;
	}

	public static function tahunbulan($tgl)
	{
		$qq = '';
		$k = explode("-", $tgl);
		$bln = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
		$qq = $bln[$k[1]] . ' ' . $k[0];
		return $qq;
	}


	public static function hari_ini()
	{
		$hari = date("D");

		switch ($hari) {
			case 'Sun':
				$hari_ini = "Minggu";
				break;

			case 'Mon':
				$hari_ini = "Senin";
				break;

			case 'Tue':
				$hari_ini = "Selasa";
				break;

			case 'Wed':
				$hari_ini = "Rabu";
				break;

			case 'Thu':
				$hari_ini = "Kamis";
				break;

			case 'Fri':
				$hari_ini = "Jumat";
				break;

			case 'Sat':
				$hari_ini = "Sabtu";
				break;

			default:
				$hari_ini = "Tidak di ketahui";
				break;
		}

		return $hari_ini;
	}

	public static function rentangwaktu($mulai, $akhir, $tipe = 1)
	{
		$lama = '';
		$date1 = new DateTime($mulai);
		$date2 = new DateTime($akhir);
		$interval = $date2->diff($date1);
		if ($tipe == 1) {
			$lama = $interval->format('%Y Tahun, %m Bulan, %d Hari');
		} else if ($tipe == 2) {
			$lama = $interval->format('%m Bulan, %d Hari');
		} else if ($tipe == 3) {
			$lama = $interval->format('%d Hari');
		} else if ($tipe == 4) {
			$lama = $interval->format('%d Hari %h Jam');
		} else if ($tipe == 5) {
			$lama = $interval->format('%i');
		}

		return $lama;
	}
	public static function bandingkanWaktu($mulai, $akhir, $timenow)
	{
		$mulaitmp = explode(":", $mulai);
		$akhirtmp = explode(":", $akhir);
		$timenowtmp = explode(":", $timenow);
		$mulaicek = ''. $mulaitmp[0] . $mulaitmp[1] .  $mulaitmp[2];
		$akhircek = $akhirtmp[0]. $akhirtmp[1]. $akhirtmp[2];
		$timenowcek = $timenowtmp[0] . $timenowtmp[1] . $timenowtmp[2];
		// return $mulaicek;
		if ((int)$mulaicek <= (int)$timenowcek && (int)$akhircek >= (int)$timenowcek) {
			return true;
		} else{
			return false;
		}
	}

}
