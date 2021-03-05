<?php


class Prodi_model extends CI_Model{
	private $table_name = "prodi";

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('fakultas_model');
	}
	

	public function find($prodi_id){
		$prodi = $this->db->where('id', $prodi_id)->limit(1)->get($this->table_name)->result_array()[0];
		$prodi['fakultas'] = $this->db->where('id', $prodi['fakultas_id'])->limit(1)->get('fakultas')->result_array()[0];
		return $prodi;
	}

	public function get()
	{
		$query =  $this->db->get($this->table_name)->result_array();
		foreach($query as &$prodi){
			$prodi['fakultas'] = $this->fakultas_model->find($prodi['fakultas_id']);
		}
		return $query;
	}


	public function dt_filter($search, $limit, $start, $order_field, $order_ascdesc, $fakultas = null){
		$sql = ("select * from prodi join (select nama_fakultas, id as fakultas_id from fakultas) as fakultas on prodi.fakultas_id = fakultas.fakultas_id
		WHERE LOWER(prodi.nama_prodi) like LOWER('%$search%')");

		if(!empty($fakultas)){
			$sql .= " AND prodi.fakultas_id = '$fakultas'";
		}
		
		$sql .= " order by $order_field $order_ascdesc limit $limit offset $start";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		return $data;
	}
	public function dt_count_all(){
		$sql = ("select * from prodi join (select nama_fakultas, id as fakultas_id from fakultas) as fakultas on prodi.fakultas_id = fakultas.fakultas_id");
		$query = $this->db->query($sql);
		$pendaftarans = $query->num_rows();
		return $pendaftarans;
	}

	public function dt_count_filter($search, $fakultas){
		$sql = ("select * from prodi join (select nama_fakultas, id as fakultas_id from fakultas) as fakultas on prodi.fakultas_id = fakultas.fakultas_id
		WHERE LOWER(prodi.nama_prodi) like LOWER('%$search%')");

		if(!empty($fakultas)){
			$sql .= " AND prodi.fakultas_id = '$fakultas'";
		}

		$query = $this->db->query($sql);
		return $query->num_rows();
	}

}
