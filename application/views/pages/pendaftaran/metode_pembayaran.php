<div class="container">
	<div class="row align-items-center justify-content-center">
		<div class="col-md-8">
			<div class="card card-custom">
				<?php 
					$nomor_pembayaran = $this->session->flashdata('nomor_pembayaran');
					if(empty($nomor_pembayaran)){
						if($pendaftaran){
							?>
							<form action="<?php echo base_url('/api/pembayaran/save_pembayaran') ?>" method="POST" name="informasi_pembayaran">
								<div class="card-body">
									<div class="form-group row">
										<label class="col-md-3 col-form-label">No. Formulir</label>
										<input type="number" class="form-control" name="id" value="<?php echo $pendaftaran['id'] ?? ''?>" readonly>
									</div>
									<div class="form-group row">
										<label class="col-md-3 col-form-label">Nama Camaru</label>
										<input type="text" class="form-control" name="nama_camaru" value="<?php echo $pendaftaran['pembayaran'][0]['nama_camaru'] ?? $pendaftaran['nama']?>" readonly>
									</div>
									<div class="form-group row">
										<label class="col-md-3 col-form-label">Pilih Metode Pembayaran</label>
										<select name="jenis_pembayaran" id="" class="form-control">
											<option value="">Pilih</option>
											<?php
												foreach($jenis_pembayarans as $jenis_pembayaran){
													?>
														<option value="<?php echo $jenis_pembayaran['id'] ?>"><?php echo $jenis_pembayaran['jenis_pembayaran'] ?></option>
													<?php
												}
											?>
										</select>
									</div>
									<div class="info-pembayaran-wrapper my-4 w-100" style="display: none;">
										<div class="card card-custom bg-light">
											<div class="card-body">
												<?php 
													foreach($jenis_pembayarans as $jenis_pembayaran){
														echo '<pre style="display: none"'.'data-info="'.$jenis_pembayaran['id'].'"'.'>'.($jenis_pembayaran["info_pembayaran"] ?? "").'</pre>';
													}
												?>
											</div>
										</div>
									</div>
									<div class="d-flex justify-content-center">
										<button type="button" class="btn btn-primary lanjut">Submit</button>
									</div>
								</div>
							</form>
							<?php
						}
					}else{
						?>
						<div class="card-body">
							<p>Nomor pembayaran Anda <b><?php echo $nomor_pembayaran ?></b>, silahkan melakukan pembayaran sesuai metode yang dipilih. <br>Nomor pendaftaran berlaku 24 jam ke depan.</p>
						</div>
						<div class="d-flex justify-content-center">
							<a href="<?php echo base_url('/pendaftaran/data_camaru') ?>" class="btn btn-primary">Kembali</a>
						</div>
						<?php
					}
				?>
			</div>
		</div>
		
	</div>
</div>
