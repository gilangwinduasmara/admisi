<?php

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_pembayaran extends RestController {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('jenis_pembayaran_model');
	}
	

	public function dt_get(){
		$search = $_GET['search']['value']; // Ambil data yang di ketik user pada textbox pencarian
		$limit = $_GET['length']; // Ambil data limit per page
		$start = $_GET['start']; // Ambil data start
		$order_index = $_GET['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
		$order_field = $_GET['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
		$order_ascdesc = $_GET['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"

		$count = $this->jenis_pembayaran_model->dt_count_all();
		$data = $this->jenis_pembayaran_model->dt_filter($search, $limit, $start, $order_field, $order_ascdesc);
		$count_filter = $this->jenis_pembayaran_model->dt_count_filter($search);
		
		$response = array(
			'draw'=>$_GET['draw'], // Ini dari datatablenya
			'recordsTotal'=>$count,
			'recordsFiltered'=>$count_filter,
			'data'=>$data
		);

		$this->response($response, 200);
	}

	public function index_post(){
		if($this->input->post('edit')){
			$this->jenis_pembayaran_model->save([
				'id' => $this->input->post('id'),
				'jenis_pembayaran' => $this->input->post('jenis_pembayaran'),
				'info_pembayaran' => $this->input->post('info_pembayaran') ?? null
			]);
		}else{
			$this->jenis_pembayaran_model->create([
				'jenis_pembayaran' => $this->input->post('jenis_pembayaran'),
				'info_pembayaran' => $this->input->post('info_pembayaran') ?? null
			]);
		}
		$this->session->set_flashdata('success', ['Data berhasil disimpan']);
		redirect('/admin/master_pembayaran');
	}

}

/* End of file jenis_pembayaran.php */
