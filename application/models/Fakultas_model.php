<?php


class Fakultas_model extends CI_Model{
	private $table_name = "fakultas";

	public function find($fakultas_id){
		$query =  $this->db->where('id', $fakultas_id)->limit(1)->get($this->table_name)->result_array()[0];
		return $query;
	}

	public function get()
	{
		$query =  $this->db->get($this->table_name)->result_array();
		return $query;
	}
}
