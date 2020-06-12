<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Excel_import extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('excel_import_model');
		$this->load->library('excel');
	}

	function index()
	{
		$this->load->view('backend/import', $data);
	}
	
	function fetch()
	{
		$data = $this->excel_import_model->select();
		$output = '
		<table class="table table-striped table-bordered">
			<tr>
				<th>No</th>
				<th>Kelas</th>
				<th>Nama Guru</th>
				<th>Mata Pelajaran</th>
				<th>Tahun Ajaran</th>
				<th>Hari</th>
				<th>Jam Mulai</th>
				<th>Jam Selesai</th>
				<th>Minggu Ini</th>
				<th>Aksi</th>
			</tr>
		';
		$no = 1;
		foreach($data->result() as $row)
		{
			$output .= '
			<tr>
				<td>'.$no.'</td>
				<td>'.$row->no_kelas.''.$row->nama_singkat.''.$row->rombel.'</td>
				<td>'.$row->nama_guru.'</td>
				<td>'.$row->nama_mapel.'</td>
				<td>'.$row->tahun.'</td>
				<td>'.$row->hari.'</td>
				<td>'.$row->jam_awal.'</td>
				<td>'.$row->jam_akhir.'</td>
				
			</tr>
			';
		}
		$output .= '</table>';
		echo $output;
	}
	function import()
	{
		if(isset($_FILES["file"]["name"]))
		{
			$path = $_FILES["file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				for($row=2; $row<=$highestRow; $row++)
				{
					$no = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$kelas = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$nama_guru = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$mata_pelajaran = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$hari = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$jamawal = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
					$jamakhir = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
					$minggu_ini = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
					$aksi = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
					$data[] = array(
						'No'					=>	$no,
						'kode_kelas'			=>	$kelas,
						'kode_guru'				=>	$nama_guru,
						'kode_mapel'			=>	$mata_pelajaran,
						'hari'					=>	$hari,
						'jam_awal'				=>	$jamawal,
						'jam_akhir'				=>	$jamakhir,
						'minggu_ini'			=>	$minggu_ini,
						'aksi'					=>	$aksi
					);
				}
			}
			$this->excel_import_model->insert($data);
			echo 'Data Imported successfully';
		}	
	}
}
	

?>