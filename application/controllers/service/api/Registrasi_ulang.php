<?php

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') OR exit('No direct script access allowed');

class Registrasi_ulang extends RestController {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('registrasi_ulang_model');
	}
	
	public function index_get(){
		$data = $this->registrasi_ulang_model->get();
		$this->response($data, 200);
	}

	public function tes_get(){
		$this->response(json_decode(""), 200);
	}
	
	public function dt_registrasi_ulang_get(){
		$search = $_GET['search']['value']; // Ambil data yang di ketik user pada textbox pencarian
		$limit = $_GET['length']; // Ambil data limit per page
		$start = $_GET['start']; // Ambil data start
		$order_index = $_GET['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
		$order_field = $_GET['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
		$order_ascdesc = $_GET['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"

		$searchByFromDate = $_GET['searchByFromDate'] ?? null;
		$searchByToDate = $_GET['searchByToDate'] ?? null;
		$searchByProdi = $_GET['searchByProdi'] ?? null;
		$searchByStatus = $_GET['searchByStatus'] ?? null;
		$searchByTahunAkademik = $_GET['columns'][1]['search']['value'] ?? null;

		$count = $this->registrasi_ulang_model->data_registrasi_ulang_count_all();
		$data = $this->registrasi_ulang_model->data_registrasi_ulang_filter($search, $limit, $start, $order_field, $order_ascdesc, $searchByStatus, $searchByProdi, $searchByFromDate, $searchByToDate, $searchByTahunAkademik);
		$count_filter = $this->registrasi_ulang_model->data_registrasi_ulang_filter_count($search, $searchByStatus, $searchByProdi, $searchByFromDate, $searchByToDate, $searchByTahunAkademik);
		
		$response = array(
			'draw'=>$_GET['draw'], // Ini dari datatablenya
			'recordsTotal'=>$count,
			'recordsFiltered'=>$count_filter,
			'data'=>$data
		);

		$this->response($response, 200);
	}
}

/* End of file Registrasi_ulang.php */
