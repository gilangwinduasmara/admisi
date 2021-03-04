<?php

class Kecamatan_model extends CI_Model{
	private $table_name = "kecamatan";

	public function create($data){
		$this->db->insert($this->table_name, $data);
		return $this->db->insert_id();
	}

	public function get(){
		$query = $this->db->get($this->table_name);
		return $query->result_array();
	}

	public function findByKota($kota_id){
		$query = $this->db->where('kota_id', $kota_id)->get($this->table_name);
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