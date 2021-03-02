<?php

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') OR exit('No direct script access allowed');

class Tahun_akademik extends RestController {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('tahun_akademik_model');
	}
	

	public function dt_get(){
		$search = $_GET['search']['value']; // Ambil data yang di ketik user pada textbox pencarian
		$limit = $_GET['length']; // Ambil data limit per page
		$start = $_GET['start']; // Ambil data start
		$order_index = $_GET['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
		$order_field = $_GET['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
		$order_ascdesc = $_GET['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"

		$count = $this->tahun_akademik_model->dt_count_all();
		$data = $this->tahun_akademik_model->dt_filter($search, $limit, $start, $order_field, $order_ascdesc);
		$count_filter = $this->tahun_akademik_model->dt_count_filter($search);
		
		$response = array(
			'draw'=>$_GET['draw'], // Ini dari datatablenya
			'recordsTotal'=>$count,
			'recordsFiltered'=>$count_filter,
			'data'=>$data
		);

		$this->response($response, 200);
	}

	public function index_post(){
		$this->tahun_akademik_model->create([
			'tahun_akademik' => $this->input->post('tahun_akademik'),
			'status' => 'NONAKTIF'
		]);
		$this->session->set_flashdata('success', ['Data berhasil disimpan']);
		redirect('/admin/master_data');
	}

}

/* End of file tahun_akademik.php */
