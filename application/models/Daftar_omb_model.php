<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar_omb_model extends CI_Model {

	protected $table_name = "daftar_omb";

	

	public function get(){
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
							WHERE registrasi_ulang.status = 'LUNAS' and hasil_penerimaan.status = 'DITERIMA' and daftar_omb.ukuran_jas_alma is not null");
		return $query->result_array();
	}

	public function findByVerifiedRegistrasiUlang($akun_id){
		$query = $this->db->query("SELECT * 
		FROM registrasi_ulang
		JOIN hasil_penerimaan ON hasil_penerimaan.id = registrasi_ulang.hasil_penerimaan_id
		JOIN (SELECT id, akun_id, status_formulir FROM pendaftaran) AS pen 
			ON pen.id = (
				SELECT id FROM pendaftaran WHERE pendaftaran.id = hasil_penerimaan.pendaftaran_id 
			)
		JOIN daftar_omb ON daftar_omb.registrasi_ulang_id = registrasi_ulang.id
		WHERE pen.status_formulir = 'AKTIF'
		AND hasil_penerimaan.status = 'DITERIMA'
		AND registrasi_ulang.status = 'LUNAS'");
		return $query->result_array();
	}

	public function findByRegistrasiUlang($registrasi_ulang_id){
		$registrasi_ulang = $this->db->where('registrasi_ulang_id', $registrasi_ulang_id)->limit(1)->get($this->table_name)->result_array();
		if(count($registrasi_ulang)>0){
			return $registrasi_ulang[0];
		}else{
			return null;
		}
	}

	public function create($data){
		return $this->db->insert($this->table_name, $data);
	}

	public function save($data){
		$id = $data['id'];
		unset($data['id']);
		return $this->db->update($this->table_name, $data, array('id' => $id));
	}



	public function count(){
		$this->db->where('ukuran_jas_alma !=', null);
		return $this->db->get($this->table_name)->num_rows();
	}

	public function data_omb_filter($search, $limit, $start, $order_field, $order_ascdesc, $date_from=null, $date_to=null, $prodi=null){
		$sql = ("SELECT *, registrasi_ulang.id AS registrasi_ulang_id
		FROM pendaftaran
		JOIN (select id as hasil_penerimaan_id, pendaftaran_id, status, kode_skpm from hasil_penerimaan) as hasil_penerimaan
			ON pendaftaran.id = hasil_penerimaan.pendaftaran_id
		JOIN registrasi_ulang
			ON registrasi_ulang.hasil_penerimaan_id = hasil_penerimaan.hasil_penerimaan_id
		LEFT JOIN (SELECT ukuran_jas_alma, registrasi_ulang_id AS kode_hasil_seleksi from daftar_omb) AS daftar_omb
			ON daftar_omb.kode_hasil_seleksi = registrasi_ulang.id
		Join (select id, nama_prodi from prodi) as prodi
			ON prodi.id = registrasi_ulang.prodi_id
		WHERE lower(registrasi_ulang.nama_camaru) like lower('%$search%') and registrasi_ulang.status = 'LUNAS' and hasil_penerimaan.status = 'DITERIMA' and daftar_omb.ukuran_jas_alma is not null");


		if(!empty($date_from)){
			$sql .= " AND (pen.created_at >='$date_from' and pen.created_at <= '$date_to')";
		}

		if(!empty($prodi)){
			$sql .= " AND prodi.id = '$prodi'";
		}

		$sql .= " order by $order_field $order_ascdesc limit $limit offset $start";
		$query = $this->db->query($sql);
		$pendaftarans = $query->result_array();
		
		return $pendaftarans;
	}
	public function data_omb_count_all(){
		$sql = ("SELECT *, registrasi_ulang.id AS registrasi_ulang_id
		FROM pendaftaran
		JOIN hasil_penerimaan
			ON pendaftaran.id = hasil_penerimaan.pendaftaran_id
		JOIN registrasi_ulang
			ON registrasi_ulang.hasil_penerimaan_id = hasil_penerimaan.id
		LEFT JOIN (SELECT ukuran_jas_alma, registrasi_ulang_id AS kode_hasil_seleksi from daftar_omb) AS daftar_omb
			ON daftar_omb.kode_hasil_seleksi = registrasi_ulang.id
		Join prodi
			ON prodi.id = registrasi_ulang.prodi_id
		WHERE registrasi_ulang.status = 'LUNAS' and hasil_penerimaan.status = 'DITERIMA' and daftar_omb.ukuran_jas_alma is not null");

		$query = $this->db->query($sql);
		$pendaftarans = $query->num_rows();
		return $pendaftarans;
	}

	public function data_omb_count_filter($search, $date_from=null, $date_to=null, $prodi=null){
		$sql = ("SELECT *, registrasi_ulang.id AS registrasi_ulang_id
		FROM pendaftaran
		JOIN hasil_penerimaan
			ON pendaftaran.id = hasil_penerimaan.pendaftaran_id
		JOIN registrasi_ulang
			ON registrasi_ulang.hasil_penerimaan_id = hasil_penerimaan.id
		LEFT JOIN (SELECT ukuran_jas_alma, registrasi_ulang_id AS kode_hasil_seleksi from daftar_omb) AS daftar_omb
			ON daftar_omb.kode_hasil_seleksi = registrasi_ulang.id
		Join prodi
			ON prodi.id = registrasi_ulang.prodi_id
			WHERE lower(registrasi_ulang.nama_camaru) like lower('%$search%') and registrasi_ulang.status = 'LUNAS' and hasil_penerimaan.status = 'DITERIMA' and daftar_omb.ukuran_jas_alma is not null");


		if(!empty($prodi)){
			$sql .= " AND prodi.id = '$prodi'";
		}

		if(!empty($date_from)){
			$sql .= " AND (created_at >='$date_from' and created_at <= '$date_to')";
		}

		$query = $this->db->query($sql);
		return $query->num_rows();
	}


}

/* End of file Daftar_omb_model.php */
