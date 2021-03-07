<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Registrasi_ulang_model extends CI_Model {

	private $table_name = "registrasi_ulang";

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('prodi_model');
		$this->load->model('daftar_omb_model');
		$this->load->model('hasil_penerimaan_model');
		$this->load->model('pendaftaran_model');
	}

	public function findByNim($nim){
		$query = $this->db->query("SELECT * 
							FROM pendaftaran
							JOIN hasil_penerimaan
								ON pendaftaran.id = hasil_penerimaan.pendaftaran_id
							JOIN registrasi_ulang
								ON registrasi_ulang.hasil_penerimaan_id = hasil_penerimaan.id
							JOIN daftar_omb
								ON daftar_omb.registrasi_ulang_id = registrasi_ulang.id
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
							JOIN daftar_omb
								ON daftar_omb.registrasi_ulang_id = registrasi_ulang.id
							WHERE pendaftaran.akun_id = '$akun_id' and registrasi_ulang.status = 'LUNAS' and hasil_penerimaan.status = 'DITERIMA'");
		return $query->result_array();
	}
	
	public function get($status = false){
		if(!empty($status)){
			$this->db->where('status', $status);
		}
		$registrasi_ulang = $this->db->where('hasil_penerimaan_id is not null')->get($this->table_name)->result_array();
		foreach($registrasi_ulang as &$registrasi){
			$registrasi['hasil_penerimaan'] = $this->hasil_penerimaan_model->find($registrasi['hasil_penerimaan_id']);
			if(!empty($registrasi['hasil_penerimaan'])){
				$formulir = $this->pendaftaran_model->findByHasilPenerimaan($registrasi['hasil_penerimaan']['pendaftaran_id']);
				$registrasi['hasil_penerimaan']['pendaftaran'] = $formulir;
			}
			$registrasi['prodi'] = $this->prodi_model->find($registrasi['prodi_id']);
		}
		return $registrasi_ulang;
	}

	public function data_registrasi_ulang_filter($search, $limit, $start, $order_field, $order_ascdesc, $status=null, $prodi=null, $date_from=null, $date_to=null, $tahun_akademik=null){
		$sql = "SELECT *, registrasi_ulang.status as status_registrasi_ulang, registrasi_ulang.id as registrasi_ulang_id
		FROM registrasi_ulang
		JOIN (select id as hasil_penerimaan_id, prodi_id, kode_skpm, pendaftaran_id from hasil_penerimaan) as hp
			on registrasi_ulang.hasil_penerimaan_id = hp.hasil_penerimaan_id
		JOIN (SELECT id as pendaftaran_id, akun_id, status_formulir, created_at, tahun_akademik, pendaftaran.tahun_akademik_id as tahun_akademik_id FROM pendaftaran left JOIN (select id as tahun_akademik_id, tahun_akademik from tahun_akademik) as ta ON pendaftaran.tahun_akademik_id = ta.tahun_akademik_id) AS pen 
			ON pen.pendaftaran_id = (
				SELECT id FROM pendaftaran WHERE pendaftaran.id = hp.pendaftaran_id 
			)
		JOIN (select id as prodi_id, nama_prodi from prodi) as prodi
			on hp.prodi_id = prodi.prodi_id
		where lower(registrasi_ulang.nama_camaru) like lower('%$search%')";
		if(!empty($status)){
			$sql .= " and registrasi_ulang.status = '$status' ";
		}

		if(!empty($tahun_akademik)){
			$sql .= " and tahun_akademik_id = '$tahun_akademik' ";
		}

		if(!empty($prodi)){
			$sql .= " and hp.prodi_id = '$prodi' ";
		}
		if(!empty($date_from)){
			$sql .= " AND (pen.created_at >='$date_from' and pen.created_at <= '$date_to') ";
		}
		$sql .= " order by $order_field $order_ascdesc limit $limit offset $start";
		return $this->db->query($sql)->result_array();
	}

	public function data_registrasi_ulang_count_all(){
		$sql = "SELECT *, registrasi_ulang.status as status_registrasi_ulang, registrasi_ulang.id as registrasi_ulang_id
		FROM registrasi_ulang
		JOIN hasil_penerimaan
			on registrasi_ulang.hasil_penerimaan_id = hasil_penerimaan.id
		JOIN (SELECT id, akun_id, status_formulir FROM pendaftaran) AS pen 
			ON pen.id = (
				SELECT id FROM pendaftaran WHERE pendaftaran.id = hasil_penerimaan.pendaftaran_id 
			)
		JOIN prodi
			on hasil_penerimaan.prodi_id = prodi.id";
		
		return $this->db->query($sql)->num_rows();
	}


	public function data_registrasi_ulang_filter_count($search, $status=null, $prodi=null, $date_from=null, $date_to=null, $tahun_akademik=null){
		$sql = "SELECT *, registrasi_ulang.status as status_registrasi_ulang, registrasi_ulang.id as registrasi_ulang_id
		FROM registrasi_ulang
		JOIN hasil_penerimaan
			on registrasi_ulang.hasil_penerimaan_id = hasil_penerimaan.id
		JOIN (SELECT id as pendaftaran_id, akun_id, status_formulir, created_at, tahun_akademik, pendaftaran.tahun_akademik_id as tahun_akademik_id FROM pendaftaran left JOIN (select id as tahun_akademik_id, tahun_akademik from tahun_akademik) as ta ON pendaftaran.tahun_akademik_id = ta.tahun_akademik_id) AS pen 
			ON pen.pendaftaran_id = (
				SELECT id FROM pendaftaran WHERE pendaftaran.id = hasil_penerimaan.pendaftaran_id 
			)
		JOIN prodi
			on hasil_penerimaan.prodi_id = prodi.id
		where lower(registrasi_ulang.nama_camaru) like lower('%$search%')";
		if(!empty($status)){
			$sql .= " and registrasi_ulang.status = '$status' ";
		}
		if(!empty($prodi)){
			$sql .= " and hasil_penerimaan.prodi_id = '$prodi' ";
		}
		if(!empty($tahun_akademik)){
			$sql .= " and tahun_akademik_id = '$tahun_akademik' ";
		}
		return $this->db->query($sql)->num_rows();
	}

	public function findByHasilPenerimaan($pendaftaran_id){
		$this->db->where('hasil_penerimaan_id', $pendaftaran_id);
		$registrasi_ulang = $this->db->get($this->table_name)->result_array();
		if(count($registrasi_ulang) > 0){
			$registrasi_ulang[0]['prodi'] = $this->prodi_model->find($registrasi_ulang[0]['prodi_id']);
			$registrasi_ulang[0]['daftar_omb'] = $this->daftar_omb_model->findByRegistrasiUlang($registrasi_ulang[0]['id']);
			return $registrasi_ulang[0];
		}
		return null;
	}
	
	public function create($data){
		$this->db->insert($this->table_name, $data);
		return $this->db->where('id', $this->db->insert_id())->get($this->table_name)->result_array()[0];
	}

	public function save($data){
		$id = $data['id'];
		print_r($id);
		unset($data['id']);
		$this->db->update($this->table_name, $data, array('id' => $id));
		return $this->db->where('id', $id)->get($this->table_name)->result_array()[0];
	}

}

/* End of file Registrasi_ulang_model.php */
