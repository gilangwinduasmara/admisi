<?php

class Kota_model extends CI_Model{
	private $table_name = "kota";
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function create($data){
		$this->db->insert($this->table_name, $data);
		return $this->db->insert_id();
	}

	public function get(){
		$query = $this->db->get($this->table_name);
		return $query->result_array();
	}

	public function findByProvinsi($provinsi_id){
		$query = $this->db->where('provinsi_id', $provinsi_id)->get($this->table_name);
		return $query->result_array();
	}

}
