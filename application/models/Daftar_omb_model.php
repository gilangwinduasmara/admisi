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
							WHERE pendaftaran.akun_id = '$akun_id' and registrasi_ulang.status = 'LUNAS' and hasil_penerimaan.status = 'DITERIMA'");
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

}

/* End of file Daftar_omb_model.php */
