<?php

class Pendaftaran_controller extends CI_Controller{

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pendaftaran_model');
		$this->load->model('pembayaran_model');
		$this->load->model('jenjang_model');
		$this->load->model('hasil_penerimaan_model');
		$this->load->model('hasil_penerimaan_model');
		$this->load->model('registrasi_ulang_model');
		$this->load->model('daftar_omb_model');
		$this->load->model('detail_prestasi_model');
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
			return null;
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
		$this->form_validation->set_rules('jalur_pendaftaran', 'Jalur Pendaftaran', 'required');

		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('errors', ['Terjadi kesalahan']);
			redirect("/pendaftaran/formulir");
		}else{
			$pendaftaran = $this->pendaftaran_model->create([
				'nama' => $this->input->post('nama'),
				'jenjang_id' => $this->input->post('jenjang'),
				'jalur_pendaftaran_id' => $this->input->post('jalur_pendaftaran'),
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
		$pendaftaran = $this->pendaftaran_model->find($data['id']);
		foreach(['upload_foto', 'upload_kk', 'upload_akta_lahir', 'upload_srt_pernyataan'] as $field){
			$data[$field] = $this->upload($field) ?? $pendaftaran[$field] ?? null;
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
		if($data2['prodi_id'] != $data1['prodi_id']){
			if($data2['prodi_id'] != null){
				$this->hasil_penerimaan_model->create($data2);
			}
		}

		$this->pendaftaran_model->save([
			'id' => $pendaftaran['id'],
			'status_formulir' => 'AKTIF'
		]);

		$this->session->set_flashdata('success', ['Pendaftaran Berhasil, Silahkan mengunggu proses seleksi']);
		

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
		);

		if($this->input->post('prodi_2_id')){
			$data['prodi_2_id'] = $this->input->post('prodi_2_id');
		}
		
		$count_files = count($_FILES['unggah_bukti_prestasi']['name'] ?? []);
		print_r($_FILES);
		print_r($_POST);
		$uploaded_files = [];
		$file_upload_index = 0;
		for($i=0; $i<$count_files; $i++){
			if(!empty($_FILES['unggah_bukti_prestasi']['name'][$i])){
				$_FILES['upload']['name'] = $_FILES['unggah_bukti_prestasi']['name'][$i];
				$_FILES['upload']['type'] = $_FILES['unggah_bukti_prestasi']['type'][$i];
				$_FILES['upload']['tmp_name'] = $_FILES['unggah_bukti_prestasi']['tmp_name'][$i];
				$_FILES['upload']['error'] = $_FILES['unggah_bukti_prestasi']['error'][$i];
				$_FILES['upload']['size'] = $_FILES['unggah_bukti_prestasi']['size'][$i];
				$uploaded_files[$file_upload_index++] = $this->upload('upload');
			}
		}
		$file_upload_index = 0;
		foreach($this->input->post("detail_prestasi_id[]") as $key=>$id){
			$data_prestasi = [
				'pendaftaran_id' => $this->input->post('id'),
				'nama_kegiatan' => $this->input->post('nama_kegiatan')[$key],
				'jenis_prestasi' => $this->input->post('jenis_prestasi')[$key],
				'tgl_kegiatan' => $this->input->post('tgl_kegiatan')[$key]
			];
			if($id == "skip"){
				$data_prestasi['upload_bukti_prestasi'] = $uploaded_files[0];
				$this->detail_prestasi_model->create($data_prestasi);
			}else{
				$stored_prestasi = $this->detail_prestasi_model->find($id);
				$data_prestasi['id'] = $id;
				$data_prestasi['upload_bukti_prestasi'] = $this->upload('upload_bukti_prestasi_'.$id) ?? $stored_prestasi['upload_bukti_prestasi'] ?? null;
				$this->detail_prestasi_model->save($data_prestasi);
			}
		}
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
		$data_pendidikan = array();
		foreach(['status_pendidikan[]','npsn[]','tahun_masuk[]','tahun_lulus[]', 'jurusan[]', 'sekolah[]', 'upload_ijazah[]', 'upload_daftar_nilai[]', 'identifier_upload_ijazah[]', 'identifier_upload_daftar_nilai[]'] as $field){
			$data_pendidikan[$field] = $this->input->post($field);
		}
		
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
				'upload_daftar_nilai' => $this->upload('upload_daftar_nilai_'.$status_pendidikan) ?? $temp_pendidikan['upload_daftar_nilai'],
				'upload_ijazah' => $this->upload('upload_ijazah_'.$status_pendidikan) ?? $temp_pendidikan['upload_ijazah']
			);
			
			$stored_pendidikan = $this->detail_pendidikan_model->findByPendaftaranAndStatus($this->input->post('id'), $status_pendidikan);
			if(count($stored_pendidikan)>0){
				$data['id'] = $stored_pendidikan[0]['id'];
				$this->detail_pendidikan_model->save($data);
			}else{
				$this->detail_pendidikan_model->create($data);
			}

		}
		redirect('/pendaftaran/formulir/data_akademik?id='.$this->input->post('id'));
	}

	private function update_data_wali(){

		$this->form_validation->set_rules('jenjang', 'Jenjang', 'required');
		$data_wali = array();
		foreach(['nama', 'NIK', 'rt', 'rw', 'no_hp','email','pendidikan_terakhir', 'status_hubungan', 'pekerjaan','nama_instansi','alamat_instansi','telp_instansi','penghasilan_perbulan','nama_ibu_kandung','same_address','negara', 'kelurahan', 'alamat', 'kewarganegaraan'] as $field){
			$data_wali[$field] = $this->input->post($field);
		}

		$data_wali['kelurahan_id'] = $data_wali['kelurahan'];
		$data_wali['pendaftaran_id'] = $this->input->post('id');
		unset($data_wali['kelurahan']);
		unset($data_wali['negara']);
		$pendaftaran = $this->pendaftaran_model->find($this->input->post('id'));
		if($this->input->post('same_address')){
			$data_wali['kewarganegaraan'] = $pendaftaran['kewarganegaraan'];
			if($pendaftaran['kewarganegaraan'] == 'WNI'){
				$data_wali['kelurahan_id'] = $pendaftaran['kelurahan_id'];
				$data_wali['alamat'] = $pendaftaran['alamat_asal'];
				$data_wali['negara'] = 'Indonesia';
			}else{
				$data_wali['kelurahan_id'] = null;
				$data_wali['alamat'] = null;
				$data_wali['negara'] = $pendaftaran['negara'];
			}
		}else{
			if($data_wali['kewarganegaraan'] == 'WNI'){
				$data_wali['negara'] = 'Indonesia';
			}else{
				$data_wali['kelurahan_id'] = null;
				$data_wali['alamat'] = null;
				$data_wali['negara'] = $this->input->post('negara');
			}
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
		print_r(json_encode($data_wali));
		redirect('/pendaftaran/formulir/data_pendidikan?id='.$this->input->post('id'));
	}

	private function update_data_diri(){

		$this->form_validation->set_rules('jenjang', 'Jenjang', 'required');
	
		$data_diri = array();

		foreach(['KK', 'rt', 'rw', 'NIK', 'nama', 'email', 'no_hp', 'kota_kelahiran', 'tgl_lahir', 'jenis_kelamin', 'pekerjaan', 'tinggi_badan', 'berat_badan', 'kewarganegaraan', 'negara', 'kelurahan', 'alamat_asal', 'status_sipil', 'gol_darah', 'agama', 'status_tinggal', 'suku'] as $field){
			$data_diri[$field] = $this->input->post($field, TRUE);
		}
		if($data_diri['gol_darah'] == ''){
			$data_diri['gol_darah'] = null;
		}
		$data_diri['kelurahan_id'] = $data_diri['kelurahan'];
		unset($data_diri['kelurahan']);
		$data_diri['id'] = $this->input->post('id');
		if($data_diri['kewarganegaraan'] == 'WNI'){
			$data_diri['negara'] = 'Indonesia';
		}else{
			$data_diri['negara'] = $this->input->post('negara');
			unset($data_diri['kelurahan_id']);
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

	public function registrasi_ulang(){
		print_r($this->input->post());
		if($this->input->post('double_degree') == "Ya"){
			$hasil_penerimaan = $this->hasil_penerimaan_model->findBySkpm($this->input->post('skpm_1'));
			$pendaftaran = $this->pendaftaran_model->find($hasil_penerimaan['pendaftaran_id']);
			$registrasi_ulang = $this->registrasi_ulang_model->create([
				'hasil_penerimaan_id' => $hasil_penerimaan['id'],
				'nama_camaru' => $pendaftaran['nama'],
				'prodi_id' => $hasil_penerimaan['prodi_id'],
				'upload_bukti_bayar' => $this->upload('upload_bukti_pembayaran_1'),
				'bank_pengirim' => $this->input->post('bank_pengirim_1'),
				'no_rek_pengirim' => $this->input->post('no_rek_pengirim_1'),
				'nama_rek_pengirim' => $this->input->post('nama_rek_pengirim_1'),
				'jenis_pembayaran_id' => $this->input->post('jenis_pembayaran_id_1'),
				'tgl_transfer' => $this->input->post('tgl_transfer_1'),
				'status' => 'VALIDASI KEUANGAN'
			]);

			// $this->daftar_omb_model->create([
			// 	'registrasi_ulang_id' => $registrasi_ulang['id']
			// ]);

			$hasil_penerimaan = $this->hasil_penerimaan_model->findBySkpm($this->input->post('skpm_2'));
			$pendaftaran = $this->pendaftaran_model->find($hasil_penerimaan['pendaftaran_id']);
			$registrasi_ulang = $this->registrasi_ulang_model->create([
				'hasil_penerimaan_id' => $hasil_penerimaan['id'],
				'nama_camaru' => $pendaftaran['nama'],
				'prodi_id' => $hasil_penerimaan['prodi_id'],
				'upload_bukti_bayar' => $this->upload('upload_bukti_pembayaran_2'),
				'bank_pengirim' => $this->input->post('bank_pengirim_2'),
				'no_rek_pengirim' => $this->input->post('no_rek_pengirim_2'),
				'nama_rek_pengirim' => $this->input->post('nama_rek_pengirim_2'),
				'tgl_transfer' => $this->input->post('tgl_transfer_2'),
				'jenis_pembayaran_id' => $this->input->post('jenis_pembayaran_id_2'),
				'status' => 'VALIDASI KEUANGAN'
			]);

			// $this->daftar_omb_model->create([
			// 	'registrasi_ulang_id' => $registrasi_ulang['id']
			// ]);

		}else{
			$hasil_penerimaan = $this->hasil_penerimaan_model->findBySkpm($this->input->post('skpm'));
			$pendaftaran = $this->pendaftaran_model->find($hasil_penerimaan['pendaftaran_id']);
		
			$registrasi_ulang = $this->registrasi_ulang_model->create([
				'hasil_penerimaan_id' => $hasil_penerimaan['id'],
				'nama_camaru' => $pendaftaran['nama'],
				'prodi_id' => $hasil_penerimaan['prodi_id'],
				'upload_bukti_bayar' => $this->upload('upload_bukti_pembayaran'),
				'status' => 'VALIDASI KEUANGAN',
				'bank_pengirim' => $this->input->post('bank_pengirim'),
				'no_rek_pengirim' => $this->input->post('no_rek_pengirim'),
				'nama_rek_pengirim' => $this->input->post('nama_rek_pengirim'),
				'tgl_transfer' => $this->input->post('tgl_transfer'),
				'jenis_pembayaran_id' => $this->input->post('jenis_pembayaran_id'),
			]);

			// $this->daftar_omb_model->create([
			// 	'registrasi_ulang_id' => $registrasi_ulang['id']
			// ]);
		}
		
		$this->session->set_flashdata('success', ['Data berhasil disimpan']);
		redirect('/pendaftaran/registrasi_ulang');
	}

	public function omb(){
		$pendaftaran = $this->pendaftaran_model->findByNim($this->input->post('nim'))[0];
		print_r(json_encode($pendaftaran));
		$this->daftar_omb_model->save([
			'id' => $pendaftaran['daftar_omb_id'],
			'registrasi_ulang_id' => $pendaftaran['registrasi_ulang_id'],
			'ukuran_jas_alma' => $this->input->post('ukuran_jas_alma')
		]);
		$this->session->set_flashdata('success', ['Data berhasil disimpan']);
		redirect('/pendaftaran/omb');
	}

}
