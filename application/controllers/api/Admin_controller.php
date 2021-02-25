<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_controller extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pembayaran_model');
		$this->load->model('hasil_penerimaan_model');
		$this->load->model('registrasi_ulang_model');
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
		$pembayaran = $this->pembayaran_model->save([
			'id' => $this->input->post('pembayaran_id'),
			'status' => 'LUNAS'
		]);
		$this->session->set_flashdata('success', ['Pembayaran berhasil divalidasi']);
		redirect('/admin/data_pendaftar');
	}

	public function validasi_pembayaran_registrasi_ulang()
	{
		$registrasi_ulang = $this->registrasi_ulang_model->save([
			'id' => $this->input->post('registrasi_ulang_id'),
			'status' => 'LUNAS',
			'nim' => rand(100000000,999999999)
		]);
		print_r($registrasi_ulang);
		
		$this->daftar_omb_model->create([
			'registrasi_ulang_id' => $registrasi_ulang['id']
		]);

		$this->session->set_flashdata('success', ['Pembayaran berhasil divalidasi']);
		redirect('/admin/data_pendaftar');
	}

	public function hasil_penerimaan()
	{
		if(!empty($this->input->post('prodi_1_id'))){
			$data = array(
				'id' => $this->input->post('prodi_1_id'),
				'status' => $this->input->post('prodi_1_status'),
			);
			$hasil_penerimaan = $this->hasil_penerimaan_model->find($this->input->post('prodi_1_id')) ;
			if($hasil_penerimaan['status'] != 'DIPROSES'){
				$data['status'] = $hasil_penerimaan['status'];
			}
			$this->hasil_penerimaan_model->save($data);
		}
		if(!empty($this->input->post('prodi_2_id'))){
			$data = array(
				'id' => $this->input->post('prodi_2_id'),
				'status' => $this->input->post('prodi_2_status'),
			);
			$hasil_penerimaan = $this->hasil_penerimaan_model->find($this->input->post('prodi_2_id')) ;
			if($hasil_penerimaan['status'] != 'DIPROSES'){
				$data['status'] = $hasil_penerimaan['status'];
			}
			$this->hasil_penerimaan_model->save($data);
		}
		$this->session->set_flashdata('success', ['Data berhasil disimpan']);
		redirect('/admin/data_camaru');
	}

}

