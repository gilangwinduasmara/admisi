<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Detail_prestasi_model extends CI_Model {
	private $table_name = "detail_prestasi";

	public function findByPendaftaran($pendaftaran_id){
		$detail_prestasi = $this->db->where("pendaftaran_id", $pendaftaran_id)->get($this->table_name);
		return $detail_prestasi->result_array();
	}

	public function create($data){
		$this->db->insert($this->table_name, $data);
	}

	public function save($data){
		$id = $data['id'];
		unset($data['id']);
		$this->db->update($this->table_name, $data, array("id" => $id));
	}

}

