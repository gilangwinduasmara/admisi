<?php

class Pendaftaran_model extends CI_Model{

	public $table_name = "pendaftaran";

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('detail_wali_model');
		$this->load->model('detail_pendidikan_model');
		$this->load->model('hasil_penerimaan_model');
		$this->load->model('pembayaran_model');
	}
	
	public function get($hasil_pendaftaran = false, $search="", $limit="", $start="", $order_field="", $order_ascdesc=""){
		$this->db->order_by('id DESC');
		if($hasil_pendaftaran){
			$this->db->where('status_formulir', 'AKTIF');
		}
		$pendaftarans = $this->db->get($this->table_name)->result_array();
		foreach($pendaftarans as &$pendaftaran){
			$validasi = $this->pembayaran_model->findByPendaftaranId($pendaftaran['id'], "VALIDASI");
			$lunas = $this->pembayaran_model->findByPendaftaranId($pendaftaran['id'], "LUNAS");
			if(count($validasi)>0){
				$validasi = $validasi[0];
			}else{
				$validasi = null;
			}
			if(count($lunas)>0){
				$lunas = $lunas[0];
			}else{
				$lunas = null;
			}
			$pendaftaran['pembayaran_validasi'] = $validasi;
			$pendaftaran['pembayaran_lunas'] = $lunas;
			if($hasil_pendaftaran){
				$pendaftaran['hasil_penerimaan'] = $this->hasil_penerimaan_model->findByPendaftaran($pendaftaran['id']);
				$pendaftaran['prodi_1'] = $this->prodi_model->find($pendaftaran['prodi_1_id']);
				$pendaftaran['prodi_2'] = $this->prodi_model->find($pendaftaran['prodi_2_id']);
			}
		}
		return $pendaftarans;
	}

	public function count_all(){
		return $this->db->count_all($this->table_name);
	}
	
	public function find($id){
		$query = $this->db->where('id', $id)->limit(1)->get($this->table_name);
		if($query->num_rows()>0){
			$pendaftaran = $query->result_array()[0];
			$validasi = $this->pembayaran_model->findByPendaftaranId($pendaftaran['id'], "VALIDASI");
			$lunas = $this->pembayaran_model->findByPendaftaranId($pendaftaran['id'], "LUNAS");
			if(count($validasi)>0){
				$validasi = $validasi[0];
			}else{
				$validasi = null;
			}
			if(count($lunas)>0){
				$lunas = $lunas[0];
			}else{
				$lunas = null;
			}
			$pendaftaran['pembayaran_validasi'] = $validasi;
			$pendaftaran['pembayaran_lunas'] = $lunas;
			$pendaftaran['hasil_penerimaan'] = $this->hasil_penerimaan_model->findByPendaftaran($pendaftaran['id']);
			$pendaftaran['detail_pendidikan'] = $this->detail_pendidikan_model->findByPendaftaran($pendaftaran['id']);
			$pendaftaran['detail_wali'] = $this->detail_wali_model->findByPendaftaran($pendaftaran['id']);
			if(!empty($pendaftara['prodi_1'])){
				$pendaftaran['prodi_1'] = $this->prodi_model->find($pendaftaran['prodi_1_id']);
			}
			if(!empty($pendaftara['prodi_2'])){
				$pendaftaran['prodi_2'] = $this->prodi_model->find($pendaftaran['prodi_2_id']);
			}
			return $pendaftaran;
		}else{
			return null;
		}
	}

	public function findByAkunId($akun_id){
		$this->db->order_by('id DESC');
		$query = $this->db->where('akun_id', $akun_id)->get($this->table_name);
		$pendaftarans = $query->result_array();
		foreach($pendaftarans as &$pendaftaran){
			$pendaftaran['pembayaran'] = $this->db->where('pendaftaran_id', $pendaftaran['id'])->limit(1)->get('pembayaran')->result_array();
			$pendaftaran['hasil_penerimaan'] = $this->hasil_penerimaan_model->findByPendaftaran($pendaftaran['id']);
			$pendaftaran['detail_wali'] = $this->detail_wali_model->findByPendaftaran($pendaftaran['id']);
			$pendaftaran['detail_pendidikan'] = $this->detail_pendidikan_model->findByPendaftaran($pendaftaran['id']);
			$proses_pembayaran = $this->db->where('pendaftaran_id', $pendaftaran['id'])->where('status !=', "BELUM LUNAS")->limit(1)->get('pembayaran')->result_array();
			if(count($proses_pembayaran)>0){
				$pendaftaran['pembayaran'] = $proses_pembayaran;
			}
		}
		return $pendaftarans;
	}

	public function create($data){
		return $this->db->insert($this->table_name, $data);
	}

	public function save($data){
		$id = $data['id'];
		unset($data['id']);
		return $this->db->update($this->table_name, $data, array('id' => $id));
	}

}
