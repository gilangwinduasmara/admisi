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
		<div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel" aria-labelledby="kt_tab_pane_2" >
			<form action="<?php echo base_url('/api/pendaftaran/update_form')?>" method="POST" enctype="multipart/form-data" name="unggah_berkas">
				<input type="text" class="form-control" readonly name="form_type" hidden value="unggah_berkas">
				<input type="text" class="form-control" readonly name="id" hidden value="<?php echo $pendaftaran['id'] ?>">
				<div class="form-group row">
					<label for="" class="col-md-2 col-form-label">Unggah Foto</label>
					<div class="col-md-10">
						<?php
							if(empty($pendaftaran['upload_foto'])){
								?>
									<input type="file" accept="application/pdf, image/jpeg, image/png" name="upload_foto">
								<?php
							}else{
								?>
									<a href="<?php echo base_url('uploads/'.$pendaftaran['upload_foto']) ?>" download class="btn btn-link bg-hover-primary text-hover-white"> <i class="fas fa-file-download text-primary"></i> Unduh Berkas</a>
									<button type="button" class="btn btn-light-primary" data-toggle="sunting" data-target="upload" data-field="upload_foto">
										<i class="fas fa-pen"></i> Sunting
									</button>
								<?php
							}
						?>
					</div>
				</div>
				<div class="form-group row">
					<label for="" class="col-md-2 col-form-label">Unggah Kartu Keluarga</label>
					<div class="col-md-10">
						<?php
							if(empty($pendaftaran['upload_kk'])){
								?>
									<input type="file" accept="application/pdf, image/jpeg, image/png" name="upload_kk">
								<?php
							}else{
								?>
								<a href="<?php echo base_url('uploads/'.$pendaftaran['upload_kk']) ?>" download class="btn btn-link bg-hover-primary text-hover-white"> <i class="fas fa-file-download text-primary"></i> Unduh Berkas</a>
									<button type="button" class="btn btn-light-primary" data-toggle="sunting" data-target="upload" data-field="upload_kk">
										<i class="fas fa-pen"></i> Sunting
									</button>
								<?php
							}
						?>
					</div>
				</div>
				<div class="form-group row">
					<label for="" class="col-md-2 col-form-label">Unggah Akta Kelahiran</label>
					<div class="col-md-10">
						<?php
							if(empty($pendaftaran['upload_akta_lahir'])){
								?>
									<input type="file" accept="application/pdf, image/jpeg, image/png" name="upload_akta_lahir">
								<?php
							}else{
								?>
									<a href="<?php echo base_url('uploads/'.$pendaftaran['upload_akta_lahir']) ?>" download class="btn btn-link bg-hover-primary text-hover-white"> <i class="fas fa-file-download text-primary"></i> Unduh Berkas</a>
									<button type="button" class="btn btn-light-primary" data-toggle="sunting" data-target="upload" data-field="upload_akta_lahir">
										<i class="fas fa-pen"></i> Sunting
									</button>
								<?php
							}
						?>
					</div>
				</div>
				<div class="form-group row">
					<label for="" class="col-md-2 col-form-label">Surat Pernyataan</label>
					<div class="col-md-10">
						<?php
							if(empty($pendaftaran['upload_srt_pernyataan'])){
								?>
									<input type="file" accept="application/pdf, image/jpeg, image/png" name="upload_srt_pernyataan">
								<?php
							}else{
								?>
									<a href="<?php echo base_url('uploads/'.$pendaftaran['upload_srt_pernyataan']) ?>" download class="btn btn-link bg-hover-primary text-hover-white"> <i class="fas fa-file-download text-primary"></i> Unduh Berkas</a>
									<button type="button" class="btn btn-light-primary" data-toggle="sunting" data-target="upload" data-field="upload_srt_pernyataan">
										<i class="fas fa-pen"></i> Sunting
									</button>
								<?php
							}
						?>
					</div>
				</div>

				<div class="d-flex justify-content-end mt-4">
					<div class="d-flex">
						<div class="mr-2">
						<a href="<?php echo base_url('/pendaftaran/formulir/data_akademik?id='.$this->input->get('id')) ?>" class="btn btn-primary">Kembali</a>
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

