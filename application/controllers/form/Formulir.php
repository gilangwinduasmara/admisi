<?php


class Formulir extends CI_Controller{
	private $pendaftaran;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pendaftaran_model');
		$this->load->model('fakultas_model');
		$this->load->model('prodi_model');
		$this->load->model('detail_pendidikan_model');
		$this->load->model('provinsi_model');
		$this->load->model('sekolah_model');
		if(!is_numeric($this->input->get('id'))){
			redirect('/pendaftaran/data_camaru');
		}
		if(empty($this->input->get('id'))){
			redirect('/pendaftaran/data_camaru');
		}
		$this->pendaftaran = $this->pendaftaran_model->find($this->input->get('id'));
		if($this->pendaftaran['status_formulir'] == 'AKTIF' ||( $this->session->userdata('id') != $this->pendaftaran['akun_id'])){
			redirect('/pendaftaran/data_camaru');
		}
		
	}
	
	public function data_diri(){

		$data_diri = $this->pendaftaran;
		$daerah = null;
		if(!empty($data_diri['kelurahan_id'])){
			$parentsIds = $this->kelurahan_model->getParents($data_diri['kelurahan_id']);
			$daerah['provinsi'] = $this->provinsi_model->get();
			$daerah['kota_kab'] = $this->kota_model->findByProvinsi($parentsIds['selected_provinsi_id']);
			$daerah['kecamatan'] = $this->kecamatan_model->findByKota($parentsIds['selected_kota_id']);
			$daerah['kelurahan'] = $this->kelurahan_model->findByKecamatan($parentsIds['selected_kecamatan_id']);
		}
		clean($data_diri);
		$data = array(
			"page" => 'pages/pendaftaran/form/data_personal.php',
			"subheader" => [
				'Pendaftaran',
				'Isi Formulir'
			],
			"pendaftaran" => $this->pendaftaran,
			'data_diri' => $data_diri,
			'daerah' => $daerah,
			'parentIds' => $parentsIds ?? null
		);
		
		$this->load->view('default', $data);
	}

	public function data_wali(){
		// $data_wali = $this->session->userdata('form')[$this->input->get('id')]['data_wali'];
		$data_wali = $this->pendaftaran['detail_wali'] ?? null;
		$daerah = null;
		if(!empty($data_wali['kelurahan_id'])){
			$parentsIds = $this->kelurahan_model->getParents($data_wali['kelurahan_id']);
			$daerah['provinsi'] = $this->provinsi_model->get();
			$daerah['kota_kab'] = $this->kota_model->findByProvinsi($parentsIds['selected_provinsi_id']);
			$daerah['kecamatan'] = $this->kecamatan_model->findByKota($parentsIds['selected_kota_id']);
			$daerah['kelurahan'] = $this->kelurahan_model->findByKecamatan($parentsIds['selected_kecamatan_id']);
		}

		$alamat_camaru = array();
		if(!empty($this->pendaftaran['kelurahan_id'])){
			$alamat_camaru_parents = $this->kelurahan_model->getParents($this->pendaftaran['kelurahan_id']);
			$alamat_camaru['provinsi'] = $this->provinsi_model->find($alamat_camaru_parents['selected_provinsi_id']);
			$alamat_camaru['kota'] = $this->kota_model->find($alamat_camaru_parents['selected_kota_id']);
			$alamat_camaru['kecamatan'] = $this->kecamatan_model->find($alamat_camaru_parents['selected_kecamatan_id']);
			$alamat_camaru['kelurahan'] = $this->kelurahan_model->find($alamat_camaru_parents['selected_kelurahan_id']);
		}

		$data = array(
			"page" => 'pages/pendaftaran/form/data_wali.php',
			"subheader" => [
				'Pendaftaran',
				'Isi Formulir'
			],
			"pendaftaran" => $this->pendaftaran,
			'data_wali' => $data_wali,
			'daerah' => $daerah,
			"parentIds" => $parentsIds ?? null,
			"alamat_camaru" => $alamat_camaru
			
		);
		clean($data);
		$this->load->view('default', $data);
	}
	
	public function data_pendidikan(){
		$pendidikan = $this->pendaftaran['detail_pendidikan'] ?? [];
		$d = array();
		$provinsi = $this->provinsi_model->get();
		if(count($pendidikan)>0){
			for($i=0; $i<count($pendidikan); $i++){
				$d['status_pendidikan[]'][$i] = $pendidikan[$i]['status'];
				$d['npsn[]'][$i] = $pendidikan[$i]['npsn'];
				$d['jurusan[]'][$i] = $pendidikan[$i]['jurusan'];
				$d['tahun_masuk[]'][$i] = $pendidikan[$i]['tahun_masuk'];
				$d['tahun_lulus[]'][$i] = $pendidikan[$i]['tahun_lulus'];
				$d['sekolah[]'][$i] = $pendidikan[$i]['sekolah_id'];
				$d['detail_alamat[]'][$i] = $pendidikan[$i]['detail_alamat'] ?? null;
				$d['upload_ijazah[]'][$i] = $pendidikan[$i]['upload_ijazah'] ?? null;
				$d['upload_daftar_nilai[]'][$i] = $pendidikan[$i]['upload_daftar_nilai'] ?? null;

				$d['sekolah_parentIds[]'][$i] = $this->sekolah_model->getParents($pendidikan[$i]['sekolah_id']);
				$d['kota_kab[]'][$i] = $this->kota_model->findByProvinsi($d['sekolah_parentIds[]'][$i]['selected_provinsi_id']);
				$d['data_sekolah[]'][$i] = $this->sekolah_model->findByKota($d['sekolah_parentIds[]'][$i]['selected_kota_id']);

			}
		}
		$data_pendidikan = $d;
		$data = array(
			"page" => 'pages/pendaftaran/form/data_pendidikan.php',
			"subheader" => [
				'Pendaftaran',
				'Isi Formulir'
				],
			"pendaftaran" => $this->pendaftaran,
			"data_pendidikan" => $data_pendidikan,
			"provinsi" => $provinsi
		);
		clean($data);
		$this->load->view('default', $data);
	}
		
	public function data_akademik(){
		$prodi = $this->prodi_model->get();
		$data_akademik = $this->session->userdata('form')[$this->input->get('id')]['data_akademik'] ?? null;
		$data = array(
			"page" => 'pages/pendaftaran/form/data_akademik.php',
			"subheader" => [
				'Pendaftaran',
				'Isi Formulir'
			],
			"pendaftaran" => $this->pendaftaran,
			"prodi" => $prodi,
			"data_akademik" =>$data_akademik
		);
		clean($data);
		$this->load->view('default', $data);
	}

	public function unggah_berkas(){
		$data = array(
			"page" => 'pages/pendaftaran/form/unggah_berkas.php',
			"subheader" => [
				'Pendaftaran',
				'Isi Formulir'
			],
			"pendaftaran" => $this->pendaftaran
		);
		$this->load->view('default', $data);
	}
	public function submit(){
		$pendidikan = $this->pendaftaran['detail_pendidikan'] ?? [];
		$d = array();
		$provinsi = $this->provinsi_model->get();
		if(count($pendidikan)>0){
			for($i=0; $i<count($pendidikan); $i++){
				$d['status_pendidikan[]'][$i] = $pendidikan[$i]['status'];
				$d['npsn[]'][$i] = $pendidikan[$i]['npsn'];
				$d['jurusan[]'][$i] = $pendidikan[$i]['jurusan'];
				$d['tahun_masuk[]'][$i] = $pendidikan[$i]['tahun_masuk'];
				$d['tahun_lulus[]'][$i] = $pendidikan[$i]['tahun_lulus'];
				$d['sekolah[]'][$i] = $pendidikan[$i]['sekolah_id'];
				$d['detail_alamat[]'][$i] = $pendidikan[$i]['detail_alamat'] ?? null;
				$d['upload_ijazah[]'][$i] = $pendidikan[$i]['upload_ijazah'] ?? null;
				$d['upload_daftar_nilai[]'][$i] = $pendidikan[$i]['upload_daftar_nilai'] ?? null;

				$d['sekolah_parentIds[]'][$i] = $this->sekolah_model->getParents($pendidikan[$i]['sekolah_id']);
				$d['provinsi[]'][$i] = $this->provinsi_model->find($d['sekolah_parentIds[]'][$i]['selected_provinsi_id']);
				$d['kota_kab[]'][$i] = $this->kota_model->findByProvinsi($d['sekolah_parentIds[]'][$i]['selected_provinsi_id']);
				$d['data_sekolah[]'][$i] = $this->sekolah_model->findByKota($d['sekolah_parentIds[]'][$i]['selected_kota_id']);

			}
		}
		$data_pendidikan = $d;



		$data_diri = $this->pendaftaran;
		$daerah = null;
		if(!empty($data_diri['kelurahan_id'])){
			$parentsIds = $this->kelurahan_model->getParents($data_diri['kelurahan_id']);
			$daerah['parentsIds'] = $parentsIds;
			$daerah['provinsi'] = $this->provinsi_model->get();
			$daerah['kota_kab'] = $this->kota_model->findByProvinsi($parentsIds['selected_provinsi_id']);
			$daerah['kecamatan'] = $this->kecamatan_model->findByKota($parentsIds['selected_kota_id']);
			$daerah['kelurahan'] = $this->kelurahan_model->findByKecamatan($parentsIds['selected_kecamatan_id']);
		}

		$data_wali = $this->pendaftaran['detail_wali'] ?? null;
		$daerah_wali = null;
		if(!empty($data_wali['kelurahan_id'])){
			$parentsIds = $this->kelurahan_model->getParents($data_wali['kelurahan_id']);
			$daerah_wali['parentsIds'] = $parentsIds;
			$daerah_wali['provinsi'] = $this->provinsi_model->get();
			$daerah_wali['kota_kab'] = $this->kota_model->findByProvinsi($parentsIds['selected_provinsi_id']);
			$daerah_wali['kecamatan'] = $this->kecamatan_model->findByKota($parentsIds['selected_kota_id']);
			$daerah_wali['kelurahan'] = $this->kelurahan_model->findByKecamatan($parentsIds['selected_kecamatan_id']);
		}

		$data_akademik = $this->session->userdata('form')[$this->input->get('id')]['data_akademik'] ?? null;
		$prodi = $this->prodi_model->get();
		$data = array(
			"page" => 'pages/pendaftaran/form/submit.php',
			"subheader" => [
				'Pendaftaran',
				'Isi Formulir'
			],
			"pendaftaran" => $this->pendaftaran,
			"data_diri" => $data_diri,
			"daerah_wali" => $daerah_wali,
			"data_wali" => $data_wali,
			"data_pendidikan" => $data_pendidikan,
			"provinsi" => $provinsi,
			"data_akademik" => $data_akademik,
			"daerah" => $daerah,
			"prodi" => $prodi
		);

		clean($data);
		$this->load->view('default', $data);
	}
}
