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
		$this->load->model('registrasi_ulang_model');
	}

	public function findByNim($nim){
		$query = $this->db->query("SELECT *, registrasi_ulang.id AS registrasi_ulang_id
								FROM pendaftaran
								JOIN hasil_penerimaan
									ON pendaftaran.id = hasil_penerimaan.pendaftaran_id
								JOIN registrasi_ulang
									ON registrasi_ulang.hasil_penerimaan_id = hasil_penerimaan.id
								LEFT JOIN (SELECT ukuran_jas_alma, registrasi_ulang_id AS kode_hasil_seleksi from daftar_omb) AS daftar_omb
									ON daftar_omb.kode_hasil_seleksi = registrasi_ulang.id
								Join prodi
								ON prodi.id = registrasi_ulang.prodi_id
							WHERE registrasi_ulang.nim = '$nim' and registrasi_ulang.status = 'LUNAS'");
		return $query->result_array();
	}

	public function findByVerifiedRegistrasiUlang($akun_id){
		$query = $this->db->query("SELECT * 
							FROM pendaftaran
							JOIN hasil_penerimaan
								ON pendaftaran.id = hasil_penerimaan.pendaftaran_id
							JOIN registrasi_ulang
								ON registrasi_ulang.hasil_penerimaan_id = hasil_penerimaan.id
							LEFT JOIN daftar_omb
								ON daftar_omb.registrasi_ulang_id = registrasi_ulang.id
							WHERE pendaftaran.akun_id = '$akun_id' and registrasi_ulang.status = 'LUNAS' and hasil_penerimaan.status = 'DITERIMA'");
		return $query->result_array();
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
	
	public function find($id, $registrasi_ulang=false){
		$query = $this->db->where('id', $id)->limit(1)->get($this->table_name);
		if($query->num_rows()>0){
			$pendaftaran = $query->result_array()[0];
			if($registrasi_ulang){
				$pendaftaran['hasil_penerimaan'] = $this->hasil_penerimaan_model->findByPendaftaran($pendaftaran['id'], "DITERIMA");
				if(count($pendaftaran['hasil_penerimaan'])==0){
					return null;
				}
			}else{
				$pendaftaran['hasil_penerimaan'] = $this->hasil_penerimaan_model->findByPendaftaran($pendaftaran['id']);
			}
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

	public function findByAkunId($akun_id, $registrasi_ulang = false){
		$this->db->order_by('id DESC');
		$query = $this->db->where('akun_id', $akun_id)->get($this->table_name);
		$pendaftarans = $query->result_array();
		foreach($pendaftarans as $key=>&$pendaftaran){
			$pendaftaran['pembayaran'] = $this->db->where('pendaftaran_id', $pendaftaran['id'])->limit(1)->get('pembayaran')->result_array();
			if($registrasi_ulang){
				$pendaftaran['hasil_penerimaan'] = $this->hasil_penerimaan_model->findByPendaftaran($pendaftaran['id'], "DITERIMA");
				if(count($pendaftaran['hasil_penerimaan'])==0){
					unset($pendaftarans[$key]);
					continue;
				}
			}else{
				$pendaftaran['hasil_penerimaan'] = $this->hasil_penerimaan_model->findByPendaftaran($pendaftaran['id']);
			}
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
