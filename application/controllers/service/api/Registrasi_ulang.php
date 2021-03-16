<?php

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') OR exit('No direct script access allowed');

class Registrasi_ulang extends RestController {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('registrasi_ulang_model');
	}
	
	public function index_get(){
		$status = $this->get('status');
		$id = last_segment($this->uri);
		if(is_numeric($id)){
			$data = $this->registrasi_ulang_model->find($id);
			$this->response($data, 200);	
		}
		$data = $this->registrasi_ulang_model->get();
		$this->response($data, 200);
	}

	public function camaru_get(){
		$data = $this->registrasi_ulang_model->get();
	}

	public function status_get(){
		$get = $this->get();
		$status = urldecode((array_keys($get)[0]) ?? null);
		if($status){
			$enum = ["LUNAS", "VALIDASI NIM", "VALIDASI KEUANGAN", "BELUM BAYAR", "SUDAH REGISTRASI"];
			if(!in_array($status, $enum)){
				$this->response(array(
					"error" => true,
					"message" => 'must be any enum of LUNAS, VALIDASI NIM, VALIDASI KEUANGAN, BELUM BAYAR, SUDAH REGISTRASI'
				), 200);	
			}
			$data = $this->registrasi_ulang_model->get($status);
			if($status == 'VALIDASI NIM'){
				$data = $this->rearange($data);
			}
			$this->response($data, 200);
		}
		$this->response($status, 200);
	}

	private function rearange($data){
		foreach($data as $key=>&$d){
			$arranged['data_akademis'] = array();
			$arranged['data_personal'] = array();
			$arranged['alamat_camaru'] = array();
			$arranged['data_wali'] = array();

			$arranged['data_akademis']['foto'] = $d['hasil_penerimaan']['pendaftaran']['upload_foto'] ?? null;
			$arranged['data_akademis']['no_pendaftaran'] = $d['hasil_penerimaan']['pendaftaran']['id'] ?? null;
			$arranged['data_akademis']['kode_prodi_masuk'] = $d['prodi_id'] ?? null;
			$arranged['data_akademis']['status_masuk_mahasiswa_id'] = null ?? null;
			$arranged['data_akademis']['status_masuk_mahasiswa'] = 'Peserta Didik Baru' ?? null;
			$arranged['data_akademis']['tahun_angkatan'] = $d['hasil_penerimaan']['pendaftaran']['tahun_akademik']['tahun_akademik'] ?? null;
			$arranged['data_akademis']['jalur_daftar'] = $d['hasil_penerimaan']['pendaftaran']['jalur_pendaftaran']['jalur_pendaftaran'] ?? null;
			$arranged['data_akademis']['biaya_masuk'] = null ?? null;

			$arranged['data_personal']['nama_mahasiswa'] = $d['nama_camaru'] ?? null;
			$arranged['data_personal']['NISN'] = $d['hasil_penerimaan']['pendaftaran']['NISN'] ?? null;
			$arranged['data_personal']['no_kk'] = $d['hasil_penerimaan']['pendaftaran']['KK'] ?? null;
			$arranged['data_personal']['NIK'] = $d['hasil_penerimaan']['pendaftaran']['NIK'] ?? null;
			$arranged['data_personal']['email'] = $d['hasil_penerimaan']['pendaftaran']['email'] ?? null;
			$arranged['data_personal']['np_hp'] = $d['hasil_penerimaan']['pendaftaran']['no_hp'] ?? null;
			$arranged['data_personal']['tempat_lahir'] = $d['hasil_penerimaan']['pendaftaran']['kota_kelahiran'] ?? null;
			$arranged['data_personal']['tanggal_lahir'] = $d['hasil_penerimaan']['pendaftaran']['tgl_lahir'] ?? null;
			$arranged['data_personal']['jenis_kelamin'] = $d['hasil_penerimaan']['pendaftaran']['jenis_kelamin'] ?? null;
			$arranged['data_personal']['status_nikah'] = $d['hasil_penerimaan']['pendaftaran']['status_sipil'] ?? null;
			$arranged['data_personal']['agama'] = $d['hasil_penerimaan']['pendaftaran']['agama'] ?? null;
			$arranged['data_personal']['gol_darah'] = $d['hasil_penerimaan']['pendaftaran']['gol_darah'] ?? null;
			$arranged['data_personal']['tinggi_badan'] = $d['hasil_penerimaan']['pendaftaran']['tinggi_badan'] ?? null;
			$arranged['data_personal']['berat_badan'] = $d['hasil_penerimaan']['pendaftaran']['berat_badan'] ?? null;
			$arranged['data_personal']['suku'] = $d['hasil_penerimaan']['pendaftaran']['suku'] ?? null;
			$arranged['data_personal']['status_tinggal'] = $d['hasil_penerimaan']['pendaftaran']['status_tinggal'] ?? null;
			$arranged['data_personal']['kewarganegaraan'] = $d['hasil_penerimaan']['pendaftaran']['kewarganegaraan'] ?? null;

			$arranged['alamat_camaru']['rt'] = $d['hasil_penerimaan']['pendaftaran']['rt'] ?? null;
			$arranged['alamat_camaru']['rw'] = $d['hasil_penerimaan']['pendaftaran']['rw'] ?? null;
			$arranged['alamat_camaru']['alamat'] = $d['hasil_penerimaan']['pendaftaran']['alamat_asal'] ?? null;
			$arranged['alamat_camaru']['kelurahan_id'] = $d['hasil_penerimaan']['pendaftaran']['kelurahan_id'] ?? null;
			$arranged['alamat_camaru']['kelurahan'] = $d['hasil_penerimaan']['pendaftaran']['kelurahan']['kelurahan'] ?? null;
			$arranged['alamat_camaru']['negara'] = ($d['hasil_penerimaan']['pendaftaran']['kewarganegaraan'] == 'WNI' ? 'ID' : $d['hasil_penerimaan']['pendaftaran']['negara']) ?? null;
			$arranged['alamat_camaru']['alamat_domisili'] = 0 ?? null;
			$arranged['alamat_camaru']['kelurahab_domisili_id'] = 0 ?? null;

			$arranged['data_wali']['nama_wali'] = $d['hasil_penerimaan']['pendaftaran']['detail_wali']['nama'] ?? null;
			$arranged['data_wali']['email'] = $d['hasil_penerimaan']['pendaftaran']['detail_wali']['email'] ?? null;
			$arranged['data_wali']['no_hp'] = $d['hasil_penerimaan']['pendaftaran']['detail_wali']['no_hp'] ?? null;
			$arranged['data_wali']['pekerjaan'] = $d['hasil_penerimaan']['pendaftaran']['detail_wali']['pekerjaan'] ?? null;
			$arranged['data_wali']['alamat'] = $d['hasil_penerimaan']['pendaftaran']['detail_wali']['alamat'] ?? null;
			$arranged['data_wali']['kelurahan_id'] = $d['hasil_penerimaan']['pendaftaran']['detail_wali']['kelurahan_id'] ?? null;
			$arranged['data_wali']['kelurahan'] = $d['hasil_penerimaan']['pendaftaran']['detail_wali']['kelurahan']['kelurahan'] ?? null ;
			$arranged['data_wali']['ibu_kandung'] = $d['hasil_penerimaan']['pendaftaran']['detail_wali']['nama'] ?? null;
			$data[$key] = $arranged;
		}
		return $data;
	}

	public function index_put(){
		// echo "tes";
		$id = last_segment($this->uri);
		$data = array('id' => $id);
		foreach(["hasil_penerimaan_id","nama_camaru","upload_bukti_bayar","nim","prodi_id","status"] as $field){
			if(!empty($this->put($field))){
				$data[$field] = $this->put($field);
			}
		}

		if(!empty($data['nim'])){
			$data['status'] = 'SUDAH REGISTRASI';
		}

		$data = $this->registrasi_ulang_model->save($data);
		$this->response(array(
			'success' => true,
			'message' => "Data successfully updated",
			'data' => $data
		), 200);
	}

	
	public function dt_registrasi_ulang_get(){
		$search = $_GET['search']['value']; // Ambil data yang di ketik user pada textbox pencarian
		$limit = $_GET['length']; // Ambil data limit per page
		$start = $_GET['start']; // Ambil data start
		$order_index = $_GET['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
		$order_field = $_GET['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
		$order_ascdesc = $_GET['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"

		$searchByFromDate = $_GET['searchByFromDate'] ?? null;
		$searchByToDate = $_GET['searchByToDate'] ?? null;
		$searchByProdi = $_GET['searchByProdi'] ?? null;
		$searchByStatus = $_GET['searchByStatus'] ?? null;
		$searchByTahunAkademik = $_GET['columns'][1]['search']['value'] ?? null;

		$count = $this->registrasi_ulang_model->data_registrasi_ulang_count_all();
		$data = $this->registrasi_ulang_model->data_registrasi_ulang_filter($search, $limit, $start, $order_field, $order_ascdesc, $searchByStatus, $searchByProdi, $searchByFromDate, $searchByToDate, $searchByTahunAkademik);
		$count_filter = $this->registrasi_ulang_model->data_registrasi_ulang_filter_count($search, $searchByStatus, $searchByProdi, $searchByFromDate, $searchByToDate, $searchByTahunAkademik);
		
		$response = array(
			'draw'=>$_GET['draw'], // Ini dari datatablenya
			'recordsTotal'=>$count,
			'recordsFiltered'=>$count_filter,
			'data'=>$data
		);

		$this->response($response, 200);
	}
}

/* End of file Registrasi_ulang.php */
