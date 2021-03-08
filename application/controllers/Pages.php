<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Pages extends CI_Controller{

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pengumuman_model');
		$this->load->model('akun_model');
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

	public function request_verification(){
		$akun = $this->akun_model->find($this->session->userdata('id'));
		if(!empty($akun->email_verified_at)){
			redirect('login');
		}
		$verificationCode = $this->akun_model->generateVerificationEmail($akun->id);
		$this->session->set_flashdata('success', ['Link aktivasi telah dikirim ke email anda '.base_url('/verify?code='.$verificationCode)]);
		redirect('verify');
	}

	public function verify()
	{
		$akun_id = $this->session->userdata('id');
		if(empty($akun_id)){
			redirect('login');
		}
		$akun = $this->akun_model->find($akun_id);
		if(!empty($akun->email_verified_at)){
			redirect('data_camaru');
		}
		$code = $this->input->get('code');
		if(empty($code)){
			$data = array(
				'page' => 'pages/verify.php'
			);
		}else{
			$valid = $this->akun_model->verify($akun_id, $code);
			if($valid){
				$this->session->unset_userdata('not_validated');
			}
			$data = array(
				'page' => 'pages/verify_with_code.php',
				'valid' => $valid
			);
		}
		
		$this->load->view('default', $data);
	}

	public function login()
	{
		$data = array(
			'page' => 'pages/login.php'
		);
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
