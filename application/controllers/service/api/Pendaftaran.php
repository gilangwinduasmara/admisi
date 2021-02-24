<?php
defined('BASEPATH') OR exit('No direct script access allowed');


use chriskacerguis\RestServer\RestController;

class Pendaftaran extends RestController {
	
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pendaftaran_model');
	}
	

	public function index_get()
	{
		$res = null;
		if($this->input->get('id'))	{
			$res = $this->pendaftaran_model->find($this->input->get('id'), $this->input->get('status'));
		}
		if($this->input->get('nim')){
			$res = $this->pendaftaran_model->findByNim($this->input->get('nim'));
		}
		

		$this->response($res, 200);

	}

	public function omb_get(){
		$res = null;
		if($this->input->get('nim')){
			$res = $this->daftar_omb_model->findByNim($this->input->get('nim'));
		}
		$this->response($res, 200);
	}

}

/* End of file Penerimaan.php */
