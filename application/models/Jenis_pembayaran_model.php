<?php
	class Jenis_pembayaran_model extends CI_Model{
		private $table_name = "jenis_pembayaran";
		public function get(){
			$query = $this->db->get($this->table_name);
			return $query->result_array();
		}
	}
?>
