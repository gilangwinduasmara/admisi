<?php

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') OR exit('No direct script access allowed');

class Registrasi extends RestController {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pendaftaran_model');
	}
	

	public function pendaftaran_get()
	{
		if($this->input->get('id')){
			$pendaftaran = $this->pendaftaran_model->find($this->input->get('id'), true);
			return $pendaftaran;
		}
		
	}

}
