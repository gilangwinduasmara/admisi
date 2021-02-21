<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Pages extends CI_Controller{
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

}
