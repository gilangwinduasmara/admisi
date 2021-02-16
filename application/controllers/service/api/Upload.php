<?php

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends RestController {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}
	
	public function index_post()
	{
		$config['upload_path']          = './uploads/';
		$config['allowed_types']        = 'gif|jpg|png|pdf';
		$config['max_size']             = 20000;
		$config['encrypt_name']         = TRUE;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('userfile'))
		{
				$error = array('error' => $this->upload->display_errors());
				$this->response($error, 200);
				$this->load->view('upload_form', $error);
		}
		else
		{
				$data = array('upload_data' => $this->upload->data());
				$this->response(array(
					'file_name' => $this->upload->data()['file_name']
				), 200);		
		}

		$this->load->library('upload', $config);
		$this->response("tes", 200);
	}

}

