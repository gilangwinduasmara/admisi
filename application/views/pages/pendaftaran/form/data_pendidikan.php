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
												<label for="" class="col-md-2 col-form-label">NPSN / NIM</label>
												<div class="col-md-10">
													<input type="text" class="form-control" name="npsn[]" value="<?php echo ($data_pendidikan['npsn[]'][$key] ?? null) ?>">
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
													<input type="text" class="form-control" name="tahun_masuk[]" value="<?php echo ($data_pendidikan['tahun_masuk[]'][$key] ?? null) ?>">
												</div>
											</div>
											<div class="form-group row">
												<label for="" class="col-md-2 col-form-label">Tahun Lulus</label>
												<div class="col-md-10">
													<input type="text" class="form-control" name="tahun_lulus[]" value="<?php echo ($data_pendidikan['tahun_lulus[]'][$key] ?? null) ?>">
												</div>
											</div>

											<h3 class="card-title text-primary">Data Sekolah</h3>		
											<div class="daerah-wrapper" data-isarray="true" data-pendidikan="true">

											</div>
									
											<div class="form-group row">
												<label for="" class="col-md-2 col-form-label">Detail Alamat</label>
												<div class="col-md-10">
													<textarea name="detail_alamat[]"cols="30" rows="10" class="form-control"><?php echo ($data_pendidikan['detail_alamat[]'][$key] ?? null) ?></textarea>
												</div>
											</div>
											<div class="form-group row">
												<label for="" class="col-md-2 col-form-label">Unggah Ijazah</label>
												<div class="col-md-10">
													<input type="file" name="tess" id="">
													<!-- <div id="dropzone_kk" class="dropzone dropzone-multi dropzone-file"  data-field="tes">
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
														<div class="dz-default dz-message"><button class="dz-button" type="button">Drop files here to upload</button></div>
													</div> -->
												<input type="file" name="tes" hidden>
												</div>
											</div>
											<div class="form-group row">
												<label for="" class="col-md-2 col-form-label">Unggah Raport/Transkrip Nilai</label>
												<div class="col-md-10">
													<div class="dropzone dropzone-multi dropzone-file" data-field="history_pendidikan_sma_ijazah">
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
										</div>
									</div>
								</div>
							</div>
						<?php
					}
				?>
				
				
				<!-- <div class="accordion accordion-toggle-arrow" id="accordion-s1">
					<div class="card">
						<div class="card-header">
							<div class="card-title" data-toggle="collapse" data-target="#collapse-s1">
								Histori Pendidikan - S1
							</div>
						</div>
						<div id="collapse-s1" class="collapse show" data-parent="#accordion-s1">
							<div class="card-body">
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Status Pendidikan</label>
									<div class="col-md-10">
										<select name="" class="form-control">
											<option value="">Pilih</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">NPSN / NIM</label>
									<div class="col-md-10">
										<input type="text" class="form-control">
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Jurusan/Program Studi</label>
									<div class="col-md-10">
										<input type="text" class="form-control">
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Tahun Masuk</label>
									<div class="col-md-10">
										<input type="text" class="form-control">
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Tahun Lulus</label>
									<div class="col-md-10">
										<input type="text" class="form-control">
									</div>
								</div>

								<h3 class="card-title text-primary">Data Sekolah</h3>		

								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Provinsi</label>
									<div class="col-md-10">
										<select name="" class="form-control">
											<option value="">Pilih</option>
											<option value="Jateng">Jawa Tengah</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Kabupaten/Kota</label>
									<div class="col-md-10">
										<select name="" class="form-control">
											<option value="">Pilih</option>
											<option value="Salatiga">Salatiga</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Nama Sekolah/Universitas</label>
									<div class="col-md-10">
										<select name="" class="form-control">
											<option value="">Pilih</option>
											<option value="Salatiga">Universitas Kristen Satya Wacana</option>
											<option value="Salatiga">IAIN Salatiga</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Detail Alamat</label>
									<div class="col-md-10">
										<textarea name="" cols="30" rows="10" class="form-control"></textarea>
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Unggah Ijazah</label>
									<div class="col-md-10">
										<div class="dropzone dropzone-multi dropzone-file" data-field="history_pendidikan_sma_ijazah">
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
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Unggah Raport/Transkrip Nilai</label>
									<div class="col-md-10">
										<div class="dropzone dropzone-multi dropzone-file" data-field="history_pendidikan_sma_ijazah">
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
							</div>
						</div>
					</div>
				</div>

				<div class="accordion accordion-toggle-arrow" id="accordion-s2">
					<div class="card">
						<div class="card-header">
							<div class="card-title" data-toggle="collapse" data-target="#collapse-s2">
								Histori Pendidikan - S2
							</div>
						</div>
						<div id="collapse-s2" class="collapse show" data-parent="#accordion-s2">
							<div class="card-body">
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Status Pendidikan</label>
									<div class="col-md-10">
										<select name="" class="form-control">
											<option value="">Pilih</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">NPSN / NIM</label>
									<div class="col-md-10">
										<input type="text" class="form-control">
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Jurusan/Program Studi</label>
									<div class="col-md-10">
										<input type="text" class="form-control">
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Tahun Masuk</label>
									<div class="col-md-10">
										<input type="text" class="form-control">
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Tahun Lulus</label>
									<div class="col-md-10">
										<input type="text" class="form-control">
									</div>
								</div>

								<h3 class="card-title text-primary">Data Sekolah</h3>		

								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Provinsi</label>
									<div class="col-md-10">
										<select name="" class="form-control">
											<option value="">Pilih</option>
											<option value="Jateng">Jawa Tengah</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Kabupaten/Kota</label>
									<div class="col-md-10">
										<select name="" class="form-control">
											<option value="">Pilih</option>
											<option value="Salatiga">Salatiga</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Nama Sekolah/Universitas</label>
									<div class="col-md-10">
										<select name="" class="form-control">
											<option value="">Pilih</option>
											<option value="Salatiga">Universitas Kristen Satya Wacana</option>
											<option value="Salatiga">IAIN Salatiga</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Detail Alamat</label>
									<div class="col-md-10">
										<textarea name="" cols="30" rows="10" class="form-control"></textarea>
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Unggah Ijazah</label>
									<div class="col-md-10">
										<div class="dropzone dropzone-multi dropzone-file" data-field="history_pendidikan_sma_ijazah">
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
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Unggah Raport/Transkrip Nilai</label>
									<div class="col-md-10">
										<div class="dropzone dropzone-multi dropzone-file" data-field="history_pendidikan_sma_ijazah">
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
							</div>
						</div>
					</div>
				</div> -->
				
				<div class="d-flex justify-content-end mt-4">
					<div class="d-flex">
						<div class="mr-2">
							<a href="data_personal" class="btn btn-primary">Kembali</a>
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
