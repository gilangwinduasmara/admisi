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
			$this->response($res, 200);
		}
		if($this->input->get('nim')){
			$res = $this->pendaftaran_model->findByNim($this->input->get('nim'));
			$this->response($res, 200);
		}
		
		$search = $_GET['search']['value']; // Ambil data yang di ketik user pada textbox pencarian
		$limit = $_GET['length']; // Ambil data limit per page
		$start = $_GET['start']; // Ambil data start
		$order_index = $_GET['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
		$order_field = $_GET['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
		$order_ascdesc = $_GET['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"
		$status_pembayaran = $_GET['columns'][3]['search']['value'] ?? null;

		$searchByFromDate = $_GET['searchByFromDate'] ?? null;
		$searchByToDate = $_GET['searchByToDate'] ?? null;

		$count = $this->pendaftaran_model->count_all();
		$data = $this->pendaftaran_model->filter($search, $limit, $start, $order_field, $order_ascdesc, $status_pembayaran, $searchByFromDate, $searchByToDate);
		$count_filter = $this->pendaftaran_model->count_filter($search, $status_pembayaran, $searchByFromDate, $searchByToDate);
		
		$response = array(
			'draw'=>$_GET['draw'], // Ini dari datatablenya
			'recordsTotal'=>$count,
			'recordsFiltered'=>$count_filter,
			'data'=>$data
		);

		$this->response($response, 200);
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
