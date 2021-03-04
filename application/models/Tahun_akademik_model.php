<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tahun_akademik_model extends CI_Model {
	
	private $table_name = "tahun_akademik";

	public function get(){
		return $this->db->get($this->table_name)->result_array();
	}

	public function findByStatus($status){
		return $this->db->where('status', $status)->get($this->table_name)->result_array();
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
		$sql = ("select * from tahun_akademik WHERE LOWER(tahun_akademik) like LOWER('%$search%')");
		$sql .= " order by $order_field $order_ascdesc limit $limit offset $start";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}

	public function dt_count_all(){
		$sql = "select * from tahun_akademik";
		$query = $this->db->query($sql);
		$data = $query->num_rows();
		return $data;
	}

	public function dt_count_filter($search){
		$sql = ("select * from tahun_akademik WHERE LOWER(tahun_akademik) like LOWER('%$search%')");
		$query = $this->db->query($sql);
		$data = $query->num_rows();
		return $data;
	}

}

/* End of file Tahun_akademik.php */
