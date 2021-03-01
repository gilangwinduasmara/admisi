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

	public function data_user_filter($search, $limit, $start, $order_field, $order_ascdesc, $jenis_akun=null, $status=null, $date_from=null, $date_to=null){
		$sql = ("select * from akun where ROLE != 'ADMIN' and lower(nama) like lower('%$search%') ");
		if(!empty($jenis_akun)){
			$sql .= " AND role = '$jenis_akun'";
		}

		if(!empty($date_from)){
			$sql .= " AND (created_at >='$date_from' and created_at <= '$date_to')";
		}

		if(!empty($status)){
			if($status){
				$sql .= " AND email_verified_at is not null";
			}else{
				$sql .= " AND email_verified_at is null";
			}
		}

		$sql .= " order by $order_field $order_ascdesc limit $limit offset $start";
		$query = $this->db->query($sql);
		$user = $query->result_array();
		return $user;
	}
	public function data_user_count_all(){
		$sql = ("select * from akun where ROLE != 'ADMIN'");
		$query = $this->db->query($sql);
		$user = $query->num_rows();
		return $user;
	}
	public function data_user_count_filter($search, $jenis_akun=null, $status=null, $date_from=null, $date_to=null){
		$sql = ("select * from akun where ROLE != 'ADMIN' and lower(nama) like lower('%$search%') ");
		if(!empty($jenis_akun)){
			$sql .= " AND role = '$jenis_akun'";
		}

		if(!empty($date_from)){
			$sql .= " AND (created_at >='$date_from' and created_at <= '$date_to')";
		}

		if(!empty($status)){
			if($status){
				$sql .= " AND email_verified_at is not null";
			}else{
				$sql .= " AND email_verified_at is null";
			}
		}

		$query = $this->db->query($sql);
		$user = $query->num_rows();
		return $user;
	}

	
}
