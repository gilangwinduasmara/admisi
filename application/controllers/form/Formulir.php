<?php


class Formulir extends CI_Controller{
	private $pendaftaran;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pendaftaran_model');
		$this->load->model('fakultas_model');
		$this->load->model('prodi_model');
		$this->load->model('detail_pendidikan_model');
		$this->pendaftaran = $this->pendaftaran_model->find($this->input->get('id'));
		
	}
	
	public function data_diri(){
		$data_diri = $this->pendaftaran;
		$data = array(
			"page" => 'pages/pendaftaran/form/data_personal.php',
			"subheader" => [
				'Pendaftaran',
				'Data Camaru'
			],
			"pendaftaran" => $this->pendaftaran,
			'data_diri' => $data_diri
		);
		
		$this->load->view('default', $data);
	}

	public function data_wali(){
		$data_wali = $this->session->userdata('form')[$this->input->get('id')]['data_wali'] ?? null;
		$data_wali = $this->pendaftaran['detail_wali'];
		$data = array(
			"page" => 'pages/pendaftaran/form/data_wali.php',
			"subheader" => [
				'Pendaftaran',
				'Data Camaru'
			],
			"pendaftaran" => $this->pendaftaran,
			'data_wali' => $data_wali
		);
		$this->load->view('default', $data);
	}
	
	public function data_pendidikan(){
		$pendidikan = $this->pendaftaran['detail_pendidikan'];
		$d = array();
		if(count($pendidikan)>0){
			for($i=0; $i<count($pendidikan); $i++){
				$d['status_pendidikan[]'][$i] = $pendidikan[$i]['status'];
				$d['npsn[]'][$i] = $pendidikan[$i]['npsn'];
				$d['jurusan[]'][$i] = $pendidikan[$i]['jurusan'];
				$d['tahun_masuk[]'][$i] = $pendidikan[$i]['tahun_masuk'];
				$d['tahun_lulus[]'][$i] = $pendidikan[$i]['tahun_lulus'];
				$d['sekolah[]'][$i] = $pendidikan[$i]['sekolah_id'];
				$d['detail_alamat[]'][$i] = $pendidikan[$i]['detail_alamat'] ?? null;
			}
		}
		$data_pendidikan = $d;
		$data = array(
			"page" => 'pages/pendaftaran/form/data_pendidikan.php',
			"subheader" => [
				'Pendaftaran',
				'Data Camaru'
				],
				"pendaftaran" => $this->pendaftaran,
				"data_pendidikan" => $data_pendidikan
			);
			$this->load->view('default', $data);
		}
		
	public function data_akademik(){
		$prodi = $this->prodi_model->get();
		$data_akademik = $this->session->userdata('form')[$this->input->get('id')]['data_akademik'] ?? null;
		$data = array(
			"page" => 'pages/pendaftaran/form/data_akademik.php',
			"subheader" => [
				'Pendaftaran',
				'Data Camaru'
			],
			"pendaftaran" => $this->pendaftaran,
			"prodi" => $prodi,
			"data_akademik" =>$data_akademik
		);
		$this->load->view('default', $data);
	}

	public function unggah_berkas(){
		$data = array(
			"page" => 'pages/pendaftaran/form/unggah_berkas.php',
			"subheader" => [
				'Pendaftaran',
				'Data Camaru'
			],
			"pendaftaran" => $this->pendaftaran
		);
		$this->load->view('default', $data);
	}
	public function submit(){
		$data = array(
			"page" => 'pages/pendaftaran/form/submit.php',
			"subheader" => [
				'Pendaftaran',
				'Data Camaru'
			],
			"pendaftaran" => $this->pendaftaran
		);
		$this->load->view('default', $data);
	}
}
