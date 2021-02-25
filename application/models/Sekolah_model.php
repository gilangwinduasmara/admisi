<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sekolah_model extends CI_Model {
	private $table_name = 'sekolah';

	public function getParents($sekolah_id){
		$query = $this->db->query("
		WITH daerah AS (
			SELECT sekolah.id AS selected_sekolah_id, kota.id AS selected_kota_id, provinsi.id AS selected_provinsi_id
				from sekolah
					join kota 
						on kota.id = sekolah.kota_id
					join provinsi 
						on provinsi.id = kota.provinsi_id 
				where sekolah.id = '$sekolah_id'
		)
		SELECT sekolah.id AS selected_sekolah_id, kota.id AS selected_kota_id, provinsi.id AS selected_provinsi_id
		from sekolah
			join kota 
				on kota.id = sekolah.kota_id
			join provinsi 
				on provinsi.id = kota.provinsi_id 
		where sekolah.id = '$sekolah_id'");
		$parent_ids = $query->result_array()[0];
		return $parent_ids;
	}

	public function findByKota($kota_id){
		$query = $this->db->where('kota_id', $kota_id)->get($this->table_name);
		return $query->result_array();
	}
}

/* End of file ModelName.php */
