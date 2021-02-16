<?php
class Akun_model extends CI_Model{
	private $table_name = "akun";
	public $no_hp;
	public $email;
	public $password;
	public $email_verified_at;
	public $created_at;
	public $updated_at;
	
	public function create($data){
		return $this->db->insert($this->table_name, $data);
	}

	public function findByEmail($email){
		$result = $this->db->where('email', $email)->limit(1)->get($this->table_name);
		if($result->num_rows() > 0){
			return $result->row();
		}
		return FALSE;
	}

	
}
