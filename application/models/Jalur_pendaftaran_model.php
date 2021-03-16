<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jalur_pendaftaran_model extends CI_Model {

	private $table_name = "jalur_pendaftaran";
	
	public function __construct()
	{
		parent::__construct();
	}

	public function find($id){
		$data = $this->db->where('id', $id)->get($this->table_name)->result_array();
		if(count($data) > 0){
			return $data[0];
		}else{
			return null;
		}
	}

	public function get(){
		return $this->db->get($this->table_name)->result_array();
	}

	public function create($data){
		$this->db->insert($this->table_name, $data);
	}

	public function save($data){
		$id = $data['id'];
		unset($data['id']);
		$this->db->update($this->table_name, $data, array('id' => $id));
	}
	

	public function dt_filter($search, $limit, $start, $order_field, $order_ascdesc){
		$sql = ("select * from jalur_pendaftaran WHERE LOWER(jalur_pendaftaran) like LOWER('%$search%')");
		$sql .= " order by $order_field $order_ascdesc limit $limit offset $start";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function dt_count_all(){
		$sql = "select * from jalur_pendaftaran";
		$query = $this->db->query($sql);
		$data = $query->num_rows();
		return $data;
	}

	public function dt_count_filter($search){
		$sql = ("select * from jalur_pendaftaran WHERE LOWER(jalur_pendaftaran) like LOWER('%$search%')");
		$query = $this->db->query($sql);
		$data = $query->num_rows();
		return $data;
	}

}

/* End of file Jalur_pendafaran_model.php */
