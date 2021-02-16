<?php

class Pembayaran_model extends CI_Model{

	public $table_name = "pembayaran";
	
	public function find($id){
		$query = $this->db->where('id', $id)->limit(1)->get($this->table_name);
		if($query->num_rows()>0){
			return $query->result_array()[0];
		}else{
			return null;
		}
	}

	public function findByAkunId($akun_id){
		$query = $this->db->where('akun_id', $akun_id)->get($this->table_name);
		return $query->result_array();
	}

	public function findByPendaftaranId($pendaftaran_id){
		$query = $this->db->where('pendaftaran_id', $pendaftaran_id)->get($this->table_name);
		return $query->result_array();
	}

	public function isValidating($pendaftaran_id){
		$query = $this->db->where('pendaftaran_id', $pendaftaran_id)->where('status', 'VALIDASI')->get($this->table_name)->result_array();
		return (count($query)>0);
	}

	public function matchPendaftaran($pembayaran_id, $pendaftaran_id){
		$query = $this->db->where('pendaftaran_id', $pendaftaran_id)->where('id', $pembayaran_id)->get($this->table_name)->result_array();
		return count($query)>0;
	}

	public function create($data){
		$this->db->insert($this->table_name, $data);
		return $this->db->insert_id();
	}

	public function save($data){
		$id = $data['id'];
		unset($data['id']);
		return $this->db->update($this->table_name, $data, array('id' => $id));
	}

}
