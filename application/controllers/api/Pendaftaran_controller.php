<?php

class Pendaftaran_controller extends CI_Controller{

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pendaftaran_model');
		$this->load->model('pembayaran_model');
		$this->load->model('jenjang_model');
		$this->load->model('hasil_penerimaan_model');
		$this->load->model('detail_pendidikan_model');
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
			print_r($error);
			return 'x';
		}
		
		else
		{
			return $this->upload->data()['file_name'];
				// $data = array('upload_data' => $this->upload->data());
				// $this->response(array(
				// 	'file_name' => $this->upload->data()['file_name']
				// ), 200);		
		}

		return null;
	}

	public function new_formulir(){
		$this->form_validation->set_rules('nama', 'Nama Camaru', 'required');
		$this->form_validation->set_rules('jenjang', 'Jenjang', 'required');

		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('errors', ['Terjadi kesalahan']);
			redirect("/pendaftaran/formulir");
		}else{
			$pendaftaran = $this->pendaftaran_model->create([
				'nama' => $this->input->post('nama'),
				'jenjang_id' => $this->input->post('jenjang'),
				'akun_id' => $this->session->userdata('id')
			]);

			$this->session->set_flashdata('success', ['Camaru berhasil ditambahkan']);
			redirect("/pendaftaran/data_camaru");
		}	
	}

	public function update_form(){
		$form_type = $this->input->post('form_type');
		print_r($form_type);
		switch($form_type){
			case 'data_diri':
				$this->update_data_diri();	
				break;
			case 'data_wali':
				$this->update_data_wali();
				break;
			case 'data_pendidikan':
				$this->update_data_pendidikan();
				break;
			case 'data_akademik':
				$this->update_data_akademik();
				break;
			case 'unggah_berkas':
				$this->unggah_berkas();
				break;
			case 'submit':
				$this->submit();
				break;
		}
	}

	private function unggah_berkas(){
		$data = array(
			'id' => $this->input->post('id')
		);
		foreach(['upload_foto', 'upload_kk', 'upload_akta_lahir', 'upload_srt_pernyataan'] as $field){
			$data[$field] = $this->upload($field);
		}
		$this->pendaftaran_model->save($data);
		redirect('/pendaftaran/formulir/submit?id='.$this->input->post('id'));
	}
	
	private function submit(){
		$data_akademik = $this->session->userdata('form')[$this->input->post('id')]['data_akademik'] ?? null;
		$pendaftaran = $this->pendaftaran_model->find($this->input->post('id'));
		$data1 = array(
			'pendaftaran_id' => $this->input->post('id'),
			'prodi_id' => $pendaftaran['prodi_1_id'],
			'status' => 'DIPROSES'
		);
		
		$data2 = array(
			'pendaftaran_id' => $this->input->post('id'),
			'prodi_id' => $pendaftaran['prodi_2_id'] ?? null,
			'status' => 'DIPROSES'
		);

		if($data1['prodi_id'] != null){
			$this->hasil_penerimaan_model->create($data1);
		}
		if($data2['prodi_id'] != null){
			$this->hasil_penerimaan_model->create($data2);
		}

		$this->pendaftaran_model->save([
			'id' => $pendaftaran['id'],
			'status_formulir' => 'AKTIF'
		]);

		redirect('/pendaftaran/data_camaru');
	}
	
	private function update_data_akademik(){
		$data_akademik = array();
		foreach(['prodi_1_id', 'prodi_2_id'] as $field){
			$data_akademik[$field] = $this->input->post($field);
		}
		$data = array(
			'id' => $this->input->post('id'),
			'prodi_1_id' => $data_akademik['prodi_1_id'],
			'prodi_2_id' => $data_akademik['prodi_2_id'] ?? null,
		);

		$pendaftaran = $this->pendaftaran_model->save($data);
		
		$this->session->set_userdata( [
			'form' => [
				$this->input->post('id') => [
					'data_akademik' => $data_akademik,
				]
			]
		] );
		redirect('/pendaftaran/formulir/unggah_berkas?id='.$this->input->post('id'));
	}

	private function update_data_pendidikan(){
		// print_r($_FILES);
		$pendaftaran = $this->pendaftaran_model->find($this->input->post('id'));
		$data_pendidikan = array();
		foreach(['status_pendidikan[]','npsn[]','tahun_masuk[]','tahun_lulus[]', 'jurusan[]', 'sekolah[]', 'upload_ijazah[]', 'upload_daftar_nilai[]'] as $field){
			$data_pendidikan[$field] = $this->input->post($field);
		}
		
		$files = $_FILES;
		$count = count($_FILES['upload_ijazah']['name']);
		print_r($files);

		$jenjang = ["SMA", "S1", "S2", "S3"];

		foreach(['upload_ijazah', 'upload_daftar_nilai'] as $upload_file){
			for($i=0; $i<$count; $i++)
			{
				$_FILES[$upload_file]['name']= $files[$upload_file]['name'][$i];
				$_FILES[$upload_file]['type']= $files[$upload_file]['type'][$i];
				$_FILES[$upload_file]['tmp_name']= $files[$upload_file]['tmp_name'][$i];
				$_FILES[$upload_file]['error']= $files[$upload_file]['error'][$i];
				$_FILES[$upload_file]['size']= $files[$upload_file]['size'][$i];

				$data_pendidikan[$upload_file.'[]'][$i] = $this->upload($upload_file);
			}
		}
		

		$this->session->set_userdata( [
			'form' => [
				$this->input->post('id') => [
					'data_pendidikan' => $data_pendidikan,
				]
			]
		] );
		$pendidikan = array();
		foreach($data_pendidikan['status_pendidikan[]'] as $key => $status_pendidikan){
			$temp_pendidikan = $this->detail_pendidikan_model->findByPendaftaranAndStatus($this->input->post('id'), $status_pendidikan)[0];
			$pendidikan[$status_pendidikan]['npsn'] = $data_pendidikan['npsn[]'][$key];
			$pendidikan[$status_pendidikan]['tahun_masuk'] = $data_pendidikan['tahun_masuk[]'][$key];
			$pendidikan[$status_pendidikan]['tahun_lulus'] = $data_pendidikan['tahun_lulus[]'][$key];
			$pendidikan[$status_pendidikan]['jurusan'] = $data_pendidikan['jurusan[]'][$key];
			$pendidikan[$status_pendidikan]['sekolah_id'] = $data_pendidikan['sekolah[]'][$key];
			$data = array(
				'status' => $status_pendidikan,
				'pendaftaran_id' => $this->input->post('id'),
				'npsn' => $data_pendidikan['npsn[]'][$key],
				'tahun_masuk' => $data_pendidikan['tahun_masuk[]'][$key],
				'tahun_lulus' => $data_pendidikan['tahun_lulus[]'][$key],
				'jurusan' => $data_pendidikan['jurusan[]'][$key],
				'sekolah_id' => $data_pendidikan['sekolah[]'][$key],
				'upload_daftar_nilai' => $data_pendidikan['upload_daftar_nilai[]'][$key] ?? $temp_pendidikan['upload_daftar_nilai'],
				'upload_ijazah' => $data_pendidikan['upload_ijazah[]'][$key] ?? $temp_pendidikan['upload_ijazah']
			);
			$stored_pendidikan = $this->detail_pendidikan_model->findByPendaftaranAndStatus($this->input->post('id'), $status_pendidikan);
			if(count($stored_pendidikan)>0){
				$data['id'] = $stored_pendidikan[0]['id'];
				$this->detail_pendidikan_model->save($data);
			}else{
				$this->detail_pendidikan_model->create($data);
			}

		}
		// redirect('/pendaftaran/formulir/data_akademik?id='.$this->input->post('id'));
	}

	private function update_data_wali(){

		$this->form_validation->set_rules('jenjang', 'Jenjang', 'required');
		$data_wali = array();
		foreach(['nama', 'NIK', 'no_hp','email','pendidikan_terakhir', 'status_hubungan', 'pekerjaan','nama_instansi','alamat_instansi','telp_instansi','penghasilan_perbulan','nama_ibu_kandung','same_address','negara', 'kelurahan', 'alamat'] as $field){
			$data_wali[$field] = $this->input->post($field);
		}

		$data_wali['kelurahan_id'] = $data_wali['kelurahan'];
		$data_wali['pendaftaran_id'] = $this->input->post('id');
		unset($data_wali['kelurahan']);
		unset($data_wali['negara']);
		$pendaftaran = $this->pendaftaran_model->find($this->input->post('id'));
		if(empty($this->input->post('kelurahan'))){
			$data_wali['kelurahan_id'] = $pendaftaran['kelurahan_id'];
			$data_wali['alamat'] = $pendaftaran['alamat_asal'];
		}
		if(isset($pendaftaran['detail_wali'])){
			$data_wali['id'] = $pendaftaran['detail_wali']['id'];
			$this->detail_wali_model->save($data_wali);
		}else{
			$this->detail_wali_model->create($data_wali);
		}
		$this->session->set_userdata( [
			'form' => [
				$this->input->post('id') => [
					'data_wali' => $data_wali,
				]
			]
		] );
		redirect('/pendaftaran/formulir/data_pendidikan?id='.$this->input->post('id'));
	}

	private function update_data_diri(){
		print_r("tes");

		$this->form_validation->set_rules('jenjang', 'Jenjang', 'required');
	
		$data_diri = array();

		foreach(['NISN', 'NIK', 'email', 'no_hp', 'kota_kelahiran', 'tgl_lahir', 'jenis_kelamin', 'pekerjaan', 'tinggi_badan', 'berat_badan', 'kewarganegaraan', 'negara', 'kelurahan', 'alamat_asal', 'status_sipil', 'gol_darah', 'agama'] as $field){
			$data_diri[$field] = $this->input->post($field);
		}
		$data_diri['kelurahan_id'] = $data_diri['kelurahan'];
		unset($data_diri['kelurahan']);
		$data_diri['id'] = $this->input->post('id');
		if($data_diri['kewarganegaraan'] == 'WNI'){
			$data_diri['negara'] = 'Indonesia';
		}else{
			$data_diri['negara'] = $this->input->post('negara');
		}
		$this->pendaftaran_model->save($data_diri);
		$this->session->set_userdata( [
			'form' => [
				$this->input->post('id') => [
					'data_diri' => $data_diri,
				]
			]
		] );
		
		redirect('/pendaftaran/formulir/data_wali?id='.$this->input->post('id'));
	}

}
