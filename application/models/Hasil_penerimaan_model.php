<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Hasil_penerimaan_model extends CI_Model {

	private $table_name = 'hasil_penerimaan';

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('prodi_model');
		$this->load->model('registrasi_ulang_model');
		$this->load->model('pendaftaran_model');
	}

	public function findByRegistrasiUlang($registrasi_ulang_id){
		// $hasil_penerimaan = $this->db->where('id', $registrasi_ulang_id)->get($this->table_name)->result_array();

		// if(count($hasil_penerimaan) > 0){
		// 	$hasil_penerimaan = $hasil_penerimaan[0];
		// 	$hasil_penerimaan['formulir'] = $this->pendaftaran_model->findByHasilPenerimaan($hasil_penerimaan['id']);
		// 	return $hasil_penerimaan;
		// }

		// return null;
		
	}

	public function findByPendaftaran($pendaftaran_id, $status=null){
		if(!empty($status)){
			$this->db->where('status', $status);
		}
		$hasil_penerimaan = $this->db->where('pendaftaran_id', $pendaftaran_id)->limit(2)->get($this->table_name)->result_array();
		foreach($hasil_penerimaan as &$penerimaan){
			$penerimaan['prodi'] = $this->prodi_model->find($penerimaan['prodi_id']);
			$penerimaan['registrasi_ulang'] = $this->registrasi_ulang_model->findByHasilPenerimaan($penerimaan['id']);
		}
		return $hasil_penerimaan;
	}

	public function find($id){
		$hasil_penerimaan = $this->db->where('id', $id)->limit(1)->get($this->table_name)->result_array();
		if(count($hasil_penerimaan) > 0){
			return $hasil_penerimaan[0];
		}
		return null;
	}

	public function findBySkpm($kode_skpm){
		$hasil_penerimaan = $this->db->where('kode_skpm', $kode_skpm)->limit(1)->get($this->table_name)->result_array();
		if(count($hasil_penerimaan) > 0){
			return $hasil_penerimaan[0];
		}
		return null;
	}

	public function create($data){
		$this->db->insert($this->table_name, $data);
		return $this->db->insert_id();
	}

	public function save($data){
		$id = $data['id'];
		unset($data['id']);
		$this->db->update($this->table_name, $data, array('id' => $id));
	}

}
