<?php


class Prodi_model extends CI_Model{
	private $table_name = "prodi";

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('fakultas_model');
	}
	

	public function find($prodi_id){
		$prodi = $this->db->where('id', $prodi_id)->limit(1)->get($this->table_name)->result_array()[0];
		$prodi['fakultas'] = $this->db->where('id', $prodi['fakultas_id'])->limit(1)->get('fakultas')->result_array()[0];
		return $prodi;
	}

	public function get()
	{
		$query =  $this->db->get($this->table_name)->result_array();
		foreach($query as &$prodi){
			$prodi['fakultas'] = $this->fakultas_model->find($prodi['fakultas_id']);
		}
		return $query;
	}
}
