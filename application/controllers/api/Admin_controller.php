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
		$this->load->model('akun_model');
		$this->load->model('jadwal_model');
		$this->load->model('gelombang_model');
		if(empty($this->session->userdata('id'))){
			redirect('/login');
		}else{
			if($this->session->userdata('role')=='USER'){
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

	public function create_panitia(){
		$data = array(
			'nama' => $this->input->post('nama'),
			'email' => $this->input->post('email'),
			'no_hp' => $this->input->post('no_hp'),
			'role' => "PPMB",
			'password ' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
		);
		$this->akun_model->create($data);
		$this->session->flashdata('success', ['Data berhasil disimpan']);
		redirect('/admin/data_user');
	}

	public function save_jadwal(){
		$jadwal = $this->jadwal_model->get();
		foreach($jadwal as $j){
			$this->jadwal_model->save(array(
				'id' => $j['id'],
				'jam_mulai' => $this->input->post('jam_mulai_'.$j['id']),
				'jam_selesai' => $this->input->post('jam_selesai_'.$j['id']),
				'status' => empty($this->input->post('status_'.$j['id'])) ? 'NONAKTIF' : 'AKTIF'
			));
		}
		$this->session->set_flashdata('success', ['Data berhasil disimpan']);
		
		redirect('/admin/jadwal_pendaftaran');
	}

	public function create_gelombang(){

		$this->gelombang_model->create([
			'tahun_akademik_id' => $this->input->post('tahun_akademik_id'),
			'nama_gelombang' => $this->input->post('nama_gelombang'),
			'tanggal_mulai' => $this->input->post('tanggal_mulai'),
			'tanggal_selesai' => $this->input->post('tanggal_selesai')
		]);

		$this->session->set_flashdata('success', ['Data berhasil disimpan']);
		
		redirect('admin/master_gelombang');
	}

	public function save_gelombang(){
		$this->session->set_flashdata('success', ['Data berhasil disimpan']);

		redirect('admin/master_gelombang');
	}

	public function set_tahun_akademik(){
		$tahun_akademik_id = $this->input->post('tahun_akademik_id');
		$tahun_akademik = $this->tahun_akademik_model->find($tahun_akademik_id);
		if(empty($tahun_akademik)){
			$this->session->set_flashdata('errors', ['Terjadi kesalahan']);
			redirect('admin/master_tahun_akademik');
		}

		$tahun_akademik_list = $this->tahun_akademik_model->get();
		foreach($tahun_akademik_list as $tahun_akademik){
			if($tahun_akademik['id'] == $tahun_akademik_id){
				$tahun_akademik['status'] = 'AKTIF';
			}else{
				$tahun_akademik['status'] = 'NONAKTIF';
			}
			$this->tahun_akademik_model->save($tahun_akademik);
		}

		$this->session->set_flashdata('success', ['Data berhasil disimpan']);
		redirect('admin/master_tahun_akademik');
	

	}

}

