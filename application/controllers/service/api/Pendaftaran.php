<?php
defined('BASEPATH') OR exit('No direct script access allowed');


use chriskacerguis\RestServer\RestController;

class Pendaftaran extends RestController {
	
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pendaftaran_model');
	}
	

	public function index_get()
	{
		$res = null;
		$dt = $this->get('dt');
		if($this->input->get('id'))	{
			$res = $this->pendaftaran_model->find($this->input->get('id'), $this->input->get('status'));
			$this->response($res, 200);
		}
		if($this->input->get('nim')){
			$res = $this->pendaftaran_model->findByNim($this->input->get('nim'));
			$this->response($res, 200);
		}
		
		if($dt == 'data_pendaftar'){
			$search = $_GET['search']['value']; // Ambil data yang di ketik user pada textbox pencarian
			$limit = $_GET['length']; // Ambil data limit per page
			$start = $_GET['start']; // Ambil data start
			$order_index = $_GET['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
			$order_field = $_GET['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
			$order_ascdesc = $_GET['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"
			$status_pembayaran = $_GET['columns'][3]['search']['value'] ?? null;
			$searchByTahunAkademik = $_GET['columns'][1]['search']['value'] ?? null;
	
			$searchByFromDate = $_GET['searchByFromDate'] ?? null;
			$searchByToDate = $_GET['searchByToDate'] ?? null;
	
			$count = $this->pendaftaran_model->count_all();
			$data = $this->pendaftaran_model->filter($search, $limit, $start, $order_field, $order_ascdesc, $status_pembayaran, $searchByFromDate, $searchByToDate, $searchByTahunAkademik);
			$count_filter = $this->pendaftaran_model->count_filter($search, $status_pembayaran, $searchByFromDate, $searchByToDate, $searchByTahunAkademik);
			
			$response = array(
				'draw'=>$_GET['draw'], // Ini dari datatablenya
				'recordsTotal'=>$count,
				'recordsFiltered'=>$count_filter,
				'data'=>$data
			);
	
			$this->response($response, 200);
		}
		if($dt == 'data_camaru'){
			$search = $_GET['search']['value']; // Ambil data yang di ketik user pada textbox pencarian
			$limit = $_GET['length']; // Ambil data limit per page
			$start = $_GET['start']; // Ambil data start
			$order_index = $_GET['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
			$order_field = $_GET['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
			$order_ascdesc = $_GET['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"
			$searchByFromDate = $_GET['searchByStatusFormulir'] ?? null;
	
			$searchByFromDate = $_GET['searchByFromDate'] ?? null;
			$searchByToDate = $_GET['searchByToDate'] ?? null;
	
			$count = $this->pendaftaran_model->data_camaru_count_all()();
			$data = $this->pendaftaran_model->filter($search, $limit, $start, $order_field, $order_ascdesc, $status_pembayaran, $searchByFromDate, $searchByToDate);
			$count_filter = $this->pendaftaran_model->count_filter($search, $status_pembayaran, $searchByFromDate, $searchByToDate);
			
			$response = array(
				'draw'=>$_GET['draw'], // Ini dari datatablenya
				'recordsTotal'=>$count,
				'recordsFiltered'=>$count_filter,
				'data'=>$data
			);
	
			$this->response($response, 200);
		}
		print_r($this->get("dt"));
	}	

	public function dt_data_camaru_get(){
		$search = $_GET['search']['value']; // Ambil data yang di ketik user pada textbox pencarian
		$limit = $_GET['length']; // Ambil data limit per page
		$start = $_GET['start']; // Ambil data start
		$order_index = $_GET['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
		$order_field = $_GET['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
		$order_ascdesc = $_GET['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"
		$searchByStatusFormulir = $_GET['searchByStatusFormulir'] ?? null;

		$searchByFromDate = $_GET['searchByFromDate'] ?? null;
		$searchByToDate = $_GET['searchByToDate'] ?? null;
		$searchByProdi = $_GET['searchByProdi'] ?? null;
		$searchByJalurPendaftaran = $_GET['searchByJalurPendaftaran'] ?? null;
		$searchByTahunAkademik = $_GET['columns'][1]['search']['value'] ?? null;

		$count = $this->pendaftaran_model->data_camaru_count_all();
		$data = $this->pendaftaran_model->data_camaru_filter($search, $limit, $start, $order_field, $order_ascdesc, $searchByStatusFormulir, $searchByFromDate, $searchByToDate, $searchByProdi, $searchByJalurPendaftaran, $searchByTahunAkademik);
		$count_filter = $this->pendaftaran_model->data_camaru_count_filter($search, $searchByStatusFormulir, $searchByFromDate, $searchByToDate, $searchByProdi, $searchByJalurPendaftaran, $searchByTahunAkademik);
		
		$response = array(
			'draw'=>$_GET['draw'], // Ini dari datatablenya
			'recordsTotal'=>$count,
			'recordsFiltered'=>$count_filter,
			'data'=>$data
		);

		$this->response($response, 200);
	}
	public function dt_data_pendaftar_get(){
			$search = $_GET['search']['value']; // Ambil data yang di ketik user pada textbox pencarian
			$limit = $_GET['length']; // Ambil data limit per page
			$start = $_GET['start']; // Ambil data start
			$order_index = $_GET['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
			$order_field = $_GET['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
			$order_ascdesc = $_GET['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"
			$status_pembayaran = $_GET['columns'][3]['search']['value'] ?? null;

			$searchByFromDate = $_GET['searchByFromDate'] ?? null;
			$searchByToDate = $_GET['searchByToDate'] ?? null;
			$searchByTahunAkademik = $_GET['columns'][1]['search']['value'] ?? null;

			$count = $this->pendaftaran_model->count_all();
			$data = $this->pendaftaran_model->filter($search, $limit, $start, $order_field, $order_ascdesc, $status_pembayaran, $searchByFromDate, $searchByToDate, $searchByTahunAkademik, $searchByTahunAkademik);
			$count_filter = $this->pendaftaran_model->count_filter($search, $status_pembayaran, $searchByFromDate, $searchByToDate, $searchByTahunAkademik, $searchByTahunAkademik);
			
			$response = array(
				'draw'=>$_GET['draw'], // Ini dari datatablenya
				'recordsTotal'=>$count,
				'recordsFiltered'=>$count_filter,
				'data'=>$data
			);

			$this->response($response, 200);
	}

	public function omb_get(){
		$res = null;
		if($this->input->get('nim')){
			$res = $this->daftar_omb_model->findByNim($this->input->get('nim'));
		}
		$this->response($res, 200);
	}

	public function generate_skr_get(){
		if(empty($this->input->get('hasil_penerimaan_id'))){
			redirect('/');
		}
		$hasil_penerimaan = $this->hasil_penerimaan_model->find($this->input->get('hasil_penerimaan_id'));
		$pendaftaran = $this->pendaftaran_model->find($hasil_penerimaan['pendaftaran_id']);
		if($this->session->userdata('id') != $pendaftaran['akun_id']){
			// redirect('/');
			echo "here";
		}

		if($hasil_penerimaan['status'] != 'DITERIMA'){
			// redirect('/');
			echo "there";
		}
		// return;
		
		$html = '
		<div style="text-align: center">
			<p>
			</p>
			<span style="font-weight: normal; font-size: 13px">SURAT KEPUTUSAN REKTOR <br/>UNIVERSITAS KRISTEN INDONESIA TORAJA</span> <br/>
			<span style="font-size: 9px">Nomor: '.$hasil_penerimaan["kode_skpm"].' <br/> Tentang</span><br/>
			<span style="font-weight: boldest; font-size: 13px">Penerimaan Mahasiswa Baru Univeritas Kristen Indonesia Toraja <br> Tahun Akademik '.$pendaftaran["tahun_akademik"]["tahun_akademik"].'</span>	<br/>
			<span style="font-weight: normal; margin-top: 4px; font-size: 13px">REKTOR UNIVERSITAS KRISTEN INDONESIA TORAJA</span><br/>
		</div>
		<div style="font-size: 8px">
			<div><b>Menimbang</b></div>
			<ol type="a">
				<li>Bahwa untuk menjadi mahasiswa Universitas Kristen Indonesia Toraja tahun akademik xxx wajib mengikutiproses seleksi sesuai dengan ketentuan yang berlaku;</li>
				<li>Bahwa calon mahasiswa tahun akademik xxx yang telah lulus seleksi, perlu ditetapkan menjadi mahasiswa melalui Keputusan Rektor;</li>
			</ol>
			<p><b>Mengingat</b></p>
			<ol>
				<li>Undang-undang Nomor 20 Tahun 2003 tentang Sistem Pendidikan Nasional;</li>
				<li>Peraturan Pemerintah No. 60 Tahun 1999 tentang Pendidikan Tinggi;</li>
			</ol>
			<p><b>Memperhatikan:</b><br>Hasil seleksi Panitia Admisi Mahasiswa Baru tahun akademik xxx</p>
			<div style="text-align: center; font-size: 8px">MEMUTUSKAN</div>
			<p><b>Menetapkan</b></p>
		</div>
		
		';

		$html2 = 
		'<table style="font-size: 8px">
			<tbody>
				<tr>
					<td>Pertama </td>
					<td style="width: 8px"></td>
					<td style="width: 200px">Calon Mahasiswa Berikut:</td>
					<td style="width: 100px"></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td style="width: 8px"></td>
					<td style="width: 200px">Nama</td>
					<td style="width: 100px">: '.$pendaftaran["nama"].'</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td style="width: 8px"></td>
					<td style="width: 200px">No. Pendaftaran</td>
					<td style="width: 100px">: '.$pendaftaran["id"].'</td>
					<td></td>
				</tr>
				<tr >
					<td></td>
					<td style="width: 8px"></td>
					<td colspan="3">Dinyatakan lulus seleksi melalui jalur '.$pendaftaran['jalur_pendaftaran']['jalur_pendaftaran'].', pada Fakultas '.$hasil_penerimaan["prodi"]['fakultas']['nama_fakultas'].' Program Studi '.$hasil_penerimaan["prodi"]['nama_prodi'].' tahun akademik '.$pendaftaran["tahun_akademik"]["tahun_akademik"].'</td>	
				</tr>
				<tr><td></td><td></td><td></td></tr>
				<tr>
					<td>Kedua </td>
					<td style="width: 8px">:</td>
					<td colspan="3">Bagi yang telah dinyatakan lulus seleksi, wajib melakukan Registrasi Ulang dengan mengumpulkan persyaratan seperti terlampir dan membayar kewajiban keuangan yang diperinci di bawah ini sebelum tanggal xxx</td>
				</tr>
			</tbody>
		</table>
		
		';
		$html3 = '
		<div style="background: blue">
			<table style="font-size: 8px">
				<thead></thead>
				<tbody>
					<tr>
						<td style="width: 100px">1.</td>
						<td style="width: 300px">Uang SPP</td>
						<td>Rp. xxx</td>
					</tr>
					<tr>
						<td style="width: 100px">2.</td>
						<td style="width: 300px">Uang Kuliah Standar</td>
						<td>Rp. xxx</td>
					</tr>
					<tr>
						<td style="width: 100px">3.</td>
						<td style="width: 300px">Uang Kuliah 20 SKS</td>
						<td>Rp. xxx</td>
					</tr>
					<tr>
						<td style="width: 100px">4.</td>
						<td style="width: 300px">Uang Senat/Semester</td>
						<td>Rp. xxx</td>
					</tr>
					<tr>
						<td style="width: 100px">5.</td>
						<td style="width: 300px">Uang Ujian/Semester</td>
						<td>Rp. xxx</td>
					</tr>
					<tr>
						<td style="width: 100px">6.</td>
						<td style="width: 300px">Uang Perpustakaan/Semester</td>
						<td>Rp. xxx</td>
					</tr>
					<tr>
						<td style="width: 100px">7.</td>
						<td style="width: 300px">Uang Jas Almamater</td>
						<td>Rp. xxx</td>
					</tr>
					<tr>
						<td style="width: 100px">8.</td>
						<td style="width: 300px">Uang Penyambutan MABA</td>
						<td>Rp. xxx</td>
					</tr>
					<tr>
						<td style="width: 100px">9.</td>
						<td style="width: 300px">Kartu Tanda Mahasiswa (KTM)</td>
						<td>Rp. xxx</td>
					</tr>
					<tr>
						<td style="width: 100px"></td>
						<td style="width: 300px"><b>Total</b></td>
						<td>Rp. xxx</td>
					</tr>
					<tr>
						<td colspan="2">Minimal pembayaran Registrasi Ulang (Pembayaran I)</td>
						<td>Rp. xxx</td>
					</tr>
					<tr>
						<td></td>
						<td style="text-align: right; padding-right: 52px"><b>(nominal rupiah)</b></td>
					</tr>
				</tbody>
			</table>
		</div>';
		$html4 =
		'<table style="font-size: 8px; width: 100%">
			<thead></thead>
			<tbody>
				<tr>
					<td style="width: 72px">Ketiga</td>
					<td style="width: 8px"></td>
					<td style="width: 500px">Calon mahasiswa yang telah melakukan registrasi ulang seperti diktum kedua, dinyatakan DITERIMA sebagai mahasiswa UKI Toraja dengan mendapatkan Nomor Induk Mahasiswa.</td>
				</tr>
				<tr><td></td><td></td><td></td></tr>
				<tr>
					<td style="width: 72px">Keempat</td>
					<td style="width: 8px"></td>
					<td style="width: 500px">Lampiran Keputusan merupakan bagian yang tidak terpisahkan dari Keputusan ini.</td>
				</tr>
				<tr><td></td><td></td><td></td></tr>
				<tr>
					<td style="width: 72px">Kelima</td>
					<td style="width: 8px"></td>
					<td style="width: 500px">Keputusan ini beraku sejak tanggal ditetapkan, dengan ketentuan apabila di kemudian hari terdapat kekeliruan dalam penetapan ini akan diadakan perbaikan sebagaimana mestinya.</td>
				</tr>
			</tbody>
		</table>
		<div style="display: flex; flex-direction: column; justify-content: end; text-align: right; width: 100%; margin-top: 32px; font-size: 8px">
			<div>
				Ditetapkan di Toraja,
			</div>
			<div>
				'.formatDate(explode(" ", strval(unix_to_human(time())))[0]).',
			</div>
			<div>
				Rektor,
			</div>
			<div style="padding-top: 128px">
				Prof Gilang
			</div>
		</div>';


		// echo $html.$html2.$html3.$html4;
		// return;

		$this->load->library('Pdf');
		
		
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		$pdf->SetCreator('ADMISI');
		$pdf->SetAuthor('ADMISI');
		$pdf->SetTitle('Surat Keputusan Rektor');
		$pdf->SetSubject('Surat Keputusan Rektor');
		// $pdf->SetKeywords('TCPDF, PDF, example, test, guide');


		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			require_once(dirname(__FILE__).'/lang/eng.php');
			$pdf->setLanguageArray($l);
		}


		$pdf->setFontSubsetting(true);

		$pdf->AddPage();

		$pdf->setPrintFooter(false);
		$footer = 
		'
			<div style="color: grey; text-align: center; margin-top: 32px; font-size: 12px">
				<b>UNIVERSITAS KRISTEN INDONESIA</b> <br/>
				<span style="font-size: 10px">Jalan Nusantaran No 12 <br/>
				Telp : (0423)22468 / (0423)22887, Fax : (0423)22073 <br/>
				Kode Pos: 91811 Makale, Tana Toraja Sulawesi Selatan, Indonesia
				</span>
			</div>
		';

		$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
		$pdf->writeHTMLCell(0, 0, '', '', $html2, 0, 1, 0, true, '', true);
		$pdf->writeHTMLCell(0, 0, '', '', $html3, 0, 1, 0, true, '', true);
		$pdf->writeHTMLCell(0, 0, '', '', $html4, 0, 1, 0, true, '', true);
		$pdf->writeHTMLCell(0, 0, '', '', $footer, 0, 1, 0, true, '', true);


		$pdf->Output('surat_keputusan_rektor_'.$hasil_penerimaan['kode_skpm'].'_.pdf', 'I');
	}

}

/* End of file Penerimaan.php */
