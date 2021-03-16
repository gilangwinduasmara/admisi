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
		$this->load->model('detail_prestasi_model');
		$this->load->model('tahun_akademik_model');
		$this->load->model('jenjang_model');
		$this->load->model('gelombang_model');
		$this->load->model('jalur_pendaftaran_model');
		$this->load->model('kelurahan_model');
	}

	public function count(){
		return $this->db->get($this->table_name)->num_rows();
	}

	public function count_submit(){
		return $this->db->where('status_formulir', 'AKTIF')->get($this->table_name)->num_rows();
	}

	public function findByHasilPenerimaan($hasil_penerimaan_id){
		$pendaftaran = $this->db->where('id', $hasil_penerimaan_id)->get($this->table_name)->result_array();
		if(count($pendaftaran) > 0){
			$pendaftaran = $pendaftaran[0];
			$pendaftaran['jenjang'] = $this->jenjang_model->findById($pendaftaran['jenjang_id']);
			$pendaftaran['kelurahan'] = $this->kelurahan_model->find($pendaftaran['kelurahan_id']);
			$pendaftaran['tahun_akademik'] = $this->tahun_akademik_model->find($pendaftaran['tahun_akademik_id']);
			$pendaftaran['jalur_pendaftaran'] = $this->jalur_pendaftaran_model->find($pendaftaran['jalur_pendaftaran_id']);
			$pendaftaran['detail_wali'] = $this->detail_wali_model->findByPendaftaran($pendaftaran['id']);
			return $pendaftaran;
		}
		return $pendaftaran;
	}

	public function findByNim($nim){
		$query = $this->db->query("SELECT *, registrasi_ulang.id AS registrasi_ulang_id
								FROM pendaftaran
								JOIN hasil_penerimaan
									ON pendaftaran.id = hasil_penerimaan.pendaftaran_id
								JOIN registrasi_ulang
									ON registrasi_ulang.hasil_penerimaan_id = hasil_penerimaan.id
								LEFT JOIN (SELECT id as daftar_omb_id, ukuran_jas_alma, registrasi_ulang_id AS kode_hasil_seleksi from daftar_omb) AS daftar_omb
									ON daftar_omb.kode_hasil_seleksi = registrasi_ulang.id
								Join prodi
								ON prodi.id = registrasi_ulang.prodi_id
							WHERE registrasi_ulang.nim = '$nim' and registrasi_ulang.status = 'SUDAH REGISTRASI'");
		return $query->result_array();
	}

	public function findByVerifiedRegistrasiUlang($akun_id, $where=""){
		$sql = "SELECT * 
			FROM registrasi_ulang
			JOIN hasil_penerimaan ON hasil_penerimaan.id = registrasi_ulang.hasil_penerimaan_id
			JOIN (SELECT id, akun_id, status_formulir FROM pendaftaran) AS pen 
				ON pen.id = (
					SELECT id FROM pendaftaran WHERE pendaftaran.id = hasil_penerimaan.pendaftaran_id 
				)
			JOIN daftar_omb ON daftar_omb.registrasi_ulang_id = registrasi_ulang.id
			WHERE pen.status_formulir = 'AKTIF'
			AND hasil_penerimaan.status = 'DITERIMA'
			AND registrasi_ulang.status = 'SUDAH REGISTRASI'
			and pen.akun_id='$akun_id'
			and daftar_omb.ukuran_jas_alma is null";
		$sql .= $where;
		$query = $this->db->query($sql);
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
				$pendaftaran['prodi_2'] = $this->prodi_model->find($pendaftaran['prodi_2_id'] ?? null);
			}
		}
		return $pendaftarans;
	}

	public function data_camaru_filter($search, $limit, $start, $order_field, $order_ascdesc, $status_formulir=null, $date_from=null, $date_to=null, $prodi=null, $jalur_pendaftaran=null, $tahun_akademik=null){
		$sql = ("SELECT * FROM pendaftaran AS pen
		right JOIN (SELECT id AS status_penerimaan_1_id, status AS status_penerimaan_1, no_test as no_test_1 FROM hasil_penerimaan) AS hp1 ON hp1.status_penerimaan_1_id = (
			SELECT id FROM hasil_penerimaan WHERE hasil_penerimaan.pendaftaran_id = pen.id AND hasil_penerimaan.prodi_id = pen.prodi_1_id LIMIT 1
		)
		left JOIN (SELECT id AS status_penerimaan_2_id, status AS status_penerimaan_2, no_test as no_test_2 FROM hasil_penerimaan) AS hp2 ON hp2.status_penerimaan_2_id = (
			SELECT id FROM hasil_penerimaan WHERE hasil_penerimaan.pendaftaran_id = pen.id AND hasil_penerimaan.prodi_id = pen.prodi_2_id  LIMIT 1
		)
		left join (select id as jalur_pendaftaran_id, jalur_pendaftaran from jalur_pendaftaran) as jp on jp.jalur_pendaftaran_id = pen.jalur_pendaftaran_id
		left join (select id as prodi_1_id, nama_prodi as prodi_1 from prodi) as prod1 on pen.prodi_1_id = prod1.prodi_1_id
		left join (select id as prodi_2_id, nama_prodi as prodi_2 from prodi) as prod2 on pen.prodi_2_id = prod2.prodi_2_id
		left JOIN (SELECT id AS tahun_akademik_id , tahun_akademik from tahun_akademik) AS ta ON ta.tahun_akademik_id = pen.tahun_akademik_id
		WHERE (LOWER(pen.nama) like LOWER('%$search%') or hp1.no_test_1 like '%$search%' or hp2.no_test_2 like '%$search%' ) AND pen.status_formulir = 'AKTIF' ");


		if(!empty($status_formulir)){
			$sql .= " AND (status_penerimaan_1 = '$status_formulir' OR status_penerimaan_2 = '$status_formulir')";
		}

		if(!empty($tahun_akademik)){
			$sql .= " AND pen.tahun_akademik_id = '$tahun_akademik'";
		}

		if(!empty($date_from)){
			$sql .= " AND (pen.created_at >='$date_from' and pen.created_at <= '$date_to')";
		}

		if(!empty($prodi)){
			$sql .= " AND (pen.prodi_1_id = '$prodi' OR pen.prodi_2_id = '$prodi')";
		}

		if(!empty($jalur_pendaftaran)){
			$sql .= " AND pen.jalur_pendaftaran_id = '$jalur_pendaftaran'";
		}

		$sql .= " order by pen.$order_field $order_ascdesc limit $limit offset $start";
		$query = $this->db->query($sql);
		$pendaftarans = $query->result_array();
		// foreach($pendaftarans as &$pendaftaran){
		// 	$pendaftaran['prodi_1'] = $this->prodi_model->find($pendaftaran['prodi_1_id']);
		// 	if(!empty($pendaftaran['prodi_2_id'])){
		// 		$pendaftaran['prodi_2'] = $this->prodi_model->find($pendaftaran['prodi_2_id']);
		// 	}
		// }
		return $pendaftarans;
	}
	public function data_camaru_count_all(){
		$sql = ("SELECT * FROM pendaftaran AS pen
		right JOIN (SELECT id AS status_penerimaan_1_id, status AS status_penerimaan_1 FROM hasil_penerimaan) AS hp1 ON hp1.status_penerimaan_1_id = (
			SELECT id FROM hasil_penerimaan WHERE hasil_penerimaan.pendaftaran_id = pen.id AND hasil_penerimaan.prodi_id = pen.prodi_1_id LIMIT 1
		)
		left JOIN (SELECT id AS status_penerimaan_2_id, status AS status_penerimaan_2 FROM hasil_penerimaan) AS hp2 ON hp2.status_penerimaan_2_id = (
			SELECT id FROM hasil_penerimaan WHERE hasil_penerimaan.pendaftaran_id = pen.id AND hasil_penerimaan.prodi_id = pen.prodi_2_id  LIMIT 1
		)
		WHERE pen.status_formulir = 'AKTIF' ");

		$query = $this->db->query($sql);
		$pendaftarans = $query->num_rows();
		return $pendaftarans;
	}

	public function data_camaru_count_filter($search, $status_formulir=null, $date_from=null, $date_to=null, $prodi=null, $jalur_pendaftaran, $tahun_akademik=null){
		$sql = ("SELECT * FROM pendaftaran AS pen
		right JOIN (SELECT id AS status_penerimaan_1_id, status AS status_penerimaan_1, no_test as no_test_1 FROM hasil_penerimaan) AS hp1 ON hp1.status_penerimaan_1_id = (
			SELECT id FROM hasil_penerimaan WHERE hasil_penerimaan.pendaftaran_id = pen.id AND hasil_penerimaan.prodi_id = pen.prodi_1_id LIMIT 1
		)
		left JOIN (SELECT id AS status_penerimaan_2_id, status AS status_penerimaan_2, no_test as no_test_2 FROM hasil_penerimaan) AS hp2 ON hp2.status_penerimaan_2_id = (
			SELECT id FROM hasil_penerimaan WHERE hasil_penerimaan.pendaftaran_id = pen.id AND hasil_penerimaan.prodi_id = pen.prodi_2_id  LIMIT 1
		)
		left join (select id as jalur_pendaftaran_id, jalur_pendaftaran from jalur_pendaftaran) as jp on jp.jalur_pendaftaran_id = pen.jalur_pendaftaran_id
		left join (select id as prodi_1_id, nama_prodi as prodi_1 from prodi) as prod1 on pen.prodi_1_id = prod1.prodi_1_id
		left join (select id as prodi_2_id, nama_prodi as prodi_2 from prodi) as prod2 on pen.prodi_2_id = prod2.prodi_2_id
		left JOIN (SELECT id AS tahun_akademik_id , tahun_akademik from tahun_akademik) AS ta ON ta.tahun_akademik_id = pen.tahun_akademik_id
		WHERE (LOWER(pen.nama) like LOWER('%$search%') or hp1.no_test_1 like '%$search%' or hp2.no_test_2 like '%$search%' ) AND pen.status_formulir = 'AKTIF' ");

		if(!empty($status_formulir)){
			$sql .= " AND (status_penerimaan_1 = '$status_formulir' OR status_penerimaan_2 = '$status_formulir')";
		}

		if(!empty($date_from)){
			$sql .= " AND (created_at >='$date_from' and created_at <= '$date_to')";
		}

		if(!empty($prodi)){
			$sql .= " AND (pen.prodi_1_id = '$prodi' OR pen.prodi_2_id = '$prodi')";
		}

		if(!empty($jalur_pendaftaran)){
			$sql .= " AND pen.jalur_pendaftaran_id = '$jalur_pendaftaran'";
		}

		if(!empty($tahun_akademik)){
			$sql .= " AND pen.tahun_akademik_id = '$tahun_akademik'";
		}

		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	public function filter($search, $limit, $start, $order_field, $order_ascdesc, $status_pembayaran=null, $date_from=null, $date_to=null, $tahun_akademik=null){
		$sql = ("SELECT * 
		FROM pendaftaran AS pen
			LEFT JOIN (select id as pembayaran_id, jenis_pembayaran_id, pendaftaran_id, nama_camaru, upload_bukti_bayar, tgl_bayar, total_bayar, status, bank_pengirim, no_rek_pengirim, nama_rek_pengirim, tgl_transfer from pembayaran) AS pem 
			ON pem.pembayaran_id = (
				SELECT id FROM pembayaran WHERE pembayaran.pendaftaran_id = pen.id ORDER BY status = 'LUNAS' DESC, status = 'VALIDASI' DESC, status = 'BELUM LUNAS' DESC LIMIT 1
			)
			left JOIN (SELECT id AS tahun_akademik_id , tahun_akademik from tahun_akademik) AS ta ON ta.tahun_akademik_id = pen.tahun_akademik_id
			join (select id as jenis_pembayaran_id, jenis_pembayaran from jenis_pembayaran) as jenis_pembayaran on pem.jenis_pembayaran_id = jenis_pembayaran.jenis_pembayaran_id
			where status is not null and LOWER(pen.nama) like LOWER('%$search%') 
		");

		if(!empty($tahun_akademik)){
			$sql .= "AND pen.tahun_akademik_id = '$tahun_akademik'";
		}

		if(!empty($status_pembayaran)){
			$sql .= "AND status = '$status_pembayaran'";
		}

		if(!empty($date_from)){
			$sql .= " AND created_at >='$date_from' and created_at <= '$date_to'";
		}

		$sql .= " order by pen.$order_field $order_ascdesc limit $limit offset $start";
		$query = $this->db->query($sql);
		$pendaftarans = $query->result_array();
		return $pendaftarans;
	}

	public function count_filter($search, $status_pembayaran, $date_from=null, $date_to=null, $tahun_akademik=null){
		$sql = ("SELECT * 
		FROM pendaftaran AS pen
			LEFT JOIN (select id as pembayaran_id, jenis_pembayaran_id, pendaftaran_id, nama_camaru, upload_bukti_bayar, tgl_bayar, total_bayar, status, bank_pengirim, no_rek_pengirim, nama_rek_pengirim, tgl_transfer from pembayaran) AS pem 
			ON pem.pembayaran_id = (
				SELECT id FROM pembayaran WHERE pembayaran.pendaftaran_id = pen.id ORDER BY status = 'LUNAS' DESC, status = 'VALIDASI' DESC, status = 'BELUM LUNAS' DESC LIMIT 1
			)
			left JOIN (SELECT id AS tahun_akademik_id , tahun_akademik from tahun_akademik) AS ta ON ta.tahun_akademik_id = pen.tahun_akademik_id
			join (select id as jenis_pembayaran_id, jenis_pembayaran from jenis_pembayaran) as jenis_pembayaran on pem.jenis_pembayaran_id = jenis_pembayaran.jenis_pembayaran_id
			where status is not null and LOWER(pen.nama) like LOWER('%$search%') 
		");

		if(!empty($tahun_akademik)){
			$sql .= " AND pen.tahun_akademik_id = '$tahun_akademik'";
		}

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
			LEFT JOIN (select id as pembayaran_id, jenis_pembayaran_id, pendaftaran_id, nama_camaru, upload_bukti_bayar, tgl_bayar, total_bayar, status, bank_pengirim, no_rek_pengirim, nama_rek_pengirim, tgl_transfer from pembayaran) AS pem 
			ON pem.pembayaran_id = (
				SELECT id FROM pembayaran WHERE pembayaran.pendaftaran_id = pen.id ORDER BY status = 'LUNAS' DESC, status = 'VALIDASI' DESC, status = 'BELUM LUNAS' DESC LIMIT 1
			)
			left JOIN (SELECT id AS tahun_akademik_id , tahun_akademik from tahun_akademik) AS ta ON ta.tahun_akademik_id = pen.tahun_akademik_id
			join (select id as jenis_pembayaran_id, jenis_pembayaran from jenis_pembayaran) as jenis_pembayaran on pem.jenis_pembayaran_id = jenis_pembayaran.jenis_pembayaran_id
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
			$pendaftaran['jalur_pendaftaran'] = $this->jalur_pendaftaran_model->find($pendaftaran['jalur_pendaftaran_id']);
			$pendaftaran['tahun_akademik'] = $this->tahun_akademik_model->find($pendaftaran['tahun_akademik_id']);
			$pendaftaran['detail_prestasi'] = $this->detail_prestasi_model->findByPendaftaran($pendaftaran['id']);
			$pendaftaran['pembayaran'] = $this->pembayaran_model->findByPendaftaranId($pendaftaran['id']);
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
			$pendaftaran['tahun_akademik'] = $this->tahun_akademik_model->find($pendaftaran['tahun_akademik_id']);
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
		$tahun_akademik = $this->tahun_akademik_model->findByStatus('AKTIF')[0];
		$data['tahun_akademik_id'] = $tahun_akademik['id'];
		// tahun
		$id = substr(explode("/", $tahun_akademik['tahun_akademik'])[0], -2);
		// reg/pin (1 / 0)
		$id .= "1";
		// gelombang
		$gelombang = $this->gelombang_model->getCurrentActiveGelombang();
		if(!empty($gelombang)){
			// $id.= explode(" ", $gelombang['nama_gelombang'])[1];
		}
		// no urut
		$count = $this->db->where('tahun_akademik_id', $data['tahun_akademik_id'])->get($this->table_name)->num_rows();
		$count+=1;
		$id .= str_pad(strval($count), 6, '0', STR_PAD_LEFT);
		$data['id'] = $id;
		$this->db->insert($this->table_name, $data);
		return $id;
	}

	public function save($data){
		$id = $data['id'];
		unset($data['id']);
		return $this->db->update($this->table_name, $data, array('id' => $id));
	}

}
