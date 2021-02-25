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
										<input type="number" class="form-control" name="NIK" value="<?php echo $data_wali['NIK'] ?? null ?>">
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
											<option value="AYAH" <?php echo(($data_wali['status_hubungan'] ?? null) == "AYAH" ? "selected": "") ?>>Ayah</option>
											<option value="IBU" <?php echo(($data_wali['status_hubungan'] ?? null) == "IBU" ? "selected": "") ?>>Ibu</option>
											<option value="WALI" <?php echo(($data_wali['status_hubungan'] ?? null) == "WALI" ? "selected": "") ?>>Wali</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">No. HP</label>
									<div class="col-md-10">
										<input type="number" class="form-control" name="no_hp" value="<?php echo $data_wali['no_hp'] ?? null ?>">
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
										<select name="pendidikan_terakhir" class="form-control">
											<option value="">Pilih</option>
											<option <?php echo ($data_wali['pendidikan_terakhir'] == 'Tidak Sekolah' ? 'selected': '') ?> value="Tidak Sekolah">Tidak Sekolah</option>
											<option <?php echo ($data_wali['pendidikan_terakhir'] == 'SD' ? 'selected': '') ?> value="SD">SD</option>
											<option <?php echo ($data_wali['pendidikan_terakhir'] == 'SMP/Sederajat' ? 'selected': '') ?> value="SMP/Sederajat">SMP/Sederajat</option>
											<option <?php echo ($data_wali['pendidikan_terakhir'] == 'SMA/Sederajat' ? 'selected': '') ?> value="SMA/Sederajat">SMA/Sederajat</option>
											<option <?php echo ($data_wali['pendidikan_terakhir'] == 'S1' ? 'selected': '') ?> value="S1">S1</option>
											<option <?php echo ($data_wali['pendidikan_terakhir'] == 'S2' ? 'selected': '') ?> value="S2">S2</option>
											<option <?php echo ($data_wali['pendidikan_terakhir'] == 'S3' ? 'selected': '') ?> value="S3">S3</option>
										</select>
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
										<input type="number" class="form-control" name="telp_instansi" value="<?php echo $data_wali['telp_instansi'] ?? null ?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Penghasilan Per Bulan</label>
									<div class="col-md-10">
										<input type="number" class="form-control input-uang" name="penghasilan_perbulan" value="<?php echo $data_wali['penghasilan_perbulan'] ?? null ?>">
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
									<!-- <div class="form-group row" hidden>
										<label for="" class="col-md-2 col-form-label">Negara</label>
										<div class="col-md-10">
											<input type="text" class="form-control" name="negara" value="">
										</div>
									</div> -->
									<?php
										if(!empty($data_wali['kelurahan_id'])){
											?>
												<div class="daerah-wrapper" >
													<?php 
														if(!empty($daerah)){
															?>
																<div class="form-group row" data-provinsi="true" >
																	<label for="" class="col-md-2 col-form-label">Provinsi</label>
																	<div class="col-md-10">
																		<select name="provinsi" class="form-control" >
																			<option value="">Pilih</option>
																			<?php
																				foreach($daerah['provinsi'] as $provinsi){
																					echo '<option '.($provinsi['id'] == $parentIds['selected_provinsi_id'] ? 'selected': '').' value="'.$provinsi['id'].'">'.$provinsi['provinsi'].'</option>';
																				}
																			?>
																			
																		</select>
																	</div>
																</div>

																<div class="form-group row" data-kota_kab="true" >
																	<label for="" class="col-md-2 col-form-label">Kabupaten/Kota</label>
																	<div class="col-md-10">
																		<select name="kota_kab" class="form-control" >
																			<option value="">Pilih</option>
																			<?php
																				foreach($daerah['kota_kab'] as $kota_kab){
																					echo '<option '.($kota_kab['id'] == $parentIds['selected_kota_id'] ? 'selected': '').' value="'.$kota_kab['id'].'">'.$kota_kab['kota_kab'].'</option>';
																				}
																			?>
																			
																		</select>
																	</div>
																</div>

																<div class="form-group row" data-kecamatan="true" >
																	<label for="" class="col-md-2 col-form-label">Kecamatan</label>
																	<div class="col-md-10">
																		<select name="kecamatan" class="form-control" >
																			<option value="">Pilih</option>
																			<?php
																				foreach($daerah['kecamatan'] as $kecamatan){
																					echo '<option '.($kecamatan['id'] == $parentIds['selected_kecamatan_id'] ? 'selected': '').' value="'.$kecamatan['id'].'">'.$kecamatan['kecamatan'].'</option>';
																				}
																			?>
																			
																		</select>
																	</div>
																</div>

																<div class="form-group row" data-kelurahan="true" >
																	<label for="" class="col-md-2 col-form-label">Kelurahan</label>
																	<div class="col-md-10">
																		<select name="kelurahan" class="form-control" >
																			<option value="">Pilih</option>
																			<?php
																				foreach($daerah['kelurahan'] as $kelurahan){
																					echo '<option '.($kelurahan['id'] == $data_wali['kelurahan_id'] ? 'selected': '').' value="'.$kelurahan['id'].'">'.$kelurahan['kelurahan'].'</option>';
																				}
																			?>
																			
																		</select>
																	</div>
																</div>

															<?php
															
														}
													?>
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
											<textarea name="alamat" cols="30" rows="10" class="form-control"><?php echo $data_wali['alamat'] ?></textarea>
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
							<a href="<?php echo base_url('/pendaftaran/formulir/data_diri?id='.$this->input->get('id')) ?>" class="btn btn-primary">Kembali</a>
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

<?php echo json_encode($daerah) ?>
