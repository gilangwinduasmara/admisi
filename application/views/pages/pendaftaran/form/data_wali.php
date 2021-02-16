<div class="container">
	<ul class="nav nav-tabs nav-tabs-line">
		<li class="nav-item">
			<a class="nav-link disabled" data-toggle="tab" href="#kt_tab_pane_1">1. Data Personal</a>
		</li>
		<li class="nav-item">
			<a class="nav-link aktive" data-toggle="tab" disabled>2. Data Wali</a>
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
			<?php print_r($data_wali) ?>
			<form action="<?php echo base_url('/api/pendaftaran/update_form') ?>" method="post" name="data_wali">
				<div class="accordion accordion-toggle-arrow" id="accordion-personal">
					<div class="card">
						<div class="card-header">
							<div class="card-title" data-toggle="collapse" data-target="#collapse-personal">
								Data Wali
							</div>
						</div>
						<div id="collapse-personal" class="collapse show" data-parent="#accordion-personal">
							<div class="card-body">
								<input type="text" class="form-control" readonly name="form_type" hidden value="data_wali">
								<input type="text" class="form-control" readonly name="id" hidden value="<?php echo $pendaftaran['id'] ?>">
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">NIK</label>
									<div class="col-md-10">
										<input type="text" class="form-control" name="NIK" value="<?php echo $data_wali['NIK'] ?? null ?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Nama</label>
									<div class="col-md-10">
										<input type="text" class="form-control" name="nama" value="<?php echo $data_wali['nama'] ?? null ?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Status dengan Camaru</label>
									<div class="col-md-10">
										<select class="form-control" required name="status_hubungan" value="<?php echo $data_wali['status_hubungan'] ?? null ?>">
											<option value="">Pilih</option>
											<option value="AYAH">Ayah</option>
											<option value="IBU">Ibu</option>
											<option value="WALI">Wali</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">No. HP</label>
									<div class="col-md-10">
										<input class="form-control input-hp" name="no_hp" value="<?php echo $data_wali['no_hp'] ?? null ?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Email</label>
									<div class="col-md-10">
										<input type="email" class="form-control input-email" name="email" value="<?php echo $data_wali['email'] ?? null ?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Pendidikan Terakhir</label>
									<div class="col-md-10">
										<input type="text" class="form-control" name="pendidikan_terakhir" value="<?php echo $data_wali['pendidikan_terakhir'] ?? null ?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Pekerjaan</label>
									<div class="col-md-10">
										<input type="text" class="form-control" name="pekerjaan" value="<?php echo $data_wali['pekerjaan'] ?? null ?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Instansi Tempat Wali Bekerja</label>
									<div class="col-md-10">
										<input type="text" class="form-control" name="nama_instansi" value="<?php echo $data_wali['nama_instansi'] ?? null ?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Alamat Instansi Tempat Wali Bekerja</label>
									<div class="col-md-10">
										<textarea type="text" class="form-control" rows="5" name="alamat_instansi"><?php echo $data_wali['alamat_instansi'] ?? null ?></textarea>
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">No. Telepon Instansi</label>
									<div class="col-md-10">
										<input type="text" class="form-control" name="telp_instansi" value="<?php echo $data_wali['telp_instansi'] ?? null ?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Penghasilan Per Bulan</label>
									<div class="col-md-10">
										<input type="text" class="form-control input-uang" name="penghasilan_perbulan" value="<?php echo $data_wali['penghasilan_perbulan'] ?? null ?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Nama Ibu Kandung</label>
									<div class="col-md-10">
										<input type="text" class="form-control" name="nama_ibu_kandung" value="<?php echo $data_wali['nama_ibu_kandung'] ?? null ?>">
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
								Alamat Wali
							</div>
						</div>
						<div id="collapse-alamat" class="collapse" data-parent="">
							<div class="card-body">
								<div class="form-group row ml-1">
									<label class="checkbox checkbox-outline checkbox-success">
										<input type="checkbox" name="same_address" value="true" <?php echo (($data_wali['same_address'] ?? null) == 'true' ? 'checked': '') ?>/>
										<span></span>
										Alamat wali sama dengan alamat camaru
									</label>
								</div>
								<div class="same-address">
									<div class="form-group row" hidden>
										<label for="" class="col-md-2 col-form-label">Negara</label>
										<div class="col-md-10">
											<input type="text" class="form-control" name="negara" value="">
										</div>
									</div>
									<div class="daerah-wrapper">
	
									</div>
									
									<div class="form-group row">
										<label for="" class="col-md-2 col-form-label">Detail Alamat</label>
										<div class="col-md-10">
											<textarea name="alamat_asal" cols="30" rows="10" class="form-control"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="d-flex justify-content-end mt-4">
					<div class="d-flex">
						<div class="mr-2">
							<a href="data_personal" class="btn btn-primary">Kembali</a>
						</div>
						<div class="">
							<button type="button" class="btn btn-primary lanjut">Lanjut</button>
						</div>
					</div>
				</div>
			</form>
		</div>
		
	</div>
	
</div>
