<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-8">
			<div class="card card-custom">
				<div class="card-body">
					<div class="form-group row">
						<label for="" class="col-md-3 col-form-label">No. Formulir</label>
						<select name="" id="formulir_selector" class="form-control" disabled>
							<option value="" >Pilih</option>
							<?php
								foreach($pendaftaran as $p){
									if(count($p['hasil_penerimaan']) > 0){
										echo '<option value="'.$p["id"].'">'.$p["id"].'	</option>';
									}
								}
							?>
						</select>
					</div>
					<div class="penerimaan-wrapper" style="display: none">
						<div class="form-group row">
							<label for="" class="col-md-3 col-form-label">Nama Camaru</label>
							<input id="nama_camaru" type="text" class="form-control" disabled>
						</div>
						<div class="penerimaan-list">
							<div class="d-flex flex-column align-items-center mt-24">
								<div for="" class="">Fakultas Teknologi Informasi - S1 Teknik Informatika</div>
								<button class="btn btn-primary">Download Surat Keputusan Penerimaan</button>
							</div>
							<div class="d-flex flex-column align-items-center mt-6">
								<div for="" class="">Fakultas Teknologi Informasi - S1 Sistem Informasi</div>
								<button class="btn btn-primary">Download Surat Keputusan Penerimaan</button>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-8 mt-4">
			<div class="card card-custom bg-light">
				<div class="card-body">
					<p>Bagi yang diterima, silahkan download pada salah satu Surat Keputusan Penerimaan</p>
					<p>Apabila pilihan Anda ada dua pilihan Program Studi, juika salah satu pilihan belum tampil, maka pilihan Anda masih dalam proses seleksi</p>
					<p>Untuk melakukan registrasi ulang dan mendapatkan Nomor Induk Mahasiswa, silahkan lakukan pembayaran sesuai biaya yang tercantum dalam Surat Keputusan Penerimaan, kemudian silahkan upload bukti pembayaran melalui menu <a href="<?php echo base_url("pendaftaran/registrasi_ulang") ?>">Registrasi Ulang</a></p>
				</div>
			</div>
		</div>
	</div>
</div>
