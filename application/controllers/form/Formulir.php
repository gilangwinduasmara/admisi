<?php


class Formulir extends CI_Controller{
	public function data_diri(){
		$data = array(
			"page" => 'pages/pendaftaran/form/data_personal.php',
			"subheader" => [
				'Pendaftaran',
				'Data Camaru'
			]
		);
		$this->load->view('default', $data);
	}
	public function data_wali(){
		$data = array(
			"page" => 'pages/pendaftaran/form/data_wali.php',
			"subheader" => [
				'Pendaftaran',
				'Data Camaru'
			]
		);
		$this->load->view('default', $data);
	}
	
	public function data_pendidikan(){
		$data = array(
			"page" => 'pages/pendaftaran/form/data_pendidikan.php',
			"subheader" => [
				'Pendaftaran',
				'Data Camaru'
				]
			);
			$this->load->view('default', $data);
		}
		
	public function data_akademik(){
		$data = array(
			"page" => 'pages/pendaftaran/form/data_akademik.php',
			"subheader" => [
				'Pendaftaran',
				'Data Camaru'
			]
		);
		$this->load->view('default', $data);
	}

	public function unggah_berkas(){
		$data = array(
			"page" => 'pages/pendaftaran/form/unggah_berkas.php',
			"subheader" => [
				'Pendaftaran',
				'Data Camaru'
			]
		);
		$this->load->view('default', $data);
	}
	public function submit(){
		$data = array(
			"page" => 'pages/pendaftaran/form/submit.php',
			"subheader" => [
				'Pendaftaran',
				'Data Camaru'
			]
		);
		$this->load->view('default', $data);
	}
}
