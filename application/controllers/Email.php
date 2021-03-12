<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {

	public function index()
	{
		
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
		$this->email->to('gilangwinduasmara2@gmail.com');
		$this->email->bcc('them@their-example.com');
		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');

		if($this->email->send()){
			echo "yay";
		}else{
			echo "nope";

		}
		



	}

}

/* End of file Email.php */
