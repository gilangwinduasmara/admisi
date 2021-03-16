<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Pages extends CI_Controller{

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pengumuman_model');
		$this->load->model('akun_model');
		$this->load->model('gelombang_model');
		$this->load->model('pendaftaran_model');
		$this->load->model('hasil_penerimaan_model');
	}
	

	public function landing(){
		$pengumuman = $this->pengumuman_model->get();
		$data = array(
			'page' => 'pages/index.php',
			'pengumuman' => $pengumuman,
			'fluid' => TRUE
		);
		$this->load->view('default', $data);
	}

	public function register()
	{
		$this->load->library('session');
		$data = array(
			'page' => 'pages/register.php'
		);
		$this->load->view('default', $data);
	}
	
	public function forgot_password()
	{
		$this->load->model('reset_password_model');
		$token = $this->input->get('token');
		if(!empty($token)){
			$stored_token = $this->reset_password_model->findByToken($token);
			if(empty($stored_token)){
				redirect('/forgot_password?invalid=true');
			}
		}
		$data = array(
			'page' => 'pages/forgot_password.php',
			'link_sent' => !empty($this->input->get('link_sent'))
		);
		$this->load->view('default', $data);
	}

	public function request_verification(){
		$akun = $this->akun_model->find($this->session->userdata('id'));
		if(!empty($akun->email_verified_at)){
			redirect('login');
		}
		$verificationCode = $this->akun_model->generateVerificationEmail($akun->id);
		$config = [
			'mailtype'  => 'html',
			'charset'   => 'utf-8',
			'protocol'  => 'smtp',
			'smtp_host' => 'mail.promager.com',
			'smtp_user' => 'admisi@promager.com',  // Email gmail
			'smtp_pass'   => '@dm1s!!@#',  // Password gmail
			'smtp_crypto' => 'ssl',
			'smtp_port'   => 465,
			'crlf'    => "\r\n",
			'newline' => "\r\n"
		];
		$this->load->library('email', $config);
		$this->email->from('admisi@promager.com', 'ADMISI');
		$this->email->to($akun->email);
		$this->email->subject('Aktivasi Akun');
		$link = base_url('/verify?code='.$verificationCode);
			$this->email->message('
				<html>
					<head>Aktifasi Akun</head>
					<body>
						Untuk mengaktifkan akun, klik tautan di bawah ini <br> <a href="'.$link.'">'.$link.'</a>
					</body>
				</html>
				');
			$email_status = $this->email->send() ? ' yay': ' nope';
		$this->session->set_flashdata('success', ['Link aktivasi telah dikirim ke email anda ']);
		redirect('verify');
	}

	public function verify()
	{
		$akun_id = $this->session->userdata('id');
	
		$code = $this->input->get('code');
		if(empty($code)){
			$data = array(
				'page' => 'pages/verify.php'
			);
		}else{
			$valid = $this->akun_model->verify($code);
			if(empty($akun_id)){
				$this->session->set_flashdata('success', ['Validasi berhasil, silahkan login kembali']);
				redirect('login');
			}
			if($valid){
				$this->session->unset_userdata('not_validated');
			}
			$data = array(
				'page' => 'pages/verify_with_code.php',
				'valid' => $valid
			);
		}
		
		$this->load->view('default', $data);
	}

	public function login()
	{
		$data = array(
			'page' => 'pages/login.php'
		);
		$this->load->view('default', $data);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/');
	}

	public function pengumuman(){
		if(empty($this->input->get('id'))){
			$pengumuman = $this->pengumuman_model->get();
			$data = array(
				'page' => 'pages/pengumuman.php',
				'pengumuman' => $pengumuman
			);
		}else{
			$pengumuman = $this->pengumuman_model->find($this->input->get('id'));
			if(empty($pengumuman)){
				redirect('/pengumuman');
			}
			$data = array(
				'page' => 'pages/pengumuman_detail.php',
				'pengumuman' => $pengumuman,
				"subheader" => [
					[
						'text' => 'Pengumuman',
						'href' => '/pengumuman'
					],
					"Detail Pengumuman"
				],
			);
		}
		$this->load->view('default', $data);
	}

	public function scrap_sekolah(){
		$data = array(
			'page' => 'pages/scrap-sekolah.php',
		);
		$this->load->view('default', $data);
	}

	public function tes(){

		$html = '
		<div style="text-align: center">
			<p>
			</p>
			<span style="font-weight: normal; font-size: 13px">SURAT KEPUTUSAN REKTOR <br/>UNIVERSITAS KRISTEN INDONESIA TORAJA</span> <br/>
			<span style="font-size: 9px">Nomor: xxx <br/> Tentang</span><br/>
			<span style="font-weight: boldest; font-size: 13px">Penerimaan Mahasiswa Baru Univeritas Kristen Indonesia Toraja <br> Tahun Akademik xx</span>	<br/>
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
					<td style="width: 100px">: xxx</td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td style="width: 8px"></td>
					<td style="width: 200px">No. Pendaftaran</td>
					<td style="width: 100px">: xxx</td>
					<td></td>
				</tr>
				<tr >
					<td></td>
					<td style="width: 8px"></td>
					<td colspan="3">Dinyatakan lulus seleksi melalui jalur xxx, pada Fakultas XXX Program Studi XXX tahun akademik xxx</td>	
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
				xxx,
			</div>
			<div>
				Rektor,
			</div>
			<div style="padding-top: 128px">
				Prof xxx
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


		$pdf->Output('example_001.pdf', 'I');
	}

}
