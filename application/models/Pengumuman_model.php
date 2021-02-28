<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman_model extends CI_Model {

	private $table_name = "pengumuman";

	public function get(){
		return $this->db->get($this->table_name)->result_array();
	}

	public function find($id){
		$data = $this->db->where('id', $id)->get($this->table_name)->result_array();
		if(count($data) > 0){
			return $data[0];
		}else{
			return null;
		}
	}

	public function create($data){
		$this->db->insert($this->table_name, $data);
	}

	public function save($data){
		$id = $data['id'];
		unset($data['id']);
		$this->db->update($this->table_name, $data, array('id' => $id));
	}
	

}

/* End of file Pengumuman_model.php */
