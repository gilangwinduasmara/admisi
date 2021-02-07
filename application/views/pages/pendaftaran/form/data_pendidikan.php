<div class="container">
	<ul class="nav nav-tabs nav-tabs-line">
		<li class="nav-item">
			<a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1">1. Data Personal</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2">2. Data Sekolah</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#kt_tab_pane_3">3. Data Akademik</a>
		</li>
	</ul>
	<div class="tab-content mt-5" id="myTabContent">
		<div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel" aria-labelledby="kt_tab_pane_2">
			<form action="">
				<div class="accordion accordion-toggle-arrow" id="accordion-personal">
					<div class="card">
						<div class="card-header">
							<div class="card-title" data-toggle="collapse" data-target="#collapse-personal">
								Histori Pendidikan - SMA/SMK Sederajat
							</div>
						</div>
						<div id="collapse-personal" class="collapse show" data-parent="#accordion-personal">
							<div class="card-body">
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Status Pendidikan</label>
									<div class="col-md-10">
										<select name="" id="" class="form-control">
											<option value="">Pilih</option>
											<option value="AYAH">Ayah</option>
											<option value="IBU">Ibu</option>
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
										<select name="" id="" class="form-control">
											<option value="">Pilih</option>
											<option value="Jateng">Jawa Tengah</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Kabupaten/Kota</label>
									<div class="col-md-10">
										<select name="" id="" class="form-control">
											<option value="">Pilih</option>
											<option value="Salatiga">Salatiga</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Nama Sekolah/Universitas</label>
									<div class="col-md-10">
										<select name="" id="" class="form-control">
											<option value="">Pilih</option>
											<option value="Salatiga">Universitas Kristen Satya Wacana</option>
											<option value="Salatiga">IAIN Salatiga</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Detail Alamat</label>
									<div class="col-md-10">
										<textarea name="" id="" cols="30" rows="10" class="form-control"></textarea>
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Kabupaten/Kota</label>
									<div class="col-md-10">
										<div class="dropzone dropzone-multi dropzone-file" id="history_pendidikan_sma_ijazah" data-field="history_pendidikan_sma_ijazah">
											<div class="dropzone-panel mb-lg-0 mb-2">
												<a class="dropzone-select btn btn-light-primary font-weight-bold btn-sm dz-clickable">Attach files</a>
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
										<input type="checkbox" name="Checkboxes15"/>
										<span></span>
										Alamat wali sama dengan alamat camaru
									</label>
								</div>
								<div class="card-body">
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Negara</label>
									<div class="col-md-10">
										<input type="text" class="form-control">
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Provinsi</label>
									<div class="col-md-10">
										<select name="" id="" class="form-control">
											<option value="">Pilih</option>
											<option value="Jateng">Jawa Tengah</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Kabupaten/Kota</label>
									<div class="col-md-10">
										<select name="" id="" class="form-control">
											<option value="">Pilih</option>
											<option value="Salatiga">Salatiga</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Kecamatan</label>
									<div class="col-md-10">
										<select name="" id="" class="form-control">
											<option value="">Pilih</option>
											<option value="Salatiga">Salatiga</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Kelurahan</label>
									<div class="col-md-10">
										<select name="" id="" class="form-control">
											<option value="">Pilih</option>
											<option value="Salatiga">Salatiga</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Kode Pos</label>
									<div class="col-md-10">
										<select name="" id="" class="form-control">
											<option value="">Pilih</option>
											<option value="Salatiga">Salatiga</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="" class="col-md-2 col-form-label">Detail Alamat</label>
									<div class="col-md-10">
										<textarea name="" id="" cols="30" rows="10" class="form-control"></textarea>
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
							<a href="data_pendidikan" class="btn btn-primary">Lanjut</a>
						</div>
					</div>
				</div>
			</form>
		</div>
		
	</div>
	
</div>
