<?php

class Pendaftaran extends CI_Controller
{
	private $akun_id;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('jenjang_model');
		$this->load->model('pendaftaran_model');
		$this->load->model('jenis_pembayaran_model');
		$this->load->model('pembayaran_model');
		$this->load->model('hasil_penerimaan_model');
		$this->akun_id = $this->session->userdata('id');
		if(empty($this->session->userdata('id'))){
			redirect('/login');
		}else{
			if($this->session->userdata('role')!='USER'){
				redirect('/');
			}
		}
	}
	

	public function data_camaru()
	{
		$akun_id = $this->session->userdata('id');
		$pendaftarans = $this->pendaftaran_model->findByAkunId($akun_id);
		$data = array(
			"page" => 'pages/pendaftaran/data_camaru.php',
			"subheader" => [
				'Pendaftaran',
				'Data Camaru'
			],
			"pendaftarans" => $pendaftarans
		);
		$this->load->view('default', $data);
	}
	public function formulir()
	{
		$jenjangs = $this->jenjang_model->get();
		$data = array(
			"page" => 'pages/pendaftaran/formulir.php',
			"subheader" => [
				'Pendaftaran',
				[
					'text' => 'Data Camaru',
					'href' => '/pendaftaran/data_camaru'
				],
				'Formulir'
			],
			"jenjangs" => $jenjangs
		);
		$this->load->view('default', $data);
	}
	public function informasi_pembayaran()
	{
		$pendaftaran = $this->pendaftaran_model->find($this->input->get("id"));
		$jenis_pembayarans = $this->jenis_pembayaran_model->get();
		if($pendaftaran){
			if($pendaftaran['akun_id'] != $this->akun_id){
				$pendaftaran = null;
				$this->session->set_flashdata('errors', ["Terjadi Kesalahan"]);
			}
		} else{
			$this->session->set_flashdata('errors', ["Data tidak ditemukan"]);
		}

		$data = array(
			"page" => 'pages/pendaftaran/informasi_pembayaran.php',
			"subheader" => [
				'Pendaftaran',
				[
					'text' => 'Data Camaru',
					'href' => '/pendaftaran/data_camaru'
				],
				'Informasi Pembayaran'
			],
			"pendaftaran" => $pendaftaran,
			"jenis_pembayarans" => $jenis_pembayarans
		);
		
		$this->load->view('default', $data);
	}
	
	public function upload_pembayaran()
	{
		$pendaftaran = $this->pendaftaran_model->find($this->input->get("id"));
		$pembayaran = $this->pembayaran_model->findByPendaftaranId($pendaftaran['id']);
		$isValidating = $this->pembayaran_model->isValidating($pendaftaran['id']);
		$data = array(
			"page" => 'pages/pendaftaran/upload_bukti_pembayaran.php',
			"subheader" => [
				'Pendaftaran',
				[
					'text' => 'Data Camaru',
					'href' => '/pendaftaran/data_camaru'
				],
				'Upload Bukti Pembayaran'
			],
			"pendaftaran" => $pendaftaran,
			"pembayaran" => $pembayaran,
			"isValidating" => $isValidating
		);

		$this->load->view('default', $data);
	}
	public function hasil_penerimaan()
	{
		$pendaftaran = $this->pendaftaran_model->findByAkunId($this->session->userdata('id'));
		$data = array(
			"page" => 'pages/pendaftaran/hasil_penerimaan.php',
			"subheader" => [
				'Pendaftaran',
				'Hasil Penerimaan'
			],
			'pendaftaran' => $pendaftaran
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
