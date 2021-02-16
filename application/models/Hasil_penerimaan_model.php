<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Hasil_penerimaan_model extends CI_Model {

	private $table_name = 'hasil_penerimaan';

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('prodi_model');
	}
	

	public function findByPendaftaran($pendaftaran_id){
		$hasil_penerimaan = $this->db->where('pendaftaran_id', $pendaftaran_id)->get($this->table_name)->result_array();
		foreach($hasil_penerimaan as &$penerimaan){
			$penerimaan['prodi'] = $this->prodi_model->find($penerimaan['prodi_id']);
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

	public function create($data){
		$this->db->insert($this->table_name, $data);
		return $this->db->insert_id();
	}

}
