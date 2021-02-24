<div class="container">
	<ul class="nav nav-tabs nav-tabs-line">
		<li class="nav-item">
			<a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1">1. Data Personal</a>
		</li>
		<li class="nav-item">
			<a class="nav-link disabled" data-toggle="tab" disabled>2. Data Wali</a>
		</li>
		<li class="nav-item">
			<a class="nav-link disabled" data-toggle="tab">3. Data Pendidikan</a>
		</li>
		<li class="nav-item">
			<a class="nav-link disabled" data-toggle="tab">3. Data Akademik</a>
		</li>
		<li class="nav-item">
			<a class="nav-link disabled" data-toggle="tab">4. Unggah Berkas</a>
		</li>
		<li class="nav-item">
			<a class="nav-link disabled" data-toggle="tab">5. Submit</a>
		</li>
	</ul>
	<div class="tab-content mt-5" id="myTabContent">
		<div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel" aria-labelledby="kt_tab_pane_2">
			<form action="<?php echo base_url('/api/pendaftaran/update_form') ?>" method="POST" name="data_diri">
				<div class="accordion accordion-toggle-arrow" id="accordion-personal">
					<div class="card">
						<div class="card-header">
							<div class="card-title" data-toggle="collapse" data-target="#collapse-personal">
								Data Diri Camaru
							</div>
						</div>
						<div id="collapse-personal" class="collapse show" data-parent="#accordion-personal">
							<div class="card-body">
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">No. Pendaftaran</label>
									<div class="col-md-10">
										<input type="text" class="form-control" readonly name="form_type" hidden value="data_diri">
										<input type="text" class="form-control" readonly name="id" hidden value="<?php echo $pendaftaran['id'] ?>">
										<input type="text" class="form-control" disabled value="<?php echo $pendaftaran['id'] ?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Nama Camaru</label>
									<div class="col-md-10">
										<input type="text" class="form-control" disabled value="<?php echo $pendaftaran['nama'] ?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">NISN</label>
									<div class="col-md-10">
										<input type="number" class="form-control" name="NISN" value="<?php echo $data_diri['NISN'] ?? null ?>">
										<!-- <div class="invalid-feedback">Shucks, check the formatting of that and try again.</div> -->
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">NIK</label>
									<div class="col-md-10">
										<input type="number" class="form-control" name="NIK" value="<?php echo $data_diri['NIK'] ?? null ?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Email</label>
									<div class="col-md-10">
										<input type="email" class="form-control" name="email" value="<?php echo $data_diri['email'] ?? null ?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">No. HP</label>
									<div class="col-md-10">
										<input type="number" class="form-control" name="no_hp" value="<?php echo $data_diri['no_hp'] ?? null ?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Kota Kelahiran</label>
									<div class="col-md-10">
										<input type="text" class="form-control" name="kota_kelahiran" value="<?php echo $data_diri['kota_kelahiran'] ?? null ?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Tanggal Lahir</label>
									<div class="col-md-10">
										<input type="date" class="form-control" name="tgl_lahir" value="<?php echo $data_diri['tgl_lahir'] ?? null ?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Jenis kelamin</label>
									<div class="col-md-10">
										<div class="radio-inline">
											<label class="radio">
												<input type="radio" name="jenis_kelamin" value="P" <?php echo (($data_diri['jenis_kelamin'] ?? 'P') == 'P' ? 'checked': '') ?>/>
												<span></span>
												Perempuan
											</label>
											<label class="radio">
												<input type="radio" name="jenis_kelamin" value="L" <?php echo (($data_diri['jenis_kelamin'] ?? 'P') == 'L' ? 'checked': '') ?>/>
												<span></span>
												Laki-laki
											</label>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Pekerjaan</label>
									<div class="col-md-10">
										<input type="text" class="form-control" name="pekerjaan" value="<?php echo $data_diri['pekerjaan'] ?? null ?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Status Pernikahan</label>
									<div class="col-md-10">
										<select name="status_sipil" id="" class="form-control">
											<option value="">Pilih</option>
											<option value="NIKAH" <?php echo (($data_diri['status_sipil'] ?? null) == 'NIKAH' ? 'selected': '') ?>>Nikah</option>
											<option value="BELUM NIKAH" <?php echo (($data_diri['status_sipil'] ?? null) == 'BELUM NIKAH' ? 'selected': '') ?>>Belum Nikah</option>
											<option value="JANDA" <?php echo (($data_diri['status_sipil'] ?? null) == 'JANDA' ? 'selected': '') ?>>Janda</option>
											<option value="DUDA" <?php echo (($data_diri['status_sipil'] ?? null) == 'DUDA' ? 'selected': '') ?>>Duda</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Golongan Darah</label>
									<div class="col-md-10">
										<select name="gol_darah" id="" class="form-control">
											<option value="">Pilih</option>
											<option value="A" <?php echo (($data_diri['gol_darah'] ?? null) == 'A' ? 'selected': '') ?>>A</option>
											<option value="B" <?php echo (($data_diri['gol_darah'] ?? null) == 'B' ? 'selected': '') ?>>B</option>
											<option value="AB" <?php echo (($data_diri['gol_darah'] ?? null) == 'AB' ? 'selected': '') ?>>AB</option>
											<option value="O" <?php echo (($data_diri['gol_darah'] ?? null) == 'O' ? 'selected': '') ?>>O</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Tinggi Badan</label>
									<div class="col-md-10">
										<input type="number" class="form-control" name="tinggi_badan" value="<?php echo $data_diri['tinggi_badan'] ?? null ?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Berat Badan</label>
									<div class="col-md-10">
										<input type="number" class="form-control" name="berat_badan" value="<?php echo $data_diri['berat_badan'] ?? null ?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Kewarganegaraan</label>
									<div class="col-md-10">
										<div class="radio-inline">
											<label class="radio">
												<input type="radio" name="kewarganegaraan" value="WNI" <?php echo (($data_diri['kewarganegaraan'] ?? 'WNI') == 'WNI' ? 'checked': '') ?>/>
												<span></span>
												WNI
											</label>
											<label class="radio">
												<input type="radio" name="kewarganegaraan" value="WNA" <?php echo (($data_diri['kewarganegaraan'] ?? 'WNI') == 'WNA' ? 'checked': '') ?>/>
												<span></span>
												WNA
											</label>
										</div>
									</div>
								</div>								
							</div>
						</div>
					</div>
				</div>
				
				<div class="accordion accordion-toggle-arrow" id="accordion-alamat">
					<div class="card">
						<div class="card-header">
							<div class="card-title" data-toggle="collapse" data-target="#collapse-alamat">
								Alamat Camaru
							</div>
						</div>
						<div id="collapse-alamat" class="collapse" data-parent="">
							<div class="card-body">
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Negara</label>
									<div class="col-md-10">
										<input type="text" class="form-control" name="negara" value="<?php echo $data_diri['negara'] ?? null ?>">
									</div>
								</div>
								<?php
									if(!empty($data_diri['kelurahan_id'])){
										?>
											<div class="form-group row">
												<label for="" class="col-md-2 col-form-label">Tempat Tinggal</label>
												<div class="col-md-10">
													<button class="btn btn-primary" data-toggle="sunting" data-target="daerah_selector" >Sunting</button>
													<input name="kelurahan" value="<?php echo $data_diri['kelurahan_id']?>" hidden>
												</div>
											</div>
										<?php
									}else{
										?>
											<div class="daerah-wrapper" >
									
											</div>
											
										<?php
									}
								?>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Detail Alamat</label>
									<div class="col-md-10">
										<textarea name="alamat_asal" id="" cols="30" rows="10" class="form-control"></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="d-flex justify-content-end mt-4">
					<div class="d-flex">
						<div class="mr-2">
							<a href="#kt_tab_pane_2" class="btn btn-primary disabled">Kembali</a>
						</div>
						<div class="">
							<button class="btn btn-primary lanjut" type="button">Lanjut</button>
						</div>
					</div>
				</div>
			</form>
		</div>
		
	</div>
	
</div>

