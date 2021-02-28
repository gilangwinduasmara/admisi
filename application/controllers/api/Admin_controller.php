<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_controller extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pembayaran_model');
		$this->load->model('hasil_penerimaan_model');
		$this->load->model('registrasi_ulang_model');
		$this->load->model('pengumuman_model');
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

	public function create_pengumuman(){
		$data = array(
			'judul' => $this->input->post('judul'),
			'isi' => $this->input->post('isi'),
			'foto' => $this->upload('foto') ?? null,
			'status' => $this->input->post('status') ?? 'AKTIF',
		);
		if(empty($this->input->post('id'))){
			$this->pengumuman_model->create($data);
		}else{
			$stored = $this->pengumuman_model->find($this->input->post('id'));
			$data['id'] = $this->input->post('id');
			$data['foto'] = $data['foto'] ?? $stored['foto'] ?? null;
			$this->pengumuman_model->save($data);
		}
		redirect('/admin/pengumuman');
	}

	public function upload($field = 'userfile')
	{
		$config['upload_path']          = './uploads/';
		$config['allowed_types']        = 'gif|jpg|png|pdf';
		$config['max_size']             = 20000;
		$config['encrypt_name']         = TRUE;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload($field))
		{
			$error = array('error' => $this->upload->display_errors());
			$this->session->flashdata('errors', $error);
			return null;
		}
		
		else
		{
			return $this->upload->data()['file_name'];
		}

		return null;
	}

}

