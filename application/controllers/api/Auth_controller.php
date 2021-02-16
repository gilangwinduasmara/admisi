<?php

class Auth_controller extends CI_Controller
{

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('akun_model');
	}
	

	public function login(){
		$this->form_validation->set_rules('email', 'Email', 'required');		
		$this->form_validation->set_rules('password', 'Password', 'required');		
		
		if($this->form_validation->run() == FALSE){
			$errors = $this->form_validation->error_array();
			foreach($errors as $error){
				echo $error;
			}
			$this->session->set_flashdata('errors', $errors);
			$this->session->set_flashdata('input', $this->input->post());
		}else{
			$akun = $this->akun_model->findByEmail($this->input->post('email'));
			if($akun && password_verify($this->input->post('password'), $akun->password)){
				$user_data = array(
					'id' => $akun->id,
				);
				$this->session->set_flashdata('success', ['Login berhasil']);
				$this->session->set_userdata( $user_data );
				redirect("/pendaftaran/data_camaru")				;
			}else{
				$this->session->set_flashdata('input', $this->input->post());
				$this->session->set_flashdata('errors', ['Email atau password yang anda masukkan salah']);
				redirect("/login");
			}
		}
	}

	public function register(){
		
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('no_hp', 'No Hp', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[32]');
		$this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|min_length[8]|max_length[32]');

		if($this->form_validation->run() == FALSE){
			$errors = $this->form_validation->error_array();
			$this->session->set_flashdata('errors', $errors);
			$this->session->set_flashdata('input', $this->input->post());
			redirect('register');
		}else{
			$this->akun_model->create([
				'nama' => $this->input->post('nama'),
				'no_hp' => $this->input->post('no_hp'),
				'email' => $this->input->post('email'),
				'password' =>  password_hash($this->input->post('password'), PASSWORD_DEFAULT) ,
			]);
			$this->session->set_flashdata('success', ['Registrasi berhasil, silahkan login']);
			redirect('login');
		}
		
	}

	public function verify_email(){
		
	}

}
