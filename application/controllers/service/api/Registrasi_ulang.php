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
		$status = $this->get('status');
		$id = last_segment($this->uri);
		if(is_numeric($id)){
			$data = $this->registrasi_ulang_model->find($id);
			$this->response($data, 200);	
		}

		$data = $this->registrasi_ulang_model->get();
		$this->response($data, 200);
	}



	public function status_get(){
		$get = $this->get();
		$status = urldecode((array_keys($get)[0]) ?? null);
		if($status){
			$enum = ["LUNAS", "VALIDASI NIM", "VALIDASI KEUANGAN", "BELUM BAYAR", "SUDAH REGISTRASI"];
			if(!in_array($status, $enum)){
				$this->response(array(
					"error" => true,
					"message" => 'must be any enum of LUNAS, VALIDASI NIM, VALIDASI KEUANGAN, BELUM BAYAR, SUDAH REGISTRASI'
				), 200);	
			}
			$data = $this->registrasi_ulang_model->get($status);
			$this->response($data, 200);
		}
		$this->response($status, 200);
	}

	public function index_put(){
		// echo "tes";
		$id = last_segment($this->uri);
		$data = array('id' => $id);
		foreach(["hasil_penerimaan_id","nama_camaru","upload_bukti_bayar","nim","prodi_id","status"] as $field){
			if(!empty($this->put($field))){
				$data[$field] = $this->put($field);
			}
		}

		if(!empty($data['nim'])){
			$data['status'] = 'SUDAH REGISTRASI';
		}

		$data = $this->registrasi_ulang_model->save($data);
		$this->response(array(
			'success' => true,
			'message' => "Data successfully updated",
			'data' => $data
		), 200);
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
