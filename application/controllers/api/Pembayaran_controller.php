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
			$data['status'] = 'BELUM LUNAS';
			$nomor_pembayaran = $this->pembayaran_model->create($data);
			$this->session->set_flashdata('nomor_pembayaran', $nomor_pembayaran);
			redirect("/pendaftaran/informasi_pembayaran?id=".$data['pendaftaran_id']);
		}
	}

	public function upload_bukti(){
		$this->form_validation->set_rules('id', 'No Formulir', 'required');
		$this->form_validation->set_rules('total_bayar', 'Total Bayar', 'required');
		$this->form_validation->set_rules('bank_pengirim', 'Bank Pengirim', 'required');
		$this->form_validation->set_rules('no_rek_pengirim', 'No Rek Pengirim', 'required');
		$this->form_validation->set_rules('nama_rek_pengirim', 'Nama Rek Pengirim', 'required');
		$this->form_validation->set_rules('tgl_transfer', 'Tanggal Transfer', 'required');
		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('errors', $this->form_validation->error_array());
		}else{
			$pembayaran = $this->pembayaran_model->matchPendaftaran($this->input->post('pembayaran_id'), $this->input->post('id'));
			if(empty($pembayaran)){
				$this->session->set_flashdata('errors', ['Nomor pembayaran salah']);
				redirect('/pendaftaran/upload_pembayaran?id='.$this->input->post('id'));
			}else{
			}
			$pendaftaran = $this->pendaftaran_model->find($this->input->post('id'));
			$data = array(
				'id' => $pembayaran,
				'status' => 'VALIDASI',
				'total_bayar' => str_replace(".", "", $this->input->post('total_bayar')),
				'bank_pengirim' => $this->input->post('bank_pengirim'),
				'no_rek_pengirim' => $this->input->post('no_rek_pengirim'),
				'nama_rek_pengirim' => $this->input->post('nama_rek_pengirim'),
				'tgl_transfer' => $this->input->post('tgl_transfer'),
				'upload_bukti_bayar' => $this->upload('upload_bukti')
			);
			$this->pembayaran_model->save($data);
			$this->session->set_flashdata('success', ['Bukti pembayaran berhasil disimpan']);
		}
		
		redirect("/pendaftaran/data_camaru");
	}

	public function upload($field = 'userfile')
	{
		$config['upload_path']          = './uploads/';
		$config['allowed_types']        = 'jpg|png';
		$config['max_size']             = 20000;
		$config['encrypt_name']         = TRUE;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload($field))
		{
			$error = array('error' => $this->upload->display_errors());
			return null;
		}
		
		else
		{
			return $this->upload->data()['file_name'];
		}

		return null;
	}
}
