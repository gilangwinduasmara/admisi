<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_pages_controller extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pendaftaran_model');
		$this->load->model('jalur_pendaftaran_model');
		$this->load->model('pengumuman_model');
		$this->load->model('akun_model');
		if(current_url() != base_url('admin/login')){
			if(empty($this->session->userdata('id'))){
				redirect('/login');
			}else{
				if($this->session->userdata('role')=='USER'){
					redirect('/');
				}
			}
		}
	}
	

	public function login()
	{
		if(!empty($this->session->userdata('id'))){
			redirect('/admin/data_pendaftar');
		}
		$data = array(
			'page' => 'pages/admin/login.php'
		);
		$this->load->view('default', $data);
	}

	public function data_pendaftar(){
		$pendaftaran = $this->pendaftaran_model->get();
		$data = array(
			'page' => 'pages/admin/data_pendaftar.php',
			'pendaftaran' => $pendaftaran
		);
		$this->load->view('default', $data);
	}

	public function data_camaru(){
		// $pendaftaran = $this->pendaftaran_model->get(true);
		$prodi = $this->prodi_model->get();
		$jalur_pendaftaran = $this->jalur_pendaftaran_model->get();
		$data = array(
			'page' => 'pages/admin/data_camaru.php',
			'prodi' => $prodi,
			'jalur_pendaftaran' => $jalur_pendaftaran,
			// 'pendaftaran' => $pendaftaran
		);
		$this->load->view('default', $data);
	}

	public function data_registrasi_ulang(){
		$registrasi_ulang = $this->registrasi_ulang_model->get();
		$prodi = $this->prodi_model->get();
		$data = array(
			'page' => 'pages/admin/data_reg_ulang.php',
			'registrasi_ulang' => $registrasi_ulang,
			'prodi' => $prodi
		);
		$this->load->view('default', $data);
	}

	public function data_omb(){
		$daftar_omb = $this->daftar_omb_model->get();
		$data = array(
			'page' => 'pages/admin/data_omb.php',
			'daftar_omb' => $daftar_omb
		);
		$this->load->view('default', $data);
	}

	public function pengumuman(){
		$daftar_omb = $this->daftar_omb_model->get();
		$pengumuman = $this->pengumuman_model->get();
		$data = array(
			'page' => 'pages/admin/pengumuman.php',
			'pengumuman' => $pengumuman
		);
		$this->load->view('default', $data);
	}

	public function pengumuman_edit(){
		$daftar_omb = $this->daftar_omb_model->get();
		$pengumuman = $this->pengumuman_model->find($this->input->get('id'));
		$data = array(
			'page' => 'pages/admin/pengumuman_edit.php',
			'pengumuman' => $pengumuman
		);
		$this->load->view('default', $data);
	}

	public function data_user(){
		$data = array(
			'page' => 'pages/admin/data_user.php',
		);
		$this->load->view('default', $data);
	}

}

/* End of file Admin_pages_controller.php */
