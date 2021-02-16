<div class="container">
<ul class="nav nav-tabs nav-tabs-line">
		<li class="nav-item">
			<a class="nav-link disabled" data-toggle="tab" href="#kt_tab_pane_1">1. Data Personal</a>
		</li>
		<li class="nav-item">
			<a class="nav-link disabled" data-toggle="tab" disabled>2. Data Wali</a>
		</li>
		<li class="nav-item">
			<a class="nav-link disabled" data-toggle="tab">3. Data Pendidikan</a>
		</li>
		<li class="nav-item">
			<a class="nav-link acvtive" data-toggle="tab">3. Data Akademik</a>
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
			<form action="<?php echo base_url('/api/pendaftaran/update_form')?>" method="POST">
				<input type="text" class="form-control" readonly name="form_type" hidden value="data_akademik">
				<input type="text" class="form-control" readonly name="id" hidden value="<?php echo $pendaftaran['id'] ?>">
				<div class="accordion accordion-toggle-arrow" id="accordion-program-studi">
					<div class="card">
						<div class="card-header">
							<div class="card-title" data-toggle="collapse" data-target="#collapse-program-studi">
								Pilihan Program Studi
							</div>
						</div>
						<div id="collapse-program-studi" class="collapse show" data-parent="#accordion-program-studi">
							<div class="card-body">
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Pilihan Pertama</label>
									<div class="col-md-10">
										<select name="prodi_1_id"  class="form-control">
											<option value="">Pilih</option>
											<?php
												foreach($prodi as $p){
													echo '<option '.($p["id"] == ($data_akademik['prodi_1_id'] ?? null) ? 'selected': null).' value="'.$p['id'].'">'.$p['nama_prodi'].'</option>';
												}
											?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Pilihan Kedua</label>
									<div class="col-md-10">
										<select name="prodi_2_id" class="form-control">
											<option value="">Pilih</option>
											<?php
												foreach($prodi as $p){
													echo '<option '.($p["id"] == ($data_akademik['prodi_2_id'] ?? null) ? 'selected': null).' value="'.$p['id'].'">'.$p['nama_prodi'].'</option>';
												}
											?>
										</select>
									</div>
								</div>						
							</div>
						</div>
					</div>
				</div>

				<div class="accordion accordion-toggle-arrow" id="accordion-prestasi">
					<div class="card">
						<div class="card-header">
							<div class="card-title" data-toggle="collapse" data-target="#collapse-prestasi">
								Prestasi Akademik yang Pernah Diraih (Opsional)
							</div>
						</div>
						<div id="collapse-prestasi" class="collapse" data-parent="#accordion-prestasi">
							<div class="card-body">
								<div id="kt_repeater_1">
									<div data-repeater-list>
										<div data-repeater-item>
											<div class="form-group row">
												<label for="" class="col-md-2 col-form-label">Jenis prestasi</label>
												<div class="col-md-10">
													<select name="jenis_prestasi"  class="form-control">
														<option value="">Pilih</option>
														<option value="NASIONAL">Nasional</option>
														<option value="INTERNASIONAL">Internasional</option>
													</select>
												</div>
											</div>
											<div class="form-group row">
												<label for="" class="col-md-2 col-form-label">Nama Kegiatan</label>
												<div class="col-md-10">
													<input type="text" class="form-control" name="nama_kegiatan">
												</div>
											</div>
											<div class="form-group row">
												<label for="" class="col-md-2 col-form-label">Tanggal Kegiatan</label>
												<div class="col-md-10">
													<input type="date" class="form-control" name="tgl_kegiatan">
												</div>
											</div>
											<div class="form-group row">
												<label for="" class="col-md-2 col-form-label">Unggah Bukti Prestasi</label>
												<div class="col-md-10">
													<div class="dropzone dropzone-multi dropzone-file"  data-field="history_pendidikan_sma_ijazah">
														<div class="dropzone-panel mb-lg-0 mb-2">
															<a class="dropzone-select btn btn-light-primary font-weight-bold btn-sm dz-clickable">Pilih Berkas</a>
															<a class="dropzone-upload btn btn-light-primary font-weight-bold btn-sm" style="display: none;">Upload All</a>
															<a class="dropzone-remove-all btn btn-light-primary font-weight-bold btn-sm" style="display: none;">Remove All</a>
														</div>
														<div class="dropzone-items">
															<div class="dropzone-item" style="display:none">
																<div class="dropzone-file">
																	<div class="dropzone-filename" title="some_image_file_name.jpg">
																		<span data-dz-name="">some_image_file_name.jpg</span>
																		<strong>(
																		<span data-dz-size="">340kb</span>)</strong>
																	</div>
																</div>
															</div>
														</div>
													<div class="dz-default dz-message"><button class="dz-button" type="button">Drop files here to upload</button></div></div>
												</div>
											</div>
											<div class="separator separator-solid mb-8"></div>
										</div>
									</div>
									<div class="d-flex justify-content-center">
										<div data-repeater-create="" class="btn font-weight-bold btn-light-primary">
											<i class="la la-plus"></i>
											Tambah Prestasi
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
							<a href="#kt_tab_pane_2" class="btn btn-primary disabled">Kembali</a>
						</div>
						<div class="">
							<button class="btn btn-primary lanjut">Lanjut</button>
						</div>
					</div>
				</div>
			</form>
		</div>
		
	</div>
	
</div>

