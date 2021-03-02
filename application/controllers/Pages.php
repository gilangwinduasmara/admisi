<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Pages extends CI_Controller{

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pengumuman_model');
	}
	

	public function landing(){
		$data = array(
			'page' => 'pages/index.php'
		);
		// $this->load->database();
		$this->load->view('default', $data);
	}

	// auth
	public function register()
	{
		$this->load->library('session');
		$data = array(
			'page' => 'pages/register.php'
		);
		// $this->load->database();
		$this->load->view('default', $data);
	}


	public function login()
	{
		$data = array(
			'page' => 'pages/login.php'
		);
		// $this->load->database();
		$this->load->view('default', $data);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/');
	}

	public function pengumuman(){
		if(empty($this->input->get('id'))){
			$pengumuman = $this->pengumuman_model->get();
			$data = array(
				'page' => 'pages/pengumuman.php',
				'pengumuman' => $pengumuman
			);
		}else{
			$pengumuman = $this->pengumuman_model->find($this->input->get('id'));
			if(empty($pengumuman)){
				redirect('/pengumuman');
			}
			$data = array(
				'page' => 'pages/pengumuman_detail.php',
				'pengumuman' => $pengumuman,
				"subheader" => [
					[
						'text' => 'Pengumuman',
						'href' => '/pengumuman'
					],
					"Detail Pengumuman"
				],
			);
		}
		$this->load->view('default', $data);
	}

	public function scrap_sekolah(){
		$data = array(
			'page' => 'pages/scrap-sekolah.php',
		);
		$this->load->view('default', $data);
	}

}
