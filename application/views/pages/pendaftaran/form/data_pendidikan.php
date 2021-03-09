<div class="container">
	<ul class="nav nav-tabs nav-tabs-line">
		<li class="nav-item">
			<a class="nav-link disabled" data-toggle="tab" href="#kt_tab_pane_1">1. Data Personal</a>
		</li>
		<li class="nav-item">
			<a class="nav-link disabled" data-toggle="tab" disabled>2. Data Wali</a>
		</li>
		<li class="nav-item">
			<a class="nav-link active" data-toggle="tab">3. Data Pendidikan</a>
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
			<form action="<?php echo base_url('/api/pendaftaran/update_form') ?>" method="POST" name="data_pendidikan" enctype="multipart/form-data">
				<?php
					$pendidikans = ['SMA'];
					if($pendaftaran['jenjang_id'] == 2){
						$pendidikans = ['SMA'];
					}
					if($pendaftaran['jenjang_id'] == 3){
						$pendidikans = ['SMA', 'S1'];
					}
					if($pendaftaran['jenjang_id'] == 4){
						$pendidikans = ['SMA', 'S1', 'S2'];
					}
				?>
				<input type="text" class="form-control" readonly name="form_type" hidden value="data_pendidikan">
				<input type="text" class="form-control" readonly name="id" hidden value="<?php echo $pendaftaran['id'] ?>">
				<?php 
					foreach($pendidikans as $key=>$pendidikan){
						?>
							<div class="accordion accordion-toggle-arrow" id="accordion-<?php echo $pendidikan ?>">
								<div class="card">
									<div class="card-header">
										<div class="card-title" data-toggle="collapse" data-target="#collapse-<?php echo $pendidikan ?>">
											Histori Pendidikan - <?php echo $pendidikan ?>
										</div>
									</div>
									<div id="collapse-<?php echo $pendidikan ?>" class="collapse show" data-parent="#accordion-<?php echo $pendidikan ?>">
										<div class="card-body">
											<div class="form-group row">
												<input type="text" name="status_pendidikan[]" value="<?php echo $pendidikan ?>" readonly hidden>
											</div>
											<div class="form-group row">
												<label for="" class="col-md-2 col-form-label">NISN / NIM</label>
												<div class="col-md-10">
													<input type="number" class="form-control" name="npsn[]" value="<?php echo ($data_pendidikan['npsn[]'][$key] ?? null) ?>">
												</div>
											</div>
											<div class="form-group row">
												<label for="" class="col-md-2 col-form-label">Jurusan/Program Studi</label>
												<div class="col-md-10">
													<input type="text" class="form-control" name="jurusan[]" value="<?php echo ($data_pendidikan['jurusan[]'][$key] ?? null) ?>">
												</div>
											</div>
											<div class="form-group row">
												<label for="" class="col-md-2 col-form-label">Tahun Masuk</label>
												<div class="col-md-10">
													<input type="number" class="form-control" name="tahun_masuk[]" value="<?php echo ($data_pendidikan['tahun_masuk[]'][$key] ?? null) ?>">
												</div>
											</div>
											<div class="form-group row">
												<label for="" class="col-md-2 col-form-label">Tahun Lulus</label>
												<div class="col-md-10">
													<input type="number" class="form-control" name="tahun_lulus[]" value="<?php echo ($data_pendidikan['tahun_lulus[]'][$key] ?? null) ?>">
												</div>
											</div>

											<h3 class="card-title text-primary">Data Sekolah</h3>		
											<?php
												if(!empty($data_pendidikan['sekolah[]'][$key])){
													$sekolah = $data_pendidikan['sekolah[]'][$key]
													?>
														<div class="daerah-wrapper" data-isarray="true" data-pendidikan="true">
															<?php 
																if(!empty($sekolah)){
																	?>
																		<div class="form-group row" data-provinsi="true" >
																			<label for="" class="col-md-2 col-form-label">Provinsi</label>
																			<div class="col-md-10">
																				<select name="provinsi[]" class="form-control" >
																					<option value="">Pilih</option>
																					<?php
																						foreach($provinsi as $p){
																							echo '<option '.($p['id'] == $data_pendidikan['sekolah_parentIds[]'][$key]['selected_provinsi_id'] ? 'selected': '').' value="'.$p['id'].'">'.$p['provinsi'].'</option>';
																						}
																					?>
																					
																				</select>
																			</div>
																		</div>

																		<div class="form-group row" data-kota_kab="true" >
																			<label for="" class="col-md-2 col-form-label">Kabupaten/Kota</label>
																			<div class="col-md-10">
																				<select name="kota_kab[]" class="form-control" >
																					<option value="">Pilih</option>
																					<?php
																						foreach($data_pendidikan['kota_kab[]'][$key] as $kota_kab){
																							echo '<option '.($kota_kab['id'] == $data_pendidikan['sekolah_parentIds[]'][$key]['selected_kota_id'] ? 'selected': '').' value="'.$kota_kab['id'].'">'.$kota_kab['kota_kab'].'</option>';
																						}
																					?>
																				</select>
																			</div>
																		</div>

																		<div class="form-group row" data-kota_kab="true" >
																			<label for="" class="col-md-2 col-form-label">Nama Sekolah/Universitas</label>
																			<div class="col-md-10">
																				<select name="sekolah[]" class="form-control" >
																					<option value="">Pilih</option>
																					<?php
																						foreach($data_pendidikan['data_sekolah[]'][$key] as $sekolah){
																							echo '<option '.($sekolah['id'] == $data_pendidikan['sekolah_parentIds[]'][$key]['selected_sekolah_id'] ? 'selected': '').' value="'.$sekolah['id'].'">'.$sekolah['sekolah'].'</option>';
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
														<div class="daerah-wrapper" data-isarray="true" data-pendidikan="true">

														</div>

														<div class="form-group row">
															<label for="" class="col-md-2 col-form-label">Detail Alamat</label>
															<div class="col-md-10">
																<textarea name="detail_alamat[]"cols="30" rows="10" class="form-control"><?php echo ($data_pendidikan['detail_alamat[]'][$key] ?? null) ?></textarea>
															</div>
														</div>
													<?php
												}
											?>
											
											<div class="form-group row">
												<label for="" class="col-md-2 col-form-label">Unggah Ijazah</label>
												<div class="col-md-10">
													<?php
														if(empty($data_pendidikan['upload_ijazah[]'][$key])){
															?>
																<input type="file" name="upload_ijazah_<?php echo $pendidikan ?>" accept="application/pdf">
															<?php
														}else{
															?>
																<a href="<?php echo base_url('uploads/'.$data_pendidikan['upload_ijazah[]'][$key]) ?>" download class="btn btn-link bg-hover-primary text-hover-white"> <i class="fas fa-file-download text-primary"></i> Unduh Berkas</a>
																<button type="button" data-name="upload_ijazah_<?php echo $pendidikan ?>" data-id="<?php echo $pendidikan ?>" class="btn btn-light-primary" data-toggle="sunting" data-target="upload" data-field="upload_ijazah[]">
																	<i class="fas fa-pen"></i> Sunting
																</button>
															<?php
														}
													?>
												</div>
											</div>
											<div class="form-group row">
												<label for="" class="col-md-2 col-form-label">Unggah Raport/Transkrip Nilai</label>
												<div class="col-md-10">
													<?php
														if(empty($data_pendidikan['upload_daftar_nilai[]'][$key])){
															?>
																<input type="file" name="upload_daftar_nilai_<?php echo $pendidikan ?>" accept="application/pdf">
															<?php
														}else{
															?>
																<a href="<?php echo base_url('uploads/'.$data_pendidikan['upload_daftar_nilai[]'][$key]) ?>" download class="btn btn-link bg-hover-primary text-hover-white"> <i class="fas fa-file-download text-primary"></i> Unduh Berkas</a>
																<button type="button" class="btn btn-light-primary" data-name="upload_daftar_nilai<?php echo $pendidikan ?>" data-id="<?php echo $pendidikan ?>" data-toggle="sunting" data-target="upload" data-field="upload_daftar_nilai[]">
																	<i class="fas fa-pen"></i> Sunting
																</button>
															<?php
														}
													?>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php
					}
				?>
				
				<div class="d-flex justify-content-end mt-4">
					<div class="d-flex">
						<div class="mr-2">
						<a href="<?php echo base_url('/pendaftaran/formulir/data_wali?id='.$this->input->get('id')) ?>" class="btn btn-primary">Kembali</a>
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
