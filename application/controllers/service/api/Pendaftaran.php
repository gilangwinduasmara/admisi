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
			$res = $this->pendaftaran_model->find($this->input->get('id'));
		}

		$this->response($res, 200);

	}

}

/* End of file Penerimaan.php */
