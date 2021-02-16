<?php

class Pembayaran_controller extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pembayaran_model');
		$this->load->model('pendaftaran_model');
	}
	
	public function save_pembayaran(){
		$this->form_validation->set_rules('id', 'No Formulir', 'required');
		$this->form_validation->set_rules('nama_camaru', 'Nama Camaru', 'required');
		$this->form_validation->set_rules('jenis_pembayaran', 'Jenis Pembayaran', 'required');
		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('errors', ['Terjadi kesalahan']);
			redirect("/pendaftaran/data_camaru");
		}else{
			$data = array(
				'pendaftaran_id' => $this->input->post("id"),
				'nama_camaru' => $this->input->post("nama_camaru"),
				'jenis_pembayaran_id' => $this->input->post("jenis_pembayaran"),
			);
			// $pembayaran = $this->pembayaran_model->findByPendaftaranId($data['pendaftaran_id']);
			// if(count($pembayaran)>0){
			// 	// save
			// 	$data['id'] = $pembayaran['id'];
			// 	$this->pembayaran_model->save($data);
			// }{
				
			// }
			$data['status'] = 'BELUM LUNAS';
			$nomor_pembayaran = $this->pembayaran_model->create($data);
			$this->session->set_flashdata('nomor_pembayaran', $nomor_pembayaran);
			// $this->session->set_flashdata('success', ['Informasi pembayaran berhasil disimpan']);
			redirect("/pendaftaran/informasi_pembayaran?id=".$data['pendaftaran_id']);
		}
	}

	public function upload_bukti(){
		$this->form_validation->set_rules('id', 'No Formulir', 'required');
		$this->form_validation->set_rules('total_bayar', 'Total Bayar', 'required');
		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('errors', $this->form_validation->error_array());
		}else{
			if(!$this->pembayaran_model->matchPendaftaran($this->input->post('pembayaran_id'), $this->input->post('id'))){
				$this->session->set_flashdata('errors', ['Nomor pembayaran salah']);
				redirect('/pendaftaran/upload_pembayaran?id='.$this->input->post('id'));
			}
			$pendaftaran = $this->pendaftaran_model->find($this->input->post('id'));
			$data = array(
				'id' => $pendaftaran['pembayaran'][0]['id'],
				'status' => 'VALIDASI',
				'total_bayar' => $this->input->post('total_bayar')
			);
			$this->pembayaran_model->save($data);
			$this->session->set_flashdata('success', ['Bukti pembayaran berhasil disimpan']);
		}
		
		redirect("/pendaftaran/data_camaru");
	}
}
