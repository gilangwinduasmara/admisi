<?php
defined('BASEPATH') OR exit('No direct script access allowed');


use chriskacerguis\RestServer\RestController;

class Daftar_omb extends RestController {
	
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pendaftaran_model');
	}
	
	public function index_get(){
		$res = null;
		if($this->input->get('nim')){
			$res = $this->daftar_omb_model->findByNim($this->input->get('nim'));
		}
		$this->response($res, 200);
	}

	public function dt_daftar_omb_get(){
		$search = $_GET['search']['value']; // Ambil data yang di ketik user pada textbox pencarian
		$limit = $_GET['length']; // Ambil data limit per page
		$start = $_GET['start']; // Ambil data start
		$order_index = $_GET['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
		$order_field = $_GET['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
		$order_ascdesc = $_GET['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"

		$searchByFromDate = $_GET['searchByFromDate'] ?? null;
		$searchByToDate = $_GET['searchByToDate'] ?? null;
		$searchByProdi = $_GET['searchByProdi'] ?? null;

		$count = $this->daftar_omb_model->data_omb_count_all();
		$data = $this->daftar_omb_model->data_omb_filter($search, $limit, $start, $order_field, $order_ascdesc, $searchByFromDate, $searchByToDate, $searchByProdi);
		$count_filter = $this->daftar_omb_model->data_omb_count_filter($search, $searchByFromDate, $searchByToDate, $searchByProdi);
		
		$response = array(
			'draw'=>$_GET['draw'], // Ini dari datatablenya
			'recordsTotal'=>$count,
			'recordsFiltered'=>$count_filter,
			'data'=>$data
		);

		$this->response($response, 200);
	}

}

/* End of file Penerimaan.php */
