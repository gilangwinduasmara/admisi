<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gelombang_model extends CI_Model {

	private $table_name = 'gelombang';

	public function get(){
		$sql = "select * from gelombang join tahun_akademik on gelombang.tahun_akademik_id = tahun_akademik.id";
		return $this->db->query($sql)->result_array();
	}

	public function save($data){
		$id = $data['id'];
		unset($data['id']);
		$this->db->update($this->table_name, $data, array('id',  $id));
	}

	public function getCurrentActiveGelombang(){
		$now = date_format(date_create(), "Y-m-d");
		$query = $this->db->query("select * from gelombang where '$now' > tanggal_mulai and '$now' < tanggal_selesai ");
		$gelombang = $query->result_array();
		if(count($gelombang) > 0){
			return $gelombang[0];
		}
		return null;
	}

	public function create($data){
		$this->db->insert($this->table_name, $data);
	}

}

/* End of file Gelombang_model.php */
