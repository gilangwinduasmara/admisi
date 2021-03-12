<?php 

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

defined('BASEPATH') OR exit('No direct script access allowed');

class ExportDaerah extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('provinsi_model');
		$this->load->model('kota_model');
		$this->load->model('kecamatan_model');
		$this->load->model('kelurahan_model');
	}
	

	public function index()
	{
		$provinsi = $this->provinsi_model->get();
		$kota = $this->kota_model->get();
		$kecamatan = $this->kecamatan_model->get();
		$kelurahan = $this->kelurahan_model->get();

		

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'Provinsi');
		$sheet->setCellValue('D1', 'Kota');
		$sheet->setCellValue('H1', 'Kecamatan');
		$sheet->setCellValue('L1', 'Provinsi');

		foreach($provinsi as $key=>$item){
			$sheet->setCellValue('A'.($key+4), $item['id']);
			$sheet->setCellValue('B'.($key+4), $item['provinsi']);
		}
		foreach($kota as $key=>$item){
			$sheet->setCellValue('D'.($key+4), $item['id']);
			$sheet->setCellValue('E'.($key+4), $item['kota_kab']);
			$sheet->setCellValue('F'.($key+4), $item['provinsi_id']);
		}
		foreach($kecamatan as $key=>$item){
			$sheet->setCellValue('H'.($key+4), $item['id']);
			$sheet->setCellValue('I'.($key+4), $item['kecamatan']);
			$sheet->setCellValue('J'.($key+4), $item['kota_id']);
		}
		foreach($kelurahan as $key=>$item){
			$sheet->setCellValue('L'.($key+4), $item['id']);
			$sheet->setCellValue('M'.($key+4), $item['kecamatan']);
			$sheet->setCellValue('N'.($key+4), $item['kota_id']);
		}

		$writer = new Xlsx($spreadsheet);
		$writer->save('daerah.xlsx');
	}

}

/* End of file ExportDaerah.php */
