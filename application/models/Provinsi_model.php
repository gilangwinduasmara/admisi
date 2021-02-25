<?php

class Provinsi_model extends CI_Model{
	private $table_name = "provinsi";

	public function getChilds(){
		$query = $this->db->query("
		WITH daerah AS (
			SELECT kelurahan.id AS selected_kelurahan_id, kecamatan.id AS selected_kecamatan_id, kota.id AS selected_kota_id, provinsi.id AS selected_provinsi_id
				from kelurahan 
					join kecamatan 
						on kecamatan.id = kelurahan.kecamatan_id 
					join kota 
						on kota.id = kecamatan.kota_id
					join provinsi 
						on provinsi.id = kota.provinsi_id 
				where kelurahan.id = '5'
		)
		SELECT kelurahan.id AS selected_kelurahan_id, kecamatan.id AS selected_kecamatan_id, kota.id AS selected_kota_id, provinsi.id AS selected_provinsi_id
		from kelurahan 
			join kecamatan 
				on kecamatan.id = kelurahan.kecamatan_id 
			join kota 
				on kota.id = kecamatan.kota_id
			join provinsi 
				on provinsi.id = kota.provinsi_id 
		where kelurahan.id = '5'");
		$parent_ids = $query->result_array()[0];
		$kota_result = $this->kota_model->findByProvinsi($parent_ids['selected_provinsi_id']);
		$daerah = array();
		foreach($kota_result as $kota){
			$kota['kecamatan'] = $this->kecamatan_model->findByKota($kota['id']);
			foreach($kota['kecamatan'] as &$k){
				$k['kelurahan'] = $this->kelurahan_model->findByKecamatan($k['id']);
			}
			$daerah[]['kota_kab'] = $kota;
		}
		return $daerah;
	}

	public function create($data){
		$this->db->insert($this->table_name, $data);
		return $this->db->insert_id();
	}

	public function get(){
		$query = $this->db->get($this->table_name);
		return $query->result_array();
	}

}
