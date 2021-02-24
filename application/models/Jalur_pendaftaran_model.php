<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jalur_pendaftaran_model extends CI_Model {

	private $table_name = "jalur_pendaftaran";
	
	public function __construct()
	{
		parent::__construct();
	}

	public function get(){
		return $this->db->get($this->table_name)->result_array();
	}
	

}

/* End of file Jalur_pendafaran_model.php */
