<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Registrasi_ulang_model extends CI_Model {

	private $table_name = "registrasi_ulang";

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('prodi_model');
		$this->load->model('daftar_omb_model');
	}

	public function findByNim($nim){
		$query = $this->db->query("SELECT * 
							FROM pendaftaran
							JOIN hasil_penerimaan
								ON pendaftaran.id = hasil_penerimaan.pendaftaran_id
							JOIN registrasi_ulang
								ON registrasi_ulang.hasil_penerimaan_id = hasil_penerimaan.id
							JOIN daftar_omb
								ON daftar_omb.registrasi_ulang_id = registrasi_ulang.id
							Join prodi
								ON prodi.id = registrasi_ulang.prodi_id
							WHERE registrasi_ulang.nim = '$nim' and registrasi_ulang.status = 'LUNAS'");
		return $query->result_array();
	}

	public function findByVerifiedRegistrasiUlang($akun_id){
		$query = $this->db->query("SELECT * 
							FROM pendaftaran
							JOIN hasil_penerimaan
								ON pendaftaran.id = hasil_penerimaan.pendaftaran_id
							JOIN registrasi_ulang
								ON registrasi_ulang.hasil_penerimaan_id = hasil_penerimaan.id
							JOIN daftar_omb
								ON daftar_omb.registrasi_ulang_id = registrasi_ulang.id
							WHERE pendaftaran.akun_id = '$akun_id' and registrasi_ulang.status = 'LUNAS' and hasil_penerimaan.status = 'DITERIMA'");
		return $query->result_array();
	}
	
	public function get(){
		return $this->db->query('SELECT *, registrasi_ulang.status as status_registrasi_ulang, registrasi_ulang.id as registrasi_ulang_id
		FROM registrasi_ulang
		JOIN hasil_penerimaan
			on registrasi_ulang.hasil_penerimaan_id = hasil_penerimaan.id
		JOIN prodi
			on hasil_penerimaan.prodi_id = prodi.id')->result_array();
		 
	}

	public function findByHasilPenerimaan($pendaftaran_id){
		$this->db->where('hasil_penerimaan_id', $pendaftaran_id);
		$registrasi_ulang = $this->db->get($this->table_name)->result_array();
		if(count($registrasi_ulang) > 0){
			$registrasi_ulang[0]['prodi'] = $this->prodi_model->find($registrasi_ulang[0]['prodi_id']);
			$registrasi_ulang[0]['daftar_omb'] = $this->daftar_omb_model->findByRegistrasiUlang($registrasi_ulang[0]['id']);
			return $registrasi_ulang[0];
		}
		return null;
	}
	
	public function create($data){
		$this->db->insert($this->table_name, $data);
		return $this->db->where('id', $this->db->insert_id())->get($this->table_name)->result_array()[0];
	}

	public function save($data){
		$id = $data['id'];
		print_r($id);
		unset($data['id']);
		$this->db->update($this->table_name, $data, array('id' => $id));
		return $this->db->where('id', $id)->get($this->table_name)->result_array()[0];
	}

}

/* End of file Registrasi_ulang_model.php */
