<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Daerah extends RestController {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('provinsi_model');
		$this->load->model('kota_model');
		$this->load->model('kecamatan_model');
		$this->load->model('kelurahan_model');
		$this->load->model('sekolah_model');
	}
	
	public function index_get(){
		
		$this->output->parse_exec_vars = FALSE;
		switch($this->input->get('type')){
			case 'provinsi':
				$res['provinsi'] = $this->provinsi_model->get();
				break;
			case 'kota':
				$res['kota_kab'] = $this->kota_model->findByProvinsi($this->input->get('provinsi_id'));;
				break;
			case 'kecamatan':
				$res['kecamatan'] = $this->kecamatan_model->findByKota($this->input->get('kota_id'));
				break;
			case 'kelurahan':
				$res['kelurahan'] = $this->kelurahan_model->findByKecamatan($this->input->get('kecamatan_id'));
				break;
			case 'sekolah':
				$res['sekolah'] = $this->sekolah_model->findByKota($this->input->get('kota_id'));
				break;
			default:
				$res = $this->kelurahan_model->getParents();
		};
		$this->response($res, 200);
	}
}
