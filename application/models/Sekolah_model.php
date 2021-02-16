<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sekolah_model extends CI_Model {
	private $table_name = 'sekolah';
	public function findByKota($kota_id){
		$query = $this->db->where('kota_id', $kota_id)->get($this->table_name);
		return $query->result_array();
	}
}

/* End of file ModelName.php */
