<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_pages_controller extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pendaftaran_model');
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
		$pendaftaran = $this->pendaftaran_model->get(true);
		$data = array(
			'page' => 'pages/admin/data_camaru.php',
			'pendaftaran' => $pendaftaran
		);
		$this->load->view('default', $data);
	}

	public function data_registrasi_ulang(){
		$registrasi_ulang = $this->registrasi_ulang_model->get();
		$data = array(
			'page' => 'pages/admin/data_reg_ulang.php',
			'registrasi_ulang' => $registrasi_ulang
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

}

/* End of file Admin_pages_controller.php */
