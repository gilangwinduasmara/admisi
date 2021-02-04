<?php

class Pendaftaran extends CI_Controller
{
	public function data_camaru()
	{
		$data = array(
			"page" => 'pages/pendaftaran/data_camaru.php',
			"subheader" => [
				'Pendaftaran',
				'Data Camaru'
			]
		);
		$this->load->view('default', $data);
	}
	public function formulir()
	{
		$data = array(
			"page" => 'pages/pendaftaran/formulir.php',
			"subheader" => [
				'Pendaftaran',
				'Data Camaru'
			]
		);
		$this->load->view('default', $data);
	}
	public function informasi_pembayaran()
	{
		$data = array(
			"page" => 'pages/pendaftaran/informasi_pembayaran.php',
			"subheader" => [
				'Pendaftaran',
				'Data Camaru',
				'Informasi Pembayaran'
			]
		);
		$this->load->view('default', $data);
	}
	public function upload_pembayaran()
	{
		$data = array(
			"page" => 'pages/pendaftaran/upload_bukti_pembayaran.php',
			"subheader" => [
				'Pendaftaran',
				'Data Camaru',
				'Upload Bukti Pembayaran'
			]
		);
		$this->load->view('default', $data);
	}
	public function hasil_penerimaan()
	{
		$data = array(
			"page" => 'pages/pendaftaran/hasil_penerimaan.php',
			"subheader" => [
				'Pendaftaran',
				'Hasil Penerimaan'
			]
		);
		$this->load->view('default', $data);
	}
	public function registrasi_ulang()
	{
		$data = array(
			"page" => 'pages/pendaftaran/registrasi_ulang.php',
			"subheader" => [
				'Pendaftaran',
				'Registrasi Ulang'
			]
		);
		$this->load->view('default', $data);
	}
	public function omb()
	{
		$data = array(
			"page" => 'pages/pendaftaran/omb.php',
			"subheader" => [
				'Pendaftaran',
				'OMB'
			]
		);
		$this->load->view('default', $data);
	}
	public function data_personal()
	{
		$data = array(
			"page" => 'pages/pendaftaran/data_personal.php',
			"subheader" => [
				'Pendaftaran',
				'Isi Formulir Pendaftaran',
				'Data Personal'
			]
		);
		$this->load->view('default', $data);
	}
}
