<?php
/**
*
*/
class Data_helper
{

	public static function get_setting()
	{
		$ci = get_instance();
		$cekData = $ci->db->get_where("pengaturan_app", ['kode' => 1])->row_array();
		return $cekData;
		
	}


	public static function getdata($tabel, $kolom, $isi, $kolomreturn)
	{
		$ci = get_instance();
		$cekData = $ci->db->get_where($tabel, [$kolom => $isi])->row_array();
		if ($cekData) {
			return $cekData[$kolomreturn];
		} else {
			return null;
		}
	}

	public static function getdatarow($tabel, $kolom, $isi)
	{
		$ci = get_instance();
		$cekData = $ci->db->get_where($tabel, [$kolom => $isi])->row_array();
		if ($cekData) {
			return $cekData;
		} else {
			return null;
		}
	}
	
}
