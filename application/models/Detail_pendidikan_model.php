<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Detail_pendidikan_model extends CI_Model {

	private $table_name = 'detail_pendidikan';
	
	public function __construct()
	{
		parent::__construct();
	}

	public function get(){
		return $this->db->get($this->table_name)->result_array();
	}

	public function findByPendaftaran($pendaftaran_id){
		$pendidikan = $this->db->where('pendaftaran_id', $pendaftaran_id)->get($this->table_name)->result_array();
		return $pendidikan;
	}

	public function findByPendaftaranAndStatus($pendaftaran_id, $status){
		$pendidikan = $this->db->where('pendaftaran_id', $pendaftaran_id)->where('status', $status)->get($this->table_name)->result_array();
		return $pendidikan;
	}

	public function create($data){
		return $this->db->insert($this->table_name, $data);
	}

	public function save($data){
		$id = $data['id'];
		unset($data['id']);
		return $this->db->update($this->table_name, $data, array('id' => $id));
	}
		

}
