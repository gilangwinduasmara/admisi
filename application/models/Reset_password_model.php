<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Reset_password_model extends CI_Model {

	private $table_name = 'reset_password';

	public function get(){
		return $this->db->get($this->table_name)->result_array();
	}

	public function create($data){
		$this->db->insert($this->table_name, $data);
		return $this->db->where('id', $this->db->insert_id())->get($this->table_name)->result_array()[0];
	}

	public function findEmail($email){
		$data =  $this->db->where('email', $email)->get($this->table_name)->result_array();
		if(count($data) > 0){
			return $data[0];
		}else{
			return null;
		}
	}

	public function findByToken($token){
		$data =  $this->db->where('token', $token)->get($this->table_name)->result_array();
		if(count($data) > 0){
			return $data[0];
		}else{
			return null;
		}
	}

}

/* End of file Reset_password_model.php */
