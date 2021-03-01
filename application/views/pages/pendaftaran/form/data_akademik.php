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
			<a class="nav-link acvtive"  href="#" data-toggle="tab">3. Data Akademik</a>
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
			<form action="<?php echo base_url('/api/pendaftaran/update_form')?>" method="POST" name="data_akademik" enctype="multipart/form-data">
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
													echo '<option '.($p["id"] == ($pendaftaran['prodi_1_id'] ?? null) ? 'selected': null).' value="'.$p['id'].'">'.$p['nama_prodi'].'</option>';
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
													echo '<option '.($p["id"] == ($pendaftaran['prodi_2_id'] ?? null) ? 'selected': null).' value="'.$p['id'].'">'.$p['nama_prodi'].'</option>';
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
									<div class="prestasi-wrapper">
										<?php 
											foreach($pendaftaran['detail_prestasi'] as $prestasi){
												?>
													<input type="hidden" name="detail_prestasi_id[]" value="<?php echo $prestasi['id'] ?>">
													<div class="form-group row">
														<label for="" class="col-md-2 col-form-label">Jenis prestasi</label>
														<div class="col-md-10">
															<select name="jenis_prestasi[]"  class="form-control">
																<option value="">Pilih</option>
																<option <?php  if ($prestasi['jenis_prestasi'] == 'NASIONAL') echo 'selected' ?> value="NASIONAL">Nasional</option>
																<option <?php  if ($prestasi['jenis_prestasi'] == 'INTERNASIONAL') echo 'selected' ?> value="INTERNASIONAL">Internasional</option>
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label for="" class="col-md-2 col-form-label">Nama Kegiatan</label>
														<div class="col-md-10">
															<input value="<?php  echo $prestasi['nama_kegiatan'] ?>" type="text" class="form-control" name="nama_kegiatan[]">
														</div>
													</div>
													<div class="form-group row">
														<label for="" class="col-md-2 col-form-label">Tanggal Kegiatan</label>
														<div class="col-md-10">
															<input value="<?php  echo $prestasi['tgl_kegiatan'] ?>" type="date" class="form-control" name="tgl_kegiatan[]">
														</div>
													</div>
													<div class="form-group row">
														<label for="" class="col-md-2 col-form-label">Unggah Bukti Prestasi</label>
														<?php 
															if(empty($prestasi['upload_bukti_prestasi'])){
																?>
																	<input type="file" name="upload_bukti_prestasi_<?php echo $prestasi['id'] ?>">
																<?php
															}else{
																?>
																	<a href="<?php echo base_url('uploads/'.$prestasi['upload_bukti_prestasi']) ?>" download class="btn btn-link bg-hover-primary text-hover-white"> <i class="fas fa-file-download text-primary"></i> Unduh Berkas</a>
																	<button type="button" class="btn btn-light-primary" data-name="upload_bukti_prestasi_<?php echo $prestasi['id'] ?>" data-toggle="sunting" data-target="upload" >
																		<i class="fas fa-pen"></i> Sunting
																	</button>
																<?php
															}
														?>
													</div>
													<div class="separator separator-solid mb-8"></div>
												<?php
											}
										?>
									</div>
									<div class="d-flex justify-content-center">
										<button type="button" data-prestasi-create="" class="btn font-weight-bold btn-light-primary">
											<i class="la la-plus"></i>
											Tambah Prestasi
										</button>
									</div>
							</div>
						</div>
					</div>
				</div>

				<div class="d-flex justify-content-end mt-4">
					<div class="d-flex">
						<div class="mr-2">
						<a href="<?php echo base_url('/pendaftaran/formulir/data_pendidikan?id='.$this->input->get('id')) ?>" class="btn btn-primary">Kembali</a>
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

