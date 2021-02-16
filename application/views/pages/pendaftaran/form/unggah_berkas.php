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
			<a class="nav-link disabled" data-toggle="tab">3. Data Akademik</a>
		</li>
		<li class="nav-item">
			<a class="nav-link active" data-toggle="tab">4. Unggah Berkas</a>
		</li>
		<li class="nav-item">
			<a class="nav-link disabled" data-toggle="tab">5. Submit</a>
		</li>
	</ul>
	<div class="tab-content mt-5" id="myTabContent">
		<div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel" aria-labelledby="kt_tab_pane_2">
			<form action="<?php echo base_url('/api/pendaftaran/update_form')?>" method="POST">
				<input type="text" class="form-control" readonly name="form_type" hidden value="unggah_berkas">
				<input type="text" class="form-control" readonly name="id" hidden value="<?php echo $pendaftaran['id'] ?>">
				<div class="form-group row">
					<label for="" class="col-md-2 col-form-label">Unggah Foto</label>
					<div class="col-md-10">
						<div id="dropzone_foto" class="dropzone dropzone-multi dropzone-file"  data-field="history_pendidikan_sma_ijazah">
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
					<label for="" class="col-md-2 col-form-label">Unggah Kartu Keluarga</label>
					<!-- <div class="col-md-10">
						<div id="dropzone_kk" class="dropzone dropzone-multi dropzone-file"  data-field="tes">
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
						<input type="file" name="tes">
					</div> -->
				</div>
				<div class="form-group row">
					<label for="" class="col-md-2 col-form-label">Unggah Akta Kelahiran</label>
					<div class="col-md-10">
						<div id="dropzone_akta" class="dropzone dropzone-multi dropzone-file"  data-field="history_pendidikan_sma_ijazah">
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
					<label for="" class="col-md-2 col-form-label">Surat Pernyataan</label>
					<div class="col-md-10">
						<div id="dropzone_pernyataan" class="dropzone dropzone-multi dropzone-file"  data-field="history_pendidikan_sma_ijazah">
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

