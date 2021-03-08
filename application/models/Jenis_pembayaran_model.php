<?php
	class Jenis_pembayaran_model extends CI_Model{
		private $table_name = "jenis_pembayaran";
		public function get(){
			$query = $this->db->get($this->table_name);
			return $query->result_array();
		}

		public function create($data){
			$this->db->insert($this->table_name, $data);
		}

		public function find($id){
			$query = $this->db->where('id', $id)->limit(1)->get($this->table_name);
			if($query->num_rows()>0){
				return $query->result_array()[0];
			}else{
				return null;
			}
		}
	
	
		public function save($data){
			$id = $data['id'];
			unset($data['id']);
			$this->db->update($this->table_name, $data, array('id' => $id));
		}

		public function dt_filter($search, $limit, $start, $order_field, $order_ascdesc){
			$sql = ("select * from jenis_pembayaran WHERE LOWER(jenis_pembayaran) like LOWER('%$search%')");
			$sql .= " order by $order_field $order_ascdesc limit $limit offset $start";
			$query = $this->db->query($sql);
			$data = $query->result_array();
			return $data;
		}
	
		public function dt_count_all(){
			$sql = "select * from jenis_pembayaran";
			$query = $this->db->query($sql);
			$data = $query->num_rows();
			return $data;
		}
	
		public function dt_count_filter($search){
			$sql = ("select * from jenis_pembayaran WHERE LOWER(jenis_pembayaran) like LOWER('%$search%')");
			$query = $this->db->query($sql);
			$data = $query->num_rows();
			return $data;
		}

	}
?>
