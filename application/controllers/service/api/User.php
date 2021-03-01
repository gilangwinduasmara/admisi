<?php

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends RestController {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('akun_model');
	}
	

	public function dt_user_get(){
		$search = $_GET['search']['value']; // Ambil data yang di ketik user pada textbox pencarian
		$limit = $_GET['length']; // Ambil data limit per page
		$start = $_GET['start']; // Ambil data start
		$order_index = $_GET['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
		$order_field = $_GET['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
		$order_ascdesc = $_GET['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"
		$searchByJenisUser = $_GET['searchByJenisUser'] ?? null;
		$searchByStatus = $_GET['searchByStatus'] ?? null;

		$searchByFromDate = $_GET['searchByFromDate'] ?? null;
		$searchByToDate = $_GET['searchByToDate'] ?? null;

		$count = $this->akun_model->data_user_count_all();
		$data = $this->akun_model->data_user_filter($search, $limit, $start, $order_field, $order_ascdesc, $searchByJenisUser, $searchByStatus, $searchByFromDate, $searchByToDate);
		$count_filter = $this->akun_model->data_user_count_filter($search, $searchByJenisUser, $searchByStatus, $searchByFromDate, $searchByToDate);
		
		$response = array(
			'draw'=>$_GET['draw'], // Ini dari datatablenya
			'recordsTotal'=>$count,
			'recordsFiltered'=>$count_filter,
			'data'=>$data
		);

		$this->response($response, 200);
	}

}

/* End of file User.php */
