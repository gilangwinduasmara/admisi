<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_controller extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pembayaran_model');
		$this->load->model('hasil_penerimaan_model');
		if(empty($this->session->userdata('id'))){
			redirect('/login');
		}else{
			if($this->session->userdata('role')!='ADMIN'){
				redirect('/');
			}
		}
	}
	

	public function validasi_pembayaran()
	{
		print_r($this->session->all_userdata());
		$pembayaran = $this->pembayaran_model->save([
			'id' => $this->input->post('pembayaran_id'),
			'status' => 'LUNAS'
		]);
		$this->session->set_flashdata('success', ['Pembayaran berhasil divalidasi']);
		redirect('http://192.168.43.152/UKIT/Admisi/admin/data_pendaftar');
	}

	public function hasil_penerimaan()
	{
		if(!empty($this->input->post('prodi_1_id'))){
			$data = array(
				'id' => $this->input->post('prodi_1_id'),
				'status' => $this->input->post('prodi_1_status'),
			);
			$this->hasil_penerimaan_model->save($data);
		}
		if(!empty($this->input->post('prodi_2_id'))){
			$data = array(
				'id' => $this->input->post('prodi_2_id'),
				'status' => $this->input->post('prodi_2_status'),
			);
			$this->hasil_penerimaan_model->save($data);
		}
		$this->session->set_flashdata('success', ['Data berhasil disimpan']);
		redirect('http://192.168.43.152/UKIT/Admisi/admin/data_camaru');
	}

}

