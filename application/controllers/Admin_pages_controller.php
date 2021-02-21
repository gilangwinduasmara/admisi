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

}

/* End of file Admin_pages_controller.php */
