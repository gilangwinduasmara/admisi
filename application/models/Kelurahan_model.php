<?php

class Kelurahan_model extends CI_Model{
	private $table_name = "kelurahan";

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

}
