<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Detail_wali_model extends CI_Model {

	private $table_name = 'detail_wali';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('kelurahan_model');
	}
		
	public function findByPendaftaran($pendaftaran_id){
		$detail_wali = $this->db->where('pendaftaran_id', $pendaftaran_id)->limit(1)->get($this->table_name)->result_array();
		if(count($detail_wali) > 0){
			$detail_wali[0]['kelurahan'] = $this->kelurahan_model->find($detail_wali[0]['id']);
			return $detail_wali[0];
		}else{
			return null;
		}
	}

	public function create($data){
		unset($data['id']);
		unset($data['same_address']);
		$this->db->insert($this->table_name, $data);
	}

	public function save($data){
		$id = $data['id'];
		unset($data['id']);
		unset($data['same_address']);
		$this->db->update($this->table_name, $data, array('id' => $id));
	}

}
