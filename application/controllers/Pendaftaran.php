<?php

class Pendaftaran extends CI_Controller
{
	private $akun_id;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('jenjang_model');
		$this->load->model('jalur_pendaftaran_model');
		$this->load->model('pendaftaran_model');
		$this->load->model('jenis_pembayaran_model');
		$this->load->model('pembayaran_model');
		$this->load->model('hasil_penerimaan_model');
		$this->load->model('daftar_omb_model');
		$this->load->model('tahun_akademik_model');
		$this->load->model('jadwal_model');
		$this->akun_id = $this->session->userdata('id');
		if($this->session->userdata('not_validated')){
			redirect('/verify');
		}
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
		$tahun_akademik = $this->tahun_akademik_model->get();
		$data = array(
			"page" => 'pages/pendaftaran/data_camaru.php',
			"subheader" => [
				'Pendaftaran',
				'Data Camaru'
			],
			"pendaftarans" => $pendaftarans,
			"tahun_akademik" => $tahun_akademik
		);
		$this->load->view('default', $data);
	}
	public function formulir()
	{
		// cek jadwal
		$jadwal = $this->jadwal_model->find(idate('w', now()));
		$current_hour = (int)date('H');
		if($current_hour < $jadwal['jam_mulai'] || $current_hour >= $jadwal['jam_selesai']){
			$this->session->set_flashdata('warnings', ['Pendaftaran belum dibuka']);
			redirect('pendaftaran/data_camaru');
		}
		$jenjangs = $this->jenjang_model->get();
		$jalur_pendaftarans = $this->jalur_pendaftaran_model->get();
		$tahun_akademik = $this->tahun_akademik_model->findByStatus('AKTIF')[0]['tahun_akademik'] ?? null;
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
			"jenjangs" => $jenjangs,
			"jalur_pendaftarans" => $jalur_pendaftarans,
			"tahun_akademik" => $tahun_akademik 
		);
		$this->load->view('default', $data);
	}

	public function metode_pembayaran()
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
			"page" => 'pages/pendaftaran/metode_pembayaran.php',
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
	public function informasi_pembayaran()
	{
		$pendaftaran = $this->pendaftaran_model->find($this->input->get("id"));
		if($pendaftaran['akun_id'] != $this->session->userdata('id')){
			redirect('pendaftaran/data_camaru');
		}
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
		if($pendaftaran['akun_id'] != $this->session->userdata('id')){
			redirect('pendaftaran/data_camaru');
		}
		$pembayaran = $this->pembayaran_model->findByPendaftaranId($pendaftaran['id']);
		$isValidating = $this->pembayaran_model->isValidating($pendaftaran['id']);
		if(empty($pendaftaran['pembayaran'])){
			redirect('pendaftaran/informasi_pembayaran?id='.$this->input->get("id"));
		}
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
		$jenis_pembayaran = $this->jenis_pembayaran_model->get();
		$pendaftaran = $this->pendaftaran_model->findByAkunId($this->session->userdata('id'), true);
		$data = array(
			"page" => 'pages/pendaftaran/registrasi_ulang.php',
			"subheader" => [
				'Pendaftaran',
				'Registrasi Ulang'
			],
			"pendaftaran" => $pendaftaran,
			"jenis_pembayaran" => $jenis_pembayaran
		);
		$this->load->view('default', $data);
	}
	public function omb()
	{
		
		$daftar_omb = $this->pendaftaran_model->findByVerifiedRegistrasiUlang($this->session->userdata('id'));
		
		$data = array(
			"page" => 'pages/pendaftaran/omb.php',
			"subheader" => [
				'Pendaftaran',
			],
			'daftar_omb' => $daftar_omb
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
