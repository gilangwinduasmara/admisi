<?php


class Jenjang_model extends CI_Model{
	public $table_name = "jenjang";

	public function get(){
		$query = $this->db->get($this->table_name);
		return $query->result_array();
	}

	public function findById($id){
		$result = $this->db->where('id', $id)->limit(1)->get($this->table_name);
		if($result->num_rows() > 0){
			return $result->row();
		}
		return FALSE;
	}

}
