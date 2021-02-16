<?php
require_once APPPATH . 'core/RestController.php';

class Daerah_controller extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('provinsi_model');
		$this->load->model('kota_model');
		$this->load->model('kecamatan_model');
		$this->load->model('kelurahan_model');
	}
	
	public function index(){
		$res = [
		];
		
		$this->output->parse_exec_vars = FALSE;
		switch($this->input->get('type')){
			case 'provinsi':
				$res[''] = $this->provinsi_model->get();
				$this->response->json($res);
			case 'kota':
				break;
		};
		
	}
}
