<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Hasil_penerimaan_model extends CI_Model {

	private $table_name = 'hasil_penerimaan';

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('prodi_model');
		$this->load->model('registrasi_ulang_model');
		$this->load->model('pendaftaran_model');
		$this->load->model('tahun_akademik_model');
	}

	public function findByRegistrasiUlang($registrasi_ulang_id){
		// $hasil_penerimaan = $this->db->where('id', $registrasi_ulang_id)->get($this->table_name)->result_array();

		// if(count($hasil_penerimaan) > 0){
		// 	$hasil_penerimaan = $hasil_penerimaan[0];
		// 	$hasil_penerimaan['formulir'] = $this->pendaftaran_model->findByHasilPenerimaan($hasil_penerimaan['id']);
		// 	return $hasil_penerimaan;
		// }

		// return null;
		
	}

	public function countByProdi(){
		$sql = '
		select prodi.id as prodi_id, nama_prodi, count(hasil_penerimaan.prodi_id) 
		from hasil_penerimaan 
		right join prodi on prodi.id = prodi_id 
		group by prodi.id, nama_prodi 
		order by prodi_id';
		return $this->db->query($sql)->result_array();
	}

	public function findByPendaftaran($pendaftaran_id, $status=null){
		if(!empty($status)){
			$this->db->where('status', $status);
		}
		$hasil_penerimaan = $this->db->where('pendaftaran_id', $pendaftaran_id)->limit(2)->get($this->table_name)->result_array();
		foreach($hasil_penerimaan as &$penerimaan){
			$penerimaan['prodi'] = $this->prodi_model->find($penerimaan['prodi_id']);
			$penerimaan['registrasi_ulang'] = $this->registrasi_ulang_model->findByHasilPenerimaan($penerimaan['id']);
		}
		return $hasil_penerimaan;
	}

	public function find($id){
		$hasil_penerimaan = $this->db->where('id', $id)->limit(1)->get($this->table_name)->result_array();
		if(count($hasil_penerimaan) > 0){
			$hasil_penerimaan[0]['prodi'] = $this->prodi_model->find($hasil_penerimaan[0]['prodi_id']);
			return $hasil_penerimaan[0];
		}
		return null;
	}

	public function findBySkpm($kode_skpm){
		$hasil_penerimaan = $this->db->where('kode_skpm', $kode_skpm)->limit(1)->get($this->table_name)->result_array();
		if(count($hasil_penerimaan) > 0){
			return $hasil_penerimaan[0];
		}
		return null;
	}

	public function create($data){
		$pendaftaran = $this->pendaftaran_model->find($data['pendaftaran_id']);
		$tahun_akademik = $this->tahun_akademik_model->find($pendaftaran['tahun_akademik_id']);
		
		// tahun
		$no_test = substr(explode("/", $tahun_akademik['tahun_akademik'])[0], -2);
		// gelombang
		$gelombang = $this->gelombang_model->getCurrentActiveGelombang();
		if(!empty($gelombang)){
			// $no_test.= explode(" ", $gelombang['nama_gelombang'])[1];
		}
		// no urut
		$count_prodi = $this->db->where('prodi_id', $data['prodi_id'])->get($this->table_name)->num_rows();
		$count_prodi+=1;
		$no_test .=  str_pad(strval($count_prodi), 4, "0", STR_PAD_LEFT);
		$no_test .= "-" . $data['prodi_id'];
		$data['no_test'] = $no_test;
		$this->db->insert($this->table_name, $data);
		return $no_test;
	}

	public function save($data){
		$id = $data['id'];
		unset($data['id']);
		$this->db->update($this->table_name, $data, array('id' => $id));
	}

}
