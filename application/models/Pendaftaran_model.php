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
	
	public function get($hasil_pendaftaran = false){
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

	public function filter($search, $limit, $start, $order_field, $order_ascdesc, $status_pembayaran=null, $date_from=null, $date_to=null){
		// $this->db->like('nama', $search); // Untuk menambahkan query where LIKE
		// // $this->db->or_like('nama', $search); // Untuk menambahkan query where OR LIKE
		// $this->db->order_by($order_field, $order_ascdesc); // Untuk menambahkan query ORDER BY
		$this->db->limit($limit, $start); // Untuk menambahkan query LIMIT
		$sql = ("SELECT * 
		FROM pendaftaran AS pen
			LEFT JOIN pembayaran AS pem 
			ON pem.id = (
				SELECT id FROM pembayaran WHERE pembayaran.pendaftaran_id = pen.id ORDER BY status = 'LUNAS' DESC, status = 'VALIDASI' DESC, status = 'BELUM LUNAS' DESC LIMIT 1
			)
			where status is not null and nama like '%$search'
			
		");


		if(!empty($status_pembayaran)){
			$sql .= "AND status = '$status_pembayaran'";
		}

		if(!empty($date_from)){
			$sql .= " AND created_at >='$date_from' and created_at <= '$date_to'";
		}

		$sql .= " order by pen.$order_field $order_ascdesc limit $limit offset $start";
		$query = $this->db->query($sql);
		$pendaftarans = $query->result_array();
		// foreach($pendaftarans as $key=>&$pendaftaran){
		// 	$validasi = $this->pembayaran_model->findByPendaftaranId($pendaftaran['id'], "VALIDASI");
		// 	$lunas = $this->pembayaran_model->findByPendaftaranId($pendaftaran['id'], "LUNAS");
		// 	$pendaftaran['status_pembayaran'] = 'Belum Bayar';
		// 	if(count($validasi) > 0){
		// 		$pendaftaran['status_pembayaran'] = 'Menunggu Validasi';
		// 		$pendaftaran['upload_bukti_bayar'] = $validasi[0]['upload_bukti_bayar'];
		// 	}
		// 	if(count($lunas) > 0){
		// 		$pendaftaran['status_pembayaran'] = 'Sudah Bayar';
		// 		$pendaftaran['upload_bukti_bayar'] = $lunas[0]['upload_bukti_bayar'];
		// 	}

		// }
		return $pendaftarans;
	}

	public function count_filter($search, $status_pembayaran, $date_from=null, $date_to=null){
		$sql = ("SELECT * 
		FROM pendaftaran AS pen
			LEFT JOIN pembayaran AS pem 
			ON pem.id = (
				SELECT id FROM pembayaran WHERE pembayaran.pendaftaran_id = pen.id ORDER BY status = 'LUNAS' DESC, status = 'VALIDASI' DESC, status = 'BELUM LUNAS' DESC LIMIT 1
			)
			where status is not null and nama like '%$search'
		");

		if(!empty($date_from)){
			$sql .= " AND created_at >='$date_from' and created_at <= '$date_to'";
		}

		if(!empty($status_pembayaran)){
			$sql .= " AND status = '$status_pembayaran'";
		}
		$query = $this->db->query($sql);
		return $query->num_rows();
	}



	public function count_all(){
		$sql = ("SELECT * 
		FROM pendaftaran AS pen
			LEFT JOIN pembayaran AS pem 
			ON pem.id = (
				SELECT id FROM pembayaran WHERE pembayaran.pendaftaran_id = pen.id ORDER BY status = 'LUNAS' DESC, status = 'VALIDASI' DESC, status = 'BELUM LUNAS' DESC LIMIT 1
			)
		");

		$query = $this->db->query($sql);
		return $query->num_rows();
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
