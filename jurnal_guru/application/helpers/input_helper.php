<?php
/**
*
*/
class Input_helper
{

	public static function postOrOr($index, $a = '', $b = '')
	{
		if(isset($_POST[$index]) && $_POST[$index]!='')
			return $_POST[$index];
		else if(isset($a))
			return $a;
		return $b;
	}
	public static function randomString($length){
		$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$char = '';
		for ($i=0; $i < $length; $i++) {
			$char.=$chars[rand(0, strlen($chars)-1)];
		}
		return $char;
	}
	public static function uploadImage($file, $dir){

		move_uploaded_file($file['tmp_name'], str_replace("system", "assets/upload/", BASEPATH)."/$dir/$file[name]");
	}
	public static function bersihkanangka($kalimat)
	{
		$re = array();
		$re[0] = ".";
		$re[1] = ",";
		$re[2] = "-";
		$dat = array();
		$dat[0] = "";
		$dat[1] = "";
		$dat[2] = "";
		return str_replace($re, $dat, $kalimat);
	}
	public static function comparejam($awal, $akhir)
	{
		$re = array();
		$re[0] = ":";
		$re[1] = ":";
		$dat = array();
		$dat[0] = "";
		$dat[1] = "";
		$awalnu = str_replace($re, $dat, $awal);
		$akhirnu = str_replace($re, $dat, $akhir);
		// return $awalnu.' '. $akhirnu;
		if((int)$awalnu <= (int)$akhirnu){
			// $hasil ="1";
			return true;
		}else {
			// $hasil = "0";
			return false;
		}

		// return $awalnu . '-' . $akhirnu . '-' . $hasil;
	}
}
