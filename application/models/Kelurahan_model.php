<?php

class Kelurahan_model extends CI_Model{
	private $table_name = "kelurahan";

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('kecamatan_model');
		$this->load->model('kota_model');
		$this->load->model('kelurahan_model');
		$this->load->model('provinsi_model');
	}
	

	public function getParents(){
		$query = $this->db->query("
		WITH daerah AS (
			SELECT kelurahan.id AS selected_kelurahan_id, kecamatan.id AS selected_kecamatan_id, kota.id AS selected_kota_id, provinsi.id AS selected_provinsi_id
				from kelurahan 
					join kecamatan 
						on kecamatan.id = kelurahan.kecamatan_id 
					join kota 
						on kota.id = kecamatan.kota_id
					join provinsi 
						on provinsi.id = kota.provinsi_id 
				where kelurahan.id = '5'
		)
		SELECT kelurahan.id AS selected_kelurahan_id, kecamatan.id AS selected_kecamatan_id, kota.id AS selected_kota_id, provinsi.id AS selected_provinsi_id
		from kelurahan 
			join kecamatan 
				on kecamatan.id = kelurahan.kecamatan_id 
			join kota 
				on kota.id = kecamatan.kota_id
			join provinsi 
				on provinsi.id = kota.provinsi_id 
		where kelurahan.id = '5'");
		$parent_ids = $query->result_array()[0];
		return $parent_ids;
	}

	public function create($data){
		$this->db->insert($this->table_name, $data);
		return $this->db->insert_id();
	}

	public function get(){
		$query = $this->db->get($this->table_name);
		return $query->result_array();
	}

	public function findByKecamatan($kecamatan_id){
		$query = $this->db->where('kecamatan_id', $kecamatan_id)->get($this->table_name);
		return $query->result_array();
	}

	public function find($id){
		$data = $this->db->where('id', $id)->get($this->table_name)->result_array();
		if(count($data) > 0){
			return $data[0];
		}else{
			return null;
		}
	}

}
