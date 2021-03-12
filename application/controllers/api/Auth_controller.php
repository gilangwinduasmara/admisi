<?php

require_once APPPATH.'libraries/JWT.php';
use Firebase\JWT\JWT;

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
					'role' => $akun->role,
					'not_validated' => empty($akun->email_verified_at)
				);
				$this->session->set_flashdata('success', ['Login berhasil']);
				$this->session->set_userdata( $user_data );
				if($this->session->role == 'USER'){
					redirect("/pendaftaran/data_camaru");
				}else if($this->session->role == 'ADMIN'){
					redirect("/admin/dashboard");
				}else{
					redirect("/admin/data_pendaftar");
				}
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

		if(!empty($this->akun_model->findByEmail($this->input->post('email')))){
			$this->session->set_flashdata('errors', ['Email sudah digunakan']);
			redirect('register');
		}

		if($this->form_validation->run() == FALSE){
			$errors = $this->form_validation->error_array();
			$this->session->set_flashdata('errors', 'Terjadi kesalahan');
			$this->session->set_flashdata('input', $this->input->post());
			redirect('register');
		}else{
			$verificationCode = $this->akun_model->create([
				'nama' => $this->input->post('nama'),
				'no_hp' => $this->input->post('no_hp'),
				'email' => $this->input->post('email'),
				'password' =>  password_hash($this->input->post('password'), PASSWORD_DEFAULT) ,
			]);
			$akun = $this->akun_model->findByEmail($this->input->post('email'));
			$user_data = array(
				'id' => $akun->id,
				'role' => $akun->role,
				'not_validated' => true
			);
			$config = [
				'mailtype'  => 'html',
				'charset'   => 'utf-8',
				'protocol'  => 'smtp',
				'smtp_host' => 'mail.promager.com',
				'smtp_user' => 'admisi@promager.com',  // Email gmail
				'smtp_pass'   => '@dm1s!!@#',  // Password gmail
				'smtp_crypto' => 'ssl',
				'smtp_port'   => 465,
				'crlf'    => "\r\n",
				'newline' => "\r\n"
			];
		
			$this->load->library('email', $config);
			$this->email->from('admisi@promager.com', 'ADMISI');
			$this->email->to($akun->email);
			$this->email->subject('Aktivasi Akun');
			$link = base_url('/verify?code='.$verificationCode);
			$this->email->message('
				<html>
					<head>Aktifasi Akun</head>
					<body>
						Untuk mengaktifkan akun, klik tautan di bawah ini <br> <a href="'.$link.'">'.$link.'</a>
					</body>
				</html>
				');
			$email_status = $this->email->send() ? ' yay': ' nope';
			$this->session->set_userdata($user_data);
			$this->session->set_flashdata('success', ['Link aktivasi telah dikirim ke email anda '.base_url('/verify?code='.$verificationCode)]);
			redirect('verify');
		}
		
	}

	public function verify_email(){
		
	}

	public function generate_token(){
		echo JWT::encode(array('user' => $this->input->get('user')), 'admisi')	;
	}
	public function verify_token(){
		// echo JWT::encode(array('user' => 'tester'), 'admisi')
		print_r(JWT::decode($this->input->get('token'), 'admisi', array('HS256')));
	}

}
